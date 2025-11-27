@extends('layouts.app')

@section('title', 'Zum Hirtenfest vom Schulipatt')

@section('content')
<div class="container">
    <article class="hero-section"><h1>Zum Hirtenfest vom Schulipatt</h1></article>
    
    <article style="margin-bottom: 2rem; padding: 1.5rem; background: var(--card-background-color); border-radius: 8px;">
        <p><strong>Von Emma Späth</strong> - Ein Gedicht im hessischen Dialekt mit hochdeutscher Übersetzung</p>
    </article>

    <table role="grid">
        <thead>
            <tr>
                <th scope="col" style="width: 80px;">Audio</th>
                <th scope="col"><strong>Zom Hörtefest vom Schulipatt</strong><br><small>vo Ruhse Emma en Platt</small></th>
                <th scope="col"><strong>Zum Hirtenfest vom Schulipatt</strong><br><small>von Emma Späth in Hochdeutsch</small></th>
            </tr>
        </thead>
        <tbody>
            @foreach($verses as $index => $verse)
            <tr>
                <td>
                    <div class="audio-player" style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;">
                        <!-- Play Button -->
                        <button type="button" class="play-btn" data-audio="{{ asset('sounds/' . $verse['audio']) }}" 
                                style="background: var(--primary); color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer; display: flex; align-items: center; justify-content: center;">
                            ▶
                        </button>
                        
                        <!-- Progress -->
                        <div class="audio-progress" style="width: 100%; background: #ddd; height: 4px; border-radius: 2px; display: none;">
                            <div class="progress-bar" style="width: 0%; height: 100%; background: var(--primary); border-radius: 2px;"></div>
                        </div>
                        
                        <!-- Time Display -->
                        <small class="time-display" style="font-size: 0.7rem; color: var(--muted-color); display: none;">0:00</small>
                    </div>
                    
                    <!-- Hidden Audio Element -->
                    <audio class="audio-element" preload="none" style="display: none;">
                        <source src="{{ asset('sounds/' . $verse['audio']) }}" type="audio/mpeg">
                        Ihr Browser unterstützt das Audio-Element nicht.
                    </audio>
                </td>
                <td style="vertical-align: top;">{!! $verse['dialect'] !!}</td>
                <td style="vertical-align: top;">{!! $verse['translation'] !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Audio Player JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentAudio = null;
    let currentButton = null;
    
    document.querySelectorAll('.play-btn').forEach(button => {
        button.addEventListener('click', function() {
            const audioUrl = this.getAttribute('data-audio');
            const audioElement = this.parentElement.nextElementSibling;
            const progressBar = this.parentElement.querySelector('.progress-bar');
            const progressContainer = this.parentElement.querySelector('.audio-progress');
            const timeDisplay = this.parentElement.querySelector('.time-display');
            
            // Stop current audio if playing
            if (currentAudio && currentAudio !== audioElement) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                if (currentButton) {
                    currentButton.textContent = '▶';
                    currentButton.parentElement.querySelector('.audio-progress').style.display = 'none';
                    currentButton.parentElement.querySelector('.time-display').style.display = 'none';
                }
            }
            
            // Toggle play/pause
            if (audioElement.paused) {
                audioElement.play();
                this.textContent = '❚❚';
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
                    button.textContent = '▶';
                    progressContainer.style.display = 'none';
                    timeDisplay.style.display = 'none';
                    progressBar.style.width = '0%';
                });
                
            } else {
                audioElement.pause();
                this.textContent = '▶';
            }
            
            currentAudio = audioElement;
            currentButton = this;
        });
    });
});
</script>

<style>
.audio-player {
    min-height: 80px;
    justify-content: center;
}

.play-btn:hover {
    opacity: 0.8;
    transform: scale(1.1);
    transition: all 0.2s ease;
}

table {
    border-collapse: collapse;
    width: 100%;
}

table th {
    background: var(--muted-color);
    padding: 1rem;
    text-align: left;
}

table td {
    padding: 1rem;
    border-bottom: 1px solid var(--muted-color);
    vertical-align: top;
}

@media (max-width: 768px) {
    table th:nth-child(1),
    table td:nth-child(1) {
        width: 80px;
    }
    
    .audio-player {
        min-height: 60px;
    }
}
</style>
@endsection