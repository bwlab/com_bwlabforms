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

jimport('joomla.database.table');
require_once 'bwlabfield.php';

/**
 * bwlabfield type textTable class
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class TableBWLabFieldTypeText extends TableBWLabField {

    /**
     *
     * @var string
     */
    public $value = null;
    /**
     *
     * @var integer
     */
    public $maxlength = null;
    /**
     *
     * @var string
     */
    public $src = null;
    /**
     *
     * @var integer
     */
    public $size = null;
    /**
     *
     * @var boolean
     */
    public $checked = null;
    /**
     *
     * @var string
     */
    public $alt = null;
    /**
     *
     * @var string
     */
    public $accept = null;
    /**
     *
     * @var string
     */
    public $date_format = null;
    /**
     *
     * @var date
     */
    public $date_today = null;
    /**
     *
     * @var string
     */
    public $radio_options = null;

}