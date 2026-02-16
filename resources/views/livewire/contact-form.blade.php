<div>
    @if($success)
        <div class="bg-accent-50 border border-accent-200 rounded-lg p-4 text-accent-700">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="font-medium">Thank you! Your message has been sent. We'll get back to you soon.</span>
            </div>
        </div>
    @else
        <form wire:submit="submit" class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" wire:model="name" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/20 transition-all outline-none" placeholder="Your name">
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" wire:model="email" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/20 transition-all outline-none" placeholder="your@email.com">
                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Phone</label>
                    <input type="text" wire:model="phone" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/20 transition-all outline-none" placeholder="+91 XXXXX XXXXX">
                    @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">Company</label>
                    <input type="text" wire:model="company" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/20 transition-all outline-none" placeholder="Company name">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Inquiry Type</label>
                <select wire:model="type" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/20 transition-all outline-none bg-white">
                    <option value="general">General Inquiry</option>
                    <option value="partnership">Partnership Inquiry</option>
                    <option value="product">Product Inquiry</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Subject</label>
                <input type="text" wire:model="subject" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/20 transition-all outline-none" placeholder="How can we help?">
            </div>
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Message <span class="text-red-500">*</span></label>
                <textarea wire:model="message" rows="5" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/20 transition-all outline-none resize-none" placeholder="Tell us about your requirements..."></textarea>
                @error('message') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn-primary w-full md:w-auto">
                <span wire:loading.remove>Send Message</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    Sending...
                </span>
            </button>
        </form>
    @endif
</div>
