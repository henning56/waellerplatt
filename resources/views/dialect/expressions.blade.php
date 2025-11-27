@extends('layouts.app')

@section('title', 'Alle Dialekt-Ausdrücke')

@section('content')
<div class="container">
    <!-- Header -->
    <article class="hero-section">
        <h1 class="hero-title">Hessisches Dialekt-Wörterbuch</h1>
        <p class="hero-subtitle">
            Durchsuchen Sie alle {{ \App\Models\DialectExpression::count() }} Dialekt-Ausdrücke - 
            Scrollen Sie nach unten um mehr Einträge zu laden
        </p>
    </article>

    <!-- Buchstaben-Navigation (Quick-Jump) -->
    <article class="content-section">
        <h2 class="section-title">Schnellnavigation nach Buchstaben</h2>
        <div class="letters-grid">
            <a href="{{ route('dialect.expressions') }}" 
               role="button" 
               class="secondary letter-button button-hover {{ !request('letter') ? 'active' : '' }}"
               onclick="scrollToTop()">
                Alle
            </a>
            @foreach($letters as $letter)
                <a href="{{ route('dialect.by-letter', $letter) }}" 
                   role="button" 
                   class="secondary letter-button button-hover {{ request('letter') == $letter ? 'active' : '' }}"
                   onclick="scrollToTop()">
                    {{ $letter }}
                </a>
            @endforeach
        </div>
        
        <!-- Aktive Filter Anzeige -->
        @if(request('letter'))
        <div style="margin-top: 1rem; padding: 0.75rem; background: color-mix(in srgb, var(--primary) 10%, transparent); border-radius: 4px;">
            <strong>Aktiver Filter:</strong> Zeige Ausdrücke mit Buchstabe "{{ request('letter') }}"
            <a href="{{ route('dialect.expressions') }}" style="margin-left: 1rem; color: var(--primary);">× Filter entfernen</a>
        </div>
        @endif
    </article>

    <!-- Ausdrücke Tabelle -->
    <article class="content-section">
        <h2 class="section-title">
            @if(request('letter'))
                Ausdrücke mit Buchstabe "{{ request('letter') }}"
            @else
                Alle Dialekt-Ausdrücke
            @endif
            <small style="font-size: 1rem; color: var(--muted-color); display: block; margin-top: 0.5rem;">
                <span id="loaded-count">{{ $expressions->count() }}</span> von 
                <span id="total-count">
                    @if(request('letter'))
                        {{ \App\Models\DialectExpression::where('letter', request('letter'))->count() }}
                    @else
                        {{ \App\Models\DialectExpression::count() }}
                    @endif
                </span> 
                Einträgen geladen
            </small>
        </h2>

        @if($expressions->count() > 0)
            <table class="expressions-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Buchstabe</th>
                        <th style="width: 30%;">Dialekt-Ausdruck</th>
                        <th style="width: 40%;">Hochdeutsche Übersetzung</th>
                        {{-- <th style="width: 20%;">Region</th> --}}
                    </tr>
                </thead>
                <tbody id="expressions-container">
                    <!-- Initiale Einträge werden hier geladen -->
                    @include('dialect.partials.expressions_list')
                </tbody>
            </table>

            <!-- Loading Indicator -->
            <div id="loading-indicator" style="display: none; text-align: center; padding: 2rem;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--muted-color);">
                    <div class="loading-spinner"></div>
                    <span>Lade weitere Einträge...</span>
                </div>
            </div>

            <!-- End of Content Message -->
            <div id="end-of-content" style="display: none; text-align: center; padding: 2rem; color: var(--muted-color);">
                <div style="background: color-mix(in srgb, var(--primary) 10%, transparent); padding: 1.5rem; border-radius: 8px;">
                    <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">🎉 Alle Einträge wurden geladen!</p>
                    <p style="margin: 0; opacity: 0.8;">
                        @if(request('letter'))
                            Sie haben alle {{ \App\Models\DialectExpression::where('letter', request('letter'))->count() }} 
                            Ausdrücke mit Buchstabe "{{ request('letter') }}" durchsucht.
                        @else
                            Sie haben alle {{ \App\Models\DialectExpression::count() }} Ausdrücke im Wörterbuch durchsucht.
                        @endif
                    </p>
                </div>
            </div>

        @else
            <article style="text-align: center; padding: 2rem;">
                <p>Keine Ausdrücke gefunden.</p>
                <a href="{{ route('dialect.expressions') }}" role="button" class="secondary">
                    Alle Ausdrücke anzeigen
                </a>
            </article>
        @endif
    </article>
