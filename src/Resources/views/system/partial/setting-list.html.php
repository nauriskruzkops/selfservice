<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 */
?><?php foreach ($settings as $setting) :?>
    <div class="form-group row">
        <div class="col-sm-3 text-right">Setting key</div>
        <div class="col-sm-9">
            Settings value
        </div>
    </div>
<?php endforeach;?>