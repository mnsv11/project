<?php
/**
 * Helpers for theming, available for all themes in their template files and functions.php.
 * This file is included right before the themes own functions.php
 */
 
 
 /**
 * Get list of tools.
 */
function get_tools() {
  global $ly;
  return <<<EOD
  
<p>



<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>

<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fc493c54aa7ef42"></script>



 
</p>
<br>
<p>
Kontakt: <a href="mailto:svedklint@telia.com">Mail</a> 
<br>
Links: 
<a href="http://www.suzukicycles.com/" target= _blank>Suzuki</a>
<a href="http://www.suzukimc.se/" target= _blank>Suzuki Sverige</a>
<a href="http://www.suzuki-motorcykel.se/" target= _blank>Suzuki MC</a>
</p>

EOD;

/**
*reklam
*/
}function reklam() {
  global $ly;
  return <<<EOD


<a href="http://www.eumoppenomc.se/" target=_blank><img src="site/themes/mytheme/eumoppen.png" width="200" height="50" border="0" alt="Eu moppen"></a> 
<a href="http://www.claessonsmotor.se/" target=_blank><img src="site/themes/mytheme/claessons.png" width="200" height="50" border="0" alt="Claessonsmotor"></a>
<a href="http://www.mcdoktorn.se//" target=_blank><img src="site/themes/mytheme/mcdok.gif" width="200" height="60" border="0" alt="Mc doktorn"></a>
<a href="http://http://www.handelsboden.com/" target=_blank><img src="site/themes/mytheme/hb.png" width="200" height="80" border="0" alt="Handelsboden"></a>
<a href="http://http://www.24mx.se/" target=_blank><img src="site/themes/mytheme/24mx.jpg" width="200" height="140" border="0" alt="24mx"></a>
<a href="http://http://www.swedenrock.com/" target=_blank><img src="site/themes/mytheme/swedenrock.gif" width="200" height="300" border="0" alt="Sweden Rock"></a>
<a href="site/themes/mytheme/SavateSommar2012.pdf" target=_blank><img src="site/themes/mytheme/SavateSommar2012.jpg" width="200" height="300" border="0" alt="Sweden Rock"></a>
EOD;
}

/**
 * Print debuginformation from the framework.
 */
function get_debug() {
  // Only if debug is wanted.
  $ly = CLydia::Instance();  
  if(empty($ly->config['debug'])) {
    return;
  }
  
  // Get the debug output
  $html = null;
  if(isset($ly->config['debug']['db-num-queries']) && $ly->config['debug']['db-num-queries'] && isset($ly->db)) {
    $flash = $ly->session->GetFlash('database_numQueries');
    $flash = $flash ? "$flash + " : null;
    $html .= "<p>Database made $flash" . $ly->db->GetNumQueries() . " queries.</p>";
  }    
  if(isset($ly->config['debug']['db-queries']) && $ly->config['debug']['db-queries'] && isset($ly->db)) {
    $flash = $ly->session->GetFlash('database_queries');
    $queries = $ly->db->GetQueries();
    if($flash) {
      $queries = array_merge($flash, $queries);
    }
    $html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $queries) . "</pre>";
  }    
  if(isset($ly->config['debug']['timer']) && $ly->config['debug']['timer']) {
    $html .= "<p>Page was loaded in " . round(microtime(true) - $ly->timer['first'], 5)*1000 . " msecs.</p>";
  }    
  if(isset($ly->config['debug']['lydia']) && $ly->config['debug']['lydia']) {
    $html .= "<hr><h3>Debuginformation</h3><p>The content of CLydia:</p><pre>" . htmlent(print_r($ly, true)) . "</pre>";
  }    
  if(isset($ly->config['debug']['session']) && $ly->config['debug']['session']) {
    $html .= "<hr><h3>SESSION</h3><p>The content of CLydia->session:</p><pre>" . htmlent(print_r($ly->session, true)) . "</pre>";
    $html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre>";
  }    
  return $html;
}


/**
 * Get messages stored in flash-session.
 */
