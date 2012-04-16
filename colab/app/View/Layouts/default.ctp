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
		CoLAB
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('mp3-player-button');
		echo $this->Html->css('colab');

		echo $scripts_for_layout;
	?>
	
	<script type="text/javascript" src="/js/soundmanager2-jsmin.js"></script>
	<script type="text/javascript" src="/js/mp3-player-button.js"></script>
	<script type="text/javascript" src="/js/motivatequote.js"></script>
	<script type="text/javascript">
	soundManager.url = '/swf/'; // directory where SM2 .SWFs live
	var play = new Boolean(true);
	</script>
	<script type="text/javascript">
	function togglePlay() {
	    if (play) {
			//play all tracks
			// wanna change css for button right here
			$('.audio-track').trigger('play');
	    }
	    else {
			//pause all tracks
			//also chance css button
	        $('.audio-track').trigger('pause');
	    }
		play = !play;
	}
	
	function rewindTracks() {
		$('.audio-track').each(function(index) {
		    this.currentTime=0;
		});
	}
	</script>
	
</head>

<body>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="/js/libs/jquery-1.6.2.min.js"><\/script>')</script>

  <script defer src="/js/plugins.js"></script>
  <script defer src="/js/script.js"></script>


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

	<header id="primary-header"> <!-- TODO swap these two tags -->
	<div id="header-cont" class="clearfix">
		
		<h1><a href="/"><img src="/img/logo-bevelled.png" alt="CoLAB" title="CoLAB" /></a></h1>
		
		<div id="user-links">
			<?php 
			if (!isset($authUser) || !$authUser) {
				echo '<img src="/img/test_img/noavatar_sq.jpg" class ="avatar" />';
				echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login'));
			} else {
				echo '<a href="/users/' . $authUser['id'] . '"><img src="/img/test_img/newavatar_sq.jpg" class="avatar" /></a>';
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
		&copy; 2012 Team CoLAB</p>
	</footer>

<!--<?php echo $this->element('sql_dump'); ?>-->

</body>
</html>
