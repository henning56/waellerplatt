@extends('layouts.app')

@section('title', 'Hessische Kinderreime')

@section('content')
<div class="container">
    <!-- Header -->
    <article class="hero-section">
        <h1 class="hero-title">Kinderreime im Wäller Platt</h1>
        <p class="hero-subtitle">
            Traditionelle Kinderreime im Wäller Platt - zum Lesen und Anhören
        </p>
    </article>

    <!-- Einleitung -->
    <article class="content-section">
        <p class="block">
            In den folgenden Abschnitten finden Sie verschiedene Kinderreime, die man sich auch anhören kann.<br>
            Diese Kinderreime wurden (bzw. werden nur noch selten) kleinen Kindern vorgesungen oder vorgesprochen, 
            z. T. auch unter Beteiligung des Kindes.
        </p>
    </article>

    <!-- Reime Liste -->
    <div class="rhymes-container">
        <!-- Haale, haale Horn -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme1')">
                <h4 class="rhyme-title">... <strong>Haale, haale Horn</strong> ...</h4>
            </button>
            <div id="rhyme1" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Haale, haale Horn,</p>
                    <p>wenn's hau net haalt, haalt's morn,</p>
                    <p>wenn's morn net haalt, haalt's üwwermorn,</p>
                    <p>haale, haale Horn.</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/haale.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/haale.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme1')">...schließen</button>
            </div>
        </article>

        <!-- Haia bum baia -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme2')">
                <h4 class="rhyme-title">... <strong>Haia bum baia</strong> ...</h4>
            </button>
            <div id="rhyme2" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Haia bum baia schloo's Giggelche duud,</p>
                    <p>legt m'r koa Aijer un frisst m'r mai Bruud,</p>
                    <p>robbe m'r em Giggelche Fä'ärncher aus,</p>
                    <p>un mache em Kendche (Name) e Bettche doo draus.</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/Haia.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/Haia.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme2')">...schließen</button>
            </div>
        </article>

        <!-- Haile, haile Gäns'che -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme3')">
                <h4 class="rhyme-title">... <strong>Haile, haile Gäns'che</strong> ...</h4>
            </button>
            <div id="rhyme3" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Haile, haile Gäns'che,</p>
                    <p>'s wörd baal wö'er gout,</p>
                    <p>'s Kätzche hoat e' Schwänz'che,</p>
                    <p>'s wörd baal wö'er gout,</p>
                    <p>haile, haile Mausespeck,</p>
                    <p>en hunnert Juhrn es alles weg.</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/haile.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/haile.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme3')">...schließen</button>
            </div>
        </article>

        <!-- Hole, hole, hole -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme4')">
                <h4 class="rhyme-title">... <strong>Hole, hole, hole</strong> ...</h4>
            </button>
            <div id="rhyme4" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Hole, hole, hole</p>
                    <p>Zuckerche wolle m'r hole,</p>
                    <p>Zucker Rosin' un Mandelkern</p>
                    <p>ess alle Kenner gern</p>
                    <p>&nbsp;</p>
                    <p class="anm">(Alternativ: isst uus (Name) suu gern)</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/Hohle.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/Hohle.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme4')">...schließen</button>
            </div>
        </article>

        <!-- Mäus'che, Mäus'che, Maus -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme5')">
                <h4 class="rhyme-title">... <strong>Mäus'che, Mäus'che, Maus</strong> ...</h4>
            </button>
            <div id="rhyme5" class="rhyme-content" style="display: none;">
                <p class="block">
                    Der folgende Reim wird so vorgetragen, dass Redner und Zuhörer die Hände übereinander legen 
                    und bei jeder Zeile die unterste Hand hervorziehen und obenauf legen. 
                    Mit der letzten Zeile ist ein allgemeines Händedurcheinander verbunden:
                </p>
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Mäus'che, Mäus'che, Maus.</p>
                    <p>Wu es de Maus? Em aale Haus.</p>
                    <p>Wu örresch aalt Haus? Abgebrannt.</p>
                    <p>Wumit? Mit Fauer.</p>
                    <p>Wu örresch Fauer? Ausgelöscht.</p>
                    <p>Wumit? Mit Wasser.</p>
                    <p>Wu örresch Wasser? De Ochs hoat's gesoffe.</p>
                    <p>Wu es de Ochs? Em grüne Wald.</p>
                    <p>Wu es de Wald? Abgehaache.</p>
                    <p>Wumit? Mit de Ax.</p>
                    <p>Wu es de Ax? Baim Schmidt.</p>
                    <p>Woas saat de Schmidt???</p>
                    <p>"Als immer droff, als immer droff...</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/Maus.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/Maus.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme5')">...schließen</button>
            </div>
        </article>

        <!-- Weitere Reime hier einfügen... -->
        <!-- Rombel de bombel, Schloof Kendche schloof, Tross tross trill, Wai o wai mai Hees'che, Wejvill Giggel sai em Dorf -->
        <!-- Rombel de bombel -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme6')">
                <h4 class="rhyme-title">... <strong>Rombel de bombel</strong> ...</h4>
            </button>
            <div id="rhyme6" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Rombel de bombel de aale Kaste</p>
                    <p class="anm">(Ein Kind beugt sich vor und ein zweites lässt währenddessen die Faust auf dem Rücken kreisen.)</p>
                    <p>Woasfier Fenger stieh?</p>
                    <p class="anm">(Bestimmte Finger werden mit der Kuppe auf den Rücken gestellt. Diese Finger müssen geraten werden. Richtig geraten: Das andere Kind ist dran. Falsch geraten:)</p>
                    <p>Häste gesaat de Middelfenger <span class="anm">(z. B.)</span>, wörscht de net gerombelt worrn.</p>
                    <p>Rombel de bombel...</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/Rombel.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/Rombel.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme6')">...schließen</button>
            </div>
        </article>

        <!-- Schloof, Kendche schloof -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme7')">
                <h4 class="rhyme-title">... <strong>Schloof, Kendche schloof</strong> ...</h4>
            </button>
            <div id="rhyme7" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Schloof, Kendche schloof,</p>
                    <p>doo oowe gieh de Schoof,</p>
                    <p>doo oowe gieh de Limmercher,</p>
                    <p>fresse Groas un Blimmercher,</p>
                    <p>fresse ganze Kerbcher voll,</p>
                    <p>des mai Kendche (Name) schloofe soll</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/schloof.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/schloof.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme7')">...schließen</button>
            </div>
        </article>

        <!-- Tross, tross, trill -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme8')">
                <h4 class="rhyme-title">... <strong>Tross, tross, trill</strong> ...</h4>
            </button>
            <div id="rhyme8" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Tross, tross trill, de Bauer hoat e Fill.</p>
                    <p>'s Fillche will net laafe, de Bauer will's verkaafe.</p>
                    <p>Verkaafe will's de Bauer, 's Lääwe wörd em sauer.</p>
                    <p>Sauer wörd em 's Lääwe, der Weinstock, der trägt Reewe.</p>
                    <p>Reewe trägt der Weinstock, Herner hoat d'r Gaasebock.</p>
                    <p>De Gaasebock hoat Herner, im Walde wachsen Dörner.</p>
                    <p>Dörner wachsen im Walde, im Winter ist es kalde.</p>
                    <p>Kalde ist's im Winter, da friert's die kleinen Kinder.</p>
                    <p>Die kleinen Kinder friert's, und wer's nicht glaubt, probiert's.</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/tross.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/tross.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme8')">...schließen</button>
            </div>
        </article>

        <!-- Wai o wai, mai Hees'che -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme9')">
                <h4 class="rhyme-title">... <strong>Wai o wai, mai Hees'che</strong> ...</h4>
            </button>
            <div id="rhyme9" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Wai o wai, mai Hees'che,</p>
                    <p>'s Hees'che wait drai Pond.</p>
                    <p>Un wenn es dej net waije dout,</p>
                    <p>doa örres net gesond.</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/heesche.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/heesche.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme9')">...schließen</button>
            </div>
        </article>

        <!-- Wejvill Giggel sai em Dorf -->
        <article class="rhyme-card content-section">
            <button class="rhyme-toggle" onclick="toggleRhyme('rhyme10')">
                <h4 class="rhyme-title">... <strong>Wejvill Giggel sai em Dorf</strong> ...</h4>
            </button>
            <div id="rhyme10" class="rhyme-content" style="display: none;">
                <blockquote>
                    <p class="quote">&nbsp;</p>
                    <p>Wejvill Giggel sai em Dorf?</p>
                    <p>Zwiiiie...</p>
                    <p>Loss mai Noas giiiiieh....</p>
                    <p>&nbsp;</p>
                    <p class="anm">Owwer:</p>
                    <p>Wejvill Giggel sai em Dorf?</p>
                    <p>Oans, zwoo, drai,</p>
                    <p>loss mai Noas frai.</p>
                    <p>&nbsp;</p>
                    <p class="anm">(Dem Kind wird mit den Fingern die Nase gehalten).</p>
                    <p class="unquote">&nbsp;</p>
                    
                    <div class="audio-player">
                        <button class="play-btn" data-audio="{{ asset('sounds/giggel.mp3') }}">
                            ▶ Reim anhören
                        </button>
                        <div class="audio-progress" style="display: none;">
                            <div class="progress-bar"></div>
                        </div>
                        <small class="time-display" style="display: none;">0:00</small>
                        <audio class="audio-element" preload="none">
                            <source src="{{ asset('sounds/giggel.mp3') }}" type="audio/mpeg">
                        </audio>
                    </div>
                </blockquote>
                <button class="close-btn" onclick="toggleRhyme('rhyme10')">...schließen</button>
            </div>
        </article>
    </div>
