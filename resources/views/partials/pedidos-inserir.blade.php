<div class="card p-4">
    <h4>Novo Pedido</h4>

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cliente" >Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="produto" >Produto</label>
            <input type="text" name="produto" id="produto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="quantidade" >Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="valor_total" >Valor total</label>
            <input type="number" name="valor_total" id="valor_total" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="status" >Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Aguardando Pagamento">Aguardando Pagamento</option>
                <option value="Processando pagamento">Processando pagamento</option>
                <option value="Enviado">Enviado</option>
                <option value="Com Pendências">Com Pendências</option>
                <option value="Reembolsado">Reembolsado</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Pedido</button>
    </form>
</div>
