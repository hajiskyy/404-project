// initialize dom variables
const form = document.querySelector("#login");
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");

// submit Event Listener
form.addEventListener("submit", e => {
  e.preventDefault();
  Authenticate();
});

function Authenticate() {
  // init api
  const api = new Api();

  // initialize ui controller
  const ui = new studentUI();

  // get login values
  let username = usernameInput.value;
  let password = passwordInput.value;
  api.Login(username, password, data => {
    if (data.status == "error") {
        ui.displayError(data.msg);
      } else {
        ui.dispalySeccess(data.msg);

        //Store login token
        localStorage.setItem("token", data.token)
        parent.window.location.href = "./student/home.html";
      }
  });
}
