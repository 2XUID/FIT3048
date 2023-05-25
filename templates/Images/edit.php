<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image $image
 * @var string[]|\Cake\Collection\CollectionInterface $inspections
 */
?>


<div class="col-lg-7" style="float:none;margin:auto;">
    <div class="column-responsive column-80">
        <div class="images form content">
            <div class="side-nav">
                <h4 class="heading"><?= __('Actions') ?></h4>
                <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'badge bg-yellow-soft text-black']) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $image->image_id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->image_id), 'class' => 'badge bg-red-200 text-red']) ?>
            </div>
            <?= $this->Form->create($image) ?>
            <fieldset>
                <legend><?= __('Edit Image') ?></legend>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('inspection_id', ['options' => $inspections, 'class' => 'form-control col-md-6', 'label' => 'Inspection ID']); ?>
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-block']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>