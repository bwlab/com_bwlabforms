<?php
/**
 * bwlabforms View for CK forms Component
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
 * bwlabforms View
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsViewBWLabForms extends JView
{
	/**
	 * bwlabforms view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		$doc =& JFactory::getDocument();
		$css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
   		$doc->addStyleDeclaration($css);
	
		$document =& JFactory::getDocument();
		$document->addStyleSheet(JURI::root(true).'/administrator/components/com_bwlabforms/css/bwlabforms_min.css');

		JToolBarHelper::title(JText::_( 'BWLabForms' ), 'bwlabform' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::custom('duplicate','publish.png','publish.png',JText::_( 'Duplicate' ),true) ;
		JToolBarHelper::custom( 'edit_css', 'css.png', 'css_f2.png', JText::_('Edit CSS'), false, false );
		JToolBarHelper::divider();
		JToolBarHelper::custom( 'backup', 'save.png', 'save_f2.png', JText::_('Backup'), false, false );
		JToolBarHelper::custom( 'restore', 'save.png', 'save_f2.png', JText::_('Restore'), false, false );

		// Get data from the model
		$items = & $this->get( 'Data');
		$pagination =& $this->get('Pagination');

		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);
		
		//$version = new CKFormsVersion();
		//$this->assignRef('version', $version);
		
		parent::display($tpl);
	}
}
