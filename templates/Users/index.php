<?php
echo $this->Html->css([
    '//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css',
    '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css', 'styles',
], ['block' => True]);

echo $this->Html->script([
    '//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', '//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js',
    '//code.jquery.com/jquery-3.5.1.js',
], ['block' => True]);
?>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                        User List
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="<?= $this->Url->build(['action' => 'add']) ?>">
                        <i class="me-1" data-feather="user-plus" style="margin-top: 1.4px;"></i>
                        Add User
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid px-4">
    <div class="card" style="overflow-x:auto;">
        <div class="card-body">
            <table id="example" class="table cell-border" style="width:100%">
                <thead>
                    <tr>
                        <th><?= h('First Name') ?></th>
                        <th><?= h('Last Name') ?></th>
                        <th><?= h('Preferred Name') ?></th>
                        <th><?= h('Phone Number') ?></th>
                        <th><?= h('Email') ?></th>
                        <th><?= h('User Type') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= h($user->user_fname) ?></td>
                            <td><?= h($user->user_lname) ?></td>
                            <td><?= h($user->user_prefername) ?></td>
                            <td><?= h($user->user_phone) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->user_type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $user->user_id], ['class' => 'badge bg-yellow-soft text-black']) ?>
                                <?php if ($this->Identity->get('email') == $user->email || $this->Identity->get('user_type') == 'admin') {
                                    echo $this->Form->postLink(
                                        __('Delete'),
                                        ['action' => 'delete', $user->user_id],
                                        ['confirm' => __('Are you sure you want to delete it ?', $user->user_id), 'class' => 'badge bg-red-200 text-red']
                                    );
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    let table = new DataTable('#example');
    $(document).ready(function() {
        $('#example').DataTable({
            scrollY: '200px',
            scrollCollapse: true,
            paging: false,
        });
    });
</script>