<?php

/*
/**
* BWLabForms version 1.3.5 stable
* Copyright (c) 2008 Cookex. All rights reserved.
* Author: Cookex development team
* 
* Visit http://www.bwlab.it
**/

function com_uninstall() {
	global $database, $mosConfig_absolute_path;
	$mainframe = JFactory::getApplication();
	
	$db	=& JFactory::getDBO();

	if ($db) {
		$tablesAllowed = $db->getTableList();
		
		//$database->setQuery("SELECT id FROM #__bwlabforms");
		$db->setQuery("SELECT * FROM #__bwlabforms");
		$forms = $db->loadObjectList();
		
		$n=count($forms);
		for ($i=0; $i < $n; $i++)
		{
			$row = $forms[$i];
			$tn = "#__bwlabforms_".$row->id;
			
			//add new admin menu images
			$db->setQuery("drop table if exists ".$tn);
			$db->query();			
				
			echo "-> Data table ".$tn." dropped <br/>";
		}
		
		
		$db->setQuery("drop table if exists #__bwlabprofilefields");
		$db->query();			
		echo "-> Profile Fields table dropped <br/>";
		
		$db->setQuery("drop table if exists #__bwlabprofiles");
		$db->query();			
		echo "-> Profiles table dropped <br/><br/>";

		$db->setQuery("drop table if exists #__bwlabfields");
		$db->query();			
		echo "-> Fields table dropped <br/>";
		
		$db->setQuery("drop table if exists #__bwlabforms");
		$db->query();			
		echo "-> Forms table dropped <br/><br/>";
	}

	// Delete languages files
	jimport('joomla.language.helper');
	$languages = JLanguageHelper::createLanguageList($mainframe->getCfg('language'));
	foreach ($languages as $key => $value) {
		foreach ($value as $key2 => $value2) {
			if ($key2 == "value")
			{
				if (file_exists (JPATH_ROOT.DS.'language'.DS.$value2.DS.$value2.'.com_bwlabforms.ini'))
				{
					echo "- Delete CK Form language file : ".$value2."<br/>";
					unlink(JPATH_ROOT.DS.'language'.DS.$value2.DS.$value2.'.com_bwlabforms.ini');
				}				
				if (file_exists (JPATH_ROOT.DS.'administrator'.DS.'language'.DS.$value2.DS.$value2.'.com_bwlabforms.ini'))
				{
					echo "- Delete CK Form Administrator language file : ".$value2."<br/>";
					unlink(JPATH_ROOT.DS.'administrator'.DS.'language'.DS.$value2.DS.$value2.'.com_bwlabforms.ini');
				}				
			}
		}
	}
	
	echo "<br/><br/>The component CK forms 1.3.5 and data associated have been succesfully uninstalled.";
}
