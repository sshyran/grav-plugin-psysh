<?php
namespace Grav\Plugin;

class PsyshTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'PsyshTwigExtension';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'psysh',
                [
                    $this,
                    'fire_shell_from_twig'
                ]
            )
        ];
    }

    public function fire_shell_from_twig()
    {
        \Grav\Plugin\PsyshPlugin::fire_shell_from_twig();
    }
}
