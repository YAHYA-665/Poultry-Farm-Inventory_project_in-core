<?php
include_once 'Crud.php';

session_start();

$crud = new Crud();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['stock_in'])) {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];

        // Perform stock-in operation
        $result = $crud->stockInItem($name, $quantity);

        if ($result) {
            $_SESSION['success_message'] = "Stock-in successful for '$name'";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: Stock-in operation failed.";
        }
    } elseif (isset($_POST['stock_out'])) {
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];

        // Perform stock-out operation
        $result = $crud->stockOutItem($name, $quantity);

        if ($result) {
            $_SESSION['success_message'] = "Stock-out successful for '$name'";
            header("Location: index.php");
            exit();
        } else {
            echo "Error: Stock-out operation failed.";
        }
    }
}

// Fetch item name based on ID from the URL
if (isset($_GET['id'])) {
    $id = $crud->escape_string($_GET['id']);
    $result = $crud->getData("SELECT * FROM users WHERE id=$id");

    if ($result) {
        $name = $result[0]['name']; // Assuming 'name' is a field in your 'users' table
    } else {
        $name = ''; // Handle case where no data is found (optional)
    }
} else {
    $name = ''; // Handle case where ID is not provided in the URL (optional)
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Dashboard.css">
    <title>Stock Operations</title>
</head>
<body>
<h2 style="text-align: center">Stock Operations</h2>
<a class="home" href="index.php">Home</a>
<form style="width: 25%; border: 0; margin-left: 10%" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name:</label>
    <span><?php echo htmlspecialchars($name); ?></span><br><br>
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" required><br><br>
    <input id="btn-stock-inn" type="submit" name="stock_in" value="Stock In">
    <input id="btn-stock-out" type="submit" name="stock_out" value="Stock Out">
</form>
</body>
</html>
