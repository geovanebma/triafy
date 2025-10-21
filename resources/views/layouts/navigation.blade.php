<link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<nav x-data="{ open: false }" class="">
    <nav class="" id="menu-nav">
        <div class="row w-100">
            <div class="col-7 col-sm-7 col-md-5 col-xs-5">
                <a href="{{ url('/inicio') }}" class="pe-auto">
                    <img id="logo-principal" aaa="1" class="pe-auto logo_width" src="{{ asset('logo.jpeg') }}" alt="">
                </a>
                <i id="menuToggle" class="bi bi-list icons_width float-end"></i>
            </div>
            <div class="col-5 col-sm-5 col-md-7 col-xs-7">
                <div id="botoes-div" class="d-inline">
                    <div class="float-end">
                        <i class="bi bi-bell-fill butons_icons icons_width m-10" title="Notificações"></i>
                        <i class="bi bi-person-fill-gear butons_icons icons_width m-10" title="Editar Perfil"></i>
                        <i class="bi bi-box-arrow-right pe-auto butons_icons icons_width float-end" id="logout" title="Sair" onclick="event.preventDefault(); document.getElementById('form_logout').submit();"></i>

                        <form method="POST" class="d-inline m-10" id="form_logout" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</nav>
<div id="sidebar" class="sidebar active" style="transform: translateX(0px); transition: transform 0.3s ease-in-out;">
    <ul class="sidebar-menu">
        <li class="text-center">
            <i class="bi bi-person-bounding-box pe-auto" id="perfil" title="Perfil"></i>
            <br>
            <span>{{ Auth::user()->name }}</span>
            <span class="d-inline">{{ Auth::user()->email }}</span>
        </li>
        <br>
        <li>
            <a href="/inicio"><i class="bi bi-layout-text-window-reverse"></i> Resumo</a>
        </li>
        <li class="has-submenu open">
            <a href="#"><i class="bi bi-dropbox"></i> Catálogo</a>
            <ul class="submenu">
                <li><a data-url="{{ route('produtos.index') }}"><i class="bi bi-grid-fill"></i> Catálogo de produtos</a>
                </li>
                <li>
                    <a href="#" data-url="{{ route('produtos.create') }}" class="menu-link">
                        <i class="bi bi-bag-plus"></i> Adicionar produto
                    </a>
                </li>
            </ul>
        </li>
        <li class="has-submenu open">
            <a href="#"><i class="bi bi-box-seam"></i> Pedidos</a>
            <ul class="submenu">
                <li>
                    <a href="#" data-url="{{ route('pedidos.listar', ['tipo' => 'meus']) }}" class="menu-link">
                        <i class="bi bi-box2-fill"></i> Meus pedidos
                    </a>
                </li>
                <li>
                    <a data-url="{{ route('pedidos.listar', ['tipo' => 'todos']) }}" class="menu-link">
                        <i class="bi bi-boxes"></i> Todos os pedidos
                    </a>
                </li>
                <li>
                    <a data-url="{{ route('pedidos.inserir') }}">
                        <i class="bi bi-plus"></i> Novo pedido
                    </a>
                </li>

            </ul>
        </li>
        <li class="has-submenu open">
            <a href="{{ route('parceiros.index') }}"><i class="bi bi-people"></i> Parceiros</a>
            <ul class="submenu">
                <li><a href="#" data-url="{{ route('vendedores.listar') }}" class="menu-link"><i class="bi bi-people"></i> Vendedores</a></li>
                <li><a href="#" data-url="{{ route('fornecedores.listar') }}" class="menu-link"><i class="bi bi-person-vcard"></i> Fornecedores</a></li>
            </ul>
        </li>
        <li class="has-submenu open">
            <a href="{{ route('parceiros.index') }}">Minhas estatísticas</a>
            <ul class="submenu">
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-graph-up"></i> Relatórios de vendas</a></li>
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-file-earmark-bar-graph-fill"></i> Relatórios financeiros</a></li>
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-file-earmark-bar-graph-fill"></i> Relatórios gerais (ranking)</a></li>
            </ul>
        </li>
        <li class="has-submenu open">
            <a href="#"><i class="bi bi-arrows-angle-contract"></i> Integrações</a>
            <ul class="submenu">
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-arrows-collapse-vertical"></i> Bling</a>
                </li>
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-arrows-collapse-vertical"></i> Shoppee</a>
                </li>
            </ul>
        </li>
        <li class="has-submenu open">
            <a href="#"><i class="bi bi-gear"></i> Configurações</a>
            <ul class="submenu">
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-person-gear"></i> Perfil</a></li>
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-people"></i> Usuários</a></li>
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-tools"></i> Integrações</a></li>
                <li><a href="{{ route('produtos.index') }}"><i class="bi bi-tools"></i> Manutenção</a></li>
            </ul>
        </li>
    </ul>
