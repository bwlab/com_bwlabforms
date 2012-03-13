<?php
/**
 * BWLabForms for BWLabForms Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * BWLabForms Model
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsModelBWLabForms extends JModel
{

	var $_data;
	
	/**
	 * Retrieves the form data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		
		$array = JRequest::getVar('id',  0, '', 'array');
		$id=(int)$array[0];
		if (is_numeric($id) == false) 
		{
			return null;
		}
		
		$query = ' SELECT * FROM #__bwlabforms where id='.$id ;
						
		$this->_db->setQuery( $query );
		$this->_data = $this->_db->loadObject();

		$query = ' SELECT * FROM #__bwlabfields where fid='.$id." and published=1 order by ordering asc" ;
		$fields = $this->_getList( $query );
		
		$n=count($fields );
		for ($i=0; $i < $n; $i++)
		{ 
			$opt = explode("[--]", $fields[$i]->defaultvalue);
			
			switch ($fields[$i]->typefield)
			{
				case 'text':
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						$fields[$i]->t_initvalueT = $key1[1];
					} else {
						$fields[$i]->t_initvalueT = '';
					}
					if (count($opt) > 1) {
						$key2 = explode("===", $opt[1]);
						$fields[$i]->t_maxchar = $key2[1];
					} else {
						$fields[$i]->t_maxchar = '';
					}
					if (count($opt) > 2) {
						$key3 = explode("===", $opt[2]);
						$fields[$i]->t_texttype = $key3[1];	
					} else {
						$fields[$i]->t_texttype = '';
					}
					if (count($opt) > 3) {
						$key4 = explode("===", $opt[3]);
						$fields[$i]->t_minchar = $key4[1];		
					} else {
						$fields[$i]->t_minchar = '';
					}
					if (count($opt) > 4) {
						$key5 = explode("===", $opt[4]);
						$fields[$i]->d_format = $key5[1];		
					} else {
						$fields[$i]->d_format = '';
					}
					if (count($opt) > 5) {
						$key6 = explode("===", $opt[5]);
						$fields[$i]->d_daydate = $key6[1];		
					} else {
						$fields[$i]->d_daydate = '';
					}
					
					if (strcmp($fields[$i]->t_initvalueT,'') == 0 && strcmp($fields[$i]->t_texttype,'date') == 0 &&  strcmp($fields[$i]->d_daydate,'1') == 0) 
					{
						$fields[$i]->t_initvalueT = date('d/m/Y');
					}
					
					if (strcmp($fields[$i]->fillwith,'inival') != 0) 
					{
						$user = & JFactory::getUser(); 
						if (strcmp($fields[$i]->t_texttype,'text') == 0 && strcmp($fields[$i]->fillwith,'usrname') == 0) 
						{
							$fields[$i]->t_initvalueT = $user->name;
						} 
						else if (strcmp($fields[$i]->t_texttype,'text') == 0 && strcmp($fields[$i]->fillwith,'usrusername') == 0) 
						{
							$fields[$i]->t_initvalueT = $user->username;
						}
						else if (strcmp($fields[$i]->t_texttype,'email') == 0 && strcmp($fields[$i]->fillwith,'usremail') == 0) 
						{
							$fields[$i]->t_initvalueT = $user->email;
						}
					}
					
				break;
	
				case 'hidden':
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						$fields[$i]->t_initvalueH = $key1[1];
					} else {
						$fields[$i]->t_initvalueH = '';
					}
					if (count($opt) > 1) {
						$key2 = explode("===", $opt[1]);
						$fields[$i]->t_filluid = $key2[1];
					} else {
						$fields[$i]->t_filluid = '';
					}
						
					break;
					
				case 'textarea':
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						$fields[$i]->t_initvalueTA = $key1[1];
					} else {
						$fields[$i]->t_initvalueTA = '';
					}
					if (count($opt) > 1) {
						$key2 = explode("===", $opt[1]);
						$fields[$i]->t_HTMLEditor = $key2[1];
					} else {
						$fields[$i]->t_HTMLEditor = '';
					}
					if (count($opt) > 2) {
						$key3 = explode("===", $opt[2]);
						$fields[$i]->t_columns = $key3[1];
					} else {
						$fields[$i]->t_columns = '';
					}
					if (count($opt) > 3) {
						$key4 = explode("===", $opt[3]);
						$fields[$i]->t_rows = $key4[1];
					} else {
						$fields[$i]->t_rows = '';
					}
					if (count($opt) > 4) {
						$key5 = explode("===", $opt[4]);
						$fields[$i]->t_wrap = $key5[1];					
					} else {
						$fields[$i]->t_wrap = '';
					}
					if (count($opt) > 5) {
						$key6 = explode("===", $opt[5]);
						$fields[$i]->t_maxchar = $key6[1];
					} else {
						$fields[$i]->t_maxchar = '';
					}
					if (count($opt) > 6) {
						$key7 = explode("===", $opt[6]);
						$fields[$i]->t_minchar = $key7[1];							
					} else {
						$fields[$i]->t_minchar = '';
					}

					break;
	
				case 'checkbox':
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						$fields[$i]->t_initvalueCB = $key1[1];
					} else {
						$fields[$i]->t_initvalueCB = '';
					}
					if (count($opt) > 0) {
						$key2 = explode("===", $opt[1]);
						$fields[$i]->t_checkedCB = $key2[1];										
					} else {
						$fields[$i]->t_checkedCB = '';
					}
					break;
					
				case 'radiobutton':
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						$fields[$i]->t_listHRB = $key1[1];
					} else {
						$fields[$i]->t_listHRB = '';
					}
					if (count($opt) > 1) {
						$key2 = explode("===", $opt[1]);
						$fields[$i]->t_displayRB = $key2[1];
					} else {
						$fields[$i]->t_displayRB = '';
					}
					break;

				case 'select':
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						$fields[$i]->t_multipleS = $key1[1];
					} else {
						$fields[$i]->t_multipleS = '';
					}
					if (count($opt) > 1) {
						$key2 = explode("===", $opt[1]);
						$fields[$i]->t_heightS = $key2[1];
					} else {
						$fields[$i]->t_heightS = '';
					}
					if (count($opt) > 2) {
						$key3 = explode("===", $opt[2]);
						$fields[$i]->t_listHS = $key3[1];					
					} else {
						$fields[$i]->t_listHS = '';
					}
					break;

				case 'button':
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						$fields[$i]->t_typeBT = $key1[1];
					} else {
						$fields[$i]->t_typeBT = '';
					}
					break;
	
				case 'fieldsep':
					$fields[$i]->t_noborderFS = '0';
					if (count($opt) > 0) {
						$key1 = explode("===", $opt[0]);
						if (count($key1) > 1)
						{
							$fields[$i]->t_noborderFS = $key1[1];
						}
					}
					break;
			}
		
		}				

		$this->_data->fields = $fields;
		
		return $this->_data;
	}
	
	/**
	 * Save Hits
	 * @return void
	 */
	function addHits()
	{
		$dba	=& JFactory::getDBO();
		
		$bwlabform = $this->getData();
		
		$query = " update #__bwlabforms set hits = ".($bwlabform->hits + 1). " where id = ".$bwlabform->id;
                $dba->setQuery($query);

		$dba->query();		
	}
	
	/**
	 * Save data
	 * @return void
	 */
	function saveData($post)
	{		
		$bwlabform = $this->getData();
		
		$fileuid = uniqid('');
		
		if (file_exists ($bwlabform->uploadpath) == true)
		{
			$nb_uploaded_file = 0;
			$n=count($bwlabform->fields );
			for ($i=0; $i < $n; $i++)
			{	
				$field = $bwlabform->fields[$i];
				if ($field->typefield == 'fileupload' && isset($_FILES[$field->name]['name']) && $_FILES[$field->name]['name'] !='' )
				{
					
					$PathInf = pathinfo($_FILES[$field->name]['name']);
					$ext = $PathInf['extension'];
					$file = basename($_FILES[$field->name]['name'],".".$ext) . "_" . $fileuid . "." . $ext; 

					$target_fu_path = $bwlabform->uploadpath . $file; 
					
					if(move_uploaded_file($_FILES[$field->name]['tmp_name'], $target_fu_path)) {
						$uploaded_file[$nb_uploaded_file] = $target_fu_path;
						$nb_uploaded_file++;						
					}				
				}				
			}
		}
		
		if ($bwlabform->saveresult == 1) 
		{			

			$dba	=& JFactory::getDBO();
			
			$query = ' insert into #__bwlabforms_'.$bwlabform->id."(" ;
		  	$query2 = ' insert into #__bwlabforms_'.$bwlabform->id."(" ;
			
			$n=count($bwlabform->fields );
			for ($i=0; $i < $n; $i++)
			{	
				$field = $bwlabform->fields[$i];
				if ($field->typefield != 'button' && $field->typefield != 'fieldsep')
				{
					$query = $query."F".$field->id.",";
					$query2 = $query2.$field->name.",";
				}
			}

			$query = $query."created,ipaddress,published,articleid) values(";
			$query2 = $query2."created,ipaddress,published,articleid) values(";
     
			$n=count($bwlabform->fields );
			for ($i=0; $i < $n; $i++)
			{	
				$field = $bwlabform->fields[$i];
				if ($field->typefield != 'button' && $field->typefield != 'fieldsep')
				{				
					if ($field->typefield == 'fileupload' && isset($_FILES[$field->name]['name']) && $_FILES[$field->name]['name'] !='' )
					{
						$PathInf = pathinfo($_FILES[$field->name]['name']);
						$ext = $PathInf['extension'];
						$file = basename($_FILES[$field->name]['name'],".".$ext) . "_" . $fileuid . "." . $ext; 
						
						$fieldValue = $bwlabform->uploadpath . $file;
					} else if (Isset($post[$field->name])){
						$fieldValue = $post[$field->name];
					} else {
						$fieldValue = '';
					}
					
					if (is_array ($fieldValue))	
					{
						$arrayVal = "";
						foreach($fieldValue as $selectValue){					
							$arrayVal = $arrayVal.$selectValue.",";
						}
						if (strcasecmp(substr($arrayVal, strlen($arrayVal) - strlen(",")),",") == 0)
						{
							$arrayVal = substr($arrayVal, 0,strlen($arrayVal) - strlen(","));
						}
						$fieldValue = $arrayVal;
					}
					
					$query = $query."'".addslashes($fieldValue)."',";
					$query2 = $query2."'".addslashes($fieldValue)."',";
				}
			}
			
			$autopublish = "0";
			if($bwlabform->autopublish == 1) 
			{
				$autopublish = "1";
			}
			   
			$query = $query."'".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."',".$autopublish.",";
			$query2 = $query2."'".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."',".$autopublish.",";

			$articleid = JRequest::getCmd('articleid');
			if (isset($articleid))
			{
				$query = $query."'".JRequest::getCmd('articleid')."'";
				$query2 = $query2."'".JRequest::getCmd('articleid')."'";
			} else {
				$query = $query."null";
				$query2 = $query2."null";
			}
			
			$query = $query.")";
			$query2 = $query2.")";
			$dba->setQuery($query);
			if (!$dba->query()) 
			{
				$errMsg = JText::_( 'Problem with' )." (".$query.")"."<br />". $dba->getErrorMsg();
							
				if (!$dba->Execute($query2)) 
				{					
					echo JText::_( 'Problem with' )." (".$query2.")";
					echo $dba->getErrorMsg();
					echo $errMsg;
				}

			}
						
		}		
		
		/* ************************* */
		/*     Send Email Result     */
		/* ************************* */
		if ($bwlabform->emailresult == 1) {
	
			$mail =& JFactory::getMailer();
			$mail->CharSet = "utf-8";
		
			$mailBody = "Form : ".$bwlabform->title." [".$bwlabform->name."]<br />\n";
			$mailBody = $mailBody."registered at ".date("Y-m-d H:i:s")."<br /><br />\n\n";

			$n=count($bwlabform->fields );
			for ($i=0; $i < $n; $i++)
			{	
				$field = $bwlabform->fields[$i];
				if ($field->typefield != 'button' && $field->typefield != 'fieldsep')
				{
					if (Isset($post[$field->name]))
					{
						$fieldValue = $post[$field->name];
					} else 
					{
						$fieldValue = '';
					}
					
					if (is_array ($fieldValue))	
					{
						$arrayVal = "";
						foreach($fieldValue as $selectValue){					
							$arrayVal = $arrayVal.$selectValue.",";
						}
						if (strcasecmp(substr($arrayVal, strlen($arrayVal) - strlen(",")),",") == 0)
						{
							$arrayVal = substr($arrayVal, 0,strlen($arrayVal) - strlen(","));
						}
						$fieldValue = $arrayVal;
					}
									
					$isEmail = false;
					if ($field->typefield == 'text') {
						$opt = explode("[--]", $field->defaultvalue);
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
						$fieldValue = '<a href="mailto:'.$fieldValue.'">'.$fieldValue.'</a>';
					} 
				
					$mailBody = $mailBody.$field->label . " : " . $fieldValue . "<br />\n";
				}
			}
			
			$mailBody = $mailBody.JText::_( 'IP Address' ) . " : " . $_SERVER['REMOTE_ADDR'] . "<br />\n";
			
			$articleid = JRequest::getCmd('articleid');
			if (isset($articleid))
			{
				$mailBody = $mailBody.JText::_( 'Article ID' ) . " : " . $articleid . "<br />\n";
			}
			
			if (strcmp($bwlabform->emailto,"") != 0)
			{
				$mail->addRecipient( explode(",", $bwlabform->emailto) );
			}
			if (strcmp($bwlabform->emailcc,"") != 0)
			{
				$mail->addCC( explode(",", $bwlabform->emailcc) );
			}
			if (strcmp($bwlabform->emailbcc,"") != 0)
			{
				$mail->addBCC( explode(",", $bwlabform->emailbcc) );
			}
			
			$mail->setSender( array( $bwlabform->emailfrom, "" ) );
			$mail->setSubject( $bwlabform->subject );
			$mail->setBody( $mailBody );

			$mail->IsHTML (true);
			
			if (Isset($nb_uploaded_file) && $bwlabform->emailresultincfile == "1")
			{
			for ($i=0; $i < $nb_uploaded_file; $i++) {
				$mail->addAttachment($uploaded_file[$i]);
			}
			}
			
			$sent = $mail->Send();
			
		}		
		
		/* ************************** */
		/*     Send Email Receipt     */
		/* ************************** */
		if ($bwlabform->emailreceipt == 1) {
		
			$IsSendMail = false;
			$emailReceiptTo = '';
			
			$mail =& JFactory::getMailer();
			$mail->CharSet = "utf-8";
		
			$mailBody = $bwlabform->emailreceipttext;
			
			$mailBody = $mailBody."<br/><br/>Form : ".$bwlabform->title."<br />\n";
			$mailBody = $mailBody.JText::_( 'registered at' )." ".date("Y-m-d H:i:s")."<br /><br />\n\n";

			$n=count($bwlabform->fields );
			for ($i=0; $i < $n; $i++)
			{	
				$field = $bwlabform->fields[$i];
				
				if ($field->typefield == 'text')
				{
					$opt = explode("[--]", $field->defaultvalue);
					if (count($opt) > 2) {
						$key3 = explode("===", $opt[2]);
						if ($key3[1] == 'email') {
							$IsSendMail = true;
							$emailReceiptTo = $post[$field->name];
						}
					}						
				}
			}
			
			if ($bwlabform->emailreceiptincfield == 1) {				
				for ($i=0; $i < $n; $i++)
				{	
					$field = $bwlabform->fields[$i];
					if ($field->typefield != 'button' && $field->typefield != 'fieldsep')
					{
							
						if (Isset($post[$field->name]))
						{
							$fieldValue = $post[$field->name];
						} else 
						{
							$fieldValue = '';
						}
						
						if (is_array ($fieldValue))	
						{
							$arrayVal = "";
							foreach($fieldValue as $selectValue){					
								$arrayVal = $arrayVal.$selectValue.",";
							}
							if (strcasecmp(substr($arrayVal, strlen($arrayVal) - strlen(",")),",") == 0)
							{
								$arrayVal = substr($arrayVal, 0,strlen($arrayVal) - strlen(","));
							}
							$fieldValue = $arrayVal;
						}
						
						$mailBody = $mailBody.$field->label . " : " . $fieldValue . "<br />\n";
					}
					
				}	
				
				$mailBody = $mailBody.JText::_( 'IP Address' ) . " : " . $_SERVER['REMOTE_ADDR'] . "<br />\n";
				
				if (Isset($nb_uploaded_file) && $bwlabform->emailreceiptincfile == "1")
				{
					for ($i=0; $i < $nb_uploaded_file; $i++) {
						$mail->addAttachment($uploaded_file[$i]);
					}
				}
			}
			
			if (strcmp($emailReceiptTo,"") != 0 && $IsSendMail == true)
			{
				$mail->addRecipient($emailReceiptTo);
						
				$mail->setSender( array( $bwlabform->emailfrom, "" ) );
				$mail->setSubject( $bwlabform->emailreceiptsubject );
				$mail->setBody( $mailBody );
		
				$mail->IsHTML (true);
			
				$sent = $mail->Send();
				

			}

		}	
		
	}

}
