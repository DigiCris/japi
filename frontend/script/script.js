const d = document;
const $buscar = d.getElementById("buscar"),
  $cerrarBusqueda = d.getElementById("cerrar-busqueda"),
  $tabla = d.getElementById("table"),
  $busquedaDinamica = d.getElementById("busqueda-dinamica"),
  $Modal = d.getElementById("modal"),
  $modalContent = d.getElementById("modal-content"),
  $modalTitle = d.getElementById("modal-title"),
  $modalMensaje = d.getElementById("mensaje-modal"),
  $mensajeModal = d.getElementById("mensaje-modal"),
  $comentarioModal = d.getElementById("comentario-modal")

  d.addEventListener("DOMContentLoaded", e => {

    d.addEventListener("click", (e) => {
      if(e.target.matches("#buscar")){
        $buscar.classList.add("none")
        $busquedaDinamica.classList.add("busqueda-dinamica-activa")
        $tabla.classList.add("mover-tabla")
      }
    
      if(e.target.matches("#cerrar")){
        $buscar.classList.remove("none")
        $busquedaDinamica.classList.remove("busqueda-dinamica-activa")
        $tabla.classList.remove("mover-tabla")
        $Modal.classList.remove("modal-active")
        $modalContent.classList.remove("modal-active")
        $comentarioModal.classList.remove("modal-active")
      }

      if(e.target.matches("#item-tabla")){
        $Modal.classList.add("modal-active");
        $modalContent.classList.add("modal-active")
        const dinamicTitle = e.target.textContent || e.target.innerText;
        $modalTitle.textContent = dinamicTitle;
      }

      if(e.target.matches("#btn-modal")) {
        $modalContent.classList.remove("modal-active");
        $mensajeModal.classList.add("modal-active")
        setTimeout(() => {
          $mensajeModal.classList.remove("modal-active")
          $comentarioModal.classList.add("modal-active")
        }, 1500)
      }

      
  });
})

