<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProformaInvoiceGenerated extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $invoice;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param $invoice
     * @param $user
     */
    public function __construct($invoice, $user)
    {
        $this->invoice = $invoice;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invoice.proforma')
            ->subject('Your Proforma Invoice');
    }
}
