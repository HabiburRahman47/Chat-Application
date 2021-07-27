const passwdFirldId=document.querySelector(".form .field input[type='password']");
const toggleFeildId=document.querySelector(".form .field i")

toggleFeildId.onclick = () =>{
    if ( passwdFirldId.type == "password" )
     {
         passwdFirldId.type ="text";   
         toggleFeildId.classList.add("active");     
     }
     else{
         passwdFirldId.type = "password";
         toggleFeildId.classList.remove("active");
     }
}