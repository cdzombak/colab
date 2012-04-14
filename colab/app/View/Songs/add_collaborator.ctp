<div class="songs form">
<?php echo $this->Form->create('Song');?>
	<fieldset>
		<legend><?php echo __('Collaborators on <em>' . $song['Song']['name'] . '</em>'); ?></legend>
	<?php
		echo $this->Form->input('User.User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back to Song'), array('action' => 'view', $song['Song']['id']));?></li>
	</ul>
</div>
