<?php

/**
 * bwlabfields Controller for BWLab Forms Component
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
 * bwlabfields Controller
 *
 * @package    CK.Joomla
 * @subpackage Components
 */
class BWLabFormsControllerBWLabFields extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
	
		parent::__construct();

		// Register Extra tasks
		//$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'apply', 'save' );
		$this->registerTask( 'unpublish',	'publish' );
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit() {
	
		JRequest::setVar( 'view', 'bwlabfield' );
		JRequest::setVar( 'layout', 'bwlabfield_tpl');
		
		parent::display();
	}

        function add() {
		JRequest::setVar( 'view', 'bwlabfield' );
		JRequest::setVar( 'layout', 'bwlabfield_tpl');
		
		parent::display();
	}
	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		
		$model = $this->getModel('bwlabfield');
		$fid = JRequest::getVar( 'fid', -1 );
		
		if ($model->store($post)) {
			$msg = JText::_( 'Field Saved' )." !";
		} else {
			$msg = JText::_( 'Error Saving Field' );
		}

		$task = JRequest::getCmd( 'task' );
		
		switch ($task)
		{
			case 'apply':
				$link = 'index.php?option=com_bwlabforms&controller=bwlabfields&task=edit&cid[]='.$model->getId().'&fid='.$fid;
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_bwlabforms&controller=bwlabfields&fid='.$fid;
				break;
		}
		
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('bwlabfield');
		$fid = JRequest::getVar( 'fid', -1 );
		
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Field Could not be Deleted' );
		} else {
			$msg = JText::_( 'Field(s) Deleted' );
		}

		$this->setRedirect('index.php?option=com_bwlabforms&controller=bwlabfields&fid='.$fid, $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$fid = JRequest::getVar( 'fid', -1 );
		
		$this->setRedirect( 'index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $fid, $msg );
	}
	
	function publish()
	{
		
		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );
		$fid		= JRequest::getVar( 'fid', -1 );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__bwlabfields'
		. ' SET published = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Fields published' : 'Fields unpublished', $n ) );
		
		$link = 'index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $fid ;
		
		$this->setRedirect($link);
	}	
	
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{	
		JRequest::setVar( 'view', 'bwlabfields' );
		
		parent::display();
	}
	
	/**
	 * Method to order up the record
	 *
	 * @access	public
	 */
	function orderup()
	{
		$fid = JRequest::getVar( 'fid', -1 );

		$model = $this->getModel('bwlabfield');
		$model->move(-1);

		$this->setRedirect('index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $fid);
	}

	/**
	 * Method to order down the record
	 *
	 * @access	public
	 */
	function orderdown()
	{
		$fid		= JRequest::getVar( 'fid', -1 );

		$model = $this->getModel('bwlabfield');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $fid);
	}

	/**
	 * Method to save the order
	 *
	 * @access	public
	 */
	function saveorder()
	{
		$fid = JRequest::getVar( 'fid', -1 );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order = JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('bwlabfield');
		$model->saveorder($cid, $order);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect('index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $fid, $msg );
	}	
	
	/**
	 * Add Field separator to Field List
	 * @return void
	 */
	function addsep() 
	{
		// Initialize variables
		$db			=& JFactory::getDBO();

		$fid = JRequest::getVar( 'fid', -1);
		
		$query = ' SELECT * from #__bwlabforms c where c.id='.$fid.' ';
		$form = $db->GetRow( $query );
		if (count($form ) == 0)
		{		
			return JError::raiseWarning( 500, $row->getError() );
		}
		
		$query = ' SELECT * from #__bwlabfields c where c.fid='.$fid.' order by ordering desc';
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if (count($rows) > 0)
		{
			$order = $rows[0]->ordering + 1;
		} else {
			$order = 0;
		}
		
		$query = ' SELECT * from #__bwlabfields c where c.fid='.$fid.' order by id desc';
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if (count($rows) > 0)
		{
			$newid = $rows[0]->id + 1;
		} else {
			$newid = '';
		}
		
		$model = $this->getModel('bwlabfield');
		$row =& JTable::getInstance('bwlabfield', 'Table');

		$row->fid = $fid;
		$row->label = 'Field separator';
		$row->name = 'fieldsep'.$newid;
		$row->typefield = 'fieldsep';
		$row->published = 1;
		$row->ordering = $order;
		
		$row->store();
		
		$msg = JText::_( 'Field separator saved' );
		$this->setRedirect('index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $fid, $msg );		
		
	}
	
	/**
	 * Duplicate selected Fields
	 * @return void
	 */
	function duplicate()
	{
		
		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );
		$fid		= JRequest::getVar( 'fid', -1 );
		
		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = ' SELECT * from #__bwlabfields c where c.id IN ( '. $cids.'  )';
		$db->setQuery($query);
		$duplicaterows = $db->loadObjectList();

		for ($i=0; $i < count($duplicaterows); $i++)
		{
			$row = $duplicaterows[$i];
			
			$query = ' SELECT * from #__bwlabfields c where c.fid='.$fid.' order by ordering desc';
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			if (count($rows) > 0)
			{
				$order = $rows[0]->ordering + 1;
			} else {
				$order = 0;
			}
			
			$query = ' SELECT * from #__bwlabfields c where c.fid='.$fid.' order by id desc';
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			if (count($rows) > 0)
			{
				$newid = $rows[0]->id + 1;
			} else {
				$newid = '';
			}
			
			$model = $this->getModel('bwlabfield');
			$newrow =& JTable::getInstance('bwlabfield', 'Table');
	
			$newrow->fid = $fid;
			$newrow->name = 'field'.$newid;
			$newrow->label = $row->label;
			$newrow->typefield = $row->typefield;
			$newrow->defaultvalue = $row->defaultvalue;
			$newrow->mandatory = $row->mandatory;
			$newrow->test_validity = $row->test_validity;
			$newrow->published = $row->published;
			$newrow->ordering = $order;
			$newrow->custominfo = $row->custominfo;
			$newrow->customerror = $row->customerror;
			$newrow->customvalidation = $row->customvalidation;
			$newrow->readonly = $row->readonly;
			$newrow->labelCSSclass = $row->labelCSSclass;
			$newrow->fieldCSSclass = $row->fieldCSSclass;
			$newrow->customtext = $row->customtext;
			$newrow->customtextCSSclass = $row->customtextCSSclass;
			$newrow->frontdisplay = $row->frontdisplay;
			
			$newrow->store();
		
		}

		$msg = JText::_( 'Fields duplicated' );
		$this->setRedirect('index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $fid, $msg );		
	}	
	
}
?>
