<?php

include("userdata.php");

/**********************************************
// Verbindung zur DB aufnehmen
**********************************************/
  mysql_connect($dbhost,$dbuser,$dbpass) or die
  ("Keine Verbindung moeglich");
  mysql_select_db($dbname) or die
  ("Die Datenbank existiert nicht");
  
  echo "<h1>G&auml;stebuch</h1>";

/************************************
// Der Verarbeitungs-Block
************************************/
if($_GET["action"] == "new"){
// eintragen

if($_GET["leer"] != ""){
  die("nice try spambot!");
}

$name 		= $_GET["name"];
$email 		= $_GET["email"];
$text 		= $_GET["text"];
$botstop 	= $_GET["botstop"];
$timestamp 	= time();
$ipadresse = get_ip();

$name		= eingabe_check($name, "Name", "string", 1);
$email	= eingabe_check($email, "Email", "mail");

$text		= eingabe_check($text, "Nachricht", "string", 1);

if( $botstop != "SpAmStoP" ){
$fehler_array_eingabe_check[] = "Bitte geben Sie das Captcha richtig ein";
}

$timestampmin = $timestamp-600;

$abfrage = "SELECT * FROM guestbook WHERE timestamp > $timestampmin";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
{
        if($row->ipadresse == $ipadresse){
          $fehler_array_eingabe_check[] = "Sie k&ouml;nnen nur alle 10 min einen Eintrag schreiben";
        }
}

if($fehler_array_eingabe_check == ""){
// in die DB
$eintrag = "INSERT INTO guestbook (name, nachricht, email, timestamp, ipadresse) VALUES ('$name', '$text', '$email', '$timestamp', '$ipadresse')";
$eintragen = mysql_query($eintrag);
$action = "abgeschickt";
}

}

if($action == "abgeschickt"){
// abgeschickt!!
echo "<div class=\"abgeschickt\"><b>Ihr Eintrag wurde hinzugef&uuml;gt und muss jetzt nur noch freigeschaltet werden</b></div><br><br>";
}

if($_GET["action"] == "write" or ($_GET["action"] == "new" && $fehler_array_eingabe_check != "")){
// schreiben des beitrags
echo "  
     <form method=\"get\" class=\"new\" action=\"$PHP_SELF\">
     <div><br>
     <input type=\"hidden\" name=\"site\" value=\"gaestebuch\">
        <h2>Neuen Eintrag hinzuf&uuml;gen</h2><br>";
        
                fehler_anzeige($fehler_array_eingabe_check, true);
                
echo"   <table>
        <tr>
        <td>Name(*):</td>
        <td><input type=\"text\" name=\"name\" value=\"$name\"></td>
        </tr>
        <tr>
        <td>E-Mail:</td>
        <td><input type=\"text\" name=\"email\" value=\"$email\"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
        <td valign=\"top\">Nachricht(*):</td>
        <td><textarea name=\"text\" cols=\"50\" rows=\"10\">$text</textarea></td>
        </tr>
        </table><br>
        Geben sie hier bitte <img src=\"img/botstop.gif\" alt=\"Botstop\"> ein(*): <input type=\"text\" name=\"botstop\">
        <div class=\"sternchen\" style=\"color: red;\">
        Alle mit einem (*) versehenen Felder m&uuml;sssen ausgef&uuml;llt werden.
        </div><br><br>
        
        <input type=\"hidden\" name=\"action\" value=\"new\">
     
        <input type=\"submit\" value=\"Abschicken\" > :: <input type=\"button\" value=\"Abbrechen\" onclick=\"javascript:self.location.href='$PHP_SELF?site=gaestebuch';\"></div>

<div style=\"display: none;\">dieses feld bitte nicht ausf&uuml;llen: <input type=\"text\" name=\"leer\" value=\"\"></div>
        </form>
        
         
  <br><br></div> </body></html>";
exit();
}

// ganz normale ansicht
echo "<div class=\"obennavi\">

<a href=\"$PHP_SELF?site=gaestebuch&amp;action=write\">Neuen Eintrag hinzuf&uuml;gen</a>

  
  
  <div class=\"insgg\"><br>";
  
   $limitanfang = mysql_real_escape_string($_GET["l"]);
   if($limitanfang == ""){$limitanfang = 0;}
   $limitende = $limitanfang+5;
   $zurueck = $limitanfang-5;
  
  if($zurueck >= 0){echo "<a href=\"$PHP_SELF?site=gaestebuch&l=$zurueck\">&lt;&lt; Zur&uuml;ck</a>";echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
  
  $limitneu = $limitende+1;
  $abfrage2 = "SELECT * FROM guestbook WHERE freigeschaltet = '1' ORDER BY timestamp DESC LIMIT $limitende, $limitneu";
  $ergebnis2 = mysql_query($abfrage2);
  while($row = mysql_fetch_object($ergebnis2))
  {
    echo "<a href=\"$PHP_SELF?site=gaestebuch&l=$limitende\">Vor &gt;&gt;</a>";
  }
  
  
  
  echo "<br><br>";
  
  $eintraege = $limitanfang;  
  $abfrage2 = "SELECT * FROM guestbook WHERE freigeschaltet = '1' ORDER BY timestamp DESC LIMIT $limitanfang, $limitende";
  $ergebnis2 = mysql_query($abfrage2);
  while($row = mysql_fetch_object($ergebnis2))
  {
  $eintraege++;
  $name 		= $row->name;
  $nachricht 	= $row->nachricht;
  $email 		= $row->email;
  $timestamp 	= $row->timestamp;
  
  /* Nachricht, Text und email ohne Html!! */
  $nachricht = htmlentities($nachricht);
  $name 	 = htmlentities($name);
  $email 	 = htmlentities($email);
      
  /* Zeit in Variable packen */
  $datum 	= date("d.m.Y",$timestamp);
  $uhrzeit 	= date("H:i",$timestamp);
  $zeit 	= $datum." um ".$uhrzeit." Uhr";

  /* Mail-Funktion */
  if($email == ""){
  $nachrichtmail = "Nicht angegeben";
  }else{
  $nachrichtmail = save_mail($email);
  }
 
  /* Ausgeben 
  echo "
  <div class=\"eintraege\">
  <div class=\"eintrag_all\">
  <div class=\"eintragnummer\"><b>".$eintraege."</b></div>
  <div class=\"nachricht\">
  <b>Von: </b>".$name."&nbsp;&nbsp;&nbsp;<b>Mail: </b>".$nachrichtmail."<br><br>
  ".$nachricht."<br><br><div class=\"eing\">Eingetragen am ".$zeit."</div>
  </div>
  </div>    
  </div>
  <br>
  ";*/
  
  echo "<b>Eintrag Nr. ".$eintraege."</b></div>
  <div class=\"nachricht\">
  <b>Autor: </b>".$name."&nbsp;&nbsp;&nbsp;<b>Mail: </b>".$nachrichtmail."<br><br>
  ".$nachricht."<br><br><div class=\"eing\">Eingetragen am ".$zeit."</div>
  </div>
  <br><br><br>";
}



?>