// initialize dom variables
//student login form
const login = document.querySelector("#login");

//student register form
const register = document.querySelector("#register");

// global variables
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");
const firtName = document.querySelector("#fname");
const lastName = document.querySelector("#lname");

// submit Event Listeners

// studentlogin event
if (login) {
  login.addEventListener("submit", e => {
    e.preventDefault();
    stdAuth();
  });
}

if (register) {
  // register event
  register.addEventListener("submit", e => {
    e.preventDefault();
    stdRegister();
  });
}


// ###FUNCTIONS

// student login
function stdAuth() {
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

// student register
function stdRegister() {
  // get register data
  let user = {
    firstName: firtName.value,
    lastName: lastName.value,
    id: usernameInput.value,
    password: passwordInput.value
  };

  const api = new Api;
  const ui = new studentUI();

  api.Register(user)
  .then(res => {
    if (res.status == "error") {
      ui.displayError(res.msg);
    } else {
      ui.dispalySuccess("Register Request has been sent.");
      setTimeout(() => {
        // redirect to home page
        parent.window.location.href = "./index.html";
      }, 4000);
    }
  })
  .catch(err => console.log(err));
}
