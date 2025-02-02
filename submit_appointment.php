<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "law_firm_appointments";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function cleanInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $phone = cleanInput($_POST['phone']);
    $reason = cleanInput($_POST['reason']);
    $appointment_date = cleanInput($_POST['appointment_date']);
    $appointment_time = cleanInput($_POST['appointment_time']);
    $description = cleanInput($_POST['description']);
    $consultation_mode = cleanInput($_POST['consultation_mode']);

    // Server-side validation
    if (empty($name) || empty($email) || empty($phone) || empty($reason) || empty($appointment_date) || empty($appointment_time) || empty($description) || empty($consultation_mode)) {
        die("Error: All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        die("Error: Invalid phone number.");
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, reason, appointment_date, appointment_time, description, consultation_mode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $phone, $reason, $appointment_date, $appointment_time, $description, $consultation_mode);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment successfully scheduled!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
