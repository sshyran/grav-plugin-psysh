<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class PsyshPlugin extends Plugin
{
    public function __construct($name, $grav, $config = null)
    {
        parent::__construct($name, $grav, $config);
        $this->require_binary();
    }

    public static function getSubscribedEvents()
    {
        return [
            'onTwigExtensions' => ['onTwigExtensions', 0],
        ];
    }

    /**
     * PLUGIN EVENTS
     */
    public function onTwigExtensions()
    {
        require_once(__DIR__ . '/twig/PsyshTwigExtension.php');
        $this->grav['twig']->twig->addExtension(new PsyshTwigExtension());
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

    static function fire_shell_from_twig()
    {
        $grav = \Grav\Common\Grav::instance();
        if(!$grav) return;
        if(!isset($grav['config'])) return;
        $psysh_enabled = $grav['config']->get('plugins.psysh.enabled');
        if(!$psysh_enabled) return;

        /**
         * This comment will be visible with `whereami`
         *
         * =============== WARNING ===============
         * Shell context is
         * \Grav\Plugin\PsyshPlugin::fire_shell()
         * Use $grav['twig'] to debug
         **/
        extract(\Psy\Shell::debug(get_defined_vars()));
    }
}
