<x-app-layout>
    <style>
        /* Style personnalisé pour les annonces */
        .annonces-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .annonces-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        /* Responsive - 2 colonnes sur tablette */
        @media (min-width: 640px) {
            .annonces-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        /* Responsive - 3 colonnes sur desktop */
        @media (min-width: 1024px) {
            .annonces-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        .annonce-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid #eaeaea;
        }
        
        .dark .annonce-card {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .annonce-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .annonce-img-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .annonce-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .no-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            color: #9ca3af;
            font-size: 2.5rem;
        }
        
        .dark .no-img-placeholder {
            background-color: #374151;
            color: #6b7280;
        }
        
        .annonce-price {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            color: #111;
            font-weight: bold;
            padding: 5px 12px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .dark .annonce-price {
            background-color: rgba(31, 41, 55, 0.9);
            color: #fff;
        }
        
        .annonce-photos-count {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 10px;
        }
        
        .annonce-content {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        
        .annonce-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        
        .annonce-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .dark .annonce-title {
            color: #f3f4f6;
        }
        
        .annonce-time {
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .dark .annonce-time {
            color: #9ca3af;
        }
        
        .annonce-location {
            font-size: 0.85rem;
            color: #4b5563;
            margin-bottom: 8px;
        }
        
        .dark .annonce-location {
            color: #d1d5db;
        }
        
        .annonce-description {
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 15px;
            line-height: 1.4;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            flex: 1;
        }
        
        .dark .annonce-description {
            color: #9ca3af;
        }
        
        .annonce-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
            margin-top: auto;
            border-top: 1px solid #eaeaea;
        }
        
        .dark .annonce-footer {
            border-top-color: #374151;
        }
        
        .annonce-link {
            color: #2563eb;
            text-decoration: none;
            font-size: 0.85rem;
        }
        
        .dark .annonce-link {
            color: #3b82f6;
        }
        
        .annonce-link:hover {
            text-decoration: underline;
        }
        
        .actions-container {
            display: flex;
            gap: 5px;
        }
        
        .btn-edit {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 0.75rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.2s;
        }
        
        .btn-edit:hover {
            background-color: #1d4ed8;
        }
        
        .btn-delete {
            background-color: #dc2626;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 0.75rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.2s;
        }
        
        .btn-delete:hover {
            background-color: #b91c1c;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
            grid-column: 1 / -1;
        }
        
        .dark .empty-state {
            background-color: #1f2937;
        }
        
        .empty-icon {
            font-size: 3rem;
            color: #9ca3af;
            margin-bottom: 20px;
        }
        
        .empty-text {
            font-size: 1.25rem;
            color: #4b5563;
            margin-bottom: 20px;
        }
        
        .dark .empty-text {
            color: #d1d5db;
        }
        
        .btn-create {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 0.9rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.2s;
        }
        
        .btn-create:hover {
            background-color: #1d4ed8;
        }

        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        
        .dark .alert-success {
            background-color: rgba(16, 185, 129, 0.2);
            border-color: #059669;
            color: #d1fae5;
        }

        .pagination-links {
            margin-top: 20px;
            text-align: center;
        }

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
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                Liste des annonces
            </h2>
            <a href="{{ route('annonces.create') }}" class="btn-create">
                <i class="fas fa-plus" style="margin-right: 8px;"></i> Nouvelle annonce
            </a>
        </div>
    </x-slot>

    <div class="annonces-container">
        @if(session('success'))
            <div class="alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="annonces-grid">
            @forelse ($annonces as $annonce)
                <div class="annonce-card">
                    <div class="annonce-img-container">
                        @if ($annonce->images->count())
                            <img src="{{ asset('storage/' . $annonce->images->first()->path) }}" 
                                class="annonce-img" alt="{{ $annonce->title }}">
                            @if($annonce->images->count() > 1)
                                <div class="annonce-photos-count">
                                    +{{ $annonce->images->count() - 1 }} photos
                                </div>
                            @endif
                        @else
                            <div class="no-img-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="annonce-price">
                            {{ number_format($annonce->price, 0, ',', ' ') }} €
                        </div>
                    </div>

                    <div class="annonce-content">
                        <div class="annonce-header">
                            <h3 class="annonce-title">{{ $annonce->title }}</h3>
                            <span class="annonce-time">
                                <i class="far fa-clock" style="margin-right: 3px;"></i> {{ $annonce->created_at->diffForHumans() }}
                            </span>
                        </div>
                        
                        <p class="annonce-location">
                            <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i> {{ $annonce->location }}
                        </p>
                        
                        <p class="annonce-description">
                            {{ Str::limit($annonce->description, 100) }}
                        </p>
                        
                        <div class="annonce-footer">
                            <a href="{{ route('annonces.show', $annonce) }}" class="annonce-link">
                                Voir les détails <i class="fas fa-arrow-right" style="margin-left: 3px;"></i>
                            </a>
                            
                            <div class="actions-container">
                                <a href="{{ route('annonces.edit', $annonce) }}" class="btn-edit">
                                    <i class="fas fa-edit" style="margin-right: 3px;"></i> Modifier
                                </a>
                                
                                <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="fas fa-trash" style="margin-right: 3px;"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <p class="empty-text">Aucune annonce disponible.</p>
                    <a href="{{ route('annonces.create') }}" class="btn-create">
                        Créer votre première annonce
                    </a>
                </div>
            @endforelse
        </div>

        <div class="pagination-links">
            {{ $annonces->links() }}
        </div>
    </div>
</x-app-layout>