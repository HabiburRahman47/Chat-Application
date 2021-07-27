const form = document.querySelector(".typing-area"),
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector("section .chat-box");

form.onsubmit = (e) => {
  e.preventDefault(); // preventing from form submiting
};

sendBtn.onclick = () => {
  // let's start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        inputField.value = " ";
      }
    }
  };
  // we have to send the form data through ajax to php
  let formData = new FormData(form);
  xhr.send(formData);
};

setInterval(() => {
  // let's start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/get-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        chatBox.innerHTML = data;
        // console.log("habibur");
      }
    }
  };
  // we have to send the form data through ajax to php
  let formData = new FormData(form);
  xhr.send(formData);
}, 500);
