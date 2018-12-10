<?php

define("MIN_SIZE", 9);
define("MAX_SIZE", 36);
try
    {
      $conn = new PDO('mysql:host=localhost;dbname=tiw',  'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }catch (Exception $e1)
        {
          die('Erreur : ' . $e1->getMessage());}
$requete= $conn->query  = ("SELECT mot,occurence,document FROM 
 mot LEFT JOIN reference   ON mot.id_mot = reference.id_mot LEFT JOIN document ON reference.id_doc = document.id_document
WHERE document.titre_document = '$_GET[x]' AND reference.occurence > 10 ");
//WHERE document.titre_document = '$clef'
$resultat = $conn->query($requete);
$min = MAX_SIZE;
$max = -MAX_SIZE;
while ($tag=$resultat->fetch()) {
  if ($tag['occurence'] < $min) $min = $tag['occurence'];
  if ($tag['occurence'] > $max) $max = $tag['occurence'];
  $tags[] = $tag;
}
header('refresh:0;url=affichage.php?nom='.base64_encode(serialize($tags)));
?>