<?php
defined('_JEXEC') or die('Restricted access');

    foreach ($this->jf_standard->getFieldset('main') as $fieldsets => $fieldset):

        echo $fieldset->label;
        echo $fieldset->input;

    endforeach;
?>