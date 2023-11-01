<?php
ob_start(); 
if (!isset($_GET['product_id'])) {
  header("refresh: 10; http://localhost/mini-project-yrs3/mini-project/views/404.php");
  exit; // Exit to prevent further code execution
}
$getid = $_GET['product_id'];

$_SERVER['pervious_page'] = $_SERVER['PHP_SELF'];

if (isset($_POST['add_to_cart'])) {
  $product_id = $getid;
  $user_id = $_SESSION['user_login']; // Replace with your user session variable
  $quantity = $_POST['quantity']; // You should add the quantity input in your form
  $total = $row['price']; // Get the price from your product data
  $status = "active";
}

require '../global/conn.php'; // Assuming this is a PDO database connection script
require '../global/func.php';
require '../global/header.php';
require '../global/menubar.php';
//print_r($_SESSION['user_login']);
//var_dump(checklogin());

$conn = conndb(); // Assuming conndb() returns a PDO connection
$sql = "SELECT p.*, c.category_name, b.carbrand_name FROM products p
      LEFT JOIN categories c ON p.category_id = c.category_id
      LEFT JOIN carbrands b ON p.carbrand_id = b.carbrand_id
      WHERE product_id = '$getid'";

$result = $conn->query($sql);

if ($result) {
  $row = $result->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
      // Handle the case where no result is found
      header("Location: ../views/404.php");
      exit; // Exit to prevent further code execution
  }

  // Use the $row data as needed
} else {
  // Handle any database query errors
  echo "Database error: " . $conn->error;
}

if (isset($_POST['add_to_cart'])) {
  $product_id = $getid;
  $user_id = $_SESSION['user_login']; // Replace with your user session variable
  $quantity = $_POST['quantity']; // You should add the quantity input in your form
  $total = $row['price']; // Get the price from your product data
  $status = "active";
}
ob_end_flush();
?>

<main>
<article>
<link rel="stylesheet" href="..\assets\css\product_view.css">
        <section class="sectionp">
            <div class="product-view">
                <div class="product-image">
                    <img src="../assets/images/<?=$row['p_image']?>" alt="Product image">
                </div>

                <div class="product-info">
                  <div class="product name">
                    <h1 class="product-name"><?=$row['product_name']?></h1>
                    <p class="prod-name"><?=$row['category_name']?> | <?=$row['carbrand_name']?></p>
              </div>
              <hr class="hr-product">

                    <div class="product-price">
                        <div class="price ask">
                          <p class="p price-1">LOWEST ASK</p>
                          <p class="p price-2">฿ <?=$row['price']?></p>
                        </div>
                        <div class="price bid">
                          <p class="price-1">HIGHEST BIT</p>
                          <p class="price-2">---</p>
                        </div>
                        <div class="price last-sale">
                          <p class="price-1">LAST SALE</p>
                          <p class="price-2">---</p>
                        </div>
                    </div>
                    <hr class="hr-product">

                    <div class="product tag">
                      <p class="tag-head"> Available listing </p>
                      
                      <ul class="tag-list">
                        <li class="tag-list-item">
                      
                        <div class="tag-icon">
                          <div class="tag-icon-img">
                            <img src="../assets/images/service-1.png" width="53" height="28" loading="lazy" class="icon-img" alt="Service icon">
                          </div>
                    </div>
                      <p class="tag-discription"> Ready to ship </p>                     
                        
                    </li>
                      </ul>
                    </div>
                    <hr class="hr-product">

                    <div class="product-logis">
                      <p class="logis-head"> Shipping Delivery </p>
                      
                      <div class="logis-item">
                      <span class="material-symbols-outlined" style="color: #00aa00;">bolt</span>
                      
                      <div class="logis-type">
                        <p class="logis-name">Express delivery</p>
                        <p class="logis-detail">Schedule delivery after authentication</p>
                        </div>
                      </div>

                      <div class="logis-item">
                        <span class="material-symbols-outlined" style="color: #00aa00;">package_2</span>
                      <div class="logis-type">
                        <p class="logis-name">Standard delivery</p>
                        <p class="logis-detail">Ship via logistic partner (2-4 days)</p>
                        </div>
                      </div>
                    <?php

                      $result = tablequery('SELECT b.*, p.Release_Date FROM bannerlists b join products p on b.product_id = p.product_id WHERE p.Release_Date order by p.Release_Date DESC ');
                      $result = $conn->query($sql);
                      $releaseDate = strtotime($row['Release_Date']);
                      $currentTime = time();

                      if($releaseDate > $currentTime){
                        echo '<div class="logis_alert">
                        <div class="logis-alert-detail" >
                      <span class="material-symbols-outlined" style= "color: rgb(211, 47, 47);">error</span>
                      <span class="span">New drops items may experience slight delay according to the distributor</span>
                      </div>  
                    </div>

                    <hr class="hr-product">
                    <form action="#" method="post">
                    <div class="product-action">
                      <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                   <input type="hidden" name="quantity" value="1">
        <button class="sell-btn" type="submit" id="sell-product">Sell</button>
        <button class="add-to-cart-btn" type="submit" id="#">
            <span>Incoming</span>
        </button>
    </div>
</form>
                    ';
                      }else
                      echo '<hr class="hr-product">
                    
                      <form action="add_to_cart.php" method="post">
      <div class="product-action">
          <input type="hidden" name="product_id" value="'.$row['product_id'].'">
          <input type="hidden" name="quantity" value="1">
          <button class="sell-btn" type="submit" id="sell-product">Sell</button>
          <button class="add-to-cart-btn" type="submit" id="add-to-cart">
              <span>Add to Cart</span>
          </button>
      </div>
  </form>';
                    ?>
                    
                    </div>
                    
                </div>
            </div>
        </section>
