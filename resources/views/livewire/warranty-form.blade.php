<div>
    @if($success)
        <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-green-100 mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="font-display text-xl font-bold text-green-800 mb-2">Warranty Claim Submitted!</h3>
            <p class="text-green-700 text-sm">Your claim has been received. Our team will review and get back to you within <strong>2–3 business days</strong> via email or phone.</p>
            <p class="text-green-600 text-xs mt-3">Reference will be sent to your email.</p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-5">
            {{-- Personal Info --}}
            <div>
                <h3 class="font-display text-sm font-bold text-brand-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Your Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-warm-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="name" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none text-sm" placeholder="John Doe">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-warm-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                        <input type="email" wire:model="email" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none text-sm" placeholder="john@email.com">
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-warm-700 mb-1.5">Phone <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="phone" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none text-sm" placeholder="+91 XXXXX XXXXX">
                        @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Product / Purchase Info --}}
            <div class="pt-4 border-t border-warm-100">
                <h3 class="font-display text-sm font-bold text-brand-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Purchase Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-warm-700 mb-1.5">Product / Lens Name <span class="text-red-500">*</span></label>
                        <select wire:model="product_name" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none text-sm bg-white">
                            <option value="">Select a product...</option>
                            <option value="Single Vision RX">Single Vision RX</option>
                            <option value="Premium Progressive RX">Premium Progressive RX</option>
                            <option value="Kryptok Bifocals">Kryptok Bifocals</option>
                            <option value="D Bifocal Lens">D Bifocal Lens</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('product_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-warm-700 mb-1.5">Purchase Date <span class="text-red-500">*</span></label>
                        <input type="date" wire:model="purchase_date" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none text-sm">
                        @error('purchase_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-warm-700 mb-1.5">Retailer / Shop Name <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="retailer_name" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none text-sm" placeholder="Optical shop name">
                        @error('retailer_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-warm-700 mb-1.5">Invoice / Bill Number</label>
                        <input type="text" wire:model="invoice_number" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none text-sm" placeholder="e.g. INV-00123 (optional)">
                        @error('invoice_number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Issue Description --}}
            <div class="pt-4 border-t border-warm-100">
                <h3 class="font-display text-sm font-bold text-brand-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    Describe the Issue
                </h3>
                <div>
                    <label class="block text-sm font-medium text-warm-700 mb-1.5">What's wrong with the lens? <span class="text-red-500">*</span></label>
                    <textarea wire:model="issue_description" rows="4" class="w-full px-4 py-3 rounded-xl border border-warm-300 focus:border-brand-400 focus:ring-2 focus:ring-brand-400/20 transition-all outline-none resize-none text-sm" placeholder="E.g. Coating peeling, scratches, vision blurriness, breakage..."></textarea>
                    @error('issue_description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit" class="btn-primary w-full text-center justify-center">
                    <span wire:loading.remove class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Submit Warranty Claim
                    </span>
                    <span wire:loading class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        Submitting...
                    </span>
                </button>
                <p class="text-xs text-warm-400 text-center mt-3">Your information is secure. We'll only use it to process your warranty claim.</p>
            </div>
        </form>
    @endif
</div>
