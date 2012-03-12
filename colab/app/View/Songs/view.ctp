<div class="songs view">
<h2><?php  echo __('Song');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($song['Song']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Owner'); ?></dt>
		<dd>
			<?php echo h($song['Song']['owner']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($song['Song']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($song['Song']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Song'), array('action' => 'edit', $song['Song']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Song'), array('action' => 'delete', $song['Song']['id']), null, __('Are you sure you want to delete # %s?', $song['Song']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Songs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Song'), array('action' => 'add')); ?> </li>
	</ul>
</div>
