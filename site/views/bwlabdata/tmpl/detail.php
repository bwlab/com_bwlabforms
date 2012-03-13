<?php defined('_JEXEC') or die('Restricted access'); ?>

<link type="text/css" href="<?php echo JURI::root(true); ?>/components/com_bwlabforms/css/bwlabforms.css" rel="stylesheet">

<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php	
    if (isset($this->form->fronttitle) == false || strcmp ($this->form->fronttitle, "") == 0)
	{
		echo $this->form->title; 
	} else {
		echo $this->form->fronttitle; 
	}
	
	$linkback = "index.php?option=com_bwlabforms&view=bwlabformsdata&layout=data&controller=ckdata&Itemid=".$this->itemid;
	if ($this->limit < 0)
	{
		$linkback = $linkback.'&limitstart=0';
	} else {
		$linkback = $linkback.'&limitstart='.$this->limit;
	}
	$linkback = $linkback.'&id='. $this->id;
	
?>
</div>

<a href="<?php echo $linkback; ?>">
<?php echo JText::_( 'Back to the list' ); ?> &raquo;</a>
 
<table>
         
<?php	$k = 0;
	$n=count( $this->fields );
	for ($i=0; $i < $n; $i++)
	{
		$rowField = $this->fields[$i];
		
		$t_texttype = "";		
		if ($rowField->typefield == 'text')
		{
			$opt = explode("[--]", $rowField->defaultvalue);
			$key1 = explode("===", $opt[0]);
			$key2 = explode("===", $opt[1]);
			$key3 = explode("===", $opt[2]);
			$t_texttype = $key3[1];
		}

		if (($rowField->typefield != 'text' && $rowField->typefield != 'button' && $rowField->typefield != 'fieldsep')
			 || ($rowField->typefield == 'text' && $t_texttype != 'password'))
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
	<td class="ckfrontlabel">
    <label for="title">
        <?php echo  $rowField->label; ?> :
    </label>
    </td>
    <td>
<?php             
			if ($rowField->typefield == 'text') {
				
				if ($t_texttype == 'email') {
					$texte = '<a href="mailto:'.$texte.'">'.$texte.'</a>';
				}
				
			}           

		echo  $texte; ?>
    </td>
</tr>
            
<?php	
			}
		}

		if ($this->form->displayip == '1') 
    	{
?>
        <tr>
            <td class="ckfrontlabel">
                <label for="title">
                   <?php echo JText::_( 'IP Address' ); ?>
                </label>
            </td>
            <td>
                <?php echo $this->item->ipaddress; ?>
            </td>
        </tr>
<?php } ?>

<?php /* ?>
        <tr>
            <td class="ckfrontlabel">
                <label for="title">
                    <?php echo JText::_( 'Date' ); ?>:
                </label>
            </td>
            <td>
                <?php echo $this->item->created; ?>
            </td>
        </tr>
<?php */ ?>
        
        </table>        
	</div>


<?php if ($this->form->poweredby == '1') { ?>
	<div id="ckpoweredby" colspan="<?php if ($custominfo == true){?>3<?php } else {?>2<?php }?>"><a href="http://bwlabforms.cookex.eu" target="_blank"><?php echo JText::_( 'Powered by BWLabForms' ); ?></a></div>
<?php } ?>
