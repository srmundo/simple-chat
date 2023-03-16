import { setLocalStorage } from "../config/storage/local.js";
const NAME_USER = document.getElementById("name-01");
const GET_DATELOCAL = JSON.parse(window.sessionStorage.getItem("user"));

const btnSend = document.getElementById("btn-send");
const btn_exit = document.getElementById("btn-exit");
let inMessage = document.getElementById("in-message");
let count = 0;
let date = new Date();
let lang = ["Chat with ", " Messages"];
let current_time =
  date.getFullYear() +
  "-" +
  date.getMonth() +
  "-" +
  date.getDate() +
  "-" +
  date.getHours() +
  "-" +
  date.getMinutes() +
  "-" +
  date.getSeconds();

window.addEventListener("load", () => {
  
  if (GET_DATELOCAL) {
    window.oncontextmenu = function () {
      return false;
    };
  
    document.addEventListener(
      "keydown",
      function (event) {
        var key = event.key || event.keyCode;
  
        if (key == 123) {
          return false;
        } else if (
          (event.ctrlKey && event.shiftKey && key == 73) ||
          (event.ctrlKey && event.shiftKey && key == 74)
        ) {
          return false;
        }
      },
      false
    );
    function getDateLocal() {
      NAME_USER.textContent = GET_DATELOCAL.name;
      document.getElementById("show-key").textContent = GET_DATELOCAL.key;
    }
    getDateLocal();
  
    
    function requestMessage(id = null, url) {
      let xhttp = new XMLHttpRequest();
      // xhttp.onload = function () {
      //   document.getElementById(id).innerHTML += this.responseText;
      // };
      xhttp.open("GET", url);
      xhttp.send();
    }

    btnSend.addEventListener("click", () => {
      requestMessage(
        "",
        "../config/message-s.php?key=" +
          GET_DATELOCAL.key +
          "&date=" +
          current_time +
          "&user=" +
          GET_DATELOCAL.name +
          "&send=" +
          inMessage.value
      );
      inMessage.value = "";
    });

    btn_exit.addEventListener("click", () => {
      document.getElementById("form-logout").action =
        "../config/logout.php?user=" + GET_DATELOCAL.name;
      document.getElementById("form-logout").submit();
      window.sessionStorage.removeItem("user");
    });

    NAME_USER.addEventListener("click", () => {
      switch (document.getElementById("menu-u").style.display) {
        case "none":
          document.querySelector(".triangle-m-u").style.display = "block";
          document.getElementById("menu-u").style.display = "block";
          document.getElementById("set_img").addEventListener("click", () => {
            document.getElementById("in-avatar").click();
          });
          document.getElementById("user_room").addEventListener(
            "click",
            () => {
              document.querySelector(".triangle-m-u").style.display = "none";
              document.getElementById("menu-u").style.display = "none";
            },
            true
          );
          document.getElementById("chat").addEventListener(
            "click",
            () => {
              document.querySelector(".triangle-m-u").style.display = "none";
              document.getElementById("menu-u").style.display = "none";
            },
            true
          );
          break;
        default:
          document.querySelector(".triangle-m-u").style.display = "none";
          document.getElementById("menu-u").style.display = "none";
      }
    });
    const $selectionFile = document.querySelector("#in-avatar"),
      $imagePrevi = document.querySelector("#me-img");

    // Escuchar cuando cambie
    $selectionFile.addEventListener("change", (e) => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const files = $selectionFile.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!files || !files.length) {
        $imagePrevi.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const firstFile = files[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(firstFile);
      // Y a la fuente de la imagen le ponemos el objectURL

      window.sessionStorage.setItem("url", objectURL);
      requestMessage(
        "",
        "../config/avatar.php?user=" +
          GET_DATELOCAL.name +
          "&avatarURL=" +
          sessionStorage.getItem("url")
      );
      $imagePrevi.style.backgroundImage = `url(${sessionStorage.getItem(
        "url"
      )})`;
    });
    // Los archivos seleccionados, pueden ser muchos o uno
    const files = $selectionFile.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!files || !files.length) {
      $imagePrevi.src = "";
      return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const firstFile = files[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(firstFile);
    // Y a la fuente de la imagen le ponemos el objectURL

    window.sessionStorage.setItem("url", objectURL);
    requestMessage(
      "",
      "../config/avatar.php?user=" +
        GET_DATELOCAL.name +
        "&avatarURL=" +
        sessionStorage.getItem("url")
    );
    $imagePrevi.style.backgroundImage = `url(${sessionStorage.getItem("url")})`;

  } else {
    location.replace("../index.html");
  }
});
