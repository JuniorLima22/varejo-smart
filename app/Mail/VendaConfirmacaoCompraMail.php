<?php

namespace App\Mail;

use App\Models\ItemVenda;
use App\Models\Venda;
use App\Service\ItemVendaService;
use App\Service\VendaService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendaConfirmacaoCompraMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected int $vendaId)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Venda Confirmacao Compra Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $vendaService = app(VendaService::class);
        $venda = $vendaService->listarPorId($this->vendaId);

        return new Content(
            markdown: 'mail.venda.confirmacao-compra',
            with: compact('venda'),
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [1];
    }
}
