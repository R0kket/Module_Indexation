<?php

function get_body($modele,$chaine_html){

        preg_match($modele,$chaine_html,$tableau_res);

        if($tableau_res[1])
            return $tableau_res[1];
        else return "";
                    
}


function explode_bis($separateurs, $chaine){
                $tab = array();
                $tok= strtok($chaine, $separateurs);
                    if (strlen($tok) > 2) $tab[] = $tok;

                    while ( $tok !== false )
                        {
                            
                            $tok = strtok($separateurs);
                            if (strlen($tok) > 2) $tab[] = $tok;
                        }
                    return $tab;
}
        
function print_array($Token){
            
            foreach ( $Token as $cle => $valeur)
                
                echo "[ $cle ]=",$valeur,"<br>";
}
function get_description($source){
  
    $table_metas = get_meta_tags($source);

    if(  $table_metas['description'] )
       return $table_metas['description'];
    else return "";
  
}

function get_keywords($source){
  
    $table_metas = get_meta_tags($source);

    if(  $table_metas['keywords'] )
       return $table_metas['keywords'];
    else return "";
  
}


function get_title($modele,$chaine){
  
  
preg_match($modele,$chaine,$tableau_res);

if($tableau_res[1])
  return $tableau_res[1];
else return "";
 
  
}
?>
