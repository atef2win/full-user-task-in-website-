<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if($user_id == ''){
    echo '<p class="empty">please login to add rate</p>';
 }else 
 {

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['rating']))
{
   
    $rostom = $_POST['name'];
   
    $rating = $_POST['rating'];
    
    $data = array(

		':name'		=>	$rostom,
		':rate'		=>	$_POST['rating']
		
	);
    
    $sql = "INSERT INTO ratee (name,rate) VALUES (:name,:rate)";
    $message[] = 'rate is added!';
   
	

	$statement = $conn->prepare($sql);

	$statement->execute($data);
    
    
    
}       
 
}
?>


<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
      
<?php include 'components/user_header.php'; ?>
<div class="contact">
    <div class="row">

<form action="add_rate.php" method="post">

    <div>
        <h1> Rating System </h1>
    </div>

    <div >
         <h2>Name:</h2>
        <input type="text" name="name" minlength="3" required class="box">
        </div>

         <div class="rateyo" id= "rating"
         data-rateyo-rating="4"
         data-rateyo-num-stars="5"
         data-rateyo-score="3">
         </div>

    <span class='result'>0</span>
    <input type="hidden" name="rating">
    <div>  <input type="submit" value="send rate" name="send" class="btn"> </div>
    </div>

   

</form>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>


    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });

</script>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>

</html>
