<?php
namespace App\Exports;

use App\Models\Produto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProdutosExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Produto::query();

        if ($this->request->busca) {
            $query->where('nome', 'LIKE', "%{$this->request->busca}%")
                  ->orWhere('sku', 'LIKE', "%{$this->request->busca}%")
                  ->orWhere('categoria', 'LIKE', "%{$this->request->busca}%");
        }

        if ($this->request->categoria) {
            $query->where('categoria', $this->request->categoria);
        }

        if ($this->request->preco_min) {
            $query->where('valor', '>=', $this->request->preco_min);
        }

        if ($this->request->preco_max) {
            $query->where('valor', '<=', $this->request->preco_max);
        }

        $produtos = $query->get();

        return view('exports.produtos', [
            'produtos' => $produtos
        ]);
    }
}
?>
