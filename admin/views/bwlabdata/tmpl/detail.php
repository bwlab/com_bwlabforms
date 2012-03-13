<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
 
    <div id="tabs1">
		<table class="admintable">

        <tr>
            <td width="100" align="right" class="key">
                <label for="title">
                   <?php echo JText::_( 'ID' ); ?>
                </label>
            </td>
            <td>
                <?php echo $this->item->id; ?>
            </td>
        </tr>
        <tr>
            <td width="100" align="right" class="key">
                <label for="title">
                    <?php echo JText::_( 'Date' ); ?>:
                </label>
            </td>
            <td>
                <?php echo $this->item->created; ?>
            </td>
        </tr>
         
	<?php	$k = 0;
		$n=count( $this->fields );
		for ($i=0; $i < $n; $i++)
		{
			$rowField = $this->fields[$i];
			if ($rowField->typefield != 'button' && $rowField->typefield != 'fieldsep')
			{
				$prop="F".$rowField->id;
				if (isset($this->item->$prop) == false)
				{
					$prop=$rowField->name;
				}
				
				if (isset($this->item->$prop))
				{
					$texte = $this->item->$prop;
				} else {
					$texte = "&nbsp;";
				}
							
 	?>
    
        <tr>
            <td width="100" align="right" class="key">
                <label for="title">
                    <?php echo  $rowField->label; ?>:
                </label>
            </td>
            <td>
<?php             

			if ($rowField->typefield == 'text') {
				$opt = explode("[--]", $rowField->defaultvalue);
				$key1 = explode("===", $opt[0]);
				$key2 = explode("===", $opt[1]);
				$key3 = explode("===", $opt[2]);
				$t_texttype = $key3[1];
				
				if ($t_texttype == 'email') {
					$texte = '<a href="mailto:'.$texte.'">'.$texte.'</a>';
				}
				
			}           
 ?>
             
                <?php echo  $texte; ?>
            </td>
        </tr>
            
	<?php	
			}
		}
 	?>
        <tr>
            <td width="100" align="right" class="key">
                <label for="title">
                   <?php echo JText::_( 'IP Address' ); ?>
                </label>
            </td>
            <td>
                <?php echo $this->item->ipaddress; ?>
            </td>
        </tr>

		</table>        
	</div>

<input type="hidden" name="option" value="com_bwlabforms" />
<input type="hidden" name="id" value="<?php echo $this->bwlabforms->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="bwlabforms" />

</form>
<div class="bwlabformbottom bwlabformbottomborder">
	CKForms V1.3.5, &copy; 2008-2009 Copyright by <a href="http://bwlabforms.cookex.eu" target="_blank" class="smallgrey">Cookex</a>, all rights reserved. 
    CKForms is Free Software released under the GNU/GPL License. 
</div>