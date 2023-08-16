<?php
include 'dbconnection.php';

$password1 = password_hash("Oluwakemi@2", PASSWORD_DEFAULT);
$password2 = password_hash("@@UNITEDforever#123", PASSWORD_DEFAULT);
$password3 = password_hash("@UNITEDforever##456", PASSWORD_DEFAULT);

$query1 = "INSERT INTO public.login (id, email, password) VALUES (1, 'debbys@gmail.com', '$password1');";
$query2 = "INSERT INTO public.login (id, email, password) VALUES (2, 'debbysconty@gmail.com', '$password2');";
$query3 = "INSERT INTO public.login (id, email, password) VALUES (3, 'debbyk@yahoo.com', '$password3');";

$result1 = pg_query($dbconn, $query1);
$result2 = pg_query($dbconn, $query2);
$result3 = pg_query($dbconn, $query3);

if (!$result1 || !$result2 || !$result3) {
    die("Query failed: " . pg_last_error());
}
?>
