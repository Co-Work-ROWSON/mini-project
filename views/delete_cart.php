<?php
// Include the necessary database connection code.
require '../global/conn.php';

if (isset($_POST['delete_item'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    print_r($product_id);
    print_r($user_id);
    // Perform the deletion in your database. You should adapt this to your database structure.
    $deleteQuery = "DELETE FROM carts WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $conn = conndb();

    $result = $conn->query($deleteQuery);

    if ($result) {
        echo 'Deletion was successful.';
        header("refresh: 1; url=http://localhost/".$_SESSION['current_page']);
        exit;
    } else {
        // Handle any errors that might occur during the deletion.
        // You can display an error message or redirect to an error page.
        echo "Failed to delete the item from the cart.";
        header("refresh: 1; url=http://localhost/".$_SESSION['current_page']);
    }
} else {
    // Handle cases where the 'delete_item' parameter is not set.
    // You can display an error message or redirect to an error page.
    echo "Invalid request.";
    header("refresh: 2; url=http://localhost/".$_SESSION['current_page']);
}
?>
