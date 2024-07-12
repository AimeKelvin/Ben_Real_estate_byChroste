<?php
    include './config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="favicon.png" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="styles/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            screens: {
                sm: '640px',
                
                md: '784px',
                
                lg: '1024px',
                
                xl: '1280px',
            },
            extend: {
            }
          }
        }
    </script>

    <link rel="stylesheet" href="fonts/icomoon/style.css" />
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css" />

    <link rel="stylesheet" href="css/tiny-slider.css" />
    <link rel="stylesheet" href="css/aos.css" />
    <link rel="stylesheet" href="css/style.css" />

    <title>
        Search Results
    </title>
  </head>
  <body>
    <?php include './whatsapplink.php'; ?>
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icofont-close js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
      <div class="container">
        <div class="menu-bg-wrap">
          <div class="site-navigation">
            <a href="index.php" class="logo m-0 float-start">Ben Real Estate.</a>

            <ul
              class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end"
            >
              <li><a href="index.php">Home</a></li>
              <li><a href="services.php">Services</a></li>
              <li class="active"><a href="properties.php">Properties</a></li>
              <li><a href="contact.php">Contact Us</a></li>
            </ul>

            <a
              href="#"
              class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
              data-toggle="collapse"
              data-target="#main-navbar"
            >
              <span></span>
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Properties</h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                  Properties
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>


    <div class="section section-properties">
      <div class="container">
          <div class="col-lg-6 text-center mx-auto" style="margin-bottom: 20px;">
            <h2 class="font-weight-bold text-primary heading">
              Search Results
            </h2>
          </div>
        <div class="row">
            <?php
                if (isset($_GET['q'])) {
                    include './config/db.php';

                    $searchQuery = $connect->real_escape_string($_GET['q']); 
                    $query = "
                        SELECT 'car' AS type, id, car_name AS title, car_price AS price, images, NULL AS number_rooms, NULL AS number_bedrooms FROM cars WHERE car_name LIKE '%$searchQuery%'
                        UNION
                        SELECT 'apartment' AS type, id, apartment_title AS title, apartment_price AS price, images, number_rooms, number_bedrooms FROM apartments WHERE apartment_title LIKE '%$searchQuery%'
                        UNION
                        SELECT 'house' AS type, id, house_title AS title, house_price AS price, images, number_rooms, number_bedrooms FROM houses WHERE house_title LIKE '%$searchQuery%'
                    ";
                    $result = $connect->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Decode the JSON array of images
                            $images = json_decode($row['images'], true);
                            $thumbnail = (is_array($images) && count($images) > 0) ? $images[0] : 'default.jpg';

                            // Determine the image path based on the type of listing
                            $imagePath = '';
                            switch ($row['type']) {
                                case 'car':
                                    $imagePath = "./includes/admin/uploaded_cars/" . $thumbnail;
                                    break;
                                case 'apartment':
                                    $imagePath = "./includes/admin/uploaded_apartments/" . $thumbnail;
                                    break;
                                case 'house':
                                    $imagePath = "./includes/admin/uploaded_houses/" . $thumbnail;
                                    break;
                            }

                            // Determine the price field based on the type of listing
                            $price = '';
                            switch ($row['type']) {
                                case 'car':
                                    $price = $row['price'];
                                    break;
                                case 'apartment':
                                    $price = $row['price'];
                                    break;
                                case 'house':
                                    $price = $row['price'];
                                    break;
                            }

                            // Determine the title field based on the type of listing
                            $title = '';
                            switch ($row['type']) {
                                case 'car':
                                    $title = $row['title'];
                                    break;
                                case 'apartment':
                                    $title = $row['title'];
                                    break;
                                case 'house':
                                    $title = $row['title'];
                                    break;
                            }

                            // Determine the details link based on the type of listing
                            $detailsLink = '';
                            switch ($row['type']) {
                                case 'car':
                                    $detailsLink = "single-car.php?car=" . $row['id'];
                                    break;
                                case 'apartment':
                                    $detailsLink = "single-apartment.php?apartment=" . $row['id'];
                                    break;
                                case 'house':
                                    $detailsLink = "single-house.php?house=" . $row['id'];
                                    break;
                            }

                            echo '
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                    <div class="property-item mb-30">
                                        <a href="' . $detailsLink . '" class="img">
                                            <img src="' . $imagePath . '" alt="Image" class="img-fluid" style="width: 100%; height: 370px; object-fit: cover; object-position: 50% 50%;" />
                                        </a>

                                        <div class="property-content">
                                            <div class="price mb-2"><span>' . htmlspecialchars($price) . '</span></div>
                                            <div>
                                                <span class="d-block mb-2 text-black-50">5232 California Fake, Ave. 21BC</span>
                                                <span class="city d-block mb-3">' . htmlspecialchars($title) . '</span>

                                                <div class="specs d-flex mb-4">
                                                    <span class="d-block d-flex align-items-center me-3">
                                                        <span class="icon-bed me-2"></span>
                                                        <span class="caption">' . htmlspecialchars($row['number_rooms']) . ' Rooms</span>
                                                    </span>
                                                    <span class="d-block d-flex align-items-center">
                                                        <span class="icon-bath me-2"></span>
                                                        <span class="caption">' . htmlspecialchars($row['number_bedrooms']) . ' Bathrooms</span>
                                                    </span>
                                                </div>

                                                <a href="' . $detailsLink . '" class="btn btn-primary py-2 px-3">See details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    } else {
                        echo "<p>No results found for '" . htmlspecialchars($searchQuery) . "'</p>";
                    }
                }
            ?>

        </div>
    </div>


    <div class="site-footer" style="margin-bottom: -125px;">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="widget">
              <h3>Contact</h3>
              <address>43 Raymouth Rd. Baltemoer, London 3910</address>
              <ul class="list-unstyled links">
                <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                <li>
                  <a href="mailto:info@mydomain.com">info@mydomain.com</a>
                </li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="widget">
              <h3>Sources</h3>
              <ul class="list-unstyled float-start links">
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Vision</a></li>
                <li><a href="#">Mission</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Privacy</a></li>
              </ul>
              <ul class="list-unstyled float-start links">
                <li><a href="#">Partners</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Creative</a></li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="widget">
              <h3>Links</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Our Vision</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
              </ul>

              <ul class="list-unstyled social">
                <li>
                  <a href="#"><span class="icon-instagram"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-twitter"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-facebook"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-linkedin"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-pinterest"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-dribbble"></span></a>
                </li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

        <div class="row mt-5">
          <div class="col-12 text-center">
            <p>
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
              . All Rights Reserved. &mdash; Developed by Chroste
            </p>
          </div>
        </div>
      </div>
      <!-- /.container -->
    </div>
    <!-- /.site-footer -->

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
