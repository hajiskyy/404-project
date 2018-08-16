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

