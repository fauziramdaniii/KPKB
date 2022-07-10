<?php

return [
    'error' => '<div class="invalid-feedback">{{content}}</div>',
    'label' => '<label class="col-form-label col-lg-2">{{text}}</label>',
    'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
    'formGroup' => '{{label}}<div class="col-lg-7">{{input}}{{error}}</div>',
    'inputContainer' => '<div class="input {{type}}{{required}} form-group row">{{content}}</div>',
    'inputContainerError' => '<div class="input {{type}}{{required}} form-group validated row">{{content}}</div>',
];