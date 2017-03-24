<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class PsyshPlugin extends Plugin
{
    public function __construct()
    {
        require_once __DIR__.'/cli/psysh';
    }
}
