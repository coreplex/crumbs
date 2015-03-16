<?php namespace Coreplex\Crumbs\Renderers;

use Coreplex\Crumbs\Contracts\Renderer;
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

                if ( ! $crumb->isCurrent()) {
                    $rendered .= '<a href="' . $crumb->getUrl() . '">'
                }

                $rendered .= $crumb->getLabel();

                if ( ! $crumb->isCurrent()) {
                    $rendered .= '</a>';
                }

                $rendered .= '</li>';
            }

            $rendered .= '</ul>';
        }

        return $rendered;
    }

}