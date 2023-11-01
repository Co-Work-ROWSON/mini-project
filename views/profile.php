<?php 
    require '../global/conn.php';
    require '../global/func.php';
    require '../global/header.php'; 
    require '../global/menubar.php';

    if(!isset($_SESSION['user_login'])){
      //อย่าลืมทำalertให้เข้าสู่ระบบ
      header('location: login.php');
    }
    
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head><script src="../assets/js/color-modes.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.118.2">
<title>Profile</title>

<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <!-- Include jQuery -->
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

<!-- Add the SweetAlert library and its dependencies -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
   
      body {
        min-height: 100vh;
        min-height: -webkit-fill-available;
        background: var(--white);
        font-size: 1.6rem;
        padding-block-start: 90px;
        background: rgba(0,0,0,0.05);
      }

      html {
        height: -webkit-fill-available;
        font-family: var(--ff-josefin-sans);
        font-size: 10px;
        scroll-behavior: smooth;
      }

      main {
        height: 100vh;
        height: -webkit-fill-available;
        max-height: 1000vh;
        overflow-x: auto;
        overflow-y: hidden;
      }
      
      a{
        text-decoration: none;
        color: #000;
      }
     
      .scrollarea {
        overflow-y: auto;
      }


      

      
      

      
      .profile{
        position: fixed;
        width:25%;
        height: 45%;
        padding: 70px 30px 44px ;
        border-radius: 1rem;
        background: #fff;
        text-align: center;
        margin-top: 20px;
        margin-left: 10px;

      }
      .profile img {
        width: 120px;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 50%;
        margin: 0 auto; 
        display: block; 
        margin-bottom: 20px;
      }

      .pic{
        width: 120px;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 50%;
        margin: 0 auto; 
        display: block; 
        margin-bottom: 20px;
      }

      .profile h2{
        font-size: 32px;
        margin: 0 0 25px:
      }

      .profile p{
        color: rgba(0,0,0,0.38);
        margin: 0 0 6px;
        font-weight:500;
        font-size:1.5rem;
      }
      
      .buyer{
        position: fixed;
        width:25%;
        height: 45%;
        padding: 70px 30px 44px ;
        border-radius: 1rem;
        background: #fff;
        text-align: center;
        margin-top: 20px;
        margin-left: 10px;

      }
      .buyer h2{
        font-size: 32px;
        margin: 0 0 25px:
        padding: 70px 30px 44px;
      }

      .buyer p{
        color: rgba(0,0,0,0.38);
        margin: 0 0 6px;
        font-weight:500;
        font-size:1.5rem;
      }

      .seller{
        position: fixed;  
        width:25%;
        height: 45%;
        padding: 70px 30px 44px ;
        border-radius: 1rem;
        background: #fff;
        text-align: center;
        margin-top: 20px;
        margin-left: 10px;

      }
      .seller h2{
        font-size: 32px;
        margin: 0 0 25px:
      }

      .seller p{
        color: rgba(0,0,0,0.38);
        margin: 0 0 6px;
        font-weight:500;
        font-size:1.5rem;
      }
      
        
    </style>

</head>
<body>


    

    


<main class="d-flex flex-nowrap">
  

  <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 250px; height: calc(100vh - 90px);">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link link-body-emphasis" aria-current="page">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
          </svg>
          Profile
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
          </svg>
          Buying
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16">
            <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
            <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
          </svg>
          Selling
        </a>
      </li>
      <li>
        <a href="#" class="nav-link link-body-emphasis">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket" viewBox="0 0 16 16">
            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
          </svg>
          Coupon & rewards
        </a>
      </li>
      <hr>
      <li>
        <!-- Button trigger modal -->
        <button type="button" class="nav-link link-body-emphasis" data-bs-toggle="modal" data-bs-target="#deleteModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
          </svg>
          Delete account
        </button>

