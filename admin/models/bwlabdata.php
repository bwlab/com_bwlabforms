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
class BWLabFormsModelBWLabData extends JModel
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
	
	/**
	* Items total
	* @var integer
	*/
	var $_total = null;
	
	/**
	* Pagination object
	* @var object
	*/
	var $_pagination = null;
	
	/*
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();

		global $mainframe, $option;

        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 
        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);

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
	function getDataForTable($tablename)
	{
	
		$query = ' SELECT * from '.$tablename.' c';						
		$data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			
		return $data;
	}

	/**
	 * Retrieves the forms data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		
		// Get Sort parameters
		$sortfield = JRequest::getVar('sortf',  'id');
		$sortdirection = JRequest::getVar('sortd',  'asc');

		$filter = $this->getFilter();
		
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$tn = "#__bwlabforms_".$this->_id;
			
			$query = ' SELECT * from '.$tn.' c ';
			if ($filter != '')			
			{
				$query = $query .' where '.$filter.' ';
			}
			$query = $query .' order by '.$sortfield.' '.$sortdirection;
			
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
			
		}

		return $this->_data;
	}

	function getTotal()
	{

		$filter = $this->getFilter();

		// Load the content if it doesn't already exist
		if (empty($this->_total)) {
			$tn = "#__bwlabforms_".$this->_id;
			
			$query = ' SELECT * from '.$tn.' c ';		
			if ($filter != '')			
			{
				$query = $query .' where '.$filter.' ';
			}
			$this->_total = $this->_getListCount($query);    
		}
		return $this->_total;
	}
	
	/**
	 * Retrieves the forms data
	 * @return array Array of objects containing the data from the database
	 */
	function getFilter()
	{
		// Get Filter parameters
		$ckfilter = JRequest::getVar('ckfilter',  '');
		$ckfilterpublished = JRequest::getVar('ckfilterpublished',  '');

		$filter = '';
		if ($ckfilter != '' || $ckfilterpublished != '')
		{		
			if ($ckfilter != '')
			{
				$filter = $filter." (";
				$fields = $this->getDatafields();
				$keywords = explode(" ", $ckfilter);
				$k=count( $keywords );
				
				for ($j=0; $j < $k; $j++)
				{
					$n=count( $fields );
					for ($i=0; $i < $n; $i++)
					{
						$rowField = $fields[$i];
						if ($rowField->typefield != 'button' && $rowField->typefield != 'fieldsep')
						{
							$prop="F".$rowField->id;
							$filter = $filter." upper(".$prop.") like upper('%".$keywords[$j]."%') or ";
						}
					}
					$filter = $filter." ipaddress like '%".$keywords[$j]."%' or ";
				}
				$filter = rtrim($filter,'or '); 
				$filter = $filter." )";
									 
			}
			if ($ckfilterpublished != '')			
			{
				if ($ckfilterpublished == '1')
				{
					if ($filter != '') $filter = $filter." and";
					$filter = $filter." published = 1 ";
				}
				else if ($ckfilterpublished == '2')
				{
					if ($filter != '') $filter = $filter." and";
					$filter = $filter." published = 0 ";
				}

			}		
		}
		
		return $filter;
	}
	
	function getPagination()
	{
		// Load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
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
		
		
}
