document.getElementById("login-button").addEventListener("click", onLoginButtonClick);
document.getElementById("close-button2").addEventListener("click", onCloseButtonClick);

function onLoginButtonClick() {
  document.getElementById("log-window").style.display ="block";
};

function onCloseButtonClick()
{
  document.getElementById("log-window").style.display ="none";
}
