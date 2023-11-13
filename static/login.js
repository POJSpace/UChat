// Names of keys in local storage
const LS_USER = "user";
const LS_PASS = "pass";

function message(text) {
  const fields = getFields();
  fields.msg.innerHTML = text;
  console.log(text);
}

function getFields() {
  const user = document.getElementById("username");
  const pass = document.getElementById("password");
  const msg = document.getElementById("msg");
  return { user, pass, msg };
}

function fillDetails() {
  const fields = getFields();
  fields.user.value = localStorage.getItem(LS_USER);
  fields.pass.value = localStorage.getItem(LS_PASS); 
}

window.addEventListener("DOMContentLoaded", fillDetails, false);

function setLogin() {
  const fields = getFields();
  localStorage.setItem(LS_USER, fields.user.value);
  localStorage.setItem(LS_PASS, fields.pass.value);
  message("Succesfully set login!");
}

function setLogout() {
  const fields = getFields();
  localStorage.removeItem(LS_USER);
  localStorage.removeItem(LS_PASS);
  fields.user.value = "";
  fields.pass.value = "";
  message("Succesfully logged out!");
}
