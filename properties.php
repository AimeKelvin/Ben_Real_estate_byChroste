<?php
    include './config/db.php'






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
      Properties
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </head>
  <body>
    <?php include './whatsapplink.php'; ?>
    <?php
        //Success
        if (isset($_GET['success'])) {
            // Decode the message
            $msg = urldecode($_GET['success']);

            echo '<span class="success-toast" style="position: absolute; bottom: 20px; left: 20px; padding: 20px; border-radius: 10px; color: #fff; font-weight: bold; z-index: 20; background-color: rgb(76, 211, 227); margin-left: 10px; margin-top: 10px;">' . htmlspecialchars($msg) . '</span>';

            unset($_GET['success']);
    
        }


        if (isset($_GET['error'])) {
            // Decode the message
            $msg = urldecode($_GET['error']);

            echo '<span class="error-cont" style="position: absolute; bottom: 20px; left: 20px; padding: 20px; border-radius: 10px; color: #fff; font-weight: bold; z-index: 20; background-color: rgb(255, 76, 76); margin-left: 10px; margin-top: 10px;">' . htmlspecialchars($msg) . '</span>';

            unset($_GET['error']);
    
        }
    ?>
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
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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

    <div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-6 text-center mx-auto">
            <h2 class="font-weight-bold text-primary heading">
              Featured Properties
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="property-slider-wrap">
              <div class="property-slider">
                <?php
                    $fetch_houses = "SELECT * FROM `houses`";

                    $stmt = $connect->prepare($fetch_houses);
        
                    $stmt->execute();
        
                    $result = $stmt->get_result();

                    if(mysqli_num_rows($result) > 0) {
                      while($fetch = $result->fetch_assoc()) {
                           // Decode the JSON array
                          $images = json_decode($fetch['images']);
        
                          if (is_array($images) && count($images) > 0) {
                              $thumbnail = $images[0];
                          }
                          echo '
                                <div class="property-item">
                                  <a href="" class="img">
                                    <img src="./includes/admin/uploaded_houses/' .$thumbnail. '" alt="Image" style="width: 100%; height: 370px; object-fit: cover; object-position: 50% 50%;" class="img-fluid" />
                                  </a>

                                  <div class="property-content">
                                    <div class="price mb-2"><span>' .$fetch['house_price']. '</span></div>
                                    <div>
                                      <span class="d-block mb-2 text-black-50"
                                        >' .$fetch['location']. '</span
                                      >
                                      <span class="city d-block mb-3">' .$fetch['house_title']. '</span>

                                      <div class="specs d-flex mb-4">
                                        <span class="d-block d-flex align-items-center me-3">
                                          <span class="icon-bed me-2"></span>
                                          <span class="caption">' .$fetch['number_rooms']. ' Rooms</span>
                                        </span>
                                        <span class="d-block d-flex align-items-center">
                                          <span class="icon-bath me-2"></span>
                                          <span class="caption">' .$fetch['number_bedrooms']. ' Bathrooms</span>
                                        </span>
                                      </div>

                                      <a
                                        href="single-house.php?house=' .$fetch['id']. '"
                                        class="btn btn-primary py-2 px-3"
                                        >See details</a
                                      >
                                    </div>
                                  </div>
                                </div>
                          
                          ';
                      }
                  }else {
                      echo '
                          <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">No Houses</div>
        
                      ';
                  }
        
                
                
                ?>
               
              </div>

              <div
                id="property-nav"
                class="controls"
                tabindex="0"
                aria-label="Carousel Navigation"
              >
                <span
                  class="prev"
                  data-controls="prev"
                  aria-controls="property"
                  tabindex="-1"
                  >Prev</span
                >
                <span
                  class="next"
                  data-controls="next"
                  aria-controls="property"
                  tabindex="-1"
                  >Next</span
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section section-properties">
      <div class="container">
          <div class="col-lg-6 text-center mx-auto" style="margin-bottom: 20px;">
            <h2 class="font-weight-bold text-primary heading">
              Featured Houses
            </h2>
          </div>
        <div class="row">
          <?php
            $fetch_houses = "SELECT * FROM `houses`";

            $stmt = $connect->prepare($fetch_houses);

            $stmt->execute();

            $result = $stmt->get_result();

            $row_one = 0;
            $pages_per_row = 3;
            $fetch_limit = "SELECT * FROM `houses` LIMIT $row_one, $pages_per_row";

            $num_rows = $result->num_rows;
            $total_pages = ceil($num_rows / $pages_per_row);

            if(mysqli_num_rows($result) > 0) {
              while($fetch = $result->fetch_assoc()) {
                   // Decode the JSON array
                  $images = json_decode($fetch['images']);

                  if (is_array($images) && count($images) > 0) {
                      $thumbnail = $images[0];
                  }
                  echo '
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="property-item mb-30">
                          <a href="" class="img">
                            <img src="./includes/admin/uploaded_houses/' .$thumbnail. '" alt="Image" class="img-fluid" style="width: 100%; height: 370px; object-fit: cover; object-position: 50% 50%;" />
                          </a>

                          <div class="property-content">
                            <div class="price mb-2"><span>' .$fetch['house_price']. '</span></div>
                            <div>
                              <span class="d-block mb-2 text-black-50"
                                >' .$fetch['location']. '</span
                              >
                              <span class="city d-block mb-3">' .$fetch['house_title']. '</span>

                              <div class="specs d-flex mb-4">
                                <span class="d-block d-flex align-items-center me-3">
                                  <span class="icon-bed me-2"></span>
                                  <span class="caption">' .$fetch['number_rooms']. ' Rooms</span>
                                </span>
                                <span class="d-block d-flex align-items-center">
                                  <span class="icon-bath me-2"></span>
                                  <span class="caption">' .$fetch['number_bedrooms']. ' Bathrooms</span>
                                </span>
                              </div>

                              <a
                                href="single-house.php?house=' .$fetch['id']. '"
                                class="btn btn-primary py-2 px-3"
                                >See details</a
                              >
                            </div>
                          </div>
                        </div>
                        
                      </div>
                  
                  ';
              }
          }else {
              echo '
                  <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">No Houses</div>

              ';
          }
          
          ?>
        </div>
        <div class="row align-items-center py-5">
          <div class="col-lg-3">Pagination (
            <?php
            if(!isset($_GET['page'])) {
              $page = 1;
            }else {
              $page = $_GET['page'];
            }
              
            ?>
            <?php echo $page ?> of <?php echo $total_pages ?>)</div>
          <div class="col-lg-6 text-center">
            <div class="custom-pagination">
              <?php
                for($counter = 1; $counter <= $total_pages; $counter ++) {
                  ?>
                    <a href="?page=<?php echo $counter ?>"><?php echo $counter ?></a>
                  <?php
                }
              
              ?>

            </div>
          </div>
        </div>
    </div>

    <div class="section section-properties">
      <div class="container">
          <div class="col-lg-6 text-center mx-auto" style="margin-bottom: 20px;">
            <h2 class="font-weight-bold text-primary heading">
              Featured Cars
            </h2>
          </div>
        <div class="row">
          <?php
            $fetch_houses = "SELECT * FROM `cars`";

            $stmt = $connect->prepare($fetch_houses);

            $stmt->execute();

            $result = $stmt->get_result();

            $row_one = 0;
            $pages_per_row = 3;
            $fetch_limit = "SELECT * FROM `cars` LIMIT $row_one, $pages_per_row";
            

            $num_rows = $result->num_rows;
            $total_pages = ceil($num_rows / $pages_per_row);

            if(mysqli_num_rows($result) > 0) {
              while($fetch = $result->fetch_assoc()) {
                   // Decode the JSON array
                  $images = json_decode($fetch['images']);

                  if (is_array($images) && count($images) > 0) {
                      $thumbnail = $images[0];
                  }
                  echo '
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="property-item mb-30">
                          <a href="" class="img">
                            <img src="./includes/admin/uploaded_cars/' .$thumbnail. '" alt="Image" class="img-fluid" style="width: 100%; height: 370px; object-fit: cover; object-position: 50% 50%;" />
                          </a>

                          <div class="property-content">
                            <div class="price mb-2"><span>' .$fetch['car_price']. '</span></div>
                            <div>
                              <span class="d-block mb-2 text-black-50"
                                >' .$fetch['location']. '</span
                              >
                              <span class="city d-block mb-3">' .$fetch['car_name']. '</span>

                              <div class="specs d-flex mb-4">
                                <span class="d-block d-flex align-items-center me-3">
                                  <span class="caption">' .$fetch['kilometres']. '</span>
                                </span>
                                <span class="d-block d-flex align-items-center">
                                  <span class="caption" style="text-transform: capitalize;">' .$fetch['status']. '</span>
                                </span>
                              </div>

                              <a
                                href="single-car.php?car=' .$fetch['id']. '"
                                class="btn btn-primary py-2 px-3"
                                >See details</a
                              >
                            </div>
                          </div>
                        </div>
                        
                      </div>
                  
                  ';
              }
          }else {
              echo '
                  <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">No Houses</div>

              ';
          }
          
          ?>
        </div>
        <div class="row align-items-center py-5">
          <div class="col-lg-3">Pagination (
            <?php
            if(!isset($_GET['page'])) {
              $page = 1;
            }else {
              $page = $_GET['page'];
            }
              
            ?>
            <?php echo $page ?> of <?php echo $total_pages ?>)</div>
          <div class="col-lg-6 text-center">
            <div class="custom-pagination">
              <?php
                for($counter = 1; $counter <= $total_pages; $counter ++) {
                  ?>
                    <a href="?page=<?php echo $counter ?>"><?php echo $counter ?></a>
                  <?php
                }
              
              ?>

            </div>
          </div>
        </div>
    </div>

    <div class="section section-properties">
      <div class="container">
          <div class="col-lg-6 text-center mx-auto" style="margin-bottom: 20px;">
            <h2 class="font-weight-bold text-primary heading">
              Featured Apartments
            </h2>
          </div>
        <div class="row">
          <?php   
            $fetch_houses = "SELECT * FROM `apartments`";

            $stmt = $connect->prepare($fetch_houses);

            $stmt->execute();

            $result = $stmt->get_result();

            $row_one = 0;
            $pages_per_row = 3;
            $fetch_limit = "SELECT * FROM `apartments` LIMIT $row_one, $pages_per_row";

            $num_rows = $result->num_rows;
            $total_pages = ceil($num_rows / $pages_per_row);


            if(mysqli_num_rows($result) > 0) {
              while($fetch = $result->fetch_assoc()) {
                   // Decode the JSON array
                  $images = json_decode($fetch['images']);

                  if (is_array($images) && count($images) > 0) {
                      $thumbnail = $images[0];
                  }
                  echo '
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="property-item mb-30">
                          <a href="" class="img">
                            <img src="./includes/admin/uploaded_apartments/' .$thumbnail. '" alt="Image" class="img-fluid" style="width: 100%; height: 370px; object-fit: cover; object-position: 50% 50%;" />
                          </a>

                          <div class="property-content">
                            <div class="price mb-2"><span>' .$fetch['apartment_price']. '</span></div>
                            <div>
                              <span class="d-block mb-2 text-black-50"
                                >' .$fetch['location']. '</span
                              >
                              <span class="city d-block mb-3">' .$fetch['apartment_title']. '</span>

                              <div class="specs d-flex mb-4">
                                <span class="d-block d-flex align-items-center me-3">
                                  <span class="icon-bed me-2"></span>
                                  <span class="caption">' .$fetch['number_rooms']. ' Rooms</span>
                                </span>
                                <span class="d-block d-flex align-items-center">
                                  <span class="icon-bath me-2"></span>
                                  <span class="caption">' .$fetch['status']. '</span>
                                </span>
                              </div>

                              <a
                                href="single-apart.php?apart=' .$fetch['id']. '"
                                class="btn btn-primary py-2 px-3"
                                >See details</a
                              >
                            </div>
                          </div>
                        </div>
                        
                      </div>
                  
                  ';
              }
          }else {
              echo '
                  <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">No Houses</div>

              ';
          }
          
          ?>
        </div>
        <div class="row align-items-center py-5">
          <div class="col-lg-3">Pagination (
            <?php
            if(!isset($_GET['page'])) {
              $page = 1;
            }else {
              $page = $_GET['page'];
            }
              
            ?>
            <?php echo $page ?> of <?php echo $total_pages ?>)</div>
          <div class="col-lg-6 text-center">
            <div class="custom-pagination">
              <?php
                for($counter = 1; $counter <= $total_pages; $counter ++) {
                  ?>
                    <a href="?page=<?php echo $counter ?>"><?php echo $counter ?></a>
                  <?php
                }
              
              ?>

            </div>
          </div>
        </div>
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

    <script src="./admin/js/jquery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
