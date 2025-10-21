@php
    use Illuminate\Support\Str;
@endphp

<div class="col-md-12">
    <div class="triafy-box">
        <div class="row mb-4">

            <div class="col-md-4 mb-3">
                <div class="card-box bg-dark text-white p-3 shadow-sm h-100">
                    <div class="icon-line text-price">
                        <i class="bi bi-bag icon-warning"></i>
                        <label>PEDIDOS NO PERÍODO</label>
                    </div>
                    <span>{{ $totalPedidos }}</span>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card-box bg-dark text-white p-3 shadow-sm h-100">
                    <div class="icon-line text-success2">
                        <i class="bi bi-cash icon-success"></i>
                        <label>VENDIDO NO PERÍODO</label>
                    </div>
                    <span>R$ {{ number_format($totalVendido, 2, ',', '.') }}</span>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card-box bg-dark text-white p-3 shadow-sm h-100">
                    <div class="icon-line text-info">
                        <i class="bi bi-wallet2 icon-primary"></i>
                        <label>PAGO AO TRIAFY</label>
                    </div>
                    <span>R$ {{ number_format($totalPago, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-6 col-md-2 mb-3">
                <div class="icon-line bg-special">
                    <span class="icon-number">{{ $aguardandoPagamento }}</span>
                    <label>Aguardando Pag.</label>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="icon-line bg-special">
                    <span class="icon-number">{{ $processando }}</span>
                    <label>Processando</label>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="icon-line bg-special">
                    <span class="icon-number">{{ $enviados }}</span>
                    <label>Enviados</label>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="icon-line bg-special">
                    <span class="icon-number">{{ $pendencias }}</span>
                    <label>Com Pendências</label>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="icon-line bg-special">
                    <span class="icon-number">{{ $reembolsados }}</span>
                    <label class="icon-danger">Reembolsados</label>
                </div>
            </div>
            <div class="col-6 col-md-2 mb-3">
                <div class="icon-line bg-special">
                    <span class="icon-number">{{ $cancelados }}</span>
                    <label class="icon-danger">Cancelados</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="triafy-box">
        <h3><i class="bi bi-box2-fill"></i> Meus pedidos</h3>
        <hr>
        <div class="container-fluid pedidos-lista">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex mt-3 mb-3">
                    <button id="reload-pedidos" class="btn btn-sm btn-outline-light">
                         <i class="bi bi-arrow-clockwise"> Atualizar</i>
                    </button>
                </div>
                <div class="d-flex mt-3 mb-3">
                    <label class="me-2">Mostrar:</label>
                    <select id="qtd-pedidos" class="form-select form-select-sm w-auto me-3">
                        <option value="10">10 itens</option>
                        <option value="20">20 itens</option>
                        <option value="30">30 itens</option>
                    </select>
                    <input id="filtro-pedidos" type="text" class="form-control" placeholder="Buscar por cliente, canal, data...">
                </div>
            </div>


            <div id="conteudo-pedidos">
                @include('partials.pedidos-lista', ['pedidos' => $pedidos])
            </div>
        </div>
    </div>
</div>