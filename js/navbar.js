document.addEventListener('DOMContentLoaded', () => {
    // Obtener todos los elementos "navbar-burger"
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  
    // Añadir un evento click en cada uno de ellos
    $navbarBurgers.forEach(el => {
      el.addEventListener('click', () => {
        // Obtener el target del atributo "data-target"
        const target = el.dataset.target;
        const $target = document.getElementById(target);
  
        // Alternar la clase "is-active" en "navbar-burger" y el "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
      });
    });
  });