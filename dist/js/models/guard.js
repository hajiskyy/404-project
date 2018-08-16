class Guard {
    constructor(){
        this.student = JSON.parse(localStorage.getItem("student_auth"));
        console.log(this.student);
        this.committee = JSON.parse(localStorage.getItem("student_auth"))
        this.head = JSON.parse(localStorage.getItem("student_auth"))
    }

    //student Guard
    studentAuth(){
        if(this.student.Token){
            return true
        } else {
            return false
        }
    }
    
    //Committee Guard
    committeeAuth(){
        if(this.committee.Token){
            return true
        } else {
            return false
        }
    }

    // Head guard
    headAuth(){
        if(this.head.Token){
            return true
        } else {
            return false
        }
    }
}