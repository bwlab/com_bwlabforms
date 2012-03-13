<?php defined('_JEXEC') or die('Restricted access'); ?>

<script type="text/javascript">

window.addEvent('domready', function(){
	$('resetBtn').addEvents({
		'click': function(){
		if($chk($('ckfilter'))) { 
			$('ckfilter').setProperty('value','');
		}
		if($chk($('ckfilterpublished'))) { 
			$('ckfilterpublished').setProperty('value','0');
		}
		}
	});
	//}
});
</script>


<style type="text/css">
<!--
#element-box  {
	overflow:auto !important;
}
-->
</style>

<?php 
	$sortLink = JRoute::_( 'index.php?option=com_bwlabforms&controller=ckdata&fid='.JRequest::getVar( 'fid', -1 ).'&limitstart='.JRequest::getVar( 'limitstart', -1 ) );
?>

<form action="index.php" method="post" name="adminForm" id="ckadminform" >

<div>
	<img src="components/com_bwlabforms/images/find.png" /> <?php echo JText::_( 'Filter' ); ?>
    <input id="ckfilter" name="ckfilter" type="text" value="<?php echo JRequest::getVar( 'ckfilter', '' ) ?>" />

    <select id="ckfilterpublished" name="ckfilterpublished" size="1">
		<option value="0" >all</option> 	
		<option value="1" <?php if (JRequest::getVar( 'ckfilterpublished', '0') == '1') { echo 'selected="selected"';}?> ><?php echo JText::_( 'published' ); ?></option>	
		<option value="2" <?php if (JRequest::getVar( 'ckfilterpublished', '0') == '2') { echo 'selected="selected"';}?> ><?php echo JText::_( 'unpublished' ); ?></option>
    </select>
    <input name="ckbtnsearch" type="submit" value="<?php echo JText::_( 'Search' ); ?>" />
    <input name="ckbtnreset" id="resetBtn" type="button" value="<?php echo JText::_( 'Reset' ); ?>" />
</div>

<table class="adminlist">
<thead>
    <tr>
            <th width="3%">
                <?php echo JText::_( 'Num' ); ?>
            </th>
			<th width="3%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>	
			<th width="3%">
    	<?php 
			$sortLinkURL = JRoute::_($sortLink."&sortf=published");
			$sortimg = '';
			if ($this->sortf == 'published')
			{
				if ($this->sortd == "asc")
				{
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=desc");
					$sortimg = ' <img src="images/sort_asc.png" />';
				} else {
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
					$sortimg = ' <img src="images/sort_desc.png" />';
				}
			} else {
				$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
			}
         ?>
         <a href="<?php echo $sortLinkURL; ?>">
		<?php 
			echo JText::_( 'Published' ).$sortimg;
		?>
        </a>
			</th>	

			<?php	$k = 0;
	$n=count( $this->fields );
	for ($i=0; $i < $n; $i++)
	{
		$rowField = $this->fields[$i];
		if ($rowField->typefield != 'button' && $rowField->typefield != 'fieldsep')
		{			
			$sortLinkURL = JRoute::_($sortLink."&sortf=".$rowField->name);
			$sortimg = '';
			if ($rowField->name == $this->sortf)
			{
				if ($this->sortd == "asc")
				{
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=desc");
					$sortimg = ' <img src="images/sort_asc.png" />';
				} else {
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
					$sortimg = ' <img src="images/sort_desc.png" />';
				}
			} else {
				$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
			}
?>
        <th><a href="<?php echo $sortLinkURL; ?>"><?php echo  $rowField->label. " " . $sortimg; ?></a></th>
<?php         
		}
	}
 ?>
			<th width="4%">
    	<?php 
			$sortLinkURL = JRoute::_($sortLink."&sortf=ipaddress");
			$sortimg = '';
			if ($this->sortf == 'ipaddress')
			{
				if ($this->sortd == "asc")
				{
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=desc");
					$sortimg = ' <img src="images/sort_asc.png" />';
				} else {
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
					$sortimg = ' <img src="images/sort_desc.png" />';
				}
			} else {
				$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
			}
         ?>
         <a href="<?php echo $sortLinkURL; ?>">
		<?php 
			echo JText::_( 'IP Address' ).$sortimg;
		?>
        </a>
			</th>

			<th width="3%">
    	<?php 
			$sortLinkURL = JRoute::_($sortLink."&sortf=id");
			$sortimg = '';
			if ($this->sortf == 'id')
			{
				if ($this->sortd == "asc")
				{
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=desc");
					$sortimg = ' <img src="images/sort_asc.png" />';
				} else {
					$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
					$sortimg = ' <img src="images/sort_desc.png" />';
				}
			} else {
				$sortLinkURL = JRoute::_($sortLinkURL."&sortd=asc");
			}
         ?>
         <a href="<?php echo $sortLinkURL; ?>">
		<?php 
			echo JText::_( 'ID' ).$sortimg;
		?>
        </a>
			</th>
	</tr>			
