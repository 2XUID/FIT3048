<?php
echo $this->Html->css([
    '//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css',
    '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css', 'styles'
], ['block' => True]);

echo $this->Html->script([
    '//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js',
    '//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js',
    '//code.jquery.com/jquery-3.5.1.js',
], ['block' => True]);
?>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="home"></i></div>
                        Apartment List
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="<?= $this->Url->build(['action' => 'add']) ?>">
                        <i class="me-1" data-feather="plus-square" style="margin-top: 1.4px;"></i>
                        Add Apartment
                    </a>
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
                        <th><?= h('Apartment Address') ?></th>
                        <th><?= h('Apartment Description') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($apartments as $apartment) : ?>
                        <tr>
                            <td><?= h($apartment->apartment_address) ?></td>
                            <td><?= h($apartment->apartment_type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $apartment->apartment_id], ['class' => 'badge bg-yellow-soft text-black']) ?>
                                <!-- <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="<?= $this->Url->build(['action' => 'view', $apartment->apartment_id]) ?>">
                                    <i data-feather="edit"></i>
                                </a> -->
                                <?php if ($this->Identity->get('user_type') == 'admin') {
                                    echo $this->Form->postLink(
                                        __('Delete'),
                                        ['action' => 'delete', $apartment->apartment_id],
                                        ['confirm' => __('Are you sure you want to delete it ?', $apartment->apartment_id), 'class' => 'badge bg-red-200 text-red']
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