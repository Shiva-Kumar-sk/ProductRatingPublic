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


     //admin login
    function admin_login($name)
    {
        $sql = "SELECT * FROM admin_login WHERE admin_name='$name' limit 1";
        $result = mysqli_query($GLOBALS['con'], $sql);
        return $result;
    }

     //select all for admin
    function select_all_for_admin()
    {
        $sql = "SELECT product_info.*, sum(product_review.rating) as total_rating, count(product_review.id) as total_review FROM product_info
        left join product_review on product_info.id = product_review.product_id
        group by product_info.id ORDER BY id DESC";
        $result = mysqli_query($GLOBALS['con'], $sql);
        return $result;
    }

     // for insert new product
    function insert_new_product($product_name, $discription, $destination_file)
    {
        $sql = "INSERT INTO product_info(product_name,discription,image) VALUES ('$product_name','$discription','$destination_file')";
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

    //for preview select product for update page
    function one_product_list($id)
    {
        $sql = "SELECT product_name ,discription, image FROM product_info WHERE id = $id limit 1";
        $result = mysqli_query($GLOBALS['con'], $sql);
        return $result;
    }







   
   

   

   
   

    


    ?>
</body>

</html>