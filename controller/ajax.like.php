<?php
try {
  $serverName = 'localhost'; // host name
  $dbName = 'image'; // bdd name
  $user = 'root'; // utilisateur
  $pass = 'root'; // mot de passe

  $db = new PDO("mysql:host=$serverName;dbname=$dbName", $user, $pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die ("Erreur : ".$e->getMessage());
}
if (isset($_POST) && isset($_POST['data'])) {
    $id = $_POST['data'];
    $req = $db->prepare('SELECT count(*) FROM ImgLike WHERE idPhoto = :id');
    $req->execute(array(':id' => $id));
    $donnee = $req->fetch();
    if ($donnee == 0) {
      $insert = $db->prepare('INSERT INTO ImgLike VALUES(:id, 1)');
      $insert->execute(array(':id' => $id));
    } else {
      $update = $db->prepare('UPDATE ImgLike SET nbLike = nbLike + 1 WHERE idPhoto = :id');
      $update->excute(array(':id' => $id));
    }
    echo "0";
} else {
  echo "1";
}
?>
