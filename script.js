
function toggleMenu() {
    const menu = document.querySelector('.menu');
    menu.classList.toggle('active');
}




  function validateForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let reason = document.getElementById("reason").value;
    let date = document.getElementById("date").value;
    let time = document.getElementById("time").value;
    let description = document.getElementById("description").value.trim();
    let mode = document.getElementById("consultation-mode").value;

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let phonePattern = /^[0-9]{10,15}$/;

    if (name === "" || email === "" || phone === "" || reason === "" || date === "" || time === "" || description === "" || mode === "") {
      alert("All fields are required!");
      return false;
    }
    if (!emailPattern.test(email)) {
      alert("Enter a valid email address.");
      return false;
    }
    if (!phonePattern.test(phone)) {
      alert("Enter a valid phone number (10-15 digits).");
      return false;
    }

    return true;
  }

