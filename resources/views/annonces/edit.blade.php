<style>
.page-header {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e3a8a;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-container {
    background-color: #fff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
}

.dark .form-container {
    background-color: #1f2937;
    box-shadow: 0 10px 25px rgba(255, 255, 255, 0.03);
}

.custom-label {
    font-weight: 500;
    color: #374151;
}

.dark .custom-label {
    color: #d1d5db;
}

.custom-input,
.custom-textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.75rem;
    font-size: 1rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.custom-input:focus,
.custom-textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
}

.dark .custom-input,
.dark .custom-textarea {
    background-color: #374151;
    border-color: #4b5563;
    color: #f3f4f6;
}

.btn-submit {
    padding: 0.75rem 2rem;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    font-weight: 600;
    border: none;
    border-radius: 0.75rem;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
}

.btn-submit:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-2px);
}
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">
            ✏️ Modifier l'annonce
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="form-container">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Modifier votre annonce</h3>

                <form action="{{ route('annonces.update', $annonce->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Titre -->
                    <div>
                        <label for="title" class="custom-label">Titre</label>
                        <input type="text" id="title" name="title" class="custom-input" value="{{ old('title', $annonce->title) }}" required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="custom-label">Description</label>
                        <textarea id="description" name="description" rows="5" class="custom-textarea" required>{{ old('description', $annonce->description) }}</textarea>
                    </div>

                    <!-- Prix -->
                    <div>
                        <label for="price" class="custom-label">Prix (€)</label>
                        <input type="number" id="price" name="price" class="custom-input" value="{{ old('price', $annonce->price) }}" step="0.01" required>
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label for="location" class="custom-label">Localisation</label>
                        <input type="text" id="location" name="location" class="custom-input" value="{{ old('location', $annonce->location) }}" required>
                    </div>

                    <!-- Images -->
                    <div>
                        <label for="images" class="custom-label">Changer / ajouter des photos</label>
                        <input type="file" id="images" name="images[]" class="text-sm" multiple>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($annonce->images as $image)
                                <div class="relative w-24 h-24">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="w-full h-full object-cover rounded-lg shadow" alt="Image">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bouton -->
                    <div class="mt-8 flex justify-center">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