<!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <form action="deleteacc.php" method="POST" id="deleteForm">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Account?</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" name="password">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger" id="delete" name="deleteacc">Delete</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <script>
          document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("#deleteForm").addEventListener("submit", function (e) {
              e.preventDefault();

              Swal.fire({
                title: "Delete Account",
                text: "Are you sure to delete your account?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it",
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    type: "POST",
                    url: "deleteacc.php",
                    data: {
                      deleteacc: 1,
                      password: $("#inputPassword").val(),
                    },
                    success: function (response) {
                      if (response === "success") {
                        Swal.fire({
                          title: "Success",
                          text: "Your account has been successfully deleted.",
                          icon: "success",
                        }).then(() => {
                          // Redirect to the homepage after successful deletion
                          window.location.href = "../views/index.php";
                        });
                      } else {
                        Swal.fire("Error", "Wrong password!", "error");
                      }
                    },
                  });
                }
              });
            });
          });
        </script>



      <button class="nav-link link-body-emphasis" id="logout">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
        </svg>
        Logout
      </button>
      <script>
        $('#logout').on('click', function () {
          Swal.fire({
            title: "Logout?",
            text: "Do you want to logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
          }).then((result) => {
            if (result.isConfirmed) {
              'Logout!',
              'Your has been logout.',
              'success'
              window.location.href = '../views/logout.php';
            }
          })
        })
      </script>

        
      </li>
    </ul>
  </div>

  

      

  <div class="container text-center">
    <div class="row profile-container">
      <div class="col">
        <div class="profile" >
          <?php
          
          if(isset($_SESSION['user_login'])){
            $conn = conndb();
            $user_id = $_SESSION['user_login'];

            $stmt = $conn->query("SELECT * from users WHERE user_id = '$user_id'");
          
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
          }
          ?>
          
          <?php
            if($row['user_image'] == '') {
                echo '<img src="default-avatar.jpg">';
            } else {
                echo '<img src="../assets/images/upload/' . $row['user_image'] . '">';
            }
          ?>
          <h2><?php echo $row['username']?></h2>

          <p><?php echo $row['first_name'].' '.$row['last_name']?></p>

          <div class="position-absolute top-0 end-0">
            <!-- Button trigger modal -->
              <button type="button" class="btn btn-outline-secondary" style="margin:20px;" data-bs-toggle="modal" data-bs-target="#editModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                </svg>
                Edit profile
              </button>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="buyer" >
          <div class="position-absolute top-0 end-0">
            <button type="button" class="btn btn-outline-secondary" style="margin:20px;" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                  view
            </button>
          </div> 
          <h2>Buyer profile</h2>
        </div>
      </div>

      <div class="col">
        <div class="seller" >
          <div class="position-absolute top-0 end-0">
              <button type="button" class="btn btn-outline-secondary" style="margin:20px;" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                    view
              </button>
          </div> 
          <h2>Seller profile</h2>
        </div>
      </div>

    </div>
  </div>

</main>


<!-- Modal -->

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="editprofile.php" method="post" enctype="multipart/form-data"> 
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if($user_id){ ?>
        <?php }else{ 
          header('location: login.php');
          exit;
          ?>
        <?php } ?>
      <div class="mb-3" >
      <?php
        if($row['user_image'] == '') {
            echo '<img src="default-avatar.jpg" class="pic">';
          }else{
            echo '<img src="../assets/images/upload/'.$row['user_image'].'"  class="pic">'; 
          }
        ?>
        <label for="formFile" class="form-label">Profile</label>
        <input type="file" class="form-control" name="imgfile" id="formFile" accept="image/jpeg, image/png, image/jpg" >
      </div>
      <div class=" mb-3">
        <label for="formFile" class="form-label">Username</label>
        <input type="text" class="form-control" value="<?php echo $row['username']?>"  name="username" >
      </div>
      <div class="mb-3">
        <label for="formFile" class="form-label">First name & Last name</label>
        <input type="text" class="form-control" value="<?php echo $row['first_name']?>" name="firstname">
        <input type="text"  class="form-control" value="<?php echo $row['last_name']?>" name="lastname" style="margin-top:2px;">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email</label>
        <input class="form-control" type="email" value="<?php echo $row['email']?>" name="email" aria-label="readonly input example" readonly>
        
      </div>
      <div class="mb-3">
        <label for="formFile" class="form-label">Date Of Birth</label>
        <input type="date"  class="form-control" value="<?php echo $row['date_of_birth']?>" name="dob">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
        <input type="text"  class="form-control" value="<?php echo $row['address']?>" name="address" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="editprofile" class="btn btn-primary" id="saveChangesButton" disabled>Save changes</button>
      </div>
    </from>
    </div>
    <div class="row">
      
  </div>
</div>




<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Get the "Save changes" button
    const saveChangesButton = document.getElementById('saveChangesButton');

    // Get all the input fields
    const inputFields = document.querySelectorAll('.form-control');

    // Function to enable the button when any input field changes
    function enableSaveButton() {
      saveChangesButton.disabled = false;
    }

    // Add an event listener to each input field
    inputFields.forEach(function (inputField) {
      inputField.addEventListener('input', enableSaveButton);
    });
  });

            /* global bootstrap: false */
      (() => {
        'use strict'
        const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(tooltipTriggerEl => {
          new bootstrap.Tooltip(tooltipTriggerEl)
        })
      })()



  

    </script>

<!-- 
    
ionicon link--><script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script><script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>