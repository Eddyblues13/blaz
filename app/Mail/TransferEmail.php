<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransferEmail extends Mailable
{
    /**
     * The user instance.
     */
    public $user;

    /**
     * The transaction amount.
     */
    public $amount;

    /**
     * The type of account (Savings or Checking).
     */
    public $type;

    /**
     * The transaction type (Credit or Debit).
     */
    public $transactionType;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $amount, $type, $transactionType)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->type = $type;
        $this->transactionType = $transactionType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transaction Notification'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transfer_notification', // Ensure this view exists
            with: [
                'user' => $this->user,
                'amount' => $this->amount,
                'type' => $this->type,
                'transactionType' => $this->transactionType,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
