class Api {
  constructor() {
    this.getHeaders = { "Content-Type": "application/json" };
  }

  async Login(username, password, callback) {
    // Send Login details
    let res = await fetch(
      `http://localhost/404/api/students/auth.php?id=${username}&password=${password}`,
      this.getHeaders
    );
    let data = await res.json();
    callback(data);
  }
  // student register
  async Register(user, callback) {}

  //staff login
  async staffLogin(username, password, callback) {}

  // get tasks
  async getTasks(callback) {
    // fetch tasks
    let res = await fetch("http://localhost/404/api/tasks/all.php", this.getHeaders);
    let data = await res.json();
    callback(data);
  }
}