</div>

<!-- Infinite Scroll JavaScript -->
<script>
// Infinite Scroll Variablen
let currentPage = 1;
let isLoading = false;
let hasMore = {{ $expressions->hasMorePages() ? 'true' : 'false' }};

console.log('=== INFINITE SCROLL INITIALIZED ===');
console.log('Current page:', currentPage, 'Has more:', hasMore);

/**
 * Lädt weitere Einträge via AJAX
 */
function loadMoreExpressions() {
    if (isLoading || !hasMore) return;
    
    isLoading = true;
    currentPage++;
    
    console.log('Loading page:', currentPage);
    
    const loadingElement = document.getElementById('loading-indicator');
    
    // Loading Indicator anzeigen
    if (loadingElement) loadingElement.style.display = 'block';
    
    // AJAX Request
    fetch(`?page=${currentPage}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP error: ${response.status}`);
        return response.json();
    })
    .then(data => {
        console.log('AJAX response received, hasMore:', data.hasMore);
        
        if (data.html && data.html.trim() !== '') {
            // Neue Einträge zum Container hinzufügen
            const container = document.getElementById('expressions-container');
            container.insertAdjacentHTML('beforeend', data.html);
            
            // Zähler aktualisieren
            const rowCount = container.querySelectorAll('tr').length;
            document.getElementById('loaded-count').textContent = rowCount;
            
            console.log('Added new rows, total now:', rowCount);
        }
        
        hasMore = data.hasMore;
        
        if (!hasMore) {
            document.getElementById('end-of-content').style.display = 'block';
            console.log('All entries loaded');
        }
    })
    .catch(error => {
        console.error('Loading error:', error);
        hasMore = false;
    })
    .finally(() => {
        isLoading = false;
        const loadingElement = document.getElementById('loading-indicator');
        if (loadingElement) loadingElement.style.display = 'none';
    });
}

/**
 * Prüft Scroll-Position und lädt bei Bedarf mehr
 */
function checkScrollPosition() {
    if (isLoading || !hasMore) return;
    
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight;
    const clientHeight = document.documentElement.clientHeight;
    
    // Lade mehr wenn 300px vor Ende der Seite
    if (scrollTop + clientHeight >= scrollHeight - 300) {
        console.log('Scroll trigger - loading more');
        loadMoreExpressions();
    }
}

// Scroll Event Listener
window.addEventListener('scroll', checkScrollPosition);

// Initial prüfen ob schon gescrollt werden muss
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, infinite scroll active');
    
    // Sofort prüfen
    setTimeout(checkScrollPosition, 100);
    
    // Nach 1 Sekunde nochmal prüfen (falls Inhalte langsam laden)
    setTimeout(checkScrollPosition, 1000);
});

/**
 * Scrollt zur Seite oben (für Buchstaben-Links)
 */
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<style>
/* Verbesserte Loading Animation */
.loading-spinner {
    width: 20px;
    height: 20px;
    border: 2px solid var(--muted-color);
    border-top: 2px solid var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Smooth transitions for new rows */
.expressions-table tbody tr {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from { 
        opacity: 0; 
        transform: translateY(10px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* Progress Anzeige */
#loaded-count {
    font-weight: bold;
    color: var(--primary);
}

/* Buchstaben Navigation Verbesserungen */
.letters-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(50px, 1fr));
    gap: 0.5rem;
}

.letter-button.active {
    background: var(--primary) !important;
    color: white !important;
}

/* Responsive Verbesserungen */
@media (max-width: 768px) {
    .letters-grid {
        grid-template-columns: repeat(auto-fit, minmax(45px, 1fr));
    }
    
    .hero-title {
        font-size: 2rem !important;
    }
}
</style>
@endsection