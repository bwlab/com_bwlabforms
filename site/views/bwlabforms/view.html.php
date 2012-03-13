<?php
/**
 * Deflaut View for CKForms Component
 * 
 * @package    CKForms
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the CKForms Component
 *
 * @package		CKForms
 * @subpackage	Components
 */
class BWLabFormsViewBWLabForms extends JView
{
	function display($tpl = null)
	{	
		$mainframe = JFactory::getApplication();
		$bwlabforms = & $this->get('Data');
	
		$post = JRequest::get('post', JREQUEST_ALLOWHTML);
		$this->assignRef( 'post',$post );
		
		$params =& $mainframe->getParams('com_content');
		$this->assignRef('params' , $params);
	
		$this->assignRef( 'bwlabforms',$bwlabforms );
		
		$formLink = "index.php?option=com_bwlabforms&view=bwlabforms&task=send&id=".$bwlabforms->id;		
		$this->assignRef( 'formLink',$formLink );

		$document =& JFactory::getDocument();
		
		
		parent::display($tpl);
		
	}

}
?>
