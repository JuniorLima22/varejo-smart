<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table): void {
            $table->id();
            $table->string('codigo_venda', 50)->unique();
            $table->enum('status', ['pendente', 'pago', 'cancelado', 'enviado', 'concluido'])->default('pendente')->after('codigo_venda');
            $table->timestamp('data_venda');
            $table->decimal('total', 10, 2);
            $table->foreignId('cupom_id')->nullable()->constrained('cupons');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('vendedor_id')->constrained('users');
            $table->timestamp('data_envio_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
