<?php
    session_start();

    include '../../config/db.php';

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


    if(isset($_GET['id'])) {
        $car_id = $_GET['id'];

        //fetch the details for the car
        $sql = "SELECT * FROM `apartments` WHERE `id` = ?";
        $stmt = $connect->prepare($sql);

        $stmt->bind_param('i', $car_id);
        $stmt->execute();

        $output = $stmt->get_result();
        $output_fetch = $output->fetch_assoc();

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel . Create</title>
    <link rel="stylesheet" href="../styles/main.css">
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
                    <div class="bg-blue-500 text-white cursor-pointer p-[10px] rounded-[6px]"><a href="" class="font-bold text-[16px] flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-square-plus text-[16px] font-bold"></i><span></span> Create</a></div>
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="manage.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-list-check text-[16px] font-bold"></i><span></span> Management</a></div>
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="history.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-trash text-[16px] font-bold"></i><span></span> History</a></div>
                </div>
            </div>
            <!--Side bar-->

            <!--Right Section-->
            <div class="h-full w-full p-[10px] md:p-[40px] pb-[50px] overflow-y-scroll md:w-[85%]">
                <div class="text-[18px] font-black text-slate-300 select-none mb-[30px]"><?php echo $output_fetch['apartment_title']; ?></div>
                <?php
                    $car_id = $_GET['id'];

                    //fetch the details for the car
                    $sql = "SELECT * FROM `apartments` WHERE `id` = ?";
                    $stmt = $connect->prepare($sql);

                    $stmt->bind_param('i', $car_id);
                    $stmt->execute();

                    $output = $stmt->get_result();
                    $output_fetch = $output->fetch_assoc();
                    
                    echo '<div class="grid grid-cols-1 md:grid-cols-4 gap-4 w-full p-[10px] border-[2px] border-gray-300 border-solid">';

                        foreach(json_decode($output_fetch['images']) as $image) {
                                echo '
                                    <div class="w-full h-[200px] rounded-[12px]">
                                        <img src="../../includes/admin/uploaded_apartments/' .$image. '" class="w-full h-full object-cover object-center" alt="Image 1">
                                    </div>
                                ';
                        }
                        
                    echo '</div>';

                    echo $output_fetch['apartment_price'] . '<br>';
                    echo $output_fetch['apartment_des'] . '<br>';
                    echo $output_fetch['number_rooms'] . '<br>';
                      
                
                
                
                ?>
                
                
            </div>
            <!--Right Section-->

        </div>
        <!--Main content-->
    </div>
    
</body>
</html>