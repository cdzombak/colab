<div class="tracks form">
<?php echo $this->Form->create('Track');?>
	<fieldset>
		<legend><?php echo __('Add Track'); ?></legend>
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
