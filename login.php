<?php
include 'dbconnection.php';

$email = 'debbys@gmail.com';
$password = 'supersecretpassword';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the user into the database
$query = "INSERT INTO signin (email, password) VALUES ($1, $2)";
$result = pg_query_params($dbconn, $query, array($email, $hashed_password));

if (!$result) {
        die("Query failed: " . pg_last_error()); // Check if query fails
    }

    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            header("Location: dashboard.php");
            exit;
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "User not found.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Login</h1>
         <?php if (isset($_GET['error']) && isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger">
                 <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <input type="submit" name="login" value="Login" class="btn btn-primary">
        </form>
    </div>
</body>
</html>
