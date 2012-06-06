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
                  'form'=>$form,
                  
                ),'leftbar');
 }
   
   

   public function init(){
   	   $this->views->SetTitle('init');
   	   $forum = new CMForum();
	 $forum->Manage('install');	   
   }
   
   
   
   
   
     /**
   * Edit a selected content, or prepare to create new content if argument is missing.
   *
   * @param id integer the id of the content.
   */
  public function Edit($id=null, $postId=null) {
  	  
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
    	    $form = new CFormForumMain2($forum);
    	        $status = $form->Check();
	    if($status === false) {
	      $this->session->AddMessage('notice', 'The form could not be processed.');
	    } else if($status === true) {
	      $this->RedirectToController('viewThread/'. $this->db->LastInsertId());
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
	      $this->RedirectToController('ViewThread/'. $forum['key']);
	    } else {
	      $this->session->AddMessage('notice', "Failed to remove an account.");
	      $this->RedirectToController('ViewThread/'. $forum['key']);
	    }
  }
} 

