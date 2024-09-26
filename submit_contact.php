<?php
// submit_contact.php: Handle form submission and insert data into MySQL

// Enable error reporting
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

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['user_id']) && isset($_POST['subject']) && isset($_POST['message'])) {
        
        // Capture form data
        $email = $conn->real_escape_string($_POST['user_id']);  // Treat user_id as email
        $subject = $conn->real_escape_string($_POST['subject']);
        $message = $conn->real_escape_string($_POST['message']);
        
        // Provide a default name value as the form does not collect a name
        $default_name = "Unknown";

        // Insert new user with default name
        $insert_user = "INSERT INTO Users (name, email) VALUES ('$default_name', '$email')";
        if ($conn->query($insert_user) === TRUE) {
            $user_id = $conn->insert_id;  // Get the inserted user's ID
        } else {
            echo "Error inserting user: " . $conn->error;
            exit();
        }

        // Insert message into ContactFormSubmissions table
        $sql = "INSERT INTO ContactFormSubmissions (user_id, subject, message) 
                VALUES ('$user_id', '$subject', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Message sent successfully!');</script>";
        } else {
            echo "Error: " . $conn->error;
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