</article>

        <article>
        <link rel="stylesheet" href="..\assets\css\style.css">
        <section class="section special">
        <div class="container">          
          <div class="special-product">

            <h2 class="h2 section-title">
              <span class="text">You may also like</span>

              <span class="line"></span>
            </h2>

            <ul class="has-scrollbar">
              <?php

        $result = tablequery('SELECT p.*, c.category_name, b.carbrand_name FROM products p
                              LEFT JOIN categories c ON p.category_id = c.category_id
                              LEFT JOIN carbrands b ON p.carbrand_id = b.carbrand_id
                              ORDER BY RAND() LIMIT 4');
      
              if ($result) {
                // Use foreach to iterate through the result set
                foreach ($result as $row) {
                  $isNewProduct = false; // Initialize a flag for checking if the product is new

      // Check if the product is new (released within the last week)
      if (!empty($row['Release_Date'])) {
      $releaseDate = strtotime($row['Release_Date']);
      $oneWeekAgo = strtotime('-1 week');
      if ($releaseDate > $oneWeekAgo) {
      $isNewProduct = true;
          }
      } //var_dump("isNewProduct: " . ($isNewProduct ? "true" : "false"));
                    echo '<li class="product-item" release-date="'. $row['Release_Date'] .'">
                        <div class="product-card" tabindex="0">
                            <figure class="card-banner">
                            <a class="image-contain" href="' . $_SERVER['PHP_SELF'] . '?product_id=' . $row['product_id'] . '"><img src="../assets/images/' . $row['p_image'] . '" width="312" height="350" loading="lazy"
                                    alt="' . $row['product_name'] . '" class="image-contain"></a>';

              if($isNewProduct){
                echo '<div class="card-badge">New</div>';
              }  
                       echo '      
                                <ul class="card-action-list">
                                    <li class="card-action-item">
                                        <button class="card-action-btn" aria-labelledby="card-label-1">
                                            <ion-icon name="cart-outline"></ion-icon>
                                        </button>
                
                                        <div class="card-action-tooltip" id="card-label-1">Add to Cart</div>
                                    </li>
                
                                    <li class="card-action-item">
                                        <button class="card-action-btn" aria-labelledby="card-label-2">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>
                
                                        <div class="card-action-tooltip" id="card-label-2">Add to Whishlist</div>
                                    </li>
                
                                    <li class="card-action-item">
                                        <button class="card-action-btn" aria-labelledby="card-label-3">
                                            <ion-icon name="eye-outline"></ion-icon>
                                        </button>
                
                                        <div class="card-action-tooltip" id="card-label-3">Quick View</div>
                                    </li>
                
                                    <li class "card-action-item">
                                        <button class="card-action-btn" aria-labelledby="card-label-4">
                                            <ion-icon name="repeat-outline"></ion-icon>
                                        </button>
                
                                        <div class="card-action-tooltip" id="card-label-4">Compare</div>
                                    </li>
                
                                </ul>
                            </figure>
                
                            <div class="card-content">
                
                                <div class="card-cat">
                                    <a href="#" class="card-cat-link">'.$row['category_name'].'</a> /
                                    <a href="#" class="card-cat-link">'.$row['carbrand_id'].'</a>
                                </div>
                
                                <h3 class="h3 card-title">
                                    <a href="#">'.$row['product_name'].'</a>
                                </h3>
                
                                <data class="card-price" value="'.$row['price'].'">'.$row['price'].'</data>
                
                            </div>
                
                        </div>
                    </li>';
                }
            } else {
                echo "0 results";
            }             
              ?>

            </ul>

          </div>

        </div>
        <div id="cart-success-alert" class="cart-alert" style="display: none;">
    <p>Item added to cart successfully!</p>
</div>

      </section>
          </article>
    </main>
    <script style="position: absolute; color: white;">
    var userIsLoggedIn =  <?php echo isset($_SESSION['user_login']) && $_SESSION['user_login'] ? 'true' : 'false'; ?>;
  </script>

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
    - CSS link
  -->
  <link rel="stylesheet" href="../assets/css/style.css">

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- 
    - tailwindcss link
  -->

</body>

</html>