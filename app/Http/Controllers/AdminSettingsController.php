<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminSettingsController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = 'logo-' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('logos', $logoName, 'public');
            
            // Delete old logo if exists
            $oldLogo = Setting::where('key', 'company_logo')->first();
            if ($oldLogo && $oldLogo->value && Storage::disk('public')->exists($oldLogo->value)) {
                Storage::disk('public')->delete($oldLogo->value);
            }
            
            // Save new logo path
            Setting::updateOrCreate(
                ['key' => 'company_logo'],
                ['value' => $logoPath, 'type' => 'image', 'group' => 'company']
            );
        }

        foreach ($validated['settings'] as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                $setting->value = $value;
                $setting->save();
            }
        }

        Setting::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings berhasil disimpan!');
    }

    public function updateEmailConfig(Request $request)
    {
        $request->validate([
            'mail_mailer' => 'required|in:smtp,log',
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'required|in:tls,ssl',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        try {
            $envPath = base_path('.env');
            $envContent = file_get_contents($envPath);

            $updates = [
                'MAIL_MAILER' => $request->mail_mailer,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
                'MAIL_FROM_NAME' => $request->mail_from_name,
            ];

            foreach ($updates as $key => $value) {
                // Handle values with spaces or special characters
                $quotedValue = $this->needsQuotes($value) ? '"' . addslashes($value) . '"' : $value;
                
                if (preg_match("/^{$key}=/m", $envContent)) {
                    // Update existing key
                    $envContent = preg_replace(
                        "/^{$key}=.*/m",
                        "{$key}={$quotedValue}",
                        $envContent
                    );
                } else {
                    // Add new key
                    $envContent .= "\n{$key}={$quotedValue}";
                }
            }

            file_put_contents($envPath, $envContent);

            // Clear config cache
            Artisan::call('config:clear');

            return redirect()->route('admin.settings.index')
                ->with('success', 'Email configuration berhasil disimpan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan konfigurasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function testEmail(Request $request)
    {
        try {
            $user = $request->user();
            
            Mail::raw('Ini adalah test email dari AF Web Design. Jika Anda menerima email ini, konfigurasi email Anda sudah benar!', function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Test Email - AF Web Design');
            });

            return response()->json([
                'success' => true,
                'message' => 'Test email berhasil dikirim ke ' . $user->email
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function needsQuotes($value)
    {
        return str_contains($value, ' ') || 
            str_contains($value, '@') || 
            str_contains($value, '#') ||
            str_contains($value, '$') ||
            empty($value);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $request->user()->id,
            'password' => 'required|string',
        ]);

        $user = $request->user();

        // Verify current password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password yang Anda masukkan salah!')
                ->withInput();
        }

        // Update email
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Email berhasil diupdate!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = $request->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->with('error', 'Password saat ini yang Anda masukkan salah!')
                ->withInput();
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Password berhasil diubah!');
    }
}
