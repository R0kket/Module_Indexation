
<body>
	<header style='background:#333333;color:white;'>
 <marquee>
<font size='+4'> bibliotheque de documents université paris 8 </font>
</marquee>
  
</header>";

<center>
    <img src="animated-gif-loading.gif" width="300" height="300"></br></br>

    <font size="5" color="#1C1C1C" > merci de patienté pandent L'indexation des pages Celle ci risque de prendre quelques minutes </font>

</center>
</body>

<?php

set_time_limit (600);

//echo " start indexation operation : ".date('h:m:s')."<br>";

// appel de la function main()
//include 'indexation7.php';

// dossier de document index
$dossier = "../fac/test";

lire_corpus($dossier);

function lire_corpus($dossier)
{
	$i=0; $fichier=array();
	if ($dir = opendir($dossier))
	{ 

		while(false !== ($file = readdir($dir))) 
		{
			
			if ($file == '.' || $file == '..') 
			{
				continue;
			} 
			
			if (is_dir($dossier . '/' . $file)) 
			{
				
				//echo " Entree dossier : $file","<br>";				
				// lire le sous dossier $entree
				lire_corpus($dossier . '/' . $file);
			}
			else 
			{
				$source = $dossier . '/' . $file;

			    if( strpos($source,'.htm') )
				{
					
					
					$fichier[]=$source;
					
					
			
				}
				
		}
		

		
			
			}
		closedir($dir);  
header('refresh:1;url=indexation_all.php?nom='.(serialize($fichier)));
	}

}


//echo " end indexation operation : ".date('h:m:s');
$x="<footer style='background:#333333;

position:absolute;

bottom:0;

width:100%;

padding-top:50px;

height:50px;''> <font size='+2' color='#FFFFFF'> Réalisation Saimi lamine slimane &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp  Validation module TIW </font> ";

echo $x;
?>