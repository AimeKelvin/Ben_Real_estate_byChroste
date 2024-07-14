<?php
    session_start();

    include '../config/db.php';

    if (isset($_SESSION['id'])) {
        $admin_id = $_SESSION['id'];
    
        if ($admin_id) {
            $error_msg = "First Logout";
            $encoded_error_msg = urlencode($error_msg);
            header("location: analytics.php?error=$encoded_error_msg");
            exit();
        }
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin . Login</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
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
    <div class="w-full h-[100vh] flex justify-center items-center">
        <div class="w-full h-full p-[30px] rounded-[12px] border-[2px] border-solid border-gray-300 flex flex-col justify-center md:w-[500px] md:h-[500px]">
            <div class="text-[18px] font-black text-center text-slate-300 select-none">Admin Login</div>
            <form action="../includes/admin/login_inc.php" method="POST">
                <div>
                    <input type="text" class="border-[1px] mb-[10px] border-solid border-gray-300 text-slate-600 w-full pl-[15px] pr-[10px] pt-[10px] pb-[10px] rounded-[6px] focus:outline-[2px] focus:outline-offset-[2px] focus:outline-solid focus:outline-blue-500 outline-0" placeholder="Email" name="email">
                </div>
                <div>
                    <input type="password" class="border-[1px] mb-[10px] border-solid border-gray-300 text-slate-600 w-full pl-[15px] pr-[10px] pt-[10px] pb-[10px] rounded-[6px] focus:outline-[2px] focus:outline-offset-[2px] focus:outline-solid focus:outline-blue-500 outline-0" placeholder="Password" name="password">
                </div>
                <div>
                    <div><button type="submit" name="login_btn" class="bg-blue-500 w-full pr-[12px] pl-[12px] pt-[8px] pb-[8px] rounded-[14px] focus:outline-[2px] outline-offset-2 outline-red-500 text-white font-bold">Login</button></div>
                </div>
            </form>
        </div>
    </div>

    <script src="./js/jquery.js"></script>
</body>
</html>