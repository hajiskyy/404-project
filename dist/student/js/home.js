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
    fileEvents();
  });
}

// FUNCTIONS

//log out functions
function logOut() {
  //clear localstorage
  localStorage.clear();

  //redirect to login
  parent.window.location.href = "../index.html";
}

//buttons events
function fileEvents() {
  // button
  const submitButtons = document.querySelectorAll("[type=file]");
  // foreach collection-item
  submitButtons.forEach(btn => {
    btn.addEventListener("change", e => {
      onSubmit(e);
    });
  });
}

//on submit
function onSubmit(e) {
  e.preventDefault();
  // initialize api
  const api = new Api();

  // initialize form data
  const formData = new FormData();

  // get the file
  const files = e.target.files;
  const file = files[0];
  formData.append("file", file);

  // get student id
  const guard = new Guard();
  const id = guard.getStudentId();
  formData.append("student_id", id);

  //get task id
  const task_id = e.target.id.replace(/^\D+/g, "");
  formData.append("task_id", task_id);

  api
    .getSingleTask(task_id)
    .then(data => {
      // get task name
      let task_name = data.data[0].name;
      formData.append("task_name", task_name);
      
      // upload data
      api.uploadSubmission(formData);
    })
    .catch(err => console.log(err));
}
