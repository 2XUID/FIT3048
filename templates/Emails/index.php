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
                        <div class="page-header-icon"><i data-feather="mail"></i></div>
                        Email List
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid px-4">
    <div class="card" style="overflow-x:auto;">
        <div class="card-body">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th><?= h('Added on') ?></th>
                        <th><?= h('Email Subject') ?></th>
                        <th><?= h('Email Address') ?></th>
                        <th><?= h('Send Status') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emails as $email) : ?>
                        <tr>
                            <td><?= h($email->email_created->format('d-m-y')) ?></td>
                            <td><?= h($email->email_name) ?></td>
                            <td><?= h($email->email_address) ?></td>
                            <td><?= h($email->email_sent) ? __('Yes') : __('No') ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $email->email_id], ['class' => 'badge bg-yellow-soft text-black']) ?>
                                <?php if ($this->Identity->get('user_type') == 'admin') {
                                    echo $this->Form->postLink(
                                        __('Delete'),
                                        ['action' => 'delete', $email->email_id],
                                        ['confirm' => __('Are you sure you want to delete it ?', $email->email_id), 'class' => 'badge bg-red-200 text-red']
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
