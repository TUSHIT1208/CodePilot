<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CoursePurchasedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $learner;
    /**
     * Create a new message instance.
     */
    public function __construct($course, $learner)
    {
        $this->course = $course;
        $this->learner = $learner;
        $this->course->final_price = $this->course->price - ($this->course->discount ?? 0);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Course Purchased Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.course_purchased_notification', // ✅ Correct view path
            with: [
                'course' => $this->course,
                'learner' => $this->learner,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
