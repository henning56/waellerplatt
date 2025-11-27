@extends('layouts.app')

@section('title', $expression->dialect_word)

@section('content')
<h1>{{ $expression->dialect_word }}</h1>

<article class="card">
    <div style="display: grid; grid-template-columns: auto 1fr; gap: 1rem; align-items: start;">
        <div><strong>Buchstabe:</strong></div>
        <div>{{ $expression->letter }}</div>

        <div><strong>Dialekt-Wort:</strong></div>
        <div>{{ $expression->dialect_word }}</div>

        <div><strong>Deutsche Übersetzung:</strong></div>
        <div>{{ $expression->german_translation }}</div>

        @if($expression->example_sentence)
            <div><strong>Beispielsatz:</strong></div>
            <div><em>"{{ $expression->example_sentence }}"</em></div>
        @endif

        @if($expression->region)
            <div><strong>Region:</strong></div>
            <div>{{ $expression->region }}</div>
        @endif
    </div>
</article>

<div style="display: flex; gap: 1rem; margin-top: 2rem;">
    <a href="{{ route('admin.expressions.edit', $expression) }}" role="button" class="secondary">Bearbeiten</a>
    <a href="{{ route('admin.expressions.index') }}" role="button" class="contrast">Zurück zur Übersicht</a>
</div>
@endsection