<?php
/**
 * Copyright by Tom.
 * Date: 8/19/14
 * Time: 9:15 PM
 */

/**
 * The purpose of this, if we decide to change our Mail Adapter, we only change this class
 */
class MailService
{
    public $subject=null;
    public $addTo=null;
    public $from=null;
    public $body=null;

    public function __construct(){
        $this->from = array(Yii::app()->params['noreplyEmail'] => Yii::app()->params['noreplyDisplayEmail']);
    }

    public function sendMail($boolToAdmin = false){
        $message = new YiiMailMessage;
        if (Yii::app()->params['sendEmailWithSMTP']) {
            Yii::app()->mail->transportType = 'smtp';
            $arrOptions = $boolToAdmin ? Yii::app()->params['adminSMTP'] : Yii::app()->params['userSMTP'];
            Yii::app()->mail->transportOptions = $arrOptions;
        };
        $message->setBody($this->body, 'text/html');
        $message->subject = $this->subject;
        $message->addTo($this->addTo);
        $message->setFrom($this->from);
        return Yii::app()->mail->send($message);
    }

    public function batchMail($boolToAdmin = false){
        $message = new YiiMailMessage;
        if (Yii::app()->params['sendEmailWithSMTP']) {
            Yii::app()->mail->transportType = 'smtp';
            $arrOptions = $boolToAdmin ? Yii::app()->params['adminSMTP'] : Yii::app()->params['userSMTP'];
            Yii::app()->mail->transportOptions = $arrOptions;
        };
        $message->setBody($this->body, 'text/html');
        $message->subject = $this->subject;
        $message->setTo((array)$this->addTo);
        $message->setFrom($this->from);
        return Yii::app()->mail->batchSend($message);
    }
}
