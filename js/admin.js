function goBackEst(popup) {
  popup.style.display = "none";
}

function showPopupEst() {
  const popup = document.getElementById("popupEstudiante");
  popup.style.display = "block";
}

document.addEventListener("DOMContentLoaded", () => {
  const popup = document.getElementById("popupEstudiante");
  document.getElementById("addCourse").addEventListener("click", () => {
    var popup = document.getElementById("popupCursos");
    popup.style.display = "block";
  });

  document.getElementById("cancelar").addEventListener("click", () => {
    const popup = document.getElementById("popupCursos");
    popup.style.display = "none";
  });

  document.getElementById("atras").addEventListener("click", () => {
    goBackEst(popup);
  });

  document.getElementById("editar").addEventListener("click", () => {
    goBackEst(popup);
  });

  document.getElementById("confirmar").addEventListener("click", () => {
    goBackEst(popup);
  });
});
