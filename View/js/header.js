class Header extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <header>
                <h2 id="header-title">Biblioteca Online</h2>
                <nav>
                    <a href="/pweb1-Biblioteca/View/livro/pagina_livro.html">Livros</a>
                    <a href="/pweb1-Biblioteca/View/autor/pagina_autor.html">Autores</a>
                    <a href="/pweb1-Biblioteca/View/estudante/pagina_estudante.html">Estudantes</a>
                    <a href="/pweb1-Biblioteca/View/emprestimo/pagina_emprestimo.html">Empréstimos</a>
                </nav>
            </header>
        `;

        // Foi o chat q fez não sei mexer em HTML
        const headerTitle = this.querySelector("#header-title");
        headerTitle.style.cursor = "pointer";
        headerTitle.addEventListener("click", () => {
            window.location.href = "/pweb1-Biblioteca/index.html";
        });
    }
}

customElements.define('main-header', Header);
