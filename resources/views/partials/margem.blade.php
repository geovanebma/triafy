<div class="triafy-box">
    <h2>Margem de Contribuição</h2>
    <hr>
    <div class="filtros">
        <label for="qtd">Mostrar:</label>
        <select id="qtd">
            <option value="2">2</option>
            <option value="5">5</option>
            <option value="10">10</option>
        </select>

        <input type="text" id="filtro" placeholder="Buscar produto...">
    </div>
    <table border="1" cellspacing="0" cellpadding="5" width="100%" id="tabela-margem"
        class="table table-striped table-bordered table-dark">
        <thead>
            <tr>
                <th class="text-center">Anúncio</th>
                <th class="text-center">Quantidade</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Preço Médio</th>
                <th class="text-center">Custo Unitário</th>
                <th class="text-center">Custo</th>
                <th class="text-center">Tarifa</th>
                <th class="text-center">Frete</th>
                <th class="text-center">Ads</th>
                <th class="text-center">Imposto</th>
                <th class="text-center">Margem</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>
                        <!-- <img src="{{ asset($produto->foto) }}" alt="foto" width="40" height="40"><br> -->
                        @if($produto->foto)
                            <img src="data:image/png;base64,{{ $produto->foto }}" alt="foto" width="40" height="40">
                        @else
                            <span>Sem foto</span>
                        @endif
                        <strong>{{ $produto->nome }}</strong><br>
                        <small>{{ $produto->descricao }}</small>
                    </td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->preco_medio, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->custo_unitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->custo, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->tarifa, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->frete, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->ads, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->imposto, 2, ',', '.') }}</td>
                    <td>
                        @if($produto->margem < 0)
                            <span style="color: red;">
                                R$ {{ number_format($produto->margem, 2, ',', '.') }}
                            </span>
                        @else
                            <span style="color: green;">
                                R$ {{ number_format($produto->margem, 2, ',', '.') }}
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>