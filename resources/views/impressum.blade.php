@extends('layouts.app')

@section('title', 'Wäller Platt Impressum')

@section('content')
    <div class="container">
        <article class="hero-section">
            <h1>Wäller Platt - Impressum</h1>
        </article>



        <article>



            <h3>Über mich :</h3>

            <p class="block">Diese Seite wurde erstellt von:<br>
                <strong>Hermann Mueller</strong><br>
                Voltastr. 63<br>
                28357 BREMEN <br>
                E-mail: Mueller.Hermann(at)web.de
            </p>
            <p>&nbsp;</p>
            <p>Besonderer Dank gilt Herrn Rainer Nöllge aus Schönbach, von dem die Wortliste stammt. Herr Nöllge ist 2012 verstorben. Er hat  zur
                Sprache und zur Küche des Westerwaldes mehrere Büchlein veröffentlicht. <a href="#" onclick="openPdfModal(event, '{{ asset('images/RainerNöllge.pdf') }}')">Mehr</a>
                

            <p>Das Redesign meiner Seite wurde von <a title="Öffnet einem Link zu koch-henning.de in einem neuen Fenster"
                    target="_blank" href="http://www.koch-henning.de">Henning Koch</a> bewerkstelligt</p>

        <!-- PDF Modal -->
        <dialog id="pdfModal">
            <article>
                <header>
                    <button aria-label="Close" rel="prev" onclick="document.getElementById('pdfModal').close()"></button>
                    <h3>Rainer Nöllge</h3>
                </header>
                <iframe id="pdfFrame" style="width: 100%; height: 70vh; border: none;"></iframe>
            </article>
        </dialog>

        <script>
            function openPdfModal(event, pdfUrl) {
                event.preventDefault();
                const modal = document.getElementById('pdfModal');
                const iframe = document.getElementById('pdfFrame');
                iframe.src = pdfUrl;
                modal.showModal();
            }
        </script>


        </article>
       
    </div>

@endsection