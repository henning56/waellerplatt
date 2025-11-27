<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        // If a controller/view provided a $meta array use it, otherwise build a minimal one
        $meta = $meta ?? [];
        if (empty($meta['title'])) {
            $titleFromSection = trim($__env->yieldContent('title'));
            if (!empty($titleFromSection)) {
                $meta['title'] = $titleFromSection . ' – ' . config('app.name');
            }
        }
    @endphp

    @include('partials.seo')

    <!-- Pico.css -->
    <link rel="stylesheet" href="{{ asset('css/pico.lime.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    <!-- Nav -->
    <nav class="container oben">
        <div id="content" class="grid">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="secondary">
                        <img src="{{ asset('images/DEU_Herborn_COA.svg') }}" class="logoherborn"/>
                    </a>
                </li>
            </ul>
            
            <ul>
                <li><a href="{{ route('home') }}">Startseite</a></li>
                
                <li>
                    <details class="dropdown">
                        <summary>Dialekt</summary>
                        <ul dir="rtl">
                            <li><a href="{{ route('dialect.expressions') }}">Wörterbuch</a></li>
                            <li><a href="{{ route('mundart') }}">Dialekt</a></li>
                            <li><a href="{{ route('aussprache') }}">Aussprache</a></li>
                        </ul>
                    </details>
                </li>

                <li>
                    <details class="dropdown">
                        <summary>Hörbeispiele</summary>
                        <ul dir="rtl">
                            <li><a href="{{ route('hirtenfest') }}">Hirtenfest</a></li>
                            <li><a href="{{ route('reime') }}">Kinderreime</a></li>
                            <li><a href="{{ route('weisheiten') }}">Weisheiten</a></li>
                        </ul>
                    </details>
                </li>
                
                <!-- Admin Bereich - nur wenn eingeloggt -->
                @auth
                    <li>
                        <details class="dropdown">
                            <summary>Admin</summary>
                            <ul dir="rtl">
                                <li><a href="{{ route('admin.expressions.index') }}">Wörter bearbeiten</a></li>
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>
                                    <!-- Logout Form -->
                                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; width: 100%; text-align: left; padding: 0.5rem 1rem;">
                                            Abmelden
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </details>
                    </li>
                @else
                    <!-- Login Link - nur wenn nicht eingeloggt -->
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main -->
    <main class="container">
        @if(session('success'))
            <article style="background: var(--ins-color); padding: 1rem; margin-bottom: 2rem;">
                {{ session('success') }}
            </article>
        @endif

        @if(session('error'))
            <article style="background: var(--del-color); padding: 1rem; margin-bottom: 2rem;">
                {{ session('error') }}
            </article>
        @endif

        @yield('content')
    </main>

    <footer class="container" style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid var(--muted-color);">
        <small>Wäller Platt &copy; {{ date('Y') }} ~ <a href="{{ route('impressum') }}">Impressum</a> ~ <a href="{{ route('datenschutz') }}">Datenschutz</a> ~ <a href="https://de.wikipedia.org/wiki/W%C3%A4ller_Platt" target="_blank">Wällerplatt - Wikipedia</a></small>
    </footer>
</body>
</html>
