<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include("bddLogin.php");

    $query = $bdd->prepare('SELECT * FROM rapport_visite');
    $query->execute();
    $post = $query->fetchAll(PDO::FETCH_OBJ);
    var_dump($post[0]->RAP_NUM);
    ?>

    <form action="" method="POST">
        <input type="text" name="name" value="<?= htmlentities($post[1]->RAP_NUM)?>">

    </form>

</body>

</html>