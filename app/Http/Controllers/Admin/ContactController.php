<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:200'],
            'status' => ['nullable', Rule::in(Contact::STATUSES)],
        ]);
        $contacts = Contact::query()
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->latest('id')->paginate(15)->withQueryString();

        return view('admin.contact.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contact.show', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->validate(['status' => ['required', Rule::in(Contact::STATUSES)]]));

        return back()->with('success', 'Inquiry status updated.');
    }

    public function reply(Request $request, Contact $contact)
    {
        $data = $request->validate(['reply' => ['required', 'string', 'max:10000']]);

        try {
            Mail::raw($data['reply'], function ($message) use ($contact) {
                $message->to($contact->email, $contact->name)->subject('Re: '.$contact->subject);
            });
        } catch (\Throwable $exception) {
            report($exception);

            return back()->withInput()->withErrors(['reply' => 'The reply could not be sent. Please check the mail configuration and try again.']);
        }

        $contact->update(['reply' => $data['reply'], 'replied_at' => now(), 'status' => 'resolved']);

        return back()->with('success', 'Reply sent and inquiry resolved.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Inquiry deleted.');
    }
}
