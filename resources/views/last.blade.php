<?php
    if ($id==null){
    header('Location: /home');
    exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{route('download-variant',$id)}}"><button class="btn btn-danger">Download variant</button></a>
    <a href="{{route('download-vidpovidi',$id)}}"><button class="btn btn-danger">Download vidpovidi</button></a>
    <a href="{{route('download-data',$id)}}"><button class="btn btn-danger">Download data</button></a>
</body>
</html>
