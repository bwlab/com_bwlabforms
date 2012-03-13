<?php
/**
 * BWLabForm for Ck forms Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

/**
 * BWLabForm Model
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsModelBWLabForm extends JModel
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
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
		$this->_id		= $id;
		$this->_data	= null;
	}

	function getId()
	{
		return $this->_id;
	}
	
	/**
	 * Method to get a form
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__bwlabforms '.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
			
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->title = null;
			$this->_data->name = null;
			$this->_data->description = null;
			$this->_data->published = 1;
			$this->_data->redirecturl = null;
			$this->_data->redirectdata = 0;
			$this->_data->saveresult = null;
			$this->_data->emailresult = null;
			$this->_data->textresult = null;			
			$this->_data->created_by = null;			
			$this->_data->created = null;			
			$this->_data->hits = null;			
			$this->_data->emailfrom = null;			
			$this->_data->emailto = null;			
			$this->_data->emailcc = null;			
			$this->_data->emailbcc = null;
			$this->_data->subject = null;
			$this->_data->captcha = null;
			$this->_data->captchacustominfo = null;
			$this->_data->captchacustomerror = null;
			$this->_data->uploadpath = JPATH_SITE.DS.'tmp'.DS;
			$this->_data->maxfilesize = null;
			$this->_data->poweredby = 1;
			$this->_data->emailresultincfile = 1; 
			$this->_data->emailreceipt = 0;
			$this->_data->emailreceiptsubject = null;
			$this->_data->emailreceipttext = null;
			$this->_data->emailreceiptincfield = 1;  
			$this->_data->emailreceiptincfile = 1;
			$this->_data->formCSSclass = null;
			$this->_data->displayip = 0;
			$this->_data->displaydetail = 0;
			$this->_data->fronttitle = null;
			$this->_data->frontdescription = null;
			$this->_data->autopublish = 1;			
		}
		return $this->_data;
	}

	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{
					
		$row = & $this->getTable();
		
		$user = & JFactory::getUser(); 
				
		$data = JRequest::get('POST', JREQUEST_ALLOWHTML);

		// Bind the form fields to the form table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Set complementary data
		$row->created_by = $user->id;
		$row->created = date("Y-m-d H:i:s");
		
		// Add '/' character to the fileupload directory path
		$rest = substr($row->uploadpath, -1);
		if (strcmp($rest,"/") != 0)
		{
			$row->uploadpath = $row->uploadpath."/";
		}
		
		// Make sure the hello record is valid
		if (!$row->check()) 
		{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
				
		$this->_id = $row->id;
		
		// Store the form table to the database
		if (!$row->store()) {
			$this->setError( $row->getError() );
			
			return false;
		}

		if ($row->saveresult == 1) {
			$tn = "#__bwlabforms_".$row->id;	
			
			$dba	=& JFactory::getDBO(); 
							
			$tablesAllowed = $dba->getTableList(); 
			
			/* Create the table to save the data */
			if (!in_array($dba->getPrefix().$tn, $tablesAllowed)) {
				/* Create table */
				$query = "create table ".$tn.
					" (id int(11) not null AUTO_INCREMENT,".
					"published tinyint,".
					"created datetime,".
					"primary key (id) ".
					") ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8";
				
                                $dba->setQuery($query);
				$dba->query();
				
				/* Add existing Fields */
				$query = ' SELECT * from #__bwlabfields c where c.fid='.$this->_id.' ';
				$fields = $this->_getList( $query );

				$tableFields = $dba->getTableFields($tn,false);
			  
			  	$n=count($fields );
				for ($i=0; $i < $n; $i++)
				{
					$rowField = $fields[$i];
					
					if (!isset( $tableFields[$tn][$rowField->name] )) 
					{
						$query = "ALTER TABLE ".$tn." ADD F".$rowField->id." TEXT NULL";
                                                $dba->setQuery($query);
						if (!$dba->query()) 
						{
							echo JText::_( 'Problem with' )." (".$query.")";
						}
					}
					
				}				
				
				// Add IP Address Field
				$query = "ALTER TABLE ".$tn." ADD ipaddress TEXT NULL";
                                $dba->setQuery($query);
				if (!$dba->query()) 
				{
					echo JText::_( 'Problem with' )." (".$query.")";
				}
				// Add Article ID Field
				$query = "ALTER TABLE ".$tn." ADD articleid TEXT NULL";
                                $dba->setQuery($query);
				if (!$dba->query()) 
				{
					echo JText::_( 'Problem with' )." (".$query.")";
				}
				
			}
		}
		
		return true;
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
		$tablesAllowed = $dba->getTableList(); 
		
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids ))
		{
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				} else {
					/* Delete Forms Data */
					$tn = "bwlabforms_" . $cid;
					
					if (in_array($dba->getPrefix().$tn, $tablesAllowed)) 
					{
						
						$query = "drop table #__".$tn;	
                                                $dba->setQuery($query);
						if (!$dba->query()) 
						{
							echo JText::_( 'Problem with' )." (".$query.")";
						}
					}
					
				}
			}						
		}
		
		return true;
	}

}
?>
