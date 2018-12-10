

<?php
$c="<header style='background:#333333;color:white;'>
 <marquee>
<font size='+4'> Bibliothéque de documents université paris 8 </font>
</marquee>
  
</header>";
echo $c;
set_time_limit (600);

//echo " start indexation operation : ".date('h:m:s')."<br>";
include 'bibliotheque-fonctions.inc.php';
//include 'bibliotheque-fonctions.inc.php';

$servername = "localhost";
$username = "root";
$password = "";

$source1= unserialize($_GET["nom"]);

//print_r($source1);
 foreach ($source1 as $source){

$separateurs = ",.;\'()/\n/\S 0123456789€\?\!:{}_ -$^~»[]ã‰=€¢ß¥£™©®ª×÷±²³¼½¾µ¿¶·¸º°¯§…¤¦≠¬ˆ¨‰™« ";

// lecture d'une source Html 
$chaine_html = implode( file($source),' ');

// recouperation du descriptif

$description = get_description($source);

// recuperation des keywords
$keywords = get_keywords($source);

// recuperation du title
$modele = "/<title>(.*)<\/title>/i";
$title = get_title($modele,$chaine_html);

// construction de la chaine head
$chaine_head = strtolower($title." ".$description." ".$keywords);

// segmentation du texte en mots
$tab_mots = explode_bis($separateurs, $chaine_head);



//filtrage de doublons et obtention de nombre d'occurrences
$tab_mots_soccurrences = array_count_values($tab_mots);
//print_array($tab_mots_soccurrences);




// lecture d'une source Html
$chaine_html = implode( file($source),' ');

//recupération du body du corps du document
$modele = "/<body[^>]*>(.*)<\/body>/is";
$chaine_body_html = get_body($modele,$chaine_html);
//suppression du javascript du body
$modele = "/<script[^>]*?>.*?<\/script>/is";
$chaine_html_sans_script = preg_replace($modele,"",$chaine_html);
//supression du css
$modele = "/<style[^>]*?>.*?<\/style>/is";
$chaine_html_sans_script = preg_replace($modele,"",$chaine_html);



//suppression de balises html du body -> body en texte brute
$chaine_body_texte = strip_tags($chaine_html_sans_script);

//supression de balise css 
$modele = "/<style[^>]*?>.*?<\/style>/is";
$chaine_body_texte = preg_replace($modele,"",$chaine_body_texte);

//mise en minuscule du texte avant traitement
$chaine_body_texte = strtolower($chaine_body_texte);

// segmentation du texte en mots
$separateurs = ",.;\'()/\n/\S 0123456789€\?\!:{}_ -$^~»[]ã‰=€¢ß¥£™©®ª×÷±²³¼½¾µ¿¶·¸º°¯§…¤¦≠¬ˆ¨‰™« ";
$tab_mots_body = explode_bis($separateurs, $chaine_body_texte);
$dictionaire = 'dictionaire.txt';
//
//recuperé les mot vide 

$mot_vide = file($dictionaire, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//fusion des 2 tableau
$tab_mot_all =  array_merge($tab_mots, $tab_mots_body) ;
//separation des mots vide
$tab_mot_all = array_diff($tab_mot_all, $mot_vide );

//filtrage de doublons et obtention de nombre d'occurrences
$tab_mots_occurrences = array_count_values($tab_mot_all);
try {
    $conn = new PDO("mysql:host=$servername;dbname=tiw", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
  foreach ($tab_mots_occurrences as $mot=>$occurrence) {
  //testé si le mot existe 
  $req=$conn->prepare('SELECT * FROM mot WHERE mot=?');
        $req->execute(array($mot));
        $donnees=$req->fetch();

}


  
 if(!$donnees) {
  $sq2  = "INSERT INTO document (titre_document,description,document)VALUES ('$title','$description','$source')";
$conn->query($sq2);
  $id2 = $conn-> lastInsertId();

  
  foreach ($tab_mots_occurrences as $mot=>$occurrence) {
  $sql = "INSERT INTO mot (mot)VALUES ('$mot')";
   


  //execution de la requête mysql_query
  $conn->query($sql);
  $id1 = $conn -> lastInsertId();
  
  
 $sq3  = "INSERT INTO reference (id_doc,id_mot,occurence)VALUES ('$id2','$id1','$occurrence')"; 
 $conn->query($sq3);
}
}
   
  
else {
  $sq2  = "INSERT INTO document (titre_document,description,document)VALUES ('$title','$description','$source')";

$conn->query($sq2);
  $id2 = $conn-> lastInsertId();


  foreach ($tab_mots_occurrences as $mot=>$occurrence) {
  //testé si le mot existe 
  $sql = "SELECT * FROM mot WHERE mot = '$mot'";
  //execution de la requête mysql_query
  $resultat = $conn->query($sql);
  $data = $resultat->fetch();
    $id3=$data['id_mot'];

if($id3 !=0){
$sq5  = "INSERT INTO reference (id_doc,id_mot,occurence)VALUES ('$id2','$id3','$occurrence')"; 

  $conn->query($sq5); 
}

}





}
}
$a="<br/><br/><br/><br/><center> <font size='5'>l'indexation est terminé  vous voulais vous consulté le moteur de recherche <br/> <br/> <a href='affichage.php'>recherche mots </a> </font> </center> ";
echo $a;
$b="</br></br></br>";
echo $b;
echo $b;
echo $b;
echo $b;

echo " end indexation operation : ".date('h:m:s');
$x="<footer style='background:#333333;

position:absolute;

bottom:0;

width:100%;

padding-top:15px;

height:50px;''> <font size='+2' color='#FFFFFF'> Réalisation Zakaria Ouzzegdouh &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp  Validation module TIW </font> ";

echo $x;

?>
