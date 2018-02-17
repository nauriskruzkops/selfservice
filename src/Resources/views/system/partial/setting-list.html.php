<?php
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;

/**
 * @var PhpEngine $view
 * @var \App\Entity\Company[] $companies
 * @var \App\Entity\Settings[] $settings
 */
?><?php foreach ($settings as $setting) :?>
    <div class="form-group">
        <label>
            <?= $setting->getTitle()?>
            <div style="font-size: 10px; margin-top: -3px"><?= $this->escape($setting->getKey())?></div>
        </label>
        <input type="text" class="form-control" value="<?= $this->escape($setting->getDefaultValue())?>">
    </div>
<?php endforeach;?>