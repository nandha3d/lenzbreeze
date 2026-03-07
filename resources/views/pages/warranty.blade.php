@extends('layouts.app')
@section('title', 'Premium Warranty Certificate')
@section('content')
<div class="min-h-screen py-20 bg-[#F9F7F2]">
    <div class="container-custom max-w-4xl px-4">
        {{-- Search Box --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-[#1A1A1A] mb-4">Warranty Verification</h1>
            <p class="text-[#666] max-w-xl mx-auto">Verify the authenticity of your premium Lenz Breeze optics and track your lifetime vision protection.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-[#E5E1D8] overflow-hidden mb-12">
            <div class="p-8 md:p-14 border-b border-[#F0EEE8]">
                <form action="{{ route('warranty') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative group">
                        <input type="text" name="serial" value="{{ request('serial') }}" placeholder="LB-XXXXXX" required
                               class="w-full pl-14 pr-6 py-5 rounded-2xl border-2 border-[#F0EEE8] bg-[#FCFBFA] focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/5 outline-none transition-all font-mono text-xl uppercase tracking-widest placeholder:text-[#C0B7A2]">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-[#D4AF37]">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                    </div>
                    <button type="submit" class="md:w-64 bg-[#1A1A1A] text-white py-5 rounded-2xl font-bold text-lg hover:bg-black transition-all shadow-xl shadow-black/10">Verify Status</button>
                </form>

                @if(session('error'))
                    <div class="mt-6 p-5 bg-[#FFF5F5] border border-[#FFE0E0] rounded-2xl flex items-center gap-4 text-[#D32F2F]">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.07 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        <p class="text-sm font-semibold">{{ session('error') }}</p>
                    </div>
                @endif
            </div>

            {{-- Golden Premium Warranty Card --}}
            @if(isset($warranty))
            <div id="warranty-card" class="bg-white p-4 md:p-14">
                <div class="relative group cursor-default">
                    {{-- The Physical Card - Modern Premium Black --}}
                    <div class="quilted-card-base relative aspect-[1.586/1] w-full rounded-[1.5rem] md:rounded-[2.5rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.6)] overflow-hidden transition-all duration-700 hover:scale-[1.01] border border-white/5">
                        {{-- Quilted Pattern Overlay --}}
                        <div class="absolute inset-0 quilted-pattern opacity-80"></div>
                        
                        {{-- Real DOM element for dots to ensure html2canvas captures them (SVG for reliability) --}}
                        <div class="quilted-dots absolute inset-0"></div>
                        
                        {{-- Pattern Fade Overlay (Real element for better export capture) --}}
                        <div class="absolute inset-0 pointer-events-none bg-gradient-to-l from-transparent via-[#020202]/50 to-[#020202]"></div>
                        
                        {{-- Gold Shine Shimmer --}}
                        <div class="absolute inset-0 gold-shine opacity-10"></div>

                        {{-- Main Content Area --}}
                        <div class="relative z-10 p-8 md:p-14 h-full flex flex-col justify-between">
                            {{-- Top Section: Large Logo & Optional Photo --}}
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="w-40 md:w-64 transition-transform duration-700 group-hover:scale-105">
                                        <img src="{{ asset('images/logo-icon.png') }}" alt="Lenz Breeze" class="w-24 h-auto object-contain">
                                    </div>
                                    <p class="mt-2 text-[#D4AF37] text-[8px] md:text-xs font-black uppercase tracking-[0.6em] ml-1 drop-shadow-md italic">Create A New World</p>
                                </div>
                                
                                {{-- Customer Photo (Right Corner) --}}
                                @if($warranty->customer_photo)
                                <div id="customer-photo-container" class="w-16 h-16 md:w-32 md:h-32 rounded-2xl border-2 border-[#D4AF37]/30 overflow-hidden shadow-2xl transform rotate-3 group-hover:rotate-0 transition-transform duration-700 bg-black/20 backdrop-blur-sm">
                                    <img src="{{ asset('storage/' . $warranty->customer_photo) }}" alt="{{ $warranty->customer_name }}" class="w-full h-full object-cover">
                                </div>
                                @endif
                            </div>

                            {{-- Middle Section: Holder Name & Serial --}}
                            <div class="-mt-4 md:-mt-12">
                                <div class="mb-2 md:mb-4">
                                    <h4 class="embossed-gold text-lg md:text-4xl uppercase tracking-wider drop-shadow-xl">{{ $warranty->customer_name }}</h4>
                                </div>
                                <p id="serial-number-text" data-serial="{{ $warranty->serial_number }}" class="font-mono text-base md:text-3xl text-white/80 tracking-[0.4em] font-black embossed-text-heavy select-none drop-shadow-2xl">
                                    {{ strtoupper($warranty->serial_number) }}
                                </p>
                            </div>

                            {{-- Placeholder for spacing --}}
                            <div class="h-8 md:h-16"></div>
                        </div>

                        {{-- Golden Footer Slant --}}
                        <div class="absolute bottom-0 left-0 right-0 h-16 md:h-28 gold-footer-slant overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/30 to-transparent animate-pulse"></div>
                            <div class="h-full flex items-center justify-between px-8 md:px-14 relative z-10">
                                <div class="flex gap-8 md:gap-20">
                                    <div class="flex flex-col">
                                        <span class="text-black/40 text-[8px] md:text-[10px] font-black uppercase tracking-widest">Valid Thru</span>
                                        <span class="text-black font-black font-mono text-xs md:text-xl">{{ $warranty->expiry_date->format('m/y') }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-black/40 text-[8px] md:text-[10px] font-black uppercase tracking-widest">Since</span>
                                        <span class="text-black font-black font-mono text-xs md:text-xl">{{ $warranty->purchase_date->format('Y') }}</span>
                                    </div>
                                </div>
                                {{-- Logo Icon --}}
                                <div class="h-8 md:h-14 opacity-20">
                                    <img src="{{ asset('images/logo-icon.png') }}" class="h-full w-auto object-contain brightness-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Status Bar --}}
                <div class="mt-12 flex flex-wrap items-center justify-between gap-6 p-8 bg-[#FCFBFA] rounded-[2rem] border border-[#F0EEE8]">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-[#A09A8E] uppercase tracking-widest">Current Status</p>
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-{{ $warranty->status_color }}-500 animate-pulse"></span>
                            <span class="text-xl font-bold text-[#1A1A1A]">{{ $warranty->status_label }}</span>
                        </div>
                    </div>
                    <div class="space-y-1 text-right">
                        <p class="text-[10px] font-bold text-[#A09A8E] uppercase tracking-widest">Validity Remaining</p>
                        <p class="text-xl font-bold text-[#1A1A1A]">
                            @if($warranty->expiry_date->isPast())
                                <span class="text-red-500">Expired</span>
                            @else
                                {{ $warranty->expiry_date->diffForHumans(null, true) }}
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Details Section --}}
                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-12">
                    {{-- Prescription Table --}}
                    <div class="space-y-6">
                        <h4 class="text-sm font-bold text-[#1A1A1A] uppercase tracking-[0.2em] flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-[#D4AF37]"></span>
                            Eye Prescription
                        </h4>
                        <div class="overflow-hidden rounded-2xl border border-[#F0EEE8]">
                            <table class="w-full text-sm">
                                <thead class="bg-[#FCFBFA] border-b border-[#F0EEE8]">
                                    <tr class="text-[#A09A8E] text-[10px] font-bold uppercase tracking-wider">
                                        <th class="px-5 py-4 text-left">Eye</th>
                                        <th class="px-5 py-4 text-center">SPH</th>
                                        <th class="px-5 py-4 text-center">CYL</th>
                                        <th class="px-5 py-4 text-center">AXIS</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#F0EEE8]">
                                    <tr class="bg-white hover:bg-[#FCFBFA] transition-colors">
                                        <td class="px-5 py-4 font-bold text-[#1A1A1A]">Right (OD)</td>
                                        <td class="px-5 py-4 text-center font-mono text-[#666]">{{ $warranty->right_eye_sph ?? '0.00' }}</td>
                                        <td class="px-5 py-4 text-center font-mono text-[#666]">{{ $warranty->right_eye_cyl ?? '0.00' }}</td>
                                        <td class="px-5 py-4 text-center font-mono text-[#666]">{{ $warranty->right_eye_axis ?? '0' }}°</td>
                                    </tr>
                                    <tr class="bg-white hover:bg-[#FCFBFA] transition-colors">
                                        <td class="px-5 py-4 font-bold text-[#1A1A1A]">Left (OS)</td>
                                        <td class="px-5 py-4 text-center font-mono text-[#666]">{{ $warranty->left_eye_sph ?? '0.00' }}</td>
                                        <td class="px-5 py-4 text-center font-mono text-[#666]">{{ $warranty->left_eye_cyl ?? '0.00' }}</td>
                                        <td class="px-5 py-4 text-center font-mono text-[#666]">{{ $warranty->left_eye_axis ?? '0' }}°</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-between p-4 bg-[#FCFBFA] rounded-xl border border-[#F0EEE8] text-sm font-semibold">
                            <span class="text-[#A09A8E]">Pupillary Distance</span>
                            <span class="text-[#1A1A1A]">{{ $warranty->pupillary_distance ?? '64.0' }} mm</span>
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="space-y-6">
                        <h4 class="text-sm font-bold text-[#1A1A1A] uppercase tracking-[0.2em] flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-[#D4AF37]"></span>
                            Product Details
                        </h4>
                        <div class="bg-[#FCFBFA] p-8 rounded-[2rem] border border-[#F0EEE8] space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-[#F0EEE8] shrink-0">📦</div>
                                <div>
                                    <p class="text-[10px] font-bold text-[#A09A8E] uppercase tracking-widest mb-1">Product Name</p>
                                    <p class="font-bold text-[#1A1A1A]">{{ $warranty->product_name }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-[#F0EEE8] shrink-0">✨</div>
                                <div>
                                    <p class="text-[10px] font-bold text-[#A09A8E] uppercase tracking-widest mb-1">Lens & Coating</p>
                                    <p class="font-bold text-[#1A1A1A]">{{ $warranty->lens_type }} • {{ $warranty->lens_coating }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center border border-[#F0EEE8] shrink-0">🏪</div>
                                <div>
                                    <p class="text-[10px] font-bold text-[#A09A8E] uppercase tracking-widest mb-1">Retailer</p>
                                    <p class="font-bold text-[#1A1A1A]">{{ $warranty->retailer->name ?? 'Vision Opticals' }}</p>
                                    <p class="text-xs text-[#A09A8E]">{{ $warranty->retailer->city ?? 'Chennai' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-12 flex flex-col sm:flex-row flex-wrap gap-4 print:hidden">
                    <button id="download-png-btn" onclick="downloadCard('png', event)" class="flex-1 bg-white text-[#1A1A1A] py-5 rounded-2xl font-bold border-2 border-[#1A1A1A] hover:bg-[#1A1A1A] hover:text-white transition-all flex items-center justify-center gap-3 group">
                        <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download PNG
                    </button>
                    <button onclick="downloadCard('pdf', event)" class="flex-1 bg-white text-[#1A1A1A] py-5 rounded-2xl font-bold border-2 border-[#1A1A1A] hover:bg-[#1A1A1A] hover:text-white transition-all flex items-center justify-center gap-3 group">
                        <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Download PDF
                    </button>
                    <button onclick="window.print()" class="flex-1 bg-white text-[#1A1A1A] py-5 rounded-2xl font-bold border-2 border-[#1A1A1A] hover:bg-[#1A1A1A] hover:text-white transition-all flex items-center justify-center gap-3">
                        🖨️ Print Full Page
                    </button>
                    <a href="{{ route('home') }}" class="flex-1 bg-[#F0EEE8] text-[#1A1A1A] py-5 rounded-2xl font-bold hover:bg-[#E5E1D8] transition-all flex items-center justify-center">
                        Back to Home
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    // Define globally
    window.downloadCard = async function(format, event) {
        if (typeof html2canvas === 'undefined') {
            console.error('html2canvas library not loaded');
            alert('The download library is still loading. Please wait a few seconds and try again.');
            return;
        }

        const cardBody = document.querySelector('#warranty-card > div');
        if (!cardBody) {
            console.error('Card element not found');
            return;
        }

        // Get serial number from data attribute
        const serialEl = document.getElementById('serial-number-text');
        const serial = serialEl ? serialEl.getAttribute('data-serial') : 'EYE-MEK';

        // Show loading state
        const btn = event.currentTarget;
        const originalBtnText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<svg class="animate-spin h-5 w-5 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Generating...`;

        try {
            const canvas = await html2canvas(cardBody, {
                scale: 3,
                useCORS: true,
                allowTaint: false,
                backgroundColor: null,
                logging: false,
                onclone: (clonedDoc) => {
                    const clonedCard = clonedDoc.querySelector('#warranty-card > div');
                    if (clonedCard) {
                        // Force specific dimensions for "Exact Format"
                        clonedCard.style.width = '1200px';
                        clonedCard.style.height = '756px'; // 1.586 ratio
                        clonedCard.style.transform = 'none';
                        clonedCard.style.padding = '0';
                        clonedCard.style.margin = '0';
                        
                        // Fix 1: Straighten Photo
                        const photo = clonedCard.querySelector('#customer-photo-container');
                        if (photo) photo.style.transform = 'rotate(0deg)';
                        
                        // Fix 2: Handle Embossed Gold Text (html2canvas compatibility)
                        const embossed = clonedCard.querySelectorAll('.embossed-gold');
                        embossed.forEach(el => {
                            el.style.webkitBackgroundClip = 'initial';
                            el.style.webkitTextFillColor = '#D4AF37';
                            el.style.color = '#D4AF37';
                            el.style.textShadow = '0 2px 4px rgba(0,0,0,0.5)';
                            el.style.background = 'none';
                        });

                        // Fix 3: Pattern & Mask Compatibility
                        const patterns = clonedCard.querySelectorAll('.quilted-pattern');
                        patterns.forEach(p => {
                            // Don't overwrite background, just ensure it's visible
                            p.style.opacity = '0.9';
                        });

                        // Fix 4: Force high visibility for dots (SVG background is reliable)
                        const dots = clonedCard.querySelectorAll('.quilted-dots');
                        dots.forEach(d => {
                            d.style.opacity = '1';
                        });
                    }
                }
            });

            if (format === 'png') {
                const imgData = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.download = `EYE-MEK-Warranty-${serial}.png`;
                link.href = imgData;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else if (format === 'pdf') {
                const { jsPDF } = window.jspdf;
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF({
                    orientation: 'landscape',
                    unit: 'px',
                    format: [canvas.width, canvas.height]
                });
                pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
                pdf.save(`EYE-MEK-Warranty-${serial}.pdf`);
            }
        } catch (error) {
            console.error('Download Error:', error);
            alert('Download failed. Please try printing the page instead.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalBtnText;
        }
    };
</script>
@endpush

<style>
    .quilted-card-base {
        background: #020202; /* Even darker base */
        position: relative;
    }

    .quilted-pattern {
        position: absolute;
        inset: 0;
        background-color: #050505;
        /* Balanced Diamond Quilted Pattern */
        background-image: 
            /* Shading for the quilted 3D effect */
            linear-gradient(135deg, #1a1a1a 25%, transparent 25%),
            linear-gradient(225deg, #1a1a1a 25%, transparent 25%),
            linear-gradient(45deg, #0a0a0a 25%, transparent 25%),
            linear-gradient(315deg, #0a0a0a 25%, transparent 25%);
        background-position: 40px 0, 40px 0, 0 0, 0 0;
        background-size: 80px 80px;
        opacity: 0.95;
    }

    /* Small gold dots at the corners of the diamonds - SVG is perfect for html2canvas */
    .quilted-dots {
        /* Aligned with 40px grid (dots every 40px) */
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='20' cy='20' r='1.8' fill='%23FFD700' /%3E%3Ccircle cx='20' cy='20' r='3.5' fill='%23D4AF37' opacity='0.4' /%3E%3C/svg%3E");
        background-size: 40px 40px;
        background-position: 0 0;
        opacity: 1;
    }

    /* Subtle 3D Depth radial overlay - concentrated more towards the right */
    .quilted-pattern::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 80% 50%, transparent 20%, rgba(0,0,0,0.7) 100%);
        pointer-events: none;
    }

    /* Stronger Inverse fade (Right to Left) */
    .quilted-pattern {
        mask-image: linear-gradient(to left, rgba(0,0,0,1) 20%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0) 100%);
        -webkit-mask-image: linear-gradient(to left, rgba(0,0,0,1) 20%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0) 100%);
    }

    .gold-footer-slant {
        background: linear-gradient(135deg, #D4AF37 0%, #F9E79F 30%, #D4AF37 50%, #B8860B 70%, #F7DC6F 100%);
        box-shadow: 0 -5px 15px rgba(0,0,0,0.3);
    }

    .embossed-gold {
        color: #D4AF37;
        background: linear-gradient(to bottom, #F9E79F 0%, #D4AF37 50%, #B8860B 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.8)) drop-shadow(0px -1px 1px rgba(255,255,255,0.1));
        font-weight: 900;
    }

    .embossed-text-heavy {
        color: #E8D090;
        text-shadow: 
            -1px -1px 0px rgba(255,255,255,0.1),
            1px 1px 2px rgba(0,0,0,1),
            2px 2px 4px rgba(0,0,0,0.8);
        letter-spacing: 0.4em;
    }

    .gold-shine {
        background: linear-gradient(110deg, 
            transparent 35%, 
            rgba(255, 255, 255, 0.1) 45%, 
            rgba(255, 255, 255, 0.2) 50%, 
            rgba(255, 255, 255, 0.1) 55%, 
            transparent 65%
        );
        background-size: 200% 100%;
        animation: card-shimmer 8s infinite;
    }

    @keyframes card-shimmer {
        0% { background-position: -200% 0% }
        100% { background-position: 200% 0% }
    }

    @media print {
        header, footer, nav, .print\:hidden { display: none !important; }
        body { background: white !important; }
        .min-h-screen { padding: 0 !important; }
        .quilted-card-base {
            padding: 2rem !important;
            box-shadow: none !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            background: #0a0a0a !important;
        }
        .container-custom { max-width: 100% !important; }
        #warranty-card { padding: 0 !important; }
        .text-white { color: white !important; }
    }
</style>
@endsection
