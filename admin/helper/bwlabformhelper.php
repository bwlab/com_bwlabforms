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

    static public function getFieldUrl($fieldtype, $form_id, $task = "add") {

        $params = array();

        $params['option'] = JRequest::getVar('option');
        $params['task'] = $task;
        $params['controller'] = 'bwlabfields';
        $params['type'] = $fieldtype;
        $params['fid'] = $form_id;

        return BWLabFormHelper::getUrl($params);
    }

    static public function getEditFieldUrl($id, $form_id) {

        $params = array();

        $params['option'] = JRequest::getVar('option');
        $params['task'] = 'edit';
        $params['controller'] = 'bwlabfields';
        $params['cid[]'] = $id;
        $params['fid'] = $form_id;

        return BWLabFormHelper::getUrl($params);
    }

    static public function getFieldListUrl($form_id) {

        $params = array();

        $params['option'] = JRequest::getVar('option');
        $params['controller'] = 'bwlabfields';
        $params['fid'] = $form_id;

        return BWLabFormHelper::getUrl($params);
    }

    static public function getFormEditUrl($fid) {

        $params = array();

        $params['option'] = JRequest::getVar('option');
        $params['task'] = 'edit';
        $params['cid[]'] = $fid;
        $params['fid'] = $form_id;

        return BWLabFormHelper::getUrl($params);
    }
    static public function getFormGenerateUrl($fid) {

        $params = array();

        $params['option'] = JRequest::getVar('option');
        $params['task'] = 'generate';
        $params['fid'] = $fid;

        return BWLabFormHelper::getUrl($params);
    }

    static public function getFormsUrl() {

        $params = array();

        $params['option'] = JRequest::getVar('option');

        return BWLabFormHelper::getUrl($params);
    }

    static public function getUrl($params) {
        foreach ($params as $key => $value) {
            $url[] = $key . '=' . $value;
        }
        return implode('&', $url);
    }

}

