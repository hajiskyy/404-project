//init variables
const taskForm = document.querySelector('#taskForm'); // task form
const taskName = document.querySelector('#name'); // task name
const description = document.querySelector('#description'); //task description
const dueDate = document.querySelector("#date"); // due date


const taskCollection = document.querySelector("#task-collection");

const api = new Api();
const ui = new UI();

taskForm.addEventListener("submit", (e) => {
    e.preventDefault();
    addTask();
});

// fetch tasks
api.getTasks()
.then((tasks) => {
    putTasks(tasks.data);
})




//// FUNCTIONS ////
async function addTask() {
    let data = {
        name: taskName.value,
        description: description.value,
        due: dueDate.value
    }

    let res = await api.addTask(data);
    console.log(res);
    if(res.status == "error"){
        ui.displayError(res.msg);
    } else {
        ui.dispalySuccess(res.msg);
    }

    setTimeout(() => {
        location.reload()
    }, 2000);
}

function putTasks(tasks){
    tasks.forEach(task => {
        let list = document.createElement("li");
        list.classList.add("collection-item");
        list.innerHTML = `
            <span><h4>Name</h4>${task.name}</span>
            <span><h4>description</h4> ${task.description}</span>
            <span><h4>due date</h4> ${task.due}</span>
            <span> <button class="btn red" onclick="deletetask(${task.id})"> delete</button> </span>
            `;
            taskCollection.appendChild(list);
    });
  
}

function deletetask(id){
    console.log(id);
}