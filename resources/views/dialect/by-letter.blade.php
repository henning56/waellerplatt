@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dialekt-Ausdrücke mit {{ $letter }}</h1>
        <p class="text-gray-600">
            <a href="{{ route('dialect.expressions') }}" class="text-green-600 hover:text-green-800">
                ← Zurück zur Übersicht
            </a>
        </p>
    </div>

    <!-- Buchstaben-Navigation -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Andere Buchstaben</h2>
        <div class="flex flex-wrap gap-2">
            @foreach($letters as $l)
                <a href="{{ route('dialect.by-letter', $l) }}" 
                   class="px-4 py-2 rounded-lg font-semibold transition 
                          {{ $l == $letter ? 'bg-green-600 text-white' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                    {{ $l }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Ausdrücke für diesen Buchstaben -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Hessischer Dialekt
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Hochdeutsche Übersetzung
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($expressions as $expression)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $expression->dialect_word }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-700">
                                {{ $expression->german_translation }}
                            </div>
                            @if($expression->example_sentence)
                            <div class="text-sm text-gray-500 italic mt-1">
                                "{{ $expression->example_sentence }}"
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                            Keine Ausdrücke mit dem Buchstaben {{ $letter }} gefunden.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection