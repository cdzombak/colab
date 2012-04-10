<div class="trackVersions form">
<?php echo $this->Form->create('TrackVersion', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Add Track Version'); ?></legend>
	<?php
		echo $this->Form->input('message');
		echo $this->Form->input('filename', array('type' => 'file'));
		echo $this->Form->input('dir', array('type' => 'hidden'));
		echo $this->Form->input('mimetype', array('type' => 'hidden'));
		echo $this->Form->input('filesize', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<ul>
		
	</ul>
</div>
