document.addEventListener("DOMContentLoaded", Init);

function Init(){
    // initialize dependencies
    const ui = new studentUI;
    const api = new Api

    //get task
    api.getTasks((tasks) => {
        //display tasks
        ui.putTasks(tasks.data);
    })
}