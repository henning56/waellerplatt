@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Hero Section -->
    <article class="hero-section">
        <h1 class="hero-title">Hessischer Dialekt Wörterbuch</h1>
        <p class="hero-subtitle">
            Entdecken Sie die faszinierende Welt des hessischen Dialekts mit über 500 Ausdrücken und Redewendungen.
        </p>
        <a href="{{ route('dialect.expressions') }}" 
           role="button" 
           class="hero-button button-hover">
            Alle Ausdrücke anzeigen
        </a>
    </article>

    <!-- Buchstaben-Navigation -->
    <article class="content-section">
        <h2 class="section-title">Nach Buchstaben durchsuchen</h2>
        <div class="letters-grid">
            @foreach($letters as $letter)
                <a href="{{ route('dialect.by-letter', $letter) }}" 
                   role="button" 
                   class="secondary letter-button button-hover">
                    {{ $letter }}
                </a>
            @endforeach
        </div>
    </article>

    <!-- Beispiel-Ausdrücke -->
    <article class="content-section">
        <h2 class="section-title">Beliebte Dialekt-Ausdrücke</h2>
        
        <div class="expressions-grid">
            @foreach($expressions as $expression)
            <div class="expression-card">
                <h3 class="expression-word">{{ $expression->dialect_word }}</h3>
                <p class="expression-translation">{{ $expression->german_translation }}</p>
                @if($expression->example_sentence)
                <p class="expression-example">"{{ $expression->example_sentence }}"</p>
                @endif
            </div>
            @endforeach
        </div>
        
        @if($expressions->count() > 0)
        <a href="{{ route('dialect.expressions') }}" class="more-link">
            Alle {{ $expressions->count() }}+ Ausdrücke anzeigen →
        </a>
        @endif
    </article>
</div>
@endsection