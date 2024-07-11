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
    <title>Admin Panel . Analytics</title>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.50.0/apexcharts.min.js" integrity="sha512-h3DSSmgtvmOo5gm3pA/YcDNxtlAZORKVNAcMQhFi3JJgY41j9G06WsepipL7+l38tn9Awc5wgMzJGrUWaeUEGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <div class="bg-blue-500 text-white cursor-pointer p-[10px] rounded-[6px]"><a href="" class="font-bold text-[16px] flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-chart-simple text-[16px] font-bold"></i><span></span> Analytics</a></div>
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="create.html" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-square-plus text-[16px] font-bold"></i><span></span> Create</a></div>
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="manage.html" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-list-check text-[16px] font-bold"></i><span></span> Management</a></div>
                    <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="history.html" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-trash text-[16px] font-bold"></i><span></span> History</a></div>
                </div>
            </div>
            <!--Side bar-->

            <!--Right Section-->
            <div class="h-full w-full p-[10px] md:p-[40px] pb-[50px] overflow-y-scroll md:w-[85%]">

                <div class="text-[18px] font-black text-slate-300 select-none mb-[30px]">Admin Analytics Portal</div>
                <div class="grid grid-cols-1 w-full gap-4 md:grid-cols-4">
                    <!--details-->
                        <!--detail one-->
                        <div class="w-full border-[2px] border-solid border-gray-300 flex flex-col items-center p-[15px] rounded-[12px]">
                            <div class="flex flex-row items-center mb-[20px]">
                                <div class="bg-pink-500 rounded-full w-[40px] h-[40px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">S</div>
                                <div class="text-[16px] font-bold text-slate-500 select-none pl-[10px]">Total Sales</div>
                            </div>
                            <div class="flex justify-between items-center space-x-[20px]">
                                <div class="text-[32px] font-black text-slate-900 select-none border-r border-solid border-gray-300 pr-[10px]">120</div>
                                <div class="text-[16px] font-bold text-pink-500 select-none pl-[10px]">Total Sales</div>
                            </div>
                        </div>
                        <!--detail one-->
                        <!--detail one-->
                        <div class="w-full border-[2px] border-solid border-gray-300 flex flex-col items-center p-[15px] rounded-[12px]">
                            <div class="flex flex-row items-center mb-[20px]">
                                <div class="bg-yellow-500 rounded-full w-[40px] h-[40px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">M</div>
                                <div class="text-[16px] font-bold text-slate-500 select-none pl-[10px]">Total Income</div>
                            </div>
                            <div class="flex justify-between items-center space-x-[20px]">
                                <div class="text-[32px] font-black text-slate-900 select-none border-r border-solid border-gray-300 pr-[10px]">$ 120</div>
                                <div class="text-[16px] font-bold text-yellow-500 select-none pl-[10px]">Total Income</div>
                            </div>
                        </div>
                        <!--detail one-->
                        <!--detail one-->
                        <div class="w-full border-[2px] border-solid border-gray-300 flex flex-col items-center p-[15px] rounded-[12px]">
                            <div class="flex flex-row items-center mb-[20px]">
                                <div class="bg-sky-500 rounded-full w-[40px] h-[40px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">L</div>
                                <div class="text-[16px] font-bold text-slate-500 select-none pl-[10px]">Total Listings</div>
                            </div>
                            <div class="flex justify-between items-center space-x-[20px]">
                                <div class="text-[32px] font-black text-slate-900 select-none border-r border-solid border-gray-300 pr-[10px]">120</div>
                                <div class="text-[16px] font-bold text-sky-500 select-none pl-[10px]">Total Listings</div>
                            </div>
                        </div>
                        <!--detail one-->
                        <!--detail one-->
                        <div class="w-full border-[2px] border-solid border-gray-300 flex flex-col items-center p-[15px] rounded-[12px]">
                            <div class="flex flex-row items-center mb-[20px]">
                                <div class="bg-red-500 rounded-full w-[40px] h-[40px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">P</div>
                                <div class="text-[16px] font-bold text-slate-500 select-none pl-[10px]">Total Listings</div>
                            </div>
                            <div class="flex justify-between items-center space-x-[20px]">
                                <div class="text-[32px] font-black text-slate-900 select-none border-r border-solid border-gray-300 pr-[10px]">120</div>
                                <div class="text-[16px] font-bold text-red-500 select-none pl-[10px]">Total Listings</div>
                            </div>
                        </div>
                        <!--detail one-->
                    <!--details-->
                </div>

                <!--Feedback and Piechart-->
                <div class="text-[18px] font-black text-slate-300 select-none mt-[30px] mb-[30px]">Feedback and Listings Analysis</div>
                <div class="flex flex-col w-full space-x-[0px] space-y-[5px] md:space-y-[0px] md:space-x-[5px] md:flex-row">
                    <div class="border-[2px] w-full h-[400px] border-solid border-gray-300 p-[20px] overflow-y-scroll rounded-[6px] md:md:w-[50%]">
                        <div class="text-[14px] font-bold text-slate-300 border-b border-solid border-gray-300 select-none">Contact Feedback</div>
                        <!--Feedbacks-->

                        <div class="w-full p-[15px]">
                            <div class="flex flex-row space-x-[20px]">
                                <div>
                                    <div class="bg-sky-500 rounded-full w-[30px] h-[30px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">L</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-[14px] font-bold text-slate-300 select-none">Caleb | caleb@gmail.com</div>
                                    <div class="text-[16px] font-bold text-pink-500 select-none">Ndashaka inzu</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full p-[15px]">
                            <div class="flex flex-row space-x-[20px]">
                                <div>
                                    <div class="bg-sky-500 rounded-full w-[30px] h-[30px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">L</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-[14px] font-bold text-slate-300 select-none">Caleb | caleb@gmail.com</div>
                                    <div class="text-[16px] font-bold text-pink-500 select-none">Ndashaka inzu</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full p-[15px]">
                            <div class="flex flex-row space-x-[20px]">
                                <div>
                                    <div class="bg-sky-500 rounded-full w-[30px] h-[30px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">L</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-[14px] font-bold text-slate-300 select-none">Caleb | caleb@gmail.com</div>
                                    <div class="text-[16px] font-bold text-pink-500 select-none">Ndashaka inzu</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full p-[15px]">
                            <div class="flex flex-row space-x-[20px]">
                                <div>
                                    <div class="bg-sky-500 rounded-full w-[30px] h-[30px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">L</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-[14px] font-bold text-slate-300 select-none">Caleb | caleb@gmail.com</div>
                                    <div class="text-[16px] font-bold text-pink-500 select-none">Ndashaka inzu</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full p-[15px]">
                            <div class="flex flex-row space-x-[20px]">
                                <div>
                                    <div class="bg-sky-500 rounded-full w-[30px] h-[30px] cursor-pointer flex justify-center items-center font-bold text-[16px] text-white">L</div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="text-[14px] font-bold text-slate-300 select-none">Caleb | caleb@gmail.com</div>
                                    <div class="text-[16px] font-bold text-pink-500 select-none">Ndashaka inzu</div>
                                </div>
                            </div>
                        </div>

                        <!--Feedbacks-->
                    </div>
                    <div class="border-[2px] w-full h-[400px] border-solid flex justify-center items-center border-gray-300 p-[20px] rounded-[6px] md:w-[50%]">
                        <!--Chart-->
                        <div>
                            <canvas id="myPieChart" class="w-full h-full"></canvas>
                        </div>
                        <!--Chart-->
                    </div>
                </div>
                <!--Feedback and Piechart-->

                <!--Previous listings-->
                <div>
                    <div class="text-[18px] font-black text-slate-300 select-none mt-[20px] mb-[30px]">Your Previous Listings</div>
                    <div class="grid grid-cols-1 md:grid-cols-4 space-x-[4px]">
                        <!--Product One-->
                        <div class="w-full bg-white/[90%] p-[5px] rounded-[4px] md:w-[100%] flex flex-col">
                            <div class="w-full h-[200px]">
                                <img src="../images/hero_bg_1.jpg" class="w-full rounded-[6px] h-full object-cover object-center" alt="Product">
                            </div>
                            <div class="p-[10px] rounded-[4px]">
                                <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">$300</div>
                                <p class="font-md text-[14px] text-slate-500 select-none text-start">Upload an Image file of your product here...</p>
                                <a href="" class="font-md text-[14px] text-blue-300 select-none text-start">View Listing <span></span><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--Product One-->
                        <!--Product Two-->
                        <div class="w-full bg-white/[90%] p-[5px] rounded-[4px] md:w-[100%] flex flex-col">
                            <div class="w-full h-[200px]">
                                <img src="../images/hero_bg_2.jpg" class="w-full rounded-[6px] h-full object-cover object-center" alt="Product">
                            </div>
                            <div class="p-[10px] rounded-[4px]">
                                <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">$300</div>
                                <p class="font-md text-[14px] text-slate-500 select-none text-start">Upload an Image file of your product here...</p>
                                <a href="" class="font-md text-[14px] text-blue-300 select-none text-start">View Listing <span></span><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--Product Two-->
                        <!--Product Three-->
                        <div class="w-full bg-white/[90%] p-[5px] rounded-[4px] md:w-[100%] flex flex-col">
                            <div class="w-full h-[200px]">
                                <img src="../images/hero_bg_3.jpg" class="w-full rounded-[6px] h-full object-cover object-center" alt="Product">
                            </div>
                            <div class="p-[10px] rounded-[4px]">
                                <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">$300</div>
                                <p class="font-md text-[14px] text-slate-500 select-none text-start">Upload an Image file of your product here...</p>
                                <a href="" class="font-md text-[14px] text-blue-300 select-none text-start">View Listing <span></span><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--Product Three-->
                        <!--Product Four-->
                        <div class="w-full bg-white/[90%] p-[5px] rounded-[4px] md:w-[100%] flex flex-col">
                            <div class="w-full h-[200px]">
                                <img src="../images/hero_bg_1.jpg" class="w-full rounded-[6px] h-full object-cover object-center" alt="Product">
                            </div>
                            <div class="p-[10px] rounded-[4px]">
                                <div class="text-[18px] font-black text-slate-900 select-none md-[4px]">$300</div>
                                <p class="font-md text-[14px] text-slate-500 select-none text-start">Upload an Image file of your product here...</p>
                                <a href="" class="font-md text-[14px] text-blue-300 select-none text-start">View Listing <span></span><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--Product Four-->
                    </div>
                </div>
                <!--Previous listings-->

            </div>
            <!--Right Scetion-->
        </div>
        <!--Main content-->
    </div>

    <script>
        // Get the context of the canvas element we want to select
        var ctx = document.getElementById('myPieChart').getContext('2d');
        
        // Create the pie chart
        var myPieChart = new Chart(ctx, {
            type: 'pie',  // Specify the chart type
            data: {
                labels: ['Cars', 'Houses'],  // Labels for the pie slices
                datasets: [{
                    label: 'Distribution',
                    data: [60, 40],  // Data values for each slice
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',  // Position of the legend
                    },
                    title: {
                        display: true,
                        text: 'Cars vs. Houses'  // Title of the chart
                    }
                }
            }
        });
    </script>
    
</body>
</html>