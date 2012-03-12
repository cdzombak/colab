<?php
/* copied, for now, from lib/Cake/View/Layouts/default.ctp , with some mods for FB */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?= $this->Facebook->html(); ?>
<?= $this->Facebook->init(); ?>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $scripts_for_layout;
	?>
	<style tpye="text/css">
	#soundmanager-debug {
 	/* SM2 debug container (optional, makes debug more useable) */
	position:absolute;position:fixed;*position:absolute;bottom:10px;right:10px;width:50em;height:18em;overflow:auto;background:#fff;margin:1em;padding:1em;border:1px solid #999;font-family:"lucida console",verdana,tahoma,"sans serif";font-size:x-small;line-height:1.5em;opacity:0.9;filter:alpha(opacity=90);
	}

	body {
		font:75% normal verdana,arial,tahoma,"sans serif";
	}

	</style>

	<link rel="stylesheet" type="text/css" href="/css/mp3-player-button.css" />
	<script type="text/javascript" src="/js/soundmanager2.js"></script>
	<script type="text/javascript" src="/js/mp3-player-button.js"></script>
	<script type="text/javascript">
	soundManager.url = '/swf/'; // directory where SM2 .SWFs live
	</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php 
			if (!isset($authUser) || !$authUser) {
			    echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login'));
			} else {
				echo 'Hello, ' . $authUser['name'] . '!';
				echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));
			}
			?>
			
			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>