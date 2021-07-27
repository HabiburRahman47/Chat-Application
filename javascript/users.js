//1st part
const searchBar = document.querySelector(".users .search input"),
  searchBtn = document.querySelector(".users .search button"),
  userList = document.querySelector(".users .users-list");

searchBtn.onclick = () => {
  searchBar.classList.toggle("active");
  searchBar.focus();
  searchBtn.classList.toggle("active");
  searchBar.value = "";
};

searchBar.onkeyup = () =>{
  let searchTerm = searchBar.value;

  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }
  // let's start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        userList.innerHTML = data;
      }
    }
  }
  // we have to send through ajax to php
  xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);

}

//2nd part
setInterval(() => {
  // let's start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("GET", "php/users.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if(!searchBar.classList.contains("active")){
          userList.innerHTML = data;
        }
      }
    }
  };
  // we have to send through ajax to php
  xhr.send();
}, 500);
