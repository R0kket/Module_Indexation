

<?php
if ( isset($_POST['query'])  ){

try
    {
      $conn = new PDO('mysql:host=localhost;dbname=tiw',  'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }catch (Exception $e1)
        {
          die('Erreur : ' . $e1->getMessage());}

$requete= $conn->query  = ("SELECT mot,titre_document,description,occurence FROM 
 mot LEFT JOIN reference  ON mot.id_mot = reference.id_mot 
 LEFT JOIN document  ON document.id_document = reference.id_doc
  WHERE mot.mot = '$_POST[query]'    ORDER BY  occurence DESC");
 

 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans titre</title>

<link href="affichage.css" rel="stylesheet" type="text/css" />
</head>




<body>
<br/><br/>
<center>
<form method="post" action="affichage.php">
  Rechercher <input type="text" name="query" size="50">
  <input type="submit" value="trouver">
</form>
<br/> 
</center >

<table>
  <thead>
    <tr>
      
      <th>Titre Document</th>
      <th>Description</th>
      <th>Occurence</th>
      <th>nuage de mot</th>
    </tr>
  </thead>
  <?php
$resultat = $conn->query($requete);

 
    while($donnees=$resultat->fetch())   { 
  
  ?>
  
  <tbody>
    <tr>
      
      <td><a href="#"><?php echo $donnees['titre_document']; ?></a> </td>
      <td><?php echo $donnees['description']; ?> </td>
      <td><a href="#"><?php echo $donnees['occurence']; ?> </a></td>
      <td> <a href="nuage.php?x=<?php echo ($donnees['titre_document']);?>"><img src="plus.png" alt="nuage de mot" width="20" height="20"  id="a" "></a></td>


    </tr>
  </tbody>
<?php  } 


?>



</center>
<?php
} else { ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans titre</title>

<link href="affichage.css" rel="stylesheet" type="text/css" />
</head>




<body>
<br /><br/>
<center>
<form method="post" action="affichage.php">
  Rechercher <input type="text" name="query" size="50">
  <input type="submit" value="trouver">
</form>
<br />

</center >


<table>
  <thead>
    <tr>
      
      <th>Titre Document</th>
      <th>Description</th>
      <th>Occurence</th>
      <th>nuage de mot</th>
    </tr>
  </thead>

<?php } ?>
</table>



</body>
</html>
