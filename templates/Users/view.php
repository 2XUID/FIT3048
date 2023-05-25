<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                        View User
                    </h1>
                </div>
                <?php if ($this->Identity->get('user_type') == 'admin') : ?>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="<?= $this->Url->build(['action' => 'index']) ?>">
                            <i class="me-1" data-feather="arrow-left" style="margin-top: 1.4px;"></i>
                            Back to the list
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>


<div class="container-fluid px-4">
    <div class="row gx-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">User Details</div>
                <div class="card-body">
                    <?= $this->Form->create($user, ['type' => 'file']) ?>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('user_fname', ['class' => "form-control", 'label' => 'First Name', 'readonly' => true, 'disabled' => true]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('user_lname', ['class' => "form-control", 'label' => 'Last Name', 'readonly' => true, 'disabled' => true]); ?>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('user_prefername', ['class' => 'form-control', 'label' => 'Prefer Name', 'readonly' => true, 'disabled' => true]); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->control('user_phone', ['class' => 'form-control', 'label' => 'Phone Number', 'readonly' => true, 'disabled' => true]); ?>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <?php echo $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email', 'readonly' => true, 'disabled' => true]); ?>
                        </div>
                        <?php if ($this->Identity->get('user_type') == 'admin') : ?>
                            <div class="col-md-6">
                                <?php echo $this->Form->control('user_type', ['class' => 'form-control', 'label' => 'Account Type', 'options' => ['admin' => 'Admin', 'contractor' => 'Contractor'], 'readonly' => true, 'disabled' => true]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <?php echo $this->Form->control('user_address', ['class' => 'form-control', 'label' => 'Address', 'readonly' => true, 'disabled' => true]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-header-actions">
                <div class="card-header">
                    Profile Image
                    <i class="text-muted" data-bs-toggle="tooltip" data-bs-placement="left"></i>
                </div>
                <div class="card-body">
                    <div class="card-body d-flex justify-content-center align-items-center" style="display: flex; justify-content: center; align-items: center;">
                        <div class="mb-3">
                            <div class="mb-3">
                                <?= $this->Html->image($user->user_image, ['width' => 200, 'height' => 150]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="mt-4 card card-header-actions">
                <div class="card-header">
                    Action
                    <i class="text-muted" data-bs-toggle="tooltip" data-bs-placement="left"></i>
                </div>
                <div class="card-body">
                    <div class="d-grid">
                        <?= $this->Form->end() ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->user_id], ['class' => 'd-grid fw-500 btn btn-warning']) ?>
                        <hr />
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $user->user_id],
                            ['confirm' => __('Are you sure you want to delete it ?', $user->user_id), 'class' => 'd-grid fw-500 btn btn-danger']
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>