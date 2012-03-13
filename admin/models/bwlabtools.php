<?php
/**
 * ckdata Model for BWLabForms Component
 * 
/**
 * bwlabforms entry point file for BWLabForms Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * BWLabData Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class BWLabFormsModelCktools extends JModel
{
	/**
	 * BWLabData data array
	 *
	 * @var array
	 */
	var $_data;
	
	/*
	 * BWLabData fields array
	 *
	 * @var array
	 */
	var $_datafields;
	
	/*
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();

		$this->setId((int)JRequest::getVar('fid',  0));		
	}
	
	/**
	 * Method to set the form identifier
	 *
	 * @access	public
	 * @param	int form identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id = $id;
	}

	function getId()
	{
		return $this->_id;
	}

	/**
	 * Retrieves the forms data
	 * @return array Array of objects containing the data from the database
	 */
	function getCss()
	{
		
		jimport('joomla.filesystem.file');

		$csspath = JPATH_SITE . DS . 'components' . DS . 'com_bwlabforms' . DS . 'css' . DS . 'bwlabforms.css';
		$content = JFile::read($csspath);

		if ($content !== false)
		{
			$content = htmlspecialchars($content, ENT_COMPAT, 'UTF-8');
		}

		return $content;
	}

	/**
	 * Retrieves the fields list
	 * @return array Array of objects containing the data from the database
	 */
	function getDatafields()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_datafields ))
		{
			$tn = "#__bwlabforms_".$this->_id;
						
			$query = ' SELECT * from #__bwlabfields c where c.fid='.$this->_id.' ';	
								
			$this->_datafields = $this->_getList( $query );
			
		}

		return $this->_datafields;
	}
	
		/**
	 * Method to get a hello
	 * @return object with data
	 */
	function getDetail()
	{
		$array = JRequest::getVar('cid',  0, '', 'array');
		
		$query = ' SELECT * FROM #__bwlabforms_'.$this->_id.
				'  WHERE id = '.(int)$array[0];
		$this->_db->setQuery( $query );
		$this->_detail = $this->_db->loadObject();
		
		return $this->_detail;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
	{
		
		$dba =& JFactory::getDBO(); 

		$fid = JRequest::getVar( 'fid', -1);
		$tn = "bwlabforms_" . $fid;
				
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		foreach($cids as $cid) {
			$query = "delete from #__" . $tn . " where id=" . $cid;
                        $dba->setQuery($query);
			if (!$dba->query()) 
			{
				$this->setError( "Problem with (".$query.")" );
				return false;
			}		
		}
		
		return true;
		
	}
	
		
	/**
	 * Retrieves the SQL Code to create table
	 * @return array Array of objects containing the data from the database
	 */
	function getTableCreate($tablename)
	{
		$dba =& JFactory::getDBO(); 
		$sql = $dba->getTableCreate($tablename);
		
		return $sql;
	}

	/**
	 * Retrieves the SQL Code to create table
	 * @return array Array of objects containing the data from the database
	 */
	function getFieldsList($tablename)
	{
		$dba =& JFactory::getDBO(); 
		$sql = $dba->getTableFields($tablename);
		
		return $sql;
	}
	
}
