<?php

/**
 * bwlabforms entry point file for BWLabForms Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

// Require the base controller
require_once (JPATH_COMPONENT . DS . 'controller.php');
require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helper' . DS . 'bwlabformhelper.php';
JForm::addFormPath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'models' . DS . 'forms');
// Require specific controller if requested
if ($controller = JRequest::getCmd('controller')) {
    require_once (JPATH_COMPONENT . DS . 'controllers' . DS . $controller . '.php');
}

$doc = & JFactory::getDocument();
$css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
$doc->addStyleDeclaration($css);

// Create the controller
$classname = 'BWLabFormsController' . $controller;
$controller = new $classname( );

// Perform the Request task
$controller->execute(JRequest::getVar('task'));

// Redirect if set by the controller
$controller->redirect();
?>
