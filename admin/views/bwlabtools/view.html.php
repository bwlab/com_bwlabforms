<?php
/**
 * bwlabfield View for CK forms Component
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
 * bwlabfield View
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsViewCktools extends JView
{
	/**
	 * display method of bwlabfield view
	 * @return void
	 **/
	function display($tpl = null)
	{
		
		$doc =& JFactory::getDocument();
		$css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
   		$doc->addStyleDeclaration($css);

		$document =& JFactory::getDocument();
		$document->addStyleSheet(JURI::root(true).'/administrator/components/com_bwlabforms/css/bwlabforms.css');
	
		switch (JRequest::getVar('layout'))
		{
			case 'css':
				JToolBarHelper::title(JText::_( 'BWLabForms - Tools - Edit CSS' ) , 'bwlabform' );
				JToolBarHelper::apply();
				JToolBarHelper::save();

				$css = & $this->get( 'Css');
				$this->assignRef('css',$css);
			break;
			case 'backup':
				JToolBarHelper::title(JText::_( 'BWLabForms - Tools - Backup' ) , 'bwlabform' );
				JToolBarHelper::custom( 'startbackup', 'save.png', 'save_f2.png', JText::_('Backup'), false, false );
			break;
			case 'restore':
				JToolBarHelper::title(JText::_( 'BWLabForms - Tools - Restore' ) , 'bwlabform' );
				JToolBarHelper::custom( 'startrestore', 'save.png', 'save_f2.png', JText::_('Restore'), false, false );
			break;
		}
					
		JToolBarHelper::cancel( 'cancel', 'Close' );

		JRequest::setVar( 'hidemainmenu', 1 );
		
		parent::display($tpl);
	}
}
