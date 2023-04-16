<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>public page</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: wheat;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>

</head>

<body>

    <?php
    include("connect.php");
    include("product_query.php");
    $result = select_all_item();

    ?>
    <div class="container-fluid mb-5">
        <h1 class="display-4 bg-primary text-center p-3">XYZ.COM</h1>
        <div class="row">


            <?php
            
            while ($row = mysqli_fetch_array($result)) {

            ?>
                <div class="col-sm-4 mb-2 mt-5 item">
                    <a href="product_all_detail.php?id=<?php echo $row['id'] ?>">
                        <img src=" ../image/<?php echo $row['image']; ?>" height="200px" width="200px"><br>
                        <h5><?php echo $row['product_name']; ?></h5>
                    </a> 
                    <?php if(!is_null($row['total_rating']) ) {?>
                    <h6 style="color:green;"> <?php $x = $row['total_rating'];
                               $y = $row['total_review'];
                               $m = $x/$y;
                               echo $m."/5 &#9734";   ?> </h6>
                               <?php } ?>
                </div>

            <?php } ?>
        </div>
    </div>

</body>

</html>