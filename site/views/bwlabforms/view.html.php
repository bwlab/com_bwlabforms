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
jimport('ZendFramework.Zend.Loader');

/**
 * HTML View class for the CKForms Component
 *
 * @package		CKForms
 * @subpackage	Components
 */
class BWLabFormsViewBWLabForms extends JView {

    function display($tpl = null) {

        $mainframe = JFactory::getApplication();

        $bwlabforms = & $this->get('Data');

        $post = JRequest::get('post', JREQUEST_ALLOWHTML);

        Zend_Loader::loadClass('Zend_Validate_Interface');
        Zend_Loader::loadClass('Zend_Form');
        Zend_Loader::loadClass('Zend_View');

        $form = new Zend_Form();
        $form->setView(new Zend_View()); //vedi http://zend-framework-community.634137.n4.nabble.com/Form-Without-View-td651297.html
        $form->render();
        $form->setAction('index.php');
        $form->setMethod('POST');
        $form->setElementDecorators(array('ViewHelper')); //opzionale
        $params = & $mainframe->getParams('com_content');


        $nbFields = count($this->bwlabforms->fields);

        JFormHelper::loadFieldClass('text');

        
        
        foreach ($bwlabforms->fields as $field) {
            
            switch ($field->typefield) {
                case 'radiobutton':
                    $type = 'radio';
                    break;
                default :
                    $type = $field->typefield;
                    break;
            }
            
            $form->addElement($type, $field->name, array('label' => $field->label));
            $form->getElement($field->name)
                    ->addDecorator(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'inputdiv'))
                    ->addDecorator('Label');
                    //->addDecorator(array('labelDivClose' => 'HtmlTag'), array('tag' => 'div', 'class' => 'labeldiv', 'placement' => 'prepend', 'openOnly' => true));
            
            switch ($type) {
                case 'radio':
                case 'select':
                    $form->getElement($field->name)
                        ->addMultiOptions(array(
                    'male' => 'Male',
                    'female' => 'Female' 
                        ));

                    break;
                case 'hidden':
                case 'button':
                    $form->getElement($field->name)->removeDecorator('Label');
                    break;
                default:
                    break;
            }
        }


        $formLink = "index.php?option=com_bwlabforms&view=bwlabforms&task=send&id=" . $bwlabforms->id;

        $this->assignRef('post', $post);
        $this->assignRef('params', $params);
        $this->assignRef('bwlabforms', $bwlabforms);
        $this->assignRef('formLink', $formLink);
        $this->assignRef('myform', $form);

        $document = & JFactory::getDocument();


        parent::display($tpl);
    }

}