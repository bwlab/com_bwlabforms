<?php
// no direct access

defined('_JEXEC') or die('Restricted access');

if ($this->bwlabforms->published != '1')
    return;

//$nbFields = count($this->bwlabforms->fields);
//
//$mandatory = false;
//$upload = false;
//$custominfo = false;
//$textareaRequired = false;
//for ($i = 0; $i < $nbFields; $i++) {
//    $field = $this->bwlabforms->fields[$i];
//    if ($field->mandatory == "1")
//        $mandatory = true;
//    if ($field->typefield == "fileupload")
//        $upload = true;
//    if ($field->custominfo != "")
//        $custominfo = true;
//    if ($field->typefield == 'textarea' && $field->mandatory == '1' && $field->t_HTMLEditor == '1')
//        $textareaRequired = true;
//}

    echo $this->myform;
?>