<div class="tracks form">
<?php echo $this->Form->create('Track');?>
	<fieldset>
		<legend><?php echo __('Edit Track'); ?></legend>
	<?php
		echo $this->Form->input('current_version');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back to Track'), array('action' => 'view', $track['Track']['id']));?></li>
	</ul>
</div>
