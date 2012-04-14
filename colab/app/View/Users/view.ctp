<div class="users view">
	<h2><?php echo h($user['User']['name']); ?></h2>
	<p><?php echo h($user['User']['username']); ?> was created <?php echo h($user['User']['created']); ?>.</p>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Song'), array('controller' => 'songs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Track Versions');?></h3>
	<?php if (!empty($user['TrackVersion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Filename'); ?></th>
		<th><?php echo __('Track Id'); ?></th>
		<th><?php echo __('Author'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['TrackVersion'] as $trackVersion): ?>
		<tr>
			<td><?php echo $trackVersion['id'];?></td>
			<td><?php echo $trackVersion['message'];?></td>
			<td><?php echo $trackVersion['filename'];?></td>
			<td><?php echo $trackVersion['track_id'];?></td>
			<td><?php echo $trackVersion['author'];?></td>
			<td><?php echo $trackVersion['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'track_versions', 'action' => 'view', $trackVersion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'track_versions', 'action' => 'edit', $trackVersion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'track_versions', 'action' => 'delete', $trackVersion['id']), null, __('Are you sure you want to delete # %s?', $trackVersion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Track Version'), array('controller' => 'track_versions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Discussion Messages');?></h3>
	<?php if (!empty($user['DiscussionMessage'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Associated Entity Type'); ?></th>
		<th><?php echo __('Associated Entity Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['DiscussionMessage'] as $discussionMessage): ?>
		<tr>
			<td><?php echo $discussionMessage['id'];?></td>
			<td><?php echo $discussionMessage['message'];?></td>
			<td><?php echo $discussionMessage['created'];?></td>
			<td><?php echo $discussionMessage['associated_entity_type'];?></td>
			<td><?php echo $discussionMessage['associated_entity_id'];?></td>
			<td><?php echo $discussionMessage['user_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'discussion_messages', 'action' => 'view', $discussionMessage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'discussion_messages', 'action' => 'edit', $discussionMessage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'discussion_messages', 'action' => 'delete', $discussionMessage['id']), null, __('Are you sure you want to delete # %s?', $discussionMessage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Discussion Message'), array('controller' => 'discussion_messages', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Timebased Comments');?></h3>
	<?php if (!empty($user['TimebasedComment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Timestamp'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Track Version Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['TimebasedComment'] as $timebasedComment): ?>
		<tr>
			<td><?php echo $timebasedComment['id'];?></td>
			<td><?php echo $timebasedComment['message'];?></td>
			<td><?php echo $timebasedComment['timestamp'];?></td>
			<td><?php echo $timebasedComment['created'];?></td>
			<td><?php echo $timebasedComment['track_version_id'];?></td>
			<td><?php echo $timebasedComment['user_id'];?></td>
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
	<h3><?php echo __('Related Songs');?></h3>
	<?php if (!empty($user['Song'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Owner'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Song'] as $song): ?>
		<tr>
			<td><?php echo $song['id'];?></td>
			<td><?php echo $song['owner'];?></td>
			<td><?php echo $song['name'];?></td>
			<td><?php echo $song['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'songs', 'action' => 'view', $song['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'songs', 'action' => 'edit', $song['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'songs', 'action' => 'delete', $song['id']), null, __('Are you sure you want to delete # %s?', $song['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Song'), array('controller' => 'songs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
