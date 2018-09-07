// init api
const api = new Api();

//init variables
const attendanceCollection = document.querySelector("#attendance-collection");

let students;
let attendance;

fetchStudents()
  .then(data => {
    students = data;
    return fetchAttendance();
  })
  .then(data => {
    attendance = data;
    return;
  })
  .then(x => {
    // display on screen
    putStudents(students, attendance, attendanceCollection );
  })
  .catch(err => console.log(err));



///// functions /////

//get registered students
async function fetchStudents() {
  let res = await api.getRegisteredStudents();
  return res.data;
}

// get atttendance
async function fetchAttendance() {
  let res = await api.getAttendance();
  return res.data;
}

function putStudents(students, attendance, collection) {
  students.forEach(st => {
    let list = document.createElement("li");
    list.classList.add("collection-item");
    list.innerHTML = `
            <span><h4>Id</h4>${st.id}</span>
            <span><h4>Name</h4> ${st.firstName + " " + st.lastName}</span>`;

    //if task is past due
    Date.prototype.getWeek = function() {
      let onejan = new Date(this.getFullYear(), 0, 1);
      return Math.ceil(((this - onejan) / 86400000 + onejan.getDay() + 1) / 7);
    };

    let today = new Date();
    let weekNumber = today.getWeek(); // Returns the week number as an integer

    let attended = false;
    // check if student attendance is already taken
    if (attendance) {
      attendance.forEach(at => {
        if (st.id == at.student_id && weekNumber == at.week) {
          attended = true;
        }
      });
    }
    // if attended
    if (attended) {
      list.innerHTML += `<span class="secondary-content">
                        <input type="checkbox" id="${st.id}"
                        value="0" onchange="selected(event,${weekNumber})" checked />
                        </span>`;
    } else {
      list.innerHTML += `<span class="secondary-content">
                        <input type="checkbox" id="${st.id}"
                        value="1" onchange="selected(event,${weekNumber})"/>
                        </span>`;
    }

    // inject list into DOM
    collection.appendChild(list);
  });
}

async function selected(e, week){
  // create attendance data
  let data = {
    id: e.target.id+"_"+guard.getstaffId(),
    student_id: e.target.id,
    advisor_id: guard.getstaffId(),
    week: week
  }

  /* A value of 0 means delete */ 
  if(e.target.value == "1"){
    let res = await api.setAttendance(data);
    console.log(res)
    location.reload();
  } else {
    let res = await api.deleteAttendance(data);
    console.log(res)
    location.reload();
  }
}
