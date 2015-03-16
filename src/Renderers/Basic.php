<?php namespace Coreplex\Crumbs\Renderers;

use Coreplex\Crumbs\Contracts\Renderer as Contract;
use Coreplex\Crumbs\Contracts\Container;

class Basic implements Contract {

    /**
     * Render the breadcrumbs from the container
     * 
     * @return string
     */
    public function render(Container $container)
    {
        $rendered = '';

        if ($container->count() > 0) {
            $rendered .= '<ul>';

            foreach ($container->getCrumbs() as $crumb) {
                $rendered .= '<li>';

                if ( ! $crumb->isCurrent() && $crumb->hasUrl()) {
                    $rendered .= '<a href="' . $crumb->getUrl() . '">';
                }

                $rendered .= $crumb->hasLabel() ? $crumb->getLabel() : $crumb->getUrl();

                if ( ! $crumb->isCurrent() && $crumb->hasUrl()) {
                    $rendered .= '</a>';
                }

                $rendered .= '</li>';
            }

            $rendered .= '</ul>';
        }

        return $rendered;
    }

}