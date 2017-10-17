<?php # mise en place de la vue partielle : le contenu central de la page  
	# Mise en place des deux boutons
	print "<p>\n";
	// pre-calcul de la page d'images précedente
	print "<a href=\"nonRealise.php\">Prev</a> ";
	// pre-calcul de la page d'images suivante
	print "<a href=\"nonRealise.php\">Next</a>\n";
	print "</p>\n";
	# Affiche de la matrice d'image avec une reaction au click
	print "<a href=\"zoom.php?zoom=1.25&imgId=$newImgId&size=$size\">\n";
	// Réalise l'affichage de l'image
	# Adapte la taille des images au nombre d'images présentes
	$size = 480 / sqrt(count($imgMatrixURL));
	# Affiche les images
	foreach ($imgMatrixURL as $i) {
		print "<a href=\"".$i[1]."\"><img src=\"".$i[0]."\" width=\"".$size."\" height=\"".$size."\"></a>\n";
	};
?>