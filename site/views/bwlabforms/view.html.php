<?php

/**
 * Deflaut View for CKForms Component
 * 
 * @package    CKForms
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */
jimport('joomla.application.component.view');
jimport('joomla.form');

/**
 * HTML View class for the CKForms Component
 *
 * @package		CKForms
 * @subpackage	Components
 */
class BWLabFormsViewBWLabForms extends JView {

    function display($tpl = null) {

        $form = new JForm('bwlabform');


        $mainframe = JFactory::getApplication();
        $bwlabforms = & $this->get('Data');

        $post = JRequest::get('post', JREQUEST_ALLOWHTML);
        $this->assignRef('post', $post);

        $params = & $mainframe->getParams('com_content');
        $this->assignRef('params', $params);

        $this->assignRef('bwlabforms', $bwlabforms);
        $nbFields=count($this->bwlabforms->fields );
        JFormHelper::loadFieldClass('text');
        for ($i = 0; $i < $nbFields; $i++) {
            $field = $this->bwlabforms->fields[$i];
            switch ($field->typefield) {
                case 'text':
                    $fld = new JFormFieldText($form);
                    break;

                default:
                    break;
            }
        }
        $formLink = "index.php?option=com_bwlabforms&view=bwlabforms&task=send&id=" . $bwlabforms->id;
        $this->assignRef('formLink', $formLink);
        $this->assignRef('myform', $form);
        $document = & JFactory::getDocument();


        parent::display($tpl);
    }

}

?>
