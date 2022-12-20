<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
 
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){

   $trade=$_POST['trade'];
   $trade = filter_var($trade, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
  

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id,trade,name, email, method, address) VALUES(?,?,?,?,?,?)");
      $insert_order->execute([$user_id,$trade,$name, $email, $method, $address]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your cart is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
  

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>your trades</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         $select_user = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_user->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
             
      ?>
         
      <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
         
         
      </div>

      <h3>place your trade</h3>
      
        

               <div class="flex">
                  <div class="box-container">
            <?php
               $grand_total = 0;
               $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
               $select_cart->execute([$user_id]);
               $select_products = $conn->prepare('SELECT * FROM products WHERE id_user ='.$user_id.'');
                $select_products->execute();
                $tables = $select_products->fetchAll(PDO::FETCH_NUM);

               if($select_cart->rowCount() > 0){
                  while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="box">
               <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
               <img src="uploaded_img<?= $fetch_cart['image']; ?>" alt="">
               <div class="display-orders">trade by <?= $fetch_cart['name']; ?></div>
            </form>
            <?php
               }
            }
            ?>
            </div>
          
         <div class="inputBox">
        <div class="from-group mb-3">
        <label name="trade" for="">choose from your trades</label>
        <select name="trade" class="box">
           <option name="trade" value="">--Select car ye djo--</option>
           <option name="trade"><?php     foreach($tables as $table){
               //Print the table name out onto the page.

               ?>
               <div class="box">
                  <img src="uploaded_img<?= $table['4']; ?>" alt="">  
                  <div class="name"><?= $table['1']; ?></div>
                  <div class="details"><span><?= $table['2']; ?></span></div>
                  <div class="flex-btn">
                  
                  </div>
               </div>

               <?php 

            }
            if($select_products->rowCount()==0)
            { 
               echo '<p class="empty">no cars added yet!</p>';

            }
            ?>


          </div></option>
                                                
        </select>
        </div>
        
          <div class="inputBox">
          <span>your name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" maxlength="50" required>
         </div>
        
                            <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>trade method :</span>
            <select name="method" class="box" required>
               <option value="tarde">trade car by car</option>
               <option value="trade">trade and add money</option>
            </select>
         </div>
         
         <div class="inputBox">
            <span>send a message to the owner</span>
            <input type="text" name="message" placeholder="enter your message" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="flat" placeholder="hachene" class="box" maxlength="50" required>
         </div>
        

      <input type="submit" name="order" class="btn " value="send request">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>