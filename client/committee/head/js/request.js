//get student collection
const studentCollection = document.querySelector("#student-collection");
const title = document.querySelector("#title");

// get Student Data
const api = new Api();
api
  .getUnregistered()
  .then(res => {
    if (res.data) {
      //display students data
      displayStudents(res.data, studentCollection);
    } else {
      NoRequest();
    }
  })
  .catch(err => console.log(err));

const ui = new UI();

// FUNCTIONS
function deleteStudent(e, id) {
  if (confirm("Are You Sure?")) {
    api
      .deleteStudent(id)
      .then(res => {
        if ((res.status = "ok")) {
          ui.dispalySuccess(res.msg);
        } else {
          ui.displayError(res.msg);
        }
        refresh();
      })
      .catch(err => console.log(err));
  }
}

function acceptStudent(e, id) {
  api
    .acceptStudent(id)
    .then(res => {
      if ((res.status = "ok")) {
        ui.dispalySuccess(res.msg);
      } else {
        ui.displayError(res.msg);
      }
      refresh();
    })
    .catch(err => console.log(err));
}
//display students
function displayStudents(students, collection) {
  // create list header and display
  let liHead = document.createElement("li");
  liHead.classList.add("collection-header");
  liHead.innerHTML = `
        <span>id</span>
        <span>name</span>
    `;
  collection.appendChild(liHead);

  //loop and display students info with buttons
  students.forEach(student => {
    let li = document.createElement("li");
    li.classList.add("collection-item");
    li.innerHTML = `
        <span><h4>id</h4>${student.id}</span>
        <span><h4>Name</h4>${student.firstName + "" + student.lastName} </span>
        <span class="secondary-content">
        <button class = "btn red" onclick="deleteStudent(event, ${
          student.id
        })">delete</button> 
        </span>
        <span class="secondary-content">
        <button class = "btn" onclick="acceptStudent(event, ${
          student.id
        })">accept</button>
        </span>
        `;
    collection.appendChild(li);
  });
}

// If no request
function NoRequest() {
  title.innerHTML = "No New Student Request";
}

function refresh() {
  setTimeout(() => {
    location.reload();
  }, 2000);
}
