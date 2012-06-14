<?php
/**
 * A model for content stored in database.
 * 
* @package LydiaCore
 */
class CMForum extends CObject implements IHasSQL, ArrayAccess, IModule {

  /**
   * Properties
   */
  public $data;


  /**
   * Constructor
   */
  public function __construct($id=null) {
    parent::__construct();
    if($id) {
      $this->LoadById($id);

    } else {
      $this->data = array();
    }
  }


  /**
   * Implementing ArrayAccess for $this->data
   */
  public function offsetSet($offset, $value) { if (is_null($offset)) { $this->data[] = $value; } else { $this->data[$offset] = $value; }}
  public function offsetExists($offset) { return isset($this->data[$offset]); }
  public function offsetUnset($offset) { unset($this->data[$offset]); }
  public function offsetGet($offset) { return isset($this->data[$offset]) ? $this->data[$offset] : null; }


  /**
   * Implementing interface IHasSQL. Encapsulate all SQL used by this class.
   *
   * @param string $key the string that is the key of the wanted SQL-entry in the array.
   */
  
    public static function SQL($key=null, $args=null) {
    $order_order  = isset($args['order-order']) ? $args['order-order'] : 'ASC';
    $order_by     = isset($args['order-by'])    ? $args['order-by'] : 'id';    
    $queries = array(
      'drop table forum'        => "DROP TABLE IF EXISTS Forum;",
      'create table forum'      => "CREATE TABLE IF NOT EXISTS Forum (id INTEGER PRIMARY KEY, key TEXT KEY, type TEXT, title TEXT, data TEXT,category TEXT, filter TEXT, idUser INT, created DATETIME default (datetime('now')), updated DATETIME default NULL, deleted DATETIME default NULL, FOREIGN KEY(idUser) REFERENCES User(id));",
      'insert forum'            => 'INSERT INTO Forum (key,type,title,data,category,filter,idUser) VALUES (?,?,?,?,?,?,?);',
      'check'                   => 'SELECT id FROM Forum WHERE (title=? and type=?);',
      'select * by id'          => 'SELECT c.*, u.acronym as owner FROM Forum AS c INNER JOIN User as u ON c.idUser=u.id WHERE c.id=?;',
      'select * by key'         => 'SELECT c.*, u.acronym as owner FROM Forum AS c INNER JOIN User as u ON c.idUser=u.id WHERE c.key=?;',
      'select * by type'        => "SELECT c.*, u.acronym as owner FROM Forum AS c INNER JOIN User as u ON c.idUser=u.id WHERE type=? ORDER BY {$order_by} {$order_order};",
      'select *'                => 'SELECT c.*, u.acronym as owner FROM Forum AS c INNER JOIN User as u ON c.idUser=u.id;',
      'update forum'            => "UPDATE Forum SET key=?, type=?, title=?, data=?,category=?, filter=?, updated=datetime('now') WHERE id=?;",
      'remove'			=> "UPDATE Forum SET deleted=datetime('now') WHERE id=?;",
      'lastid'			=> 'SELECT MAX(id) as id FROM Forum;',
     );
    if(!isset($queries[$key])) {
      throw new Exception("No such SQL query, key '$key' was not found.");
    }
    return $queries[$key];
  }

 

