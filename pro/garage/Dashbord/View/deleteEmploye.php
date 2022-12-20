<?PHP
	include "../Controller/employec.php";

	$employec=new employec();
	
	if (isset($_POST["idEmp"])){
		$employec->supprimerEmploye($_POST["idEmp"]);
		header ('Location:viewEmploye.php');
	}
?>