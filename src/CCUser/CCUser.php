<?php
/**
 * A user controller  to manage login and view edit the user profile.
 * 
 * @package LydiaCore
 */
class CCUser extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }


  /**
   * Show profile information of the user.
   */
  public function Index() {
    $this->views->SetTitle('User Controller');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'is_authenticated'=>$this->user['isAuthenticated'], 
                  'user'=>$this->user,
                ));
  }
  

  /**
   * View and edit user profile.
   */
  public function Profile() {    
    $form = new CFormUserProfile($this, $this->user);
    $form->Check();

    $this->views->SetTitle('User Profile');
    $this->views->AddInclude(__DIR__ . '/profile.tpl.php', array(
                  'is_authenticated'=>$this->user['isAuthenticated'], 
                  'user'=>$this->user,
                  'profile_form'=>$form->GetHTML(),
                ));
  }
  

  /**
   * Change the password.
   */
  public function DoChangePassword($form = null) {
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
      $this->session->AddMessage('error', 'Password does not match or is empty.');
    } else {
      $ret = $this->user->ChangePassword($form['password']['value']);
      $this->AddMessage($ret, 'Saved new password.', 'Failed updating password.');
    }
    $this->RedirectToController('profile');
  }
  

  /**
   * Save updates to profile information.
   */
  public function DoProfileSave($form = null) {
    $this->user['name'] = $form['name']['value'];
    $this->user['email'] = $form['email']['value'];
    $ret = $this->user->Save();
    $this->session->AddMessage($ret, 'Saved profile.', 'Failed saving profile.');
    $this->RedirectToController('profile');
  }
  


  /**
   * Authenticate and login a user.
   */
  public function Login() {
    $form = new CFormUserLogin($this);
    if($form->Check() === false) {
      $this->session->AddMessage('notice', 'You must fill in acronym and password.');
      $this->RedirectToController('login');
    }
    $this->views->SetTitle('Login');
    $this->views->AddInclude(__DIR__ . '/login.tpl.php', array(
                  'login_form' => $form,
                  'allow_create_user' => CLydia::Instance()->config['create_new_users'],
                  'create_user_url' => $this->request->CreateUrl(null, 'create'),
                ));
  }
  /**
   * Perform a login of the user as callback on a submitted form.
   */
  public function DoLogin($form = null) {
  	 
    if($this->user->Login($form['acronym']['value'], $form['password']['value'])) {
      $this->session->AddMessage('success', "Welcome {$this->user['name']}.");
      $this->RedirectToController('profile');
    } else {
      $this->session->AddMessage('notice', "Failed to login, user does not exist or password does not match.");
      $this->RedirectToController('login');      
    }
    	 
  }
  
    /**
   * Create a new user.
   */
  public function Create() {
    $form = new CFormUserCreate($this);
    if($form->Check() === false) {
      $this->session->AddMessage('notice', 'You must fill in all values.');
      $this->RedirectToController('Create');
    }
    $this->views->SetTitle('Create user');
    $this->views->AddInclude(__DIR__ . '/create.tpl.php', array('form' => $form->GetHTML(),'usercheck' => $this->session->GetAuthenticatedUser()));     
  }
  
   
    /**
   * Perform a creation of a user as callback on a submitted form.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoCreate($form) {   
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
      $this->session->AddMessage('error', 'Password does not match or is empty.');
      $this->RedirectToController('create');
    } else if($this->user->Create($form['acronym']['value'], 
                           $form['password']['value'],
                           $form['name']['value'],
                           $form['email']['value'],
                           $form['userGroup']['value']
                           )) {
      $this->session->AddMessage('success', "Your have successfully created a new account.");
      $this->RedirectToController('create');
      
    } else {
      $this->session->AddMessage('notice', "Failed to create an account.");
      $this->RedirectToController('create');
    }
  }
  
  
    /**
   * remove a user.
   */
      public function Remove() {
    $form = new CFormUserRemove($this);
    if($form->Check() === false) {
      $this->session->AddMessage('notice', 'You must fill in all values.');
      $this->RedirectToController('Remove');
    }
    $this->views->SetTitle('Remove user');
    $this->views->AddInclude(__DIR__ . '/remove.tpl.php', array('form' => $form->GetHTML(),'usercheck' => $this->session->GetAuthenticatedUser()));     
  }
  
      /**
   * Perform a remove of a user as callback on a submitted form.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoRemove($form) {
  	  $check = false;
    if($check = $this->user->Remove($form['name']['value'],
                           $form['email']['value']
                           )) {
      $this->session->AddMessage('success', "Your have successfully removed a account.");
      $this->RedirectToController('remove');
    } else {
      $this->session->AddMessage('notice', "Failed to remove an account.");
      $this->RedirectToController('remove');
    }
  }
  
  
      /**
   * get users.
   */
      public function getUsers() {
    $this->views->SetTitle('Show users');
    
    $this->views->AddInclude(__DIR__ . '/showUsers.tpl.php', array('usercheck' => $this->session->GetAuthenticatedUser(), 
    	    			       'users' => $this->user->getUsers(),
    	    			       'userGroup' => $this->user->getUser2group()));     
  }

  /**
   * Logout a user.
   */
  public function Logout() {
    $this->user->Logout();
    $this->RedirectToController();
  }
  

  /**
   * Init the user database.
   */
  public function Init() {
    $this->user->Init();
    $this->RedirectToController();
  }
  

} 
