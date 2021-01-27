<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php
   //connect hướng thủ tục
   $connect= mysqli_connect('localhost', 'root','','mywebsite');
   if(!$connect)
    {
        echo "ket noi that bai";
    }   else{
        echo "ket noi thanh cong";
    }
    // kết nối bằng hướng đối tượng
    // $connect= mysqli( giống kết nối hướng thủ tục)
   ?>
</body>
</html>