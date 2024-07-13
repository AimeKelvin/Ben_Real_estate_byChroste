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

    <title>Services</title>
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
            <a href="index.php" class="logo m-0 float-start">Ben Real Estate</a>

            <ul
              class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end"
            >
              <li><a href="index.php">Home</a></li>
              <li  class="active"><a href="services.php">Services</a></li>
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
      style="background-image: url('images/hero_bg_1.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">Services</h1>

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
                  Services
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="box-feature mb-4">
              <span class="flaticon-house mb-4 d-block"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                Quality Properties
              </h3>
              <p>
              We sell brand new houses, providing personalized and seamless
               service through a dedicated agent. Find your perfect new home with us!
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="box-feature mb-4">
              <span class="flaticon-house-2 mb-4 d-block-3"></span>
              <h3 class="text-black mb-3 font-weight-bold">The Agent</h3>
              <p class="text-black-50">
              All our real estate transactions are managed by a single dedicated agent,
              ensuring personalized and seamless service.
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="box-feature mb-4">
              <span class="flaticon-building mb-4 d-block"></span>
              <h3 class="text-black mb-3 font-weight-bold">
                Property for Sale
              </h3>
              <p class="text-black-50">
              <p>
              We sell brand new houses, providing personalized and seamless
               service through a dedicated agent. Find your perfect new home with us!
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
            </div>
          </div>

          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box-feature mb-4">
              <span class="flaticon-house-1 mb-4 d-block-1"></span>
              <h3 class="text-black mb-3 font-weight-bold">House for Sale</h3>
              <p class="text-black-50">
              We specialize in selling homes, offering personalized and
              seamless service from a dedicated agent. Find your dream home with us!
              </p>
              <p><a href="#" class="learn-more">Read more</a></p>
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
                <li><a href="#">Services</a></li>
                <li><a href="./properties.php">Properties</a></li>
                <li><a href="./contact.php">Contact us</a></li>
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
