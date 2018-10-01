class Guard {
  constructor() {
    // get authentication info
    this.student = localStorage.getItem("student_auth")
      ? JSON.parse(localStorage.getItem("student_auth"))
      : false;

    this.committee = localStorage.getItem("committee_auth")
      ? JSON.parse(localStorage.getItem("committee_auth"))
      : false;
    this.head = localStorage.getItem("head_auth")
      ? JSON.parse(localStorage.getItem("head_auth"))
      : false;
  }

  //student Guard
  studentAuth() {
    if (this.student.Token) {
      return true;
    } else {
      return false;
    }
  }

  //Committee Guard
  committeeAuth() {
    if (this.committee.Token) {
      return true;
    } else {
      return false;
    }
  }

  // Head guard
  headAuth() {
    if (this.head.Token) {
      return true;
    } else {
      return false;
    }
  }

  //get student id
  getStudentId() {
    const student = JSON.parse(localStorage.getItem("student_auth"));
    return student.id;
  }

  //get head id
  getHeadId() {
    const head = JSON.parse(localStorage.getItem("head_auth"));
    return head.id;
  }

  //get staff id
  getstaffId() {
    const staff = JSON.parse(localStorage.getItem("committee_auth"));
    return staff.id;
  }
  // get student Name
  getStudentName(){
    const student = JSON.parse(localStorage.getItem("student_auth"));
    return student.name;
  }
  // Get Head Name
  getHeadName(){
    const head = JSON.parse(localStorage.getItem("head_auth"));
    return head.name;
  }
  // Get Staff Name
  getStaffName(){
    const staff = JSON.parse(localStorage.getItem("committee_auth"));
    return staff.name;
  }
}
