<div class="tracks view">
<h2><?php echo $track['Track']['name']; ?></h2>
	
	<h2><?php echo __('Versions of this Track') ?></h2>
	
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Version #</th>
			<th>Listen</th>
			<th>Created</th>
			<th>Message</th>
			<th>Author</th>
		</tr>
		<?php
		$track['TrackVersion'] = array_reverse($track['TrackVersion']);
		
		foreach($track['TrackVersion'] as $trackVersion) { ?>
		<tr <?php if ($track['Track']['current_version'] == $trackVersion['id']) { echo ' class="current-version"'; } ?>>
			<td><?php echo h($trackVersion['id']); ?><br />
				<a href="/tvdownload.php?tvfilename=<?php echo $trackVersion['filename']; ?>">Download</a>
			</td>
			<td><audio src="<?php echo '/', $trackVersion['dir'], '/', $trackVersion['filename'];?>" controls></audio></td>
			<td><?php echo h($trackVersion['created']); ?></td>
			<td><?php echo h($trackVersion['message']); ?></td>
			<td><?php echo $this->Html->link(__($trackVersion['author']['Author']['name']), array('controller' => 'users', 'action' => 'view', $trackVersion['author']['Author']['id'])); ?></td>
		</tr>
		<?php } ?>
	</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Upload New Version'), '/tracks/'.$track['Track']['id'].'/addVersion'); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Track'), array('action' => 'edit', $track['Track']['id'])); ?> </li>
		<!--<li><?php echo $this->Form->postLink(__('Delete Track'), array('action' => 'delete', $track['Track']['id']), null, __('Are you sure you want to delete # %s?', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('action' => 'add')); ?> </li>-->
	</ul>
</div>