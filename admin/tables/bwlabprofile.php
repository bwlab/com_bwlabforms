<?php
/**
 * Profile table class
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


/**
 * Profile Table class
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class TableCkprofile extends JTable
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
	var $formid = null;

	/**
	 * @var string
	 */
	var $title = null;

	/**
	 * @var string
	 */
	var $description = null;

	/**
	 * @var int
	 */
	var $published = 1;

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
	function TableCkprofile(& $db) {	
		$user =& JFactory::getUser();
		$created_by = $user->id;
		parent::__construct('#__bwlabprofiles', 'id', $db);
	}
	
	function store() {
		return parent::store();
	}
}
?>
