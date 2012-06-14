<?php
/**
 * Sample controller for a site builder.
 */
class CCMycontroller extends CObject implements IController {

	
	private $picParth;
  /**
   * Constructor
   */
  public function __construct() { 
  	  parent::__construct();
  	  $this->picParth = 'http://www.student.bth.se/~mnsv11/project/site/themes/mytheme/';
  	  
  }
  
  
  
  
  
  
      /**
   * Implementing interface IController. All controllers must have an index action.
   */
  public function Index() {    
    $modules = new CMModules();
    $content = new CMContent();
    $this->session->storePage('../');
    $this->views->SetTitle('Index');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array('img'=>$this->picParth . 'GSXR1000.png'), 'leftbar');
    $this->views->AddInclude(__DIR__ . '/indexNews.tpl.php', array('contents' => $content->ListAll(array('type'=>'page', 'order-by'=>'id', 'order-order'=>'DESC'))), 'rightbar');
  }

  /**
   * News.
   */
    public function news() {    
    $modules = new CMModules();
    $this->session->storePage('../my/news');
    $this->views->SetTitle('Rss');
    $this->views->AddInclude(__DIR__ . '/rightbar.tpl.php', array('img'=>$this->picParth . 'webBikeWorld5.jpg'), 'primary');
    $this->views->AddInclude(__DIR__ . '/prime.tpl.php', array('img'=>$this->picParth . 'alltommc.jpg'), 'primary');
    $this->views->AddInclude(__DIR__ . '/leftbar.tpl.php', array('img'=>$this->picParth . 'smc_logo.png'), 'leftbar');
    
  }
  
  
/**
   * History.
   */
    public function history() {    
    $modules = new CMModules();
    $this->session->storePage('../my/history');
    $this->views->SetTitle('Historia');
    $this->views->AddInclude(__DIR__ . '/historia.tpl.php', array(), 'leftbar');

  }
  
  /**
   * About me.
   */
      public function about() {    
    $modules = new CMModules();
    $this->session->storePage('../my/about');
    $this->views->SetTitle('Om');
    $this->views->AddInclude(__DIR__ . '/om.tpl.php', array('img'=>$this->picParth . 'mig.jpg'), 'leftbar');

  }
  
  /**
   * The blog.
   */
  public function Blog() {
    $content = new CMContent();
    $this->views->SetTitle('Suzuki');
    $this->views->AddInclude(__DIR__ . '/blog.tpl.php', array(
                  'contents' => $content->ListAll(array('type'=>'post', 'order-by'=>'title', 'order-order'=>'DESC')),
                ), 'featured-first');
  }


  /**
   * The guestbook.
   */
  public function myGuestbook() {
    $guestbook = new CMGuestbook();
    $form = new CFormMyGuestbook($guestbook);
    $this->session->storePage('../my/myGuestbook');
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToControllerMethod();
    } else if($status === true) {
      $this->RedirectToControllerMethod();
    }
    
    $this->views->SetTitle('Gästbok');
    $this->views->AddInclude(__DIR__ . '/myGuestbook.tpl.php', array(
            'entries'=>$guestbook->ReadAll(), 
            'form'=>$form,
            
         ),'leftbar');
  }
  
}


/**
 * Form for the guestbook
 */
class CFormMyGuestbook extends CForm {

  /**
   * Properties
   */
  private $object;

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->object = $object;
    $this->AddElement(new CFormElementTextarea('data', array('label'=>'Add entry:')))
         ->AddElement(new CFormElementSubmit('add', array('callback'=>array($this, 'DoAdd'), 'callback-args'=>array($object))));
           	      
  }
  

  /**
   * Callback to add the form content to database.
   */
  public function DoAdd($form, $object) {
    return $object->Add(strip_tags($form['data']['value']));
  }
  
  
}






