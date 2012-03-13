<?php // no direct access

	defined('_JEXEC') or die('Restricted access'); 
	
	if ($this->form->published != '1') return;

?>

<style type="text/css">
<!--
#maincolumn  {
	overflow:auto !important;
}
-->
</style>

<link type="text/css" href="<?php echo JURI::root(true); ?>/components/com_bwlabforms/css/bwlabforms.css" rel="stylesheet">

<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php	
    if (isset($this->form->fronttitle) == false || strcmp ($this->form->fronttitle, "") == 0)
	{
		echo $this->form->title; 
	} else {
		echo $this->form->fronttitle; 
	}
?>
</div>

<?php 
	if (isset($this->form->frontdescription) == false || strcmp($this->form->frontdescription, "") == 0) 
	{ 
		echo "<p>".$this->form->description."</p>";
	} else {
		echo "<p>".$this->form->frontdescription."</p>";
	}
?>

<form action="index.php" method="post" name="adminForm">

<table class="ckdatatable <?php if (isset($this->displayBorders) == false || strcmp($this->displayBorders,"1") == 0) {echo "ckdatatableborder";} ?>">

<?php if (isset($this->displayColumnHeader) == false || strcmp($this->displayColumnHeader,"1") == 0)
{
	$sortLink = JRoute::_( 'index.php?option=com_bwlabforms&controller=ckdata&view=bwlabformsdata&layout=data&id='.$this->id.'&cid[]='.$this->form->id.'&Itemid='.$this->itemid.'&limitstart='.$this->limit );

?>	

<thead>
    <tr>
<?php $k = 0;
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
?>
    <td class="sectiontableheader">
    	<?php 
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
        <a href="<?php echo $sortLinkURL; ?>">
		<?php 
			echo $rowField->label.$sortimg;
		?>
        </a>
    </td>
<?php	
		}
	}
 	
    if ($this->form->displayip == '1') 
    {
 ?>
		<td class="sectiontableheader">
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

		</td>
<?php
	} 
?>

	</tr>			
</thead>
<?php	} ?>

<?php
	
	$k = 0;
	$n=count( $this->items );
	for ($i=0; $i < $n; $i++)
	{	
	
		$row = &$this->items[$i];
		$link = JRoute::_( 'index.php?option=com_bwlabforms&controller=ckdata&view=bwlabformsdata&layout=detail&task=detail&fid='.$this->form->id.'&id='.$this->id.'&cid[]='.$row->id.'&Itemid='.$this->itemid.'&limitstart='.$this->limit );

?>
		<tr class="sectiontableentry1">
         
<?php
	$z=count( $this->fields );
	for ($j=0; $j < $z; $j++)
	{
		$rowField = $this->fields[$j];
		
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
			
			if ($rowField->typefield == 'fileupload' && isset($row->$prop))
			{
				$texte = basename($row->$prop);
			}
			
			$isEmail = false;
			if ($rowField->typefield == 'text') {				
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
 
	<td>
<?php 
	if (isset($row->$prop))
	{
		if (isset($this->form->displaydetail) == false || $this->form->displaydetail == true)
		{
			echo "<a href=\"".$linkfield."\">".$texte."</a>"; 
		} else {
			echo $texte; 
		}
	} else { 
		?> &nbsp;<?php 
	} ?>
	</td> 
    
<?php	
		}
	}

    if ($this->form->displayip == '1') 
    {
 ?>
			<td>
				<?php 
				
				if (isset($this->form->displaydetail) == false || $this->form->displaydetail == true)
				{
					echo "<a href=\"".$linkfield."\">".$row->ipaddress."</a>"; 
				} else {
					echo $row->ipaddress; 
				}
				
				?>
			</td>
<?php } ?>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>

</table> 

<div class="ckpagination"><?php echo $this->pagination->getPagesLinks(); ?><br /><?php echo $this->pagination->getPagesCounter(); ?></div>
    
    <input type="hidden" name="option" value="<?php echo JRequest::getCmd( 'option', '-1' ) ?>" />
    <input type="hidden" name="view" value="<?php echo JRequest::getCmd( 'view', '-1' ) ?>" />
    <input type="hidden" name="layout" value="<?php echo JRequest::getCmd( 'layout', '-1' ) ?>" />
    <input type="hidden" name="controller" value="<?php echo JRequest::getCmd( 'controller', '-1' ) ?>" />
    <input type="hidden" name="Itemid" value="<?php echo JRequest::getCmd( 'Itemid', '-1' ) ?>" />
    <input type="hidden" name="lang" value="<?php echo JRequest::getCmd( 'lang', '-1' ) ?>" />
    <input type="hidden" name="id" value="<?php echo JRequest::getCmd( 'id', '-1' ) ?>" />
    <input type="hidden" name="sortf" value="<?php echo $this->sortf; ?>" />
    <input type="hidden" name="sortd" value="<?php echo $this->sortd; ?>" />

</form>
