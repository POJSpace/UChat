function getFields() {
  const user = document.getElementById("username");
  const pass = document.getElementById("password");
  const msg = document.getElementById("msg");
  return { user, pass, msg };
}

window.addEventListener("DOMContentLoaded", function() {
  const fields = getFields();
  fields.user.value = localStorage.getItem("user");
  fields.pass.value = localStorage.getItem("pass");
}, false);

function setLogin() {
  const fields = getFields();
  localStorage.setItem("user", fields.user.value);
  localStorage.setItem("pass", fields.pass.value);
  fields.msg.innerHTML = "Succesfully set login!";
}
