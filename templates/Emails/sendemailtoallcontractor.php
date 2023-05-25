<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Email $email
 */
?>
<div class="row">
    <aside class="column-responsive column-80">
        <div class="apartments form content">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Email Lists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="emails form content">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Emails', 'action' => 'sendemailtoallcontractor']]) ?>
            <fieldset>
                <legend><?= __('Send Inspection Email(Admin only)') ?></legend>
                <div class="row gx-3 mb-3">
                    <div class="col-md-6">
                        <?php echo $this->Form->control('email_name', ['label' => 'Your name']); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->control('email_body', ['label' => 'information of Inspection', 'rows' => 10, 'cols' => 100]); ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Send email'), ['class' => 'btn btn-primary btn-block']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>