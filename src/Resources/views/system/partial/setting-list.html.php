<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 * @var \App\Entity\Settings[] $settings
 */
?><?php foreach ($settings as $setting) :?>
    <div class="form-group row">
        <div class="col-sm-3 text-right">
            <?= $setting->getTitle()?>
            <div style="font-size: 10px; margin-top: -3px"><?= $this->escape($setting->getKey())?></div>
        </div>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?= $this->escape($setting->getDefaultValue())?>">
        </div>
    </div>
<?php endforeach;?>