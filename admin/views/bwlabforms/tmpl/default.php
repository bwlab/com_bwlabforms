<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
            <th width="3%">
                <?php echo JText::_( 'Num' ); ?>
            </th>
			<th width="3%">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th width="40%">
				<?php echo JText::_( 'Title' ); ?>
			</th>
			<th width="20%">
				<?php echo JText::_( 'Name' ); ?>
			</th>
            <th width="5%" nowrap="nowrap">
                <?php echo JHTML::_('grid.sort', JText::_( 'Published' ), 'published', @$lists['order_Dir'], @$lists['order'] ); ?>
            </th>
			<th width="5%" nowrap="nowrap">
				<?php echo JText::_( 'Fields' ); ?>
			</th>
			<th width="5%" nowrap="nowrap">
				<?php echo JText::_( 'Author' ); ?>
			</th>
			<th width="10%" nowrap="nowrap">
				<?php echo JText::_( 'Date' ); ?>
			</th>
			<th width="15%" nowrap="nowrap">
				<?php echo JText::_( 'Data' ); ?>
			</th>
			<th width="15%" nowrap="nowrap">
				<?php echo JText::_( 'Hits' ); ?>
			</th>
			<th width="3%">
				<?php echo JText::_( 'ID' ); ?>
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
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_bwlabforms&controller=bwlabforms&task=edit&cid[]='. $row->id );
		$fields		= JRoute::_( 'index.php?option=com_bwlabforms&controller=bwlabfields&fid='. $row->id );
		$savedData 	= JRoute::_( 'index.php?option=com_bwlabforms&controller=ckdata&fid='. $row->id );

		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $i+1; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->title; ?></a>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
			</td>
            <td align="center">
                <?php echo $published;?>
            </td>
            <td nowrap="nowrap">
            	<a href="<?php echo $fields; ?>"><img src="<?php echo JURI::root(); ?>includes/js/ThemeOffice/mainmenu.png" border="0" /></a>
                &nbsp;
				<a href="<?php echo $fields; ?>"><?php echo $row->nbfields; ?></a>
            </td>
			<td>
				<?php echo $row->username; ?>
			</td>
			<td nowrap="nowrap">
				<?php echo $row->created; ?>
			</td>
			<td nowrap="nowrap">
            <?php 
				if ($row->saveresult == '1')
				{
			?>
				<a href="<?php echo $savedData; ?>"><?php echo JText::_( 'Display data' ); ?></a>
            <?php 
				} else {
			?>
            	&nbsp;
            <?php 
				}
			?>
			</td>			
           	<td>
				<?php echo $row->hits; ?>
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
      <td colspan="11"><?php echo $this->pagination->getListFooter(); ?></td>
    </tr>
  	</tfoot>
    
	</table>
</div>

<input type="hidden" name="option" value="com_bwlabforms" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="bwlabforms" />
</form>

<div class="bwlabformbottom">
	CKForms V1.3.5, &copy; 2008-2009 Copyright by <a href="http://bwlabforms.cookex.eu" target="_blank" class="smallgrey">Cookex</a>, all rights reserved. 
    CKForms is Free Software released under the GNU/GPL License. 
</div>