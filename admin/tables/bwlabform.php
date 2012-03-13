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
class TableBWLabForm extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $title = null;

	/**
	 * @var string
	 */
	var $name = null;

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
	var $redirecturl = 0;
	var $redirectdata = 0;

	/**
	 * @var int
	 */
	var $saveresult = 0;

	/**
	 * @var int
	 */
	var $emailresult = 0;

	/**
	 * @var string
	 */
	var $textresult = null;

	/**
	 * @var int
	 */	
	var $created_by = 0;

	/**
	 * @var datetime
	 */
	var $created = null;

	/**
	 * @var int
	 */	
	var $hits = 0;

	/**
	 * @var string
	 */
	var $emailfrom = null;

	/**
	 * @var string
	 */
	var $emailto = null;

	/**
	 * @var string
	 */
	var $emailcc = null;

	/**
	 * @var string
	 */
	var $emailbcc = null;

	/**
	 * @var string
	 */
	var $subject = null;
	
	/**
	 * @var int
	 */	
	var $captcha = 0;

	var $captchacustominfo = null;
	var $captchacustomerror = null;

	/**
	 * @var int
	 */	
	var $poweredby = 0;
	
	/**
	 * @var string
	 */
	var $uploadpath = null;
	
	/**
	 * @var int
	 */	
	var $maxfilesize = 0;
	
	var $emailreceipt = 0;
	
	var $emailreceiptsubject = null;
	
	var $emailreceipttext = null;
	
	var $emailreceiptincfield = 0;
	
	var $emailreceiptincfile = 0;
	
	var $emailresultincfile = 0;
	
	var $formCSSclass = null;
	
	/**
	 * @var int
	 */
	var $displayip = 1;

	/**
	 * @var int
	 */
	var $displaydetail = 0;

   	var $fronttitle = null;
	
   	var $frontdescription = null;

   	var $autopublish = 1;
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableBWLabForm(& $db) {	
		$user =& JFactory::getUser();
		$created_by = $user->id;
		parent::__construct('#__bwlabforms', 'id', $db);
	}
	
	function store() {
		return parent::store();
	}
}
?>
