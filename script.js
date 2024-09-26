function validateForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let subject = document.getElementById("subject").value;
    let message = document.getElementById("message").value;

    let valid = true;

    // Name validation
    if (name === "" || name.length > 100) {
        document.getElementById("nameError").innerHTML = "Please enter your name";
        document.getElementById("nameError").style.color = "red";
        valid = false;
    } else {
        document.getElementById("nameError").innerHTML = "Valid Name entered";
        document.getElementById("nameError").style.color = "green";
    }

    // Email validation
    if (!/^[a-zA-Z0-9._%+-]+@gmail.com$/.test(email)) {
        document.getElementById("emailError").innerHTML = "Please enter your email.";
        document.getElementById("emailError").style.color = "red";
        valid = false;
    } else {
        document.getElementById("emailError").innerHTML = "Valid Email Entered";
        document.getElementById("emailError").style.color = "green";
    }

    // subject validation
    if (subject ==="" || subject.length>100) {
        document.getElementById("subjectError").innerHTML = "Please enter your subject";
        document.getElementById("subjectError").style.color = "red";
        valid = false;
    } else {
        document.getElementById("subjectError").innerHTML = "Valid subject";
        document.getElementById("subjectError").style.color = "green";
    }

    // Message validation
    if (message ==="" || message.length>500) {
        document.getElementById("messageError").innerHTML = "Please enter your message";
        document.getElementById("messageError").style.color = "red";
        valid = false;
    } else {
        document.getElementById("messageError").innerHTML = "Valid Message";
        document.getElementById("messageError").style.color = "green";
    }

    // If form is valid, alert success
    if (valid) {
        alert("Form submitted successfully!");
    }
}

function resetForm() {
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("subjectError").innerHTML = "";
    document.getElementById("messageError").innerHTML = "";

}
