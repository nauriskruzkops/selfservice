<?php

namespace App\View\Helpers;

use App\Entity\CompanyDepartment;
use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine;
use Symfony\Component\Templating\Helper\Helper;

class ObjectUrlHelper extends Helper
{
    /** @var PhpEngine  */
    private $view;

    public function __construct(PhpEngine $templating)
    {
        $this->view = $templating;
    }

    public function object($object, $route = null, $template = '<a %s href="%s">%s</a>')
    {
        $url = '';
        $title = '-- wrong object to get url --';
        $opt = '';

        if ($object instanceof Employee) {
            $url = $this->view['router']->path($route ?? 'employee_id', ['employee_id' => $object->getId()]);
            $title = $this->view->escape($object->getFullName());
        } elseif ($object instanceof CompanyDepartment) {
            $url = $this->view['router']->path($route ?? 'department', ['department_id' => $object->getId()]);
            $title = $this->view->escape($object->getTitle());
        }

        return sprintf($template, $opt, $url, $title);
    }

    /**
     * Returns the canonical name of this helper.
     * @return string The canonical name
     */
    public function getName()
    {
        return 'object_url';
    }
}