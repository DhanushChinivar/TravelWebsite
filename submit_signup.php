<?php
// submit_signup.php: Handle sign-up form submission

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "127.0.0.1";  // Or your server address
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password (often empty for localhost)
$dbname = "oceans_forever";
$port = 3307;  // Set the correct port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        // Retrieve form data safely
        $user_id  = $conn->real_escape_string($_POST['user_id']);
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);

        // Prepare SQL query to insert data
        $sql = "INSERT INTO users (user_id, name, email, phone) VALUES ('$user_id','$name', '$email', '$phone')";

        // Execute the query and check if the insertion was successful
        if ($conn->query($sql) === TRUE) {
            // Notify that data was successfully inserted
            echo "<script>alert('Data has been successfully inserted into the database!');</script>";
        } else {
            // Notify of any error
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "Required form data is missing!";
    }
} else {
    echo "Invalid request method!";
}

// Close the database connection
$conn->close();
?>
