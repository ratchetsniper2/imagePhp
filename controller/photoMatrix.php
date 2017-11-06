<?php

require_once("model/image.php");
require_once("model/imageDAO.php");

class PhotoMatrix {

	private $imgDAO;

	public function __construct(){
		$this->imgDAO = new ImageDAO();
	}

	private function getData(array $imgs, int $nbImg = null) : array{

		if ($nbImg == null){
			// Si il n'y a pas de taille demandé, on garde la meme taille ou celle par defaut
			if (isset($_GET["nbImg"]) && is_numeric($_GET["nbImg"])) {
				$nbImg = $_GET["nbImg"];
			} else {
				$nbImg = 2;
			}
		}

		foreach ($imgs as $key => $value) {
			$data["img"][$key]["imgUrl"] = $value->getURL();
			$data["img"][$key]["imgId"] = $value->getId();
			$data["img"][$key]["imgComment"] = $value->getComment();
			$data["img"][$key]["imgCategory"] = $value->getCategory();
		}

		// menu
		$imgId = $imgs[array_keys($imgs)[0]]->getId();

		$nbImgBis = $nbImg*2;
		$nbImgTer = $nbImg/2;
		if ($nbImgTer < 1) {
			$nbImgTer = 1;
		}

		$data["menu"]['Home'] = "index.php";
		$data["menu"]['A propos'] = "index.php?controller=home&action=aproposAction";
		$data["menu"]['First'] = "index.php?controller=photoMatrix&action=firstAction";
		$data["menu"]['Random'] = "index.php?controller=photoMatrix&action=randomAction&imgId=$imgId";
		$data["menu"]['More'] = "index.php?controller=photoMatrix&imgId=$imgId&nbImg=$nbImgBis";
		$data["menu"]['Less'] = "index.php?controller=photoMatrix&imgId=$imgId&nbImg=$nbImgTer";

		return $data;
	}

	public function indexAction() {
		$this->showAction();
	}

	public function showAction() {
		if (isset($_GET["imgId"]) && is_numeric($_GET["imgId"])) {
			$imgId = $_GET["imgId"];
			$img = $this->imgDAO->getImage($imgId);
		} else {
			// Pas d'image, se positionne sur la première
			$img = $this->imgDAO->getFirstImage();
		}

		if (isset($_GET["nbImg"]) && is_numeric($_GET["nbImg"])) {
			$nbImg = $_GET["nbImg"];
		} else {
			$nbImg = 2;
		}

		$imgs = $this->imgDAO->getImageList($img, $nbImg);


		$data = $this->getData($imgs, $nbImg);
		$data["view"] = "photoMatrixView.php";

		require_once("view/mainView.php");
	}

}
