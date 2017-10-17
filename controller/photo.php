<?php

require_once("model/image.php");
require_once("model/imageDAO.php");

class Photo {
	
	// La taille par défaut des images
	const DEFAULT_SIZE = 480;
	
	private $imgDAO;
	
	public function __construct(){
		$this->imgDAO = new ImageDAO();
	}
	
	/**
	 * Crée les données pour les vue (menu / information sur l'image)
	 * 
	 * @param Image $img L'image à afficher
	 * @param int $imgSize La taille de l'image à afficher
	 * 
	 * @return array
	 */
	private function getData(Image $img, int $imgSize = null) : array{
		if ($imgSize == null){
			// Si il n'y a pas de taille demandé, on garde la meme taille ou celle par defaut
			if (isset($_GET["size"]) && is_numeric($_GET["size"])) {
				$imgSize = $_GET["size"];
			} else {
				$imgSize = self::DEFAULT_SIZE;
			}
		}
		$data["imgSize"] = $imgSize;
		
		$data["imgUrl"] = $img->getURL();
		$data["imgId"] = $img->getId();
		$data["imgComment"] = $img->getComment();
		$data["imgCategory"] = $img->getCategory();
		
		// menu
		$imgId = $img->getId();
		
		$data["menu"]['Home'] = "index.php";
		$data["menu"]['A propos'] = "index.php?controller=home&action=aproposAction";
		$data["menu"]['First'] = "index.php?controller=photo&action=firstAction&size=$imgSize";
		$data["menu"]['Random'] = "index.php?controller=photo&action=randomAction&size=$imgSize";
		$data["menu"]['More'] = "index.php?controller=photoMatrix&imgId=$imgId";    
		$data["menu"]['Zoom +'] = "index.php?controller=photo&action=zoomAction&imgId=$imgId&size=$imgSize&zoom=1.25";
		$data["menu"]['Zoom -'] = "index.php?controller=photo&action=zoomAction&imgId=$imgId&size=$imgSize&zoom=0.75";

		return $data;
	}

	/**
	 * Action par defaut
	 * Afficher la première image
	 */
	public function indexAction(){
		$this->firstAction();
	}
	
	/**
	 * Afficher la première image
	 */
	public function firstAction(){
		$img = $this->imgDAO->getFirstImage();
		$data = $this->getData($img);
		
		$data["view"] = "photoView.php";
		
		require_once("view/mainView.php");
	}
	
	/**
	 * Afficher l'image suivante
	 */
	public function nextAction(){
		// Récupération de l'image
		if (isset($_GET["imgId"]) && is_numeric($_GET["imgId"])) {
			$imgId = $_GET["imgId"];
			$img = $this->imgDAO->getNextImage($this->imgDAO->getImage($imgId));
		} else {
			// Pas d'image, se positionne sur la première
			$img = $this->imgDAO->getFirstImage();
		}
		
		$data = $this->getData($img);
		
		$data["view"] = "photoView.php";

		require_once("view/mainView.php");
	}
	
	/**
	 * Afficher l'image précédente
	 */
	public function prevAction(){
		// Récupération de l'image
		if (isset($_GET["imgId"]) && is_numeric($_GET["imgId"])) {
			$imgId = $_GET["imgId"];
			$img = $this->imgDAO->getPrevImage($this->imgDAO->getImage($imgId));
		} else {
			// Pas d'image, se positionne sur la première
			$img = $this->imgDAO->getFirstImage();
		}
		
		$data = $this->getData($img);
		
		$data["view"] = "photoView.php";

		require_once("view/mainView.php");
	}
	
	/**
	 * Afficher une image aléatoire
	 */
	public function randomAction(){
		$img = $this->imgDAO->getRandomImage();
		
		$data = $this->getData($img);
		
		$data["view"] = "photoView.php";

		require_once("view/mainView.php");
	}
	
	/**
	 * Afficher l'image avec un zoom
	 */
	public function zoomAction(){
		// Récupération de l'image
		if (isset($_GET["imgId"]) && is_numeric($_GET["imgId"])) {
			$imgId = $_GET["imgId"];
			$img = $this->imgDAO->getImage($imgId);
		} else {
			// Pas d'image, se positionne sur la première
			$img = $this->imgDAO->getFirstImage();
		}
		
		// Récupération de la taille actuelle
		if (isset($_GET["size"]) && is_numeric($_GET["size"])) {
			$imgSize = $_GET["size"];
		} else {
			$imgSize = self::DEFAULT_SIZE;
		}
		
		// Transformation de la taille avec le zoom demandé
		if (isset($_GET["zoom"]) && is_numeric($_GET["zoom"])) {
			$imgSize = round($imgSize * $_GET["zoom"]);
		}
		
		$data = $this->getData($img, $imgSize);
		
		$data["view"] = "photoView.php";

		require_once("view/mainView.php");
	}
	
}