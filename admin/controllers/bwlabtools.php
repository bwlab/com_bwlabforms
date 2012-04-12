<?php
/**
 * ckdata Controller for CK forms Component
 * 
 * @package    CK.Joomla
 * @subpackage Components
 * @link http://www.cookex.eu
 * @license		GNU/GPL
 *
 *	Last change : 04/06/2008
 *	Pierre Revest
 */ 

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.controller' );

/**
 * ckdata Controller
 *
 * @package    CK.Joomla
 * @subpackage Components
 */
class BWLabFormsControllerCktools extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{	
		parent::__construct();
				
	}

	/**
	 * display CKForms view to Edit CSS
	 * @return void
	 **/
	function editCSS()
	{
				
		JRequest::setVar( 'view', 'cktools' );
		JRequest::setVar( 'layout', 'css' );
		
		parent::display();		
	}

	/**
	 * display CKForms view to Backup the data
	 * @return void
	 **/
	function backup()
	{
				
		JRequest::setVar( 'view', 'cktools' );
		JRequest::setVar( 'layout', 'backup' );
		
		parent::display();
		
	}

	/**
	 * Generate CKForms Backup data
	 * @return void
	 **/
	function startbackup()
	{
		$dba	=& JFactory::getDBO(); 					

		$model = $this->getModel('cktools');
		$modelCKForms = $this->getModel('bwlabforms');
		$modelCKFields = $this->getModel('bwlabfields');
		$modelCKData = $this->getModel('ckdata');
	
		$document = &JFactory::getDocument();
		$doc = &JDocument::getInstance('text');
		$document = $doc;
		
		header("Expires: Sun, 1 Jan 2000 12:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	
		header( "Content-type: text/plain; charset=UTF-8" ); 
		
		header("Content-disposition: attachment; filename=bwlabforms_" . date("Ymd").".sql"); 
	
		echo "-- CK Forms SQL Dump\n";
		echo "-- version 1.3.5\n";
		echo "-- http://bwlabforms.cookex.eu\n";
		echo "--\n";
		echo "-- Serveur: localhost\n";
		echo "-- Generated : ".date("Y-m-d H:i:s")."\n";

		echo "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n";

		echo "-- --------------------------------------------------------\n";

		echo "--\n";
		echo "-- Structure de la table `jos_bwlabforms`\n";
		echo "--\n";
		
		echo "TRUNCATE TABLE `".$dba->getPrefix()."bwlabforms`;\n";
		
		$fieldList =  $model->getFieldsList($dba->getPrefix()."bwlabforms");
		$items = $modelCKForms->getData();
		
		$fieldsStr = "";
		reset($fieldList[$dba->getPrefix()."bwlabforms"]);
		while (list($key, $val) = each($fieldList[$dba->getPrefix()."bwlabforms"])) {
			$fieldsStr = $fieldsStr."`$key`,";
		}
		
		if (substr($fieldsStr, strlen($fieldsStr)-1,1) == ",") $fieldsStr = substr($fieldsStr,0, strlen($fieldsStr)-1);
		
		$n=count( $items );
		for ($i=0; $i < $n; $i++)
		{
			$row = $items[$i];
			$rowSQL = "";
			$rowSQL = $rowSQL."INSERT INTO `".$dba->getPrefix()."bwlabforms` (".$fieldsStr.") VALUES (";
			reset($fieldList[$dba->getPrefix()."bwlabforms"]);
			while (list($key, $val) = each($fieldList[$dba->getPrefix()."bwlabforms"])) {
				if ($row->$key == null || trim($row->$key) == "")
				{
					$rowSQL = $rowSQL. "null";
				} else {
					if ($val != "int" and $val != "tinyint") $rowSQL = $rowSQL."'";
					$rowSQL = $rowSQL.addslashes($row->$key);
					if ($val != "int" and $val != "tinyint") $rowSQL = $rowSQL."'";
					} 
				$rowSQL = $rowSQL. ",";
			}
			if (substr($rowSQL, strlen($rowSQL)-1,1) == ",") $rowSQL = substr($rowSQL,0, strlen($rowSQL)-1);
			$rowSQL = $rowSQL. ");\n";
			echo $rowSQL;
		}
		
		echo "--\n";
		echo "-- Structure de la table `jos_bwlabfields`\n";
		echo "--\n";
		
		echo "TRUNCATE TABLE `".$dba->getPrefix()."bwlabfields`;\n";
		
		$fieldList =  $model->getFieldsList($dba->getPrefix()."bwlabfields");
		$items = $modelCKFields->getAllData();
		
		$fieldsStr = "";
		reset($fieldList[$dba->getPrefix()."bwlabfields"]);
		while (list($key, $val) = each($fieldList[$dba->getPrefix()."bwlabfields"])) {
			$fieldsStr = $fieldsStr."`$key`,";
		}
		
		if (substr($fieldsStr, strlen($fieldsStr)-1,1) == ",") $fieldsStr = substr($fieldsStr,0, strlen($fieldsStr)-1);
		
		$n=count( $items );		
		for ($i=0; $i < $n; $i++)
		{
			$row = $items[$i];
			$rowSQL = "";
			$rowSQL = $rowSQL."INSERT INTO `".$dba->getPrefix()."bwlabfields` (".$fieldsStr.") VALUES (";
			reset($fieldList[$dba->getPrefix()."bwlabfields"]);
			while (list($key, $val) = each($fieldList[$dba->getPrefix()."bwlabfields"])) {
				if ($row->$key == null || trim($row->$key) == "")
				{
					$rowSQL = $rowSQL. "null";
				} else {
					if ($val != "int" and $val != "tinyint") $rowSQL = $rowSQL."'";
					$rowSQL = $rowSQL.addslashes($row->$key);
					if ($val != "int" and $val != "tinyint") $rowSQL = $rowSQL."'";
					} 
				$rowSQL = $rowSQL. ",";
			}
			if (substr($rowSQL, strlen($rowSQL)-1,1) == ",") $rowSQL = substr($rowSQL,0, strlen($rowSQL)-1);
			$rowSQL = $rowSQL. ");\n";
			echo $rowSQL;
		}
	
		$tablesAllowed = $dba->getTableList(); 

		$items = $modelCKForms->getData();			
		$n=count( $items );		
		for ($i=0; $i < $n; $i++)
		{
			$row = $items[$i];
			
			if (in_array(strtolower($dba->getPrefix()."bwlabforms_".$row->id), $tablesAllowed))
			{
			
				echo "--\n";
				echo "-- Structure de la table `jos_bwlabforms_".$row->id."`\n";
				echo "--\n";

				echo "DROP TABLE IF EXISTS `".$dba->getPrefix()."bwlabforms_".$row->id."`;\n";
				
				$sql_create =  $model->getTableCreate($dba->getPrefix()."bwlabforms_".$row->id);
				if (count($sql_create) > 0)
				{
					$createSQL = str_replace(chr(10), " ", $sql_create[$dba->getPrefix()."bwlabforms_".$row->id]);
					echo $createSQL.";\n";
				}
				
				echo "--\n";
				
				$fieldList =  $model->getFieldsList($dba->getPrefix()."bwlabforms_".$row->id);
				$itemsData = $modelCKData->getDataForTable($dba->getPrefix()."bwlabforms_".$row->id);
				
				$fieldsStr = "";
				reset($fieldList[$dba->getPrefix()."bwlabforms_".$row->id]);
				while (list($key, $val) = each($fieldList[$dba->getPrefix()."bwlabforms_".$row->id])) {
					$fieldsStr = $fieldsStr."`$key`,";			
				}
				if (substr($fieldsStr, strlen($fieldsStr)-1,1) == ",") $fieldsStr = substr($fieldsStr,0, strlen($fieldsStr)-1);
				
				$k=count( $itemsData );		
				for ($j=0; $j < $k; $j++)
				{
					$rowData = $itemsData[$j];
					
					$rowSQLData = "INSERT INTO `".$dba->getPrefix()."bwlabforms_".$row->id."` (".$fieldsStr.") VALUES (";
					reset($fieldList[$dba->getPrefix()."bwlabforms_".$row->id]);
					while (list($key, $val) = each($fieldList[$dba->getPrefix()."bwlabforms_".$row->id])) {
						if ($rowData->$key == null || trim($rowData->$key) == "")
						{
							$rowSQLData = $rowSQLData. "null";
						} else {
							if ($val != "int" and $val != "tinyint") $rowSQLData = $rowSQLData."'";
							$rowSQLData = $rowSQLData.addslashes($rowData->$key);
							if ($val != "int" and $val != "tinyint") $rowSQLData = $rowSQLData."'";
							} 
						$rowSQLData = $rowSQLData. ",";
					}
					if (substr($rowSQLData, strlen($rowSQLData)-1,1) == ",") $rowSQLData = substr($rowSQLData,0, strlen($rowSQLData)-1);
					$rowSQLData = $rowSQLData. ");\n";
					echo $rowSQLData;
				}
			}				
		}
		
	}
	
	/**
	 * display CKForms view to Restore the data
	 * @return void
	 **/
	function restore()
	{
				
		JRequest::setVar( 'view', 'cktools' );
		JRequest::setVar( 'layout', 'restore' );
		
		parent::display();
		
	}
	
	/**
	 * Restore CKForms backup data
	 * @return void
	 **/
	function startrestore()
	{
		global $mainframe;
	
		$dba =& JFactory::getDBO(); 					
		$modelCKForms = $this->getModel('bwlabforms');
		$modelCKFields = $this->getModel('bwlabfields');
		$model = $this->getModel('cktools');

		$fileContent = file($_FILES['backupfile']['tmp_name']);
		
		if ($fileContent != false)
		{
			$aContent[] = null;
			$strlineContent = "";
			$version = "";
			
			while (list($numline,$line) = each($fileContent)) 
			{
				if (strpos($line,"version") !== false && substr($line,0,2) == "--") 
				{
					$version = trim(substr($line,strpos($line,"version")+strlen("version")+1,strlen($line)));
					//echo $version."<br />";
				}
				if (substr($line,0,2) != "--")
				{
					if ($line != '') 
					{
						$strlineContent = $strlineContent.trim($line);
					}
					
					if (substr($strlineContent,strlen($strlineContent)-1,1) == ";") 
					{
						if($strlineContent != '') $aContent[] = trim($strlineContent);
						$strlineContent = "";
					}
										
				}
			}
			
			foreach ($aContent as $cnt) {

				if ($cnt != '')
				{
					if (!$dba->Execute($cnt)) 
					{
						$this->setError( JText::_('Problem with')." (".$cnt.")" );
						echo $dba->getErrorMsg();
						//return false;
					}
				}
			}

			// Add Fiels IPADDRESS and PUBLISHED to old backup files
			$tablesAllowed = $dba->getTableList(); 
	
			$items = $modelCKForms->getData();			
			$n=count( $items );		
			for ($i=0; $i < $n; $i++)
			{
				$row = $items[$i];
				
				if (in_array(strtolower($dba->getPrefix()."bwlabforms_".$row->id), $tablesAllowed))
				{
					$fieldList =  $model->getFieldsList($dba->getPrefix()."bwlabforms_".$row->id);
				
					$test_ipaddress = '0';
					$test_published = '0';
					$test_articleid = '0';
					
					while (list($key, $val) = each($fieldList)) {
						while (list($key2, $val2) = each($val)) {
							if (strcmp($key2,"ipaddress") == 0) 
							{
								$test_ipaddress = '1';
							}
							if (strcmp($key2,"published") == 0) 
							{
								$test_published = '1';
							}
							if (strcmp($key2,"articleid") == 0) 
							{
								$test_articleid = '1';
							}
						}				
	
					}				
					
					if (strcmp($test_ipaddress,'0') == 0) 
					{
						$query = "ALTER TABLE ".$dba->getPrefix()."bwlabforms_".$row->id." ADD ipaddress TEXT NULL";
                                                $dba->setQuery($query);
						if (!$dba->query()) 
						{
							echo JText::_( 'Problem with' )." (".$query.")";
							echo $dba->getErrorMsg();
							return false;
						}
						
					}
					if (strcmp($test_published,'0') == 0) 
					{
						$query = "ALTER TABLE ".$dba->getPrefix()."bwlabforms_".$row->id." ADD published tinyint NULL DEFAULT '1'";
                                                $dba->setQuery($query);
						if (!$dba->query()) 
						{
							echo JText::_( 'Problem with' )." (".$query.")";
							echo $dba->getErrorMsg();
							return false;
						}
						
					}
					if (strcmp($test_articleid,'0') == 0) 
					{
						$query = "ALTER TABLE ".$dba->getPrefix()."bwlabforms_".$row->id." ADD articleid TEXT NULL";
                                                $dba->setQuery($query);
						if (!$dba->query()) 
						{
							echo JText::_( 'Problem with' )." (".$query.")";
							echo $dba->getErrorMsg();
							return false;
						}
						
					}

				}
			}
			
			$key = explode(".", $version);
			
			if ($key[0] <= 1 && $key[1] <= 3 && $key[2] <= 3) {
				
				// Process on table : rename table fields in save data				
				$items = $modelCKForms->getData();
				
				$n=count($items);		
				for ($i=0; $i < $n; $i++)
				{
					$row = $items[$i];
					
					$dataFieldList =  $model->getFieldsList($dba->getPrefix()."bwlabforms_".$row->id);
					$fields = $modelCKFields->getAllFields($row->id);

					while (list($key, $val) = each($dataFieldList[$dba->getPrefix()."bwlabforms_".$row->id])) {
						if ($key != 'id' && $key != 'created' && $key != 'ipaddress')
						{
							foreach ($fields as $field)							
							{
								if ($field->name == $key || "F".$field->id == $key)
								{
									echo $field->name . " : " .$key . " : " . "F".$field->id . "<br />";
									if ($field->name == $key)
									{
										$query = "ALTER TABLE ".$dba->getPrefix()."bwlabforms_".$row->id." CHANGE ".$field->name." F".$field->id . " TEXT NULL DEFAULT NULL"; 
                                                                                $dba->setQuery($query);
										
										if (!$dba->query()) 
										{
											echo JText::_( 'Problem with' )." (".$query.")";
											echo $dba->getErrorMsg();
										}
									}
								}
							}
		
						}
					}					
				}
			}
				
			$mainframe->redirect('index.php?option=com_bwlabforms',  JText::_('Restore successful')." [".$version."]");			
		} else {
			$mainframe->redirect('index.php?option=com_bwlabforms',  JText::_('Problem with Restore File')." ".$version);			
		}	
	}

	/**
	 * Save CKForms CSS
	 * @return void
	 **/
	function save()
	{
		global $mainframe;

		// Initialize some variables
		$csspath = JPATH_SITE . DS . 'components' . DS . 'com_bwlabforms' . DS . 'css' . DS . 'bwlabforms.css';
		$filecontent	= JRequest::getVar('ckcss', '', 'post', 'string', JREQUEST_ALLOWRAW);

		if (!$filecontent) {
			$mainframe->redirect('index.php?option=com_bwlabforms', JText::_('Operation Failed').': '.JText::_('Content empty').".");
		}

		jimport('joomla.filesystem.file');
		$return = JFile::write($csspath, $filecontent);

		if ($return)
		{
			$mainframe->redirect('index.php?option=com_bwlabforms',  JText::_('File Saved'));
		}
		else {
			$mainframe->redirect('index.php?option=com_bwlabforms', JText::_('Operation Failed').': '.JText::sprintf('Failed to open file for writing'.".", $file));
		}
	}

	/**
	 * Apply CKForms CSS
	 * @return void
	 **/
	function apply()
	{
		global $mainframe;

		// Initialize some variables
		$csspath = JPATH_SITE . DS . 'components' . DS . 'com_bwlabforms' . DS . 'css' . DS . 'bwlabforms.css';
		$filecontent	= JRequest::getVar('ckcss', '', 'post', 'string', JREQUEST_ALLOWRAW);

		if (!$filecontent) {
			$mainframe->redirect('index.php?option=com_bwlabforms', JText::_('Operation Failed').': '.JText::_('Content empty').".");
		}

		jimport('joomla.filesystem.file');
		$return = JFile::write($csspath, $filecontent);

		if ($return)
		{
			$mainframe->redirect('index.php?option=com_bwlabforms&controller=cktools&task=editCSS',  JText::_('File Saved'));
		}
		else {
			$mainframe->redirect('index.php?option=com_bwlabforms&controller=cktools&task=editCSS', JText::_('Operation Failed').': '.JText::sprintf('Failed to open file for writing'.".", $file));
		}
	}
	
}
?>
