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
</head>
<body>
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
</body>
</html>