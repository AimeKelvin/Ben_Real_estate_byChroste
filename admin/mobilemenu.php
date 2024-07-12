<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="absolute z-9999 pt-[90px] bg-white top-0 bottom-0 left-0 right-0 w-full h-[100vh] flex justify-center items-center md:hidden" id="menu" style="display: none;">
        <div class="flex flex-col space-y-[20px]">
        <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="./analytics.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-chart-simple text-[16px] font-bold"></i><span></span> Analytics</a></div>
            <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="./cars/create.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-square-plus text-[16px] font-bold"></i><span></span> Create</a></div>
            <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="./manage.php" class="font-bold text-[16px] flex  text-slate-400  flex-row items-center space-x-[6px]"><i class="fa-solid fa-list-check text-[16px] font-bold"></i><span></span> Management</a></div>
            <div class="hover:bg-slate-200 cursor-pointer p-[10px] rounded-[6px]"><a href="./history.php" class="font-bold text-[16px] text-slate-400 flex flex-row items-center space-x-[6px]"><i class="fa-solid fa-trash text-[16px] font-bold"></i><span></span> History</a></div>
        </div>
    </div>

    <script src="./js/main.js"></script>
</body>
</html>