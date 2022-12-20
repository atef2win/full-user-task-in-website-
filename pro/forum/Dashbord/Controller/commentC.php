<?php

class config
{
    function getConnexion () {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'shop_db';
        try {
            $pdo = new PDO(
                "mysql:host=$servername;dbname=$dbname",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        // echo "Connected successfully";
            return $pdo;
        }
        catch(PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }
    }
}
?>
<?PHP
	
	include '../components/connect.php';
	include ("Dashbord/Model/comment.php");

	class commentC {
		function ajouterComment($comment){
			 $sql="INSERT INTO comment ( name, comment , idPost) 
			 VALUES (:name, :comment,:idPost)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
			 	$query = $conn->prepare($sql);
			 	$query->execute([
				'name' => $comment->getName(),
				'comment' => $comment->getComment(),
				'idPost' => $comment->getIdPost()
			]);			
			}
			catch (Exception $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function afficherComment(){
			$sql="SELECT * FROM comment";
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


        function supprimerComment($iddd){
			$sql="DELETE FROM comment WHERE id= :id";
			$conn = new config();
            $db=$conn->getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$iddd);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}


        function recupererReponse($idReponse){
			$sql="SELECT * from reponse where id=$idReponse";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$garage=$query->fetch();
				return $garage;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

		function afficherCommentPost($id){
			$sql="SELECT * FROM comment WHERE idPost = ".$id;
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
	}

?>