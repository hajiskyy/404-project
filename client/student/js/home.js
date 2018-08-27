// init dom varialble
// log out buttons
const logOutButtons = document.querySelectorAll("#logOut");

// on load
document.addEventListener("DOMContentLoaded", Init);

// for each log out buttons
logOutButtons.forEach(logOutBtn => {
  logOutBtn.addEventListener("click", e => {
    e.preventDefault();
  });
});

function Init() {
  // initialize classes
  const stdUi = new studentUI();
  const api = new Api();
  const guard = new Guard();
  //get task
  api
    .getTasks()
    .then(tasks => {
      //get submitted tasks
      let student_id = guard.getStudentId();
      api
        .getSubmittedTask(student_id)
        .then(submitted => {
          //display tasks
          stdUi.putTasks(tasks.data, submitted.data);
        })
        .catch(err => console.log(err));
    })
    .catch(err => console.log(err));
}

// FUNCTIONS

//log out functions
function logOut() {
  //clear localstorage
  localStorage.clear();

  //redirect to login
  parent.window.location.href = "../index.html";
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

      //get state of submission
      let state = e.target.id.replace(/[0-9]/g, "");

      const ui = new UI();

      // if state is submit
      if (state == "submit") {
        api
          .uploadSubmission(formData)
          .then(res => {
            // display message
            if (res.status == "error") {
              ui.displayError(res.msg);
            } else {
              ui.dispalySuccess(res.msg);
            }
          })
          .catch(err => console.log(err));
      } else {
        api
          .uploadResubmission(formData)
          .then(res => {
            // display message
            if (res.status == "error") {
              ui.displayError(res.msg);
            } else {
              ui.dispalySuccess(res.msg);
            }
          })
          .catch(err => console.log(err));
      }
    })
    .catch(err => console.log(err));
}
