<?php 
  require '../global/conn.php';
  require '../global/func.php';
  require '../global/header.php'; 
  
  $user = $_SESSION['user_login'];
  print_r($user);

if (!checkLogin()) {
    $link = "../views/login.php";
    $text = "Login / Register";
    $profile_img = '<ion-icon name="person-outline" aria-hidden="true"></ion-icon>';
} else {
    $link = "../views/profile.php";
    $text = "Profile";
}

if ($user) {
    $result = tablequery("SELECT * FROM users WHERE user_id = '$user'");
    
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if (!empty($row['user_image'])) {
            $profile_img = '<img src="../assets/images/upload/' . $row['user_image'] . '" width="22" height="22" loading="lazy"
            alt="' . $row['username'] . '" class="dummy-profile">';
        } else {
            $dummy_txt = strtoupper(substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1));
            $profile_img = '<div class="dummy-profile">
                <p class="dummy-profile-text">' . $dummy_txt . '</p>
            </div>';
        }
    } else {
        $profile_img = '<ion-icon name="person-outline" aria-hidden="true"></ion-icon>';
    }
}
?>

<!-- 
    - #HEADER
  -->
  <link rel="stylesheet" href="..\assets\css\style.css">
  <div class="page__overlay"></div>
  <header class="header" data-header>

  <div class="cart-container">
    <div class="cart" style="top: 0;">
      <div class="cart-top">Add To Card</div>
      <div class="cart-inner">
        <div class="cart-title">
          <span class="material-symbols-outlined" style="position: absolute; left: 0; top: 100%; width: 24px; height: 30px; margin-top: -15px; transform: translateY(-50%);">check_circle</span>
          <h2>Add to cart</h2>
        </div>
        <?php
if ($user) {
    $cart = tablequery("SELECT c.*, p.product_name, p.price, p.p_image
                        FROM carts c
                        JOIN products p ON c.product_id = p.product_id
                        WHERE c.user_id = '$user'");
    $rowCount = $cart->rowCount();
    $alltotal = 0; // Initialize the total price.

    if ($rowCount > 0) {
        echo '<div class="cart-item">';
        foreach ($cart as $row) {
            // Calculate the total for each item and add it to the overall total.
            $itemTotal = $row['price'] * $row['quantity'];
            $alltotal += $itemTotal;

            echo '<div class="cart-item-warpper">
            <div class="cart-item-img">
                <img src="../assets/images/' . $row['p_image'] . '" width="64px" height="64px" alt="" class="cart-img">
            </div>
            <div class="cart-item-detail">
                <form action="../views/delete_cart.php" method="post">
                <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                <input type="hidden" name="user_id" value="'.$row['user_id'].'">
                <button type="submit" class="delete-button" name="delete_item">
                <span class="material-symbols-outlined" style="position: absolute; width: 34px; height: 34px; background-position: -213px 0; 
                right: 4px; top: 4px; padding: 0; transform: scale(0.72); cursor: pointer;">close</span>
                </form>
                <p class="cart-item-name">
                    <a href="#" class="a-item-name"> ' . $row['product_name'] . ' </a>
                </p>
                <span class="cart-item-price">$ ' . $row['total'] . '</span>
            </div>
        </div>';
        }

        echo '</div>
        <div class="cart-bottom">
                <div class="cart-total">
                <h6>Total: <span class="cart-total-cast">$ ' . $alltotal . '</span></h6>
                </div>
                <div class="cart-button">
                  <a href="#" class="cart-btn2">View Cart(' . $rowCount . ')</a>
                  <a href="../views/allproduct.php" class="cart-btn1">Continue Shopping</a>
              </div>
            </div>';
    } else {
        echo '<div class="cart-item-empty">
        <p class="cart-text-empty">Your cart is empty</p>
        <div class="cart-button">
            <a href="../views/allproduct.php" class="cart-btn2">Start Shopping</a>
        </div>';
    }
} else {
    echo '<div class="cart-item-empty">
    <p class="cart-text-empty">Your cart is empty</p>
    <div class="cart-button">
        <a href="../views/allproduct.php" class="cart-btn2">Start Shopping</a>
    </div>
  </div>';
}
?>

      </div>
    </div>
  </div>


      <div class="search_resu" id="search-results"></div>
      
    <div class="container">
      <div class="overlay" data-overlay></div>

      <a href="../views/index.php" class="logo">
        <img src="../assets/images/fastlanelogo.svg" width="160" height="50" alt="FastLane logo">
      </a>

      <button class="nav-open-btn" data-nav-open-btn aria-label="Open Menu">
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <button class="nav-close-btn" data-nav-close-btn aria-label="Close Menu">
          <ion-icon name="close-outline"></ion-icon>
        </button>

        <a href="#" class="logo">
          <img src="../assets/images/fastlanelogo.svg" width="190" height="50" alt="FastLane logo">
        </a>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="../views/allproduct.php" class="navbar-link">All Shop</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link">Ready to ship</a>
          </li>
          
          <li class="navbar-item">
            <a href="#upcoming" class="navbar-link">Upcoming</a>
          </li>

          <li class="navbar-item">
            <a href="../global/main.php" class="navbar-link">About</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link">Contact</a>
          </li>

          <li class="navbar-item">
            <a href="../global/test.php" class="navbar-link">Test</a>
          </li>
        </ul>

        <ul class="nav-action-list">

        <li>
            <button class="nav-action-btn">
        <div class="search-box">
        <input checked="" class="checkbox" type="checkbox"> 
        <div class="mainbox">
            <div class="iconContainer">
            <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
            </div>
         <input class="search_input" placeholder="search" type="text" id="search">
        </div>
    </div>
          <span class="nav-action-text">Search</span>
            </button>
          </li>
<!--
          <li>
            <button class="nav-action-btn">
              
            <ion-icon name="search-outline" aria-hidden="true"></ion-icon>

              <span class="nav-action-text">Search</span>
            </button>
          </li>
-->
          <li>
            <a href="<?=$link?>" class="nav-action-btn">
              <?=$profile_img?>

              <span class="nav-action-text"><?=$text?></span>
            </a>
          </li>

          <li>
            <a href="#" class="nav-action-btn">
              <ion-icon name="heart-outline" aria-hidden="true"></ion-icon>

              <span class="nav-action-text">Wishlist</span>

              <data class="nav-action-badge" value="5" aria-hidden="true">5</data>
            </a>
          </li>

          <li>
            <button class="nav-action-btn" id="cart-icon">
            <ion-icon name="bag-outline" aria-hidden="true"></ion-icon>
                
              <data class="nav-action-text" value="318.00">Basket: <strong>$318.00</strong></data>

              <data class="nav-action-badge" value="4" aria-hidden="true">4</data>
            </button>
          </li>

        </ul>

      </nav>
      
    </div>
  </header>
    
<?php require '../global/footer.php'; ?>


  <!-- 
    - #GO TO TOP
  -->
  <a href="#top" class="go-top-btn" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>



  <!-- 
    - custom js link
  -->
  <script src="../assets/js/script.js"></script>


  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


  <!-- 
    - tailwindcss link
  -->
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>