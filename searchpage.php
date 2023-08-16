<?php
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_name = $_POST['search_name'];

    $query = "SELECT * FROM usersdata WHERE name ILIKE $1";
    $result = pg_query_params($dbconn, $query, array("%$search_name%"));

    if (!$result) {
        $message = "Error retrieving data: " . pg_last_error();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>User Search</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Search Users</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="search_name">Search by Name:</label>
                <input type="text" class="form-control" name="search_name" required>
            </div>
            <input type="submit" value="Search" class="btn btn-primary">
        </form>
        <?php if (isset($result) && pg_num_rows($result) > 0): ?>
            <h2>Search Results</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Occupation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = pg_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['occupation']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif (isset($message)): ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
