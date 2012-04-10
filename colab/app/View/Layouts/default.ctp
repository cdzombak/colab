<?php
/* copied, for now, from lib/Cake/View/Layouts/default.ctp , with some mods for FB */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?= $this->Facebook->html(); ?>
<?= $this->Facebook->init(); ?>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1">

	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('mp3-player-button');
		echo $this->Html->css('colab');

		echo $scripts_for_layout;
	?>
	
	<style type="text/css">
	#soundmanager-debug {/* SM2 debug container (optional, makes debug more useable) */ position:absolute;position:fixed;*position:absolute;bottom:10px;right:10px;width:50em;height:18em;overflow:auto;background:#fff;margin:1em;padding:1em;border:1px solid #999;font-family:"lucida console",verdana,tahoma,"sans serif";font-size:x-small;line-height:1.5em;opacity:0.9;filter:alpha(opacity=90);}
	</style>
	<script type="text/javascript" src="/js/soundmanager2-jsmin.js"></script>
	<script type="text/javascript" src="/js/mp3-player-button.js"></script>
	<script type="text/javascript">
	soundManager.url = '/swf/'; // directory where SM2 .SWFs live
	</script>
	
</head>

<body>

	<header id="primary-header"> <!-- TODO swap these two tags -->
	<div id="header-cont" class="clearfix">
		
		<h1><a href="/"><img src="/img/logo-1.png" alt="CoLAB" title="CoLAB" /></a></h1>
		
		<div id="user-links">
			<?php 
			if (!isset($authUser) || !$authUser) {
			    echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login'));
			} else {
				echo '<a href="#"><img src="/img/test_img/newavatar_sq.jpg" class="avatar" /></a>';
				echo 'Hello, ' . $authUser['name'] . '!<br />';
				echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));
			}
			?>
		</div>
		
	</div>
	</header>

	<div id="main" role="main" class="clearfix">
		
		<?php echo $this->Session->flash(); ?>

		<?php echo $content_for_layout; ?>

	</div>

	<footer>
		<p><a href="#">Blog</a> | <a href="#">Help</a><br />
		&copy; 2012 CoLAB contributors</p>
	</footer>


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="/js/libs/jquery-1.6.2.min.js"><\/script>')</script>

  <script defer src="/js/plugins.js"></script>
  <script defer src="/js/script.js"></script>

  <!-- TODO -->
  <script> // Change UA-XXXXX-X to be your site's ID
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

<?php echo $this->element('sql_dump'); ?>

</body>
</html>