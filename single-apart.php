<?php
    include './config/db.php';
    


    if(isset($_GET['apart'])) {
      $apartment_id = $_GET['apart'];

      //fetch the details for the car
      $sql = "SELECT * FROM `apartments` WHERE `id` = ?";
      $stmt = $connect->prepare($sql);

      $stmt->bind_param('i', $apartment_id);
      $stmt->execute();

      $output = $stmt->get_result();
      $output_fetch = $output->fetch_assoc();

      $apart_title = $output_fetch['apartment_title'];

      if(!$output_fetch) {
          header('location: error.php');
          exit();
      }

      $stmt->close();

    }else{
      header('location: error.php');
      exit();
    }



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

    <title><?php echo $apart_title; ?></title>
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
              <li><a href="properties.php">Properties</a></li>
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
      style="background-image: url('images/hero_bg_3.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">
              <?php echo $apart_title; ?>
            </h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">
                  <a href="properties.php">Properties</a>
                </li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                  <?php echo $apart_title; ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-7">
            <div class="img-property-slide-wrap">
              <div class="img-property-slide">
                <?php
                    $apartment_id  = $_GET['apart'];

                    //fetch the details for the car
                    $sql = "SELECT * FROM `apartments` WHERE `id` = ?";
                    $stmt = $connect->prepare($sql);

                    $stmt->bind_param('i', $apartment_id);
                    $stmt->execute();

                    $output = $stmt->get_result();
                    $output_fetch = $output->fetch_assoc();
                    
                    
                    foreach(json_decode($output_fetch['images']) as $image) {
                            echo '
                                <img src="./includes/admin/uploaded_apartments/' .$image. '" alt="Image" class="img-fluid" />

                            ';
                    }
                        
                ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <h2 class="heading text-primary"><?php echo $apart_title; ?></h2>
            <p class="meta"><?php echo $output_fetch['location']; ?></p>
            <p class="text-black-50">
              <?php echo $output_fetch['apartment_des']; ?>
            </p>
            
            <div style="margin-bottom: 30px;">
                <div class="specs d-flex mb-4">
                  <span class="d-block d-flex align-items-center me-3">
                    <span class="icon-bed me-2"></span>
                    <span class="caption"><?php echo $output_fetch['number_rooms']; ?> Rooms</span>
                  </span>
                  <span class="d-block d-flex align-items-center" style="margin-right: 20px;">
                    <span class="icon-bath me-2"></span>
                    <span class="caption"><?php echo $output_fetch['number_bedrooms']; ?> Bathrooms</span>
                  </span>
                  <span class="d-block d-flex align-items-center" style="margin-right: 20px;">
                    <span class="caption"><?php echo $output_fetch['location']; ?></span>
                  </span>
                  <span class="d-block d-flex align-items-center">
                    <span class="caption" style="text-transform: capitalize;"><?php echo $output_fetch['status']; ?></span>
                  </span>
                </div>
            </div> 

            <div>
              <h2 class="heading text-primary">Make a Deal</h2>
              <form action="./includes/admin/add_new_deal.php" method="POST">
                <div>
                  <input type="text" style="display: none;" name="listing_name" value="<?php echo $output_fetch['apartment_title']; ?>">
                </div>
                <div style="margin-bottom: 10px;">
                  <input type="text" name="name" class="form-control" placeholder="Your Name"/>
                </div>
                <div style="margin-bottom: 10px;">
                  <input type="text" name="phone" class="form-control" placeholder="Your Number"/>
                </div>
                <div>
                  <input type="submit" name="send_deal_btn" value="Send Message"class="btn btn-primary"/>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="widget">
              <h3>Contact</h3>
            
              <address>Kacyiru, KG 572 Street</address>
              <ul class="list-unstyled links">
                <li><a href="tel://250788558218">+250 788 558 218</a></li>
                <li>
                  <a href="mailto:info@mydomain.com">benrealestate24@gmail.com</a>
                </li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
         
          <!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="widget">
              <h3>Links</h3>
              

              <ul class="list-unstyled social">
                <li>
                  <a href="#"><span class="icon-instagram"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-youtube"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-facebook"></span></a>
                </li>
               
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->

          <div class="col-lg-4">
            <div class="widget">
              <h3>Navigation</h3>
              <ul class="list-unstyled float-start links">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./services.php">Services</a></li>
                <li><a href="./properties.php">Properties</a></li>
                <li><a href="./">Contact us</a></li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
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
