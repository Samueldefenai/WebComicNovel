<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $validUser = ($username === "samuel" && $password === "123");

    if ($validUser) {
        // Redirect to the main page after successful login
        header("Location: halaman_utama.html"); 
        exit();
    } else {
        echo "Login failed. Please check your username and password.";
    }
}

?>