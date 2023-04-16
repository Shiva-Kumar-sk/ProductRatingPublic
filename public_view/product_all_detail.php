<?php include("connect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

    </style>
</head>

<body>
    <div class="container container1">
    <h1 class="display-4 bg-primary text-center p-3">Ratings</h1>


        <?php
        include("product_query.php");

        if (empty($_GET['id'])) {
            header("location:index.php");
        }
        $id = $_GET['id'];
        $nameerr = $emailerr = $rateerr = $commenterr = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $email = $rate = $comment = "";
            if (empty($_POST["name"])) {
                $nameerr = "Name is required";
            } else {
                $name = test_input($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                    $nameerr = "Only letters and white space allowed";
                }

                if (strlen($name) < 3) {
                    $nameerr = " minimum  3 characters allowed.";
                } elseif (strlen($name) > 20) {
                    $nameerr = " maximum  25 characters allowed.";
                }
            }

            if (empty($_POST["email"])) {
                $emailerr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailerr = "Invalid email format";
                }
            }

            if (empty($_POST["rate"])) {
                $rateerr = "rating requier";
            } else {
                if ($rate > 5) {
                    $rateerr = "rate under 5 rating";
                } else {
                    $rate = test_input($_POST["rate"]);
                }
            }

            if (empty($_POST["comment"])) {
                $commenterr = " comment requierd";
            } else {
                $comment = test_input($_POST["comment"]);
            }

            // for check  review already exist or not if not then insert.
            if ($nameerr == "" && $emailerr == "" && $rateerr == "" && $commenterr == "") {
                $check = check_user($email , $id);
                if (mysqli_num_rows($check) > 0) {
                    $nameerr = "you have allrady rated this product!";
                } else {
                    $resu = insert_review($id,$name,$email,$rate,$comment);
                    if ($resu == true) {
                        header('location:product_all_detail.php?id=' . $id);
                    }
                }
            }
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (isset($id)) {

            // product all detail.
           $result = select_one_product($id);
            if (mysqli_num_rows($result) == 0) {
                header("location:index.php");
            }
        ?>
            <div class="row">

                <?php
                $rew = mysqli_fetch_assoc($result);

                ?>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-7"> <img src=" ../image/<?php echo $rew['image']; ?>" height="100px" width="100px">
                        <h6><?php echo $rew['product_name']; ?></h6>

                    </div>
                    <div class="col-sm-1"></div>


             <?php

                
        }
             ?>
            </div>

            <?php

            // product review.

            if (isset($id)) {
               $res = select_review($id)
                
            ?>
                <div class="row">

                    <?php

                    while ($row = mysqli_fetch_array($res)) {

                    ?>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-7">
                            <h6 style=color:blue;><?php echo $row['rating'] . "/5 &#9734"; ?> </h6>
                            <h5 style=color:green;><?php echo $row['name'];  ?> </h5>
                            <p><?php echo $row['comment'];  ?> </p>
                        </div>
                        <div class="col-sm-1"></div>

                <?php

                    }
                }

                ?>
                </div>

                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4 m-5">

                        <h4 style=color:orange;> * Please Rate This Product * <h4>


                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Enter Your Name" autocomplete="off" class="form-control">
                                    </div>
                                    <span class="error"> <?php echo $nameerr; ?></span><br>
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Enter Your Email" autocomplete="off" class="form-control">
                                    </div>
                                    <span class="error"> <?php echo $emailerr; ?></span><br>
                                    <div>
                                        <input type="range" name="rate" min="1" max="5">
                                    </div>
                                    <span class="error"> <?php echo $rateerr; ?></span>
                                    <div class="form-group">
                                        <textarea name="comment" rows="3" cols="25" class="form-control"></textarea>
                                    </div>
                                    <span class="error"> <?php echo $commenterr; ?></span><br>

                                    <input type="submit" name="submit" value="Rate" class="btn btn-success btn-block">


                                </form>
                    </div>


                    <div class="col-4"></div>


                </div>

    </div>

</body>

</html>