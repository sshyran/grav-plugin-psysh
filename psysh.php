<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class PsyshPlugin extends Plugin
{
    public function __construct()
    {
        /**
         * Update with `wget https://git.io/psysh -O psysh.phar`
         * More at http://psysh.org
         */
        require_once __DIR__.'/psysh.phar';
    }
}
