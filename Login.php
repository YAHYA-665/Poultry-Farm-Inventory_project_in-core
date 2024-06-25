<?php
include_once 'Crud.php';

$crud = new Crud();

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password match in the database
    $result = $crud->loginUser($username, $password);

    if ($result) {
        $_SESSION['username'] = $username; // Set the session variable
        header("Location: index.php"); // Redirect to the main page
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="CSS/Dashboard.css">
    <title>Login</title>
</head>
<body>

    <form style="width: 25%; border: 0; margin-left: 10%" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>

</body>
</html>