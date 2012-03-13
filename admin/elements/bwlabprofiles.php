<?php

/**
 * List of forms for BWLabForms Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JElementCkprofiles extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'ckdata';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db = &JFactory::getDBO();

		$query = "SELECT concat('f',a.id) as id, concat(a.name,' default') AS text "
		. ' FROM #__bwlabforms AS a'
		. ' WHERE a.published = 1'
		. ' ORDER BY a.name'
		;
		$db->setQuery( $query );
		$forms = $db->loadObjectList( );

		$query = "SELECT concat('p',a.id) as id, a.name AS text "
		. ' FROM #__bwlabprofiles AS a'
		. ' WHERE a.published = 1'
		. ' ORDER BY a.name'
		;
		$db->setQuery( $query );
		$options = $db->loadObjectList( );
		
		//$default = array();
		//$default[0] = JHTML::_('select.option',  '-1', '- '.JText::_( 'Default' ).'aa -', 'id', 'text' );
		$options = array_merge($forms, $options);


		$html = JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'id', 'text', $value, $control_name.$name );
		$html .= "\n".'<input type="hidden" name="urlparams[controller]" value="ckdata" />'; 
		
		return $html;
		
	}
}