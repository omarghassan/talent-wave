document.addEventListener("DOMContentLoaded", function () {
    emailjs.init("rDXnoVX1oF94FtTu6"); 

    document.getElementById("contactForm").addEventListener("submit", sendMail);
});

function sendMail(event) {
    event.preventDefault(); 

    let name = document.getElementById("uname").value;
    let email = document.getElementById("email").value;
    let subject = document.getElementById("subject").value;
    // let plan = document.getElementById("plan").value;
    let message = document.getElementById("message").value;

    document.getElementById("loading").style.display = "block";

    emailjs.send("service_2btuga2", "template_0ttnq6j", {
        from_name: name,
        from_email: email,
        subject: subject,
        // plan: plan,
        message: message
    }).then(function(response) {
        document.getElementById("loading").style.display = "none";
        document.getElementById("feedback").textContent = "✅ Your message was sent successfully!";
        // document.getElementById("contact-form").reset();
        document.getElementById("uname").value = "";
        document.getElementById("email").value = "";
        document.getElementById("subject").value = "";
        // document.getElementById("plan").value = "";
        document.getElementById("message").value = "";
    }).catch(function(error) {
        document.getElementById("loading").style.display = "none";
        document.getElementById("feedback").textContent = "There was a transmission error. Try again.";
        console.log(error);
    });

}