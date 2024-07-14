<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page</title>
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
        <div>
            <div class="font-black text-[36px] text-slate-900 select-none">
                404 NOT FOUND
            </div>
            <div class="mt-[30px] flex justify-center">
                <?php
                $previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'analytics.php';
                ?>
                <a href="<?php echo htmlspecialchars($previousPage); ?>" class="bg-slate-500 pr-[12px] pl-[12px] pt-[8px] pb-[8px] rounded-[14px] focus:outline-[2px] outline-offset-2 outline-red-500 text-white font-bold">Back</a>
            </div>
        </div>
    </div>
</body>
</html>