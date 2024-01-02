function adicionarMateriais(material){
    document.querySelector('input[name="quantidade"]').value = material.quantidade;
    document.querySelector('input[name="dtEntrada"]').value = material.dtEntrada;

    const form = document.getElementById('adicionarMaterialForm');
    const rotaAtualizacao = `/material/adicionar/${material.idMateriais}`;
    form.action = rotaAtualizacao;

    const myModal = new bootstrap.Modal(document.getElementById('adicionarModalMateriais'));
    myModal.show();
}

function removerMateriais(material){
    document.querySelector('input[name="quantidade"]').value = material.quantidade;
    document.querySelector('input[name="dtSaida"]').value = material.dtSaida;

    const form = document.getElementById('removerMaterialForm');
    const rotaAtualizarRemover = `/material/remover/${material.idMateriais}`;
    form.action = rotaAtualizarRemover;

    const myModal = new bootstrap.Modal(document.getElementById('removerModalMateriais'));
    myModal.show();
}

 function editarMateriais(material){
     document.querySelector('input[name="nomeM"]').value = material.nomeM;
     document.querySelector('input[name="kg"]').value = material.kg;
     document.querySelector('input[name="metros"]').value = material.metros;
     document.querySelector('input[name="quantidade"]').value = material.quantidade;
     document.querySelector('input[name="dtVencimento"]').value = material.dtVencimento;
     document.querySelector('select[name="Status_2"]').value = material.Status_2;
     document.querySelector('input[name="dtEntrada"]').value = material.dtEntrada;

     const form = document.getElementById('editarMaterialForm');
    const rotaAtualizarEditar = `/material/update/${material.idMateriais}`;
     form.action = rotaAtualizarEditar;
    
     const myModal = new bootstrap.Modal(document.getElementById('editarModalMateriais'));
     myModal.show();
 }

function removerNMateriais(material){
    document.querySelector('input[name="quantidade"]').value = material.quantidade;

    const form = document.getElementById('removerNMaterialForm');
    const rotaAtualizarRemover = `/obra/materiais/remover/${material.idMateriais}`;
    form.action = rotaAtualizarRemover;

    const myModal = new bootstrap.Modal(document.getElementById('removerNModalMateriais'));
    myModal.show();
}