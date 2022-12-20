<?php

include 'components/connect.php';

session_start();


$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:user_login.php');
};
if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('uploaded_img'.$fetch_delete_image['image_01']);
    unlink('uploaded_img'.$fetch_delete_image['image_02']);
    unlink('uploaded_img'.$fetch_delete_image['image_03']);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    header('location:trades.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cars</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>
<section class="show-products">

   <h1 class="heading">cars added</h1>

   <div class="box-container">
<?php

$host_name = "localhost";
$database = "shop_db"; // Change your database name
$username = "root";          // Your database user id 
$password = "";          // Your password

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}

// echo $user_id;
// exit;
// $user_id=2;

      $select_products = $conn->prepare('SELECT * FROM products WHERE id_user ='.$user_id.'');


       $select_products->execute();
   


      $tables = $select_products->fetchAll(PDO::FETCH_NUM);

//Loop through our table names.
foreach($tables as $table){
    //Print the table name out onto the page.

   ?>
   <div class="box">
      <img src="uploaded_img<?= $table['4']; ?>" alt="">  
      <div class="name"><?= $table['1']; ?></div>
      <div class="price">$<span><?= $table['3']; ?></span>/-</div>
      <div class="details"><span><?= $table['2']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product1.php?update=<?= $table['0']; ?>" class="option-btn">update</a>
         <a href="trades.php?delete=<?= $table['0']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>

   <?php 

}
if($select_products->rowCount()==0)
{ 
    echo '<p class="empty">no cars added yet!</p>';

}
?>
   </div>
    </section>
   <script src="../js/admin_script.js"></script>
   
   
</body>
</html>