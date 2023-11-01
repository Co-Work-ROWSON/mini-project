<?php 
    require '../global/conn.php';
    require '../global/func.php';
    require '../global/header.php'; 
    require '../global/menubar.php';

    if (isset($_SESSION['user_login'])) {
      $userId = $_SESSION['user_login'];
  } else {
      $userId = ''; // or any default value you want
  }
    print_r($userId);
?>

<section class="section upcoming" id="upcoming">
        <div class="container">
          <h2 class="h2 section-title">Upcoming Release</h2>
      <?php
      $result = tablequery('SELECT b.*, p.Release_Date FROM bannerlists b join products p on b.product_id = p.product_id WHERE p.Release_Date order by p.Release_Date DESC ');
      if ($result) {
        // Use foreach to iterate through the result set
        foreach ($result as $row)  { 
            echo '<div class = "section upcoming-list" style="background-image: url(../assets/images/' . $row['bn_image'] . ')">
            <div class="container '.$row['text_layout'].'">';

            $releaseDate = strtotime($row['Release_Date']);
            $currentTime = time();
            
            if ($releaseDate > $currentTime) {
                // Display the timer container only if the release date is in the future
                echo '<div class="timer-container" release_date="' . $row['Release_Date'] . '">
                          <div class="clock" id="#">
                            <span id="day">00</span>
                            <span>:</span>
                            <span id="hrs">00</span>
                            <span>:</span>
                            <span id="mins">00</span>
                            <span>:</span>
                            <span id="sec">00</span>
                          </div>
                        </div>';
            }
                echo' <h2 class="h1 hero-title">
                        <strong>' . $row['bannerlist_infoL1'] . '</strong>
                      </h2>
                      <p class="hero-text">
                        ' . $row['bannerlist_infoL2'] . '
                      </p>
                      <a href="../views/products_view.php?product_id=' . $row['product_id'] . '"><button class="btn btn-primary">
                        <span>Shop Now</span>
                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                      </button></a>
                    </div>
                  </div>';
          }
        }else {
            echo "0 results";
        }
      ?>
      </div>

      <p>Time remaining: <span id="countdown"></span></p>
    
    <!-- Your payment form goes here -->

    <script>
        // Set the countdown target time (in seconds)// 10 minutes

        const countdownElement = document.getElementById('');

        function updateCountdown() {
  const now = new Date();
  const timeRemaining = releaseDate - now;

  if (timeRemaining <= 0) {
    // Release date has passed, you can take appropriate action here
    document.querySelector('.clock').textContent = 'Release Date has passed';
  } else {
    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    // Update the HTML elements
    document.getElementById('day').textContent = String(days).padStart(2, '0');
    document.getElementById('hrs').textContent = String(hours).padStart(2, '0');
    document.getElementById('mins').textContent = String(minutes).padStart(2, '0');
    document.getElementById('sec').textContent = String(seconds).padStart(2, '0');
  }
}

// Call the function initially to set up the timer
updateCountdown();
    </script>
      </section>


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