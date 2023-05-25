<!-- in /templates/Users/login.php -->
<?php
$this->disableAutoLayout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>400 Error 400</title>
    <?= $this->Html->css(['log_styles', 'normalize.min', 'cake']) ?>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-white">
    <div id="layoutError">
        <div id="layoutError_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="text-center mt-4">
                                <img class="img-fluid p-4" src="assets/img/illustrations/400-error-bad-request.svg" alt="" />
                                <p class="lead">Your do not have permission.</p>
                                <a class="text-arrow-icon" href="<?= $this->Url->build('/users') ?>">
                                    <i class="ms-0 me-1" data-feather="arrow-left"></i>
                                    Return to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- in /templates/Users/login.php -->
    <?php
    $this->disableAutoLayout();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>400 Error 400</title>
        <?= $this->Html->css(['log_styles', 'normalize.min', 'cake']) ?>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>

    <body class="bg-white">
        <div id="layoutError">
            <div id="layoutError_content">
                <main>
                    <div class="container-xl px-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="text-center mt-4">
                                    <img class="img-fluid p-4" src="assets/img/illustrations/400-error-bad-request.svg" alt="" />
                                    <p class="lead">Your do not have permission.</p>
                                    <a class="text-arrow-icon" href="<?= $this->Url->build('/users') ?>">
                                        <i class="ms-0 me-1" data-feather="arrow-left"></i>
                                        Return to Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>

    </html>


    <?php
    /**
     * @var \App\View\AppView $this
     * @var \Cake\Database\StatementInterface $error
     * @var string $message
     * @var string $url
     */

    use Cake\Core\Configure;
    use Cake\Error\Debugger;

    $this->layout = 'error';

    if (Configure::read('debug')) :
        $this->layout = 'dev_error';

        $this->assign('title', $message);
        $this->assign('templateName', 'error400.php');

        $this->start('file');
    ?>
        <?php if (!empty($error->queryString)) : ?>
            <p class="notice">
                <strong>SQL Query: </strong>
                <?= h($error->queryString) ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($error->params)) : ?>
            <strong>SQL Query Params: </strong>
            <?php Debugger::dump($error->params) ?>
        <?php endif; ?>
        <?= $this->element('auto_table_warning') ?>
    <?php

        $this->end();
    endif;
    ?>
    <h2><?= h($message) ?></h2>
    <p class="error">
        <strong><?= __d('cake', 'Error') ?>: </strong>
        <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
    </p>