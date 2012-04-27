<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm">
    <div class="width-20 fltrt">
        <fieldset class="adminform">
            <legend>Legenda</legend>
            <ul>
                <li><a href="<?php echo JRoute::_('index.php?' . BWLabFormHelper::getFieldUrl('text', $this->fid)); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXT'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?' . BWLabFormHelper::getFieldUrl('checkbox', $this->fid)); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_CHEKCBOX'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?' . BWLabFormHelper::getFieldUrl('radiobutton', $this->fid)); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_RADIOBUTTON'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?' . BWLabFormHelper::getFieldUrl('select', $this->fid)); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_SELECT'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?' . BWLabFormHelper::getFieldUrl('textarea', $this->fid)); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXTAREA'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=separator&controller=bwlabfields&fid=' . $this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_SEPARATOR'); ?></a></li>
            </ul>
        </fieldset>

    </div>
    <div class="width-80 fltrl">
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="3%">
                        <?php echo JText::_('Num'); ?>
                    </th>
                    <th width="3%">
                        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
                    </th>			
                    <th width="25%">
                        <?php echo JText::_('Label'); ?>
                    </th>
                    <th width="25%">
                        <?php echo JText::_('Name'); ?>
                    </th>
                    <th width="5%" nowrap="nowrap">
                        <?php echo JHTML::_('grid.sort', JText::_('Published'), 'published', @$lists['order_Dir'], @$lists['order']); ?>
                    </th>
                    <th width="20%" nowrap="nowrap">
                        <?php echo JHTML::_('grid.sort', JText::_('Order by'), 'c.ordering', @$lists['order_Dir'], @$lists['order']); ?>
                        <?php echo JHTML::_('grid.order', $this->items); ?>
                    </th>
                    <th width="10%" nowrap="nowrap">
                        <?php echo JText::_('Type'); ?>
                    </th>
                    <th width="3%">
                        <?php echo JText::_('ID'); ?>
                    </th>
                </tr>			
            </thead>
            <?php
            $n = count($this->items);
            foreach ($this->items as $i => $field):
                $published = JHTML::_('grid.published', $field, $i);
                $checked = JHTML::_('grid.id', $i, $field->id);
                $link = JRoute::_('index.php?' . BWLabFormHelper::getFieldUrl('text', $this->fid, 'edit')."&cid[]=" . $field->id);
                
                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td>
                        <?php echo $i + 1; ?>
                    </td>
                    <td>
                        <?php echo $checked; ?>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"><?php echo $field->label; ?></a>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"><?php echo $field->name; ?></a>
                    </td>
                    <td align="center">
                        <?php echo $published; ?>
                    </td>
                    <td class="order">
                        <?php $page = new JPagination($n, 1, $n); ?>
                        <span><?php echo $page->orderUpIcon($i, $i > 0, 'orderup', JText::_('Move Up'), true); ?></span>
                        <span><?php echo $page->orderDownIcon($i, $n, $i < $n, 'orderdown', JText::_('Move Down'), true); ?></span>					
                        <input type="text" name="order[]" size="5" value="<?php echo $field->ordering; ?>" class="text-area-order"/>
                    </td>
                    <td nowrap="nowrap">
                        <a href="<?php echo $link; ?>"><?php echo $field->type; ?></a>
                    </td>
                    <td>
                        <?php echo $field->id; ?>
                    </td>
                </tr>
                <?php $k = 1 - $k ?>
            <?php endforeach; ?>

            <tfoot>
                <tr>
                    <td colspan="8"><?php echo $this->pagination->getListFooter(); ?></td>
                </tr>
            </tfoot>

        </table>
    </div>
    <input type="hidden" name="option" value="com_bwlabforms" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="bwlabfields" />
    <input type="hidden" name="fid" value="<?php echo $this->fid ?>" />
</form>