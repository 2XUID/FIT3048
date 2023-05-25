<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Apartment $apartment
 */
echo $this->Html->css([
    'styles'
], ['block' => True]);
?>
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="home"></i></div>
                        View Apartment
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="<?= $this->Url->build(['action' => 'index']) ?>">
                        <i class="me-1" data-feather="arrow-left" style="margin-top: 1.4px;"></i>
                        Back to the list
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid px-4">
    <div class="row gx-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">Apartment Details</div>
                <div class="card-body">
                    <?= $this->Form->create($apartment) ?>
                    <div class="mb-3">
                        <?php echo $this->Form->control('apartment_address', ['class' => 'form-control col-md-6', 'label' => 'Apartment Address', 'readonly' => true]); ?>
                    </div>
                    <div class="mb-3">
                        <?php echo $this->Form->control('apartment_type', [
                            'class' => 'form-control col-md-6', 'label' => 'Apartment Description: ie. 2 Bedroom, 1 Bathroom', 'readonly' => true
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-header-actions">
                <div class="card-header">
                    Action
                    <i class="text-muted" data-bs-toggle="tooltip" data-bs-placement="left"></i>
                </div>
                <div class="card-body">
                    <div class="d-grid">
                        <?= $this->Form->end() ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $apartment->apartment_id], ['class' => 'd-grid fw-500 btn btn-warning']) ?>
                        <hr />
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $apartment->apartment_id],
                            ['confirm' => __('Are you sure you want to delete it ?', $apartment->apartment_id), 'class' => 'd-grid fw-500 btn btn-danger']
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>