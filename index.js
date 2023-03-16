import { setLocalStorage } from "./config/storage/local.js";
const GET_DATELOCAL = window.sessionStorage.getItem("user");
let IN_NICKNAME = document.getElementById("in-nickname");
let IN_KEY = document.getElementById("in-key");
let IN_NICKNAME_C = document.getElementById("in-nickname-c");
let IN_KEY_C = document.getElementById("in-key-c");
const btnAccess = document.getElementById("btn-access");
const btnAccess_s = document.getElementById("btn-access-s");
const form_log = document.getElementById("form-log");
let btnCreateNewRoom = document.getElementById("btn-c-new-room");
let btnKG = document.getElementById("btn-g-k");
let keyG = document.getElementById("key-g");
let contCreateKey = document.getElementById("cont-btn-generator");
let form_sign = document.getElementById("form-sign");
let btnCreate = document.getElementById("btn-create");
window.addEventListener("load", () => {
  if (!GET_DATELOCAL) {
    btnCreateNewRoom.addEventListener("click", () => {
      form_sign.style.display = "block";
      form_log.style.display = "none";
      document.getElementById("in-key").value = "empty";
      document.getElementById("in-nickname").value = "empty";
      document.getElementById("in-key-c").value = "";
      document.getElementById("in-nickname-c").value = "";
    });
    btnAccess_s.addEventListener("click", () => {
      form_sign.style.display = "none";
      form_log.style.display = "block";
      document.getElementById("in-key-c").value = "empty";
      document.getElementById("in-nickname-c").value = "empty";
      document.getElementById("in-key").value = "";
      document.getElementById("in-nickname").value = "";
    });

    function insertDateLocal() {
      form_log.addEventListener("submit", (e) => {
        if (
          document.getElementById("in-key").value === "" ||
          document.getElementById("in-key").value.length === 0 ||
          document.getElementById("in-nickname").value === "" ||
          document.getElementById("in-nickname").value.length === 0
        ) {
          alert("Los campos no pueden estar vacios");
          e.preventDefault();
        } else {
          setLocalStorage("user", {
            name: IN_NICKNAME.value,
            key: IN_KEY.value,
          });
          form_log.action = "./config/login.php";
        }
      });
      form_sign.addEventListener("submit", (e) => {
        if (
          document.getElementById("in-key-c").value === "" ||
          document.getElementById("in-key-c").value.length === 0 ||
          document.getElementById("in-nickname-c").value === "" ||
          document.getElementById("in-nickname-c").value.length === 0
        ) {
          alert("Los campos no pueden estar vacios");
          e.preventDefault();
        } else {
          setLocalStorage("user", {
            name: IN_NICKNAME_C.value,
            key: IN_KEY_C.value,
          });
          form_sign.action = "./config/create_room.php";
        }
      });
    }

    insertDateLocal();

    function generateKey() {
      /* Function to generate combination of password */
      function generateP() {
        var pass = "";
        var str =
          "ABCDEFGHIJKLMNOPQRSTUVWXYZ" +
          "abcdefghijklmnopqrstuvwxyz0123456789@#$";

        for (let i = 1; i <= 8; i++) {
          var char = Math.floor(Math.random() * str.length + 1);

          pass += str.charAt(char);
        }

        return pass;
      }

      btnKG.addEventListener("click", () => {
        keyG.innerHTML = generateP();
        document.getElementById("btn-c-key").className = "icon-copy";
      });

      function copyClipBoard(id_element, id_btn) {
        document.getElementById(id_btn).onclick = function () {
          let text = document.getElementById(id_element).textContent;
          document.getElementById(id_btn).className = "icon-check";
          navigator.clipboard
            .writeText(text)
            .then(() => {
              console.log("Text copied to clipboard");
            })
            .catch((err) => {
              console.error("Error in copying text: ", err);
            });
        };
      }

      copyClipBoard("key-g", "btn-c-key");
    }

    generateKey();
  } else {
    location.replace('./src/app.html');
  }
});
