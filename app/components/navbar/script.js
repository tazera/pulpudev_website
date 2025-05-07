document.addEventListener("DOMContentLoaded", function() {
  const navbar = document.querySelector('.navbar');
  const collapseEl = document.querySelector('.navbar-collapse');
  const toggler = document.querySelector('.navbar-toggler');
  

  
  // Scroll hiding
  let lastScrollTop = 0;
  window.addEventListener('scroll', function() {
    let currentScrollTop = window.pageYOffset;
    if (currentScrollTop > lastScrollTop) {
      navbar.style.transform = "translateY(-100%)";
    } else {
      navbar.style.transform = "";
    }
    lastScrollTop = currentScrollTop;
  });


  // Create our own Collapse instance instead of trying to get Bootstrap's
  const bsCollapse = new bootstrap.Collapse(collapseEl, {
    toggle: false
  });
  
  // Replace Bootstrap's default toggle behavior with our own
  toggler.removeAttribute('data-bs-toggle');
  toggler.removeAttribute('data-bs-target');
  
  // Handle toggler clicks with custom behavior
  toggler.addEventListener('click', function() {
    if (collapseEl.classList.contains('show')) {
      bsCollapse.hide();
    } else {
      bsCollapse.show();
    }
  });
  
  // Close menu on nav-link click (except dropdowns)
  document.querySelectorAll('.navbar-collapse .nav-link').forEach(link => {
    if (!link.classList.contains('dropdown-toggle') && !link.classList.contains('dropdown-item')) {
      link.addEventListener('click', () => {
        if (collapseEl.classList.contains('show') && bsCollapse) {
          bsCollapse.hide();
        }
      });
    }
  });
  
  // Close menu on outside click
  document.addEventListener('click', function(e) {
    if (collapseEl.classList.contains('show') && 
        !navbar.contains(e.target) && 
        bsCollapse) {
      bsCollapse.hide();
    }
  }, true);
});
