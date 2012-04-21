<?php

/**
 * BWLabField for CK form Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

/**
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormHelper {

    static public function getFieldUrl($fieldtype, $form_id) {

        $params = array();
        
        $params['option'] = JRequest::getVar('option');
        $params['task'] = add;
        $params['controller'] = 'bwlabfields';
        $params['type'] = $fieldtype;
        $params['fid'] = $form_id;
        
        foreach ($params as $key => $value) {
            $url[] = $key.'='.$value;
        }
        return implode('&', $url);
    }

}

