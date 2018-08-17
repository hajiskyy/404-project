// init dom varialble

// log out buttons
const logOutButtons = document.querySelectorAll("#logOut");

// on load
document.addEventListener("DOMContentLoaded", Init);

// for each log out buttons
logOutButtons.forEach(logOutBtn => {
  logOutBtn.addEventListener("click", e => {
    e.preventDefault();
    logOut();
  });
});

function Init() {
  // initialize dependencies
  const ui = new studentUI();
  const api = new Api();

  //get task
  api.getTasks(tasks => {
    //display tasks
    ui.putTasks(tasks.data);
    //set button click events
    buttonEvents()
  });
}

// FUNCTIONS
function logOut() {
  //clear localstorage
  localStorage.clear();

  //redirect to login
  parent.window.location.href = "../index.html";
}

function buttonEvents() {
  // button
  const submitButtons = document.querySelectorAll("button");
  // foreach collection-item
  submitButtons.forEach(btn => {
    btn.addEventListener("click", e => {
      onSubmit(e.target.id);
    });
  });
}

// on submit
function onSubmit(id) {
    // TODO - UPLOAD SUBMISSION
    console.log(id);
}
