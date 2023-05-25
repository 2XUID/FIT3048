<?php

echo $this->Html->css([
    '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
    '//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',
    '//cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css', 'styles',
], ['block' => True]);
echo $this->Html->script([
    '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',

], ['block' => True]);
echo $this->Html->script('//cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js', ['block' => True]);
echo $this->Html->script('//cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js', ['block' => True]);
echo $this->Html->script('//cdn.ckbox.io/CKBox/1.3.2/ckbox.js', ['block' => True]);
?>
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="mail"></i></div>
                        Email to Admin
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <?= $this->Html->link(__('Back to inspection list'), ['controller' => 'Inspections', 'action' => 'index'], ['class' => 'btn btn-sm btn-light text-primary']) ?>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="col-lg-7" style="float:none;margin:auto;">
    <div class="column-responsive column-80">
        <div class="emails form content">
            <?= $this->Form->create($email) ?>
            <fieldset>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6" style="display:none;">
                        <?php echo $this->Form->control('email_address', [
                            'class' => 'form-control',
                            'value' => $this->Identity->get('email')
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <?php echo $this->Form->control('email_name', ['class' => 'form-control', 'label' => 'Email Subject:']); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <?php echo $this->Form->control('email_body', ['class' => 'form-control col-md-6 ', 'label' => 'Email Text:']); ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Send email'), ['class' => 'btn btn-primary btn-block']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>