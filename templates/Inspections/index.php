<?php
echo $this->Html->css([
    '//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css',
    '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css', 'styles',
], ['block' => True]);

echo $this->Html->script([
    '//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js',
    '//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js',
    '//code.jquery.com/jquery-3.5.1.js',
], ['block' => True]);
?>
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4 overflow-x:auto">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="globe"></i></div>
                        Inspection List
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <?php if ($this->Identity->get('user_type') == 'admin') { ?>
                        <a class="btn btn-sm btn-light text-primary" href="<?= $this->Url->build(['action' => 'add']) ?>">
                            <i class="me-1" data-feather="file-plus" style="margin-top: 1.4px;"></i>
                            Add Inspection
                        </a>
                    <?php } ?>
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
                        <th><?= h('Inspection Date ') ?></th>
                        <th><?= h('Inspection Status') ?></th>
                        <th><?= h('Contractor Name') ?></th>
                        <th><?= h('Apartment') ?></th>
                        <th><?= h('Type') ?></th>
                        <th><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inspections as $inspection) {
                        if ($this->Identity->get('user_type') == 'admin' || $inspection->has('user') == False || $this->Identity->get('user_id') == $inspection->user_id) { ?>
                            <tr>
                                <td><?= h($inspection->inspection_datetime->format('d-m-y')) ?></td>
                                <td><?= h($inspection->inspection_status) ?></td>
                                <td><?= $inspection->has('user') ? $inspection->user->user_fname : '' ?></td>
                                <td><?= $inspection->has('apartment') ? $inspection->apartment->apartment_address : '' ?></td>
                                <td><?= h($inspection->inspection_type) ?></td>
                                <td class="actions">
                                    <?php if ($this->Identity->get('user_type') == 'contractor' && $inspection->has('user') == False) : ?>
                                        <?= $this->Html->link(__('Accept'), ['action' => 'accept', $inspection->inspection_id], ['class' => 'badge bg-green-soft text-green']) ?>
                                    <?php endif; ?>
                                    <?php if ($this->Identity->get('user_type') == 'contractor' || $inspection->has('user') == False && $this->Identity->get('user_type') != 'admin') : ?>
                                        <?= $this->Html->link(__('View'), ['action' => 'view', $inspection->inspection_id], ['class' => 'badge bg-yellow-soft text-black']) ?>
                                    <?php endif; ?>
                                    <?php if ($this->Identity->get('user_type') == 'admin') {
                                        echo $this->Html->link(__('View'), ['action' => 'view', $inspection->inspection_id], ['class' => 'badge bg-yellow-soft text-black']);
                                        echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $inspection->inspection_id], ['confirm' => __('Are you sure you want to delete # {0}?', $inspection->inspection_id), 'class' => 'badge bg-red-200 text-red']);
                                    }
                                    ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } ?>
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
