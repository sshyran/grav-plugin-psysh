<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class PsyshPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * PLUGIN EVENTS
     */
    public function onPluginsInitialized()
    {
        $this->require_binary();
    }


    /**
     * PLUGIN METHODS
     */
    protected function require_binary()
    {
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