</div>
<div id="conteudo" style="color: white;"></div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("menuToggle");
        const sidebar = document.getElementById("sidebar");

        menuToggle.addEventListener("click", () => {
            if (sidebar.style.transform === "translateX(0px)") {
                sidebar.style.transform = "translateX(-100%)";
            } else {
                sidebar.style.transform = "translateX(0)";
            }
            sidebar.style.transition = "transform 0.3s ease-in-out";
        });

        function inicializarLinksAjax() {
            document.querySelectorAll("a[data-url]").forEach(link => {
                link.addEventListener("click", function (e) {
                    e.preventDefault();

                    const url = this.getAttribute("data-url");
                    fetch(url)
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById("conteudo").innerHTML = html;
                            inicializarLinksAjax();
                        })
                        .catch(err => console.error("Erro ao carregar página:", err));
                });
            });
        }

        document.addEventListener("DOMContentLoaded", inicializarLinksAjax);

        const menuPais = document.querySelectorAll(".has-submenu > a");

        menuPais.forEach(menu => {
            menu.addEventListener("click", function (e) {
                e.preventDefault();
                const li = this.parentElement;

                li.classList.toggle("open");
            });
        });

        const submenuLinks = document.querySelectorAll(".submenu li a");

        submenuLinks.forEach(link => {
            link.addEventListener("click", (e) => {
                e.preventDefault();

                submenuLinks.forEach(l => l.classList.remove("ativo"));
                link.classList.add("ativo");

                if (link.dataset.url) {
                    fetch(link.dataset.url)
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById("conteudo").innerHTML = html;
                        });
                }
            });
        });

        const ultimaPartial = localStorage.getItem("ultimaPartial");

        if (ultimaPartial) {
            fetch(ultimaPartial)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("conteudo").innerHTML = html;
                    if (ultimaPartial.includes('/produtos/')) {
                        inicializarShowProdutoJS();
                    } else if (ultimaPartial.includes('/produtos')) {
                        inicializarProdutosJS();
                    } else if (ultimaPartial.includes('/pedidos')) {
                        var tipo = (ultimaPartial.includes('tipo=meus')) ? 'meus' : 'todos';
                        inicializarPedidosJS(tipo);
                    }
                });

            document.querySelectorAll("a.menu-link").forEach(link => {
                if (link.dataset.url === ultimaPartial) {
                    link.classList.add("ativo");
                } else {
                    link.classList.remove("ativo");
                }
            });
        }
    });

    function inicializarPedidosJS(tipo) {
        const conteudoPedidos = document.getElementById("conteudo-pedidos");
        const reloadBtn = document.getElementById("reload-pedidos");
        const qtdSelect = document.getElementById("qtd-pedidos");
        const filtroInput = document.getElementById("filtro-pedidos");

        if (!conteudoPedidos) return;

        function carregarPedidos() {
            let qtd = qtdSelect.value;
            let busca = filtroInput.value;

            fetch(`/pedidos/filtro?qtd=${qtd}&busca=${encodeURIComponent(busca)}&tipo=${tipo}`)
                .then(res => res.text())
                .then(html => {
                    conteudoPedidos.innerHTML = html;
                });
        }

        reloadBtn.addEventListener("click", carregarPedidos);
        qtdSelect.addEventListener("change", carregarPedidos);
        filtroInput.addEventListener("keyup", carregarPedidos);

        carregarPedidos();
    }

    function lerFiltros() {
        const qtdSelect = document.getElementById('qtd-produtos');
        const filtroInput = document.getElementById('filtro-produtos');

        return {
            qtd: (qtdSelect && qtdSelect.value) || 20,
            busca: (filtroInput && filtroInput.value) || '',
            categoria: document.getElementById('filtro-categoria') ? document.getElementById('filtro-categoria').value : '',
            ordenar: document.getElementById('filtro-ordenar') ? document.getElementById('filtro-ordenar').value : '',
            preco_min: document.getElementById('filtro-preco-min') ? document.getElementById('filtro-preco-min').value : '',
            preco_max: document.getElementById('filtro-preco-max') ? document.getElementById('filtro-preco-max').value : '',
        };
    }

    async function carregarProdutos(opts = {}) {
        const filtros = Object.assign(lerFiltros(), opts);
        const url = montarUrl(filtros);
        const container = document.getElementById('conteudo-produtos');

        try {
            const res = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await res.text();
            container.innerHTML = html;

            ativarDelegacaoPaginacao();

        } catch (err) {
            console.error('Erro ao carregar produtos:', err);
        }
    }

    function montarUrl(params = {}) {
        const p = new URLSearchParams();
        if (params.qtd) p.set('qtd', params.qtd);
        if (params.busca) p.set('busca', params.busca);
        if (params.categoria) p.set('categoria', params.categoria);
        if (params.ordenar) p.set('ordenar', params.ordenar);
        if (params.preco_min) p.set('preco_min', params.preco_min);
        if (params.preco_max) p.set('preco_max', params.preco_max);
        if (params.page) p.set('page', params.page);
        return `/produtos?${p.toString()}`;
    }

    function ativarDelegacaoPaginacao() {
        const container = document.getElementById('conteudo-produtos');

        container.querySelectorAll('.pagination a').forEach(a => {
            a.addEventListener('click', function (e) {
                e.preventDefault();

                const href = this.getAttribute('href') || '';
                const url = new URL(href, window.location.origin);
                const page = url.searchParams.get('page');

                if (page) {
                    carregarProdutos({ page });
                    container.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    }

    function inicializarProdutosJS() {
        const container = document.getElementById('conteudo-produtos');
        const qtdSelect = document.getElementById('qtd-produtos');
        const filtroInput = document.getElementById('filtro-produtos');
        const reloadBtn = document.getElementById('reload-produtos');
        const exportBtn = document.getElementById('exportar-produtos');
        const abrirFiltroBtn = document.getElementById('abrir-filtro-produtos');

        if (!container) return;

        function debounce(fn, delay = 300) {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), delay);
            };
        }

        const debouncedCarregar = debounce(() => carregarProdutos(), 300);

        if (qtdSelect) {
            qtdSelect.addEventListener('change', () => carregarProdutos());
        }
        if (filtroInput) {
            filtroInput.addEventListener('keyup', debouncedCarregar);
        }
        if (reloadBtn) {
            reloadBtn.addEventListener('click', () => carregarProdutos());
        }

        if (exportBtn) {
            exportBtn.addEventListener('click', () => {
                const filtros = lerFiltros();
                const url = new URL('/produtos/exportar', window.location.origin);
                if (filtros.qtd) url.searchParams.set('qtd', filtros.qtd);
                if (filtros.busca) url.searchParams.set('busca', filtros.busca);
                if (filtros.categoria) url.searchParams.set('categoria', filtros.categoria);
                if (filtros.ordenar) url.searchParams.set('ordenar', filtros.ordenar);
                if (filtros.preco_min) url.searchParams.set('preco_min', filtros.preco_min);
                if (filtros.preco_max) url.searchParams.set('preco_max', filtros.preco_max);
                window.location = url.toString();
            });
        }

        document.getElementById("conteudo").addEventListener("click", function (e) {
            if (e.target && e.target.matches("a[data-url]")) {
                e.preventDefault();
                const url = e.target.getAttribute("data-url");

                localStorage.setItem("ultimaPartial", url);

                fetch(url)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById("conteudo").innerHTML = html;
                        if (url.includes('/produtos/')) {
                            inicializarShowProdutoJS();
                        } else if (url.includes('/produtos')) {
                            inicializarProdutosJS();
                        } else if (url.includes('/pedidos')) {
                            inicializarPedidosJS();
                        }
                    });
            }
        })

        if (abrirFiltroBtn) {
            abrirFiltroBtn.addEventListener('click', () => {
                Swal.fire({
                    title: 'Filtrar produtos',
                    html: `
                    <div class="mb-2 text-start">
                        <label>Categoria</label>
                        <select id="filtro-categoria" class="form-select"></select>
                    </div>
                    <div class="mb-2 text-start">
                        <label>Ordenar</label>
                        <select id="filtro-ordenar" class="form-select">
                            <option value="created_at">Mais recentes</option>
                            <option value="preco_asc">Preço (menor)</option>
                            <option value="preco_desc">Preço (maior)</option>
                        </select>
                    </div>
                    <div class="mb-2 text-start">
                        <label>Preço de</label>
                        <input id="filtro-preco-min" type="number" class="form-control" placeholder="Ex.: 19.40">
                    </div>
                    <div class="mb-2 text-start">
                        <label>Preço até</label>
                        <input id="filtro-preco-max" type="number" class="form-control" placeholder="Ex.: 1500">
                    </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'Aplicar'
                }).then(result => {
                    if (result.isConfirmed) {
                        carregarProdutos({
                            categoria: document.getElementById('filtro-categoria').value,
                            ordenar: document.getElementById('filtro-ordenar').value,
                            preco_min: document.getElementById('filtro-preco-min').value,
                            preco_max: document.getElementById('filtro-preco-max').value
                        });
                    }
                });

                const categoriasFromPage = document.querySelectorAll('#_categorias_lista option');
                if (categoriasFromPage.length) {
                    setTimeout(() => {
                        const select = document.getElementById('filtro-categoria');
                        categoriasFromPage.forEach(opt => {
                            const newOpt = document.createElement('option');
                            newOpt.value = opt.value;
                            newOpt.text = opt.text;
                            select.appendChild(newOpt);
                        });
                    }, 50);
                }

            });
        }

        carregarProdutos();
    }

    function addEspecificacao(chave = '', valor = '') {
        const container = document.getElementById("especificacoes-container");

        const div = document.createElement("div");
        div.classList.add("row", "mb-2", "align-items-center");

        div.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="especificacoes[chave][]" 
                    class="form-control bg-dark text-white border-secondary" placeholder="Ex: Cor" value="${chave}" required>
            </div>
            <div class="col-md-5">
                <input type="text" name="especificacoes[valor][]" 
                    class="form-control bg-dark text-white border-secondary" placeholder="Ex: Azul" value="${valor}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger" 
                    onclick="this.parentElement.parentElement.remove()">
                    <i class="bi bi-dash"></i>
                </button>
            </div>
        `;

        container.appendChild(div);
    }

    const conteudo = document.getElementById("conteudo");

    conteudo.addEventListener("submit", function (e) {
        if (e.target && e.target.id === "form-produto") {
            e.preventDefault();

            let form = e.target;
            let formData = new FormData(form);

            let nome = formData.get("nome").trim();
            // let sku = formData.get("sku").trim();
            let valor = formData.get("valor").trim();
            let quantidade = formData.get("quantidade").trim();

            if (!nome) return Swal.fire("Atenção", "O campo Nome é obrigatório!", "warning");

            if (!valor || isNaN(valor) || parseFloat(valor) <= 0)
                return Swal.fire("Atenção", "Informe um valor válido!", "warning");
            if (!quantidade || isNaN(quantidade) || parseInt(quantidade) < 0)
                return Swal.fire("Atenção", "Informe uma quantidade válida!", "warning");

            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.errors) {
                        let erros = Object.values(data.errors).flat().join("<br>");
                        Swal.fire("Erro", erros, "error");
                    } else if (data.success) {
                        Swal.fire({
                            title: "Sucesso!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "Ok"
                        }).then(() => {
                            let ultimaPartial = localStorage.getItem("ultimaPartial");

                            if (ultimaPartial) {
                                fetch(ultimaPartial)
                                    .then(res => res.text())
                                    .then(html => {
                                        conteudo.innerHTML = html;
                                    });
                            }
                        });
                    }
                })
                .catch(err => {
                    Swal.fire("Erro", "Erro inesperado no servidor!", "error");
                    console.error(err);
                });
        }
    });

    document.addEventListener("click", function (e) {
        if (e.target && e.target.id === "gerar-sku") {
            const nome = document.getElementById("nome").value;

            if (nome) {
                fetch(`/produtos/gerar-sku?nome=${encodeURIComponent(nome)}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById("sku").value = data.sku;
                        Swal.fire("SKU Gerado", `O SKU <b>${data.sku}</b> foi criado com sucesso!`, "success");
                    })
                    .catch(err => {
                        Swal.fire("Erro", "Não foi possível gerar o SKU.", "error");
                        console.error(err);
                    });
            } else {
                Swal.fire("Atenção", "Informe o nome do produto antes!", "warning");
            }
        }

        // document.addEventListener("click", function (e) {
        //     const link = e.target.closest("a[ver-prod], a[data-url]");
        //     if (!link) return; // clicou em algo que não é link -> ignora

        //     e.preventDefault();
        //     const url = link.getAttribute("ver-prod") || link.getAttribute("data-url");

        //     if (!url) return;

        //     fetch(url)
        //         .then(res => res.text())
        //         .then(html => {
        //             document.getElementById("conteudo").innerHTML = html;
        //             // não perde os eventos, pois o listener é global
        //         });
        // });

        const exportBtn = document.getElementById("exportar-produtos");
        if (exportBtn) {
            exportBtn.addEventListener("click", () => {
                window.location.href = "/produtos/exportar";
            });
        }
    });

    // document.querySelectorAll("a[data-url]").forEach(link => {
    //     link.addEventListener("click", function (e) {
    //         e.preventDefault();
    //         const url = this.getAttribute("data-url");

    //         localStorage.setItem("ultimaPartial", url);

    //         fetch(url)
    //             .then(res => res.text())
    //             .then(html => {
    //                 document.getElementById("conteudo").innerHTML = html;
    //                 if (url.includes('/produtos')) {
    //                     inicializarProdutosJS();
    //                 } else if (url.includes('/pedidos')) {
    //                     inicializarPedidosJS();
    //                 }
    //             });
    //     });
    // });

    function inicializarShowProdutoJS() {
        const thumbs = document.querySelectorAll('.thumb');
        const mainImg = document.getElementById('slider-main-img');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        let currentIndex = 0;

        if (!thumbs.length || !mainImg) return;

        function updateMainImage(index) {
            const selected = thumbs[index];
            mainImg.src = selected.src;
            thumbs.forEach(t => t.classList.remove('active'));
            selected.classList.add('active');
            currentIndex = index;
        }

        thumbs.forEach((thumb, index) => {
            thumb.addEventListener('click', () => updateMainImage(index));
        });

        prevBtn.addEventListener('click', () => {
            const newIndex = (currentIndex - 1 + thumbs.length) % thumbs.length;
            updateMainImage(newIndex);
        });

        nextBtn.addEventListener('click', () => {
            const newIndex = (currentIndex + 1) % thumbs.length;
            updateMainImage(newIndex);
        });

        thumbs[0]?.classList.add('active');
    }

    document.addEventListener("click", function (e) {
        const link = e.target.closest("a[ver-prod], a[data-url]");
        if (!link) return; // clicou em algo que não é link -> ignora

        e.preventDefault();
        const url = link.getAttribute("ver-prod") || link.getAttribute("data-url");

        localStorage.setItem("ultimaPartial", url);

        if (!url) return;

        fetch(url)
            .then(res => res.text())
            .then(html => {
                document.getElementById("conteudo").innerHTML = html;

                if (url.includes('/produtos/')) {
                    inicializarShowProdutoJS();
                } else if (url.includes('/produtos')) {
                    inicializarProdutosJS();
                } else if (url.includes('/pedidos')) {
                    var tipo = (url.includes('tipo=meus')) ? 'meus' : 'todos';
                    inicializarPedidosJS(tipo);
                }
            });
    });
</script>
<link rel="stylesheet" href="{{ asset('js/margem.js') }}">