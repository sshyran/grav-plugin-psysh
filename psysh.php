<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class PsyshPlugin extends Plugin
{
    public function __construct($name, $grav, $config = null)
    {
        parent::__construct($name, $grav, $config);

        /**
         * Update with `wget https://git.io/psysh -O psysh.phar`
         * More at http://psysh.org
         */
        $psysh_binary = __DIR__.'/psysh.phar';

        ob_start(); // Fix https://git.io/vSlBs
        require($psysh_binary);
        ob_end_clean();
    }
}
