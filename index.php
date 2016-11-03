<?php include("inhalt.php");$site = $_GET["site"];?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
  <head>
    <title>david-reess.de</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" type="text/css" href="style.css">
    
  </head>
  <body>
  
  <div id="copy">
     (c) by David Ree&szlig; 2009
  </div>
  
  <div id="produkte">
    HTML | PHP | MySQL | CSS | JS | Ajax | Webdesign | Administration
  </div>
  
  <div id="header">
    david-reess.de
  </div>
  
  <div id="sideline" style="display: none;">
      <table>
        
        <tr>
          <td><img src="img/inet/email.gif"></td>
          <td>  </td>
          <td>&#100;&#97;&#118;&#105;&#100;&#114;&#101;&#101;&#115;&#115;&#64;&#103;&#109;&#120;&#46;&#100;&#101;</td>
        </tr>
        
                
        
        <tr>
          <td><img src="img/inet/icq.gif"></td>
          <td>  </td>
          <td><a target="_blank" href="http://people.icq.com/people/about_me.php?uin=410843838">ICQ</a></td>
       
        </tr>
        
        
        
        <tr>
          <td><img src="img/inet/facebook.gif"></td>
          <td>  </td>
          <td><a target="_blank" href="http://www.facebook.com/profile.php?id=1760257998">Facebook</a></td>
        </tr>
        
                
                <tr>
          <td><img src="img/inet/tutorials.gif"></td>
          <td>  </td>
          <td><a target="_blank" href=" http://www.tutorials.de/forum/members/queicherius.html">Tutorials.de</a></td>
       
        </tr>
        

                <tr>
          <td><img src="img/inet/skype.gif"></td>
          <td>  </td>
          <td>queicherius</td>
        </tr>
        
        
        <tr>
          <td><img src="img/inet/youtube.gif"></td>
          <td>  </td>
          <td><a target="_blank" href="http://www.youtube.com/creakjack">Youtube</a></td>
        </tr>
                <tr>
          <td><img src="img/inet/twitter.gif"></td>
          <td>  </td>
          <td><a target="_blank" href="http://twitter.com/queicherius">Twitter</a></td>
        </tr>
        
        <tr>
          <td><img src="img/inet/wordpress.gif"></td>
          <td>  </td>
          <td><a target="_blank" href="http://queicherius.wordpress.com/">Blog</a></td>
        </tr>


       
      
      </table>
  </div>
  
  <div id="logo">
     <img src="img/logo.gif" alt=""/>
  </div>
  
  <ul class="new_navi">
    <li><a<?php echo ($site == "home" or $site == "") ? " id=\"active_menu\"" : ""; ?> href="?site=home">Home</a></li>
      <li><a<?php echo ($site == "portfolio") ? " id=\"active_menu\"" : ""; ?> href="?site=portfolio">Portfolio</a></li>
      <li><a<?php echo ($site == "produkte") ? " id=\"active_menu\"" : ""; ?> href="?site=produkte">Produkte</a></li>
      <li><a<?php echo ($site == "scriptarchiv") ? " id=\"active_menu\"" : ""; ?> href="?site=scriptarchiv">Projekte</a></li>
     <!--  <li><a<?php echo ($site == "gaestebuch") ? " id=\"active_menu\"" : ""; ?>><a href="?site=gaestebuch">G&auml;stebuch</a></li> //-->
      <li><a<?php echo ($site == "impressum") ? " id=\"active_menu\"" : ""; ?> href="?site=impressum">Impressum</a></li>
  </ul>
  
    
    <div class="inhalt">   
   
<?php 

switch ($site){


case "produkte":
  echo $inhalt["produkte"];
break;

default:
case "home":
  echo $inhalt["home"];
break;

case "portfolio":
  echo $inhalt["portfolio"];
break;

case "scriptarchiv":
  echo $inhalt["scriptarchiv"];
break;

case "downloads":
  echo $inhalt["downloads"];
break;

case "kleineprojekte":
  echo $inhalt["kleineprojekte"];
break;

case "gaestebuch":
  include("guestbook.php");
break;

case "impressum":
  echo $inhalt["impressum"];
break;

}

?>
    
    
    </div>
    
    
  </body>
</html>