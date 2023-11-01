<?php 
  require '../global/conn.php';
  require '../global/func.php';
  require '../global/header.php'; 
  require '../global/menubar.php';

  if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
} else {
    $product_id = ''; // or any default value you want
}

?>

    <main>
    <section class="sectiona">
      <div class="sidebar">
        <div class="sidebar-scrollbar">

        <div class="topic-cat">
            <div class="box-cat-tem1 header-cat">
              <div class="box-cat-tem2 header-title">
              <h4 class="p-sidebar">By Categories</h4>
              </div>
            </div>
            <div class="box-cat">
              <div class="box-cat-fl">
                <div class="box-cat-width">
              <div class="box-cat-pad">
                <ul class="cat-item-list">
        <?php
          $conn = conndb();
          $result = tablequery('SELECT * FROM categories');

          if($result){
            foreach($result as $row){
              echo '<li>
              <div class="box-cat-tem1 cat-item">
                  <a href="#" class="cat-item-text">'.$row['category_name'].'</a>
              </div>
              </il>';
            }
          }else{
            echo "0 results";
          }
        ?>
              </ul>
              </div>
            </div>
          </div>
            </div>
          </div>

          <div class="topic-cat">
            <div class="box-cat-tem1 header-cat">
              <div class="box-cat-tem2 header-title">
              <h4 class="p-sidebar">By Regions</h4>
              </div>
            </div>
            <div class="box-cat">
              <div class="box-cat-fl">
                <div class="box-cat-width">
              <div class="box-cat-pad">
                <ul class="cat-item-list">
                <?php
          $conn = conndb();
          $result = tablequery('SELECT DISTINCT SUBSTRING(carbrand_id, 1, 2) AS carbrand_text FROM carbrands');

          if($result){
            foreach($result as $row){
              echo '<li>
              <div class="box-cat-tem1 cat-item">
                  <a href="#" class="cat-item-text">'.$row['carbrand_text'].'</a>
              </div>
              </il>';
            }
          }else{
            echo "0 results";
          }
        ?>
              </ul>
              </div>
            </div>
          </div>
            </div>
          </div>

          <div class="topic-cat">
            <div class="box-cat-tem1 header-cat">
              <div class="box-cat-tem2 header-title">
              <h4 class="p-sidebar">By Brands</h4>
              </div>
            </div>
            <div class="box-cat">
              <div class="box-cat-fl">
                <div class="box-cat-width">
              <div class="box-cat-pad">
                <ul class="cat-item-list">
                <?php
          $conn = conndb();
          $result = tablequery('SELECT * FROM carbrands');

          if($result){
            foreach($result as $row){
              echo '<li>
              <div class="box-cat-tem1 cat-item">
                  <a href="#" class="cat-item-text">'.$row['carbrand_name'].'</a>
              </div>
              </il>';
            }
          }else{
            echo "0 results";
          }
        ?>
              </ul>
              </div>
            </div>
          </div>
            </div>
          </div>

          </div>
      </div>

          </div>
        </div>

        <!--
            PRODUCT SECTION
        -->

        <div class="section product">
        <div class="container">
            <h2 class="h2 section-title" style="text-align: left;
            margin-left: 2.2rem; margin-bottom: 6rem;">Explore The Hot Wheels Realms</h2>

            <ul class="product-list" id="product-list">
                <!-- Product Listing -->
                <?php

$sql = "SELECT p.*, c.category_name, b.carbrand_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.category_id
LEFT JOIN carbrands b ON p.carbrand_id = b.carbrand_id
WHERE (p.Release_Date IS NULL OR p.Release_Date <= CURRENT_DATE)";

if (!empty($product_id)) {
$sql .= " AND p.product_id = '$product_id'";
}

$sql .= " ORDER BY p.Release_Date DESC";
 
$result= tablequery($sql);
  if ($result) {
      if ($result->rowCount() > 0) {
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
              }
              echo '<li class="product-item" release-date="' . $row['Release_Date'] . '">
              <div class="product-card" tabindex="0">
                  <figure class="card-banner">
                  <a class="image-contain" href="../views/products_view.php?product_id=' . $row['product_id'] . '"><img src="../assets/images/' . $row['p_image'] . '" width="312" height="350" loading="lazy"
                  alt="' . $row['product_name'] . '" class="image-contain"></a>';
  
              // Display the "New" badge if it's a new product
              if ($isNewProduct) {
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
                  <div class="card-action-tooltip" id="card-label-2">Add to Wishlist</div>
              </li>
              <li class="card-action-item">
                  <button class="card-action-btn" aria-labelledby="card-label-3">
                      <ion-icon name="eye-outline"></ion-icon>
                  </button>
                  <div class="card-action-tooltip" id="card-label-3">Quick View</div>
              </li>
              <li class="card-action-item">
                  <button class="card-action-btn" aria-labelledby="card-label-4">
                      <ion-icon name="repeat-outline"></ion-icon>
                  </button>
                  <div class="card-action-tooltip" id="card-label-4">Compare</div>
              </li>
          </ul>
      </figure>
      <div class="card-content">
          <div class="card-cat">
              <a href="#" class="card-cat-link">' . $row['category_name'] . '</a> /
              <a href="#" class="card-cat-link">' . $row['carbrand_name'] . '</a>
          </div>
          <h3 class="h3 card-title">
              <a href="#">' . $row['product_name'] . '</a>
          </h3>
          <data class="card-price" value="180.85">฿' . $row['price'] . '</data>
      </div>
  </div>
  </li>';
          }
      } else {
          echo "We apologize, but there are currently no products available at this time.";
      }
      $html = ob_get_clean(); // Get the buffered HTML content
      echo $html; // Return the HTML content as the response
  } else {
      echo "Database error"; // Handle database error
  } 
?> 
            </ul>
        </div>
        </div>
    </section>
      
</main>
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