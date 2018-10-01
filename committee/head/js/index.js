const displayName = document.querySelector("#displayName");
// diplay name
const name = guard.getHeadName();
if (displayName) {
  displayName.innerHTML = "Welcome " + name;
}
