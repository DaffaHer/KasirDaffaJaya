document.addEventListener('DOMContentLoaded', function () {
    var navLinks = document.querySelectorAll('.nav-item.has-treeview > .nav-link');
    
    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            var parent = this.parentElement;
            var isOpen = parent.classList.contains('menu-open');
            
            // Tutup semua menu open
            document.querySelectorAll('.nav-item.has-treeview.menu-open').forEach(function (openItem) {
                if (openItem !== parent) {
                    openItem.classList.remove('menu-open');
                }
            });
            
            // Toggle menu open state
            if (!isOpen) {
                parent.classList.add('menu-open');
            } else {
                parent.classList.remove('menu-open');
            }
        });
    });
});
