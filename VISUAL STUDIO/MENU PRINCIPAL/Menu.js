const barra = document.getElementById("menu-barra");
const expandir = document.getElementById("expandir");
const texto = document.getElementById("texto");
const barraDer = document.getElementById("menu-barra-der")

expandir.addEventListener("click",function() {
    barra.style.width = "300px";
    barraDer.style.marginLeft = "600px";
    
})