  /**
   * Implementing interface IModule. Manage install/update/deinstall and equal actions.
   */
  public function Manage($action=null) {
    switch($action) {
      case 'install': 
        try {
          $this->db->ExecuteQuery(self::SQL('drop table forum'));
          $this->db->ExecuteQuery(self::SQL('create table forum'));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('gäster', 'kategori', 'Information', "",'gäst', 'plain', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('medlem', 'kategori', 'Suzuki', "",'medlem', 'plain', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('medlem', 'kategori', 'Mek', "",'medlem', 'plain', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('medlem', 'kategori', 'Sporthojar i övrigt', "",'medlem', 'plain', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('medlem', 'kategori', 'Övrigt', "",'medlem', 'plain', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('2', 'tråd', 'Vilken hoj har ni', 'Lägg gärna in vad för hoj ni har här','medlem', 'bbcode', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('1', 'tråd', 'Allmän info','Vi ber er alla att sköta er på detta forum och respektera andra','gäst', 'bbcode', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('3', 'tråd', 'Hjälp', 'Någon som kan hjälpa mig, min hoj startar ej.','medlem', 'bbcode', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('3', 'tråd', 'Trim', 'Vill ah hjälp med att trimma min hoj','medlem', 'bbcode', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('4', 'tråd', 'Ny Honda', 'Någon som har sett den nya honda firebird?','medlem', 'bbcode', $this->user['id']));
          $this->db->ExecuteQuery(self::SQL('insert forum'), array('5', 'tråd', 'Recept', 'Någon som har ett bra recept på en paj?','medlem', 'bbcode', $this->user['id']));
          return array('success', 'Successfully created the database tables and created a new forum, owned by you.');
        } catch(Exception$e) {
          die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
        }
      break;
      
      default:
        throw new Exception('Unsupported action for this module.');
      break;
    }
  }
  
    /**
   * Save content. If it has a id, use it to update current entry or else insert new entry.
   *
   * @returns boolean true if success else false.
   */
  public function Save() {
    $msg = null;
  
    $check = $this->check($this['type'] , $this['title']);
    
    $checkUser = $this->user['id'];
    if($checkUser == "")
    {
     $checkUser = "1";	    
    }

    if($check)
    {
    	$this->AddMessage('error', "Kategori finns redan"); 
    	return "";
    }
    
    else if($this['id']) {
      $this->db->ExecuteQuery(self::SQL('update forum'), array($this['key'], $this['type'], $this['title'], $this['data'],$this['category'], $this['filter'], $this['id']));
      $msg = 'uppdaterad';
    } else {
      $this->db->ExecuteQuery(self::SQL('insert forum'), array($this['key'], $this['type'], $this['title'], $this['data'],$this['category'], $this['filter'], $checkUser));
      $this['id'] = $this->db->LastInsertId();
    
      $msg = 'skapad';
    }
    $rowcount = $this->db->RowCount();
    if($rowcount) {
      $this->AddMessage('success', "{$this['type']} blev {$msg} ");
     } else {
      $this->AddMessage('error', "{$this['type']} blev inte {$msg}");
    }
    return $rowcount === 1;
  }
  
  
  public function check($type, $title)
  {	if($title)
  	  {
  	  	  return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('check'), array($title,$type));
   	  }
  }
  
  
  /**
  *edit forum
  *
  */
  public function edit()
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('update forum'), array($this['key'], $this['type'], $this['title'], $this['data'],$this['category'], $this['filter'], $this['id']));
  	  $msg = 'uppdaterad';
  	  $rowcount = $this->db->RowCount();
  	  
          if($rowcount) {
          	  $this->AddMessage('success', "{$this['type']} {$msg}");
          } else {
          	  $this->AddMessage('error', "{$this['type']} ej {$msg} ");
          }
          return $rowcount === 1;
  	  
  }
  
    /**
   * Load content by id.
   *
   * @param id integer the id of the content.
   * @returns boolean true if success else false.
   */
  public function LoadById($id) {
    $res = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * by id'), array($id));
    if(empty($res)) {
      $this->AddMessage('error', "Failed to load forum with id '$id'.");
      return false;
    } else {
      $this->data = $res[0];
    }
    return true;
  }
  
  /**
   * List all content.
   *
   * @param $args array with various settings for the request. Default is null.
   * @returns array with listing or null if empty.
   */

  public function ListAll($args=null) {    
    try {
      if(isset($args) && isset($args['type'])) {
      	  
        return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * by type', $args), array($args['type']));
      } else {
   
        return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select *', $args));
      }
    } catch(Exception $e) {
      echo $e;
      return null;
    }
  }
  
 
  
  /**remove a thread or post in forum
  *
  */
  public function Remove()
  {
     $msg = null;
      $this->db->ExecuteQuery(self::SQL('remove'), array($this['id']));
      $msg = 'removed';
    $rowcount = $this->db->RowCount();
    if($rowcount) {
      $this->AddMessage('success', "Successfully {$msg}");
    } else {
      $this->AddMessage('error', "Failed to {$msg}");
    }
    return $rowcount === 1;
  }
  
  
  
  
}
