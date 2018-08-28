// init dom varialble

// log out buttons
const logOutButtons = document.querySelectorAll("#logOut");
//menu buttons
const menuBtn = document.querySelector("#menu");
//side nav
const sideNav = document.querySelector("#sidenav");

// for each log out buttons
if(logOutButtons){
  logOutButtons.forEach(logOutBtn => {
    logOutBtn.addEventListener("click", e => {
      e.preventDefault();
    });
  });
  
}

//log out functions
function logOut() {
  //clear localstorage
  localStorage.clear();

  //redirect to login
  parent.window.location.href = "../index.html";
}

// menu button click and side nav
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

