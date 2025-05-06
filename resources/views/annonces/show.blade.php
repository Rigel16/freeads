<x-app-layout>
    <style>
        /* Styles pour la page de détails d'annonce */
        .annonce-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .annonce-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        
        .annonce-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }
        
        .dark .annonce-title {
            color: #f3f4f6;
        }
        
        .annonce-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }
        
        .annonce-location, .annonce-date {
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            color: #4b5563;
        }
        
        .dark .annonce-location, .dark .annonce-date {
            color: #d1d5db;
        }
        
        .annonce-price {
            background-color: #2563eb;
            color: white;
            font-size: 1.3rem;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }
        
        .annonce-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .btn-edit, .btn-delete, .btn-back {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-edit {
            background-color: #2563eb;
            color: white;
        }
        
        .btn-edit:hover {
            background-color: #1d4ed8;
        }
        
        .btn-delete {
            background-color: #dc2626;
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #b91c1c;
        }
        
        .btn-back {
            background-color: #6b7280;
            color: white;
        }
        
        .btn-back:hover {
            background-color: #4b5563;
        }
        
        /* Galerie d'images */
        .annonce-gallery {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        
        @media (min-width: 768px) {
            .annonce-gallery {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .main-image {
                grid-column: span 2;
                grid-row: span 2;
            }
        }
        
        .gallery-item {
            border-radius: 8px;
            overflow: hidden;
            height: 200px;
            position: relative;
        }
        
        .main-image {
            height: 100%;
        }
        
        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gallery-action {
            background-color: rgba(255, 255, 255, 0.9);
            color: #111827;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        .no-images {
            grid-column: 1 / -1;
            background-color: #f3f4f6;
            height: 300px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #6b7280;
        }
        
        .dark .no-images {
            background-color: #374151;
            color: #9ca3af;
        }
        
        .no-images-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        /* Contenu de l'annonce */
        .annonce-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        @media (min-width: 768px) {
            .annonce-content {
                grid-template-columns: 2fr 1fr;
            }
        }
        
        .annonce-description {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .dark .annonce-description {
            background-color: #1f2937;
        }
        
        .description-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .dark .description-title {
            color: #f3f4f6;
            border-bottom-color: #374151;
        }
        
        .description-content {
            font-size: 1rem;
            line-height: 1.6;
            color: #4b5563;
            white-space: pre-line;
        }
        
        .dark .description-content {
            color: #d1d5db;
        }
        
        .annonce-sidebar {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }
        
        .dark .annonce-sidebar {
            background-color: #1f2937;
        }
        
        .sidebar-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .dark .sidebar-title {
            color: #f3f4f6;
            border-bottom-color: #374151;
        }
        
        .contact-info {
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #4b5563;
        }
        
        .dark .info-item {
            color: #d1d5db;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            background-color: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: #2563eb;
        }
        
        .dark .info-icon {
            background-color: #374151;
            color: #3b82f6;
        }
        
        .btn-contact {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            background-color: #2563eb;
            color: white;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .btn-contact:hover {
            background-color: #1d4ed8;
        }
        
        /* Modal galerie */
        .gallery-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            overflow: hidden;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            position: relative;
            width: 90%;
            max-width: 1000px;
            max-height: 90vh;
        }
        
        .modal-img {
            width: 100%;
            height: auto;
            max-height: 80vh;
            object-fit: contain;
        }
        
        .modal-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-prev, .modal-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 2rem;
            cursor: pointer;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
        }
        
        .modal-prev {
            left: 10px;
        }
        
        .modal-next {
            right: 10px;
        }
        
        .modal-counter {
            position: absolute;
            bottom: -30px;
            width: 100%;
            text-align: center;
            color: white;
        }
    </style>

    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                Détails de l'annonce
            </h2>
            <a href="{{ route('annonces.index') }}" class="btn-back">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="annonce-container">
        @if(session('success'))
            <div class="alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="annonce-header">
    <div>
        <h1 class="annonce-title">{{ $annonce->title }}</h1>
        <div class="annonce-meta">
            <div class="annonce-location">
                <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i> {{ $annonce->location }}
            </div>
            <div class="annonce-date">
                <i class="far fa-calendar-alt" style="margin-right: 5px;"></i> Publiée {{ $annonce->created_at->diffForHumans() }}
            </div>
        </div>

        @if(Auth::check() && Auth::id() === $annonce->user_id)
            <div class="annonce-actions">
                <a href="{{ route('annonces.edit', $annonce) }}" class="btn-edit">
                    <i class="fas fa-edit" style="margin-right: 5px;"></i> Modifier
                </a>
                <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash" style="margin-right: 5px;"></i> Supprimer
                    </button>
                </form>
            </div>
        @endif
        <a href="{{ route('messages.show', [$annonce->id, $annonce->user_id]) }}" class="btn-edit">
    💬 Contacter le vendeur
</a>

    </div>

    <div class="annonce-price">
        <i class="fas fa-tag" style="margin-right: 8px;"></i> {{ number_format($annonce->price, 0, ',', ' ') }} €
    </div>
</div>


        <!-- Galerie d'images -->
        <div class="annonce-gallery">
            @if ($annonce->images->count())
                @foreach ($annonce->images as $index => $image)
                    <div class="gallery-item {{ $index === 0 ? 'main-image' : '' }}">
                        <img src="{{ asset('storage/' . $image->path) }}" 
                            class="gallery-img" alt="Image de l'annonce {{ $annonce->title }}">
                        <div class="gallery-overlay">
                            <div class="gallery-action" onclick="openGallery({{ $index }})">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-images">
                    <div class="no-images-icon">
                        <i class="fas fa-image"></i>
                    </div>
                    <p>Aucune image disponible pour cette annonce</p>
                </div>
            @endif
        </div>

        <!-- Contenu de l'annonce -->
        <div class="annonce-content">
            <div class="annonce-description">
                <h2 class="description-title">Description</h2>
                <div class="description-content">
                    {{ $annonce->description }}
                </div>
            </div>

            <div class="annonce-sidebar">
                <h2 class="sidebar-title">Contact</h2>
                <div class="contact-info">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <strong>{{ $annonce->user->name }}</strong>
                            <p>Membre depuis {{ $annonce->user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            {{ $annonce->contact_phone ?? 'Non renseigné' }}
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            {{ $annonce->contact_email ?? $annonce->user->email }}
                        </div>
                    </div>
                </div>
                <a href="mailto:{{ $annonce->contact_email ?? $annonce->user->email }}" class="btn-contact">
                    <i class="fas fa-paper-plane" style="margin-right: 5px;"></i> Contacter
                </a>
            </div>
        </div>
    </div>

    <!-- Modal galerie -->
    <div class="gallery-modal" id="galleryModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeGallery()">
                <i class="fas fa-times"></i>
            </span>
            <img class="modal-img" id="modalImg" src="">
            <div class="modal-prev" onclick="changeImage(-1)">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="modal-next" onclick="changeImage(1)">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="modal-counter" id="modalCounter"></div>
        </div>
    </div>

    <script>
        // Variables pour la galerie
        let currentImageIndex = 0;
        const images = [
            @foreach ($annonce->images as $image)
                "{{ asset('storage/' . $image->path) }}",
            @endforeach
        ];

        // Ouvrir la galerie
        function openGallery(index) {
            const modal = document.getElementById('galleryModal');
            const modalImg = document.getElementById('modalImg');
            const modalCounter = document.getElementById('modalCounter');
            
            currentImageIndex = index;
            modalImg.src = images[currentImageIndex];
            modalCounter.textContent = `${currentImageIndex + 1} / ${images.length}`;
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        // Fermer la galerie
        function closeGallery() {
            const modal = document.getElementById('galleryModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Changer d'image
        function changeImage(direction) {
            const modalImg = document.getElementById('modalImg');
            const modalCounter = document.getElementById('modalCounter');
            
            currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
            modalImg.src = images[currentImageIndex];
            modalCounter.textContent = `${currentImageIndex + 1} / ${images.length}`;
        }

        // Fermer la galerie avec la touche Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeGallery();
            } else if (event.key === 'ArrowLeft') {
                changeImage(-1);
            } else if (event.key === 'ArrowRight') {
                changeImage(1);
            }
        });
    </script>
</x-app-layout>