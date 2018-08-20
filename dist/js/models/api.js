class Api {
  constructor() {
    this.getHeaders = { "Content-Type": "application/json" };
    this.formHeaders = { "Content-Type": "multipart/form-data" };
    this.ui = new studentUI();
  }

  async Login(username, password, callback) {
    const url = `http://localhost/404/api/students/auth.php?id=${username}&password=${password}`;

    // Send Login details
    let res = await fetch(url);
    let data = await res.json();
    callback(data);
  }
  // student register
  async Register(user, callback) {}

  //staff login
  async staffLogin(username, password, callback) {}

  // get tasks
  async getTasks(callback) {
    const url = "http://localhost/404/api/tasks/all.php";
    // fetch tasks
    let res = await fetch(url);
    let data = await res.json();
    callback(data);
  }

  // get single task
  async getSingleTask(id) {
    const url = `http://localhost/404/api/tasks/single.php?id=${id}`;
    // fetch tasks
    let res = await fetch(url);
    let data = await res.json();
    return data;
  }

  // upload submission
  async uploadSubmission(formData) {
    const url = "http://localhost/404/api/submissions/create.php";
    let res = await fetch(url, { method: "post", body: formData, redirect: "error" });

    let data = await res.json();
    const ui = new studentUI();
    // display message
    if(data.status == "error"){
      this.ui.displayError(data.msg);
    } else {
      this.ui.dispalySuccess(data.msg);
    } 
  }
}
