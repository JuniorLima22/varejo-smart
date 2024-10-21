<?php

namespace App\Jobs;

use App\Mail\VendaConfirmacaoCompraMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class EnviarEmailVendaJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected int $vendaId, protected string $emailCliente)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->emailCliente)->send(new VendaConfirmacaoCompraMail($this->vendaId));
    }
}
