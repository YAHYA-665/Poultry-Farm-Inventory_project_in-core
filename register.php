<?php
include_once 'Crud.php';

//session_start();

$crud = new Crud();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Hash the password before storing it in the database

    $result = $crud->registerUser($username, $password);

    if ($result) {
        echo "Registration successful!";
    } else {
        echo "Registration failed!";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="CSS/Dashboard.css">
    <title>Register</title>
</head>
<body>

    <form style="width: 25%; border: 0; margin-left: 10%" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register">
        <a <button></button></a>
    </form>

</body>
</html>