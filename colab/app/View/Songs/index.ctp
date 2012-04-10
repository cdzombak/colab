<div class="songs index">
	<h2><?php echo __('My Songs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>	
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('owner');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
	</tr>
	<?php
	foreach ($songs as $song): ?>
	<tr>
		<!--<td><?php echo h($song['Song']['id']); ?>&nbsp;</td>-->
		<td><?php echo $this->Html->link(h($song['Song']['name']), array('action' => 'view', $song['Song']['id'])); ?></td>
		<td><?php echo $this->Html->link(h($song['Owner']['name']), array('controller' => 'users', 'action' => 'view', $song['Owner']['id'])); ?></td>
		<td><?php echo h($song['Song']['created']); ?></td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}; viewing {:start}-{:end}.')
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
	<ul>
		<li><?php echo $this->Html->link(__('Create New Song'), array('action' => 'add')); ?></li>
	</ul>
</div>
