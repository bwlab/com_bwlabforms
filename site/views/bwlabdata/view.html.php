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
class BWLabFormsViewBWLabFormsdata extends JView
{
	function display($tpl = null)
	{	
		global $mainframe;
		
        $menus  = & JSite::getMenu(); 
        $menu   = $menus->getActive(); 
		
		$params = & $mainframe->getParams('com_content');	
		
		$itemid = JRequest::getCmd('Itemid','-1');
		$limit = JRequest::getCmd('limitstart','-1');
		if ($limit < 0) 
		{
			$limit = 0;
		}
		
		$id = JRequest::getCmd('id','-1');
		$sortf = JRequest::getCmd('sortf','id');
		$sortd = JRequest::getCmd('sortd','asc');		
		
		$this->assignRef('params' , $params);
		$this->assignRef('itemid' , $itemid);
		$this->assignRef('limit' , $limit);
		$this->assignRef('id' , $id);
		$this->assignRef('sortf' , $sortf);
		$this->assignRef('sortd' , $sortd);

		if ($this->_layout == "detail")
		{

			// Get data from the model
			$item = & $this->get( 'Detail');
			$form = & $this->get('Form4detail');	
			$fields = & $this->get('Datafields4detail');
			
			$this->assignRef('item',$item);

		} else {
		
			$displayColumnHeader = '1';
			$displayBorders = '1';
			
			// because the application sets a default page title, we need to get it 
			// right from the menu item itself 
			if (is_object( $menu )) { 
				$menu_params = new JParameter( $menu->params );         
				$displayColumnHeader = $menu_params->get( 'show_columnheader', '0' );           
				$displayBorders = $menu_params->get( 'show_tableborder', '0' );  
			} 
			
			$items = & $this->get('Data');	
			$pagination =& $this->get('Pagination');
			$form = & $this->get('Form');
			$fields = & $this->get('Datafields');
		
			$this->assignRef('items',$items );
			$this->assignRef('pagination', $pagination);
			$this->assignRef('displayColumnHeader',$displayColumnHeader );
			$this->assignRef('displayBorders', $displayBorders);
			
		}

		$this->assignRef('form',$form);
		$this->assignRef('fields',$fields);

		parent::display($tpl);
		
	}

}
?>
