<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use DatabaseTransactions;

    private function inquiry(): Contact
    {
        return Contact::create(['name' => 'Contact Tester', 'email' => 'contact@example.com', 'subject' => 'Course question', 'message' => '<script>alert(1)</script>']);
    }

    private function admin(): void
    {
        $this->actingAs(new User(['id' => 1, 'name' => 'Admin', 'role' => 'admin', 'status' => '1']), 'admin');
    }

    public function test_public_submission_is_validated_and_saved_without_accepting_status(): void
    {
        $this->get(route('contact'))->assertOk()->assertSee('Send message');
        $this->post(route('contact.store'), [])->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
        $this->post(route('contact.store'), ['name' => 'Test', 'email' => 'contact@example.com', 'subject' => 'Help', 'message' => 'Please help', 'status' => 'resolved'])
            ->assertRedirect(route('contact'))->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', ['subject' => 'Help', 'status' => 'new']);
    }

    public function test_guest_cannot_access_or_modify_inquiries(): void
    {
        $contact = $this->inquiry();
        $this->get(route('admin.contact.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.contact.show', $contact))->assertRedirect(route('admin.login'));
        $this->patch(route('admin.contact.update', $contact), ['status' => 'resolved'])->assertRedirect(route('admin.login'));
        $this->post(route('admin.contact.reply', $contact), ['reply' => 'Hello'])->assertRedirect(route('admin.login'));
        $this->delete(route('admin.contact.destroy', $contact))->assertRedirect(route('admin.login'));
        $this->assertDatabaseHas('contacts', ['id' => $contact->id, 'status' => 'new']);
    }

    public function test_admin_can_filter_read_update_and_delete(): void
    {
        $contact = $this->inquiry();
        $this->admin();
        $this->get(route('admin.contact.index', ['search' => 'Course question', 'status' => 'new']))->assertOk()->assertSee('Course question');
        $this->get(route('admin.contact.index', ['search' => 'no-match-123']))->assertOk()->assertDontSee('Course question');
        $this->get(route('admin.contact.show', $contact))->assertOk()->assertSee('&lt;script&gt;', false)->assertDontSee('<script>alert(1)</script>', false);
        $this->patch(route('admin.contact.update', $contact), ['status' => 'invalid'])->assertSessionHasErrors('status');
        $this->patch(route('admin.contact.update', $contact), ['status' => 'in_progress'])->assertSessionHas('success');
        $this->assertSame('in_progress', $contact->fresh()->status);
        $this->delete(route('admin.contact.destroy', $contact))->assertRedirect(route('admin.contact.index'));
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    public function test_reply_records_success_only_after_mail_is_sent(): void
    {
        $contact = $this->inquiry();
        $this->admin();
        Mail::shouldReceive('raw')->once()->with('Thanks for contacting us', \Mockery::on(function ($callback) {
            $message = new \Illuminate\Mail\Message(new \Symfony\Component\Mime\Email);
            $callback($message);

            return $message->getTo()[0]->getAddress() === 'contact@example.com' && $message->getSubject() === 'Re: Course question';
        }));
        $this->post(route('admin.contact.reply', $contact), ['reply' => 'Thanks for contacting us'])->assertSessionHas('success');
        $this->assertSame('resolved', $contact->fresh()->status);
        $this->assertNotNull($contact->fresh()->replied_at);
    }

    public function test_mail_failure_preserves_inquiry_and_reply_input(): void
    {
        $contact = $this->inquiry();
        $this->admin();
        Mail::shouldReceive('raw')->once()->andThrow(new \RuntimeException('Mail unavailable'));
        $this->post(route('admin.contact.reply', $contact), ['reply' => 'Try again'])->assertSessionHasErrors('reply')->assertSessionHasInput('reply', 'Try again');
        $this->assertSame('new', $contact->fresh()->status);
        $this->assertNull($contact->fresh()->replied_at);
    }
}
