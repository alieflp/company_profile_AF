# Password Reset Feature

## Fitur yang Telah Dibuat

1. **Halaman Lupa Password** (`/forgot-password`)
   - Form untuk memasukkan email
   - Validasi email harus terdaftar
   - Mengirim link reset password ke email

2. **Halaman Reset Password** (`/reset-password/{token}`)
   - Form untuk memasukkan password baru
   - Validasi password minimal 8 karakter
   - Konfirmasi password harus cocok
   - Token valid selama 60 menit (default)

3. **Email Notification**
   - Custom email template dalam bahasa Indonesia
   - Link reset password otomatis
   - Expiry time notification

## Routes yang Ditambahkan

```php
// Menampilkan form lupa password
GET /forgot-password → password.request

// Mengirim email reset password
POST /forgot-password → password.email

// Menampilkan form reset password
GET /reset-password/{token} → password.reset

// Proses reset password
POST /reset-password → password.update
```

## Cara Testing (Development)

Saat ini email menggunakan `MAIL_MAILER=log`, jadi email akan disimpan di log file:

1. **Buka halaman login** → Klik "Lupa Password?"

2. **Masukkan email yang terdaftar** (misalnya email admin yang ada di database)

3. **Check log file** untuk melihat email yang dikirim:
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Copy link reset password** dari log dan buka di browser

5. **Masukkan password baru** dan konfirmasi

## Setup Email untuk Production

### Menggunakan Gmail SMTP

Edit file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="AF Web Design"
```

**Catatan:** Untuk Gmail, gunakan [App Password](https://myaccount.google.com/apppasswords), bukan password akun biasa.

### Menggunakan Mailtrap (Testing)

Edit file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@afwebdesign.com
MAIL_FROM_NAME="AF Web Design"
```

### Menggunakan SendGrid

Edit file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@afwebdesign.com
MAIL_FROM_NAME="AF Web Design"
```

## File yang Dibuat/Dimodifikasi

### Controllers
- `app/Http/Controllers/PasswordResetController.php` (new)

### Views
- `resources/views/auth/forgot-password.blade.php` (new)
- `resources/views/auth/reset-password.blade.php` (new)
- `resources/views/auth/login.blade.php` (updated - added "Lupa Password?" link)

### Notifications
- `app/Notifications/ResetPasswordNotification.php` (new)

### Models
- `app/Models/User.php` (updated - added sendPasswordResetNotification method)

### Routes
- `routes/web.php` (updated - added password reset routes)

## Testing Checklist

- [ ] Buka halaman login
- [ ] Klik "Lupa Password?"
- [ ] Masukkan email yang tidak terdaftar → harus error
- [ ] Masukkan email yang terdaftar → harus sukses
- [ ] Check log/email untuk link reset
- [ ] Klik link reset password
- [ ] Masukkan password baru < 8 karakter → harus error
- [ ] Masukkan password baru tanpa konfirmasi → harus error
- [ ] Masukkan password baru dengan konfirmasi berbeda → harus error
- [ ] Masukkan password baru valid → harus sukses
- [ ] Login dengan password lama → harus gagal
- [ ] Login dengan password baru → harus berhasil

## Security Features

1. **Rate Limiting** - Mencegah spam request
2. **Token Expiry** - Link reset kadaluarsa setelah 60 menit
3. **One-Time Use** - Token hanya bisa digunakan sekali
4. **Email Validation** - Hanya email terdaftar yang bisa reset
5. **Password Confirmation** - Memastikan user tidak salah ketik
6. **All Tokens Deleted** - Semua session/token lama dihapus setelah reset

## Konfigurasi

Password reset dapat dikonfigurasi di `config/auth.php`:

```php
'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60, // Link kadaluarsa dalam 60 menit
        'throttle' => 60, // Cooldown 60 detik antar request
    ],
],
```
