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

class JElementBWLabForms extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'bwlabforms';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db = &JFactory::getDBO();

		$query = 'SELECT a.id, a.name AS text '
		. ' FROM #__bwlabforms AS a'
		. ' WHERE a.published = 1'
		. ' ORDER BY a.name'
		;
		$db->setQuery( $query );
		$options = $db->loadObjectList( );

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'id', 'text', $value, $control_name.$name );
	}
}