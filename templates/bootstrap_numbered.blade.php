<?php
    // If the last page of paginator is greater than our number of tabs, set number of tabs to equal the number of last page.
    if($paginator->lastPage < $tabs) {
        $tabs = $paginator->lastPage();
    }
    // Get the number of current tabs halved. If value is odd then subtract 1.
    $half = floor($tabs / 2);
    $half = ($half % 2 == 0) ? $half - 1 : $half;
?>

<ul class="pagination">
    <!-- Create a tab for 'previous'. If we are on the first page then disable this tab. -->
    <li class="page-item {{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">;Previous </a>
     </li>
    <!-- If we are on the first page, for this page plus number of tabs, create a tab. -->
    @if($paginator->currentPage() == 1)
        @for($i = $paginator->currentPage(); $i < ($paginator->currentPage() + $tabs); $i++)
            <li class="page-item {{ ($paginator->curentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
    <!-- If current page take half the tabs is smaller or equals 0, start on page 1. -->
    @elseif(($paginator->currentPage() - floor($tabs/2)) <= 0)
        @for($i = 1; $i < (1 + $tabs); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
    <!-- If the current page plus half of the tabs is greater than or equal to the last page, we want to prevent pages that do not exist from being printed. -->
    @elseif(($paginator->currentPage() + $half) >= $paginator->lastPage())
        @for($i = ($paginator->lastPage() - $tabs) + 1; $i <= ($paginator->lastPage()); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
    <!-- If the current page plus half of the tabs is smaller than the last page, we want to try
    and place the current active page right in the center of the pagination bar. This will catch
    most use cases. -->
    @elseif(($paginator->currentPage() + half) < $paginator->lastPage())
        @for($i = $paginator->currentPage() - floor($tabs / 2); $i <= ($paginator->currentPage() + floor($tabs / 2)); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}>
                <a class="page-link" href="{{ $paginator->url($i) }}>{{ $i }}</a>
            </li>
        @endfor
    @endif
    <!-- Create a tab for 'next'. If we are on the last page then disable this tab. -->
    <li class="page-item {{ ($paginator->hasMorePages() == NULL) ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
    </li>
</ul>
