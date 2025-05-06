<x-app-layout>
<x-slot name="header">
    <div class="flex items-center justify-between px-4 sm:px-0 bg-white dark:bg-gray-800 py-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center space-x-3">
            <a href="{{ route('messages.index') }}" class="inline-header-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Discussion avec {{ $user->name }}</h2>
        </div>
        <span class="text-sm font-medium text-blue-600 dark:text-blue-400 truncate max-w-[200px]">
            Annonce: {{ $annonce->title }}
        </span>
    </div>
</x-slot>
    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg flex flex-col h-[75vh] border border-gray-200 dark:border-gray-700">
                <!-- Messages -->
                <div id="messages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900">
                    
                    @forelse($messages as $message)
                    <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
    <div class="max-w-[85%] rounded-lg p-4 text-sm relative
        {{ $message->sender_id === Auth::id() 
            ? 'bg-blue-600 text-white rounded-tr-none'
            : 'bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100 rounded-tl-none' }}">
        <p class="break-words mb-2">{{ $message->content }}</p>
        <div class="text-xs {{ $message->sender_id === Auth::id() 
            ? 'text-blue-200' 
            : 'text-gray-500 dark:text-gray-300' }}">
            {{ $message->created_at->format('H:i') }}
        </div>
    </div>
</div>
                    @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="text-lg font-medium">Aucun message</p>
                            <p class="mt-1 text-sm">Commencez la conversation !</p>
                        </div>
                    @endforelse
                </div>

                <!-- Formulaire -->
                <form action="{{ route('messages.send', ['annonce' => $annonce->id, 'user' => $user->id]) }}" 
                      method="POST" 
                      class="border-t border-gray-200 dark:border-gray-700 p-4 bg-white dark:bg-gray-800">
                    @csrf
                    <div class="flex gap-3">
                        <textarea 
                            name="content" 
                            id="messageInput" 
                            rows="1"
                            class="flex-1 resize-none rounded-lg py-2 px-4 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 dark:placeholder-gray-500"
                            placeholder="Écrivez votre message..."
                            required
                        ></textarea>
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Style pour le bouton retour intégré dans l'en-tête */
.inline-header-back {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 9999px;
    transition: all 0.2s ease;
    color: #4b5563; /* text-gray-600 */
}

.dark .inline-header-back {
    color: #d1d5db; /* dark:text-gray-300 */
}

.inline-header-back:hover {
    background-color: #f3f4f6; /* bg-gray-100 */
    color: #111827; /* text-gray-900 */
}

.dark .inline-header-back:hover {
    background-color: #374151; /* dark:bg-gray-700 */
    color: #f9fafb; /* dark:text-gray-100 */
}

.inline-header-back:focus {
    outline: 2px solid #3b82f6; /* ring-2 ring-blue-500 */
    outline-offset: 2px;
}

.inline-header-back:active {
    transform: scale(0.95);
}

/* Animation subtile */
.inline-header-back svg {
    transition: transform 0.15s ease;
}

.inline-header-back:hover svg {
    transform: translateX(-2px);
}
.dark .bg-gray-600 {
    background-color: #4b5563;
}

.dark .text-gray-300 {
    color: #d1d5db;
}

.dark .bg-gray-600 {
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
}
        textarea {
            color: #1f2937 !important;
            background-color: #ffffff !important;
        }

        .dark textarea {
            color: #f3f4f6 !important;
            background-color: #111827 !important;
        }

        /* Styles des messages */
        .bg-blue-600 {
            background-color: #2563eb;
        }

        .bg-gray-200 {
            background-color: #f3f4f6;
        }

        .dark .bg-gray-700 {
            background-color: #374151;
        }

        /* Contraste amélioré */
        .text-gray-900 {
            color: #1f2937;
        }

        .dark .text-gray-100 {
            color: #f3f4f6;
        }

        /* Barre de défilement */
        #messages::-webkit-scrollbar {
            width: 8px;
        }

        #messages::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .dark #messages::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
        /* Forme des bulles */
.rounded-tr-none {
    border-top-right-radius: 4px !important;
    border-bottom-right-radius: 18px !important;
    border-bottom-left-radius: 18px !important;
}

.rounded-tl-none {
    border-top-left-radius: 4px !important;
    border-bottom-right-radius: 18px !important;
    border-bottom-left-radius: 18px !important;
}

/* Ombre légère */
.bg-blue-600 {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}

.bg-gray-100 {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.dark .bg-gray-700 {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Espacement entre les messages */
.space-y-4 > :not([hidden]) ~ :not([hidden]) {
    --tw-space-y-reverse: 0;
    margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse)));
    margin-bottom: calc(1rem * var(--tw-space-y-reverse));
}
    </style>

    <script>
        // Script de base pour l'auto-expansion
        const messageInput = document.getElementById('messageInput');
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Défilement automatique
        const messagesContainer = document.getElementById('messages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    </script>
</x-app-layout>