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
}
