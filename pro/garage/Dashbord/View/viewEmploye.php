<?PHP
	include ("../Controller/employec.php");

	$employec=new employec();
	$listeemploye=$employec->afficherEmploye();
    
if(isset($_POST['submit']))
{
    $listeemploye=$employec->afficherEmploye();
}

if(isset($_POST['ajout']))
{
    header ('Location:addEmploye.php');
}

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>View Employe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/style.css">

	</head>

	<body>
	<section class="ftco-section">
		<div class="container">
            <h3 class="mb-4 text-center"><FONT COLOR="WHITE"><strong>View Employe</strong></FONT></h3>
            <br>
            <br>
            <div class="form-group">
                <a href="addEmploye.php">
                    <button type="ajout" name="actualiser" value="Ajouter" class="btn btn-primary">
                        Ajouter
                    </button>
                </a>
            </div>
            <div class="form-group">
                <a href="http://localhost/pro/home.php">
                    <button type="ajout" name="actualiser" value="Ajouter" class="btn btn-primary">
                        return to website
                    </button>
                </a>
            </div>
            <table id="myTable" class="table table-striped" >  
                <thead>
                    <th><FONT COLOR="WHITE">ID</FONT></th>
                    <th><FONT COLOR="WHITE">Name</FONT></th>
                    <th><FONT COLOR="WHITE">Email</FONT></th>
                    <th><FONT COLOR="WHITE">Salaire</FONT></th>
                    <th><FONT COLOR="WHITE">ID Garage</FONT></th>
                    <th><FONT COLOR="WHITE"></FONT></th>
                    <th><FONT COLOR="WHITE"></FONT></th>
                </thead>
                <tbody>
                    <?PHP
				        foreach($listeemploye as $emp){
			        ?>
                    <tr>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $emp['idEmp']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $emp['name']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $emp['email']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $emp['salaire']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $emp['idg']; ?></FONT>
                        </td>
                        <td>
                            <div class="form-group">
                                <form method="POST" action="deleteEmploye.php?idEmp=<?php echo $emp['idEmp']?>">
                                    <input type="submit" name="Supprimer" value="Supprimer" class="btn btn-primary">
                                    <input type="hidden" value=<?PHP echo $emp['idEmp']; ?> name="idEmp">
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <a href="modifyEmploye.php?idEmp=<?PHP echo $emp['idEmp']; ?>">
                                    <input type="submit" value="Modfier" class="btn btn-primary">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?PHP
				        }
			        ?>
                </tbody>
            </table>
            
		</div>
	</section>


	<script src="js/jquery.min.js"></script>
  	<script src="js/popper.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/jquery.validate.min.js"></script>
  	<script src="js/main.js"></script>

	</body>
</html>

