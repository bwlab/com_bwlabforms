<?php
/**
 * Ck form entry point file for Ck form Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
// Require the base controller
set_include_path(get_include_path().PATH_SEPARATOR.JPATH_LIBRARIES.'/ZendFramework');

require_once (JPATH_COMPONENT.DS.'controller.php');
// Require specific controller if requested
if($controller = JRequest::getCmd('controller')) {
	require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
}

// Create the controller
$classname	= 'BWLabFormsController'.$controller;
$controller = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();

?>
