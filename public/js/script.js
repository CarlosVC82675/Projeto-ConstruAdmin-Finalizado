const sidebarToggle = document.querySelector("#sidebar-toggle");

sidebarToggle.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

function highlightItem(element) {
    const sidebarItems = document.querySelectorAll('.sidebar-link');
    sidebarItems.forEach(item => item.classList.remove('active'));
    element.classList.add('active');
}

// Função para verificar o tamanho da tela
function checkScreenSize() {
    if (window.innerWidth < 768) {
      // Se a largura da tela for menor que 768px (tamanho de celular)
      return 'mobile';
    } else {
      // Se for maior que 768px (tamanho de desktop)
      return 'desktop';
    }
  }