function get_messages_from_session() {
  $messages = CLydia::Instance()->session->GetMessages();
  $html = null;
  if(!empty($messages)) {
    foreach($messages as $val) {
      $valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
      $class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
      $html .= "<div class='$class'>{$val['message']}</div>\n";
    }
  }
  return $html;
}


/**
 * Login menu. Creates a menu which reflects if user is logged in or not.
 */
function login_menu() {
  $ly = CLydia::Instance();
  if($ly->user['isAuthenticated']) {
    $items = "<a href='" . create_url('user/profile') . "'><img class='gravatar' src='" . get_gravatar(20) . "' alt=''> " . $ly->user['acronym'] . "</a> ";
    if($ly->user['hasRoleAdmin']) {
      $items .= "<a href='" . create_url('acp') . "'>acp</a> ";
    }
    $items .= "<a href='" . create_url('user/logout') . "'>logout</a> ";
  } else {
    $items = "<a href='" . create_url('user/login') . "'>login</a> ";
  }
  return "<nav>$items</nav>";
}

function status(){
	$ly = CLydia::Instance();
	if($ly->user['isAuthenticated']) {
	return "logged";
	}
}

function log_out(){
	
  return CLydia::Instance()->request->base_url . 'user/logout';
	
}


/**
 *Generate a menu.
*/
function GenerateMenu($items) {
    $html = "";
    foreach($items as $item) {
    	    $html .= "<li><a id=" . $item['altText'] . "- href='" . base_url() . "{$item['url']}'>{$item['text']}</a></li>\n";
    }
    return $html;
  }


/**
 * Get a gravatar based on the user's email.
 */
function get_gravatar($size=null) {
  return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim(CLydia::Instance()->user['email']))) . '.jpg?' . ($size ? "s=$size" : null);
}

/**
 * Escape data to make it safe to write in the browser.
 *
 * @param $str string to escape.
 * @returns string the escaped string.
 */
function esc($str) {
  return htmlEnt($str);
}

/**
 * Filter data according to a filter. Uses CMContent::Filter()
 *
 * @param $data string the data-string to filter.
 * @param $filter string the filter to use.
 * @returns string the filtered string.
 */
function filter_data($data, $filter) {

  return CMContent::Filter($data, $filter);
}
/**
 * Display diff of time between now and a datetime. 
 *
 * @param $start datetime|string
 * @returns string
 */
function time_diff($start) {
  return formatDateTimeDiff($start);
}

/**
 * Prepend the base_url.
 */
function base_url($url=null) {
  return CLydia::Instance()->request->base_url . trim($url, '/');
}



/**
 * Create a url to an internal resource.
 *
 * @param string the whole url or the controller. Leave empty for current controller.
 * @param string the method when specifying controller as first argument, else leave empty.
 * @param string the extra arguments to the method, leave empty if not using method.
 */
function create_url($urlOrController=null, $method=null, $arguments=null) {
  return CLydia::Instance()->request->CreateUrl($urlOrController, $method, $arguments);
}


/**
 * Prepend the theme_url, which is the url to the current theme directory.
 *
 * @param $url string the url-part to prepend.
 * @returns string the absolute url.
 */
function theme_url($url) {
  return create_url(CLydia::Instance()->themeUrl . "/{$url}");
}


/**
 * Prepend the theme_parent_url, which is the url to the parent theme directory.
 *
 * @param $url string the url-part to prepend.
 * @returns string the absolute url.
 */
function theme_parent_url($url) {
  return create_url(CLydia::Instance()->themeParentUrl . "/{$url}");
}


/**
 * Return the current url.
 */
function current_url() {
  return CLydia::Instance()->request->current_url;
}


/**
 * Render all views.
 *
 * @param $region string the region to draw the content in.
 */
function render_views($region='default') {
  return CLydia::Instance()->views->Render($region);
}

/**
 * Check if region has views. Accepts variable amount of arguments as regions.
 *
 * @param $region string the region to draw the content in.
 */
function region_has_content($region='default' /*...*/) {
  return CLydia::Instance()->views->RegionHasView(func_get_args());
}


         
