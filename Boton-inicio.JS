//Se declara la constante
const btnTop = document.getElementById("btnTop");

// Mostrar el botón cuando se hace scroll
window.onscroll = function() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    btnTop.style.display = "block";
  } 
  else {
    btnTop.style.display = "none";
  }
};

  // Al hacer clic, volver al inicio
  btnTop.addEventListener("click", function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });