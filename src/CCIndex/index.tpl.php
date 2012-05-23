<h1>Index Controller</h1>
<p>Welcome to Lydia index controller.</p>

<h2>Download</h2>
<p>You can download Lydia from github.</p>
<blockquote>
<code>git clone git://github.com/mnsv11/project.git</code>

</blockquote>
<p>You can review its source directly on github: <a href='https://github.com/mnsv11/project'>https://github.com/mnsv11/project</a></p>
<h2>Installation</h2>
<p>First you have to make the data-directory writable. This is the place where Lydia needs
to be able to write and create files.</p>
<blockquote>
<code>cd project; chmod 777 site/data/.ht.sqlite</code><br>
<code>cd project; chmod 777 themes/grid</code>
<P>Change in .htaccess(if you use this on student server) </p>

</blockquote>

<p>Second, Lydia has some modules that need to be initialised. You can do this through a 
controller. Point your browser to the following link. After install login and do install again.</p>
<blockquote>
<a href='<?=create_url('modules/install')?>'>modules/install</a>
</blockquote>

</blockquote>

<p>Third, open site/src/config.php and add // in front of<br> "'index'     => array('enabled' => true,'class' => 'CCIndex')", 
<br>and remove // in front of<br> "'index'     => array('enabled' => true,'class' => 'CCMycontroller')".</p>
<blockquote>

</blockquote>

<p>Fourth, start use the site.</p>
<blockquote>
