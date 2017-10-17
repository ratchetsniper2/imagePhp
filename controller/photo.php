<?php

require_once("model/image.php");
require_once("model/imageDAO.php");

class Photo {
	
	private $imgDAO;
	
	public function Photo(){
		$this->imgDAO = new ImageDAO();
	}
		
	public function indexAction(){
		$this->firstAction();
	}
	
	public function firstAction(){
		$view = "photoView.php";
		
		# Mise en place du menu
		$menu['Home'] = "index.php";
		$menu['A propos'] = "index.php?controller=home&action=aproposAction";

		$img = $this->imgDAO->getFirstImage();
		$imgUrl = $img->getURL();
		
		require_once ("view/mainView.php");
	}
	
	public function nextAction(){
		$view = "photoView.php";
		
		# Mise en place du menu
		$menu['Home'] = "index.php";
		$menu['A propos'] = "index.php?controller=home&action=aproposAction";

		if (isset($_GET["imgId"])) {
			$imgId = $_GET["imgId"];
			$img = $this->imgDAO->getImage($imgId);
		} else {
			// Pas d'image, se positionne sur la première
			$img = $this->imgDAO->getFirstImage();
			$imgId = $img->getId();
		}
		
		$imgUrl = $img->getURL();
		
		require_once ("view/mainView.php");
	}
	
}