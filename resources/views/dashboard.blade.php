<x-app-layout>
<!-- Ajout du CSS personnalisé directement dans le dashboard -->
<style>
.custom-detail-btn {
    display: inline-block;
    width: 100%;
    text-align: center;
    padding: 0.75rem 1rem;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #fff;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    transition: transform 0.2s ease, box-shadow 0.3s ease;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.custom-detail-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
}

.custom-detail-btn::after {
    content: '→';
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease, right 0.3s ease;
}

.custom-detail-btn:hover::after {
    opacity: 1;
    right: 0.75rem;
}
/* Boutons du header avec effet moderne */
.header-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.2rem;
    font-size: 0.9rem;
    font-weight: 600;
    color: white;
    border-radius: 0.75rem;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: all 0.25s ease;
    position: relative;
}

/* Variante bleue */
.header-link.blue {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
}

.header-link.blue:hover {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    transform: translateY(-2px);
}

/* Variante verte */
.header-link.green {
    background: linear-gradient(135deg, #10b981, #059669);
}

.header-link.green:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
}

/* Variante violette */
.header-link.purple {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.header-link.purple:hover {
    background: linear-gradient(135deg, #7c3aed, #6d28d9);
    transform: translateY(-2px);
}

/* Badge pour le nombre de messages */
.header-link .badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #ef4444;
    color: white;
    font-size: 0.7rem;
    font-weight: bold;
    border-radius: 9999px;
    width: 1.25rem;
    height: 1.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dark .header-link {
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.05);
}
.btn-custom-blue {
    width: 100%;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 0.75rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-custom-blue:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
}

/* Mode sombre */
.dark .btn-custom-blue {
    box-shadow: 0 4px 10px rgba(255, 255, 255, 0.05);
}

/* Styles pour les liens de pagination */
.pagination-links nav {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-links .page-link {
    display: inline-block;
    padding: 8px 12px;
    margin: 0 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #555;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

.pagination-links .page-link:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination-links .page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}
</style>


<x-slot name="header">
    
    <div class="bg-white dark:bg-gray-900 shadow-md rounded-2xl px-6 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white flex items-center gap-2 header-logo">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Tableau de bord <span class="text-blue-600">Freeads</span></span>
            </h2>

            <div class="flex flex-wrap gap-3">
            <a href="{{ route('annonces.index') }}" class="header-link blue">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
    </svg>
    Mes annonces
</a>

<a href="{{ route('annonces.create') }}" class="header-link green">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
    </svg>
    Créer une annonce
</a>

<a href="{{ route('messages.index') }}" class="header-link purple">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
    </svg>
    Messages
    <span class="badge">3</span>
</a>

            </div>
        </div>
    </div>
</x-slot>


    <div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        <!-- Section de bienvenue -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 shadow-md rounded-2xl p-8">
            <h3 class="text-3xl font-extrabold text-blue-900 dark:text-white mb-4">🎉 Bienvenue sur Freeads !</h3>
            <p class="text-lg text-gray-700 dark:text-gray-300">
                Parcourez les meilleures annonces près de chez vous. Vendez, achetez, échangez en toute simplicité.
            </p>
        </div>

        <!-- Barre de recherche -->
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl p-8">
    <form action="{{ route('annonces.search') }}" method="GET" class="grid md:grid-cols-12 gap-4 items-center">
        <div class="md:col-span-6">
            <input 
                type="text" 
                name="query" 
                placeholder="🔍 Rechercher une annonce..." 
                class="w-full px-5 py-3 rounded-xl border border-gray-300 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white"
            >
        </div>
        <div class="md:col-span-2">
        <button 
    type="submit" 
    class="btn-custom-blue"
>
    🔍 Rechercher
</button>

        </div>
    </form>
</div>


        <!-- Liste des annonces -->
        <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-10 mb-6">🗂️ Toutes les annonces</h3>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($annonces as $annonce)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-lg transition p-4 flex flex-col">
            <div class="relative rounded-xl overflow-hidden aspect-video bg-gray-200 dark:bg-gray-700">
                @if($annonce->images->first())
                    <img 
                        src="{{ asset('storage/' . $annonce->images->first()->path) }}" 
                        alt="{{ $annonce->title }}" 
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-500 dark:text-gray-400 text-sm">
                        Pas d'image
                    </div>
                @endif
                <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                    {{ ucfirst($annonce->category) }}
                </span>
            </div>

            <div class="flex-1 mt-4 space-y-1">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $annonce->title }}</h4>
                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">{{ $annonce->description }}</p>
            </div>

            <div class="mt-3 flex justify-between text-sm text-gray-500 dark:text-gray-400">
                <span class="text-green-600 font-semibold dark:text-green-400">{{ number_format($annonce->price, 2) }} €</span>
                <span>{{ $annonce->created_at->diffForHumans() }}</span>
            </div>

            <a 
    href="{{ route('annonces.show', $annonce) }}" 
    class="custom-detail-btn mt-4"
>
    Voir les détails
</a>

        </div>
    @empty
        <div class="col-span-3 bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6 text-center">
            <p class="text-gray-600 dark:text-gray-300">Aucune annonce disponible pour le moment.</p>
        </div>
    @endforelse
</div>

<div class="pagination-links mt-6">
    {{ $annonces->links() }}
</div>

    </div>
</div>

</x-app-layout>