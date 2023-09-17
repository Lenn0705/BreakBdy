const barra = document.getElementById("menu-barra");
const expandir = document.getElementById("expandir");
const texto = document.getElementById("texto");

expandir.addEventListener("click",function() {
    barra.style.width = "300px";
    texto.style.display = "block";
})