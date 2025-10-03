@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-md-12">
    <div class="triafy-box">
        <h2><i class="bi bi-bag-plus"></i> Adicionar Produto</h2>
        <hr>
        <form id="form-produto" action="{{ route('produtos.store') }}" method="post" enctype="multipart/form-data" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label text-light">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control bg-dark text-white border-secondary" placeholder="Digite o nome do produto" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label">Categoria:</label>
                    <input type="text" id="categoria" name="categoria" class="form-control bg-dark text-white border-secondary" placeholder="Ex: Eletrônicos" required>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-6 mb-3">
                    <label for="sku" class="form-label text-light">SKU:</label>
                    <div class="input-group">
                        <input type="text" id="sku" name="sku" class="form-control bg-dark text-white border-secondary" placeholder="Ex: 123ABC" required>
                        <button type="button" class="btn btn-outline-light" id="gerar-sku">Gerar</button>
                    </div>
                </div> -->
                <div class="col-md-6 mb-3">
                    <label for="quantidade" class="form-label text-light">Estoque:</label>
                    <input type="number" id="quantidade" name="quantidade" class="form-control bg-dark text-white border-secondary" placeholder="Ex: 10" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="valor" class="form-label text-light">Custo:</label>
                    <input type="text" id="valor" name="valor" class="form-control bg-dark text-white border-secondary" placeholder="Ex: 199.90" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="foto" class="form-label text-light">Foto(s):</label>
                    <input type="file" id="foto" name="fotos[]" class="form-control bg-dark text-white border-secondary" multiple>
                </div>
                
            </div>
            <div class="mb-3">
                <label class="form-label text-light">Especificações Técnicas:</label>
                <div id="especificacoes-container"></div>
                <button type="button" class="btn btn-sm btn-outline-light mt-2" onclick="addEspecificacao()">
                    <i class="bi bi-plus"></i> Adicionar Especificação
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descricao" class="form-label text-light">Descrição:</label>
                    <textarea id="descricao" name="descricao" class="form-control bg-dark text-white border-secondary" placeholder="Escreva uma descrição breve"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Salvar Produto
                </button>
            </div>
        </form>
    </div>
</div>