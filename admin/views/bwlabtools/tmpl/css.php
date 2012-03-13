<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
    	<textarea name="ckcss" id="ckcss" wrap="wrap" style="width:98%;height:300px"><?php echo $this->css; ?></textarea>         
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_bwlabforms" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="cktools" />

</form>


<div class="bwlabformbottom">
	CKForms V1.3.5, &copy; 2008-2009 Copyright by <a href="http://bwlabforms.cookex.eu" target="_blank" class="smallgrey">Cookex</a>, all rights reserved. 
    CKForms is Free Software released under the GNU/GPL License. 
</div>