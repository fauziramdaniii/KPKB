<?php
$this->Html->css(array(
    '/admin-assets/froala/css/froala_editor.css',
    '/admin-assets/froala/css/froala_style.css',
    '/admin-assets/froala/css/plugins/code_view.css',
    '/admin-assets/froala/css/plugins/colors.css',
    '/admin-assets/froala/css/plugins/image_manager.css',
    '/admin-assets/froala/css/plugins/image.css',
    '/admin-assets/froala/css/plugins/line_breaker.css',
    '/admin-assets/froala/css/plugins/table.css',
    '/admin-assets/froala/css/plugins/char_counter.css',
    '/admin-assets/froala/css/plugins/video.css',
    '/admin-assets/froala/css/third_party/image_tui.min.css',
    '/admin-assets/froala/css/froala_custom.css',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css',
    'https://cdn.jsdelivr.net/npm/tui-image-editor@3.2.2/dist/tui-image-editor.css'
), ['block' => true]);

$this->Html->script(array(
    'https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.6.7/fabric.min.js',
    'https://cdn.jsdelivr.net/npm/tui-code-snippet@1.4.0/dist/tui-code-snippet.min.js',
    'https://cdn.jsdelivr.net/npm/tui-image-editor@3.2.2/dist/tui-image-editor.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js',
    '/admin-assets/froala/js/froala_editor.min.js',
    '/admin-assets/froala/js/plugins/align.min.js',
    '/admin-assets/froala/js/plugins/code_beautifier.min.js',
    '/admin-assets/froala/js/plugins/code_view.min.js',
    '/admin-assets/froala/js/plugins/colors.min.js',
    '/admin-assets/froala/js/plugins/draggable.min.js',
    '/admin-assets/froala/js/plugins/font_size.min.js',
    '/admin-assets/froala/js/plugins/font_family.min.js',
    '/admin-assets/froala/js/plugins/image.min.js',
    '/admin-assets/froala/js/plugins/image_manager.min.js',
    '/admin-assets/froala/js/plugins/line_breaker.min.js',
    '/admin-assets/froala/js/plugins/link.min.js',
    '/admin-assets/froala/js/plugins/lists.min.js',
    '/admin-assets/froala/js/plugins/paragraph_format.min.js',
    '/admin-assets/froala/js/plugins/paragraph_style.min.js',
    '/admin-assets/froala/js/plugins/table.min.js',
    '/admin-assets/froala/js/plugins/video.min.js',
    '/admin-assets/froala/js/plugins/url.min.js',
    '/admin-assets/froala/js/plugins/entities.min.js',
    '/admin-assets/froala/js/plugins/char_counter.min.js',
    '/admin-assets/froala/js/plugins/inline_style.min.js',
    '/admin-assets/froala/js/plugins/fullscreen.min.js',
    '/admin-assets/froala/js/plugins/save.min.js',
    '/admin-assets/froala/js/third_party/image_tui.min.js',
), ['block' => true]); ?>

<script>
    $(document).ready(function() {
        $('textarea.froala-editor').froalaEditor({
            height: 300,
            imageManagerLoadURL: '<?= $this->Url->build(['controller' => 'Uploads', 'action' => 'images']); ?>',
            imageUploadURL: '<?= $this->Url->build(['controller' => 'Uploads', 'action' => 'upload', 'image']); ?>',
            imageManagerDeleteURL: '<?= $this->Url->build(['controller' => 'Uploads', 'action' => 'delete']); ?>',
            imageUploadParams: {_csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'},
            imageManagerDeleteParams: {_csrfToken: '<?= $this->request->getParam('_csrfToken'); ?>'},
            toolbarButtons: ['fullscreen', '|', 'bold', 'italic', 'strikeThrough', 'underline', '|',
                'paragraphFormat', 'paragraphStyle', 'align', 'formatOL', 'formatUL', 'indent', 'outdent',
                '|', 'insertImage', 'insertLink', 'insertTable', 'clearFormatting', 'fontAwesome', 'html']
        });
    });
</script>
