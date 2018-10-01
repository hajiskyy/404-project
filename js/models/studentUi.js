// Side nav
class studentUI {
  constructor() {
    this.taskCollection = document.querySelector("#task-collection");
  }
  //dispaly tasks on screen
  putTasks(tasks, submitted) {
    tasks.forEach(task => {
      let list = document.createElement("li");
      list.classList.add("collection-item");
      list.innerHTML = `
          <span><h4>Name</h4>${task.name}</span>
          <span><h4>description</h4> ${task.description}</span>`;

      //if task is past due
      let due = new Date(task.due);
      let today = new Date();

      list.innerHTML += `<span><h4>due date</h4> ${task.due}</span>`;

      // if not past yet
      if (today < due) {
        let submittedTask = false;
        // find submitted tasks
        if (submitted) {
          submitted.forEach(submit => {
            if (task.id == submit.task_id) {
              submittedTask = true;
            }
          });
        }

        if (submittedTask) {
          list.innerHTML += `<span class="secondary-content">
              <input type="file" id="resubmit${
                task.id
              }" style="display: none;" accept=".docx, .pdf, .jpeg, .jpg, .png" onchange="onSubmit(event)" />
              <button class="btn info" onclick="document.querySelector('#resubmit${
                task.id
              }').click()">resubmit</button>
              </span>`;
        } else {
          list.innerHTML += `<span class="secondary-content">
            <input type="file" id="submit${
              task.id
            }" style="display: none;" accept=".docx, .pdf, .jpeg, .jpg, .png" onchange="onSubmit(event)" />
            <button class="btn" onclick="document.querySelector('#submit${
              task.id
            }').click()" >submit</button>
            </span>`;
        }
      } else {
        list.innerHTML += `<span> due date is passed</span>`;
      }

      // inject list into DOM
      this.taskCollection.appendChild(list);
    });
  }
}
