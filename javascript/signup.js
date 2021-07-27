const form = document.querySelector(".signup form"),
  contiueBtn = form.querySelector("form .button"),
  errorTxt = form.querySelector(" form .error-txt");

form.onsubmit = (e) => {
  e.preventDefault(); // preventing from form submiting
};

contiueBtn.onclick = () => {
  // let's start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var data = xhr.response;
        if (data == "success") {
          location.href = "users.php";
        } else {
          errorTxt.textContent = data;
          errorTxt.style.display = "block";
        }
      }
    }
  };
  // we have to send the form data through ajax to php
  let formData = new FormData(form);
  xhr.send(formData);
};
