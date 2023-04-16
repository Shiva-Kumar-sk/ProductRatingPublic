<?php
session_start();
if(isset($_SESSION['admin_id'])){
    header("location:dasboard.php");
}

include("connect.php");
include("product_query.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: #2596be;
            background: blend mode 5px;

        }

        .btn1 {
            border: none;
            outline: none;
            height: 40px;
            width: 50%;
            background-color: #8bff30;
            color: wheat;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 200px;
            margin-left: 90px;
            margin-bottom: 50px;
        }

        .btn1:hover {
            background-color: white;
            color: #000;
            box-shadow: 10px 10px 10px 0 black;

        }

        span {
            color: #f79e2a;
            font-weight: bold;
        }

        .form {
            margin-top: -100px;
            padding-bottom: 50px;
            border-radius: 20px;
            height: 500px;
            width: 400px;
            /* background-color:darkgray; */
            background-color: rgba(40, 61, 105, 0.2);
            text-align: center;
            box-shadow: 10px 10px 10px 0 black;

        }

        h2 {
            font-weight: bold;
            padding-top: 25px;
        }

        .main {
            margin-top: 80px;
        }

        .form-control {
            background-color: rgba(40, 61, 105, 0.5);
            width: 80%;
            margin-left: 40px;

        }
    </style>
    <title>admin login</title>
</head>

<body>
    <?php
    $nameerr = "";
    $passworderr = "";
    $name = "";
    $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["user_name"])) {
            $nameerr = "User Name is required";
        } else {
            $name = test_input($_POST["user_name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameerr = "Only letters and white space allowed";
            }
            if (strlen($name) < 3) {
                $nameerr = " !user name must be minimum  3 characters.";
            } elseif (strlen($name) > 20) {
                $nameerr = "!user name must be maximum  25 characters.";
            }
        }
        if (empty($_POST['password'])) {
            $passworderr = "password is requered";
        } else {
            $password = test_input($_POST['password']);
            if (strlen($password) < 4) {
                $passworderr = "!password may be minimum four characters.";
            }
            if (strlen($password) > 16) {
                $passworderr = "!password may be maximum sixteen characters.";
            }
        }
        if ($nameerr == "" && $passworderr == "") {
            $name = $_POST['user_name'];
            $password = $_POST['password'];
            $password = md5($password);
            $result = admin_login($name);
            $rows = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0 && $rows['admin_password'] == $password ) {
                
                $_SESSION['admin_id'] = $rows['id'];
                $_SESSION['admin_name'] = $rows['admin_name'];
                header("location:dasboard.php");
            } else {
                $nameerr = "userid or password incorrect";
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


    ?>

    <div class="container">
        <div class="row main">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 my-5 form">
                <h2>Wellcom to login page</h2>
                <form action="" method="post">
                    <div class="row mt-4">
                        <input type="text" name="user_name" placeholder="@shiva" class="form-control" autocomplete="off">
                        <span><?php echo "*" . $nameerr; ?></span>
                    </div>
                    <div class="row mt-4">
                        <input type="password" name="password" placeholder="******" class="form-control">
                        <span><?php echo "*" . $passworderr; ?></span>
                    </div>
                    <div class="row ">
                        <button type="submit" name="submit" class="btn1">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>

        </div>

    </div>
    <?php


    ?>

</body>

</html>