// init dom varialble
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
  });
}

function logOut() {
  //clear localstorage
  localStorage.clear();

  //redirect to login
  parent.window.location.href = "../index.html";
}
