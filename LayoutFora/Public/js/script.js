const sidebarToggle = document.querySelector("#sidebar-toggle");

sidebarToggle.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

function highlightItem(element) {
    const sidebarItems = document.querySelectorAll('.sidebar-link');
    sidebarItems.forEach(item => item.classList.remove('active'));
    element.classList.add('active');
}


/*
const openModalButtons = document.querySelectorAll('.btn-open-modal');

    openModalButtons.forEach(button => {
        button.addEventListener('click', function() {

        const userId = this.getAttribute('data-user-id');

        // Chame a função interna para buscar os detalhes do usuário pelo ID
        const userDetails = buscarDetalhesUsuario(userId);

        // Verifica se os detalhes do usuário foram encontrados
        if (userDetails) {
            // Atualiza o conteúdo do modal com os detalhes do usuário
            document.getElementById('visualizarModalLabel').innerHTML = `Detalhes de ${userDetails.nome}`;
            document.getElementById('nome').value = userDetails.nome;
            document.getElementById('email').value = userDetails.email;
            // Atualize outros campos conforme necessário

            // Exibe o modal
            const myModal = new bootstrap.Modal(document.getElementById('visualizarModal'));
            myModal.show();
        } else {
            console.error('Detalhes do usuário não encontrados.');
        }


        });
    });



    function buscarDetalhesUsuario(userId) {

        fetch(`/api/usuarios/${userId}`) // Substitua isso pela rota correta do seu back-end
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar os detalhes do usuário');
            }
            return response.json();
        })
        .then(userDetails => {
            // Atualizar o modal com os detalhes do usuário obtidos da resposta do servidor
            document.getElementById('visualizarModalLabel').innerHTML = `Detalhes de ${userDetails.nome}`;
            document.getElementById('nome').value = userDetails.nome;
            document.getElementById('email').value = userDetails.email;
            // Atualize outros campos conforme necessário

            // Exibir o modal
            const myModal = new bootstrap.Modal(document.getElementById('visualizarModal'));
            myModal.show();
        })
        .catch(error => {
            console.error('Erro ao buscar os detalhes do usuário:', error.message);
        });
    }
*/


function exibirDetalhesUsuario(user, role, telefones) {

    const telefoneUser = {
        telefone1: telefones[0] ? telefones[0].telefone : 'Nenhum telefone',
        telefone2: telefones[1] ? telefones[1].telefone : 'Nenhum telefone',
        telefone3: telefones[2] ? telefones[2].telefone : 'Nenhum telefone',
    };

    document.querySelector('input[name="name"]').value = user.name;
    document.querySelector('input[name="lastName"]').value = user.lastName;
    document.querySelector('input[name="atribuicao"]').value = role;
    document.querySelector('input[name="email"]').value = user.email;
    document.querySelector('input[name="genero"]').value = user.genero;
    document.querySelector('input[name="cep"]').value = user.cep;
    document.querySelector('input[name="cidade"]').value = user.cidade;
    document.querySelector('input[name="estado"]').value = user.estado;
    document.querySelector('input[name="pais"]').value = user.pais;
    document.querySelector('input[name="cpf"]').value = user.cpf;

    // Preencha os campos de telefone conforme necessário
    document.querySelector('input[name="telefone1"]').value = telefoneUser.telefone1;
    document.querySelector('input[name="telefone2"]').value = telefoneUser.telefone2;
    document.querySelector('input[name="telefone3"]').value = telefoneUser.telefone3;

    const form = document.getElementById('usuarioForm');
    const rotaAtualizacao = `/usuario/atualizar/${user.idUsuario}`;
    form.action = rotaAtualizacao;


    const h5 = document.getElementById('visualizarModalLabel');
    h5.textContent = user.name;

    const myModal = new bootstrap.Modal(document.getElementById('visualizarModal'));
    myModal.show();

}


