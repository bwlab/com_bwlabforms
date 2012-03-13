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
        <li><?php echo JText::_('<b>Form name</b><br/> The form name can only contain the following characters : <br/><b>abcdefghijklmnopqrstuvwxy<br/>ABCDEFGHIJKLMNOPQRSTUVWXYZ<br/>0123456789</b>'); ?></li>

        <li><?php echo JText::_('<b>Save result "YES"</b> save the data of your form in the Database and can be viewed and exported'); ?></li>
        <li><?php echo JText::_('<b>Text Result</b> is the text displayed after the form submission'); ?></li>
        <li><?php echo JText::_('<b>Redirect URL</b> is the URL displayed after the form submission'); ?></li>

        <li><?php echo JText::_('Separate emails with comma'); ?></li>
        <li><?php echo JText::_('<b>Email result</b> "Yes" send the data submited by email to the emails addresses with the subject.'); ?></li>
        <li><?php echo JText::_('<b>Email receipt</b> (only if a "E-Mail" field is present in the Form)'); ?></li>
    </ul>
</fieldset>