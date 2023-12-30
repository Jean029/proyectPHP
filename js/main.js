document.addEventListener("DOMContentLoaded", () => {
  const numest = document.getElementById("numEst");
  const form = document.getElementById("registro");

  numest.addEventListener("input", () => {
    if (!isFinite(numest.value.charAt(numest.value.length - 1))) {
      numest.value = numest.value.slice(0, numest.value.length - 1);
    } else {
      if (numest.value.length == 3 || numest.value.length == 6) {
        numest.value += "-";
      }
    }
  });

  form.addEventListener("submit", (e) => {
    const pass = document.getElementById("password").value;

    if (
      document.getElementById("numEst").value.length < 11 ||
      document.getElementById("numest").value[0] != 0
    ) {
      e.preventDefault();
      alert("Please enter a valid student number");
    } else if (!/[A-Z]/.test(pass)) {
      e.preventDefault();
      document.getElementById("passLabel").innerText =
        "Contraseña: Coloque una letra mayuscula";
    } else if (!/[^\w]/.test(pass)) {
      e.preventDefault();
      document.getElementById("passLabel").innerText =
        "Contraseña: Coloque un caracter especial";
    }
  });
});

function showPopup() {
  var popup = document.getElementById("popup");
  popup.style.display = "block";
}
function goBack() {
  var popup = document.getElementById("popup");
  popup.style.display = "none";
}

function showForm() {
  var courseForm = document.getElementById("courseForm");
  courseForm.style.display = "block";
}
function cancelForm() {
  var courseForm = document.getElementById("courseForm");
  courseForm.style.display = "none";
}
function showCourse() {
  var editCourse = document.getElementById("editCourse");
  editCourse.style.display = "block";
}

function cancelCourse() {
  var editCourse = document.getElementById("editCourse");
  editCourse.style.display = "none";
}

function showList() {
  var list = document.getElementById("List");
  list.style.display = "block";
}

function cancelList() {
  var list = document.getElementById("List");
  list.style.display = "none";
}

function showTable(tableId) {
  var tables = document.querySelectorAll(".results table");
  tables.forEach(function (table) {
    if (table.id === tableId) {
      table.style.display = "table";
    } else {
      table.style.display = "none";
    }
  });
}
