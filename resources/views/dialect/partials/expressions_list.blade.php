@foreach($expressions as $expression)
<tr>
    <td data-label="Buchstabe">
        <span class="cell-content"><strong>{{ $expression->letter }}</strong></span>
    </td>
    <td data-label="Dialekt-Wort">
        <span class="cell-content">{{ $expression->dialect_word }}</span>
        @if($expression->example_sentence)
        <p class="expression-example" style="margin-top: 0.5rem; margin-bottom: 0;">
            "{{ $expression->example_sentence }}"
        </p>
        @endif
    </td>
    <td data-label="Übersetzung">
        <span class="cell-content">{{ $expression->german_translation }}</span>
    </td>
   {{--  <td data-label="Region">
        <span class="cell-content">{{ $expression->region ?? '-' }}</span>
    </td> --}}
</tr>
@endforeach