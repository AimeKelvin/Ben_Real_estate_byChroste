<?php
    session_start();

    include '../config/db.php';

    $admin_id = $_SESSION['id'];


    if(!$admin_id || empty($admin_id)) {
        $error_msg = "You have to login";
        $encoded_error_msg = urlencode($error_msg);
        header("location: login.php?error=$encoded_error_msg");
        exit();
    }


    $fetch_admin = "SELECT * FROM `admins` WHERE `id` = ?";
    $stmt = $connect->prepare($fetch_admin);

    $stmt->bind_param('i', $admin_id);

    $stmt->execute();

    $result = $stmt->get_result();
    $fetch = $result->fetch_assoc();

    //get default avatar

    $fullname = $fetch['full_name'];



    $fullNameArr = explode(" ", $fullname);
    $firstWord = current($fullNameArr);
    $lastWord  = end($fullNameArr);
    $firstCharacter = substr($firstWord, 0, 1);
    $lastCharacter = substr($lastWord, 0, 1);
    $defaultProfile = strtoupper($firstCharacter.$lastCharacter);








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel . Manage</title>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    <div class="w-full h-[100vh]">
        <!--Navigation-->
        <div class="w-full h-[80px] border-[1px] border-solid border-gray-300 bg-white p-[10px] fixed top-0 left-0 right-0 flex flex-row justify-between items-center">
            <div>
                <h3 class="select-none font-black text-slate-900 cursor-pointer">Ben Estate</h3>
            </div>
            <div class="flex flex-row spacex-x-[20px] items-center">
                <div class="flex flex-row space-x-[10px] items-center border-r border-solid pr-[10px] border-slate-400">
                    <div class="bg-blue-500 rounded-full w-[40px] h-[40px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white"><?php echo $defaultProfile; ?></div>
                    <div class="font-bold text-[16px] select-none text-slate-900"><?php echo $fullname; ?></div>
                </div>
                <div class="pl-[10px]">
                    <form action="../includes/admin/logout_inc.php" method="POST">
                        <button type="submit" class="bg-red-500 pr-[12px] pl-[12px] pt-[8px] pb-[8px] rounded-[14px] focus:outline-[2px] outline-offset-2 outline-red-500 text-white font-bold" name="logout_btn">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <!--Navigation-->

        <!--Main content-->
        <div class="w-full h-full flex flex-row items-center">

            <!--Side bar-->
            <div class="w-[15%] h-full hidden md:block border-r border-solid border-gray-300">
                <div class="w-full h-full p-[20px] flex flex-col space-y-[20px]">
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="analytics.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-chart-simple text-[16px] font-bold"></i><span></span> Analytics</a></div>
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="cars/create.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-square-plus text-[16px] font-bold"></i><span></span> Create</a></div>
                    <div class="bg-blue-500 text-white cursor-pointer p-[10px] rounded-[6px]"><a href="" class="font-bold text-[16px] flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-list-check text-[16px] font-bold"></i><span></span> Management</a></div>
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="history.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-trash text-[16px] font-bold"></i><span></span> History</a></div>
                </div>
            </div>
            <!--Side bar-->

            
            

            <!--Right Section-->
            <div class="h-full w-full p-[10px] md:p-[40px] pb-[50px] overflow-y-scroll md:w-[85%]">

                <div>
                    <div class="text-[18px] font-black text-slate-300 select-none mt-[20px] mb-[30px]">Added Houses</div>
                    <div class="grid grid-cols-1 md:grid-cols-4 space-x-[4px]">
                        <?php
                            $fetch_houses = "SELECT * FROM `houses`";

                            $stmt = $connect->prepare($fetch_houses);
    
                            $stmt->execute();
    
                            $result = $stmt->get_result();

                            if(mysqli_num_rows($result) > 0) {
                                while($fetch = $result->fetch_assoc()) {
                                    $images = json_decode($fetch['images']);

                                    if (is_array($images) && count($images) > 0) {
                                        $thumbnail = $images[0];
                                    }
                                    echo '
                                        <div class="w-full bg-white/[90%] p-[5px] rounded-[4px] md:w-[100%] flex flex-col">
                                            <div class="w-full h-[200px]">
                                                <img src="../includes/admin/uploaded_houses/' .$thumbnail. '" class="w-full rounded-[6px] h-full object-cover object-center" alt="Product">
                                            </div>
                                            <div class="p-[10px] rounded-[4px]">
                                                <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">' .$fetch['house_price']. '</div>
                                                <p class="font-md text-[14px] text-slate-500 select-none text-start">Upload an Image file of your product here...</p>
                                                <a href="../admin/houses/single_listing_house.php?id=' .$fetch['id']. '" class="font-md text-[14px] text-blue-300 select-none text-start">View Listing <span></span><i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    
                                    
                                    ';
                                }
                            }else {
                                echo '
                                    <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">No Cars Added</div>

                                ';
                            }
                        
                        ?>

                    </div>
                </div>


                <div>
                    <div class="text-[18px] font-black text-slate-300 select-none mt-[20px] mb-[30px]">Added Apartments</div>
                    <div class="grid grid-cols-1 md:grid-cols-4 space-x-[4px]">
                        <?php
                            $fetch_apartments = "SELECT * FROM `apartments`";

                            $stmt = $connect->prepare($fetch_apartments);
    
                            $stmt->execute();
    
                            $result = $stmt->get_result();

                            if(mysqli_num_rows($result) > 0) {

                                while($fetch = $result->fetch_assoc()) {
                                    $images = json_decode($fetch['images']);

                                    if (is_array($images) && count($images) > 0) {
                                        $thumbnail = $images[0];
                                    }
                                    echo '
                                        <div class="w-full bg-white/[90%] p-[5px] rounded-[4px] md:w-[100%] flex flex-col">
                                            <div class="w-full h-[200px]">
                                                <img src="../includes/admin/uploaded_apartments/' .$thumbnail. '" class="w-full rounded-[6px] h-full object-cover object-center" alt="Product">
                                            </div>
                                            <div class="p-[10px] rounded-[4px]">
                                                <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">' .$fetch['apartment_price']. '</div>
                                                <p class="font-md text-[14px] text-slate-500 select-none text-start">Upload an Image file of your product here...</p>
                                                <a href="../admin/apartments/single_listing_apartment.php?id=' .$fetch['id']. '" class="font-md text-[14px] text-blue-300 select-none text-start">View Listing <span></span><i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    
                                    
                                    ';
                                }
                            }else {
                                echo '
                                    <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">No Cars Added</div>

                                ';
                            }
                        
                        ?>

                    </div>
                </div>


                <div>
                    <div class="text-[18px] font-black text-slate-300 select-none mt-[20px] mb-[30px]">Added Vehicles</div>
                    <div class="grid grid-cols-1 md:grid-cols-4 space-x-[4px]">
                        <?php
                            $fetch_cars = "SELECT * FROM `cars`";

                            $stmt = $connect->prepare($fetch_cars);
    
                            $stmt->execute();
    
                            $result = $stmt->get_result();

                            if(mysqli_num_rows($result) > 0) {
                                while($fetch = $result->fetch_assoc()) {
                                    $images = json_decode($fetch['images']);

                                    if (is_array($images) && count($images) > 0) {
                                        $thumbnail = $images[0];
                                    }
                                    echo '
                                        <div class="w-full bg-white/[90%] p-[5px] rounded-[4px] md:w-[100%] flex flex-col">
                                            <div class="w-full h-[200px]">
                                                <img src="../includes/admin/uploaded_cars/' .$thumbnail. '" class="w-full rounded-[6px] h-full object-cover object-center" alt="Product">
                                            </div>
                                            <div class="p-[10px] rounded-[4px]">
                                                <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">' .$fetch['car_price']. '</div>
                                                <p class="font-md text-[14px] text-slate-500 select-none text-start">Upload an Image file of your product here...</p>
                                                <a href="../admin/cars/single_listing_car.php?id=' .$fetch['id']. '" class="font-md text-[14px] text-blue-300 select-none text-start">View Listing <span></span><i class="fa-solid fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    
                                    
                                    ';
                                }
                            }else {
                                echo '
                                    <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">No Cars Added</div>

                                ';
                            }
                        
                        ?>

                    </div>
                </div>

            </div>
            <!--Right Section-->
        </div>
        <!--Main content-->
    </div>
    
</body>
</html>