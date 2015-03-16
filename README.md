# Crumbs
Framework agnostic breadcrumb container

The Container
-------------

All breadcrumbs are held in a **Container** class. This allows you to prepare and render a set of breadcrumbs. A container has two dependencies. A `Contracts\Crumb` instance, and a `Contracts\Renderer` instance. We provide basic ones in the repository to be used

```php
$container = new Coreplex\Crumbs\Container(new Coreplex\Crumbs\Components\Crumb, new Coreplex\Crumbs\Renderers\Basic);
```

To add a few breadcrumbs to the container, you can either use the `append` method directly, like so

```php
$container->append('Homepage', '/home');
```

Or you can use a closure to group them into their own scope. To do this, just call the `prepare` method and use any of the container functions on the passed instance

```php
$container->prepare(function($crumbs)
{
    $crumbs->append('Homepage', '/home')
           ->append('Edit');
});
```

To add a breadcrumb to the start of the container rather than the end, use the alternative `prepend` method

```php
$container->prepend('The Website', '/');
```

Rendering The Breadcrumbs
-------------------------

The basic renderer provided will return a simple list-based navigation string. This can be invoked through the main container class by just calling the `render` method.

```php
$container->render();
```

The render method causes the last breadcrumb to be active by default. To disable this behaviour, pass false as the first parameter when calling render.

```php
$container->render(false);
```

Planned Features
----------------

- Laravel 4/5 Integration
- Travis integration