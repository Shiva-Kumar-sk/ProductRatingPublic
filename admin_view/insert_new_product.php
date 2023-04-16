<?php include("connect.php");
include("product_query.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>insert new product</title>
</head>

<body>
    <div class="container">
        <br>
        <h2 class="text-white text-center p-4 bg-primary display-4">Add New Product</h2>
        <div class="row">
            <?php
            $product_name_err = $product_image_err = $product_discription_err = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $product_name = $file = $discription = "";
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



                // if (isset($_POST['submit'])) {
                $file = $_FILES['product_image'];
                // $product_name = $_POST['product_name'];
                $discription = $_POST['discription'];
                $file_name = $file['name'];
                $file_error = $file['error'];
                $file_temp = $file['tmp_name'];

                $file_ext = explode('.', $file_name);
                $file_check = strtolower(end($file_ext));

                $file_ext_stored = array('jpg', 'png', 'jpeg');

                if (in_array($file_check, $file_ext_stored)) {
                    $destination_file = $file_name;
                    move_uploaded_file($file_temp,  '../image/' . $destination_file);


                    $result = insert_new_product($product_name, $discription, $destination_file);
                    if ($result) {
                        echo "data inserted";
                    }
                }
            }

            ?>
            <div class="col-sm-6 m-auto">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="product_name" class="form-control" placeholder="product name">
                    <span><?php echo $product_name_err; ?></span> <br><br>
                    <input type="file" name="product_image" class="form-control" placeholder=""><br><br>
                    <span><?php echo $product_image_err; ?></span>
                    <textarea name="discription" rows="3" cols="25" class="form-control mb-3" placeholder="discription"></textarea><br>
                    <span><?php echo $product_discription_err; ?></span>
                    <input type="submit" name="submit" class="btn btn-success" value="Add">


                </form>
            </div>

        </div>

    </div>
</body>

</html>