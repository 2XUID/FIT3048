<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image $image
 * @var \App\Model\Entity\Inspection $inspection
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'badge bg-yellow-soft text-black']) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $image->image_id],  ['class' => 'badge bg-yellow-soft text-yellow']) ?>
            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $image->image_id], ['confirm' => __('Are you sure you want to delete it ?', $image->image_id), 'class' => 'badge bg-red-200 text-red']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="images view content">
            <h3><?= h($image->image_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Image Number') ?></th>
                    <td><?= $this->Number->format($image->image_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Inspection ID: ') ?></th>
                    <td><?= $image->has('inspection') ? $this->Html->link($image->inspection->inspection_id, ['controller' => 'Inspections', 'action' => 'view', $image->inspection->inspection_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Apartment Address: ') ?></th>
                 </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <tr>
                    <td><?= $this->Html->image($image->image_photo) ?></td>
                </tr>
                </tr>
                <tr>
                    <th><?= __('Image Description: ') ?></th>
                    <td><?= h($image->image_description) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
