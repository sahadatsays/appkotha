<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('message_type', $request->type);
        }

        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'unanswered') {
                $query->where('is_replied', false);
            }
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    public function show(ContactMessage $message)
    {
        // Mark as read when viewed
        if (!$message->is_read) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function reply(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'reply_message' => 'required|string|min:10',
            'subject' => 'nullable|string|max:255',
        ]);

        $subject = $validated['subject'] ?? 'Re: ' . ($message->subject ?: 'Your Message');

        // Send email reply
        Mail::raw($validated['reply_message'], function ($mail) use ($message, $subject) {
            $mail->to($message->email, $message->name)
                ->subject($subject);
        });

        // Mark as replied
        $message->markAsReplied();
        $message->update(['notes' => $validated['reply_message']]);

        return back()->with('success', 'Reply sent successfully.');
    }

    public function markAsRead(ContactMessage $message)
    {
        $message->markAsRead();

        return back()->with('success', 'Message marked as read.');
    }

    public function markAsReplied(ContactMessage $message)
    {
        $message->markAsReplied();

        return back()->with('success', 'Message marked as replied.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function bulkMarkRead(Request $request)
    {
        $ids = $request->input('ids', []);

        ContactMessage::whereIn('id', $ids)->update(['is_read' => true]);

        return back()->with('success', 'Messages marked as read.');
    }
}
