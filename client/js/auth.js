// initialize dom variables
const login = document.querySelector("#login");
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");

// submit Event Listener
login.addEventListener("submit", e => {
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
      ui.dispalySuccess(data.msg);
      //get student data
      let student = {};
      student = {
        ...data.data[0]
      };

      // Store login token
      localStorage.setItem("student_auth", JSON.stringify(student));

      // redirect to home page
      parent.window.location.href = "./student/home.html";
    }
  });
}
