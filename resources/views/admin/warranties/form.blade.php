@extends('layouts.admin')
@section('title', isset($warranty) ? 'Edit Warranty — ' . $warranty->serial_number : 'Register New Warranty')
@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.warranties') }}" class="p-2 text-warm-500 hover:bg-warm-100 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h1 class="text-2xl font-bold">{{ isset($warranty) ? 'Edit Warranty' : 'Register New Warranty' }}</h1>
        @if(isset($warranty))
            <span class="ml-auto font-mono text-accent-600 text-sm bg-accent-50 px-3 py-1 rounded-lg">{{ $warranty->serial_number }}</span>
        @endif
    </div>

    <form action="{{ isset($warranty) ? route('admin.warranties.update', $warranty) : route('admin.warranties.store') }}"
          method="POST" enctype="multipart/form-data" class="space-y-6" x-data="warrantyForm()">
        @csrf
        @if(isset($warranty)) @method('PUT') @endif

        {{-- Product Info --}}
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
            <h2 class="text-lg font-bold text-warm-800 mb-4">📦 Product Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Product Name <span class="text-red-500">*</span></label>
                    <input type="text" name="product_name" value="{{ old('product_name', $warranty->product_name ?? '') }}" placeholder="e.g. Lenz Breeze Polarized Single Vision" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 focus:border-accent-500 outline-none">
                    @error('product_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Order Number / Serial <span class="text-warm-400 text-xs font-normal">(auto if blank)</span></label>
                    <div class="flex gap-2">
                        <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $warranty->serial_number ?? '') }}" placeholder="LB-XXXXXXXX" class="flex-1 px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none font-mono uppercase" {{ isset($warranty) ? 'readonly' : '' }}>
                        @if(!isset($warranty))
                        <button type="button" id="fetch-order-btn" onclick="fetchOrder()" class="px-3 py-2 bg-warm-100 hover:bg-warm-200 text-warm-700 rounded-lg text-sm font-semibold transition-colors border border-warm-300 whitespace-nowrap">Fetch Order</button>
                        @endif
                    </div>
                    @error('serial_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Customer Details --}}
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
            <h2 class="text-lg font-bold text-warm-800 mb-4">👤 Customer Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $warranty->customer_name ?? '') }}" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                    @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Phone <span class="text-red-500">*</span></label>
                    <input type="tel" name="customer_phone" value="{{ old('customer_phone', $warranty->customer_phone ?? '') }}" placeholder="9876543210" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                    @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email', $warranty->customer_email ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Customer Photo</label>
                    <div class="flex items-center gap-4">
                        <input type="file" name="customer_photo" accept="image/*" @change="photoPreview = URL.createObjectURL($event.target.files[0])" class="w-full text-sm text-warm-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-accent-50 file:text-accent-700 hover:file:bg-accent-100">
                        <template x-if="photoPreview"><img :src="photoPreview" class="w-12 h-12 rounded-full object-cover border-2 border-warm-200"></template>
                        @if(isset($warranty) && $warranty->customer_photo)
                            <img src="{{ $warranty->customer_photo_url }}" class="w-12 h-12 rounded-full object-cover border-2 border-warm-200" x-show="!photoPreview">
                        @endif
                    </div>
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Full Address <span class="text-red-500">*</span></label>
                    <textarea name="customer_address" rows="2" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">{{ old('customer_address', $warranty->customer_address ?? '') }}</textarea>
                    @error('customer_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Eye Prescription --}}
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
            <h2 class="text-lg font-bold text-warm-800 mb-4">👁️ Eye Prescription</h2>
            @foreach(['right' => ['label' => 'Right Eye (OD)', 'badge' => 'R', 'color' => 'blue'], 'left' => ['label' => 'Left Eye (OS)', 'badge' => 'L', 'color' => 'green']] as $side => $info)
            <div class="mb-5">
                <h3 class="text-sm font-bold text-warm-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-{{ $info['color'] }}-100 text-{{ $info['color'] }}-700 flex items-center justify-center text-xs font-bold">{{ $info['badge'] }}</span>
                    {{ $info['label'] }}
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach(['sph' => 'SPH', 'cyl' => 'CYL', 'axis' => 'AXIS', 'add' => 'ADD'] as $field => $label)
                    <div class="space-y-1">
                        <label class="block text-xs font-medium text-warm-500">{{ $label }}</label>
                        <input type="number" step="{{ $field === 'axis' ? '1' : '0.25' }}" name="{{ $side }}_eye_{{ $field }}" value="{{ old($side.'_eye_'.$field, $warranty->{$side.'_eye_'.$field} ?? '') }}" placeholder="{{ $field === 'axis' ? '0' : '0.00' }}" {{ $field === 'axis' ? 'min=0 max=180' : '' }} class="w-full px-3 py-2 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none text-sm">
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            <div class="max-w-xs">
                <label class="block text-xs font-medium text-warm-500 mb-1">PD (mm)</label>
                <input type="number" step="0.5" name="pupillary_distance" value="{{ old('pupillary_distance', $warranty->pupillary_distance ?? '') }}" placeholder="64.0" class="w-full px-3 py-2 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none text-sm">
            </div>
        </div>

        {{-- Lens Details --}}
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
            <h2 class="text-lg font-bold text-warm-800 mb-4">🔬 Lens Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Lens Type <span class="text-red-500">*</span></label>
                    <select name="lens_type" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                        <option value="">Select...</option>
                        @foreach(['Single Vision','Bifocal','Progressive','Reading','Sunglasses'] as $t)
                            <option value="{{ $t }}" {{ old('lens_type', $warranty->lens_type ?? '') === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('lens_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Coating <span class="text-red-500">*</span></label>
                    <select name="lens_coating" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                        <option value="">Select...</option>
                        @foreach(['Anti-Glare','Blue Cut','Anti-Glare + Blue Cut','Photochromic','Polarized','Polarized + Blue Cut','HMC Blue','HMC Green'] as $c)
                            <option value="{{ $c }}" {{ old('lens_coating', $warranty->lens_coating ?? '') === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                    @error('lens_coating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Index</label>
                    <select name="lens_index" class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                        <option value="">Select...</option>
                        @foreach(['1.50','1.56','1.60','1.67','1.74'] as $i)
                            <option value="{{ $i }}" {{ old('lens_index', $warranty->lens_index ?? '') === $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Manufacturing Date</label>
                    <input type="date" name="manufacturing_date" value="{{ old('manufacturing_date', isset($warranty) && $warranty->manufacturing_date ? $warranty->manufacturing_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Batch Number</label>
                    <input type="text" name="batch_number" value="{{ old('batch_number', $warranty->batch_number ?? '') }}" placeholder="BATCH-2026-001" class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                </div>
            </div>
        </div>

        {{-- Sale & Warranty --}}
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
            <h2 class="text-lg font-bold text-warm-800 mb-4">📅 Sale & Warranty</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Retailer <span class="text-red-500">*</span></label>
                    <select name="retailer_id" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                        <option value="">Select Retailer...</option>
                        @foreach($retailers as $r)
                            <option value="{{ $r->id }}" {{ old('retailer_id', $warranty->retailer_id ?? '') == $r->id ? 'selected' : '' }}>{{ $r->name }} ({{ $r->retailer_code }})</option>
                        @endforeach
                    </select>
                    @error('retailer_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Purchase Date <span class="text-red-500">*</span></label>
                    <input type="date" name="purchase_date" x-model="purchaseDate" @change="calcExpiry()" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Duration <span class="text-red-500">*</span></label>
                    <select name="warranty_months" x-model="warrantyMonths" @change="calcExpiry()" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                        <option value="6" {{ old('warranty_months', $warranty->warranty_months ?? 12) == 6 ? 'selected' : '' }}>6 Months</option>
                        <option value="12" {{ old('warranty_months', $warranty->warranty_months ?? 12) == 12 ? 'selected' : '' }}>1 Year</option>
                        <option value="24" {{ old('warranty_months', $warranty->warranty_months ?? 12) == 24 ? 'selected' : '' }}>2 Years</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 p-3 bg-accent-50 rounded-lg border border-accent-100">
                <p class="text-sm text-accent-700"><span class="font-semibold">Warranty Expires:</span> <span x-text="expiryDate" class="font-mono font-bold"></span></p>
            </div>
        </div>

        {{-- Status & Claims (edit only) --}}
        @if(isset($warranty))
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
            <h2 class="text-lg font-bold text-warm-800 mb-4">📋 Status & Claims</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">
                        @foreach(\App\Models\Warranty::STATUSES as $s)
                            <option value="{{ $s }}" {{ old('status', $warranty->status) === $s ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$s)) }}</option>
                        @endforeach
                    </select>
                </div>
                @if($warranty->claim_date)
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Claim Date</label>
                    <p class="px-4 py-2.5 rounded-lg bg-warm-50 border border-warm-200 text-warm-600">{{ $warranty->claim_date->format('M d, Y') }}</p>
                </div>
                @endif
                <div class="md:col-span-2 space-y-2">
                    <label class="block text-sm font-semibold text-warm-700">Claim Notes</label>
                    <textarea name="claim_notes" rows="3" placeholder="Issue details, resolution..." class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">{{ old('claim_notes', $warranty->claim_notes ?? '') }}</textarea>
                </div>
            </div>
        </div>
        @endif

        {{-- Notes --}}
        <div class="bg-white rounded-xl shadow-sm border border-warm-200 p-6">
            <label class="block text-sm font-semibold text-warm-700 mb-2">Internal Notes</label>
            <textarea name="notes" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-warm-300 focus:ring-2 focus:ring-accent-500 outline-none">{{ old('notes', $warranty->notes ?? '') }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.warranties') }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary min-w-[180px]">{{ isset($warranty) ? 'Update Warranty' : 'Register & Generate' }}</button>
        </div>
    </form>
</div>
@push('scripts')
<script>
function warrantyForm() {
    return {
        photoPreview: null,
        purchaseDate: '{{ old("purchase_date", isset($warranty) ? $warranty->purchase_date->format("Y-m-d") : date("Y-m-d")) }}',
        warrantyMonths: '{{ old("warranty_months", $warranty->warranty_months ?? 12) }}',
        expiryDate: '',
        init() { this.calcExpiry(); },
        calcExpiry() {
            if (this.purchaseDate) {
                const d = new Date(this.purchaseDate);
                d.setMonth(d.getMonth() + parseInt(this.warrantyMonths));
                this.expiryDate = d.toLocaleDateString('en-US', {year:'numeric',month:'short',day:'numeric'});
            }
        }
    }
}

function fetchOrder() {
    let orderNo = document.getElementById('serial_number').value;
    if(!orderNo) return alert('Please enter an Order Number / Serial Number first.');
    let btn = document.getElementById('fetch-order-btn');
    btn.innerHTML = 'Fetching...';
    btn.disabled = true;
    
    fetch('{{ route("admin.warranties.order-lookup") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', 
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({order_number: orderNo})
    })
    .then(r => r.json())
    .then(data => {
        btn.innerHTML = 'Fetch Order';
        btn.disabled = false;
        
        if(data.found) {
            document.querySelector('[name="customer_name"]').value = data.customer_name;
            document.querySelector('[name="customer_phone"]').value = data.customer_phone;
            document.querySelector('[name="customer_email"]').value = data.customer_email;
            document.querySelector('[name="customer_address"]').value = data.customer_address;
            document.querySelector('[name="product_name"]').value = data.product_name;
            
            // Auto-dispatch alpine reactive event for purchaseDate
            let pd = document.querySelector('[name="purchase_date"]');
            pd.value = data.purchase_date;
            pd.dispatchEvent(new Event('input', { bubbles: true }));
            pd.dispatchEvent(new Event('change', { bubbles: true }));
        } else {
            alert('Order not found in SalePro!');
        }
    })
    .catch(e => {
        btn.innerHTML = 'Fetch Order';
        btn.disabled = false;
        alert('Error fetching order');
        console.error(e);
    });
}
</script>
@endpush
@endsection
