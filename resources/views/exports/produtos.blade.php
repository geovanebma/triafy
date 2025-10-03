<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>SKU</th>
            <th>Categoria</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
        <tr>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->sku }}</td>
            <td>{{ $produto->categoria }}</td>
            <td>{{ number_format($produto->valor, 2, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
