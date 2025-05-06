<script>
document.addEventListener('DOMContentLoaded', () => {
const input = document.getElementById('location');
const suggestions = document.getElementById('suggestions');

input.addEventListener('input', async () => {
    const query = input.value;

    if (query.length < 2) {
        suggestions.innerHTML = '';
        suggestions.classList.add('hidden');
        return;
    }

    try {
        const response = await fetch(`https://wft-geo-db.p.rapidapi.com/v1/geo/cities?limit=5&namePrefix=${query}&countryIds=FR&sort=-population`, {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': 'e5723cb364msh4b3da4213dd24c2p11ed1ajsn1c3404b03a75',
                'X-RapidAPI-Host': 'wft-geo-db.p.rapidapi.com'
            }
        });

        const result = await response.json();
        suggestions.innerHTML = '';

        result.data.forEach(city => {
            const li = document.createElement('li');
            li.textContent = `${city.city}, ${city.countryCode}`;
            li.classList.add('px-3', 'py-2', 'cursor-pointer', 'hover:bg-gray-100', 'dark:hover:bg-gray-700', 'transition-colors');
            li.addEventListener('click', () => {
                input.value = li.textContent;
                suggestions.innerHTML = '';
                suggestions.classList.add('hidden');
            });
            suggestions.appendChild(li);
        });

        suggestions.classList.remove('hidden');
    } catch (error) {
        console.error('Erreur API:', error);
    }
});

// Cacher les suggestions quand on clique ailleurs
document.addEventListener('click', (e) => {
    if (!input.contains(e.target) && !suggestions.contains(e.target)) {
        suggestions.innerHTML = '';
        suggestions.classList.add('hidden');
    }
});

// Fonction de prévisualisation des images
const imageInput = document.getElementById('images');
const previewContainer = document.getElementById('image-preview');

imageInput.addEventListener('change', function() {
    previewContainer.innerHTML = '';
    
    if (this.files) {
        for (let i = 0; i < this.files.length; i++) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative w-24 h-24 m-2 group';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover rounded-lg shadow-sm';
                
                imgContainer.appendChild(img);
                previewContainer.appendChild(imgContainer);
                
                setTimeout(() => {
                    imgContainer.classList.add('opacity-100', 'translate-y-0');
                }, 10);
            };
            
            reader.readAsDataURL(this.files[i]);
        }
    }
});
});
</script>

<x-app-layout>
<style>

/* Variables et thèmes */
:root {
--primary: #3b82f6;
--primary-hover: #2563eb;
--secondary: #10b981;
--secondary-hover: #059669;
--accent: #8b5cf6;
--accent-hover: #7c3aed;
--danger: #ef4444;
--success: #10b981;
--warning: #f59e0b;
--info: #3b82f6;
--light: #f3f4f6;
--dark: #1f2937;
--text-light: #f9fafb;
--text-dark: #111827;
--text-muted: #6b7280;
--border-color: #e5e7eb;
--border-active: #93c5fd;
--card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
--hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
--transition: all 0.3s ease;
--radius: 1rem;
}

.dark {
--primary: #3b82f6;
--primary-hover: #60a5fa;
--border-color: #374151;
--border-active: #1e40af;
--card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
}

/* Animations */
@keyframes fadeIn {
from { opacity: 0; transform: translateY(10px); }
to { opacity: 1; transform: translateY(0); }
}

@keyframes slideDown {
from { opacity: 0; transform: translateY(-10px); }
to { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
0%, 100% { transform: scale(1); }
50% { transform: scale(1.05); }
}

@keyframes highlightField {
0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5); }
70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
}

/* Styles du formulaire */
.bg-white.dark\:bg-gray-800 {
animation: fadeIn 0.5s ease-out;
border-radius: var(--radius);
box-shadow: var(--card-shadow);
transition: var(--transition);
border: 1px solid transparent;
}

.bg-white.dark\:bg-gray-800:hover {
box-shadow: var(--hover-shadow);
}

/* Style des libellés */
label.block.text-sm {
margin-bottom: 0.5rem;
font-weight: 600;
color: var(--text-dark);
transition: var(--transition);
}

.dark label.block.text-sm {
color: var(--text-light);
}

/* Style des champs de formulaire */
input[type="text"],
input[type="file"],
textarea {
border-radius: 0.75rem;
border: 2px solid var(--border-color);
padding: 0.75rem 1rem;
transition: var(--transition);
background-color: white;
width: 100%;
outline: none;
}

.dark input[type="text"],
.dark textarea {
background-color: #1f2937;
color: white;
border-color: #374151;
}

input[type="text"]:focus,
textarea:focus {
border-color: var(--border-active);
box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
transform: translateY(-2px);
}

/* Style des erreurs */
.text-red-500 {
margin-top: 0.25rem;
font-size: 0.875rem;
animation: slideDown 0.3s ease-out;
}

/* Style du champ de prix */
.relative .pl-8 {
padding-left: 2rem;
}

.relative span.absolute {
color: var(--text-muted);
z-index: 10;
padding-left: 0.75rem;
pointer-events: none;
}

