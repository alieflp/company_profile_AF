<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\UpdateContactMessageStatusRequest;
use Illuminate\Support\Facades\RateLimiter;

class ContactMessageController extends Controller
{
    public function index()
    {
        return ContactMessage::query()->latest()->paginate(25);
    }

    public function store(StoreContactMessageRequest $request)
    {
        if (RateLimiter::tooManyAttempts('contact:'.$request->ip(), 10)) {
            return response()->json(['message' => 'Too many submissions'], 429);
        }
        $data = $request->validated();
        $data['status'] = 'new';
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->userAgent();
        $created = ContactMessage::create($data);
        RateLimiter::hit('contact:'.$request->ip());
        return $created;
    }

    public function show(ContactMessage $contactMessage)
    {
        return $contactMessage;
    }

    public function update(UpdateContactMessageStatusRequest $request, ContactMessage $contactMessage)
    {
        $data = $request->validated();
        if (isset($data['status'])) {
            if ($data['status'] === 'read' && !$contactMessage->is_read) {
                $data['is_read'] = true;
                $data['read_at'] = now();
            }
            if ($data['status'] === 'responded') {
                $data['responded_at'] = now();
            }
        }
        $contactMessage->update($data);
        return $contactMessage->refresh();
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return response()->json(['deleted' => true]);
    }
}
