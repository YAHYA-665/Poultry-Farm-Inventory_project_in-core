<?php
include_once 'Crud.php';

session_start();
//$_SESSION['success_message'] = "Stock-out successful";

$crud = new Crud();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];


    $result = $crud->stockOutItem($name, $quantity);

    if ($result) {
        $_SESSION['success_message'] = "Stock-out successful";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Stock-out operation failed.";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Dashboard.css">
    <title>Stock Out</title>
</head>
<body>
<br/>
<h3 style="text-align: center">Stock-out</h3>
<a class="home" href="index.php">Home</a>
<form style="width: 25%; border: 0; margin-left: 10%" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Item Name:</label>
    <input type="text" name="name" required><br><br>
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" required><br><br>
    <input type="submit" value="Stock Out">
</form>
</body>
</html>
