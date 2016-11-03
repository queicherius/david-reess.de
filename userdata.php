<?php 

/**
// MySql-Daten
**/
$dbhost = "localhost";   // der host (meistens localhost)  
$dbuser = "root";        // benutzername     
$dbpass = "";            // passwort
$dbname = "daten";        // name der datenbank


function fehler_anzeige ( $fehlerarray, $notadmin = false ){

if($fehlerarray == ""){return false;}

global $pfad_images;

echo "<div class=\"fehler_anzeige\">
        <div style=\"font-size: 1.3em; font-weight: bold;padding-top:10px;\">Es sind Fehler vorhanden:</div>
        
        <table>
          <tr>
            <td><img src=\"";
            
            echo ($notadmin == true) ? "admin/" : "";
            echo "$pfad_images/error.gif\"></td>
            <td>
        
      <div style=\"text-align: left; padding-left: 5%;\">
        <ul>";

  foreach( $fehlerarray as $string ){
    echo "<li>";
    echo $string;
    echo "</li>";
  }
  
echo "  </ul>
     </div>
     </td>
     </tr>
     </table>
     </div>
     <br><br>";
      
}

function get_ip(){

$ipadresse = $REMOTE_ADDR;
if($ipadresse == ""){$ipadresse = $_SERVER["REMOTE_ADDR"];}
if($ipadresse == ""){$ipadresse = getenv($REMOTE_ADDR);}

return $ipadresse;
}

function eingabe_check($eingabe, $name_eingabe, $typ = "string", $pflicht = 0, $minsize = 0, $maxsize = 10240){

    global $fehler_array_eingabe_check;
    
    // schauen ob es gesetzt und nicht leer ist
    if($pflicht == 1 and empty($eingabe)){
      $fehler_array_eingabe_check[] = $name_eingabe." ist leer";
      return $eingabe;
    }
    
    // schauen ob es gesetzt und nicht leer ist
    // ansonsten raus, da keine pflicht
    if($pflicht == 0 and empty($eingabe)){
      return $eingabe;
    }
    
    // Standart-Sicherheit (DB-Verbindung!)
    $eingabe = mysql_real_escape_string($eingabe);
    
    /******************************
    // Verschiedene Typen:
    // - String
    // - Nummer
    // - Mail
    // - Website
    // - Timestamp
    *******************************/
    switch($typ){
    
        default:
        case "string":
            if(!is_string($eingabe)){
              $fehler_array_eingabe_check[] = $name_eingabe." ist kein Text";
            }
        break;
        
        case "number":
            if(!is_numeric($eingabe)){
              $fehler_array_eingabe_check[] = $name_eingabe." ist keine Nummer";
            }
        break;
        
        case "mail":
            if( !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $eingabe ) ){
              $fehler_array_eingabe_check[] = $name_eingabe." ist keine g&uuml;ltige E-Mail-Adresse";
            }
        break;
        
        case "website":
            if( !eregi("#(^|[^\"=]{1})(http://|ftp://|mailto:|news:)([^\s<>]+)([\s\n<>]|$)#sm", $eingabe)){
              $fehler_array_eingabe_check[] = $name_eingabe." ist keine Website";
            }
        break;
        
        case "timestamp":
            if(!is_numeric($eingabe) or $eingabe < -2147483648 or $eingabe > 2147483647){
              $fehler_array_eingabe_check[] = $name_eingabe." ist kein g&uuml;ltiger Timestamp";
            } 
        break;
            
    } 
    
if( sizeof($eingabe) > $maxsize){
   $fehler_array_eingabe_check[] = $name_eingabe." ist zu gro&szlig;";
}

if( sizeof($eingabe) < $minsize){
   $fehler_array_eingabe_check[] = $name_eingabe." ist zu klein";
}

return $eingabe;

}
?>