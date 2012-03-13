<?php
/**
 * bwlabfields View for Ck forms Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

/**
 * bwlabfields View
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsViewBWLabFields extends JView
{
	/**
	 * bwlabfields view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		$doc =& JFactory::getDocument();
		$css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
   		$doc->addStyleDeclaration($css);

		$document =& JFactory::getDocument();
		$document->addStyleSheet(JURI::root(true).'/administrator/components/com_bwlabforms/css/bwlabforms_min.css');
	
		JToolBarHelper::title(JText::_( 'BWLabForms - Fields' ), 'bwlabform' );
	
		JToolBarHelper::custom('addsep','publish.png','publish.png',JText::_( 'Add separator' ),false) ;
		JToolBarHelper::divider();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		//JToolBarHelper::addNew();
		JToolBarHelper::custom('duplicate','publish.png','publish.png',JText::_( 'Duplicate' ),true) ;
		JToolBarHelper::divider();
		JToolBarHelper::back('Forms','index.php?option=com_bwlabforms');

		// Get data from the model
		$items = & $this->get( 'Data');
		$pagination =& $this->get('Pagination');

		$this->assignRef('items',$items);
                $this->assignRef('fid',  JRequest::getVar('fid',-1));
		$this->assignRef('pagination', $pagination);

		parent::display($tpl);
	}
}
