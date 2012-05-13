<?php
/**
 * Sample controller for a site builder.
 */
class CCMycontroller extends CObject implements IController {

  /**
   * Constructor
   */
  public function __construct() { parent::__construct(); }
  
      /**
   * Implementing interface IController. All controllers must have an index action.
   */
  public function Index() {      
    $modules = new CMModules();
    $controllers = $modules->AvailableControllers();
    $this->views->SetTitle('Index');
    $this->views->AddInclude(__DIR__ . '/leftbar.tpl.php',array(),'leftbar');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(), 'primary');
    $this->views->AddInclude(__DIR__ . '/rightbar.tpl.php',array(),'rightbar');
    
  }

  /**
   * The page about me
   */
  public function page() {
    $content = new CMContent(5);
    $this->views->SetTitle('page');
    $this->views->AddInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                ));
  }


  /**
   * The blog.
   */
  public function Blog() {
    $content = new CMContent();
    $this->views->SetTitle('My blog');
    $this->views->AddInclude(__DIR__ . '/blog.tpl.php', array(
                  'contents' => $content->ListAll(array('type'=>'post', 'order-by'=>'title', 'order-order'=>'DESC')),
                ));
  }


  /**
   * The guestbook.
   */
  public function myGuestbook() {
    $guestbook = new CMGuestbook();
    $form = new CFormMyGuestbook($guestbook);
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToControllerMethod();
    } else if($status === true) {
      $this->RedirectToControllerMethod();
    }
    
    $this->views->SetTitle('Guestbook');
    $this->views->AddInclude(__DIR__ . '/myGuestbook.tpl.php', array(
            'entries'=>$guestbook->ReadAll(), 
            'form'=>$form,
         ));
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
    $this->objecyt = $object;
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
