v<?php
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

jimport('joomla.database.table');
require_once 'bwlabfield.php';

/**
 * bwlabfield type textTable class
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class TableBWLabFieldTypeSelect extends TableBWLabField {

    /**
     *
     * @var string
     */
    public $select_options = null;

}