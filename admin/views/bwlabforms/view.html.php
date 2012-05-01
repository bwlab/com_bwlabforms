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
		JToolBarHelper::title(JText::_( 'BWLabForms' ), 'bwlabform' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::custom('duplicate','publish.png','publish.png',JText::_( 'Duplicate' ),true) ;
		JToolBarHelper::divider();
		JToolBarHelper::custom( 'backup', 'save.png', 'save_f2.png', JText::_('Backup'), false, false );
		JToolBarHelper::custom( 'restore', 'save.png', 'save_f2.png', JText::_('Restore'), false, false );

		$this->assignRef('forms', $this->get( 'Data'));
                
		$this->assignRef('pagination', $this->get('Pagination'));
		
		parent::display($tpl);
	}
}
