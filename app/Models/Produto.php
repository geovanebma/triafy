<?php
    // app/Models/Produto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'sku',
        'categoria',
        'quantidade',
        'valor',
        'preco_promocional',
        'estoque',
        'status',
        'imagem',
        'preco_medio',
        'custo_unitario',
        'custo',
        'tarifa',
        'frete',
        'ads',
        'imposto',
        'margem',
        'foto',
        'especificacoes',
        'user_id'
    ];
}

?>