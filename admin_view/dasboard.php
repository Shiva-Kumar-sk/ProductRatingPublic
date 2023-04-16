<?php session_start();
include("connect.php");
include("product_query.php");

if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>dasboard</title>
    <style>
        a {
            color: #000;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <br>
    
        <div class="col-md-12 offset-sm-8 d-flex mb-5 float-end bg-success">
            <form action="" method="post">
                <button name="logout" class="btn btn-danger m-4">logout</button>
            </form>
            <a href="insert_new_product.php" class="btn btn-primary m-4">Add NEW Product</a>
        </div>
    
    <?php
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("location:index.php");
    }
    $result = select_all_for_admin();
    ?>

    <div class="container">
        <div class="row">
            <?php
            while ($rows = mysqli_fetch_array($result)) {

            ?>
                <div class="col-sm-4 mb-4">
                    <a href="product_update_page.php?id=<?php echo $rows['id'] ?>">
                    <img src="../image/<?php echo $rows['image']; ?>" alt="" height="200px" width="200px">
                        <h2><?php echo $rows['product_name']; ?></h2>
                    </a>
                    <?php if(!is_null($rows['total_rating']) ) {?>
                    <h6 style="color:blue;"> <?php $x = $rows['total_rating'];
                               $y = $rows['total_review'];
                               $m = $x/$y;
                               echo $m."/5 &#9734";   ?> </h6>
                               <?php } ?>
                </div>

            <?php
            }

            ?>
        </div>

    </div>

</body>

</html>