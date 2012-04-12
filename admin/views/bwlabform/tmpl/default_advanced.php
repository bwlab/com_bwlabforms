<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_config
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;
?>
<fieldset class="adminform">
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_TEXT'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title"><?php echo JText::_('Use Captcha'); ?> :</label>
            <fieldset class="radio">
                <?php
                echo JHTML::_('select.booleanlist', 'captcha', '', $this->bwlabforms->captcha);
                ?>
            </fieldset>
        </li>
        <li>   
            <label for="title">
                <?php echo JText::_('Captcha tips text'); ?>:
            </label>
            <input class="text_area" type="text" name="captchacustominfo" id="captchacustominfo" maxlength="255" value="<?php echo $this->bwlabforms->captchacustominfo; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Captcha custom error text'); ?>:
            </label>
            <input class="text_area" type="text" name="captchacustomerror" id="captchacustomerror" maxlength="255" value="<?php echo $this->bwlabforms->captchacustomerror; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('CSS class'); ?>:
            </label>
            <input class="text_area" type="text" name="formCSSclass" id="formCSSclass" maxlength="50" value="<?php echo $this->bwlabforms->formCSSclass; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Uploaded files path'); ?>:
            </label>
            <input class="text_area" type="text" name="uploadpath" id="uploadpath" maxlength="255" value="<?php echo $this->bwlabforms->uploadpath; ?>" /><br/>
            <?php
            if ($this->bwlabforms->uploadpath != null && trim($this->bwlabforms->uploadpath) != "") {
                if (file_exists($this->bwlabforms->uploadpath)) {
                    echo "<span class=\"txtgreen\">(" . JText::_('Directory exists') . "</span> - ";

                    if (is_writable($this->bwlabforms->uploadpath)) {
                        echo "<span class=\"txtgreen\">" . JText::_('directory writables') . ")</span>";
                    } else {
                        echo "<span class=\"txtred\">" . JText::_('ERROR : directory read only') . " !" . ")</span>";
                    }
                } else {
                    echo "<span class=\"txtred\">(" . JText::_('ERROR : directory doesnt exist') . " !" . ")</span>";
                }
            }
            ?>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('File uploaded maximum size'); ?>:
            </label>
            <input class="text_area" type="text" name="maxfilesize" id="maxfilesize" size="32" maxlength="32" value="<?php echo $this->bwlabforms->maxfilesize; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Display "powered by" text'); ?>:
            </label>
            <fieldset class="radio">
                <?php
                echo JHTML::_('select.booleanlist', 'poweredby', '', $this->bwlabforms->poweredby);
                ?>
            </fieldset>
        </li>
    </ul>
</fieldset>