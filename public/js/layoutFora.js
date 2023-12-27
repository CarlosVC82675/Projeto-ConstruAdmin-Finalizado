const sidebarToggle = document.querySelector("#sidebar-toggle");

sidebarToggle.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

function highlightItem(element) {
    const sidebarItems = document.querySelectorAll('.sidebar-link');
    sidebarItems.forEach(item => item.classList.remove('active'));
    element.classList.add('active');
}







