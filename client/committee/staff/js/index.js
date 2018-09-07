const displayName = document.querySelector("#displayName");
// diplay name
const name = guard.getStaffName();
console.log(name);

if (displayName) {
  displayName.innerHTML = "Welcome " + name;
}
