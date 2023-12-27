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

//formatar cep
Inputmask("99999-999").mask(".cep");
//formatar cpf
Inputmask("999.999.999-99").mask("#cpf");
//formatar telefone fixo
Inputmask("(99)9999-9999").mask(".telefoneFixo");
//formatar telefone Movel
Inputmask("(99)99999-9999").mask(".telefoneMovel");
//formtar telefone reserva


// Função para buscar o CEP
function buscarCEP() {

    // chave: gea7Akb2TT2gK7liOo1Dy0TQKz7ieMGr8TddW5PY03jsqDEjlCCOviXPy0LXSDen

    let cep = document.getElementById('cep').value; // Remover espaços em branco
    cep = cep.replace(/_/g, ''); // Remover apenas os traços

    console.log(cep);
    if (cep.length === 9) {
        const url = `https://brasilaberto.com/api/v1/zipcode/${cep}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('CEP não encontrado ou inválido.');
                }
                return response.json();
            })
            .then(data => {
                const result = data.result;
                document.getElementById('cidade').value = result.city;
                document.getElementById('uf').value = result.stateShortname;
            })
            .catch(error => {
                console.error('Erro ao buscar o CEP:', error);
            });
    }
}

function buscarCEPAtualizado() {

    // chave: gea7Akb2TT2gK7liOo1Dy0TQKz7ieMGr8TddW5PY03jsqDEjlCCOviXPy0LXSDen

    let cep = document.getElementById('cep2').value; // Remover espaços em branco
    cep = cep.replace(/_/g, ''); // Remover apenas os traços

    console.log(cep);
    if (cep.length === 9) {
        const url = `https://brasilaberto.com/api/v1/zipcode/${cep}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('CEP não encontrado ou inválido.');
                }
                return response.json();
            })
            .then(data => {
                const result = data.result;
                document.getElementById('cidade2').value = result.city;
                document.getElementById('uf2').value = result.stateShortname;
            })
            .catch(error => {
                console.error('Erro ao buscar o CEP:', error);
            });
    }
}


$(document).ready(function() {
    $('.filtro-alfabetico').on('click', function() {
        ordenarTabelaAlfabeticamente();
        return false; // Evita o comportamento padrão do link
    });

    function ordenarTabelaAlfabeticamente() {
        //vai selecionar a tabela
        var $table = $('#tabelaFuncionarios');
        //vai selecionar o corpo da tabela
        var $tbody = $table.find('tbody');
        // Seleciona todas as linhas (rows) da tabela e converte para um array
        var $rows = $tbody.find('tr').toArray();

           // A função sort() ordena as linhas com base em uma função de comparação
        $rows.sort(function(a, b) {
              // Obtém o texto da primeira coluna (índice 0) de cada linha e o converte para maiúsculas
            var nomeA = $(a).find('td:eq(0)').text().trim().toUpperCase();
            var nomeB = $(b).find('td:eq(0)').text().trim().toUpperCase();

             // Compara os valores para ordenar alfabeticamente
            if (nomeA < nomeB) {
                return -1;
            } else if (nomeA > nomeB) {
                return 1;
            } else {
                return 0;
            }
        });
        // Limpa o corpo da tabela e insere as linhas ordenadas
        $tbody.empty().append($rows);
    }
});

$(document).ready(function() {
    $('.filtro-alfabetico2').on('click', function() {
        ordenarTabelaAlfabeticamente();
        return false; // Evita o comportamento padrão do link
    });

    function ordenarTabelaAlfabeticamente() {
        //vai selecionar a tabela
        var $table = $('#tabelaclientes');
        //vai selecionar o corpo da tabela
        var $tbody = $table.find('tbody');
        // Seleciona todas as linhas (rows) da tabela e converte para um array
        var $rows = $tbody.find('tr').toArray();

           // A função sort() ordena as linhas com base em uma função de comparação
        $rows.sort(function(a, b) {
              // Obtém o texto da primeira coluna (índice 0) de cada linha e o converte para maiúsculas
            var nomeA = $(a).find('td:eq(0)').text().trim().toUpperCase();
            var nomeB = $(b).find('td:eq(0)').text().trim().toUpperCase();

             // Compara os valores para ordenar alfabeticamente
            if (nomeA < nomeB) {
                return -1;
            } else if (nomeA > nomeB) {
                return 1;
            } else {
                return 0;
            }
        });
        // Limpa o corpo da tabela e insere as linhas ordenadas
        $tbody.empty().append($rows);
    }
});



$(document).ready(function() {
    // ...
    $('#btnBuscar').on('click', function() {
        // Abre o minimodal para buscar o usuário
        $('#miniModalBuscar').modal('show');
    });

    $('#btnConfirmarBusca').on('click', function() {
        var termoBusca = $('#termoBusca').val().trim().toUpperCase();
        buscarUsuario(termoBusca);
        $('#miniModalBuscar').modal('hide'); // Esconde o minimodal após buscar
    });

    function buscarUsuario(termoBusca) {
        // Lógica para buscar o usuário e encontrar sua linha na tabela
        var $table = $('#tabelaFuncionarios');
        var $tbody = $table.find('tbody');
        var $rows = $tbody.find('tr').toArray();

        $rows.forEach(function(row) {
            var $row = $(row);
            var nomeUsuario = $row.find('td:eq(0)').text().trim().toUpperCase();

            if (nomeUsuario === termoBusca) {
                $tbody.prepend($row); // Coloca o usuário encontrado no topo da tabela
                $row.addClass('destacar-usuario'); // Aplica uma classe para destacar o usuário
            } else {
                $row.removeClass('destacar-usuario'); // Remove a classe de destaque dos outros usuários
            }
        });
    }
});
