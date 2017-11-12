<?php

// include config
require_once ("./config.php");

# Controleur frontal (front controler) 

# En fonction du controleur et de l'action en parametre lance le bon traitement
# Recherche le nom du controleur
if (isset($_GET["controller"])) {
	$controller_to_run = $_GET["controller"];
} else {
	# Si pas de controleur trouvée, choisit celui par defaut
	$controller_to_run = "home";
}
# Recherche du nom de l'action pour ce controleur
if (isset($_GET["action"])) {
	$action = $_GET["action"];
} else {
	# Si pas d'action trouvée, definit une action par defaut
	$action = "indexAction";
}

# Chargement du module de controleur correspondant à l'action

# Vérification de l'éxistence du controller
$isValidController = false;
$controllerFile = $controller_to_run.".php";
$controllerDirectoryPath = "controller";
$controllerDirectory = opendir($controllerDirectoryPath);
if ($controllerDirectory) {
	while (($file = readdir($controllerDirectory)) !== false && !$isValidController) {
		if ($file === $controllerFile){
			$isValidController = true;
		}
	}
}

if ($isValidController){
	# Le fichier est trouvé, il est chargé et définit une nouvelle classe
	require_once($controllerDirectoryPath."/".$controllerFile);

	# Construit le nom de la classe controller à activer
	$controllerClassName = $controller_to_run;
	# Vérifie que cette classe existe
	if (class_exists($controllerClassName)) {
		# Cree l'objet controleur de cette action
		$controller = new $controllerClassName();
		# Vérifie que le code de l'action existe
		if (method_exists($controller, $action)) {
			# Réalise le traitement adéquat el lancant l'action de ce controleur
			$controller->$action();
		} else {
			# Erreur dans le code, la classe de l'action n'est pas trouvé
			die("<b>### Erreur : la methode '$action' du controleur '$controllerClassName' du fichier '$controllerFile' n'existe pas</b>
				</br>Conseil : verifiez l'orthographe du nom de cette methode dans le fichier $controllerFile.");        
		}
	} else {
		# Erreur dans le code, la classe de l'action n'est pas trouvé
		die("<b>### Erreur : la classe du controleur '$controllerClassName' du fichier $controllerFile n'existe pas</b>
			</br>Conseil : verifiez l'orthographe du nom de cette classe dans le fichier $controllerFile.");
	}
} else{
	# Erreur dans le code, le fichier de l'action n'est pas trouvé
	die("<b>### Erreur : le fichier $controllerFile est absent</b>
		</br>Conseil : il faut creer ce fichier, verifier son nom ou verifier le lien du bouton
		en particulier la valeur de la variable 'controller' dans l'URL.");
}