<?php

/*
/**
* BWLabForms version 1.3.5 stable
* Copyright (c) 2009 Cookex. All rights reserved.
* Author: Cookex development team
* See readme.html.
* Visit http://www.bwlab.it
**/

global $mainframe;

function com_install() {
	global $database;

	$db	=& JFactory::getDBO();
	if ($db) {
		//change fb menu icon
		$db->setQuery("SELECT id FROM #__components WHERE admin_menu_link = 'option=com_bwlabforms'");
		$id = $db->loadResult();
		
		//add new admin menu images
		$db->setQuery("UPDATE #__components " . "SET admin_menu_img  = '../administrator/components/com_bwlabforms/images/logo-menu.png'" . ",   admin_menu_link = 'option=com_bwlabforms' " . "WHERE id='$id'");
		$db->query();
		echo "->Change Menu Icon Ok<br/>";
	}
	
	echo "<br/>Thank you for the installation of BWLabForms 1.3.5<br/><br/>If you have any problems, contact <a href=\"mailto:webmaster@cookex.eu\">webmaster@cookex.eu</a><br/>Visit the <a href=\"http://www.bwlab.it\">CK Form web site</a> for the lastest news and update." ;

}
?>
