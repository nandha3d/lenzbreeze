<div>
    @if($success)
        <p class="text-accent-400 text-sm font-medium flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Subscribed successfully!
        </p>
    @else
        <form wire:submit="subscribe" class="flex gap-2">
            <input type="email" wire:model="email" aria-label="Email address" placeholder="Enter your email" class="flex-1 min-w-0 px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-warm-400 focus:border-accent-400 focus:ring-2 focus:ring-accent-400/20 outline-none transition-all text-sm">
            <button type="submit" class="px-5 py-3 rounded-lg bg-accent-500 hover:bg-accent-600 text-white font-medium text-sm transition-colors shrink-0">
                <span wire:loading.remove>Subscribe</span>
                <span wire:loading>...</span>
            </button>
        </form>
        @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        @if($errorMessage) <p class="text-yellow-400 text-xs mt-1">{{ $errorMessage }}</p> @endif
    @endif
</div>
