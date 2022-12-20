<?php
	require_once '../Controller/employec.php';
	require_once '../Controller/garagec.php';
    require_once '../Model/employe.php';

    $error = "";
    // create user
    $employe = null;
    // create an instance of the controller
    $employec = new employec();
	$garagec = new garagec();

    if (
        isset($_POST["email"]) &&
        isset($_POST["name"]) &&
        isset($_POST["salaire"])&&
        isset($_POST["idg"])
        
    ) {
        if (
            !empty($_POST["email"]) &&
            !empty($_POST["name"]) &&
            !empty($_POST["salaire"])&&
            !empty($_POST["idg"])
            
        ) {
            $employe = new employe(
                $_POST['email'],
                $_POST['name'],
                $_POST['salaire'],
                $_POST['idg']
            );
			$employec->ajouterEmploye($employe);
        }
        else
            $error = "Missing information";
    }  
	if(isset($_POST['submit']))
	{
    	header ('Location:viewEmploye.php');
	}

	$liste=$garagec->affichergarage();

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Add Employe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/style.css">

	</head>

	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-12">
					<div class="wrapper">
						<div class="row justify-content-center">
							<div class="col-lg-8">
								<div class="contact-wrap">
									<h3 class="mb-4 text-center"><strong>Add Employe</strong></h3>
									<br>
									<br>
									<div id="form-message-warning" class="mb-4 w-100 text-center"></div> 
										<form method="POST" id="contacForm" name="contactorm" class="contactForm">
											<div class="row">
												<div class="col-md-12"> 
													<div class="form-group">
														<input type="text" class="form-control" name="email" placeholder="Email">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" name="name" placeholder="Name">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="text" class="form-control" name="salaire" placeholder="Salaire">
													</div>
												</div>
												<div class="col-md-12">
													<select name="idg" class="form-control p-6" style="height: 50px;">
														<option value="">Select Garage</option>)
														<?php foreach($liste as $gar){?>
														<option value="<?php echo $gar['ID_garage'];?>"><?php echo $gar['Nom_garage'];?></option>
														<?php } ?>
													</select>
													<br>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="submit" name="submit" value="Ajouter Employe" onclick="return okEvent();" class="btn btn-primary">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="js/jquery.min.js"></script>
  	<script src="js/popper.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/jquery.validate.min.js"></script>
  	<script src="js/main.js"></script>

	</body>
</html>

