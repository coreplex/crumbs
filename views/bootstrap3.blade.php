@if($container->count() > 0)
<ol class="breadcrumb">
    @foreach($container->getCrumbs() as $crumb)
        <li @if($crumb->isCurrent()) class="active" @endif >
            @if( ! $crumb->isCurrent() && $crumb->hasUrl())
                <a href="{{ $crumb->getUrl() }}">{!! $crumb->hasLabel() ? $crumb->getLabel() : $crumb->getUrl() !!}</a>
            @else
                {!! $crumb->hasLabel() ? $crumb->getLabel() : $crumb->getUrl() !!}
            @endif
        </li>
    @endforeach
</ol>
@endif