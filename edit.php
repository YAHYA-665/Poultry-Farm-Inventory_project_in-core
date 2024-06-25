<?php

include_once("Crud.php");

$crud = new Crud();

$id = $crud->escape_string($_GET['id']);

$result = $crud->getData("SELECT * FROM users WHERE id=$id");

foreach ($result as $res) {
    $name = $res['name'];
    $quantity = $res['quantity'];
    $category = $res['category'];
    $pricing = $res['pricing'];
    $date = $res['date'];
}

?>

<html>
<head>
    <link rel="stylesheet" href="CSS/Dashboard.css">
    <title>Edit Data</title>
</head>

<body>
<br/>
<h2 style="text-align: center">Update your inventory</h2>
<a class="home" href="index.php">Home</a>
<br/><br/>

<form name="form1" method="post" action="editaction.php">
    <table style="width: 25%; border: 0">
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="number" name="quantity" value="<?php echo $quantity; ?>"></td>
        </tr>
        <tr>
            <td>Category</td>
            <td><select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Medicines" <?php echo ($category === 'Medicines') ? 'selected' : ''; ?>>Medicines</option>
                    <option value="Eggs" <?php echo ($category === 'Eggs') ? 'selected' : ''; ?>>Eggs</option>
                    <option value="Breed" <?php echo ($category === 'Breed') ? 'selected' : ''; ?>>Breed</option>
                    <option value="Feed" <?php echo ($category === 'Feed') ? 'selected' : ''; ?>>Feed</option>
                    <option value="Chicks" <?php echo ($category === 'Chicks') ? 'selected' : ''; ?>>Chicks</option>
                    <option value="Medications" <?php echo ($category === 'Medications') ? 'selected' : ''; ?>>Medications</option>
                    <option value="Equipment" <?php echo ($category === 'Equipment') ? 'selected' : ''; ?>>Equipment</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Pricing</td>
            <td><input type="number" name="pricing" value="<?php echo $pricing; ?>"></td>
        </tr>
        <tr>
            <td>Entry Date</td>
            <td><input type="date" name="entry_date" value="<?php echo $date; ?>"></td>
        </tr>

<!--        <tr>-->
<!--            <td>Stock In Quantity</td>-->
<!--            <td><input type="number" name="stock_in_quantity" placeholder="Stock In Quantity"></td>-->
<!--        </tr>-->
<!--        -->
<!--        <tr>-->
<!--            <td>Stock Out Quantity</td>-->
<!--            <td><input type="number" name="stock_out_quantity" placeholder="Stock Out Quantity"></td>-->
<!--        </tr>-->
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
            <td><input type="submit" name="update" value="Update"></td>
        </tr>
    </table>
</form>
</body>
</html>
