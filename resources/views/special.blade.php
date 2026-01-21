<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès au Formulaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <div class="w-screen h-screen" id="to_hide">
        <nav class="flex items-center justify-between px-8 py-6 bg-white shadow-sm">
            <div class="text-2xl font-bold text-indigo-600">Projet FullTruck!</div>
            <div class="space-x-6 hidden md:block">
                <a href="#" class="hover:text-indigo-600 transition">Accueil</a>
                <a href="#formulaire" class="bg-indigo-600 text-white px-5 py-2 rounded-full hover:bg-indigo-700 transition">S'inscrire</a>
            </div>
        </nav>
    
        <header class="max-w-6xl mx-auto px-8 py-20 text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 tracking-tight">
                Prêt à passer à l'étape <span class="text-indigo-600">suivante ?</span>
            </h1>
            <p class="text-lg text-slate-600 mb-10 max-w-2xl mx-auto">
                Remplissez le formulaire ci-dessous pour noter vos camarades et les récompenser pour leur dur labeur.
            </p>
            <a href="#formulaire" class="animate-bounce inline-block">
                <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="id19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                </svg>
            </a>
        </header>

        <div class="text-center">
            <button class="text-6xl mx-auto bg-blue-300 p-12 rounded-full animate-bounce font-extrabold">
                Accéder au formulaire
            </button>
        </div>
    
        <footer class="py-10 text-center text-slate-400 text-sm">
            &copy; 2026 MonProjet. Tous droits réservés.
        </footer>
    </div>

</body>
<video class="w-screen h-screen hidden" controls autoplay id="video">
    <source src="{{ asset('storage/video_tres_importante.mp4') }}" type="video/mp4">
</video>

<script>
    window.addEventListener('click', () => {
        const vid = document.querySelector('video');
        const body = document.querySelector('#to_hide');
        vid.classList.toggle('hidden');
        body.classList.toggle('hidden');
        vid.play();
    }, { once: true });
</script>
</html>

