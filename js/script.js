function chk() { 
    let pass = document.getElementById("pass").value;
    let cpass = document.getElementById("cpass").value;

    if(pass!=cpass){
      document.getElementById("error").innerHTML = "Passwords do not match!";
        document.getElementById("cpass").value = "";
    }
    else{
        document.getElementById("error").innerHTML = "Passwords match!";
    }
}
function togglePasswordVisibility() {
    let passwordInput = document.getElementById("pass", "cpass");
    let showPasswordCheckbox = document.getElementById("show-password");
  
    if (showPasswordCheckbox.checked) {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }