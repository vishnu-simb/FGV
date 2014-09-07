<?php

/**
 * Author: tomdoan (doannhandng@gmail.com)
 * Date: 8/19/14
 * Time: 2:51 PM
 */
Yii::import('application.models.service.MailService');
Yii::import('application.models.service.EmailTemplate');

class Message extends SimbFormModel
{
    public $recipient_email, $subject, $message, $sender_name, $sender_email , $attachment;

    /**
     * Send email using info from it's properties
     */
    public function sendEmail()
    {
    	$boolSuccess = false;
    	try {
    		$mail = new MailService();
    		$mail->from = array($this->sender_email => $this->sender_name);
    		$mail->addTo = $this->recipient_email;
    		$mail->attachment = $this->attachment;
    		$mail->subject = $this->subject;
    		$mail->body = $this->message;
    		$useToAdminSmtp = false;
    		if ($mail->sendMail($useToAdminSmtp)) {
    			$boolSuccess = true;
    		}
    	} catch (CException $e) {
    		$boolSuccess = false;
    	}
    	return $boolSuccess;
    }
    
    /**
     * Send reset password email to user
     * @param $params
     * @return boolean, email is sent successfully or not
     */
    
    public function sendResetPassCode($params)
    {
    	$template = new EmailTemplate();
    	$this->message = $template->resetPassCode($params);
    	// Send message via email
    	$boolSuccess = $this->sendEmail();
    	return $boolSuccess;
    }
    
    /**
     * Send Grower Report email to user
     * @param $params
     * @return boolean, email is sent successfully or not
     */
    
    public function sendGrowerReport($params)
    {
    	$template = new EmailTemplate();
    	$this->message = $template->growerReport($params);
    	// Send message via email
    	$boolSuccess = $this->sendEmail();
    	return $boolSuccess;
    }
    

}
