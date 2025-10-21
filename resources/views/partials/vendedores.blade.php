<div class="triafy-box">
    <h4>Vendedores</h4>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendedores as $vendedor)
            <tr>
                <td>{{ $vendedor->id }}</td>
                <td>{{ $vendedor->name }}</td>
                <td>{{ $vendedor->email }}</td>
                <td>{{ $vendedor->telefone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>