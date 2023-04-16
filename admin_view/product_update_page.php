<?php include("connect.php");
include("product_query.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        span {
            color: #f79e2a;
            font-weight: bold;
        }
    </style>
    <title>Product Update</title>

</head>

<body>
    <div class="container">
        <h1 class="text-center bg-info mb-2 pb-2 pt-2">Update Products</h1>
        <div class="row">
            <?php
            if (empty($_GET['id'])) {
                header("location:dasboard.php");
            }
            $id = $_GET['id'];
            $product_name_err = $product_image_err = $product_discription_err = "";
            $product_name = $file = $discription = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (empty($_POST["product_name"])) {
                    $product_name_err = " producd Name is required";
                } else {
                    $product_name = $_POST["product_name"];
                }
                if (empty($_FILES['product_image'])) {
                    $product_image_err = "product image is requered";
                } else {
                    $file = $_FILES['product_image'];
                }
                if (empty($_POST['discription'])) {
                    $product_discription_err = "please write some discription.";
                } else {
                    $discription = $_POST['discription'];
                }

                $file_name = $file['name'];
                $file_error = $file['error'];
                $file_temp = $file['tmp_name'];
                $file_ext = explode('.', $file_name);
                $file_check = strtolower(end($file_ext));
                $file_ext_stored = array('jpg', 'png', 'jpeg');
                if ($product_name_err == "" && $product_image_err == "" && $product_discription_err == "") {
                    if (in_array($file_check, $file_ext_stored)) {
                        $destination_file = $file_name;
                        move_uploaded_file($file_temp, '../image/' .  $destination_file);

                        $result = update_product($product_name, $discription, $destination_file, $id);
                        if ($result) {
                            echo "data updated";
                        }
                    }
                }
            }

            if (isset($id)) {
                $result = one_product_list($id);

                if (mysqli_num_rows($result) == 0) {
                    header("location:dasboard.php");
                }
            ?>
                <div class="row">

                    <?php

                    $row = mysqli_fetch_assoc($result);

                    ?>
                    <div class="col-sm-6 m-auto mt-3 text-center"> <img src="../image/<?php echo $row['image']; ?>" height="100px" width="100px" class="m-4 ">
                        <h6><?php echo $row['product_name']; ?></h6>
                        <p> <?php echo $row['discription']; ?></p>
                    </div>

                    <div class="col-sm-6 m-auto">

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" name="product_name" class="form-control" placeholder="product name" value="<?php echo $row['product_name']; ?>">
                            <span><?php echo $product_name_err; ?></span> <br><br>
                            <input type="file" name="product_image" class="form-control" placeholder=""><br><br>
                            <span><?php echo $product_image_err; ?></span>
                            <textarea name="discription" rows="3" cols="25" class="form-control mb-3" placeholder="discription"><?php echo $row['discription']; ?>"</textarea>
                            <span><?php echo $product_discription_err; ?></span><br>
                            <input type="submit" name="submit" class="btn btn-success" value="Update">
                        </form>
                    </div>
                <?php

            }

                ?>
                </div>
                <?php

                if (isset($id)) {
                    $sql = "SELECT name,rating,comment FROM product_review WHERE product_id = $id ORDER BY id DESC";
                    $result = mysqli_query($con, $sql);


                ?>
                    <div class="row">

                        <?php

                        while ($row = mysqli_fetch_array($result)) {

                        ?>

                            <div class="col-lg-7 text-center">
                                <h6 style=color:blue;><?php echo $row['rating'] . "/5 &#9734"; ?> </h6>
                                <h5 style=color:green;><?php echo $row['name'];  ?> </h5>
                                <p><?php echo $row['comment'];  ?> </p>
                            </div>

                    <?php

                        }
                    }

                    ?>
                    </div>





        </div>

    </div>
</body>

</html>