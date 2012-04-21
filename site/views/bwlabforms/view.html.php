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

/**
 * HTML View class for the CKForms Component
 *
 * @package		CKForms
 * @subpackage	Components
 */
class BWLabFormsViewBWLabForms extends JView {

    public function __construct($config = array()) {

        parent::__construct($config);

    }

    function display($tpl = null) {

        $mainframe = JFactory::getApplication();

        $bwlabforms = & $this->get('Data');

        if ($bwlabforms->published != '1')
            return;

        $action = "index.php?option=com_bwlabforms&view=bwlabforms&task=send&id=" . $bwlabforms->id;
        
        /**
         * directory form and field xml model 
         */
        $path = JPATH_COMPONENT.DS.'models'.DS.'fields';
        
        /**
         * load xml form model 
         * @var JXMLElement
         */
        $xml_form =  simplexml_load_file($path.DS.'bwl_form.xml', 'JXMLElement');
        $fieldset = $xml_form->xpath('//fieldset[@name="main"]');
        $field = $fieldset[0]->addChild('field');
        $field->addAttribute('type', 'text');
        $field->addAttribute('label', 'test');
        $field->addAttribute('name', 'test');
     
        
           $field = $fieldset[0]->addChild('field');
        $field->addAttribute('type', 'text');
        $field->addAttribute('label', 'nuovo amico');
        $field->addAttribute('name', 'test2');
        
        /**
         *load cml field model 
         */
        $xml_field =  simplexml_load_file($path.DS.'bwl_flds_text.xml', 'JXMLElement');
        
  
        
        JForm::addFormPath($path);
        $jf_standard = new JForm('formmain');
        $jf_standard->load($xml_form);
//        JForm::getInstance('formmain','bwl_form');
        //$jf_standard->setField($xml_field, 'extra');
        
        //$jf_standard->setField($xml_field, 'extra');
        $this->assignRef('jf_standard', $jf_standard);
        
        //$post = JRequest::get('post', JREQUEST_ALLOWHTML);

//        $form = $this->getForm($action);

        
        
        
        /**
         * form elements creation 
         */
//        foreach ($bwlabforms->fields as $field) {
//
//            $type = $this->getFieldType($field);
//
//            $form->addElement($type, $field->name, array('label' => $field->label));
//
//            $form->getElement($field->name)
//                    ->addDecorator(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'inputdiv'))
//                    ->addDecorator('Label');
//            //->addDecorator(array('labelDivClose' => 'HtmlTag'), array('tag' => 'div', 'class' => 'labeldiv', 'placement' => 'prepend', 'openOnly' => true));
//
//            $form->getElement($field->name)->setValue(
//                    $this->getDefaultValue($field)
//            );
//            switch ($type) {
//                case 'file':
//                    $form->getElement($field->name)->setDecorators(
//                            array(
//                                'File',
//                                'Errors',
//                                array(array('data' => 'HtmlTag'),  array('tag' => 'div', 'class' => 'inputdiv')),
//                                array('Label'),
//                            )
//                    );
//                    break;
//                case 'radio':
//                case 'select':
//                case 'multiselect':
//                    $this->setOptions($field, $form->getElement($field->name));
//                    break;
//                case 'checkbox':
//                    if ($field->t_checkedCB)
//                        $form->getElement($field->name)->setAttrib('checked', 'checked');
//                    break;
//                case 'hidden':
//                case 'button':
//                    $form->getElement($field->name)->removeDecorator('Label');
//                    break;
//                default:
//                    break;
//            }
//            $form->getElement($field->name);
//        }

        $this->assignRef('params', $mainframe->getParams('com_content'));
        $this->assignRef('bwlabforms', $form);

        $document = & JFactory::getDocument();

        parent::display($tpl);
    }

    /**
     * mapping into zend_form fields
     * @param type $field
     * @return type 
     */
    private function getFieldType($field) {

        switch ($field->typefield) {
            case 'radiobutton':
                $type = 'radio';
                break;
            case 'select':
                $type = $field->t_multipleS ? 'multiselect' : 'select';
                break;
            case 'button':
                $type = 'submit';
                break;
            default :
                $type = $field->typefield;
                break;
        }

        return $type;
    }

    /**
     * explode options for select and radiobutton
     * @param type $field
     * @param type $element 
     */
    private function setOptions($field, $element) {

        $options = array();

        //explode radiobutton and select
        if ($field->t_displayRB || $field->t_listHS) {

            if ($field->t_displayRB)
                $opts = explode("[-]", $field->t_listHRB);

            if ($field->t_listHS)
                $opts = explode("[-]", $field->t_listHS);

            foreach ($opts as $opt) {

                $vals_opt = explode("==", $opt);

                $key_and_val = explode("||", $vals_opt[1]);

                if (strpos($key_and_val[1], ' [default]')) {

                    $key_and_val[1] = str_replace(' [default]', '', $key_and_val[1]);

                    $element->setValue($key_and_val[0]);
                }

                $element->addMultiOption(
                        $key_and_val[0], $key_and_val[1]
                );
            }
        }


        $element->addMultiOptions($options);
    }

    /**
     * get zend_form instance
     * @return \Zend_Form 
     */
    public function getForm($action) {

        $form = new Zend_Form();

        $form->setAction($action);

        $form->setMethod('POST');

        $form->setView(new Zend_View()); //vedi http://zend-framework-community.634137.n4.nabble.com/Form-Without-View-td651297.html

        $form->render();

        $form->setElementDecorators(array('ViewHelper')); //opzionale

        return $form;
    }

    private function getDefaultValue($field) {

        if ($field->t_initvalueT) {
            return $field->t_initvalueT;
        }

        if ($field->t_initvalueTA) {
            return $field->t_initvalueTA;
        }

        if ($field->t_initvalueH) {
            return $field->t_initvalueH;
        }

        if ($field->t_initvalueCB) {
            return $field->t_initvalueCB;
        }

        return '';
    }

}

