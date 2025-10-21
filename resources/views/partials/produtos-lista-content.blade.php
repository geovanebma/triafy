<div class="row">
    @foreach ($produtos as $produto)
        <div class="col-md-3 mb-3">
            <a ver-prod="{{ route('produtos.show', $produto->id) }}">
                <div class="card bg-dark text-white p-2 h-100">
                    <div class="position-relative card-produto">
                        @php
                            $fotos = json_decode($produto->foto, true);
                            if (!$fotos)
                                $fotos = [$produto->foto];
                        @endphp
                        @if ($fotos && count($fotos) > 0)
                            <img src="data:image/png;base64,{{ $fotos[0] }}" class="card-img-top " alt="{{ $produto->nome }}">
                        @endif
                        <span class="badge bg-success position-absolute top-0 start-0 m-2">DISPONÍVEL</span>
                    </div>
                    <div class="card-body">
                        <span class="card-title">{{ $produto->nome }}</span>
                        <p class="text-price fw-bold">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
                        <small>SKU: {{ $produto->sku }}</small><br>
                        <small>Categoria: {{ $produto->categoria }}</small>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $produtos->links('pagination::bootstrap-5') }}
</div>