<?php
/**
 * bwlabfield table class
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


/**
 * bwlabfield Table class
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class TableBWLabField extends JTable
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
	var $fid = null;
	
	/**
	 * @var string
	 */
	var $label = null;

	/**
	 * @var string
	 */
	var $name = null;

	/**
	 * @var string
	 */
	var $typefield = null;

	/**
	 * @var int
	 */
	var $ordering = null;

	/**
	 * @var int
	 */
	var $published = 1;

	/**
	 * @var int
	 */
	var $mandatory = 0;
	
	/**
	 * @var int
	 */
	var $readonly = 0;

	/**
	 * @var string
	 */
	var $custominfo = null;

	/**
	 * @var string
	 */
	var $customerror = null;

	/**
	 * @var string
	 */
	var $customvalidation = null;

	/**
	 * @var string
	 */
	var $fieldCSSclass = null;

	/**
	 * @var string
	 */
	var $labelCSSclass = null;
	
	/**
	 * @var string
	 */
	var $customtext = null;
	
	/**
	 * @var string
	 */
	var $customtextCSSclass = null;
	
	/**
	 * @var int
	 */
	var $frontdisplay = 1;
	
	var $fillwith = null;
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableBWLabField(& $db) {			
		parent::__construct('#__bwlabfields', 'id', $db);
	}
	
	function store() {

		return parent::store();
	}
}
?>