</div>

<style>
.rhymes-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.rhyme-card {
    padding: 0;
    overflow: hidden;
}

.rhyme-toggle {
    width: 100%;
    background: none;
    border: none;
    text-align: left;
    padding: 1.5rem;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.rhyme-toggle:hover {
    background: color-mix(in srgb, var(--primary) 5%, transparent);
}

.rhyme-title {
    margin: 0;
    color: var(--primary);
    font-size: 1.25rem;
}

.rhyme-content {
    padding: 0 1.5rem 1.5rem 1.5rem;
    border-top: 1px solid var(--muted-color);
}

.rhyme-content blockquote {
    margin: 1rem 0;
    padding: 0;
    border-left: 4px solid var(--primary);
    padding-left: 1rem;
}

.quote, .unquote {
    margin: 0.5rem 0;
}

.anm {
    font-style: italic;
    color: var(--muted-color);
    font-size: 0.875rem;
}

.close-btn {
    background: var(--muted-color);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 1rem;
}

.close-btn:hover {
    opacity: 0.8;
}

/* Audio Player Styles */
.audio-player {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
    margin: 1rem 0;
}

.play-btn {
    background: var(--primary);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
}

.play-btn:hover {
    opacity: 0.9;
}

.audio-progress {
    width: 100%;
    background: #ddd;
    height: 6px;
    border-radius: 3px;
}

.progress-bar {
    width: 0%;
    height: 100%;
    background: var(--primary);
    border-radius: 3px;
    transition: width 0.1s linear;
}

.time-display {
    font-size: 0.875rem;
    color: var(--muted-color);
}

/* Responsive */
@media (max-width: 768px) {
    .rhyme-toggle {
        padding: 1rem;
    }
    
    .rhyme-content {
        padding: 0 1rem 1rem 1rem;
    }
    
    .play-btn {
        width: 100%;
        text-align: center;
    }
}
</style>

<script>
// Toggle-Funktion für Reime
function toggleRhyme(rhymeId) {
    const element = document.getElementById(rhymeId);
    if (element.style.display === 'none') {
        element.style.display = 'block';
    } else {
        element.style.display = 'none';
        
        // Audio stoppen wenn geschlossen
        const audio = element.querySelector('.audio-element');
        const button = element.querySelector('.play-btn');
        const progress = element.querySelector('.audio-progress');
        const timeDisplay = element.querySelector('.time-display');
        
        if (audio) {
            audio.pause();
            audio.currentTime = 0;
        }
        if (button) button.textContent = '▶ Reim anhören';
        if (progress) progress.style.display = 'none';
        if (timeDisplay) timeDisplay.style.display = 'none';
    }
}

// Audio Player Funktionen
document.addEventListener('DOMContentLoaded', function() {
    let currentAudio = null;
    let currentButton = null;
    
    document.querySelectorAll('.play-btn').forEach(button => {
        button.addEventListener('click', function() {
            const audioElement = this.parentElement.querySelector('.audio-element');
            const progressBar = this.parentElement.querySelector('.progress-bar');
            const progressContainer = this.parentElement.querySelector('.audio-progress');
            const timeDisplay = this.parentElement.querySelector('.time-display');
            
            // Stop current audio if playing
            if (currentAudio && currentAudio !== audioElement) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                if (currentButton) {
                    currentButton.textContent = '▶ Reim anhören';
                    currentButton.parentElement.querySelector('.audio-progress').style.display = 'none';
                    currentButton.parentElement.querySelector('.time-display').style.display = 'none';
                }
            }
            
            // Toggle play/pause
            if (audioElement.paused) {
                audioElement.play();
                this.textContent = '❚❚ Pausieren';
                progressContainer.style.display = 'block';
                timeDisplay.style.display = 'block';
                
                // Update progress bar
                audioElement.addEventListener('timeupdate', function() {
                    const progress = (audioElement.currentTime / audioElement.duration) * 100;
                    progressBar.style.width = progress + '%';
                    
                    // Format time display
                    const currentMinutes = Math.floor(audioElement.currentTime / 60);
                    const currentSeconds = Math.floor(audioElement.currentTime % 60);
                    const durationMinutes = Math.floor(audioElement.duration / 60);
                    const durationSeconds = Math.floor(audioElement.duration % 60);
                    
                    timeDisplay.textContent = 
                        currentMinutes + ':' + (currentSeconds < 10 ? '0' : '') + currentSeconds + ' / ' +
                        durationMinutes + ':' + (durationSeconds < 10 ? '0' : '') + durationSeconds;
                });
                
                // Reset when finished
                audioElement.addEventListener('ended', function() {
                    button.textContent = '▶ Reim anhören';
                    progressContainer.style.display = 'none';
                    timeDisplay.style.display = 'none';
                    progressBar.style.width = '0%';
                });
                
            } else {
                audioElement.pause();
                this.textContent = '▶ Reim anhören';
            }
            
            currentAudio = audioElement;
            currentButton = this;
        });
    });
});
</script>
@endsection