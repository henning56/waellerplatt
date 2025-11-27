@extends('layouts.app')

@section('title', 'Dialektausdrücke verwalten')

@section('content')
<h1>Dialektausdrücke verwalten</h1>

<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.expressions.create') }}" role="button" class="primary">Neuer Ausdruck</a>
</div>

@if($expressions->count() > 0)
    <table role="grid">
        <thead>
            <tr>
                <th scope="col">Buchstabe</th>
                <th scope="col">Dialekt-Wort</th>
                <th scope="col">Deutsche Übersetzung</th>
                {{-- <th scope="col">Region</th> --}}
                <th scope="col">Aktionen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expressions as $expression)
            <tr>
                <td data-label="Buchstabe"><strong>{{ $expression->letter }}</strong></td>
                <td data-label="Dialekt-Wort">{{ $expression->dialect_word }}</td>
                <td data-label="Deutsche Übersetzung">{{ $expression->german_translation }}</td>
                {{-- <td data-label="Region">{{ $expression->region ?? '-' }}</td> --}}
                <td data-label="Aktionen">
                    <div class="table-actions">
                        <a href="{{ route('admin.expressions.edit', $expression) }}" role="button" class="secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                            Bearbeiten
                        </a>
                        <form action="{{ route('admin.expressions.destroy', $expression) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="contrast" onclick="return confirm('Wirklich löschen?')" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
                                Löschen
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <nav style="margin-top: 2rem;">
        {{ $expressions->links('vendor.pagination.simple') }}
    </nav>
@else
    <article style="text-align: center; padding: 2rem;">
        <p>Noch keine Dialektausdrücke vorhanden.</p>
        <a href="{{ route('admin.expressions.create') }}" role="button" class="primary">Ersten Ausdruck erstellen</a>
    </article>
@endif
@endsection