</thead>
	<?php
	$k = 0;
	$n=count( $this->items );
	for ($i=0; $i < $n; $i++)
	{	
	
		$row = &$this->items[$i];
		$published	= JHTML::_('grid.published', $row, $i );
		$checked = JHTML::_('grid.id',   $i, $row->id );
		$link = JRoute::_( 'index.php?option=com_bwlabforms&controller=ckdata&task=detail&fid='.JRequest::getVar( 'fid', -1 ).'&cid[]='. $row->id );

		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $i+1; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>            
            <td align="center">
                <?php echo $published;?>
            </td>
<?php
	$z=count( $this->fields );
	for ($j=0; $j < $z; $j++)
	{
		$rowField = $this->fields[$j];
		if ($rowField->typefield != 'button' && $rowField->typefield != 'fieldsep')
		{
			$prop="F".$rowField->id;
			if (isset($row->$prop) == false)
			{
				$prop=$rowField->name;
			}
			if (isset($row->$prop))
			{
				$texte = $row->$prop;
			} else {
				$texte = "&nbsp;";
			}
			if (strlen($texte) > 255) {
				$texte = substr($texte,0,255)."...";
			}
			
			$isEmail = false;
			if ($rowField->typefield == 'text') {
				$opt = explode("[--]", $rowField->defaultvalue);
				$key1 = explode("===", $opt[0]);
				$key2 = explode("===", $opt[1]);
				$key3 = explode("===", $opt[2]);
				$t_texttype = $key3[1];
				
				if ($t_texttype == 'email') {
					$isEmail = true;
				}
				
			}
			
			if ($isEmail == true) 
			{
				$linkfield = "mailto:".$texte;
			} 
			else 
			{
				$linkfield = $link;
			}
 ?>
	<td><?php echo "<a href=\"".$linkfield."\">".$texte."</a>"; ?></td> 
<?php	
		}
	}
 ?>

			<td>
				<?php echo $row->ipaddress; ?>
			</td>
			<td>
				<?php echo $row->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
    
    <tfoot>
    <tr>
      <td colspan="<?php echo (count($this->fields) + 4); ?>"><?php echo $this->pagination->getListFooter(); ?></td>
    </tr>
  </tfoot>

</table> 

    <input type="hidden" name="option" value="com_bwlabforms" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="ckdata" />
    <input type="hidden" name="fid" value="<?php echo JRequest::getVar( 'fid', -1 ) ?>" />
    <input type="hidden" name="sortf" value="<?php echo $this->sortf; ?>" />
    <input type="hidden" name="sortd" value="<?php echo $this->sortd; ?>" />

</form>

<div class="bwlabformbottom">
	CKForms V1.3.5, &copy; 2008-2009 Copyright by <a href="http://bwlabforms.cookex.eu" target="_blank" class="smallgrey">Cookex</a>, all rights reserved. 
    CKForms is Free Software released under the GNU/GPL License. 
</div>