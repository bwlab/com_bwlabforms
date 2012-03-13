<?php
/**
 * ckdata Controller for CK forms Component
 * 
 * @package    CK.Joomla
 * @subpackage Components
 * @link http://www.cookex.eu
 * @license		GNU/GPL
 */ 

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.controller' );

/**
 * ckdata Controller
 *
 * @package    BWLabForms
 * @subpackage Components
 */
class BWLabFormsControllerBWLabData extends JController
{

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
	
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'unpublish',	'publish' );
	}

	/**
	 * Export data saved in database
	 * @return void
	 */
	function export() {
			
		$model = $this->getModel('ckdata');
		
		$items = $model->getData();
		$fields = $model->getDatafields();
		
		$ipfieldname = "ipaddress";
		
		$document = &JFactory::getDocument();
		$doc = &JDocument::getInstance('text');
		$document = $doc;
			
		header("Expires: Sun, 1 Jan 2000 12:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header( "Content-type: application/vnd.ms-excel"); 
		header("Content-disposition: attachment; filename=bwlabforms_" . date("Ymd").".csv");  

		$data = "";
		$isIPaddress = false;
		
		$nbItems=count( $items );
		$nbFields=count( $fields );
		
		/* Test if ipaddress field exist */
		if ($nbItems > 0)
		{			
			$row = $items[0];
			
			foreach($row as $key => $value) {
				if (strcmp($key,$ipfieldname) == 0)
				{
					$isIPaddress = true;
				}
			}
			
		}
		
		for ($i=0; $i < $nbFields; $i++)
		{
			$rowField = $fields[$i];
			if ($rowField->typefield != 'button' && $rowField->typefield != 'fieldsep')
			{
				//$unicode_str_for_Excel = utf8_decode($rowField->name);
				$unicode_str_for_Excel = iconv("UTF-8", "windows-1250",$rowField->label);

				$unicode_str_for_Excel = str_replace("\"", "\"\"", $unicode_str_for_Excel);
				
				$pos = strpos($unicode_str_for_Excel, ';');
				if ($pos === false) 
				{
					$data .= $unicode_str_for_Excel;
				} else {
					$data .= "\"".$unicode_str_for_Excel."\"";
				}
				
				if ($i < $nbFields-1) $data .= ";";				
			}			
		}
		if ($isIPaddress == true)
		{
			$data .= ";".JText::_( 'IP Address' );
		}

		echo $data." \n";
		
		for ($i=0; $i < $nbItems; $i++)
		{
			$row = $items[$i];
			
			$data = '';
			$z=count( $fields );
			for ($j=0; $j < $z; $j++)
			{
				$rowField = $fields[$j];
				if ($rowField->typefield != 'button' && $rowField->typefield != 'fieldsep')
				{
					$prop="F".$rowField->id;
					
					//$unicode_str_for_Excel = mb_convert_encoding( $row->$prop, 'UTF-16LE', 'UTF-8'); 
					//$unicode_str_for_Excel = utf8_decode($row->$prop);
					
					if (isset($row->$prop) == false)
					{
						$prop=$rowField->name;
					}
					$unicode_str_for_Excel = iconv("UTF-8", "windows-1250",$row->$prop);

					$unicode_str_for_Excel = str_replace("\"", "\"\"", $unicode_str_for_Excel);

					$pos = strpos($unicode_str_for_Excel, ';');
					if ($pos === false) 
					{
						$data .= $unicode_str_for_Excel;
					} else {
						$data .= "\"".$unicode_str_for_Excel."\"";
					}
	
					if ($j < $z-1) $data .= ";";			
				}
			}

			if ($isIPaddress == true)
			{
				$data .= ";".$row->$ipfieldname;
			}

			echo $data." \n";
		}

		return;
	}	

	/**
	 * remove record(s) from database
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('ckdata');
		$fid = JRequest::getVar( 'fid', -1 );
		
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More record could not be Deleted' );
		} else {
			$msg = JText::_( 'Field(s) Deleted' );
		}

		$this->setRedirect('index.php?option=com_bwlabforms&controller=ckdata&fid='.$fid, $msg );
	}
	
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{	
		JRequest::setVar( 'view', 'ckdata' );
		
		parent::display();
	}

	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function detail()
	{
		JRequest::setVar( 'view', 'ckdata' );
		JRequest::setVar( 'layout', 'detail' );
		
		parent::display();
	}
	
	
	/**
	 * publish record
	 * @return void
	 */
	function publish()
	{
		
		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );
		$fid = JRequest::getVar( 'fid', -1 );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		$link = 'index.php?option=com_bwlabforms&controller=ckdata&fid='. $fid ;

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__bwlabforms_'.$fid
		. ' SET published = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )';
		
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		
		$this->setMessage( JText::sprintf( $publish ? 'Data published' : 'Data unpublished', $n ) );
		
		$this->setRedirect($link);		
	}
	
	
	/* ************************************ */
	/* Functions to export in XLS Format 	*/
	/* ************************************ */
	
	function xlsBOF() { 
		echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);  
		return; 
	} 
	
	function xlsEOF() { 
		echo pack("ss", 0x0A, 0x00); 
		return; 
	} 
	
	function xlsWriteNumber($Row, $Col, $Value) { 
		echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
		echo pack("d", $Value); 
		return; 
	} 
	
	function xlsWriteLabel($Row, $Col, $Value ) { 
		$L = strlen($Value); 
		echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
		echo $Value; 
		return; 
	} 
	
}
?>
