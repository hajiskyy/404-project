const menuBtn = document.querySelector("#menu");
const sideNav = document.querySelector("#sidenav");

let revealed = false;

menuBtn.addEventListener("click", () => {
  if(!revealed){
    sideNav.classList.add("reveal");
    menuBtn.classList.add("change");
    revealed = true;
  } else if (revealed){
    sideNav.classList.remove("reveal");
    menuBtn.classList.remove("change");

    revealed = false;
  }
});

class UI {
  constructor(){
    this.notification = document.querySelector("#msg");
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
}

