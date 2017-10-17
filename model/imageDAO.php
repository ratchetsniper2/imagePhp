<?php
	require_once("image.php");
	# Le 'Data Access Object' d'un ensemble images
	class ImageDAO {

		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# A MODIFIER EN FONCTION DE VOTRE INSTALLATION
		# !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# Chemin URL où se trouvent les images
		const urlPath="model/IMG";

		function __construct() {
			try {
				$serverName = 'localhost'; // Data source name
				$user= 'root'; // Utilisateur
				$pass= ''; // Mot de passe

				$this->db = new PDO("mysql:host=$serverName;dbname=image", $user, $pass);
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//$db est un attribut prive d'ImageDAO
			} catch (PDOException $e) {
				die ("Erreur : ".$e->getMessage());
			}
		}

		# Retourne le nombre d'images référencées dans le DAO
		function size() : int {
			return $this->db->query('SELECT count(*) FROM image')->fetch(PDO::FETCH_NUM)[0];
		}

		# Retourne un objet image correspondant à l'identifiant
		function getImage(int $imgId) : Image{
			# Verifie que cet identifiant est correct

			if(!($imgId >= 1 and $imgId <= $this->size())) {
				debug_print_backtrace();
				die("<H1>Erreur dans ImageDAO.getImage: imgId=$imgId incorrect</H1>");
			}

			$s = $this->db->prepare('SELECT * FROM image WHERE id=:id');
			$s->execute(array("id" => $imgId));

			if ($s) {
				$img = $s->fetch();
			} else {
				print "Error in getImage. id=".$imgId."<br/>";
				$err= $this->db->errorInfo();
				print $err[2]."<br/>";
			}

			return new Image(self::urlPath."/".$img["path"], $imgId, $img["category"], $img["comment"]);
		}


		# Retourne une image au hazard
		function getRandomImage() : Image {
			return $this->getImage(random_int(1, $this->size()));
		}

		# Retourne l'objet de la premiere image
		function getFirstImage() : Image {
			return $this->getImage(1);
		}

		# Retourne l'image suivante d'une image
		function getNextImage(Image $img) : Image {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id+1);
			}
			return $img;
		}

		# Retourne l'image précédente d'une image
		function getPrevImage(Image $img) : Image {
			$id = $img->getId();
			if ($id > 1) {
				$img = $this->getImage($id-1);
			}
			return $img;
		}

		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		function jumpToImage(Image $img,int $nb) : Image {
			$id = $img->getId();
			$newId = $id + $nb;

			if ($newId < 1){
				$newId = 1;
			}else if ($newId >= $this->size()){
				$newId = $this->size();
			}

			return $this->getImage($newId);
		}

		# Retourne la liste des images consécutives à partir d'une image
		function getImageList(image $img, int $nb) : array {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			while ($id < $this->size() && $id < $max) {
				$res[] = $this->getImage($id);
				$id++;
			}
			return $res;
		}
	}

	# Test unitaire
	# Appeler le code PHP depuis le navigateur avec la variable test
	# Exemple : http://localhost/image/model/imageDAO.php?test
	if (isset($_GET["test"])) {
		echo "<H1>Test de la classe ImageDAO</H1>";
		$imgDAO = new ImageDAO();
		echo "<p>Creation de l'objet ImageDAO.</p>\n";
		echo "<p>La base contient ".$imgDAO->size()." images.</p>\n";
		$img = $imgDAO->getFirstImage();
		echo "La premiere image est : ".$img->getURL()."</p>\n";
		# Affiche l'image
		echo "<img src=\"".$img->getURL()."\"/>\n";

		$img = $imgDAO->getNextImage($img);
		echo "La seconde image est : ".$img->getURL()."</p>\n";
		echo "<img src=\"".$img->getURL()."\"/>\n";

		$img = $imgDAO->getPrevImage($img);
		echo "L'image précédante est : ".$img->getURL()."</p>\n";
		echo "<img src=\"".$img->getURL()."\"/>\n";

		$img = $imgDAO->jumpToImage($img, 10);
		echo "L'image 10 plus loin est : ".$img->getURL()."</p>\n";
		echo "<img src=\"".$img->getURL()."\"/>\n";
	}
