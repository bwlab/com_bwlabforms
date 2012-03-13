<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

<p><b>CK forms restore tool</b> restore all your forms with the fields saved with the backup tool.</p>
<p>Warning : the restore procedure replace all your existing data with the data in the backup file !</p>
<p />
<p>To start the restore procedure choose the backup file and click on "Restore" button.</p>

<input name="backupfile" type="file" size="100" />

<input type="hidden" name="option" value="com_bwlabforms" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="cktools" />

</form>

<div class="bwlabformbottom bwlabformbottomborder">
	CKForms V1.3.5, &copy; 2008-2009 Copyright by <a href="http://bwlabforms.cookex.eu" target="_blank" class="smallgrey">Cookex</a>, all rights reserved. 
    CKForms is Free Software released under the GNU/GPL License. 
</div>