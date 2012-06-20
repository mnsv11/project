<?php
/**
 * A page controller to display a page, for example an about-page, displays content labelled as "page".
 * 
* @package LydiaCore
 */
class CCForum extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    
    
    
  }


     /**
   * Display a thread.
   *
   * @param $id integer the id of the page.
   */
  public function index($id=null) {
  	  $this->session->storePage('../forum');
  	  $userCheck = $this->session->GetAuthenticatedUser();
    $forum = new CMForum($id);

    $form = new CFormForumCat($forum);
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
    } else if($status === true) {
      $this->RedirectToController();
    }  

    $this->views->SetTitle('Forum');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'usercheck' => $this->session->GetAuthenticatedUser(),
                  'forum'=>$forum->ListAll(array('type'=>'kategori', 'order-by'=>'type', 'order-order'=>'DESC')),
                  'entry'=>$forum->ListAll(array('type'=>'tråd', 'order-by'=>'type', 'order-order'=>'DESC')),
                  'visit'=>$forum->checkVisited(array('user'=>$userCheck['id'], 'order-by'=>'type', 'order-order'=>'DESC')),
                  'form'=>$form,
                  
                ),'leftbar');
 }
   
   


   public function init(){
   	     $userCheck = $this->session->GetAuthenticatedUser();
   	 if($userCheck['groups'][0]['idGroups'] == 1)
   	 {
   	   $this->views->SetTitle('init');
   	   $forum = new CMForum();
	 $forum->Manage('install');
	 $this->AddMessage('notice', 'Ny databas för forumet är skapat');
	 $this->RedirectToController();
	 }
	 else
	 {
	 	 $this->AddMessage('notice', 'Du har inte behörighet för denna funktion');
	 	$this->RedirectToController();	 
	 }
   }
   
   
   
   
   
     /**
   * Edit a selected content, or prepare to create new content if argument is missing.
   *
   * @param id integer the id of the content.
   */
  public function Edit($id=null, $postId=null) {
  	  $check = false;
  	  
    if($postId)
    {
    	    $forum = new CMForum($postId);
    	    $form = new CFormForumMain($forum);
    	        $status = $form->Check();
	    if($status === false) {
	      $this->session->AddMessage('notice', 'The form could not be processed.');
	    } else if($status === true) {
	      $this->RedirectToController('viewThread/'. $postId);
	    }
    }
    else
    {
    	    
    	    $forum = new CMForum($id);
    	    if($forum['type'] == "tråd"){
    	    	    $form = new CFormForumMain2A($forum);
    	    	    if($forum['title'] == ""){
    	    	    	    $redirect ='viewThread/' . $forum['key'];
    	    	    }else{
    	    	    	  $redirect = 'viewThread/' . $forum['id'];  
    	    	    }
    	    }
    	    else
    	    {
    	    	   $form = new CFormForumMain2($forum); 
    	    	  $check = true;
    	    	   
    	    }	    
    	    
    	        $status = $form->Check();
	    if($status === false) {
	      $this->session->AddMessage('notice', 'The form could not be processed.');
	    } else if($status === true) {
	    	    
	    	    if($check == true)
	    	    {
	    	 	$redirect ='viewThread/'.$forum['id'];
	    	    }
	    	 
	      $this->RedirectToController($redirect);
	    }
	    	    
	    
    }
        
    
    if($this->session->GetAuthenticatedUser() == "" && $forum['category'] == "medlem")
    {
    	   $this->session->AddMessage('notice', 'Du måste vara medlem för denna sidan!');
    	  $this->RedirectToController('../user/login');
    	     	    
    }
    
    $title = isset($id) ? 'Edit' : 'Create';
    $this->views->SetTitle("$title forum: $id");
    $this->views->AddInclude(__DIR__ . '/edit.tpl.php', array(
                  'user'=>$this->user, 
                  'forum'=>$forum, 
                  'form'=>$form,
                  'title'=>$title,
                ),'leftbar');
    
  }
  

  /**
   * Create new message.
   */
  public function Create($id=null) {
    $this->Edit(null,$id);
  }
  
    /**
   * Create new message.
   */
  public function CreateThread($id=null) {
    $this->Edit($id);
  }
  
  
  /**
   * Display a thread.
   *
   * @param $id integer the id of the page.
   */
  public function View($id=null) {
  	  
    $forum = new CMForum($id);
    $form = new CFormForumThread($forum);
    $userCheck = $this->session->GetAuthenticatedUser();
    $this->session->storePage('../forum/view/' . $forum['id']);
    $status = $form->Check();
    if($this->session->GetAuthenticatedUser() == "" && $forum['category'] == "medlem")
    {
    	   $this->session->AddMessage('notice', 'Du måste vara medlem för denna sidan!');
    	  $this->RedirectToController('../user/login');
    	     	    
    }
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToControllerMethod();
    } else if($status === true) {
      $this->RedirectToControllerMethod();
    }  

    $this->views->SetTitle('Page: '.htmlEnt($forum['title']));
    $this->views->AddInclude(__DIR__ . '/threads.tpl.php', array(
                  'forum' => $forum,
                  'usercheck' => $this->session->GetAuthenticatedUser(),
                  'entries'=>$forum->ListAll(array('type'=>'tråd', 'order-by'=>'type', 'order-order'=>'DESC')),
                  'visit'=>$forum->checkVisited(array('user'=>$userCheck['id'], 'order-by'=>'type', 'order-order'=>'DESC')),
                  'form'=>$form,
                ),'leftbar');
 }
  
 
   /**
   * Display a thread.
   *
   * @param $id integer the id of the page.
   */
  public function ViewThread($id=null) {
  	  
    $forum = new CMForum($id);
    $form = new CFormForumThread($forum);
    $this->session->storePage('../forum/ViewThread/' . $id);
    $status = $form->Check();
        if($this->session->GetAuthenticatedUser() == "" && $forum['category'] == "medlem")
    {
    	   $this->session->AddMessage('notice', 'Du måste vara medlem för denna sidan!');
    	  $this->RedirectToController('../user/login');
    	     	    
    }
    $user = $this->session->GetAuthenticatedUser();
    $forum->addVisit($user['id'] ,$forum['id']);
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToControllerMethod();
    } else if($status === true) {
      $this->RedirectToControllerMethod();
    }  

    $this->views->SetTitle('Page: '.htmlEnt($forum['title']));
    $this->views->AddInclude(__DIR__ . '/view.tpl.php', array(
                  'forum' => $forum,
                  'usercheck' => $this->session->GetAuthenticatedUser(),
                  'entries'=>$forum->ListAll(array('type'=>'tråd', 'order-by'=>'type', 'order-order'=>'DESC')),'form'=>$form,
                ),'leftbar');
 }
 
 
 
      /**
   * Perform a remove of a thread
   *
   * 
   */
  public function Remove($id = null) {
  	 
  	
  	 $check = false;
  	  $forum = new CMForum($id);
  	
  	 if($check = $forum->Remove())
    	    {
    	    	    if($forum['title'] == ""){
    	    	    	    $this->RedirectToController('ViewThread/'. $forum['key']);
    	    	    }
    	    	    else{
    	    	    	    $this->RedirectToController('view/' . $forum['key']);
    	    	    }
    	    	    	    
	    } else {
	      $this->session->AddMessage('notice', "Failed to remove an account.");
	      $this->RedirectToController('ViewThread/'. $forum['key']);
	    }
  }
} 

