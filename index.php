<?php
include_once("Crud.php");

session_start();
if (isset($_SESSION['success_message']) && $_SESSION['success_message'] != "") {
    echo "<div style='color: green; margin-left: 20px; margin-top: 20px'>$_SESSION[success_message]</div>";
    unset($_SESSION['success_message']);
}

$crud = new Crud();

$query = "SELECT * FROM users ORDER BY id DESC";
$result = $crud->getData($query);


?>

<html>
<head>
    <link rel="stylesheet" href="CSS/Dashboard.css">
    <title>Homepage</title>
</head>
<body>
<br/>
<h1 style="text-align: center">Poultry Farm inventory</h1>
<a class="add-new-data" href="add.html">Add New Stock</a><br/><br/>

<?php
if(isset($_SESSION['success']) && $_SESSION['success'] == 1) {
    echo "<p style='color: green; margin-left: 20px'>Data added successfully.</p>";
    unset($_SESSION['success']);
}
?>

<table style="width: 80%; border: 0; transform: translate(2px,30px);">
    <tr>
        <td>Name</td>
        <td>Quantity</td>
        <td>Category</td>
        <td>Pricing</td>
        <td>Date</td>
        <td>Stock-In-Out</td>
<!--        <td>Stock-Out</td>-->
        <td>Update</td>
    </tr>
    <?php
    if (is_array($result) || is_object($result))
    foreach ($result as $key => $res) {
        echo "<tr>";
        echo "<td>".$res['name']."</td>";
        echo "<td>".$res['quantity']."</td>";
        echo "<td>".$res['category']."</td>";
        echo "<td>".$res['pricing']."</td>";
        echo "<td>".$res['date']."</td>";
        echo "<td><a class='btn-stock-in' href=\"stock.php?id=$res[id]\">Stock-In-Out</a></td>";
//        echo "<td><a class='btn-stock-out' href=\"stock-out.php?id=$res[id]\">Stock-Out</a></td>";
        echo "<td><a class='btn-edit' href=\"edit.php?id=$res[id]\">Edit</a> | <a class='btn-delete' href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        echo "</tr>";
    }
    else {
        // Handle the case where $result is not an array or object
        echo "No results found";
    }
    ?>
</table>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            var successMessage = document.querySelector('.success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000);
    });
</script>

</body>
</html>

