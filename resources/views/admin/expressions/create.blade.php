@extends('layouts.app')

@section('title', 'Neuen Dialektausdruck erstellen')

@section('content')
<h1>Neuen Dialektausdruck erstellen</h1>

<form action="{{ route('admin.expressions.store') }}" method="POST">
    @csrf
    
    <div class="form-spacing">
        <label for="letter">Anfangsbuchstabe *</label>
        <select id="letter" name="letter" required>
            <option value="">Bitte wählen</option>
            @foreach($letters as $letter)
                <option value="{{ $letter }}" {{ old('letter') == $letter ? 'selected' : '' }}>
                    {{ $letter }}
                </option>
            @endforeach
        </select>
        @error('letter')
            <small style="color: var(--del-color)">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-spacing">
        <label for="dialect_word">Dialekt-Wort *</label>
        <input type="text" id="dialect_word" name="dialect_word" value="{{ old('dialect_word') }}" required>
        @error('dialect_word')
            <small style="color: var(--del-color)">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-spacing">
        <label for="german_translation">Deutsche Übersetzung *</label>
        <input type="text" id="german_translation" name="german_translation" value="{{ old('german_translation') }}" required>
        @error('german_translation')
            <small style="color: var(--del-color)">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-spacing">
        <label for="example_sentence">Beispielsatz (optional)</label>
        <textarea id="example_sentence" name="example_sentence" rows="3" placeholder="Optional: Ein Beispielsatz, der den Dialektausdruck verwendet...">{{ old('example_sentence') }}</textarea>
    </div>

    <div class="form-spacing">
        <label for="region">Region in Hessen (optional)</label>
        <input type="text" id="region" name="region" value="{{ old('region') }}" placeholder="z.B. Nordhessen, Rhein-Main, Odenwald...">
    </div>

    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
        <button type="submit" class="primary">Speichern</button>
        <a href="{{ route('admin.expressions.index') }}" role="button" class="secondary">Abbrechen</a>
    </div>
</form>
@endsection