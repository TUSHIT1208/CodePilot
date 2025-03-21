<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
// use Symfony\Component\Mime\Part\DataPart;
use Illuminate\Contracts\Queue\ShouldQueue;

class CoursePurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $learner;
    public $pdf;
    /**
     * Create a new message instance.
     */
    public function __construct($course, $learner,$pdf)
    {
        $this->course = $course;
        $this->learner = $learner;
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Course Purchase Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.course_purchase_confirmation', // ✅ Correct view path
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
        try {
            logger('Generating PDF attachment...');
            
            $attachments = [
                Attachment::fromData(fn () => $this->pdf->output(), 'invoice.pdf')
                    ->withMime('application/pdf'),
            ];
            
            logger('PDF attached successfully.');
    
            return $attachments;
        } catch (\Exception $e) {
            logger('Error generating PDF attachment: ' . $e->getMessage());
            return [];
        }
    }
}
