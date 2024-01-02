const sidebarToggle = document.querySelector("#sidebar-toggle");

sidebarToggle.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

function highlightItem(element) {
    const sidebarItems = document.querySelectorAll('.sidebar-link');
    sidebarItems.forEach(item => item.classList.remove('active'));
    element.classList.add('active');
}


function exibirDetalhesUsuario(user, telefones) {

    //var usuarioAtribuicao = atividade.Usuario[i].roles;

    console.log(user);


    var rolesNames = user.roles.map(function(role) {
        return role.name;
    });

    console.log(telefones);
    const telefoneUser = {
        telefone1: telefones[0] ? telefones[0].telefone : 'Nenhum telefone',
        telefone2: telefones[1] ? telefones[1].telefone : 'Nenhum telefone',
        telefone3: telefones[2] ? telefones[2].telefone : 'Nenhum telefone',
    };

    document.querySelector('input[name="name"]').value = user.name;
    document.querySelector('input[name="lastName"]').value = user.lastName;
    document.querySelector('input[name="atribuicao"]').value = rolesNames;
    document.querySelector('input[name="email"]').value = user.email;
    document.querySelector('input[name="genero"]').value = user.genero;
    document.querySelector('input[name="cep"]').value = user.cep;
    document.querySelector('input[name="cidade"]').value = user.cidade;
    document.querySelector('input[name="estado"]').value = user.estado;
    document.querySelector('input[name="pais"]').value = user.pais;
    document.querySelector('input[name="cpf"]').value = user.cpf;

    // Preencha os campos de telefone conforme necessário
    console.log(telefoneUser.telefone1);
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


