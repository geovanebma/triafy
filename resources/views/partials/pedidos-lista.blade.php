@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@foreach($pedidos as $pedido)
<div class="pedido-card">
    <div class="row align-items-center">
        <div class="col-1 text-center">
            <input type="checkbox" class="form-check-input">
        </div>
        <div class="col-2">
            @if($pedido->foto)
                <img src="data:image/png;base64,{{ $pedido->foto }}" class="with_img" alt="foto">
            @else
                <div class="without_img"><i class="bi bi-card-image"></i></div>
            @endif
        </div>
        <div class="col-3">
            <span class="badge bg-{{ Str::slug($pedido->status) }}">{{ $pedido->status }}</span>
            <label class="mb-0 text-white">{{ $pedido->cliente }}</label>
            <small class="text-special">Pedido {{ $pedido->id }}</small>
            <br>
            <small class="text-special">#{{ $pedido->codigo_externo }}</small>
        </div>
        <div class="col-3">
            <small class="d-block text-special">
                Criado em: <strong class="text-destaque">{{ $pedido->created_at->format('d/m/Y, H:i:s') }}</strong>
            </small>
            <small class="d-block text-special">
                Canal de venda: <span class="text-destaque">{{ $pedido->canal_venda }}</span><br>
                <span class="text-destaque">{{ $pedido->canal_venda_categoria }}</span>
            </small>
        </div>
        <div class="col-3">
            <small class="d-block text-white">
                Total da venda: <strong>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</strong>
            </small>
            <small class="d-block text-white">
                Total a receber: <strong>R$ {{ number_format($pedido->valor_receber, 2, ',', '.') }}</strong>
            </small>
        </div>
    </div>
</div>
@endforeach

{{-- Paginação --}}
<div class="mt-3">
    {{ $pedidos->links() }}
</div>
