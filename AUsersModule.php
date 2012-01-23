<?php
Yii::import("packages.users.behaviors.*");
Yii::import("packages.users.components.*");
Yii::import("packages.users.models.*");
/**
 * Deals with registration and management of users.
 * To use this module, configure it as shown below in your application config:
 * <pre>
 * "modules" => array(
 * 	"users" => array(
 * 		"class" => "packages.users.AUsersModule",
 * 		"userModelClass" => "User", // the name of your custom user class
 * 	),
 * )
 * </pre>
 * @author Charles Pick
 * @package packages.users
 */
class AUsersModule extends CWebModule {
	/**
	 * The name of the user model.
	 * This should extend the AUser class.
	 * Defaults to "AUser".
	 * @var string
	 */
	public $userModelClass = "User";

	/**
	 * The name of the user group model.
	 * This should extend the AUserGroup class
	 * Defaults to "AUserGroup"
	 * @var string
	 */
	public $userGroupModelClass = "AUserGroup";

	/**
	 * The name of the user group member model.
	 * This should extend the AUserGroupMember class
	 * Defaults to "AUserGroupMember"
	 * @var string
	 */
	public $userGroupMemberModelClass = "AUserGroupMember";

	/**
	 * Whether to delete user groups when all member leave.
	 * Defaults to false
	 * @var boolean
	 */
	public $deleteEmptyUserGroups = false;

	/**
	 * The route or URL to redirect to after a user registers.
	 * Defaults to the user's account page.
	 * @var string|array
	 */
	public $redirectAfterRegistration = array("/users/user/account");

	/**
	 * Whether to allow users to upload their own profile images.
	 * If this is true, profile images will be shown when displaying user details
	 * @var boolean
	 */
	public $enableProfileImages = true;


	/**
	 * Whether to send an activation to the user with a link to activate their account not not.
	 * Defaults to false meaning no account activation is required.
	 * @var boolean
	 */
	public $requireActivation = false;

	/**
	 * The name of the user identity class to use when logging in users.
	 * Defaults to AUserIdentity
	 * @var string
	 */
	public $identityClass = "AUserIdentity";

	/**
	 * The name of the login form class.
	 * Defaults to ALoginForm.
	 * @var string
	 */
	public $loginFormClass = "ALoginForm";

	/**
	 * How long in seconds we should remember a user's login info for
	 * Defaults to 2592000 (30 days).
	 * @var integer
	 */
	public $autoLoginDuration = 2592000;

	/**
	 * Whether to log the user in by default or not.
	 * Defaults to false.
	 * @see $loginDuration
	 * @var boolean
	 */
	public $autoLoginByDefault = false;

	/**
	 * The default controller for this module
	 * @var string
	 */
	public $defaultController = "user";


}
