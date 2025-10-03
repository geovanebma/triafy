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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('sku')->unique();
            $table->string('categoria')->nullable();

            // Estoque
            $table->integer('quantidade')->default(0);

            // Valores e custos
            $table->decimal('valor', 10, 2); // preço de venda
            $table->decimal('preco_promocional', 10, 2)->nullable();
            $table->integer('estoque')->default(0);
            $table->string('status')->default('disponível');
            $table->string('imagem')->nullable();
            $table->decimal('preco_medio', 10, 2)->nullable();
            $table->decimal('custo_unitario', 10, 2)->nullable();
            $table->decimal('custo', 10, 2)->nullable();
            $table->decimal('tarifa', 10, 2)->nullable();
            $table->decimal('frete', 10, 2)->nullable();
            $table->decimal('ads', 10, 2)->nullable();
            $table->decimal('imposto', 10, 2)->nullable();
            $table->decimal('margem', 10, 2)->nullable();
            $table->json('especificacoes')->nullable()->after('descricao');

            // Imagem em base64
            $table->longText('foto')->nullable();

            // Relacionamento
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // quem cadastrou o produto

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn('especificacoes');
        });
    }
};