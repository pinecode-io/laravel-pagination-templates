<?php
   // If the last page of paginator is greater than our number of tabs, set number of tabs to equal the number of last page.
   if($paginator->lastPage() < $tabs) {
      $tabs = $paginator->lastPage();
   }
   // Get the number of current tabs halved. If value is odd then subtract 1.
   $t = (floor($tabs / 2) % 2 == 0) ? floor($tabs / 2) - 1 : floor($tabs / 2);
?>
<nav>
   <ul class="pagination">
      <!-- Create a tab for 'previous'. If we are on the first page then disable this tab. -->
      @if($paginator->currentPage() == 1)
         <li class="{{ ($paginator->currentPage() == 1) ? 'disabled' : '' }}">Previous</li>
      @else
         <li><a href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
      @endif
      <!-- If we are on the first page, for this page plus number of tabs, create a tab. -->
      @if($paginator->currentPage() == 1)
         @for($i = $paginator->currentPage(); $i < ($paginator->currentPage() + $tabs); $i++)
            @if($paginator->currentPage() == $i )
               <li class="current">{{ $i }}</li>
            @else
               <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
         @endfor
      <!-- If current page take half the tabs is smaller or equals 0, start on page 1. -->
      @elseif(($paginator->currentPage() - floor($tabs / 2)) <= 0)
         @for($i = 1; $i < (1 + $tabs); $i++)
            @if($paginator->currentPage() == $i )
               <li class="current">{{ $i }}</li>
            @else
               <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
         @endfor
      <!-- If the current page plus half of the tabs is greater than or equal to the last page, we want to prevent pages that do not exist from being printed. -->
      @elseif(($paginator->currentPage() + $t) >= $paginator->lastPage())
         @for($i = ($paginator->lastPage() - $tabs) + 1; $i <= ($paginator->lastPage()); $i++)
            @if($paginator->currentPage() == $i )
               <li class="current">{{ $i }}</li>
            @else
               <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
         @endfor
      <!-- If the current page plus half of the tabs is smaller than the last page, we want to try and place the current active page right in the center of the pagination bar. This will catch most use cases. -->
      @elseif(($paginator->currentPage() + $t) < $paginator->lastPage())
         @for($i = $paginator->currentPage() - floor($tabs / 2); $i <= ($paginator->currentPage() + floor($tabs / 2)); $i++)
            @if($paginator->currentPage() == $i )
               <li class="current">{{ $i }}</li>
            @else
               <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
         @endfor
      @endif
      <!-- Create a tab for 'next'. If we are on the last page then disable this tab. -->
      @if($paginator->hasMorePages() == NULL)
         <li class="disabled">Next</li>

      @else
         <li><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
      @endif
   </ul>
</nav>
