# Grav PsySH (PHP interactive shell) Plugin

This **PsySH plugin** for [Grav](http://github.com/getgrav/grav) provide a runtime developer console, interactive debugger and REPL for PHP.

Visit [PsySH](http://psysh.org/) homepage for full details.

![](assets/grav-psy-shell.png)

# Install

`bin/gpm install psysh`

# Fire a shell from

## command line

`bin/plugin psysh shell`

## inline server

* Open a terminal.
* `cd` to your Grav install.
* Start PHP inline server with `php -S 127.0.0.1:8080 system/router.php`.
* Add `eval(\Psy\sh())` in a PHP file or `{% do psysh() %};` in a TWIG file.
* Visit [127.0.0.1:8080](http://127.0.0.1:8080).
* A shell will fire in your terminal.
* Do your magic.
* Hit **ctrl-d** to exit.

The server will return to normal execution. From there, you can change break point location, return to your browser, hit F5, return to your terminal and use the new session.

You can fire a shell anywhere once plugins are loaded. Including in Grav core.

## virtual machine

* Log on your VM with SSH.
* Run Grav on PHP inline server.

Read above instructions on how to use PHP inline server.
You will need use the machine public IP instead of 127.0.0.1 when calling `php -S`.

## other web servers

The shell can't fire when running Grav on web servers such as NGINX, Apache and Lighttpd.

You'll need to use the PHP inline server on your web server.
Read above instructions on how to fire from a virtual machine.

# Understanding shell context

PsySH shell run in the context of a PHP execution. The shell execute where the break point is. The `whereami` command will help you figure out where this happen in the code.

# Usage examples

## test without var_dump; die;

```
>>> null >= 0
=> true
>>> 1 + "a"
PHP warning:  A non-numeric value encountered on line 1
>>> 1 + '1'
=> 2
```

## show source

```
>>> list --methods Grav\Common\Grav
Class Methods: __call, __construct, extend, factory, fallbackUrl, fireEvent, header, instance, keys, offsetExists, offsetGet, offsetSet, offsetUnset, process, protect, raw, redirect, redirectLangSafe, register, resetInstance, setLocale, shutdown
>>> show Grav\Common\Grav::fireEvent
  > 272|     public function fireEvent($eventName, Event $event = null)
    273|     {
	***|         [...]
    278|     }
```

## inspect an instance

```
>>> use Grav\Common\User\User
=> null
>>> $user = new User()
=> Grav\Common\User\User {#361}
>>> show $user
  >  17| class User extends Data
     18| {
	***|         [...]
     55| }
>>> list $user --methods
Class Methods: __construct, __get, __isset, __set, __unset, authenticate, authorise, authorize, blueprints, count, def, exists, extra, file, filter, find, get, getDefaults, getJoined, join, joinDefaults, load, merge, offsetExists, offsetGet, offsetSet, offsetUnset, raw, remove, save, set, setDefaults, toArray, toJson, toYaml, undef, validate, value

```

## redneck testing

```psysh
>>> $grav_core = new Grav();
=> Grav\Common\Grav {#394}
>>> list $grav_core --methods
Class Methods: __call, __construct, extend, factory, fallbackUrl, fireEvent, header, instance, keys, offsetExists, offsetGet, offsetSet, offsetUnset, process, protect, raw, redirect, redirectLangSafe, register, resetInstance, setLocale, shutdown
>>> $grav_core->resetInstance();
=> null
>>> $grav_core->shutdown();
InvalidArgumentException with message 'Identifier "config" is not defined.'
```

## read PHP doc

```
>>> doc array_reverse
function array_reverse($input, $preserve_keys = unknown)

Description:
  Return an array with elements in reverse order
  Takes an input $array and returns a new array with the order of the elements reversed.

Param:
  array  $array          The input array.
  bool   $preserve_keys  If set to TRUE numeric keys are preserved.  Non-numeric keys are not
                         affected by this setting and will always be preserved.

Return:
  array  Returns the reversed array.

See Also:
   * array_flip()

```

# Attribution

This plugin include the PsySH executable created and maintained by Justin Hileman at [github.com/bobthecow/psysh](https://github.com/bobthecow/psysh)
