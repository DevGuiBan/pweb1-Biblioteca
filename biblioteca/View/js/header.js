class Header extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <header>
                <h2 id="header-title">Biblioteca Online</h2>
                <nav>
                    <a href="/Library/pweb1-Biblioteca/biblioteca/View/livro/pagina_livro.html">Livros</a>
                    <a href="/Library/pweb1-Biblioteca/biblioteca/View/autor/pagina_autor.html">Autores</a>
                    <a href="/Library/pweb1-Biblioteca/biblioteca/View/estudante/pagina_estudante.html">Estudantes</a>
                    <a href="/Library/pweb1-Biblioteca/biblioteca/View/emprestimo/pagina_emprestimo.html">Empréstimos</a>
                </nav>
            </header>
        `;

        // Foi o chat q fez não sei mexer em HTML
        const headerTitle = this.querySelector("#header-title");
        headerTitle.style.cursor = "pointer";
        headerTitle.addEventListener("click", () => {
            window.location.href = "/Library/pweb1-Biblioteca/biblioteca/View/index_pagina_principal.html";
        });
    }
}

customElements.define('main-header', Header);
