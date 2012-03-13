<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm">
    <div class="width-20 fltrt">
        <fieldset class="adminform">
            <legend>Legenda</legend>
            <ul>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=text&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXT'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=text&texttypefield=date&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXT_DATE'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=text&texttypefield=email&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXT_EMAIL'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=text&texttypefield=number&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXT_NUMBER'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=text&texttypefield=password&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXT_PASSWORD'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=text&texttypefield=url&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXT_URL'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=checkbox&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_CHECKBOX'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=radiobutton&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_RADIOBUTTON'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=select&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_SELECT'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=button&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_BUTTON'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=textarea&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_TEXTAREA'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=hidden&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_HIDDEN'); ?></a></li>
                <li><a href="<?php echo JRoute::_('index.php?option=com_bwlabforms&task=add&fieldtype=separator&controller=bwlabfields&fid='.$this->fid); ?>"><?php echo JText::_('BWLABFORMS_ADD_NEW_FIELD_SEPARATOR'); ?></a></li>
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
                    <th width="40%">
                        <?php echo JText::_('Label'); ?>
                    </th>
                    <th width="20%">
                        <?php echo JText::_('Name'); ?>
                    </th>
                    <th width="5%" nowrap="nowrap">
                        <?php echo JHTML::_('grid.sort', JText::_('Published'), 'published', @$lists['order_Dir'], @$lists['order']); ?>
                    </th>
                    <th width="10%" nowrap="nowrap">
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
            $k = 0;
            $n = count($this->items);
            for ($i = 0; $i < $n; $i++) {
                $row = &$this->items[$i];
                $published = JHTML::_('grid.published', $row, $i);
                $checked = JHTML::_('grid.id', $i, $row->id);
                $link = JRoute::_('index.php?option=com_bwlabforms&controller=bwlabfields&task=edit&cid[]=' . $row->id . '&fid=' . JRequest::getVar('fid', -1));
                ?>
                <tr class="<?php echo "row$k"; ?>">
                    <td>
                        <?php echo $i + 1; ?>
                    </td>
                    <td>
                        <?php echo $checked; ?>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"><?php echo $row->label; ?></a>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
                    </td>
                    <td align="center">
                        <?php echo $published; ?>
                    </td>
                    <td>
                        <?php
                        jimport('joomla.html.pagination');
                        $page = new JPagination($n, 1, $n);
                        ?>
                        <span><?php echo $page->orderUpIcon($i, $i > 0, 'orderup', JText::_('Move Up'), true); ?></span>
                        <span><?php echo $page->orderDownIcon($i, $n, $i < $n, 'orderdown', JText::_('Move Down'), true); ?></span>					
                        <input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
                    </td>
                    <td nowrap="nowrap">
                        <a href="<?php echo $link; ?>"><?php echo $row->typefield; ?>
                            <?php
                            if ($row->typefield == "text") {
                                $opt = explode("[--]", $row->defaultvalue);
                                $key = explode("===", $opt[2]);
                                echo " [" . $key[1] . "]";
                            }
                            ?>		
                        </a>
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
                    <td colspan="8"><?php echo $this->pagination->getListFooter(); ?></td>
                </tr>
            </tfoot>

        </table>
    </div>
    <input type="hidden" name="option" value="com_bwlabforms" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="bwlabfields" />
    <input type="hidden" name="fid" value="<?php echo JRequest::getVar('fid', -1) ?>" />
</form>