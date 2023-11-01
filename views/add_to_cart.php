<?php
require '../global/conn.php';
require '../global/func.php';

// Include your database connection code here
if (isset($_SESSION['user_login'])) {
    $user_id = $_SESSION['user_login'];
} else {
    $user_id = ''; // or any default value you want
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION['user_login'])) {
        // Get product_id and quantity from the form
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $conn = conndb();

        // Query the carts table to check if a cart item with the same user_id and product_id exists
        $sql = "SELECT * FROM carts WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $cartItem = $stmt->fetch();

        if ($cartItem) {
            // The cart item already exists, update it with new quantity and total
            $newQuantity = $cartItem['quantity'] + $quantity;
            $newTotal = $newQuantity * $cartItem['total'];
            $updated_at = date('Y-m-d H:i:s');
            
            $updateSql = "UPDATE carts SET quantity = :quantity, total = :total, updated_at = :updated_at WHERE user_id = :user_id AND product_id = :product_id";

            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':quantity', $newQuantity);
            $updateStmt->bindParam(':total', $newTotal);
            $updateStmt->bindParam(':user_id', $user_id);
            $updateStmt->bindParam(':product_id', $product_id);
            $updateStmt->bindParam(':updated_at', $updated_at);
            
            if ($updateStmt->execute()) {
                // Cart item successfully updated
                echo "Cart item updated";
                header("refresh: 1; url=http://localhost/mini-project-yrs3/mini-project/views/products_view.php?product_id=" . $product_id);
            } else {
                // Handle the update error
                echo "Error: " . $updateStmt->errorInfo();
                header("refresh: 1; url=http://localhost" . $_SESSION['current_page']);
            }
        } else {
            // The cart item doesn't exist, insert a new record
            $product = getProductDetails($conn, $product_id);
            
            if ($product) {
                // Calculate the total cost based on the product's price and quantity
                $total = $product['price'] * $quantity;
                
                $status = "active";
                $created_at = date('Y-m-d H:i:s');
                $updated_at = date('Y-m-d H:i:s');
                
                $insertSql = "INSERT INTO carts (user_id, product_id, quantity, total, status, created_at, updated_at)
                        VALUES (:user_id, :product_id, :quantity, :total, :status, :created_at, :updated_at)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bindParam(':user_id', $user_id);
                $insertStmt->bindParam(':product_id', $product_id);
                $insertStmt->bindParam(':quantity', $quantity);
                $insertStmt->bindParam(':total', $total);
                $insertStmt->bindParam(':status', $status);
                $insertStmt->bindParam(':created_at', $created_at);
                $insertStmt->bindParam(':updated_at', $updated_at);
                
                if ($insertStmt->execute()) {
                    // Cart item successfully added
                    echo "Cart item added";
                    header("refresh: 1; url=http://localhost" . $_SESSION['current_page']);
                } else {
                    // Handle the insertion error
                    echo "Error: " . $insertStmt->errorInfo();
                    header("refresh: 1; url=http://localhost" . $_SESSION['current_page']);
                }
            } else {
                // Handle the case where the product doesn't exist
                echo "Product not found.";
                header("refresh: 1; url=http://localhost" . $_SESSION['current_page']);
            }
        }
    } else {
        // Handle the case where user_id is not valid or not available
        echo "Invalid user or not logged in. Insert/Update canceled.";
        header("location: ../views/login.php");
    }
} else {
    // Handle the case where the request method is not POST
    echo "Invalid request method.";
    header("refresh: 1; url=http://localhost" . $_SESSION['current_page']);
}

function getProductDetails($conn, $product_id) {
    // Query the product details based on product_id
    $sql = "SELECT price FROM products WHERE product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    return $stmt->fetch();
}
?>