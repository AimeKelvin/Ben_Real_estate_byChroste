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
      Ben Estate . Home
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
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="services.php">Services</a></li>
              <li><a href="properties.php">Properties</a></li>
              <li><a href="#about">About</a></li>
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

    <div class="hero">
      <div class="hero-slide">
        <div
          class="img overlay"
          style="background-image: url('images/hero_bg_3.jpg')"
        ></div>
        <div
          class="img overlay"
          style="background-image: url('images/hero_bg_2.jpg')"
        ></div>
        <div
          class="img overlay"
          style="background-image: url('images/hero_bg_1.jpg')"
        ></div>
      </div>

      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center">
            <h1 class="heading" data-aos="fade-up">
              Find your dream Properties <br>
              dial +250 788 558 218
            </h1>
            
            <form
              action="./search.php"
              class="narrow-w form-search d-flex align-items-stretch mb-3"
              data-aos="fade-up"
              data-aos-delay="200"
              method="GET"
            >
              <input
                type="text"
                name="q"
                class="form-control px-4"
                placeholder="Search by Location"
              />
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          <div class="col-lg-6">
            <h2 class="font-weight-bold text-primary heading">
              Popular Properties
            </h2>
          </div>
          <div class="col-lg-6 text-lg-end">
            <p>
              <a
                href="./properties.php"
                
                class="btn btn-primary text-white py-3 px-4"
                >View all properties</a
              >
            </p>
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

    <section class="features-1">
      <div class="container">
        <div class="row">
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
            <div class="box-feature">
              <span class="flaticon-house"></span>
              <h3 class="mb-3">Our Properties</h3>
              <p>
              We sell brand new houses, providing personalized and seamless
               service through a dedicated agent. Find your perfect new home with us!
              </p>
             
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
            <div class="box-feature">
              <span class="flaticon-building"></span>
              <h3 class="mb-3">Property for Sale</h3>
              <p>
              We have prime real estate properties for sale,
               featuring modern designs and competitive prices.
                Discover your perfect home or investment today!
              </p>
          
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
            <div class="box-feature">
              <span class="flaticon-house-3"></span>
              <h3 class="mb-3">Real Estate Agent</h3>
              <p>
              All our real estate transactions are managed by a single dedicated agent,
               ensuring personalized and seamless service.
              </p>
            </div>
          </div>
          <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="box-feature">
              <span class="flaticon-house-1"></span>
              <h3 class="mb-3">House for Sale</h3>
              <p>
                We specialize in selling homes, offering personalized and
                 seamless service from a dedicated agent. Find your dream home with us!
              </p>
              
            </div>
          </div>
        </div>
      </div>
    </section>

    <secton id="about">
    <div class="section section-5 bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-6 mb-5">
            <h2 class="font-weight-bold heading text-primary mb-4">
             The Agent
            </h2>
          </div>
        </div>
        <div class="row">
          
          <div style="display: flex; justify-content: center;">
            <div class="h-100 person">
              <img
                src="https://i.pinimg.com/736x/1b/dd/ac/1bddac34546993d914bf382176ea60fd.jpg"
                alt="Image"
                class="img-fluid"
              />

              <div class="person-contents" style="width: 600px;">
                <h2 class="mb-0"><a href="#">Ben Shakondo</a></h2>
                <span class="meta d-block mb-3">Real Estate Agent</span>
                <p style="text-align: center;
                padding:50px">
                Hi, I'm Ben Shakondo, a real estate agent in Rwanda.
                 I specialize in helping clients find homes, investment
                  properties, and commercial spaces. With a deep
                   understanding of the local market and strong 
                   negotiation skills, I aim to provide exceptional 
                   service and trusted advice for all your real estate needs.
                </p>

                <ul class="social list-unstyled list-inline dark-hover">
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-linkedin"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </secton>

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
                 <li class="list-inline-item">
                    <a href="https://youtube.com/@benshakondorealestateagent6021?si=u57Hif2Tc6ZE2tZV"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://youtube.com/@benshakondorealestateagent6021?si=u57Hif2Tc6ZE2tZV"><span class="icon-youtube"></span></a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://www.instagram.com/benrealestate2024?igsh=MTN5dWx5bDVrbnJ3MQ%3D%3D"><span class="icon-instagram"></span></a>
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
                <li><a href="#">Home</a></li>
                <li><a href="./services.php">Services</a></li>
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
