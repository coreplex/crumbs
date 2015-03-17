<?php namespace Coreplex\Crumbs;

use Coreplex\Crumbs\Container;
use Coreplex\Crumbs\Components\Crumb;
use Coreplex\Crumbs\Renderer\Basic as BasicRenderer;
use Coreplex\Crumbs\Contracts\Container as ContainerContract;
use Coreplex\Crumbs\Contracts\Renderer as RendererContract;
use Coreplex\Crumbs\Contracts\Crumb as CrumbContract;
use Illuminate\Support\ServiceProvider;

class CrumbsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('coreplex/crumbs', 'coreplex/crumbs');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // $this->publishConfig();
        $this->registerRenderer();
        $this->registerCrumb();
        $this->registerContainer();
    }

    /**
     * Publishes the config
     * 
     * @return void
     */
    public function publishConfig()
    {
        $this->publishes([
            __DIR__.'/config/crumbs.php' => config_path('crumbs.php'),
        ]);
    }

    /**
     * Register the renderer used by Crumbs.
     * 
     * @return void
     */
    public function registerRenderer()
    {
        $this->app['Coreplex\Crumbs\Contracts\Renderer'] = $this->app->share(function($app)
        {
            return new $app['config']['crumbs']['renderer'];
        });
    }

    /**
     * Register the crumb class used by Crumbs.
     * 
     * @return void
     */
    public function registerCrumb()
    {
        $this->app['Coreplex\Crumbs\Contracts\Crumb'] = $this->app->share(function($app)
        {
            return new $app['config']['crumbs']['crumb'];
        });
    }

    /**
     * Take the components of Crumbs together and build the Container
     * 
     * @return void
     */
    public function registerContainer()
    {
        $this->app['Coreplex\Crumbs\Contracts\Container'] = $this->app->share(function($app)
        {
            $args = [$app['Coreplex\Crumbs\Contracts\Crumb'], $app['Coreplex\Crumbs\Contracts\Renderer']];
            return (new ReflectionClass($app['config']['crumbs']['container']))->newInstanceArgs($args);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'Coreplex\Crumbs\Contracts\Container',
            'Coreplex\Crumbs\Contracts\Crumb',
            'Coreplex\Crumbs\Contracts\Renderer',
        ];
    }

}