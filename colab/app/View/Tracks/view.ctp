<?php debug($track)?>
<div class="tracks view">
<h2><?php  echo __('Track');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($track['Track']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Song'); ?></dt>
		<dd>
			<?php echo $this->Html->link($track['Song']['name'], array('controller' => 'songs', 'action' => 'view', $track['Song']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Current Version'); ?></dt>
		<dd>
			<?php echo h($track['Track']['current_version']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($track['Track']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($track['Track']['created']); ?>
			&nbsp;
		</dd>
	</dl>
	
	<h2><?php echo __('Versions') ?></h2>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>ID</th>
		<th>Listen</th>
		<th>Message</th>
		<th>Filename</th>
		<th>Author</th>
		<th>Created</th>
	</tr>
		<?php
		array_reverse($track['TrackVersion']);
		foreach($track['TrackVersion'] as $trackVersion) { ?>
		<tr>
			<td><?php echo h($trackVersion['id']); ?>&nbsp;</td>
			<td><a href="<?php echo '/', $trackVersion['dir'], '/', $trackVersion['filename'];?>" class = "sm2_button"></a></td>
			<td><?php echo h($trackVersion['message']); ?>&nbsp;</td>
			<td><?php echo h($trackVersion['filename']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link(__($trackVersion['author']['Author']['name']), array('controller' => 'users', 'action' => 'view', $trackVersion['author']['Author']['id'])); ?></td>
			<td><?php echo h($trackVersion['created']); ?>&nbsp;</td>
		</tr>
		<?php } ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Upload New Version'), '/tracks/'.$track['Track']['id'].'/addVersion'); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Track'), array('action' => 'edit', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Track'), array('action' => 'delete', $track['Track']['id']), null, __('Are you sure you want to delete # %s?', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('action' => 'add')); ?> </li>
	</ul>
</div>