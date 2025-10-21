<div class="container my-4 text-white triafy-box">
    <a href="#" data-url="{{ route('produtos.index') }}" class="d-block mb-3 text-decoration-none">
        ← Voltar ao Catálogo
    </a>
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="text-purple">{{ $produto->nome }}</h2>
            @php
                $fotos = json_decode($produto->foto, true);
                if (!$fotos)
                    $fotos = [$produto->foto];
            @endphp
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-inner slider-main slider-thumbs mt-3 d-flex gap-2 flex-wrap">
                    @foreach($fotos as $index => $img)
                    @php
                        // converte a imagem base64 em resource GD
                        $data = base64_decode($img);
                        $src = imagecreatefromstring($data);

                        $width = imagesx($src);
                        $height = imagesy($src);

                        // define qual atributo usar com base na proporção
                        $isVertical = $height >= $width;

                        // libera memória
                        imagedestroy($src);
                    @endphp
                        <div class="carousel-item text-center {{ $index === 0 ? 'active' : '' }}">
                            <img class="rounded shadow" src="data:image/png;base64,{{ $img }}" alt="{{ $produto->nome }}"
                                @if($isVertical) height="400px" @else width="100%" @endif style="object-fit: contain;">

                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="carousel-indicators" style="position: relative;">
                @foreach($fotos as $index => $img)
                    <img src="data:image/png;base64,{{ $img }}"
                        class="thumb img-thumbnail {{ $index === 0 ? 'active' : '' }}" width="90" data-index="{{ $index }}"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" aria-current="true"
                        aria-label="Slide {{ $index }}" style="height: unset;">
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-6">
            <br>
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
        <p><b>Criado em:</b>
            {{ implode("/", array_reverse(explode("-", explode(" ", $produto->created_at)[0]))) . " " . explode(" ", $produto->created_at)[1] }}
        </p>
        <p><b>Última atualização:</b>
            {{ implode("/", array_reverse(explode("-", explode(" ", $produto->updated_at)[0]))) . " " . explode(" ", $produto->updated_at)[1] }}
        </p>
    </div>
</div>
<!-- @section('content')
@endsection -->