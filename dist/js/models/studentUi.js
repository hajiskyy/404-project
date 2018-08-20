// Side nav
class studentUI {
  constructor() {
    this.notification = document.querySelector("#msg");
    this.taskCollection = document.querySelector("#task-collection");
  }

  // Dispaly Error Messages
  displayError(msg) {
    this.notification.innerHTML = msg;
    this.notification.classList.add("show", "error");
    this.clearNotifications();
  }

  // Display Success Message
  dispalySuccess(msg) {
    this.notification.innerHTML = msg;
    this.notification.classList.add("show", "success");
    this.clearNotifications();
  }
  // Clear Notifications after 3s
  clearNotifications() {
    setTimeout(() => {
      this.notification.classList.remove("show");
    }, 3000);
  }

  //dispaly tasks on screen
  putTasks(tasks) {
    tasks.forEach((task, index) => {
      let list = document.createElement("li");
      list.classList.add("collection-item");
      list.innerHTML = `
          <span><h4>Name</h4>${task.name}</span>
          <span><h4>due date</h4> ${task.due}</span>
          <span><h4>description</h4> ${task.description}</span>
          <span class="secondary-content">
            <input type="file" id="file${task.id}" style="display: none;" accept=".docx, .pdf, .jpeg, .jpg, .png" />
            <button class="btn" onclick="document.querySelector('#file${task.id}').click()" >submit</button>
          </span>
        `;
      this.taskCollection.appendChild(list);
    });
  }
}
