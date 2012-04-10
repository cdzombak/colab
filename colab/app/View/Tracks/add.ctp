<div class="tracks form">
<?php echo $this->Form->create('Track');?>
	<fieldset>
		<legend><?php echo __('Add Track'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div><!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tracks'), array('action' => 'index'));?></li>
	</ul>
</div>-->
