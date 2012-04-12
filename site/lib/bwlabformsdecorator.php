<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BWLabFormsDecorator
 *
 * @author lmassa
 */

class BWLabFormsDecorator extends Zend_Form_Decorator_Abstract {
    
    protected $_format = '';

    public function render($content) {
        $this->_format = '<label for="%s">%s</label>'. '<input id="%s" name="%s" type="text" value="%s"/>';
        $element = $this->getElement();
        $name = htmlentities($element->getFullyQualifiedName());
        $label = htmlentities($element->getLabel());
        $id = htmlentities($element->getId());
        $value = htmlentities($element->getValue());
        $markup = sprintf($this->_format, $name, $label, $id, $name, $value);
        return $markup;
        
    }
}
