<?PHP
	
	include_once ("../../config.php");
	include ("../Model/employe.php");

	class employec {
		function ajouterEmploye($employe){
			 $sql="INSERT INTO employe (email, name,salaire,idg) 
			 VALUES (:email, :name, :salaire, :idg)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
			 	$query = $conn->prepare($sql);
			 	$query->execute([
				'email' => $employe->getEmail(),
				'name' => $employe->getName(),
		 		'salaire' => $employe->getSalaire(),
				'idg' => $employe->getIDG()
			]);			
			}
			catch (Exception $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function afficherEmploye(){
			$sql="SELECT * FROM employe";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
			
		}


        function supprimerEmploye($id){
			$sql="DELETE FROM employe WHERE idEmp= :id";
			$conn = new config();
            $db=$conn->getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$id);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

        function modifierEmploye($employe, $id){
			
			try {
				
				$conn = new config();
            	$db=$conn->getConnexion();
				$query = $db->prepare(
					"UPDATE employe SET 
						email = :email,
						name = :name,
						salaire = :salaire,
						idg = :idg
					    WHERE idEmp = :idEmp"
				);
				$query->execute([
					'email' => $employe->getEmail(),
					'name' => $employe->getName(),
					'salaire' => $employe->getSalaire(),
					'idg' => $employe->getIDG(),
					'idEmp' => $id
				]);
				echo $query->execute;
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}


        function recupererEmploye($id){
			$sql="SELECT * from employe where idEmp=$id";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$employe=$query->fetch();
				return $employe;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

	}

?>