<?php
/**
 * bwlabforms Controller for BWLab Forms Component
 * 
 * @package    CK.Joomla
 * @subpackage Components
 * @link http://www.cookex.eu
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/**
 * bwlabforms Controller
 *
 * @package    CK.Joomla
 * @subpackage Components
 */
class BWLabFormsControllerBWLabForms extends BWLabFormsController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'apply',		'save' );
		$this->registerTask( 'unpublish',	'publish' );
	}

	/**
	 * display the CK Forms CSS
	 * @return void
	 */
	function edit_css() 
	{
		$this->setRedirect("index.php?option=com_bwlabforms&controller=cktools&task=editCSS");
	}

	/**
	 * display the CK Forms Backup page
	 * @return void
	 */
	function backup() 
	{
		$this->setRedirect("index.php?option=com_bwlabforms&controller=cktools&task=backup");
	}

	/**
	 * display the CK Forms Restore page
	 * @return void
	 */
	function restore() 
	{
		$this->setRedirect("index.php?option=com_bwlabforms&controller=cktools&task=restore");
	}
	
	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'bwlabform' );
		JRequest::setVar( 'layout', 'form'  );
		
		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('bwlabform');
		
		if ($model->store($post)) {
			$msg = JText::_( 'Form Saved' )." !";
		} else {
			$msg = JText::_( 'Error Saving Form' );
		}

		$task = JRequest::getCmd( 'task' );
		
		switch ($task)
		{
			case 'apply':
				$link = 'index.php?option=com_bwlabforms&controller=bwlabforms&task=edit&cid[]='. $model->getId() ;
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_bwlabforms';
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
		$model = $this->getModel('bwlabform');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Forms Could not be Deleted' );
		} else {
			$msg = JText::_( 'Form(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_bwlabforms', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_bwlabforms', $msg );
	}
	
	/**
	 * publish record
	 * @return void
	 */
	function publish()
	{
		$this->setRedirect( 'index.php?option=com_bwlabforms' );
		
		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__bwlabforms'
		. ' SET published = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Forms published' : 'Forms unpublished', $n ) );
	}	
	
	/**
	 * display the fields list for the selected form
	 * @return void
	 */
	function fields()
	{
		$fid = JRequest::getVar( 'id', -1);
		$this->setRedirect( "index.php?option=com_bwlabforms&controller=bwlabfields&fid=".$fid, $msg );
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
		
		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = ' SELECT * from #__bwlabforms c where c.id IN ( '. $cids.'  ) order by id asc';
		$db->setQuery($query);
		$duplicateforms = $db->loadObjectList();

		for ($j=0; $j < count($duplicateforms); $j++)		
		{
			$form = $duplicateforms[$j];
					
			$query = ' SELECT * from #__bwlabforms c order by ordering desc';
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			if (count($rows) > 0)
			{
				$order = $rows[0]->ordering + 1;
			} else {
				$order = 0;
			}
			
			$query = ' SELECT * from #__bwlabforms c order by id desc';
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			if (count($rows) > 0)
			{
				$newid = $rows[0]->id + 1;
			} else {
				$newid = '';
			}

			$model = $this->getModel('bwlabform');
			$newform =& JTable::getInstance('bwlabform', 'Table');
	
			$newform->name = 'form'.$newid;
	
			$newform->title = $form->title;
			$newform->description = $form->description;
			$newform->emailfrom = $form->emailfrom;
			$newform->emailto = $form->emailto;
			$newform->emailcc = $form->emailcc;
			$newform->emailbcc = $form->emailbcc;
			$newform->subject = $form->subject;
			$newform->created = $form->created;
			$newform->created_by = $form->created_by;
			$newform->hits = $form->hits;
			$newform->published = $form->published;
			$newform->saveresult = $form->saveresult;
			$newform->emailresult = $form->emailresult;
			$newform->textresult = $form->textresult;
			$newform->redirecturl = $form->redirecturl;
			$newform->captcha = $form->captcha;
			$newform->captchacustominfo = $form->captchacustominfo;
			$newform->captchacustomerror = $form->captchacustomerror;
			$newform->customjs = $form->customjs;
			$newform->uploadpath = $form->uploadpath;
			$newform->maxfilesize = $form->maxfilesize;
			$newform->poweredby = $form->poweredby;
			$newform->emailreceipt = $form->emailreceipt;
			$newform->emailreceipttext = $form->emailreceipttext;
			$newform->emailreceiptsubject = $form->emailreceiptsubject;
			$newform->emailreceiptincfield = $form->emailreceiptincfield;
			$newform->emailreceiptincfile = $form->emailreceiptincfile;
			$newform->emailresultincfile = $form->emailresultincfile;
			$newform->formCSSclass = $form->formCSSclass;			
			$newform->displayip = $form->displayip;	
		   	$newform->displaydetail = $form->displaydetail;	
		   	$newform->fronttitle = $form->fronttitle;			
		   	$newform->frontdescription = $form->frontdescription;	
			$newform->autopublish = $form->autopublish;	
   
			$newform->store();
			
			$query = ' SELECT * from #__bwlabforms c order by id desc';
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			$fid = $rows[0]->id;

			$query = ' SELECT * from #__bwlabfields where fid='.$form->id.' order by id asc';
			$db->setQuery($query);
			$duplicaterows = $db->loadObjectList();
	
			for ($i=0; $i < count($duplicaterows); $i++)
			{
				$row = $duplicaterows[$i];
				
				$query = ' SELECT * from #__bwlabfields c order by id desc';
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
				$newrow->ordering = $i;
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

		}
		
		
		$msg = JText::_( 'Forms and Fields duplicated' );
		$this->setRedirect( 'index.php?option=com_bwlabforms', $msg );
	}	
	
}
?>
