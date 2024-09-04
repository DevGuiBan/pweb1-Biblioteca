class Footer extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <footer>
                <p><strong>PWEB I - IFCE campus Cedro, CE</strong></p>
                <p>Guilherme Bandeira Dias (Banco de Dados)</p>
                <p>Nickolas Davi Vieira Lima (Front-End)</p>
                <p>Raimundo Gabriel Pereira Ferreira (Back-End)</p>
                <p>&copy; Alguns direitos reservados.</p>
            </footer>
        `;
    }
}

customElements.define('main-footer', Footer);