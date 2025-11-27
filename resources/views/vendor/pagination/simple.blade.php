@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination">
        <ul style="display: flex; gap: 1rem; list-style: none; padding: 0; justify-content: center;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true">
                    <span style="color: var(--muted-color); cursor: not-allowed;">← Zurück</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">← Zurück</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">Weiter →</a>
                </li>
            @else
                <li aria-disabled="true">
                    <span style="color: var(--muted-color); cursor: not-allowed;">Weiter →</span>
                </li>
            @endif
        </ul>
    </nav>
@endif