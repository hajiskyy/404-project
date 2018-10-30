// init api
const api = new Api();

//init variables
const collection = document.querySelector("#collection");

let students

api.getRegisteredStudents()
.then(data => {
  console.log(data.data);
  putStudents(data.data);
})
.catch(err => console.log(err))


function putStudents(students) {
  students.forEach(st => {
    let list = document.createElement("li");
    list.classList.add("collection-item");
    list.innerHTML = `
            <span><h4>Id</h4>${st.id}</span>
            <span><h4>Name</h4> ${st.firstName + " " + st.lastName}</span>
            <span> <button class="btn green" onclick="viewSubmission(${st.id})"> View submissions </button> </span>
            `;
    // inject list into DOM
    collection.appendChild(list);
  })
}

function viewSubmission(id){
  console.log(id);
  localStorage.setItem("submission_id", id);
  location.href = "submissions.html"
}