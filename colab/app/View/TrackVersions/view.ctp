<div class="trackVersions view">
<h2><?php  echo __('Track Version');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($trackVersion['TrackVersion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($trackVersion['TrackVersion']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($trackVersion['TrackVersion']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Track'); ?></dt>
		<dd>
			<?php echo $this->Html->link($trackVersion['Track']['name'], array('controller' => 'tracks', 'action' => 'view', $trackVersion['Track']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Author'); ?></dt>
		<dd>
			<?php echo h($trackVersion['TrackVersion']['author']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($trackVersion['TrackVersion']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Track Version'), array('action' => 'edit', $trackVersion['TrackVersion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Track Versions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track Version'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('controller' => 'tracks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('controller' => 'tracks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Timebased Comments'), array('controller' => 'timebased_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timebased Comment'), array('controller' => 'timebased_comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Version Tags'), array('controller' => 'version_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version Tag'), array('controller' => 'version_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Timebased Comments');?></h3>
	<?php if (!empty($trackVersion['TimebasedComment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Timestamp'); ?></th>
		<th><?php echo __('Created Time'); ?></th>
		<th><?php echo __('Track Version Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($trackVersion['TimebasedComment'] as $timebasedComment): ?>
		<tr>
			<td><?php echo $timebasedComment['id'];?></td>
			<td><?php echo $timebasedComment['message'];?></td>
			<td><?php echo $timebasedComment['timestamp'];?></td>
			<td><?php echo $timebasedComment['created_time'];?></td>
			<td><?php echo $timebasedComment['track_version_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'timebased_comments', 'action' => 'view', $timebasedComment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'timebased_comments', 'action' => 'edit', $timebasedComment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'timebased_comments', 'action' => 'delete', $timebasedComment['id']), null, __('Are you sure you want to delete # %s?', $timebasedComment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Timebased Comment'), array('controller' => 'timebased_comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Version Tags');?></h3>
	<?php if (!empty($trackVersion['VersionTag'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Tag'); ?></th>
		<th><?php echo __('Track Version Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($trackVersion['VersionTag'] as $versionTag): ?>
		<tr>
			<td><?php echo $versionTag['id'];?></td>
			<td><?php echo $versionTag['tag'];?></td>
			<td><?php echo $versionTag['track_version_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'version_tags', 'action' => 'view', $versionTag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'version_tags', 'action' => 'edit', $versionTag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'version_tags', 'action' => 'delete', $versionTag['id']), null, __('Are you sure you want to delete # %s?', $versionTag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Version Tag'), array('controller' => 'version_tags', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
