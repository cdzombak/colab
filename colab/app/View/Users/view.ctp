<div class="users view">
	<div style="float:left; padding:30px;">
		<img style="height:200px; width:200px;" src="http://mkolas.colab.cdzombak.net/img/test_img/newavatar_sq.jpg">
	</div>
	<div style="align:center;">
		<h2><?php echo h($user['User']['name']); ?></h2>
		<p><?php echo h($user['User']['username']); ?> was created on <?php echo h($user['User']['created']); ?>.</p>
		<h2>Inspirational Quote</h2>
		<script>inspire();</script>
	</div>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'edit', $user['User']['id'])); ?> </li>
	</ul>
</div>
