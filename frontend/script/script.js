const d = document;
const $buscar = d.getElementById("buscar"),
  $cerrarBusqueda = d.getElementById("cerrar-busqueda"),
  $tabla = d.getElementById("table"),
  $busquedaDinamica = d.getElementById("busqueda-dinamica");

d.addEventListener("click", (e) => {
  if(e.target.matches("#buscar")){
    $buscar.classList.add("none")
    $busquedaDinamica.classList.add("busqueda-dinamica-activa")
    $tabla.classList.add("mover-tabla")
  }

  if(e.target.matches("#cerrar-busqueda")){
    $buscar.classList.remove("none")
    $busquedaDinamica.classList.remove("busqueda-dinamica-activa")
    $tabla.classList.remove("mover-tabla")
  }
});
