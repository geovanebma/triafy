document.addEventListener("DOMContentLoaded", function () {
    if (!document.getElementById("tabela-margem")) return;

    const tabela = document.getElementById("tabela-margem").getElementsByTagName("tbody")[0];
    const filtro = document.getElementById("filtro");
    const qtd = document.getElementById("qtd");

    let linhas = Array.from(tabela.rows);

    function atualizarTabela() {
        const termo = filtro.value.toLowerCase();
        const limite = parseInt(qtd.value);
        let count = 0;

        linhas.forEach(linha => {
            let texto = linha.innerText.toLowerCase();

            if (texto.includes(termo) && count < limite) {
                linha.style.display = "";
                count++;
            } else {
                linha.style.display = "none";
            }
        });
    }

    filtro.addEventListener("keyup", atualizarTabela);
    qtd.addEventListener("change", atualizarTabela);

    atualizarTabela();
});
