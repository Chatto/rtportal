<section>
<table id="users" class="table table-bordered table-striped <!--table-hover -->">
		<thead>
			<th><?= $paginate->sort('id', 'Id'); ?></th>
			<!--<th><?= $paginate->sort('sort_order', 'Order'); ?></th>-->
			<th><?= $paginate->sort('username', 'Username'); ?></th>
			<!--<th><?= $paginate->sort('display_name', 'Display Name'); ?></th>-->
			<th><?= $paginate->sort('email', 'Email'); ?></th>
			<th><?= $paginate->sort('role', 'Role'); ?></th>
			<th colspan="3">Actions</th>
		</thead>
		<tbody id="sort">
		<? $items = $paginate['items']; ?>
		<?php foreach ($items as $key => $val): ?>
		<tr id='User_<?= $key['id']?>'>
			<!--<td style="width:1px;"><?= $key['id']; ?></td>-->
			<td style="width:20px;"><?= $key['id']; ?>
			</td>
			<td>
				<? if(!empty($key['username'])): ?>
				<?= $key['username']; ?>
				<?php else: ?>
				<?= '--'; ?>
				<? endif; ?>
			</td>
			<!--
			<td>
				<? if(!empty($key['display_name'])): ?>
				<?= $this->Text->truncate($key['display_name'],
				200,
				array(
					'ellipsis' => '...',
					'exact' => false,
					'html' => true)); ?>
				<?php else: ?>
				<?= '--'; ?>
				<? endif; ?>
			</td>
			-->
			<td>
				<? if(!empty($key['email'])): ?>
				<?= $key['email']; ?>
				<?php else: ?>
				<?= '--'; ?>
				<? endif; ?>
			</td>
			<td>
				<? if(!empty($key['role'])): ?>
				<?= $key['role']; ?>
				<?php else: ?>
				<?= '--'; ?>
				<? endif; ?>
			</td>
			<td style="width:1px;">
				<?= $this->Html->link(
				'Profile',
				array(
					'controller' => 'users',
					'action' => 'profile',
					$key['id']),
				array(
						'class' => 'btn btn-small btn-info'
				));?>
			</td>
			<td style="width:1px;">
				<?= $this->Form->postLink(
				'Edit',
				array(
					'controller' => 'users',
					'action' => 'edit',
					$key['id']),
				array(
						'class' => 'btn btn-small btn-warning'
				));?>
			</td>
			<td style="width:1px;">
				<?= $this->Html->link(
				'Delete',
				array(
					'controller' => 'users',
					'action' => 'delete',
					$key['id']),
				array(
						'class' => 'btn btn-small btn-danger',
						' "Are you sure you wish to delete this?"'
				));?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</section>