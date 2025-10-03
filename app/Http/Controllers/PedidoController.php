<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    // Lista todos os pedidos (para carregar via AJAX)
    // public function listar()
    // {
    //     $pedidos = Pedido::all();
    //     return view('partials.pedidos', compact('pedidos'));
    // }

    // public function listar()
    // {
    //     $pedidos = Pedido::all();
    //     return view('partials.pedidos', compact('pedidos'));
    // }

    public function listar()
    {
        // total de pedidos no período
        $totalPedidos = Pedido::count();

        // valor total vendido no período
        $totalVendido = Pedido::sum('valor_total');

        // valor pago (exemplo: pode ser um campo no banco ou calculado)
        $totalPago = Pedido::sum('valor_receber');

        // pedidos por status
        $aguardandoPagamento = Pedido::where('status', 'Aguardando Pagamento')->count();
        $processando = Pedido::where('status', 'Processando pagamento')->count();
        $enviados = Pedido::where('status', 'Enviado')->count();
        $pendencias = Pedido::where('status', 'Com Pendências')->count();
        $reembolsados = Pedido::where('status', 'Reembolsado')->count();
        $cancelados = Pedido::where('status', 'Cancelado')->count();

        // lista dos pedidos (mais recentes primeiro)
        $pedidos = Pedido::orderBy('created_at', 'desc')->paginate(10);

        return view('partials.pedidos', compact(
            'pedidos',
            'totalPedidos',
            'totalVendido',
            'totalPago',
            'aguardandoPagamento',
            'processando',
            'enviados',
            'pendencias',
            'reembolsados',
            'cancelados'
        ));
    }

    public function filtro(Request $request)
{
    $query = Pedido::query();

    if ($request->filled('busca')) {
        $busca = $request->busca;
        $query->where(function ($q) use ($busca) {
            $q->where('cliente', 'ILIKE', "%{$busca}%")
              ->orWhere('canal_venda', 'ILIKE', "%{$busca}%")
              ->orWhere('canal_venda_categoria', 'ILIKE', "%{$busca}%")
              ->orWhere('codigo_externo', 'ILIKE', "%{$busca}%")
              ->orWhere('created_at', 'ILIKE', "%{$busca}%");
        });
    }

    $qtd = $request->get('qtd', 10);
    $pedidos = $query->orderBy('created_at', 'desc')->paginate($qtd);

    return view('partials.pedidos-lista', compact('pedidos'))->render();
}



    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }

    // Página de criação (se quiser usar futuramente)
    public function create()
    {
        return view('pedidos.create');
    }

    // Salva um novo pedido
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'produto' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:1'
        ]);

        Pedido::create($request->all());

        return redirect()->route('pedidos.listar')->with('success', 'Pedido criado com sucesso!');
    }
}
