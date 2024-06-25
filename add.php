<?php
include_once("Crud.php");
include_once("Validation.php");

$crud = new Crud();
$validation = new Validation();

if(isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $pricing = $_POST['pricing'];
    $date = $_POST['date'];


    $existingNames = $crud->getAllUserNames();
    if (in_array($name, $existingNames)) {
        echo "Name already exists. Please enter a different name.";
        exit();
    }


    $msg = $validation->check_empty($_POST, array('name', 'quantity', 'category', 'pricing'));
    $check_quantity = $validation->is_quantity_valid($quantity);
    $check_category = $validation->is_category_valid($category);
    $check_category = true;

    if($msg != null) {
        echo $msg;
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } elseif (!$check_quantity) {
        echo 'Please provide proper quantity.';
    } elseif (!$check_category) {
        echo 'Please provide proper category.';
    } else {

        $result = $crud->insertUserWithPricingAndDate($name, $quantity, $category, $pricing, $date);

        if($result) {

            $crud->stockInItem($name, $quantity);


            header("Location: index.php?success=1");
            exit();
        } else {
            echo "Error adding data.";
        }
    }
}
?>
