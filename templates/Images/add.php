<?php
echo $this->Html->css('//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', ['block' => True]);
echo $this->Html->script('//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['block' => True]);
echo $this->Html->script('//cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js', ['block' => True]);
?>

<div class="col-lg-7" style="float:none;margin:auto;">
    <div class="column-responsive column-80">
        <div class="images form content">
            <div class="side-nav">
                <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'badge bg-yellow-soft text-black']) ?>
            </div>
            <?= $this->Form->create($image, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Image') ?></legend>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('inspection_id', ['options' => $inspections, 'class' => 'form-control col-md-6 js-example-basic-single', 'label' => 'Apartment Address']); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo $this->Form->control('image_photo', ['type' => 'file', 'class' => 'form-control col-md-6 js-example-basic-single', 'label' => 'Upload Image ']); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <?php echo $this->Form->control('image_description', ['label' => 'Image Description', 'class' => 'form-control col-md-6 js-example-basic-single','rows' => 10, 'cols' => 60]); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->control('finishallinspection', ['type' => 'checkbox', 'label' => 'If the inspection has been finished, please submit to notify the admin staff ']); ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary btn-block']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>