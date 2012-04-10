<div class="songs form">
<?php echo $this->Form->create('Song');?>
	<fieldset>
		<legend><?php echo __('Edit Song'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back to Songs'), array('action' => 'index'));?></li>
	</ul>
</div>
