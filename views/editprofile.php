<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

<?php
require_once '../global/conn.php';

if (isset($_POST['editprofile'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    $conn = conndb();
    $user_id = $_SESSION['user_login'];

    if (isset($_FILES['imgfile']['name']) && !empty($_FILES['imgfile']['name'])) {
        $date1 = date("Ymd_His");
        $numrand = (mt_rand());
        $upload = $_FILES['imgfile']['name'];

        $typefile = strrchr($_FILES['imgfile']['name'], ".");

        if ($typefile == '.jpg' || $typefile == '.jpeg' || $typefile == '.png') {
            $path = "../assets/images/upload/";
            $newname = $numrand . $date1 . $typefile;
            $path_copy = $path . $newname;
            move_uploaded_file($_FILES['imgfile']['tmp_name'], $path_copy);

            // Update both image and user information
            $stmt = $conn->prepare("UPDATE users SET username=:username, email=:email, first_name=:firstname, last_name=:lastname, date_of_birth=:dob, address=:address, user_image=:newname WHERE user_id=:user_id");
            $stmt->bindParam(":newname", $newname);
            $stmt->bindParam(":user_id", $user_id);
        } else {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "File not correct",
                        type: "error"
                    },function() {
                        window.location = "profile.php"; 
                    });
                }, 1000);
            </script>';
            // Optionally, you may want to exit here to prevent further execution
            exit;
        }
    } else {
        // Update user information without changing the image
        $stmt = $conn->prepare("UPDATE users SET username=:username, email=:email, first_name=:firstname, last_name=:lastname, date_of_birth=:dob, address=:address WHERE user_id=:user_id");
    }

    // Common parameter binding
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":dob", $dob);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":user_id", $user_id);

    // Execute the statement
    $result = $stmt->execute();

    if ($result) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Update Success",
                    type: "success"
                }, function() {
                    window.location = "profile.php"; 
                });
            }, 1000);
        </script>';
    } else {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "Error!",
                    type: "error"
                },function() {
                    window.location = "profile.php"; 
                });
            }, 1000);
        </script>';
    }
}
?>
