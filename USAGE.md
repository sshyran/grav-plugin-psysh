## Understanding shell context

PsySH shell run in the context of a PHP execution. The shell execute at user specified break points. Once the shell fired, the `whereami` command will show you the break point and it's surrounding code.

## Firing a shell

In order for PsySH fire a shell, script need to execute from a terminal. This happen when using php command line or inline server. It's possible to fire shells on remote machine if you're logged in via SSH.

### command line

`bin/plugin psysh shell`

See this [example](assets/fire-command-line.png).

### inline server

* Open a terminal.
* `cd` to your Grav install.
* Start PHP inline server with `php -S 127.0.0.1:8080 system/router.php`.
* Add `eval(\Psy\sh())` in a PHP file or `{% do psysh() %};` in a TWIG file.
* Visit [127.0.0.1:8080](http://127.0.0.1:8080).

She this [example](assets/fire-inline-server.png).

## Breakpoint

As you can see in the last example the shell fired at `eval(\Psy\sh())`. This is a PsySH breakpoint. It execute the shell.

You can specify multiple breakpoints and change their location at anytime. Changes take effect when executing the PHP script again.

To add a breakpoint in a twig file use `{% do psysh() }`.

## Basic usage

PsySH provide fully featured PHP interpreter. Thus, you can test anything and see live results. Furthermore, the `help` command will list available helpers.

Here's an [example](assets/basic-usage.png).

There is a lot you can do with PsySH but it can be hard at first.

The most useful commands are:

* ` doc` show PHP documentation ([example](assets/basic-usage-doc.png))
* `show` show object source code ([example](assets/basic-usage-show.png))
* `list` show available methods, attributes, functions, vars, global vars, etc ([example](assets/basic-usage-list.png))

## Usage examples

Following are some use cases example to help you work in Grav.

* [Load Grav instance](assets/usecase-grav-instance.png).
* [Debug Admin plugin](assets/usecase-debug-plugin.png).
* [Debug Antimatter theme](assets/usecase-debug-twig.png).