<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Querys</title>
</head>

<body>
    <?php
    include("connect.php");
    //for public page
    function select_all_item()
    {
        $sql = "SELECT product_info.*, sum(product_review.rating) as total_rating, count(product_review.id) as total_review FROM product_info
        left join product_review on product_info.id = product_review.product_id
        group by product_info.id";
        $result = mysqli_query($GLOBALS['con'], $sql);
        return $result;
    }

    //for review page select one item
    function select_one_product($id)
    {
        $query = "SELECT product_name,image FROM product_info WHERE id = $id limit 1";
        $result = mysqli_query($GLOBALS['con'], $query);
        return $result;
    }
    // for review 
    function select_review($id)
    {
        $sql = "SELECT rating,name,comment FROM product_review WHERE product_id = $id ";
        $res = mysqli_query($GLOBALS['con'], $sql);
        return $res;
    }
    // for check  review already exist or not if not then insert.
    function check_user($email, $id)
    {
        $forcheck = "SELECT*FROM product_review WHERE email='$email' AND product_id='$id'";
        $check = mysqli_query($GLOBALS['con'], $forcheck);
        return $check;
    }

    function insert_review($id, $name, $email, $rate, $comment)
    {
        $msql = "INSERT INTO product_review(product_id,name,email,rating,comment) VALUES('$id','$name','$email','$rate','$comment')";
        $resu = mysqli_query($GLOBALS['con'], $msql);
        return $resu;
    }
    // for insert new product
    function insert_new_product($product_name,$discription,$destination_file)
    {
        $sql = "INSERT INTO product_info(product_name,discription,image) VALUES ('$product_name','$discription','$destination_file')";
                    $result = mysqli_query($GLOBALS['con'], $sql);
                    return $result;
    }

    //admin login
    function admin_login($name){
        $sql = "SELECT * FROM admin_login WHERE admin_name='$name' limit 1";
            $result = mysqli_query($GLOBALS['con'], $sql);
            return $result;
    }

    //select all for admin
    function select_all_for_admin(){
        $sql = "SELECT * FROM product_info ORDER BY id DESC";
    $result = mysqli_query($GLOBALS['con'], $sql);
    return $result;
    }
    // for update product
    function update_product($product_name, $discription, $destination_file, $id)
    {
        $sql = "UPDATE product_info SET product_name='$product_name',discription='$discription',image='$destination_file'  WHERE id = '$id' ";
        $result = mysqli_query($GLOBALS['con'], $sql);
        return $result;
    }


    ?>
</body>

</html>