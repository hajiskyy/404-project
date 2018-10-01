const staffId = document.querySelector("#staffId");
const firstName = document.querySelector("#firstName");
const lastName = document.querySelector("#lastName");
const password = document.querySelector("#password");
const form = document.querySelector("#accountForm");

form.addEventListener("submit", (e) => {
    e.preventDefault()
    createAccount();
})

async function createAccount() {
    const api = new Api();
    let account = {
        id: staffId.value,
        firstName: firstName.value,
        lastName: lastName.value,
        password: password.value
    }

    let res = await api.createStaffAccounts(account);
    const ui = new UI()
    if(res.status == "error"){
        ui.displayError(res.msg)
    } else {
        ui.dispalySuccess(res.msg);
    }

    staffId.value = "";
    firstName.value = "";
    lastName.value = "";
    password.value = "";
} 
