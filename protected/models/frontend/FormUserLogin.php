<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/19/14
 * Time: 2:51 PM
 *
 * FormModel for handling login in backend
 */
class FormUserLogin extends SimbFormModel
{
    public $username;
    public $password;
    
    public $type;
    
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) { // we only want to authenticate when no input errors
            // we need to make sure that the admin panel is only accessible to admin
	            try{
		            $adminAccess = Users::model()->countByAttributes(
		                array(),
		                '(username = :username) AND is_deleted = 0',
		                array(':username' => $this->username)
		            );
		            if(!$adminAccess) {
		            	$growerAccess = Grower::model()->countByAttributes(
		            			array(),
		            			'(username = :username) AND is_deleted = 0',
		            			array(':username' => $this->username)
		            	);
		            	if(!$growerAccess){
							throw new Exception('The details you entered were incorrect. Please try again');
		            	}
		             }
	               }catch (Exception $e) {
	    			$this->addError('password', Yii::t('app', $e->getMessage()));
	    			return false;
	    		}
                // Use a backend UserIdentity that has been derived from CUserIdentity
                // File in Components
                $this->_identity = new SimbUserIdentityFrontend($this->username,$this->password);
                $this->_identity->authenticate();
                switch ($this->_identity->errorCode) {
                    case SimbUserIdentityFrontend::ERROR_NONE:
                        $expires = 60*60*24; // 1day
                        Yii::app()->user->login($this->_identity, $expires);
                        break;
                    default:
                        $this->addError('password', Yii::t('app', 'The details you entered were incorrect. Please try again'));
                }
            
        }

    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            // Use a backend UserIdentity that has been derived from CUserIdentity
            // File in Components
            $this->_identity = new SimbUserIdentityFrontend($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === SimbUserIdentityFrontend::ERROR_NONE) {
            $expires = 60*60*24; // 1day
            Yii::app()->user->login($this->_identity, $expires);
            return true;
        } else {
            return false;
        }
    }
}
