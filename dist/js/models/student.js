class studentUI {
  constructor() {
    this.notification = document.querySelector("#msg");
  }

  // Dispaly Error Messages
  displayError(msg) {
      this.notification.innerHTML = msg;
      this.notification.style.color = "red";
      this.clearNotifications();
  }
  // Display Success Message
  dispalySeccess(msg) {
      this.notification.innerHTML = msg;
      this.notification.style.color = "green";
      this.clearNotifications()
  }
  // Clear Notifications after 3s
  clearNotifications(){
      setTimeout(() => {
        this.notification.innerHTML = "";
      }, 3000);
  }
}
