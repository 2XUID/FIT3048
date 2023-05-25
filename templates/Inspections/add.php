<?php
echo $this->Html->css([
    '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
    '//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',
    '//cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css',
    'styles',
], ['block' => True]);
echo $this->Html->script([
    '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
    '//cdn.ckeditor.com/ckeditor5/36.0.1/super-build/ckeditor.js',
    '//cdn.ckbox.io/CKBox/1.3.2/ckbox.js'
], ['block' => True]);
?>
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="globe"></i></div>
                        Add Inspection
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
                <div class="card-header">Inspection Details</div>
                <div class="card-body">
                    <?= $this->Form->create($inspection) ?>
                    <div class="row gx-3 mb-3">
                        <?php echo $this->Form->control('apartment_id', ['options' => $apartments, 'class' => 'js-example-basic-single form-control col-md-6 ', 'label' => 'Apartment Address ']); ?>
                    </div>
                    <div class="mb-3">
                        <?php echo $this->Form->control('inspection_datetime', ['class' => 'form-control col-md-6', 'label' => 'Inspection Date ']); ?>
                    </div>
                    <div class="mb-3">
                        <?php echo $this->Form->control('inspection_status', ['class' => 'form-control', 'label' => 'Inspection status', 'options' => ['Pending' => 'Pending', 'Accepted' => 'Accepted', 'Inspected' => 'Inspected', 'Finished' => 'Finished', 'Rejected' => 'Rejected']]); ?>
                    </div>
                    <div class="mb-3">
                        <?php echo $this->Form->control('inspection_type', ['class' => 'form-control', 'label' => 'Inspection type', 'options' => ['Other'=>'Other','Routine Inspection' => 'Routine Inspection', 'Private Inspection' => 'Private Inspection', 'Open Inspection' => 'Open Inspection', 'Property Audit' => 'Property Audit']]); ?>
                    </div>
                </div>
            </div>
            <div class="card card-header-actions mb-4 mb-lg-0">
                <div class="card-header">
                    Inspection Description
                </div>
                <div class="card-body">
                    <?php echo $this->Form->control('inspection_description', ['class' => 'form-control col-md-6', 'label' => false]); ?>
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
                        <?= $this->Form->button(__('Submit'), ['class' => 'd-grid fw-500 btn btn-primary']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: 'bootstrap-5'
        });
        CKEDITOR.ClassicEditor.create(document.getElementById(""), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            ckbox: {
                tokenUrl: 'https://96945.cke-cs.com/token/dev/DJCu0e3AP18eQq3rVOvvuVMcnpbUe8TIYpDy?limit=10'
            },
            cloudServices: {
                tokenUrl: 'https://96945.cke-cs.com/token/dev/6EUT5q9UeHgJa6s6bv38RUGvg8PLZ94bOP8H?limit=10',
                uploadUrl: 'https://96945.cke-cs.com/easyimage/upload/'
            },
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'link', 'ckbox', 'uploadImage', '|', 'blockQuote', 'insertTable', 'mediaEmbed', 'htmlEmbed', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment',
                    'horizontalLine', 'pageBreak', '|',
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: 'Add inspection information',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                //'CKBox',
                //'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
    });
</script>