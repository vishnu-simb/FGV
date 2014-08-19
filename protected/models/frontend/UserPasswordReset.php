<?php

/**
 * UserRecoveryForm class.
 * UserRecoveryForm is the data structure for keeping
 * user password reset form data. It is used by the 'recovery' action of 'UserController'.
 */
class UserPasswordReset extends SimbFormModel {

    public $newPassword;
    public $code;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('newPassword', 'required'),
            array('newPassword', 'length', 'max'=>128, 'min' => 4),
            array('code', 'checkValidCode'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'newPassword'=>Yii::t("app","New Password"),
        );
    }

    public function checkValidCode($attribute,$params) {
        if(!$this->hasErrors())  // we only want to authenticate when no input errors
        {
            $user=Grower::model()->findByAttributes(array('resetpassword_key'=>$this->code),"resetpassword_key IS NOT NULL AND resetpassword_key != ''");
            if (!$user){
                $this->addError('code',Yii::t('app','Invalid Password Code. Please try again'));
            }
        }
    }

    /**
     * change password based on user input
     * @throws CHttpException
     */
    public function changePassword(){
        $user=Grower::model()->findByAttributes(array('resetpassword_key'=>$this->code),"resetpassword_key IS NOT NULL AND resetpassword_key != ''");
        $email = Yii::app()->params['adminEmail'];
        if ($user){
            $user->password = $user->hashPassword($this->newPassword);
            $user->resetpassword_key = null;
            if (!$user->save(false)){
                throw new CHttpException(404,Yii::t("app","Something went wrong please contact administrator @ {$email}"));
            }
            return true;
        }
        throw new CHttpException(404,Yii::t("app","Something went wrong please contact administrator @ {$email}"));
    }

}