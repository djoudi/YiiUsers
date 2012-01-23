<?php
/**
 * AUserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AUserIdentity extends CUserIdentity {
	const ERROR_ACCOUNT_INACTIVE=3;
	/**
	 * Holds the id of the logged in user
	 * @var integer
	 */
	protected $_id;
	/**
	 * Holds the name of the logged in user
	 * @var string
	 */
	protected $_name;

	/**
	 * Constructor.
	 * @param string $email the user's email address
	 * @param string $password the user's password
	 */
	public function __construct($email = null,$password = null) {
		$this->username=$email;
		$this->password=$password;
	}
	/**
	 * Authenticates a user.
	 *
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		$modelClass = Yii::app()->getModule("users")->userModelClass;
		$user = $modelClass::model()->findByAttributes(array("email" => $this->username));

		if(!is_object($user)) {
			Yii::log("Invalid login attempt from ".$_SERVER['REMOTE_ADDR']." (no such user)","invalidLogin","user.activity");
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		elseif(!$user->verifyPassword($this->password)) {
			Yii::log("[$user->id] Invalid login attempt from ".$_SERVER['REMOTE_ADDR']." (incorrect password)","invalidLogin","user.activity");
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		elseif($user->is(AUser::STATE_DEACTIVATED) || (Yii::app()->getModule("users")->requireActivation && !$user->is(AUser::STATE_ACTIVE))) {
			Yii::log("[$user->id] Invalid login attempt from ".$_SERVER['REMOTE_ADDR']." (account inactive)","invalidLogin","user.activity");
			$this->errorCode=self::ERROR_ACCOUNT_INACTIVE;
		}
		else {
			Yii::log("[".$user->id."] Logged in from ".$_SERVER['REMOTE_ADDR'],"login","user.activity");
			$this->loginUser($user);
		}
		return !$this->errorCode;
	}

	/**
	 * Logs the given user into the site without requiring authentication
	 * @param AUser $user the user to log in
	 */
	public function loginUser(AUser $user) {
		$this->errorCode = self::ERROR_NONE;
		$this->errorCode=self::ERROR_NONE;
		$this->setId($user->id);
		$this->setName($user->name);
	}

	/**
	 * Gets the ID of the current logged in user
	 * @return integer The user's ID
	 */
	public function getId() {
		return $this->_id;
	}
	/**
	 * Sets the ID of the current logged in user
	 * @param integer $id The user's ID
	 * @return integer The user's ID
	 */
	public function setId($id) {
		return $this->_id = $id;
	}

	/**
	 * Gets the name of the current logged in user
	 * @return string The user's name
	 */
	public function getName() {
		return $this->_name;
	}
	/**
	 * Sets the name of the current logged in user
	 * @param string $name The user's name
	 * @return string The user's name
	 */
	public function setName($name) {
		return $this->_name = $name;
	}
}