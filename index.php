<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $uri = $_SERVER['REQUEST_URI'];
    $uri = explode('/', $uri);
    $uri = "/" . $uri[2];
    ?>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS REF -->
    
    <?php echo $uri!="/"?'':'<link rel="stylesheet" href="resources/css/LandingPage.css">'?>
    <?php echo $uri!="/login"?'':'<link rel="stylesheet" href="resources/css/login.css">'?>
    <?php echo $uri!="/rapport"?'':'<link rel="stylesheet" href="resources/css/VisiteurPage.css">'?>
    
    <!-- Boostrap Jquery / CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/f586a409a9.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php
    require('Controller.php');
    ?>
</body>

</html>