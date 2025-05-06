<div class="conversations-list">
<div class="mb-4">
<a href="{{ url()->previous() }}" class="back-button">
    <span class="retour">Retour</span>
</a>
    </div>
    @forelse($conversations as $groupKey => $messages)
        @php
            $lastMessage = $messages->last();
            $contact = $lastMessage->sender_id === Auth::id() ? $lastMessage->receiver : $lastMessage->sender;
            $annonce = $lastMessage->annonce;
            $unread = $messages->where('is_read', false)->where('receiver_id', Auth::id())->count();
            $timeAgo = $lastMessage->created_at->diffForHumans();
        @endphp

        <a href="{{ route('messages.show', ['annonce' => $annonce->id, 'user' => $contact->id]) }}" class="conversation-item">
            <div class="conversation-icon">
                <svg class="message-icon" viewBox="0 0 24 24">
                    <path stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            
            <div class="conversation-content">
                <div class="conversation-header">
                    <h3 class="contact-name">{{ $contact->name }}</h3>
                    <span class="message-time">{{ $timeAgo }}</span>
                </div>
                
                <p class="annonce-title">{{ $annonce->title }}</p>
                
                <div class="conversation-footer">
                    <p class="message-preview">{{ Str::limit($lastMessage->content, 60) }}</p>
                    @if($unread > 0)
                        <span class="unread-count">{{ $unread }}</span>
                    @endif
                </div>
            </div>
        </a>
    @empty
        <div class="empty-conversations">
            <div class="empty-icon">
                <svg viewBox="0 0 24 24">
                    <path stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3>Aucune conversation</h3>
            <p>Commencez une nouvelle discussion</p>
        </div>
    @endforelse
</div>

<style>
/* Base styles */
.back-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    font-weight: 500;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    margin-bottom: 1rem;
    position: relative;
    overflow: hidden;
}

/* Mode clair */
:root {
    --back-text: #4b5563;
    --back-text-hover: #111827;
    --back-bg-hover: rgba(243, 244, 246, 0.8);
    --back-icon: #6b7280;
}

/* Mode sombre */
.dark {
    --back-text: #d1d5db;
    --back-text-hover: #f9fafb;
    --back-bg-hover: rgba(31, 41, 55, 0.5);
    --back-icon: #9ca3af;
}

.back-button {
    color: var(--back-text);
    background-color: transparent;
}

.back-button:hover {
    color: var(--back-text-hover);
    background-color: var(--back-bg-hover);
}

.back-button:focus {
    outline: 2px solid var(--color-accent);
    outline-offset: 2px;
}

.back-button:active {
    transform: translateY(1px);
}

/* Icône flèche de retour */
.back-button::before {
    content: "←";
    font-size: 1rem;
    margin-right: 0.25rem;
    color: var(--back-icon);
    transition: all 0.2s;
}

.back-button:hover::before {
    transform: translateX(-3px);
    color: var(--back-text-hover);
}

/* Animation de l'effet ondulatoire au clic */
.back-button .ripple {
    position: absolute;
    border-radius: 50%;
    transform: scale(0);
    animation: ripple 0.6s linear;
    background-color: rgba(255, 255, 255, 0.3);
}

@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Style pour le texte "Retour" */
.retour {
    position: relative;
}

/* Animation de soulignement au survol */
.retour::after {
    content: '';
    position: absolute;
    width: 0;
    height: 1px;
    bottom: -1px;
    left: 0;
    background-color: currentColor;
    transition: width 0.2s ease;
}

.back-button:hover .retour::after {
    width: 100%;
}

/* Intégration avec les classes Tailwind de Laravel Breeze */
.inline-flex.items-center.gap-1\.5 {
    @extend .back-button;
}

/* Media query pour les appareils mobiles */
@media (max-width: 640px) {
    .back-button {
        padding: 0.375rem 0.625rem;
    }
}

.conversations-list {
    max-width: 800px;
    margin: 0 auto;
    padding: 1rem;
}

/* Conversation item */
.conversation-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    padding: 1.25rem;
    margin-bottom: 1rem;
    border-radius: 0.75rem;
    background: #ffffff;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s ease;
    border: 1px solid #e5e7eb;
}

.dark .conversation-item {
    background: #1f2937;
    border-color: #374151;
}

.conversation-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
}

.dark .conversation-item:hover {
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2);
}

/* Icon */
.conversation-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e0f2fe;
    border-radius: 0.5rem;
}

.dark .conversation-icon {
    background: #1e3a8a;
}

.message-icon {
    width: 24px;
    height: 24px;
    color: #0ea5e9;
}

.dark .message-icon {
    color: #60a5fa;
}

/* Content */
.conversation-content {
    flex-grow: 1;
    min-width: 0;
}

.conversation-header {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.contact-name {
    font-size: 1.125rem;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.dark .contact-name {
    color: #f3f4f6;
}

.message-time {
    font-size: 0.875rem;
    color: #6b7280;
    flex-shrink: 0;
}

.dark .message-time {
    color: #9ca3af;
}

.annonce-title {
    font-size: 0.875rem;
    color: #3b82f6;
    margin: 0 0 0.5rem 0;
    font-weight: 500;
}

.dark .annonce-title {
    color: #60a5fa;
}

/* Footer */
.conversation-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.message-preview {
    font-size: 0.875rem;
    color: #4b5563;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dark .message-preview {
    color: #9ca3af;
}

.unread-count {
    background: #3b82f6;
    color: white;
    font-size: 0.75rem;
    min-width: 24px;
    height: 24px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 0.5rem;
    flex-shrink: 0;
}

.dark .unread-count {
    background: #2563eb;
}

/* Empty state */
.empty-conversations {
    text-align: center;
    padding: 4rem 1rem;
    color: #6b7280;
}

.empty-conversations h3 {
    font-size: 1.25rem;
    color: #111827;
    margin: 1rem 0 0.5rem;
}

.dark .empty-conversations h3 {
    color: #f3f4f6;
}

.empty-conversations svg {
    width: 64px;
    height: 64px;
    color: #9ca3af;
    margin: 0 auto;
}

.dark .empty-conversations svg {
    color: #6b7280;
}

@media (max-width: 640px) {
    .conversation-item {
        padding: 1rem;
        gap: 1rem;
    }
    
    .conversation-icon {
        width: 40px;
        height: 40px;
    }
    
    .message-icon {
        width: 20px;
        height: 20px;
    }
    
    .contact-name {
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.back-button, .inline-flex.items-center.gap-1\\.5');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            
            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;
            
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});
</script>