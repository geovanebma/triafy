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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            // Cliente
            $table->string('cliente');
            $table->string('email_cliente')->nullable();
            $table->string('telefone_cliente')->nullable();

            // Produto
            $table->foreignId('produto_id')->nullable()->constrained('produtos')->onDelete('set null');
            $table->integer('quantidade')->default(1);

            // Identificação
            $table->string('n_pedido')->nullable(); // número do pedido interno
            $table->string('codigo_externo')->nullable(); // código do marketplace

            // Canal de venda
            $table->string('canal_venda')->nullable(); // Shopee, Mercado Livre, etc
            $table->string('canal_venda_categoria')->nullable(); // ex: Mercado Envios Coleta

            // Status
            $table->string('status')->default('Aguardando Pagamento');

            // Valores financeiros
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->decimal('valor_receber', 10, 2)->default(0);

            // Foto (opcional, pode vir do produto)
            $table->longText('foto')->nullable();

            // Relacionamento com vendedor
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
