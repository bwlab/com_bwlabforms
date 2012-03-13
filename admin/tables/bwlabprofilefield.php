<?php
/**
 * Form table class
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


/**
 * Form Table class
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class TableCkprofilefield extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var int
	 */
	var $profileid = null;

	/**
	 * @var int
	 */
	var $fieldid = null;

	/**
	 * @var string
	 */
	var $customlabel = null;

	/**
	 * @var string
	 */
	var $defaultvalue = null;

	/**
	 * @var int
	 */
	var $published = 1;

	/**
	 * @var int
	 */
	var $ordering = 0;

	/**
	 * @var int
	 */	
	var $created_by = 0;

	/**
	 * @var datetime
	 */
	var $created = null;
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableCkprofilefield(& $db) {	
		$user =& JFactory::getUser();
		$created_by = $user->id;
		parent::__construct('#__bwlabprofilefields', 'id', $db);
	}
	
	function store() {
		return parent::store();
	}
}
?>
