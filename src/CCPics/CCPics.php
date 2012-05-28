<?php
/**
 * A page controller to display a page, for example an about-page, displays content labelled as "page".
 * 
* @package LydiaCore
 */
class CCPics extends CObject implements IController {


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
  public function Index($id=null) {    
    $pictures = new CMPics($id);
    $this->views->SetTitle('Bilder');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array('pictures' => $pictures->listAll(), 'picParth' => $this->picParth,'usercheck' => $this->session->GetAuthenticatedUser(),), 'primary');

  }
  
  public function init(){
  	  $this->views->SetTitle('init');
  	  $pictures = new CMPics();
  	  $pictures->Manage('install');
  }

  /**
   * Add pics.
   */
  public function addPics($id=null) {
   $pictures = new CMPics($id);
    $form = new CFormPics($pictures);
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToControllerMethod();
    } else if($status === true) {
      $this->RedirectToControllerMethod();
    }  

    $this->views->SetTitle('Page: '.htmlEnt($pictures['title']));
    $this->views->AddInclude(__DIR__ . '/addPic.tpl.php', array(
                  'contents' => $pictures,'usercheck' => $this->session->GetAuthenticatedUser(),
                  'entries'=>$pictures->ListAll(array('type'=>'komment', 'order-by'=>'type', 'order-order'=>'DESC')),'form'=>$form,
                ),'primary');
   }
   
   
 

} 


/**
 * Form for pics
 */
class CFormPics extends CForm {

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

    $this->AddElement(new CFormElementText('name', array('value'=>"")))
    	 ->AddElement(new CFormElementHidden('id', array('value'=>"")))
    	 ->AddElement(new CFormElementText('nameSmall', array('value'=>"")))
    	 ->AddElement(new CFormElementText('comment', array('value'=>"")))
    	 ->AddElement(new CFormElementText('sub', array('value'=>"")))
    	 ->AddElement(new CFormElementUpload('picture', array('value'=>"")))
    	 ->AddElement(new CFormElementTextarea('data', array('label'=>'Add picture info:')))
         ->AddElement(new CFormElementSubmit('Spara', array('callback'=>array($this, 'DoSave'), 'callback-args'=>array($object))));
  }
  
  /**
   * Callback to save the form content to database.
   */
  public function DoSave($form, $pictures) {
    $pictures['id']    	      = $form['id']['value'];
    $pictures['name'] 	      = $form['name']['value'];
    $pictures['data']         = $form['data']['value'];
    $pictures['picture']      = $form['picture']['value'];
    $pictures['nameSmall']    = $form['nameSmall']['value'];
    

	// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
	// of $_FILES.
	
	$uploaddir = '/home/saxon/students/20112/mnsv11/www/project/site/themes/mytheme/';
	$uploadfile = $uploaddir . basename($_FILES['picture']['name']);
	if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile)) {
	
	}
	return $pictures->Save();
  }
  
  
  
  
}
