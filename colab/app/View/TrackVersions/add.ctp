<div class="trackVersions form">
<?php echo $this->Form->create('TrackVersion');?>
	<fieldset>
		<legend><?php echo __('Add Track Version'); ?></legend>
	<?php
		echo $this->Form->input('message');
		echo $this->Form->input('filename');
		echo $this->Form->input('track_id');
		echo $this->Form->input('author');
		echo $this->Form->input('created');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Track Versions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timebased Comments'), array('controller' => 'timebased_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timebased Comment'), array('controller' => 'timebased_comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Version Tags'), array('controller' => 'version_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version Tag'), array('controller' => 'version_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>