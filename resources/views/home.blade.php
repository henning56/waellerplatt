@extends('layouts.app')

@section('title', 'Wäller Platt ')

@section('content')
<div class="container">
    <article class="hero-section"><h1>Wäller Platt</h1></article>
    
    
    <article>
        <h3> Dialekt - Plattdeutsch - Hörschbeijer Platt</h3>
        <p>
            Woas de heij läse kannst es Platt. Wäller Platt. Su weij's heij stitt öres aus dem kloane Dörfche Hörschbörg. 
            Des lait oom Ostrand voom Westerwaald. Platt wörd net nur do geschwetzt, wu mör den rura Kraas seijt. 
            Warer weg hört sich des owwer annerschder oh. Verstieh dout mör sich trotzdem off'm Waald un em Hennerland.
        </p>

        <div style="display: inline-flex; align-items: center; gap: 0.5rem; margin: 1rem 0;">
            <span>hört oh...</span>
            <button onclick="toggleAudio()" 
                    style="background: var(--primary); color: white; border: none; border-radius: 50%; width: 36px; height: 36px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                ▶
            </button>
            
            <audio id="plattAudio" preload="none" style="display: none;">
                <source src="{{ asset('sounds/platt1.mp3') }}" type="audio/mpeg">
            </audio>
        </div>
    </article>

      <article>
 
  <h3>Die Idee:</h3>
<p>Auf dieser Internetseite soll über den Dialekt des Westerwaldes informiert werden. Für die Einheimischen ist es das &quot;Wäller Platt&quot;. Die Besonderheiten des Dialektes werden erläutert und die Aussprache wird erklärt. Dabei spielen die lokalen Besonderheiten des östlichen Westerwaldes eine besondere Rolle. Trotz aller Gemeinsamkeiten gibt es nicht unerhebliche Unterschiede zwischen den einzelnen Ortschaften. Im Vordergrund dieser Erläuterungen stehen die Ortsteile der Stadt Herborn und besonders des kleinen und auch nicht mehr selbstständigen Dörfchens Hirschberg. Der Aufbau dieser Internetseite dient nicht nur dem Zweck Über den Dialekt zu informieren, sondern durch die multimedialen Möglichkeiten soll der Dialekt auch zu hören sein. Dies ist besonders deswegen von Bedeutung, da die jüngere Generation kaum noch in der Lage ist platt zu reden. </p>

    </article>

   
</div>

<script>
function toggleAudio() {
    const audio = document.getElementById('plattAudio');
    const button = event.target;
    
    if (audio.paused) {
        audio.play();
        button.innerHTML = '❚❚';
    } else {
        audio.pause();
        button.innerHTML = '▶';
    }
    
    // Reset button when audio ends
    audio.addEventListener('ended', function() {
        button.innerHTML = '▶';
    });
}
</script>

@endsection