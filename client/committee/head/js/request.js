//get student collection
const studentCollection = document.querySelector("#student-collection");

// get Student Data
const api = new Api();
api.getUnregistered()
.then(res => {
    //display students data
    displayStudents(res.data, studentCollection);
})
.catch(err => console.log(err))


// FUNCTIONS
function deleteStudent(e, id){
    console.log(id)
}

function acceptStudent(e, id){
    console.log(id);
}
//display students
function displayStudents(students, collection) {
    // create list header and display
    let liHead = document.createElement("li")
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
        <span><h4>Name</h4>${student.firstName + ""+ student.lastName} </span>
        <span class="secondary-content">
        <button class = "btn red" onclick="deleteStudent(event, ${student.id})">delete</button> 
        </span>
        <span class="secondary-content">
        <button class = "btn" onclick="acceptStudent(event, ${student.id})">accept</button>
        </span>
        `;
        collection.appendChild(li);
    })
}