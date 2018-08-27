// initialize dom variables
//student login form
const login = document.querySelector("#login");

//student register form
const register = document.querySelector("#register");

//staf login form
const staffLogin = document.querySelector('#staffLogin');

// global variables
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");
const firtName = document.querySelector("#fname");
const lastName = document.querySelector("#lname");

// submit Event Listeners

if (login) {
  // studentlogin event
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

if(staffLogin) {
  // staff login event
  staffLogin.addEventListener("submit", e => {
    e.preventDefault();
    staffAuth();
  })
}


// ###FUNCTIONS

// student login
function stdAuth() {
  // init api
  const api = new Api();

  // initialize ui controller
  const ui = new UI();

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
  const ui = new UI();

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

function staffAuth(){
  let username = usernameInput.value;
  let password = passwordInput.value;

  const ui = new UI();
  
  const api = new Api();
  api.staffLogin(username, password)
  .then(res => {
    if (res.status == "error") {
      ui.displayError(res.msg);
    } else {
      ui.dispalySuccess(res.msg);
      // get staff data
      let staff = {};
      staff = {
        ...res.data[0]
      };

      // Store login token
      if(res.role == "head"){
        localStorage.setItem("head_auth", JSON.stringify(staff));
        // redirect to head home page
        parent.window.location.href = "../committee/head/";
      } else {
        localStorage.setItem("committee_auth", JSON.stringify(staff));
        // redirect to committee home page
        parent.window.location.href = "../committee/staff/";
      }
      
    }
  })
  .catch(err => console.log(err));
}