/* Style des suggestions de localisation */
#suggestions {
border-radius: 0.75rem;
border: 1px solid var(--border-color);
overflow: hidden;
max-height: 200px;
overflow-y: auto;
box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
animation: slideDown 0.3s ease-out;
}

.dark #suggestions {
background-color:rgb(211, 221, 236);
border-color: #374151;
}

#suggestions li {
padding: 0.75rem 1rem;
border-bottom: 1px solid var(--border-color);
transition: var(--transition);
}

.dark #suggestions li {
border-color: #374151;
color: white;
}

#suggestions li:last-child {
border-bottom: none;
}

#suggestions li:hover {
background-color: #f3f4f6;
cursor: pointer;
}

.dark #suggestions li:hover {
background-color:rgb(255, 255, 255);
}

/* Style du champ d'upload */
input[type="file"] {
background-color: transparent;
padding: 0.5rem 0;
border: none;
cursor: pointer;
}

input[type="file"]::file-selector-button {
background-color: var(--light);
color: var(--text-dark);
border: 1px solid var(--border-color);
border-radius: 0.5rem;
padding: 0.5rem 1rem;
margin-right: 1rem;
cursor: pointer;
transition: var(--transition);
}

input[type="file"]:hover::file-selector-button {
background-color: #e5e7eb;
}

.dark input[type="file"]::file-selector-button {
background-color: #374151;
color: white;
border-color: #4b5563;
}

.dark input[type="file"]:hover::file-selector-button {
background-color: #4b5563;
}

/* Conteneur de prévisualisation d'images */
#image-preview {
display: flex;
flex-wrap: wrap;
margin-top: 0.5rem;
width: 200px;
height: 100px;
}

#image-preview > div {
opacity: 0;
transform: translateY(10px);
transition: all 0.3s ease;
}

/* Bouton de soumission */
button[type="submit"],
.ms-3 {
background-color: var(--primary);
color: white;
border-radius: 0.75rem;
padding: 0.75rem 1.5rem;
font-weight: 600;
transition: var(--transition);
border: none;
cursor: pointer;
position: relative;
overflow: hidden;
z-index: 1;
}

button[type="submit"]:hover,
.ms-3:hover {
background-color: var(--primary-hover);
transform: translateY(-2px);
box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

button[type="submit"]::before,
.ms-3::before {
content: "";
position: absolute;
top: 0;
left: -100%;
width: 100%;
height: 100%;
background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
transition: all 0.6s;
z-index: -1;
}

button[type="submit"]:hover::before,
.ms-3:hover::before {
left: 100%;
}

/* Effet de transition sur le titre */
h2.font-semibold.text-xl {
position: relative;
transition: var(--transition);
}

h2.font-semibold.text-xl::after {
content: "";
position: absolute;
bottom: -0.5rem;
left: 0;
width: 0;
height: 2px;
background-color: var(--primary);
transition: var(--transition);
}

h2.font-semibold.text-xl:hover::after {
width: 50px;
}

/* Styles responsifs */
@media (max-width: 640px) {
.py-12 {
padding-top: 2rem;
padding-bottom: 2rem;
}

input[type="text"],
textarea {
font-size: 16px; /* Evite le zoom sur mobile */
}
}
</style>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <span class="text-blue-600">📝</span> Créer une annonce
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-8">
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Informations de votre annonce</h3>
            
            <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Titre -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titre de l'annonce</label>
                    <input type="text" id="title" name="title" 
                        class="mt-1 block w-full rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm" 
                        value="{{ old('title') }}" placeholder="Ex: iPhone 13 Pro Max comme neuf" required>
                    @error('title')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description détaillée</label>
                    <textarea id="description" name="description" rows="5"
                        class="mt-1 block w-full rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm"
                        placeholder="Décrivez votre article, son état, ses caractéristiques..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Prix -->
                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 dark:text-gray-400">€</span>
                        <input type="text" id="price" name="price" 
                            class="mt-1 block w-full pl-8 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm" 
                            value="{{ old('price') }}" placeholder="Ex: 499.99" required>
                    </div>
                    @error('price')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Localisation -->
                <div class="mb-6 relative">
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Localisation</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <input type="text" id="location" name="location" 
                            class="mt-1 block w-full pl-10 rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm" 
                            value="{{ old('location') }}" placeholder="Commencez à taper une ville..." autocomplete="off" required>
                    </div>

                    <!-- Suggestions -->
                    <ul id="suggestions" class="absolute bg-white dark:bg-gray-800 border mt-1 hidden z-50 w-full shadow-lg rounded-xl"></ul>

                    @error('location')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Images -->
                <div class="mb-6">
                    <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Photographies (facultatif)</label>
                    <div class="mt-2 flex items-center">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 flex-1">
                            <input type="file" id="images" name="images[]" class="text-sm text-gray-500 dark:text-gray-400 file:mr-4" multiple>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Téléchargez jusqu'à 5 photos pour illustrer votre annonce</p>
                    
                    <!-- Prévisualisation des images -->
                    <div id="image-preview" class="flex flex-wrap mt-3"></div>
                    
                    @error('images')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="mt-8 flex justify-center">
                    <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition shadow-lg">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Publier mon annonce
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>