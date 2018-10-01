//init variables
const taskForm = document.querySelector('#taskForm'); // task form
const taskName = document.querySelector('#name'); // task name
const description = document.querySelector('#description'); //task description
const dueDate = document.querySelector("#date"); // due date

const api = new Api();
const ui = new UI();

taskForm.addEventListener("submit", (e) => {
    e.preventDefault();
    addTask();
});

// fetch tasks
api.getTasks()
.then((tasks) => {
    putTasks(tasks);
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

}