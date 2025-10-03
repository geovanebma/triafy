<link rel="stylesheet" href="{{ asset('css/produtos.css') }}">
<div id="" class="catalogo-container p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="">Catálogo de Produtos</h3>
        <button id="reload-produtos" class="btn ms-2"><i class="bi bi-arrow-clockwise"></i> Recarregar</button>
    </div>

    <!-- Filtros -->
    <div class="d-flex mb-3">
        <select id="qtd-produtos" class="form-select w-auto bg-dark text-white">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20" selected>20</option>
            <option value="50">50</option>
        </select>

        <input type="text" id="filtro-produtos" class="form-control bg-dark text-white border-secondary"
            placeholder="Digite o nome, SKU ou categoria...">
        <button id="abrir-filtro-produtos" class="btn ms-2"><i class="bi bi-sliders2-vertical"></i> Filtrar</button>
        <button id="exportar-produtos" class="btn ms-2"><i class="bi bi-file-earmark-arrow-down-fill"></i>
            Exportar</button>
    </div>

    {{-- Container só dos cards --}}
    <div id="conteudo-produtos">
        @include('partials.produtos-lista-content', ['produtos' => $produtos])
    </div>
    <select id="_categorias_lista" hidden>
        <option value="">Todas</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria }}">{{ $categoria }}</option>
        @endforeach
    </select>
</div>
<!-- <div id="conteudo-produtos">
    @include('partials.produtos-lista-content', ['produtos' => $produtos])
</div> -->
<script>
    Swal.fire({
        title: "Filtrar Produtos",
        html: `
            <div class="mb-2">
                <label>Categoria</label>
                <select id="filtro-categoria" class="form-select">
                    <option value="">Todas</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label>Ordenar por</label>
                <select id="filtro-ordenar" class="form-select">
                    <option value="created_at">Mais recentes</option>
                    <option value="preco_asc">Preço (menor)</option>
                    <option value="preco_desc">Preço (maior)</option>
                </select>
            </div>
            <div class="mb-2">
                <label>Preço de</label>
                <input type="number" id="filtro-preco-min" class="form-control">
            </div>
            <div class="mb-2">
                <label>Preço até</label>
                <input type="number" id="filtro-preco-max" class="form-control">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: "Aplicar"
    }).then(result => {
        if (result.isConfirmed) {
            carregarProdutos({
                categoria: document.getElementById("filtro-categoria").value,
                ordenar: document.getElementById("filtro-ordenar").value,
                preco_min: document.getElementById("filtro-preco-min").value,
                preco_max: document.getElementById("filtro-preco-max").value
            });
        }
    });
</script>