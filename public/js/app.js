import './bootstrap.js';

/*
caught TypeError: Cannot read properties of null (reading 'addEventListener')
  at app.js:6:15


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

















//SCRIPTS THAUAN ( PQP LEK EU QUERO ME MATAR)//


$('.button_Assoc').on('click', function() {

  debugger;
      var atividade = JSON.parse($(this).attr('data-atividade'));


      debugger;
      $('#idAtividade').val(atividade.idAtividade);
      $('#idUsuario').val(0);
      $('#Modal_Associar_Usuario').modal('show');



});

$(document).ready(function(){
$('#Form_Assoc_User').submit(function(e){
e.preventDefault();
debugger;
var idUsuario = $('[name="idUsuario"]').val();
var idAtividade = $('[name="idAtividade"]').val();
var idobra = $('input[name="idobra"]').val();
$('#idUsuario').val()
var formData = new FormData(this);
var csrfToken = $('meta[name="csrf-token"]').attr('content');
debugger;

$.ajax({
  type: 'PUT',
  url: '/Atividade/Associar_Usuario/' + idAtividade + '/' + idUsuario  + '/' + idobra,
  data: formData,
  processData: false,
  contentType: false,
  headers: {
    'X-CSRF-TOKEN': csrfToken
  },
  success: function (response) {
    window.location.reload();
    if (response.redirect) {

      window.location.href = response.redirect;
    } else {

      console.log(response);
    }

    debugger;


  },
  error: function (error) {

    console.error('Erro ao criar o relacao no JS:', error);
  }
});



})

});




$(document).ready(function() {

  $('#FormCriarAtv').submit(function(e) {
      e.preventDefault();
      debugger;
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      var formData = new FormData(this);
      debugger;


      $.ajax({
          url: '/Atividade/Criar_Atividade',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          success: function(response) {
            window.location.reload();

              if (response.redirect) {
                window.location.href = response.redirect;
              } else {
                debugger;
                console.log(response);
              }

              debugger;
              console.log("to aqui3");
              $('#ModalCriarAtividade').modal('hide');
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);




            console.error('Erro ao criar o Atividade no JS', error, status, xhr);
          }


      });
    });
  });


  // Set the card_id when the modal is opened
  $('.create-activity').on('click', function() {
    debugger;
      var card = JSON.parse($(this).attr('data-card'));
      debugger;
      $('#card_atividades_idCard').val(card.idCard);

      $('#ModalCriarAtividade').modal('show');
  });





$(document).ready(function () {
  $('.view-coments').on('click', function () {
    var atividade = $(this).data('atividade');
    var authId = $(this).data('auth-id');
debugger;

console.log('Propriedades de Atividade:', atividade);

if (atividade && atividade.hasOwnProperty('usuarios') && Array.isArray(atividade.usuarios)) {
      // Limpar o conteúdo do modal antes de exibir os novos comentários
      $('#modal-comentarios').empty();
      debugger;
      document.querySelector('input[name="Atividade_idAtividade"').value = atividade.idAtividade;
      document.querySelector('input[name="Usuarios_idUsuario"').value = authId;
      document.querySelector('span[name="titulo"').innerText = 'Comentarios da '+atividade.nome;

      $('#comentarios').empty();


      for (var u = 0; u < atividade.usuarios.length; u++) {
        // Verifica se há comentários para a atividade
        var comentariosAtividade = atividade.usuarios[u].comentarios.filter(function(comentario) {
            return comentario != null && comentario.Atividade_idAtividade == atividade.idAtividade;
        });

        if (comentariosAtividade.length > 0) {
          for (var o = 0; o < comentariosAtividade.length; o++) {

          var trContainer = $('<tr>');

  var tdPerfil = $('<td>');

  var divInfosPrincipais = $('<div>',{
    class: 'd-flex align-items-center'
  });

  var ImgPerfil = $('<img>',{
      src: 'https://mdbootstrap.com/img/new/avatars/8.jpg',
      alt: '',
      style: 'width: 45px; height: 45px',
      class: 'rounded-circle'

  });

  var divNameUser = $('<div>',{
    class: 'ms-3',
    style:'width:50vw'
  });

const data = comentariosAtividade[o].updated_at;
const dataV = new Date(data);
const dataCon = dataV.toLocaleString();

  var PnomeEtime = $('<p>',{
    class:'fw-bold mb-1',
    style:'margin-right:2vw',
    text:atividade.usuarios[u].name + ' | ' + dataCon
  });


  var pComentario = $('<p>',{
text:comentariosAtividade[o].comentario,
class:'text-break'

  });

  var tdSecundaria = $('<td>');

  var pAtribuicao = $('<p>',{
    class:'fw-normal mb-1'
  })



  var tdEditar = $('<td>');

  var buttoneditar = $('<button>',{
    type:'button',
    class:'border border-danger text-danger  btn btn-link btn-sm btn-rounded delete-comment-btn',
    text:'Apagar',
    'data-comment-id': comentariosAtividade[o].idComentarios

  });

tdEditar.append(buttoneditar);
tdSecundaria.append(pAtribuicao);
divNameUser.append(PnomeEtime,pComentario);
divInfosPrincipais.append(ImgPerfil,divNameUser);
tdPerfil.append(divInfosPrincipais);

trContainer.append(tdPerfil,tdSecundaria,tdEditar);


$('#comentarios').append(trContainer);
          }

        }
        debugger;
    }
      debugger;

      // Mostrar o modal
      $('#myModal').modal('show');
    } else {
      console.error('Erro:', atividade.usuarios.hasOwnProperty('comentarios') ?
        'A propriedade "comentarios" não é uma array.' :
        'A propriedade "comentarios" não existe em usuarios.');
    }


  })
});


$(document).ready(function () {
  // Use on para lidar com elementos dinâmicos
  $('#comentarios').on('click', '.delete-comment-btn', function () {
    var commentId = $(this).data('comment-id');
    console.log(commentId);
    debugger;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
debugger;
    $.ajax({
      url: '/Atividade/Comentarios/Deletar_Comentario/' + commentId,
      type: 'DELETE',
      processData: false,
      contentType: false,
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {
        debugger;
        // Lógica de sucesso, se necessário
        console.log('Comentário excluído com sucesso');
        window.location.reload();
        if (response.redirect) {

          window.location.href = response.redirect;
        } else {

          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        debugger;
        // Lógica de erro, se necessário
        console.error('Erro na solicitação DELETE', error, status, xhr);
      }
    });
  });
});







$(document).ready(function(){
  $('#formComentario').on('submit', function (event) {
    event.preventDefault();
    var atividadeId = $('#Atividade_idAtividade').val();
    var usuarioId = $('#Usuarios_idUsuario').val();
    var novocomentario = $('#comentario').val();
    var formData = new FormData(this);
    debugger;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: 'POST',
      url: '/Atividade/Comentarios/Criar_Comentarios/' + atividadeId + '/' + usuarioId,
      data: formData,
      processData: false,
      contentType: false,
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {
        // Adicionar o novo comentário ao modal
        var comentarioDiv = $('<h1><span>').addClass('badge badge-success');
        $('#modal-comentarios').append(comentarioDiv.append('<div><strong>Novo Comentário:</strong> ' + novocomentario + '</div>'));
        debugger;
        window.location.reload();
        // Limpar o campo do novo comentário
        $('#comentario').val('');
        if (response.redirect) {

          window.location.href = response.redirect;

        } else {

          console.log(response);
        }
      },
      error: function (error) {

        console.error('Erro ao criar o comentário no JS:', error);
      }
    });
  });
});








var imagemAntigaEtiqueta = '';
var imagemAntigoAnexo = '';

$(document).ready(function () {

  $('.view-activity').on('click', function () {
    var atividade = $(this).data('atividade');

console.log(atividade);

    debugger;
    if (atividade && atividade.hasOwnProperty('usuarios') && Array.isArray(atividade.usuarios)) {
      debugger;
      var imageSrcEtiqueta =  atividade.etiqueta ;
      var imageSrcAnexo = atividade.anexo ;
      imagemAntigaEtiqueta = imageSrcEtiqueta;
      imagemAntigoAnexo = imageSrcAnexo;
      debugger;
      $('#antigaEtiqueta').attr('src', imagemAntigaEtiqueta);
      $('#antigoAnexo').attr('src', imagemAntigoAnexo);
      debugger;

      debugger;
      $('#staticBackdrop img[name="etiqueta[]"]').attr('src', imageSrcEtiqueta);
      $('#staticBackdrop img[name="anexo[]"]').attr('src', imageSrcAnexo);
      debugger;
      var etiquetaImage = document.getElementById('etiquetaV');
      if (etiquetaImage) {
        etiquetaImage.src = imageSrcEtiqueta;
      }

      var anexoImage = document.getElementById('anexoV');
      if (anexoImage) {
        anexoImage.src = imageSrcAnexo;
      }
      var statusDropdown = document.querySelector('select[name="statusV"]');

      // Encontrar a opção correspondente e definir como selecionada
      for (var i = 0; i < statusDropdown.options.length; i++) {
        if (statusDropdown.options[i].value === atividade.status) {
          statusDropdown.options[i].selected = true;
          break;
        }
      }


      debugger;
      document.querySelector('input[name="nomeV"]').value = atividade.nome;
      document.querySelector('textarea[name="descricaoV"]').value = atividade.descricao;
      document.querySelector('input[name="dtFinalV"]').value = atividade.dtFinal;
      document.querySelector('input[name="dtInicialV"]').value = atividade.dtInicial;
      document.querySelector('input[name="idAtividade"]').value = atividade.idAtividade;
      document.querySelector('input[name="card_atividades_idCardV"]').value = atividade.card_atividades_idCard;
      debugger;



      $('[name="nomeUsuario"]').empty();

      for (var i = 0; i < atividade.usuarios.length; i++) {
          var usuarioNome = atividade.usuarios[i].name;
          var usuarioAtribuicao = atividade.usuarios[i].roles[0].name;
          var usuarioEmail = atividade.usuarios[i].email;


          // Criar a estrutura da coluna (column) com a classe Bootstrap
          var colContainer = $('<div>', {
              class: 'col-xl-6 mb-4   '
          });

          var card = $('<div>', {
              class: 'card'
          });


          var cardBody = $('<div>', {
              class: 'card-body'
          });

          var cardHeader = $('<div>', {
              class: 'd-flex justify-content-between align-items-center ',

          });


          var userDetails = $('<div>', {
              class: 'd-flex align-items-center',
              style: 'white-space: wrap; overflow-x:auto;overflow-y:auto;'

          });


          var userImage = $('<img>', {
              src: 'https://mdbootstrap.com/img/new/avatars/8.jpg',
              alt: '',
              style: 'width: 45px; height: 45px',
              class: 'rounded-circle'
          });


          var userInfo = $('<div>', {
              class: 'ms-3',


          });


          var userNameElement = $('<p>', {
              class: 'fw-bold mb-1',
              text: usuarioNome
          });


          var userRole = $('<p>', {
              class: 'fw-bold mb-2',
              text: usuarioAtribuicao
          });


          var userEmail = $('<p>', {
              class: 'text-muted mb-0',
              text: usuarioEmail
          });

          // Montar a estrutura do cartão
          userInfo.append(userNameElement, userRole, userEmail);
          userDetails.append(userImage, userInfo);
          cardHeader.append(userDetails);
          cardBody.append(cardHeader);

          // Adicionar o rodapé ao cartão
          var cardFooter = $('<div>', {
              class: 'card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around '
          });


          var messageButton = $('<a>', {
              class: 'btn btn-link m-0 text-reset',
              href: '#',
              role: 'button',
              'data-ripple-color': 'primary',
              'data-mdb-ripple-init': true,
              text: 'Message'
          });

          var callButton = $('<a>', {
              class: 'btn btn-link m-0 text-reset',
              href: '#',
              role: 'button',
              'data-ripple-color': 'primary',
              'data-mdb-ripple-init': true,
              text: 'Call'
          });

          // Adicionar ícones aos botões
          var messageIcon = $('<i>', {
              class: 'fas fa-envelope ms-2'
          });

          var callIcon = $('<i>', {
              class: 'fas fa-phone ms-2'
          });

          messageButton.append(messageIcon);
          callButton.append(callIcon);
          cardFooter.append(messageButton, callButton);


          card.append(cardBody, cardFooter);

          // Anexar o cartão à div com o atributo name igual a "nomeUsuario"
          colContainer.append(card);
          $('[name="nomeUsuario"]').append(colContainer);
      }



      updateFileInput('etiquetaV', atividade.etiqueta);
      updateFileInput('anexoV', atividade.anexo);

      $('#staticBackdrop').modal('show');
    } else {
      console.error('Invalid activity data.');
    }
  });

  function updateModalImages() {
    $('#staticBackdrop img[name="etiqueta[]"]').attr('src', imagemAntigaEtiqueta);
    $('#staticBackdrop img[name="anexo[]"]').attr('src', imagemAntigoAnexo);
    debugger;

  }

  $('#staticBackdrop').on('shown.bs.modal', function () {
    updateModalImages();
    debugger;
  });


  $('#atividadeForm').on('submit', function (event) {
    event.preventDefault();
    debugger;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData(this);
    var idAtividade = $('[name="idAtividade"]').val();
    var etiqueta = $('[name="etiqueta[]"]').val();
    debugger;
    $.ajax({
      url: '/Atividade/Atualizar_Atividade/' + idAtividade,
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {
        console.log('Requisição POST bem-sucedida:');
        if(etiqueta == null){

        }else{
        updateModalImages();
        }
        window.location.reload();
    if (response.redirect) {

      window.location.href = response.redirect;
    } else {

      console.log(response);
    }
      },
      error: function (xhr, status, error) {
        console.error('Erro na requisição POST', error, status, xhr);
      }
    });
  });

  function updateFileInput(inputName, filePaths) {
    var inputContainer = $('#' + inputName + 'List');
    inputContainer.empty();
    debugger;
    for (var i = 0; i < filePaths.length; i++) {
      var fileLink = $('<a>', {
        href: filePaths[i],
        text: inputName.charAt(0).toUpperCase() + inputName.slice(1) + ' File ' + (i + 1),
        target: '_blank'
      });
      inputContainer.append(fileLink);
    }

    if (filePaths.length === 0) {
      inputContainer.text('Nenhum arquivo disponível');
    }
  }
});

$(document).ready(function () {
  $('#btnDeletarAtividade').on('click', function () {
    var idAtividade = $('input[name="idAtividade"]').val();
    var idobra = $('input[name="idobra"]').val();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '/Atividade/Deletar_Atividade/' + idAtividade+ '/' + idobra,
      type: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {
        window.location.reload();
        if (response.redirect) {

          window.location.href = response.redirect;
        } else {

          console.log(response);
        }
      },
      error: function (xhr, status, error) {

        console.error('Erro na solicitação DELETE', error, status, xhr);
      }
    });
  });
});


$(document).ready(function(){
  $('.Delete_card_Button').on('click', function(){
    var idCard = $(this).data('card');
    var idobra = $(this).data('obra');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '/Card/Atividade/Deletar/' + idCard + '/' + idobra,
      type: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success: function (response) {
        if (response.redirect) {
          window.location.href = response.redirect;
        } else {
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        console.error('Erro na solicitação DELETE', error, status, xhr);
      }
    });
  });
});




$(document).ready(function () {
  $('#menu_').on('click', function () {
    $('#sidebarMenu').collapse('toggle');})})



    // fechar modais //

    $(document).ready(function(){
    document.getElementById('FecharAssociar').addEventListener('click', function () {

      $('#Modal_Associar_Usuario ').modal('hide');
    });
  });

  $(document).ready(function(){
    document.getElementById('FecharCriarATV').addEventListener('click', function () {

      $('#ModalCriarAtividade ').modal('hide');
    });
  });


$(document).ready(function(){
    document.getElementById('FecharComent').addEventListener('click', function () {

      $('#myModal').modal('hide');
    });
  });

  $(document).ready(function(){
    document.getElementById('FecharView').addEventListener('click', function () {

      $('#staticBackdrop ').modal('hide');
    });
  });

  $(document).ready(function(){
    document.getElementById('FecharCreateCard').addEventListener('click', function () {

      $('#exampleModal').modal('hide');
    });
  });
