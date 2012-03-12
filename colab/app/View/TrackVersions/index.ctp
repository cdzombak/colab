<div class="trackVersions index">
	<h2><?php echo __('Track Versions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('message');?></th>
			<th><?php echo $this->Paginator->sort('filename');?></th>
			<th><?php echo $this->Paginator->sort('track_id');?></th>
			<th><?php echo "Listen";?><th>
			<th><?php echo $this->Paginator->sort('author');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($trackVersions as $trackVersion): ?>
	<tr>
		<td><?php echo h($trackVersion['TrackVersion']['id']); ?>&nbsp;</td>
		<td><?php echo h($trackVersion['TrackVersion']['message']); ?>&nbsp;</td>
		<td><?php echo h($trackVersion['TrackVersion']['filename']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($trackVersion['Track']['name'], array('controller' => 'tracks', 'action' => 'view', $trackVersion['Track']['id'])); ?>
		</td>
		<td><p><a href="<?php echo $trackVersion['TrackVersion']['dir'], '/', $trackVersion['TrackVersion']['filename'];?>" class = "sm2_button"></a>test</p></td>
		<td><?php echo h($trackVersion['TrackVersion']['author']); ?>&nbsp;</td>
		<td><?php echo h($trackVersion['TrackVersion']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $trackVersion['TrackVersion']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $trackVersion['TrackVersion']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Track Version'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timebased Comments'), array('controller' => 'timebased_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timebased Comment'), array('controller' => 'timebased_comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Version Tags'), array('controller' => 'version_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version Tag'), array('controller' => 'version_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
