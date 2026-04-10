// Botón de menú hamburguesa
const botonMenu = document.getElementById("abrir");
const nav = document.querySelector("nav");

botonMenu.addEventListener("click", () => {
    nav.classList.toggle("active");
});

//Cuando haga clic afuera del menú, se cerrará
document.addEventListener("click", (event) => {
    if (!nav.contains(event.target) && !botonMenu.contains(event.target)) {
        nav.classList.remove("active");
    }
});