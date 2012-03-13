<?php
/**
 * Ck forms default controller
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */

jimport('joomla.application.component.controller');

/**
 * Ck forms Component Controller
 *
 * @package	CkForms
 */
class BWLabFormsController extends JController
{
	/**
	 * Method to display the captcha to validate the form
	 *
	 * @access	public
	 */
	function captcha()
	{
		include("components/com_bwlabforms/captcha/securimage.php");
				
		$document = &JFactory::getDocument();
		$doc = &JDocument::getInstance('raw');
		$document = $doc;
		$img = new Securimage();
		$img->ttf_file = "components/com_bwlabforms/captcha/elephant.ttf";
		$img->show();
	}

	function  display()
	{
		$model = $this->getModel('bwlabforms');
		$model->addHits();
		
		$_SESSION['bwlab_send_once'.JRequest::getCmd('id')] = "1";
		$_SESSION['bwlab_cache_page_'.JRequest::getCmd('id')] = md5(JRequest::getURI());
		
		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * and send emails
	 * @return void
	 */
	function send()
	{		
		$model = $this->getModel('bwlabforms');
		$bwlabform = $model->getData();		

		if ($bwlabform->captcha == 1)
		{
			include("components/com_bwlabforms/captcha/securimage.php");
			
			$img = new Securimage();
			
			$valid = $img->check($_POST['bwlab_captcha_code']);			
			
			if($valid == false) {
				JError::raiseWarning( 0, JText::_( "Sorry, the code you entered was invalid" ));
				
				$this->display();
				return false;
			}
		}
		if (isset($_SESSION['bwlab_send_once'.$bwlabform->id]))
		{
			session_unregister('bwlab_send_once'.$bwlabform->id);			
		} else {
			JError::raiseWarning( 0, JText::_( "Sorry, you can send the form only once" ));
			return false;		
		}

		session_unregister('securimage_code_value');

		$post = JRequest::get('post', JREQUEST_ALLOWHTML);	
		
		$model->saveData($post);				

		if (isset($_SESSION['bwlab_cache_page_'.$bwlabform->id]))
		{
			$cacheid = $_SESSION['bwlab_cache_page_'.$bwlabform->id];
			$cache = &JFactory::getCache();
			$cacheresult = $cache->remove($cacheid, 'page'); 
		}
		
		$msg = JText::sprintf('Form successfully sent', 1);
		
		if ( isset($bwlabform->redirecturl) && $bwlabform->redirecturl != "") {
			
			$params = '';
			
			if ($bwlabform->redirectdata == 1)
			{
				foreach ($post as $key => $value) {
					$params = $params . '&'. $key.'='.htmlentities($value);
				}
				if (strlen($params) > 0 && strpos($bwlabform->redirecturl, '?') === false)
				{
					$params = '?'.substr($params, 1); 
				}
			}
			$this->setRedirect($bwlabform->redirecturl.$params);
			
			
		} else if ((isset($bwlabform->redirecturl) == false || $bwlabform->redirecturl == "")
			&& ((isset($bwlabform->textresult) == false || $bwlabform->textresult == ""))) {
			$this->setRedirect(JURI::base(), $msg);
		}
		
		JRequest::setVar( 'view', 'bwlabforms' );
		JRequest::setVar( 'layout', 'message'  );
		
		parent::display();

	}
}
?>
