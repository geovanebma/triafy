<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    // public function index(Request $request)
    // {
    //     $qtd = $request->get('qtd', 20);
    //     $busca = $request->get('busca');

    //     $query = Produto::query();

    //     if ($busca) {
    //         $query->where('nome', 'ILIKE', "%{$busca}%")
    //               ->orWhere('sku', 'ILIKE', "%{$busca}%")
    //               ->orWhere('categoria', 'ILIKE', "%{$busca}%");
    //     }

    //     $produtos = $query->orderBy('created_at', 'desc')->paginate($qtd);

    //     return view('partials.produtos-lista', compact('produtos'));
    // }

    // public function index(Request $request)
    // {
    //     $qtd = $request->get('qtd', 20);
    //     $busca = $request->get('busca');

    //     $query = Produto::query();

    //     if ($busca) {
    //         $query->where(function ($q) use ($busca) {
    //             $q->where('nome', 'LIKE', "%{$busca}%")
    //                 ->orWhere('sku', 'LIKE', "%{$busca}%")
    //                 ->orWhere('categoria', 'LIKE', "%{$busca}%");
    //         });
    //     }

    //     // outros filtros...

    //     $produtos = $query->orderBy('created_at', 'desc')->paginate($qtd);

    //     // Se for AJAX (X-Requested-With) retorne só o conteúdo dos cards
    //     if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
    //         return view('partials.produtos-lista-content', compact('produtos'))->render();
    //     }

    //     // lista de categorias para o popup (distinct)
    //     $categorias = Produto::select('categoria')->distinct()->pluck('categoria');

    //     return view('partials.produtos-lista', compact('produtos', 'categorias'));
    // }

    // public function index(Request $request)
    // {
    //     $qtd = $request->get('qtd', 20);
    //     $busca = $request->get('busca');
    //     $categoria = $request->get('categoria');
    //     $ordenar = $request->get('ordenar');
    //     $precoMin = $request->get('preco_min');
    //     $precoMax = $request->get('preco_max');

    //     $query = Produto::query();

    //     // Filtro de busca
    //     if ($busca) {
    //         $query->where(function ($q) use ($busca) {
    //             $q->where('nome', 'LIKE', "%{$busca}%")
    //                 ->orWhere('sku', 'LIKE', "%{$busca}%")
    //                 ->orWhere('categoria', 'LIKE', "%{$busca}%");
    //         });
    //     }

    //     // Filtro de categoria
    //     if ($categoria) {
    //         $query->where('categoria', $categoria);
    //     }

    //     // Filtro de preço mínimo
    //     if ($precoMin !== null && $precoMin !== '') {
    //         $query->where('preco', '>=', (float) $precoMin);
    //     }

    //     // Filtro de preço máximo
    //     if ($precoMax !== null && $precoMax !== '') {
    //         $query->where('preco', '<=', (float) $precoMax);
    //     }

    //     // Ordenação
    //     if ($ordenar === 'preco_asc') {
    //         $query->orderBy('preco', 'asc');
    //     } elseif ($ordenar === 'preco_desc') {
    //         $query->orderBy('preco', 'desc');
    //     } else {
    //         $query->orderBy('created_at', 'desc'); // default
    //     }

    //     $produtos = $query->paginate($qtd);

    //     if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
    //         return view('partials.produtos-lista-content', compact('produtos'))->render();
    //     }

    //     $categorias = Produto::select('categoria')->distinct()->pluck('categoria');
    //     return view('partials.produtos-lista', compact('produtos', 'categorias'));
    // }

    public function index(Request $request)
    {
        $qtd = $request->get('qtd', 20);
        $busca = $request->get('busca');
        $categoria = $request->get('categoria');
        $ordenar = $request->get('ordenar');
        $valorMin = $request->get('preco_min'); // no front continua preco_min
        $valorMax = $request->get('preco_max'); // no front continua preco_max

        $query = Produto::query();

        // 🔎 Filtro de busca
        if ($busca) {
            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'LIKE', "%{$busca}%")
                    ->orWhere('sku', 'LIKE', "%{$busca}%")
                    ->orWhere('categoria', 'LIKE', "%{$busca}%");
            });
        }

        // 📂 Filtro de categoria
        if ($categoria) {
            $query->where('categoria', $categoria);
        }

        // 💰 Filtro de valor mínimo
        if ($valorMin !== null && $valorMin !== '') {
            $query->where('valor', '>=', (float) $valorMin);
        }

        // 💰 Filtro de valor máximo
        if ($valorMax !== null && $valorMax !== '') {
            $query->where('valor', '<=', (float) $valorMax);
        }

        // 📊 Ordenação
        if ($ordenar === 'preco_asc') {
            $query->orderBy('valor', 'asc');
        } elseif ($ordenar === 'preco_desc') {
            $query->orderBy('valor', 'desc');
        } else {
            $query->orderBy('created_at', 'desc'); // default
        }

        $produtos = $query->paginate($qtd);

        // ⚡ Resposta parcial para AJAX
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('partials.produtos-lista-content', compact('produtos'))->render();
        }

        // 📌 Lista de categorias para o filtro
        $categorias = Produto::select('categoria')->distinct()->pluck('categoria');

        return view('partials.produtos-lista', compact('produtos', 'categorias'));
    }





    public function gerarSku(Request $request)
    {
        $nome = $request->get('nome', 'PROD');
        $prefixo = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $nome), 0, 3));

        do {
            $sku = $prefixo . '-' . strtoupper(Str::random(5));
        } while (Produto::where('sku', $sku)->exists());

        return $sku;
    }

    public function create()
    {
        return view('partials.produto_form');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'categoria' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Gera SKU sempre que não existir
        if (empty($data['sku'])) {
            $data['sku'] = $this->gerarSku($request);
        }

        if ($request->hasFile('fotos')) {
            $fotosArray = [];

            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $fotosArray[] = base64_encode(file_get_contents($foto->path()));
                }
            }

            $data['foto'] = json_encode($fotosArray);
        }

        // Especificações em JSON
        if ($request->has('especificacoes')) {
            $especificacoes = [];
            foreach ($request->especificacoes['chave'] as $index => $chave) {
                if (!empty($chave) && !empty($request->especificacoes['valor'][$index])) {
                    $especificacoes[$chave] = $request->especificacoes['valor'][$index];
                }
            }
            $data['especificacoes'] = json_encode($especificacoes);
        }

        Produto::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Produto cadastrado com sucesso!'
        ]);
    }

    // public function exportar(Request $request)
    // {
    //     $produtos = Produto::all();
    //     $csv = "Nome,SKU,Categoria,Valor\n";

    //     foreach ($produtos as $p) {
    //         $csv .= "{$p->nome},{$p->sku},{$p->categoria},{$p->valor}\n";
    //     }

    //     return response($csv)
    //         ->header('Content-Type', 'text/csv')
    //         ->header('Content-Disposition', 'attachment; filename=produtos.csv');
    // }

    // public function exportar(Request $request)
    // {
    //     return Excel::download(new ProdutosExport($request), 'produtos.xlsx');
    // }

    // public function exportar(Request $request)
    // {
    //     $produtos = Produto::all();
    //     $filename = "produtos.csv";

    //     $handle = fopen('php://temp', 'r+');
    //     fputcsv($handle, ['Nome', 'SKU', 'Categoria', 'Valor'], ';');

    //     foreach ($produtos as $p) {
    //         fputcsv($handle, [
    //             $p->nome,
    //             $p->sku,
    //             $p->categoria,
    //             $p->valor
    //         ], ';'); // usa ; que o Excel entende melhor
    //     }

    //     rewind($handle);
    //     $content = stream_get_contents($handle);
    //     fclose($handle);

    //     return response($content)
    //         ->header('Content-Type', 'text/csv; charset=UTF-8')
    //         ->header('Content-Disposition', "attachment; filename={$filename}")
    //         ->header('Pragma', 'no-cache')
    //         ->header('Expires', '0');
    // }

    public function exportar(Request $request)
    {
        $produtos = Produto::all();
        $filename = "produtos.csv";

        $handle = fopen('php://temp', 'r+');

        // escreve BOM para o Excel entender UTF-8
        fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

        // cabeçalho
        fputcsv($handle, ['Nome', 'SKU', 'Categoria', 'Valor'], ';');

        // dados
        foreach ($produtos as $p) {
            fputcsv($handle, [
                $p->nome,
                $p->sku,
                $p->categoria,
                $p->valor
            ], ';'); // usa ; que o Excel entende melhor
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', "attachment; filename={$filename}")
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);

        // return view('produtos.show', compact('produto'));
        return view('partials.show', compact('produto'));
    }


}