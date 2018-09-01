class Api {
  constructor() {
    this.getHeaders = { "Content-Type": "application/json" };
    this.formHeaders = { "Content-Type": "multipart/form-data" };
  }

  async Login(username, password, callback) {
    const url = `http://localhost/404/server/api/students/auth.php?id=${username}&password=${password}`;

    // Send Login details
    let res = await fetch(url);
    let data = await res.json();
    callback(data);
  }

  // student register
  async Register(user) {
    const url = 'http://localhost/404/server/api/students/register.php';

    let res = await fetch(url,{method: "POST", body: JSON.stringify(user)});
    let data = await res.json()

    return data;
  }

  //staff login
  async staffLogin(username, password) {
    const url = `http://localhost/404/server/api/staffs/auth.php?id=${username}&password=${password}`;

    // Send Login details
    let res = await fetch(url);
    let data = await res.json();
    return data;
  }

  // get tasks
  async getTasks() {
    const url = "http://localhost/404/server/api/tasks/all.php";
    // fetch tasks
    let res = await fetch(url);
    let data = await res.json();
    return data;
  }

  // get single task
  async getSingleTask(id) {
    const url = `http://localhost/404/server/api/tasks/single.php?id=${id}`;
    // fetch tasks
    let res = await fetch(url);
    let data = await res.json();
    return data;
  }

  // upload submission
  async uploadSubmission(formData) {
    const url = "http://localhost/404/server/api/submissions/create.php";
    let res = await fetch(url, {
      method: "post",
      body: formData,
      redirect: "error"
    });

    let data = await res.json();
    return data;
  }
  async uploadResubmission(formData) {
    const url = "http://localhost/404/server/api/submissions/update.php";
    let res = await fetch(url, {
      method: "post",
      body: formData,
      redirect: "error"
    });

    let data = await res.json();
    return data;
  }

  // get submitted tasks
  async getSubmittedTask(id) {
    const url = `http://localhost/404/server/api/submissions/IdSingle.php?id=${id}`;
    // fetch submitted tasks
    let res = await fetch(url);
    let data = await res.json();
    return data;
  }

  // get unregistered students
  async getUnregistered(){
    const url = 'http://localhost/404/server/api/students/unregistered.php';
    // fetch data tasks
    let res = await fetch(url);
    let data = await res.json();
    return data;
  }

  //accept student registeration
  async acceptStudent(id){
    const url = 'http://localhost/404/server/api/students/validate.php';
    // fetch data tasks
    let res = await fetch(url, {method: "PUT", body: JSON.stringify({id: id}) });
    let data = await res.json();
    return data;
  }

  //delete student
  async deleteStudent(id) {
    const url = 'http://localhost/404/server/api/students/delete.php';
    // fetch data tasks
    let res = await fetch(url, {method: "DELETE", body: JSON.stringify({id: id}) });
    let data = await res.json();
    return data;
  }

  //create Staff account
  async createStaffAccounts(account){
    const url = 'http://localhost/404/server/api/staffs/create.php';
    // send request
    let res = await fetch(url, {method: "POST", body: JSON.stringify({...account}) });
    let data = await res.json();
    return data;
  }

}
