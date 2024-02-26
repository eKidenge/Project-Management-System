<?php
session_start();

$errmsg_arr = array();
$errflag = false;

include('db.php');

$user = mysqli_real_escape_string($conn, $_POST['user']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

$query = mysqli_query($conn, "SELECT * FROM users NATURAL JOIN employee WHERE username='$user' AND io='1'");
$count = mysqli_num_rows($query);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $name = $row['firstname'] . ' ' . $row['lastname'];

        if (password_verify($pass, $row['password'])) {
            session_regenerate_id();
            $_SESSION['ID'] = $row['eid'];
            $_SESSION['UID'] = $row['uid'];
            $_SESSION['TYPE'] = $row['user_type'];
            $_SESSION['NAME'] = $name;

            echo "true"; // User is authenticated
            exit(); // Terminate script
        }
    }
} else {
    // User not found, so let's proceed with registration
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $registration_query = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$user', '$hashed_password')");

    if ($registration_query) {
        // Registration successful
        echo "registered";
        exit(); // Terminate script
    } else {
        // Registration failed
        echo "registration_failed";
        exit(); // Terminate script
    }
}

// Handle case where neither login nor registration is successful
echo "login_failed";
exit(); // Terminate script
?>
