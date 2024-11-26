function mostrarEntrar() {
    document.getElementById("EntrarPainel").classList.add("active");
    document.getElementById("CadastroSite").classList.remove("active");
    document.getElementById("btnEntrar").classList.add("active");
    document.getElementById("btnCadastro").classList.remove("active");
    document.getElementById("Indicador").style.transform = "translateX(25px)";
}
function mostrarCadastro() {
    document.getElementById("EntrarPainel").classList.remove("active");
    document.getElementById("CadastroSite").classList.add("active");
    document.getElementById("btnEntrar").classList.remove("active");
    document.getElementById("btnCadastro").classList.add("active");
    document.getElementById("Indicador").style.transform = "translateX(220px)";
}
