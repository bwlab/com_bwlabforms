<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<table class="contentpaneopen">
<tr>
	<td class="contentheading" width="100%">
		<?php echo $this->bwlabforms->title; ?>
	</td>
</tr>
</table>

<?php if (strcmp ( $this->bwlabforms->textresult , "" ) != 0) { ?>
<table class="contentpaneopen">
<tr>
<td valign="top">
	<?php echo $this->bwlabforms->textresult; ?>
</td>
</tr>
</table>
<?php } ?>
