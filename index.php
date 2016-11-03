<?php

function str_cutting($scString,$scMaxlength,$atspace = 1)
    {
        if (strlen($scString)>$scMaxlength)
        {
            $output = "";
            $scString = substr($scString,0,$scMaxlength-4);
            if ($atspace && strpos($scString,' '))
            {
                $scStrexp = split(" ",$scString);
                for ($scI = 0; $scI < count($scStrexp)-1; $scI++) $output.= $scStrexp[$scI]." ";
            }
            else
                $output = $scString;
            return $output."...";
        }
        else
            return $scString;
    }
    
    function getJahreszeit(){
    
    $monat = date("n");
    $tag = date("j");
    
    if($monat == 4 and $tag <= 6 ){
      return "ostern";
    }
    
    if($monat == 12 and $tag <= 26 and $tag > 22 ){
      return "weihnachten";
    }
    
    if($monat == 7 and $tag == 29){
      return "bday";
    }
    
    if(($monat == 7 and $tag > 29) or $monat == 8 or ($monat == 9 and $tag < 11)){
      return "sommer";
    }
    
    if($monat == 11){
      return "herbst";
    }
    
    if(($monat == 5 and $tag > 24) or ($monat == 6 and $tag < 6)){
      return "pfingsten";
    }
    
    return "none";
    
    }


function replaceIcons($p){

$s = array(
":)",
";)",
"]:)",
"^^",
":D",
"xD",
":o",
":O",
":P",
":p",
":(",
":}"
);

$imagepath = "images/emos/emoticon_";

$i = array(
'<img src="'.$imagepath.'smile.png">',
'<img src="'.$imagepath.'wink.png">',
'<img src="'.$imagepath.'evilgrin.png">',
'<img src="'.$imagepath.'happy.png">',
'<img src="'.$imagepath.'grin.png">',
'<img src="'.$imagepath.'grin.png">',
'<img src="'.$imagepath.'surprised.png">',
'<img src="'.$imagepath.'surprised.png">',
'<img src="'.$imagepath.'tongue.png">',
'<img src="'.$imagepath.'tongue.png">',
'<img src="'.$imagepath.'unhappy.png">',
'<img src="'.$imagepath.'waii.png">'
);

$p = str_replace($s, $i, $p); 

return $p;
}

function getFileArrayFromFolder($folder){

$handle = opendir($folder);
while ($file = readdir ($handle)) {
    if($file != "." && $file != "..") {
        if(!is_dir($ordner."/".$file)) {
           $array[] = $file;
        }
    }
}
closedir($handle);


return $array;

}

$site = $_GET["s"];

if($site == ""){
$site = "Home";
}

$siteArray = array("Home", "Blog", "Projekte", "Gallerie", "Portfolio", "Impressum");

if(in_array($site, $siteArray)){
  $siteInclude = strtolower($site).".html";
}else{
  $siteInclude = "error.html";
}

$menue = "<ul>";

foreach($siteArray as $ss){
  
  $menue .= "<li";
  
  if($ss == $site){
    $menue .= ' id="current"';
  }
  
  $menue .= "><a href=\"".$ss."\">".$ss."</a></li>";
  
}

$menue .= "</ul>";


$pagedesign = "page-design.html";

$page = file_get_contents($pagedesign);
$content = file_get_contents($siteInclude);




$page = str_replace("{layout-path}", "", $page);
$page = str_replace("{jahreszeit}", getJahreszeit(), $page);

$sidebar = file_get_contents("sidebar.html");

$blog = file_get_contents("blog.html");

preg_match('#<div class="newestPost post">
<h1>([^(</h1>)]*)</h1>
<span class="timestamp">[\w\W]*</span>
([\w\W]*)
</div>#U', $blog, $patterns); 



$sbinner = "<b>".$patterns[1]."</b><br>".str_cutting(strip_tags($patterns[2]), 200, 1);

$sidebar = str_replace("{sb-inner}", $sbinner, $sidebar);




#ascii

$page = str_replace("{content}", $content, $page);
$page = str_replace("{sidebar}", $sidebar, $page);
$page = str_replace("{menue}", $menue, $page);
$page = str_replace("{siteTitle}", $site, $page);

if($site == "Home" or $site == "home"){
  $files = getFileArrayFromFolder("images/asciiart");
  shuffle($files);
  $page = str_replace("{ascii}", "images/asciiart/".$files[0], $page);
  
  
     $jahr = 1994;
     $mon  =  7;
     $tag  =  29;
     
     $alter = (date('Y') - $jahr) - intval((date('j') < $tag) AND (date('n' ) <= $mon) );
     $alter = 15;
  
  
  $progzeit = $alter-12;
  
 $page = str_replace("{progzeit}", $progzeit, $page);
 $page = str_replace("{alter}", $alter, $page);
}

$page = replaceIcons($page); 

echo $page;

?>

