<div class="triafy-box">

    <h4>Fornecedores</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Fornecedor</th>
                <th>Categoria</th>
                <th>Total de Produtos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->canal_venda }}</td>
                <td>{{ $fornecedor->canal_venda_categoria }}</td>
                <td>{{ $fornecedor->total_quantidade }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>