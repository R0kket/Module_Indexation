


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
WHERE document.titre_document = '$_GET[x]' AND reference.occurence > '5' ");
//WHERE document.titre_document = '$clef'
$resultat = $conn->query($requete);
$min = MAX_SIZE;
$max = -MAX_SIZE;

while ($tag=$resultat->fetch()) {
  if ($tag['occurence'] < $min) $min = $tag['occurence'];
  if ($tag['occurence'] > $max) $max = $tag['occurence'];
  $tags[] = $tag;
}

$min_size = MIN_SIZE;
$max_size = MAX_SIZE;

?>

<!DOCTYPE html>
<html>
<head>
  <title> </title>
</head>
<body>
<meta charset="UTF-8">
  <?php 

  foreach ($tags as $tag) {
  $tag['size'] = intval($min_size + (($tag['occurence'] - $min) * (($max_size - $min_size) / ($max - $min))));
  $tags_extended[] = $tag;
}

?>


  <?php foreach ($tags_extended as $tag) :
$tag['mot'] = utf8_decode($tag['mot']); ?>
<?php if ($tag['size']<= 39 and $tag['size'] >= 35) { ?>
<font size="6" style="color: #581845"> <?php echo $tag['mot']; ?> </font>
<?php } ?>
<?php if ($tag['size']<= 34 and $tag['size'] >= 30) { ?>
<font size="5" style="color: #900C3F"> <?php echo $tag['mot']; ?> </font>
<?php } ?>
<?php if ($tag['size']<= 29 and $tag['size'] >= 25) { ?>
<font size="4" style="color: #C70039"> <?php echo $tag['mot']; ?> </font>
<?php } ?>
<?php if ($tag['size']<= 24 and $tag['size'] >= 20) { ?>
<font size="3" style="color: #FF5733"> <?php echo $tag['mot']; ?> </font>
<?php } ?>
<?php if ($tag['size']<= 19 and $tag['size'] >= 15) { ?>
<font size="2" style="color: #FFC300"> <?php echo $tag['mot']; ?> </font>
<?php } ?>
<?php if ($tag['size']<= 15 and $tag['size'] >= 9) { ?>
<font size="1" style="color: #33A828 "> <?php echo $tag['mot']; ?> </font>
<?php } ?>
<?php endforeach; ?>
</div>



</body>
</html>

