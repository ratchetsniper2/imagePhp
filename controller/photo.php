<?php

require_once("model/image.php");
require_once("model/imageDAO.php");

class Photo {
	
	private $imgDAO;
	
	public function Photo(){
		$this->imgDAO = new ImageDAO();
	}
	
	/**
	 * 
	 * 
	 * @return array
	 */
	private function getData() : array{
		if (isset($_GET["imgId"])) {
			$imgId = $_GET["imgId"];
			$img = $this->imgDAO->getImage($imgId);
		} else {
			// Pas d'image, se positionne sur la première
			$img = $this->imgDAO->getFirstImage();
			$imgId = $img->getId();
		}
		
		$data = [];
		
		$data["imgUrl"] = $img->getURL();
		$data["imgId"] = $img->getId();
		$data["imgComment"] = $img->getComment();
		$data["imgCategory"] = $img->getCategory();
		
		if (isset($_GET["size"])) {
			$imgSize = $_GET["size"];
		} else {
			$imgSize = 480;
		}
		$data["imgSize"] = $imgSize;
		
		$data["prevImgId"] = $this->imgDAO->getPrevImage($img)->getId();
		$data["nextImgId"] = $this->imgDAO->getNextImage($img)->getId();
		
		// menu
		$data["menu"]['Home'] = "index.php";
		$data["menu"]['A propos'] = "index.php?controller=home&action=aproposAction";
		
		return $data;
	}
		
	public function indexAction(){
		$this->firstAction();
	}
	
	public function firstAction(){
		$data = $this->getData();
		
		$data["view"] = "photoView.php";
		
		require_once ("view/mainView.php");
	}
	
	public function nextAction(){
		$data = $this->getData();
		
		$data["view"] = "photoView.php";

		require_once ("view/mainView.php");
	}
	
}