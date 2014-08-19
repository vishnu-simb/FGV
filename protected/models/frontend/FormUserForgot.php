<?php

/**
 * Author: tomdoan (doannhandng@gmail.com)
 * Date: 8/19/14
 * Time: 2:51 PM
 *
 * FormModel for handling forgot password in front-end
 */

class FormUserForgot extends SimbFormModel
{
    public $username, $user_id;


    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
        		
            // username required
            array('username', 'required'),
        	array('username', 'checkexists'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username' => Yii::t('app', 'Username'),
        		
        );
    }

    public function checkexists($attribute,$params) {
    	if(!$this->hasErrors())  // we only want to authenticate when no input errors
    	{
    		$user=Grower::model()->findByAttributes(array('username'=>$this->username,'enabled'=>'yes'));
    		if ($user)
    			$this->user_id=$user->id;
    		if($user===null){
    			$this->addError("username",Yii::t("app","The username does not exist in our system."));
    		}
    	}
    }
    
    
    /**
     * send resetpassword code and send email notice
     * @return bool
     * @throws CHttpException
     */
    public function sendPasswordCode(){
    	$model = $this->checkExistence();
    	if ($model){
    		$model->generateResetpasswordKey(); // generate resetpassword key
    		if (!$model->save(false)){
    			$email = Yii::app()->params['adminEmail'];
    			throw new CHttpException(404,Yii::t("app","Something went wrong please contact administrator @ {$email}"));
    		}
    
    		// Get basic info for sending email
    		$arrParams = array(
    				'{name}'=>$model->name ,
    				'{link}'=>Yii::app()->createAbsoluteUrl('/site/resetpassword',array('is_code'=>1)),
    				'{code}'=>$model->resetpassword_key,
    				'{signature}'=>Yii::app()->params['emailSignature'],
    		);
    		
    		$mail = new Message();
    		$mail->recipient_email = $model->email;
    		$mail->subject = Yii::t('app','Reset Password');
    		$mail->sender_name = Yii::t('app', 'FGV Forgot');
    		$mail->sender_email = Yii::app()->params['noreplyEmail'];
    		return $mail->sendResetPassCode($arrParams);
    	}
    	return false;
    
    }
    
    /**
     * check existence of email/username in our DB
     * @return CActiveRecord
     */
    private function checkExistence(){
    	$model=Grower::model()->findByAttributes(array('username'=>$this->username,'enabled'=>'yes'));
    	return $model;
    }

}
