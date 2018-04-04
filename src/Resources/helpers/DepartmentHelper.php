<?php

namespace App\View\Helpers;

use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\Templating\Helper\Helper;

class DepartmentHelper extends Helper
{
    /** @var PhpEngine  */
    private $view;

    public function __construct(PhpEngine $templating)
    {
        $this->view = $templating;
    }

    /**
     * Returns the canonical name of this helper.
     * @return string The canonical name
     */
    public function getName()
    {
        return 'employee';
    }
}