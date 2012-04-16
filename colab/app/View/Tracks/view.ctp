<script type="text/javascript">
	function diff() {
		var versions = new Array();
		
		$('input.diff-checkbox:checked').each(function(i) {
			versions.push(this.dataset['trackversion']);
		});
		
		if (versions.length !== 2) {
			alert("Please select exactly two versions to diff.");
			return;
		}
		
		window.location = "/trackVersions/diff?a=" + versions[0] + "&b=" + versions[1];
	}
	
	$(function() {
		$('a.revert-link').click(function(e) {
			e.preventDefault();
			
			if (this.dataset['activated'] === true) return;
			this.dataset['activated'] = true;
			
			$(this).text("Working...");
			
			$.post(
				'/songs/<?php echo $track['Track']['song_id']; ?>/tracks/<?php echo $track['Track']['id']; ?>/setCurrentVersion',
				{ 'trackVersion': this.dataset['trackversion'] },
				function(data, status, jqxhr) { location.reload(); }
			);
		});
	});
</script>

<div class="tracks view">
<h2><?php echo $track['Track']['name']; ?> - History</h2>
	<div class="diff">
		<a class="button icon diff" onclick="diff();"><span>Diff</span></a>
	</div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Version</th>
			<th><!--Listen--></th>
			<th>Created</th>
			<!--<th>Message</th>-->
			<th>Author</th>
			<th>Diff</th>
			<th class="actions"><!--<?php echo __('Actions');?>--></th>
		</tr>
		<?php
		$track['TrackVersion'] = array_reverse($track['TrackVersion']);
		
		foreach($track['TrackVersion'] as $trackVersion) { ?>
		<tr <?php if ($track['Track']['current_version'] == $trackVersion['id']) { echo ' class="current-version"'; } ?>>
			<td><?php echo h($trackVersion['id']); ?></td>
			<td><?php echo h($trackVersion['message']); ?><br /><audio src="<?php echo '/', $trackVersion['dir'], '/', $trackVersion['filename'];?>" controls style="width:254px; margin-top:5px;"></audio></td>
			<td><?php echo h($trackVersion['created']); ?></td>
			<!--<td><?php echo h($trackVersion['message']); ?></td>-->
			<td><?php echo $this->Html->link(__($trackVersion['author']['Author']['name']), array('controller' => 'users', 'action' => 'view', $trackVersion['author']['Author']['id'])); ?></td>
			<td><input type="checkbox" data-trackversion="<?php echo $trackVersion['id']; ?>" class="diff-checkbox" /></td>
			<td class="actions">
				<a href="/tvdownload.php?tvfilename=<?php echo $trackVersion['filename']; ?>">Download</a>
				<a class="revert-link" data-trackversion="<?php echo $trackVersion['id']; ?>" style="cursor:pointer;">Make Current</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Back to Song'), array('controller' => 'songs', 'action' => 'view', $track['Track']['song_id'])); ?></li>
		<li><?php echo $this->Html->link(__('Upload New Version'), '/tracks/'.$track['Track']['id'].'/addVersion'); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Track'), array('action' => 'edit', $track['Track']['id'])); ?> </li>
		<!--<li><?php echo $this->Form->postLink(__('Delete Track'), array('action' => 'delete', $track['Track']['id']), null, __('Are you sure you want to delete # %s?', $track['Track']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tracks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Track'), array('action' => 'add')); ?> </li>-->
	</ul>
</div>
