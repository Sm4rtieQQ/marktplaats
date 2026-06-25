@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex gap-2 items-center">

    @if (!$paginator->onFirstPage())
    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-submit text-sm">
        Vorige pagina
    </a>
    @endif

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-submit text-sm">
        Volgende pagina
    </a>
    @endif

</nav>
@endif