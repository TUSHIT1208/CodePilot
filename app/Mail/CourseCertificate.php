<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class CourseCertificate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $certificate;
     public $test_result;
     public $pdf;

    public function __construct($certificate, $test_result, $pdf)
    {
        $this->certificate = $certificate;
        $this->test_result = $test_result;
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Course Certificate',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.course_certificate',
            with: [
                'certificate' => $this->certificate,
                'test_result' => $this->test_result,
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
                Attachment::fromData(fn () => $this->pdf->output(), 'certificate.pdf')
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
