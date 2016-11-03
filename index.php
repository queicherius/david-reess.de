<?php

function str_cutting($scString,$scMaxlength,$atspace = 1)
{
	if (strlen($scString)>$scMaxlength)
	{
		$output = "";
		$scString = substr($scString,0,$scMaxlength-4);
		if ($atspace && strpos($scString,' '))
		{
			$scStrexp = @split(" ",$scString);
			for ($scI = 0; $scI < count($scStrexp)-1; $scI++) $output.= $scStrexp[$scI]." ";
		}
		else
		$output = $scString;
		return $output."...";
	}
	else
	return $scString;
}

function twitter_call($url, $type='GET')
{


	//cURL Handle erzeugen
	$ch = curl_init();




	curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8');



	//Festlegen ob ein GET- oder POST-Request gesendet wird
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);

	//URL festlegen
	curl_setopt($ch, CURLOPT_URL, $url);

	//Daten als String zurückgeben und nicht direkt an den Browser senden
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//Login-Informationen setzen
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, "queicherius:heroz4w0rld");

	//URL aufrufen und XML interpretieren
	$data = curl_exec($ch);


	if(preg_match("#(over capacity)#", $data)){
		echo "Twitter is over capacity.";
		return false;
	}

	if(preg_match("#(rate limit exceeded)#", $data)){
		echo "Rate limit is exceeded.";
		return false;
	}

	if(curl_error($ch)){
		echo "CURL-ERROR:";
		var_dump(curl_error($ch));
		return false;
	}


	$data = @simplexml_load_string($data);
	//Resourcen freigeben
	curl_close($ch);

	return $data;
}

function createGallerie($folder){

	$newfolder = "public/images/".$folder;
$newfolder2 = URL_PUBLIC.$newfolder;
	echo '<div class="gallery">';

	$i = 0;

	$handle = opendir($newfolder);
	while ($file = readdir ($handle)) {
		if($file != "." && $file != "..") {

			$filewithoutending = explode(".", $file);
			$filename = $filewithoutending[0];
			$fileending = $filewithoutending[1];

			if(!preg_match("#([^.]*).((\d*x\d*)|(x\d*)|(\d*x)).(jpg|jpeg|png|gif|wbmp)#", $file)){
				echo '<a href="'.$newfolder2."/".$file.'" class="floatleft">
	               <span class="bild"><img src="'.$newfolder2."/".$filename.'.148x.'.$fileending.'"/></span>
	              <!-- <span class="title">Die Mona Lisa in W&uuml;rfeln</span> -->
	            </a>';

						$i++;

				if($i == 4){
					echo '<br class="clear">';
					$i = 0;
				}


			}
		}
	}
	closedir($handle);

	echo  '<br class="clear" /></div>';


}



/**
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2009 Martijn van der Kleijn <martijn.niji@gmail.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 *
 * This file is part of Wolf CMS.
 *
 * Wolf CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Wolf CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Wolf CMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Wolf CMS has made an exception to the GNU General Public License for plugins.
 * See exception.txt for details and the full text.
 */

//  Constants  ---------------------------------------------------------------

define('CMS_ROOT', dirname(__FILE__));
define('FROG_ROOT', CMS_ROOT); // DEFINED ONLY FOR BACKWARDS SUPPORT - to be taken out before 0.9.0
define('CORE_ROOT', CMS_ROOT.'/wolf');
define('PLUGINS_ROOT', CORE_ROOT.'/plugins');

define('APP_PATH', CORE_ROOT.'/app');

require_once(CORE_ROOT.'/utils.php');

$config_file = CMS_ROOT.'/config.php';

require_once($config_file);

// if you have installed wolf and see this line, you can comment it or delete it :)
if ( ! defined('DEBUG')) { header('Location: install/'); exit(); }

// Figure out what the public URI is based on URL_PUBLIC.
// TODO - improve
$changedurl = str_replace('//','|',URL_PUBLIC);
$lastslash = strpos($changedurl, '/');
if (false === $lastslash) {
	define('URI_PUBLIC', '/');
}
else {
	define('URI_PUBLIC', substr($changedurl, $lastslash));
}

// Security checks -----------------------------------------------------------
if (DEBUG == false && isWritable($config_file)) {
	// Windows systems always have writable config files... skip those.
	if (substr(PHP_OS, 0, 3) != 'WIN') {
		echo '<html><head><title>Wolf CMS automatically disabled!</title></head><body>';
		echo '<h1>Wolf CMS automatically disabled!</h1>';
		echo '<p>Wolf CMS has been disabled as a security precaution.</p>';
		echo '<p><strong>Reason:</strong> the configuration file was found to be writable.</p>';
		echo '</body></html>';
		exit();
	}
}

//  Init  --------------------------------------------------------------------

define('BASE_URL', URL_PUBLIC . (endsWith(URL_PUBLIC, '/') ? '': '/') . (USE_MOD_REWRITE ? '': '?'));

require CORE_ROOT.'/Framework.php';

try {
	$__CMS_CONN__ = new PDO(DB_DSN, DB_USER, DB_PASS);
}
catch (PDOException $error) {
	die('DB Connection failed: '.$error->getMessage());
}

if ($__CMS_CONN__->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql')
$__CMS_CONN__->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

// DEFINED ONLY FOR BACKWARDS SUPPORT - to be taken out before 0.9.0
$__FROG_CONN__ = $__CMS_CONN__;

Record::connection($__CMS_CONN__);
Record::getConnection()->exec("set names 'utf8'");

Setting::init();

use_helper('I18n');
I18n::setLocale(Setting::get('language'));

// Only add the cron web bug when necessary
if (defined('USE_POORMANSCRON') && USE_POORMANSCRON && defined('POORMANSCRON_INTERVAL')) {
	Observer::observe('page_before_execute_layout', 'run_cron');

	function run_cron() {
		$cron = Cron::findByIdFrom('Cron', '1');
		$now = time();
		$last = $cron->getLastRunTime();

		if ($now - $last > POORMANSCRON_INTERVAL) {
			echo $cron->generateWebBug();
		}
	}
}

// run everything!
require APP_PATH.'/main.php';
