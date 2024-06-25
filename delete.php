<?php
include_once("Crud.php");
class DeleteUser
{
    private $crud;
    public function __construct()
    {
        $this->crud = new Crud();
    }
    public function deleteUser($id)
    {
        $id = $this->crud->escape_string($id);
        $result = $this->crud->delete($id, 'users');

        return $result;
    }
}

$deleteUser = new DeleteUser();

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $result = $deleteUser->deleteUser($id);

    if ($result) {
        header("Location:index.php");
        exit();
    } else {
        echo "Error deleting user.";
    }
} else {
    echo "Invalid user ID.";
}
?>
