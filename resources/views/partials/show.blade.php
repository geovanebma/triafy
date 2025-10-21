@extends('layouts.app')

@section('content')
    <div class="container my-4 text-white triafy-box">
        <a href="#" data-url="{{ route('produtos.index') }}" class="d-block mb-3 text-decoration-none">
            ← Voltar ao Catálogo
        </a>
        <div class="row">
            <div class="col-6">
                @php
                    $fotos = json_decode($produto->foto, true);
                    if (!$fotos)
                        $fotos = [$produto->foto];
                @endphp
                <div class="produto-slider text-center">
                    <div class="slider-main">
                        <img id="slider-main-img" src="data:image/png;base64,{{ $fotos[0] ?? '' }}"
                            class="img-fluid rounded shadow" alt="{{ $produto->nome }}">
                    </div>
                    <div class="slider-controls d-flex justify-content-between align-items-center mt-2">
                        <button id="prev-btn" class="btn btn-outline-light btn-sm"><i class="bi bi-chevron-left"></i></button>
                        <button id="next-btn" class="btn btn-outline-light btn-sm"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
                <div class="slider-thumbs mt-3 d-flex justify-content-center gap-2 flex-wrap">
                    @foreach($fotos as $index => $img)
                        <img src="data:image/png;base64,{{ $img }}" 
                            class="thumb img-thumbnail" 
                            width="90" 
                            data-index="{{ $index }}">
                    @endforeach
                </div>
            </div>
            <div class="col-6">
                <h2 class="text-purple">{{ $produto->nome }}</h2>
                <p class="">SKU: {{ $produto->sku }}</p>

                <h3 class="text-success">
                    R$ {{ number_format($produto->valor, 2, ',', '.') }}
                </h3>

                @if ($produto->preco_promocional)
                    <h5 class="text-warning">
                        Promoção: R$ {{ number_format($produto->preco_promocional, 2, ',', '.') }}
                    </h5>
                @endif

                <span class="badge bg-{{ $produto->status == 'disponível' ? 'success' : 'danger' }}">
                    {{ strtoupper($produto->status) }}
                </span>

                <p class="mt-3"><b>Categoria:</b> {{ $produto->categoria }}</p>
                <p><b>Quantidade em estoque:</b> {{ $produto->quantidade }}</p>
                <p><b>Descrição:</b> {{ $produto->descricao }}</p>

                <hr class="border-secondary">

                <h5>Especificações Técnicas</h5>
                <ul>
                    @if($produto->especificacoes)
                        @foreach(json_decode($produto->especificacoes, true) as $chave => $valor)
                            <li><b>{{ $chave }}:</b> {{ $valor }}</li>
                        @endforeach
                    @else
                        <li>Sem especificações adicionais</li>
                    @endif
                </ul>

                <hr class="border-secondary">
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <div class="text-muted small">
            <p><b>Cadastrado por:</b> Usuário ID {{ $produto->user_id }}</p>
            <p><b>Criado em:</b> {{ implode("/", array_reverse(explode("-", explode(" ", $produto->created_at)[0])))." ".explode(" ", $produto->created_at)[1] }}</p>
            <p><b>Última atualização:</b> {{ implode("/", array_reverse(explode("-", explode(" ", $produto->updated_at)[0])))." ".explode(" ", $produto->updated_at)[1] }}</p>
        </div>
    </div>
@endsection