@if($container->count() > 0)
<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
    @foreach($container->getCrumbs() as $key=>$crumb)
        <li @if($crumb->isCurrent()) class="active" @endif itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            @if( ! $crumb->isCurrent() && $crumb->hasUrl())
                <a itemscope itemtype="http://schema.org/Thing"
                   itemprop="item" href="{{ $crumb->getUrl() }}"><span itemprop="name">{!! $crumb->hasLabel() ? $crumb->getLabel() : $crumb->getUrl() !!}</span></a>
            @else
                <span itemprop="name">{!! $crumb->hasLabel() ? $crumb->getLabel() : $crumb->getUrl() !!}</span>
            @endif
                <meta itemprop="position" content="{{ $key + 1 }}" />
        </li>
    @endforeach
</ol>
@endif
