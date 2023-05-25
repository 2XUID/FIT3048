<?php
echo $this->Html->css('//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css', ['block' => True]);
echo $this->Html->script('//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', ['block' => True]);
echo $this->Html->script('//code.jquery.com/jquery-3.5.1.js', ['block' => True]);
?>
<div class="images index content">
    <div class="card-body">
        <h3><?= __('Images') ?></h3>
        <?= $this->Html->link(__('New Image'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <table id="example" class="cell-border" style="width:100%">
            <thead>
                <tr>
                    <th><?= h('inspection_id') ?></th>
                    <th><?= h('image_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($images as $image) : ?>
                    <tr>
                        <td><?= $image->has('inspection') ? $this->Html->link($image->inspection->inspection_id, ['controller' => 'Inspections', 'action' => 'view', $image->inspection->inspection_id]) : '' ?></td>
                        <td><?= $this->Number->format($image->image_id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $image->image_id],['class' => 'badge bg-yellow-soft text-black']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $image->image_id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->image_id), 'class' => 'badge bg-red-200 text-red']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
