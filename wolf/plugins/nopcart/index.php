<?php

Plugin::setInfos(array(
    'id'          => 'nopcart',
    'title'       => 'Nopcart', 
    'description' => 'Nopcart - Creer une boutique en ligne', 
    'version'     => '1.0', 
    'website'     => 'http://office-web.net')
);

function nopcart() {
echo "<script type=\"text/javascript\" src=\"".URL_PUBLIC."frog/plugins/nopcart/nopcart.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"".URL_PUBLIC."frog/plugins/nopcart/language-fr.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"".URL_PUBLIC."frog/plugins/nopcart/checkform.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"".URL_PUBLIC."frog/plugins/nopcart/switchcontent.js\"></script>\n";
echo "<script type=\"text/javascript\" src=\"".URL_PUBLIC."frog/plugins/nopcart/switchicon.js\"></script>\n";
echo "<link rel=\"stylesheet\" href=\"".URL_PUBLIC."frog/plugins/nopcart/styles.css\" type=\"text/css\" media=\"screen\" >\n";
}

