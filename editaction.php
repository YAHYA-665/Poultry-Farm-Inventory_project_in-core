<?php

include_once("Crud.php");
include_once("Validation.php");

$crud = new Crud();
$validation = new Validation();

if(isset($_POST['update']))
{
    $id = $_POST['id'];

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $pricing = $_POST['pricing'];
    $entry_date = date('Y-m-d');

    $msg = $validation->check_empty($_POST, array('name', 'quantity', 'category', 'pricing'));
    $check_quantity = $validation->is_quantity_valid($quantity);
    $check_category = $validation->is_category_valid($category);
    $check_category = true;
//    $check_pricing = $validation->is_pricing_valid($pricing);
//    $check_pricing = true;

    if($msg) {
        echo $msg;
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } elseif (!$check_quantity) {
        echo 'Please provide proper quantity.';
    } elseif (!$check_category) {
        echo 'Please provide proper category.';
//    } elseif (!$check_pricing) {
//        echo 'Please provide proper pricing.';
    } else {
        $result = $crud->updateUserData($id, $name, $quantity, $category, $pricing, $entry_date);
        if($result) {
            echo "<font color='green'>Data updated successfully.";
            header("Location: index.php");
        } else {
            echo "Error updating data.";
        }
    }
}
?>
