<div class="tracks view">
<h2><?php  echo __('Track');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($track['Track']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Song Id'); ?></dt>
		<dd>
			<?php echo h($track['Track']['song_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current Version'); ?></dt>
		<dd>
			<?php echo h($track['Track']['current_version']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Time'); ?></dt>
		<dd>
			<?php echo h($track['Track']['deleted_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($track['Track']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Time'); ?></dt>
		<dd>
			<?php echo h($track['Track']['created_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Track'), array('action' => 'edit', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Track'), array('action' => 'delete', $track['Track']['id']), null, __('Are you sure you want to delete # %s?', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('action' => 'add')); ?> </li>
	</ul>
</div>
