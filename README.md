# Grav PsySH (PHP interactive shell) Plugin

This **PsySH plugin** for [Grav](http://github.com/getgrav/grav) provide a runtime developer console, interactive debugger and REPL for PHP.

Visit [PsySH](http://psysh.org/) homepage for full details.

![](assets/grav-psy-shell.png)

# Enabling plugin

Since this plugin only work from command line, there's no need to enable it in the config.

# Usage

To fire PsySH use `bin/plugin psysh shell`.

Type `help` for a list of commands.

## Examples

### test without var_dump; die;

```
>>> null >= 0
=> true
>>> 1 + "a"
PHP warning:  A non-numeric value encountered on line 1
>>> 1 + '1'
=> 2
```

### show source

```
>>> list --methods Grav\Common\Grav
Class Methods: __call, __construct, extend, factory, fallbackUrl, fireEvent, header, instance, keys, offsetExists, offsetGet, offsetSet, offsetUnset, process, protect, raw, redirect, redirectLangSafe, register, resetInstance, setLocale, shutdown
>>> show Grav\Common\Grav::fireEvent
  > 272|     public function fireEvent($eventName, Event $event = null)
    273|     {
	***|         [...]
    278|     }
```

### inspect an instance

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

### redneck testing

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

### read PHP doc

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

# Future plans

* Interactive debugging from
** inline server (php -S)
** cli scripts
** from any event
* Admin panel

# Attributions

This plugin include the PsySH executable created and maintained by Justin Hileman at [github.com/bobthecow/psysh](https://github.com/bobthecow/psysh)
