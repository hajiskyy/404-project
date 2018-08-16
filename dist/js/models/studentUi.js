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
  dispalySeccess(msg) {
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
          <span> ${task.name}</span>
          <span> due: ${task.due}</span>
          <span class="secondary-item"><button class="btn">submit</button></span>
        `;
      this.taskCollection.appendChild(list);
    });
  }
}
