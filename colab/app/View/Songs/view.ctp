<div class="songs view">
<h2><?php echo h($song['Song']['name']); ?></h2>
	<p>Created by <?php echo $this->Html->link(h($song['Owner']['name']), array('controller' => 'users', 'action' => 'view', $song['Owner']['id'])); ?> on <?php echo h($song['Song']['created']); ?>.</p>

	<h2><?php echo __('Tracks') ?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Name</th>
		<th>Listen</th>
		<th>Current Version</th>
		<th>Message</th>
		<th>Author</th>
		<th>Created</th>
		<th>View</th>
	</tr>
		<?php
		//array_reverse($track['TrackVersion']);
		foreach($song['Track'] as $track) { ?>
		<tr>
			<td><?php echo h($track['name'])?></td>
			<td><a href="
			<?php
			foreach($trackVersions as $tv){ //forgive me father
				if($tv['TrackVersions']['id'] == $track['current_version']){ //for i have sinned				
					$newest = $tv['TrackVersions'];
				}
			}
			echo '/', $newest['dir'], '/', $newest['filename'];?>
			" class = "sm2_button"></a></td>
			<td><?php echo h($track['current_version']); ?>&nbsp;</td>
			<td><?php echo h($newest['message']);?>&nbsp;</td>
			<td><?php echo h($newest['author']);?>&nbsp;</td>
			<td><?php echo h($track['created']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tracks', 'action' => 'view', $track['id'])); ?>
			</td>
		</tr>
		<?php } ?>		
	</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Add Track To Song'), '/songs/'.$song['Song']['id'].'/addTrack'); ?> </li>
		<li><?php echo $this->Html->link(__('Edit This Song'), array('action' => 'edit', $song['Song']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Back to Songs'), array('action' => 'index'));?></li>
		<!--<li><?php echo $this->Form->postLink(__('Delete Song'), array('action' => 'delete', $song['Song']['id']), null, __('Are you sure you want to delete # %s?', $song['Song']['id'])); ?> </li>-->
		<!--<li><?php echo $this->Html->link(__('List Songs'), array('action' => 'index')); ?> </li>-->
	</ul>
</div>
