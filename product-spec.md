# EYE MEK – Product Page Design Specification
> **For AI Agent Use**: This document defines all product data, variant logic, design system tokens, and UI/UX requirements for refactoring the product detail page (`resources/views/pages/products/show.blade.php`) and the product listing page (`resources/views/pages/products/index.blade.php`) in the Lenz Breeze Laravel + Alpine.js + Tailwind CSS v4 project.

---

## 1. Tech Stack Context

- **Framework**: Laravel 11 (Blade templates)
- **CSS**: Tailwind CSS v4 (via `@theme` in `app.css`)
- **JS**: Alpine.js (x-data, x-show, x-transition, x-cloak)
- **Fonts**: `Outfit` (display), `Inter` (body) — loaded via Google Fonts in the layout
- **Icons**: Inline SVGs only (no icon library)
- **Animation**: CSS transitions + Alpine.js transitions
- **Do NOT change**: layouts, header, footer, CSS `@theme` tokens, routes, controllers, models, seeder

---

## 2. Design System Tokens (from `app.css @theme`)

```
Brand (Navy):    brand-500 = #0e3558  |  brand-700 = #0a243d  |  brand-900 = #04101d
Accent (Teal):   accent-500 = #00afb0 |  accent-600 = #009494 |  accent-50 = #e6fafa
EYE MEK Theme:   accent-500 = #f1b51c (Gold)  — active inside .theme-eyemek wrapper
Warm Gray:       warm-50 = #fafaf9  |  warm-200 = #e7e5e4  |  warm-400 = #a8a29e  |  warm-600 = #57534e
```

**Existing utility classes to reuse:**
- `.btn-primary` — teal gradient button with shadow
- `.btn-secondary` — white/navy outline button
- `.card` — white rounded-2xl shadow-lg, hover lifts
- `.section-padding` — py-16 md:py-24
- `.container-custom` — max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
- `.gradient-brand` — navy diagonal gradient (for hero sections)
- `.variant-image-item` — clickable variant card
- `.variant-image-box` — 64×64px icon box
- `.variant-label` — tiny uppercase label
- `.info-popup` / `.info-popup-content` — modal overlay
- `.theme-eyemek` — overrides accent to gold (#f1b51c)

---

## 3. Product Catalogue & Variants

### 3.1 Single Vision (SV)
**DB slug**: `single-vision-rx`
**Brand**: EYE MEK
**Tagline**: "Your Vision, Upgraded."
**Category**: Single Vision Lenses

| # | Variant Name | `icon_type` | Description |
|---|---|---|---|
| 1 | CR 39 White | `clear` | Ultra-lightweight optical-grade material. Crystal clear with natural colour rendering. |
| 2 | Uncoated (UC) | `clear` | Pure base lens — ideal for those who prefer no additional coatings. |
| 3 | Hard Coat | `clear` | Industrial-grade scratch-resistant layer for active, on-the-go lifestyles. |
| 4 | Photochromic – Grey | `photochromic` | Seamlessly darkens to a natural grey tint outdoors. Clears indoors. |
| 4b | Photochromic – Brown | `photochromic` | Warm brown tint for enhanced contrast and comfortable outdoor viewing. |
| 5 | Blue Cut | `blue_cut` | Filters high-energy blue light from screens. Essential for digital professionals. |
| 6 | HD Digital | `blue_cut` | Precision-surfaced for edge-to-edge clarity. Best for higher prescriptions. |
| 7 | Polarized | `polarized` | Eliminates reflective glare. Perfect for driving, fishing, outdoor sports. |
| 8a | HMC Antiglare – Emerald Green | `antiglare` | Classic natural look. Reduces eye strain with a subtle green reflex. |
| 8b | HMC Antiglare – Sapphire Blue | `antiglare_blue` | Modern digital aesthetic. Sapphire blue reflex for a premium look. |
| 9 | Drive X | `drive` | Specialized filter for road clarity and reduced night-time glare. |

**Best For Tags**: Everyday Comfort · Active Lifestyles · Gamers · Digital Professionals · Outdoor Sports · Driving

---

### 3.2 Progressive (PRO)
**DB slug**: `premium-progressive-rx`
**Brand**: EYE MEK
**Tagline**: "Seamless Sight. Absolute Protection."
**Category**: Progressive Lenses

| # | Variant Name | `icon_type` | Description |
|---|---|---|---|
| 1 | CR 39 White | `clear` | Premium optical-grade base material. Lightweight and distortion-free. |
| 2 | Uncoated (UC) | `clear` | Clean base lens with no additional surface treatments. |
| 3 | Hard Coat | `clear` | Enhanced durability and scratch resistance for long-lasting wear. |
| 4a | Photochromic – Grey | `photochromic` | Adapts to outdoor light with a natural grey tint. Rapid activation. |
| 4b | Photochromic – Brown | `photochromic` | Warm-toned outdoor protection. Ideal for bright, high-contrast environments. |
| 5 | Polarized | `polarized` | Eliminates dashboard reflections and road glare for safer driving. |
| 6 | Blue Cut | `blue_cut` | Built-in screen protection for multi-device professionals. |
| 7 | HD Digital | `blue_cut` | Wider corridors, reduced "swim effect," faster adaptation. |
| 8a | HMC Antiglare – Emerald Green | `antiglare` | Natural green reflex. Classic anti-glare for everyday use. |
| 8b | HMC Antiglare – Sapphire Blue | `antiglare_blue` | Blue reflex. Modern tech-aesthetic finish for digital lifestyles. |
| 9 | Drive X | `drive` | Purpose-built for the driver. Sharpens road details, reduces night glare. |

**Key Technology Callout**: Drive X + HD Digital = "High-Performance" category. Addresses peripheral "swim" and driving glare — highlight as primary differentiators.

---

### 3.3 Kryptok Bifocal Lens (KBF)
**DB slug**: `kryptok-bifocals`
**Brand**: EYE MEK
**Tagline**: "The Trusted Classic, Reimagined."
**Category**: Bifocal Lenses

| # | Variant Name | `icon_type` | Description |
|---|---|---|---|
| 1 | CR 39 White | `clear` | Classic white optical material. Lightweight with clean optics. |
| 2 | Uncoated (UC) | `clear` | Standard bifocal without additional surface treatments. |
| 3 | Hard Coat | `clear` | Industrial-grade scratch resistance for daily durability. |
| 4a | Photochromic – Grey | `photochromic` | Smart light adaptation for both viewing zones. |
| 4b | Photochromic – Brown | `photochromic` | Warm tint for comfortable indoor-to-outdoor transitions. |
| 5 | Blue Cut | `blue_cut` | Digital eye-strain protection across both bifocal segments. |
| 6a | HMC Antiglare – Emerald Green | `antiglare` | Makes the bifocal segment line less visible. More aesthetic look. |
| 6b | HMC Antiglare – Sapphire Blue | `antiglare_blue` | Modern blue reflex. Hides the segment line for a premium appearance. |
| 7 | CR39 Lenticular KT | `clear` | Specialized thin design for high-power prescriptions. |

**Marketing Tip**: HMC coating makes the bifocal segment line less visible — emphasize aesthetic upgrade over standard bifocals.

---

### 3.4 D Bifocal / Flat Top BF (DBF)
**DB slug**: `drive-ease` *(or create new slug `d-bifocal-flat-top` if seeder is updated)*
**Brand**: EYE MEK
**Tagline**: "The Wide-Angle View."
**Category**: Bifocal Lenses

| # | Variant Name | `icon_type` | Description |
|---|---|---|---|
| 1 | CR39 White | `clear` | Ultra-clear CR-39 optical material. Lightweight for all-day comfort. |

**Key Differentiator**: Widest reading segment (Flat Top / "D" shape). Loved by readers and crafters. First-time bifocal wearers find the segment instantly.

---

## 4. `icon_type` to CSS Class Mapping

Each variant card uses an `icon_type` string that maps to a CSS class on `.variant-image-box`:

| `icon_type` | CSS class | Visual Style |
|---|---|---|
| `clear` | `.icon-clear` | Glass/crystal radial gradient (white → light blue) |
| `photochromic` | `.icon-photochromic` | White → grey gradient (light to dark) |
| `polarized` | `.icon-polarized` | Deep dark gradient (charcoal → black) |
| `blue_cut` | `.icon-blue_cut` | Blue radial gradient (light blue → electric blue) |
| `antiglare` | `.icon-antiglare` | Green radial gradient (mint → emerald) |
| `antiglare_blue` | `.icon-antiglare_blue` | **NEW** — Blue-indigo gradient for Sapphire HMC |
| `drive` | `.icon-drive` | Amber/orange diagonal gradient |

> **Action for AI**: Add `.icon-antiglare_blue` to `app.css` with style: `background: radial-gradient(circle at 30% 30%, rgba(196, 221, 255, 1) 0%, rgba(59, 130, 246, 1) 100%);`

---

## 5. Product Listing Page (`index.blade.php`) — UI/UX Requirements

### Hero Section
- Keep existing `.gradient-brand` hero
- Add animated floating lens shapes in hero background (CSS `@keyframes float`)
- Display category count below tagline: "X Premium Lens Collections"

### Category Filter Bar
- Sticky below header (existing: `top-18`)
- Make tabs pill-shaped with smooth indicator slide animation
- Add hover scale transform on individual pills

### Product Cards Grid
- Layout: 3 columns on lg, 2 on sm, 1 on mobile
- **Card redesign requirements:**
  - Aspect ratio top image area: `aspect-[4/3]`
  - Image area: gradient background with floating lens icon when no image
  - **Variant Count Badge**: Show `"9 Variants"` count badge on card (bottom-left of image area)
  - **Best For chips**: Show 2–3 "best for" tags at bottom of card (e.g. "Gamers", "Drivers")
  - Technology tags: max 3, styled as accent-50 pills
  - Hover: card lifts with shadow, arrow icon slides right
  - Active brand badge: top-left corner pill

### Data for Variant Count (hardcode per product):

| Slug | Variant Count |
|---|---|
| `single-vision-rx` | 9 Variants |
| `premium-progressive-rx` | 9 Variants |
| `kryptok-bifocals` | 7 Variants |
| `drive-ease` | 1 Variant |

---

## 6. Product Detail Page (`show.blade.php`) — UI/UX Requirements

### 6.1 Breadcrumb
- Keep existing breadcrumb
- Style current page in `accent-500` (teal/gold depending on theme)

### 6.2 Product Hero Section (2-column grid)
**Left column — Image Gallery:**
- Main image: `aspect-square`, rounded-2xl, soft gradient background
- Brand badge top-left
- Zoom/lightbox on click (existing Alpine x-data)
- Thumbnail strip below (if gallery exists)
- **NEW**: If no image — show animated lens illustration using CSS (concentric circles + light refraction effect)

**Right column — Product Info:**
```
[Category Label — small caps]
[H1 Product Name — font-display, brand-500]
[Tagline — accent-600, italic]
[Description — warm-600, leading-relaxed]
[Technologies — pill tags]
[Variant Selector — see 6.3]
[Care Package Highlights]
[CTA Buttons]
```

### 6.3 Variant Selector — REDESIGNED

**Current**: 4-column icon grid with popup modal

**New Design Requirements**:

#### Layout
- Section heading: `"Choose Your Lens Variant"` in small-caps, brand-500
- **Tab/Group approach for Photochromic**: Since Photochromic comes in Grey AND Brown, group them under a single card with a sub-toggle
- **Tab/Group approach for HMC Antiglare**: Group Green + Blue variants under one card with sub-toggle

#### Visual Design per Variant Card
```
┌─────────────────────┐
│  [64×64 icon box]   │
│                     │
│  [Variant Name]     │
│  [1-line benefit]   │
│  [→ Learn More]     │
└─────────────────────┘
```
- Card: white bg, border border-warm-200, rounded-2xl
- Hover: border-brand-300, shadow-lg, icon scales up + lifts
- Selected state: border-accent-500 ring-2 ring-accent-200, icon fully scales
- On click: open info popup (existing Alpine modal)

#### Sub-variant Toggles (for grouped variants)
For `Photochromic` card:
```html
<!-- Mini toggle inside the variant card popup -->
<div class="flex gap-2 mt-4">
  <button class="px-3 py-1 rounded-full text-xs font-bold ...">Grey</button>
  <button class="px-3 py-1 rounded-full text-xs font-bold ...">Brown</button>
</div>
```

For `HMC Antiglare` card:
```html
<div class="flex gap-2 mt-4">
  <button class="...">🟢 Emerald Green</button>
  <button class="...">🔵 Sapphire Blue</button>
</div>
```

#### Variant Popup (Modal)
Keep existing Alpine modal structure. Enhance with:
- Larger icon: `w-24 h-24` in popup
- "Best For:" section with 2–3 lifestyle tags
- Sub-variant toggle if applicable
- Gradient accent divider line

#### Variant Grid Columns
- Mobile: 2 columns
- Tablet (sm): 3 columns
- Desktop (lg): 4 or 5 columns (auto-fit to variant count)

### 6.4 "Best For" Lifestyle Tags
Display after technologies, before variant selector:

| Product | Best For Tags |
|---|---|
| SV | Everyday Use · Digital Work · Gaming · Active Lifestyle · Driving · Outdoor Sports |
| PRO | Multi-Distance Vision · Driving · Professionals · Digital Work · Travel |
| KBF | Reading · Near + Far Vision · Classic Bifocal Wearers · High Prescriptions |
| DBF | Reading · Crafting · Books · Tablets · First-time Bifocal Wearers |

Style: pill tags with a small icon prefix (🎯 or ✓), `bg-brand-50 text-brand-600 text-xs font-bold`

### 6.5 Features & Specifications (Below the fold)
- 2-column grid (existing)
- Keep card structure
- Add numbered steps or progress-bar style for specs if applicable

### 6.6 Warranty & Care Section
- Keep existing featured-section-card
- No changes required

### 6.7 Related Products
- Keep existing 3-column grid
- Show variant count badge on related product cards

---

## 7. New CSS Classes to Add in `app.css`

```css
/* Sub-variant toggle button */
.variant-sub-btn {
  @apply px-3 py-1.5 rounded-full text-xs font-bold transition-all duration-200 border;
}
.variant-sub-btn.active {
  @apply bg-brand-500 text-white border-brand-500;
}
.variant-sub-btn:not(.active) {
  @apply bg-white text-warm-500 border-warm-200 hover:border-brand-300 hover:text-brand-500;
}

/* Antiglare Blue icon */
.icon-antiglare_blue {
  background: radial-gradient(circle at 30% 30%, rgba(196, 221, 255, 1) 0%, rgba(59, 130, 246, 1) 100%);
  opacity: 0.9;
}

/* Variant selected state */
.variant-image-item.selected {
  @apply border-accent-500 shadow-lg;
  box-shadow: 0 0 0 3px rgba(0, 175, 176, 0.2);
}

/* Variant count badge */
.variant-count-badge {
  @apply absolute bottom-3 left-3 px-2.5 py-1 rounded-full text-xs font-bold bg-white/90 text-brand-500 shadow-sm backdrop-blur-sm;
}

/* Best for lifestyle tags */
.lifestyle-tag {
  @apply inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-brand-50 text-brand-600 border border-brand-100;
}

/* Animated lens placeholder (when no product image) */
.lens-placeholder {
  @apply w-40 h-40 rounded-full relative mx-auto;
  background: radial-gradient(circle at 35% 35%, rgba(255,255,255,0.9), rgba(0,175,176,0.15) 50%, rgba(14,53,88,0.1));
  border: 2px solid rgba(0,175,176,0.3);
  box-shadow: 0 0 40px rgba(0,175,176,0.15), inset 0 0 30px rgba(255,255,255,0.5);
  animation: lensFloat 4s ease-in-out infinite;
}

@keyframes lensFloat {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-12px) rotate(2deg); }
}
```

---

## 8. Alpine.js Data Structure for Variant Selector

The variant selector x-data should track:
```javascript
{
  selectedVariant: null,
  selectedSubVariant: null,  // for photochromic: 'grey'|'brown', for HMC: 'green'|'blue'
  showPopup: false,
  openPopup(variant, subVariant = null) {
    this.selectedVariant = variant;
    this.selectedSubVariant = subVariant;
    this.showPopup = true;
    document.body.style.overflow = 'hidden';
  },
  closePopup() {
    this.showPopup = false;
    document.body.style.overflow = '';
  }
}
```

---

## 9. Seeder Update for Accurate Variants

Update `DatabaseSeeder.php` `variants` arrays to match this spec exactly:

### For SV (`single-vision-rx`) variants array:
```php
'variants' => [
    ['name' => 'CR 39 White', 'icon_type' => 'clear', 'description' => 'Ultra-lightweight optical-grade material. Crystal clear with natural colour rendering.', 'best_for' => 'Everyday Comfort'],
    ['name' => 'Uncoated (UC)', 'icon_type' => 'clear', 'description' => 'Pure base lens — ideal for those who prefer no additional coatings.', 'best_for' => 'Budget-Friendly'],
    ['name' => 'Hard Coat', 'icon_type' => 'clear', 'description' => 'Industrial-grade scratch resistance for active, on-the-go lifestyles.', 'best_for' => 'Active Lifestyles'],
    ['name' => 'Photochromic', 'icon_type' => 'photochromic', 'description' => 'Seamlessly darkens outdoors in Grey or Brown. Clears fully indoors.', 'best_for' => 'Indoor/Outdoor Use', 'sub_variants' => ['Grey', 'Brown']],
    ['name' => 'Blue Cut', 'icon_type' => 'blue_cut', 'description' => 'Filters high-energy blue light from screens. Essential for digital professionals.', 'best_for' => 'Digital Professionals & Gamers'],
    ['name' => 'HD Digital', 'icon_type' => 'blue_cut', 'description' => 'Precision-surfaced for edge-to-edge clarity. Best for higher prescriptions.', 'best_for' => 'High Prescriptions'],
    ['name' => 'Polarized', 'icon_type' => 'polarized', 'description' => 'Eliminates reflective glare. Perfect for driving, fishing, outdoor sports.', 'best_for' => 'Driving & Outdoors'],
    ['name' => 'HMC Antiglare', 'icon_type' => 'antiglare', 'description' => 'Premium anti-glare coating in Emerald Green or Sapphire Blue. Reduces eye strain beautifully.', 'best_for' => 'Eye Strain Reduction', 'sub_variants' => ['Emerald Green', 'Sapphire Blue']],
    ['name' => 'Drive X', 'icon_type' => 'drive', 'description' => 'Specialized filter for road clarity and reduced night-time glare.', 'best_for' => 'Driving & Night Vision'],
],
```

### For PRO (`premium-progressive-rx`) variants array:
```php
'variants' => [
    ['name' => 'CR 39 White', 'icon_type' => 'clear', 'description' => 'Premium optical-grade base material. Lightweight and distortion-free.', 'best_for' => 'Everyday Wear'],
    ['name' => 'Uncoated (UC)', 'icon_type' => 'clear', 'description' => 'Clean base lens with no additional surface treatments.', 'best_for' => 'Basic Progressive'],
    ['name' => 'Hard Coat', 'icon_type' => 'clear', 'description' => 'Enhanced durability and scratch resistance for long-lasting wear.', 'best_for' => 'Active Lifestyle'],
    ['name' => 'Photochromic', 'icon_type' => 'photochromic', 'description' => 'Adapts to outdoor light in Grey or Brown. Rapid activation in under 30 seconds.', 'best_for' => 'Indoor/Outdoor Versatility', 'sub_variants' => ['Grey', 'Brown']],
    ['name' => 'Polarized', 'icon_type' => 'polarized', 'description' => 'Eliminates dashboard reflections and road glare for safer driving.', 'best_for' => 'Driving & Outdoors'],
    ['name' => 'Blue Cut', 'icon_type' => 'blue_cut', 'description' => 'Built-in screen protection for multi-device professionals.', 'best_for' => 'Digital Professionals'],
    ['name' => 'HD Digital', 'icon_type' => 'blue_cut', 'description' => 'Wider corridors, reduced swim effect, faster adaptation.', 'best_for' => 'High Prescriptions'],
    ['name' => 'HMC Antiglare', 'icon_type' => 'antiglare', 'description' => 'Premium anti-glare in Emerald Green or Sapphire Blue.', 'best_for' => 'Eye Strain & Aesthetics', 'sub_variants' => ['Emerald Green', 'Sapphire Blue']],
    ['name' => 'Drive X', 'icon_type' => 'drive', 'description' => 'Purpose-built for the driver. Sharpens road details, reduces night glare.', 'best_for' => 'Night Driving & Road Clarity'],
],
```

### For KBF (`kryptok-bifocals`) variants array:
```php
'variants' => [
    ['name' => 'CR 39 White', 'icon_type' => 'clear', 'description' => 'Classic white optical material. Lightweight with clean optics.', 'best_for' => 'Everyday Use'],
    ['name' => 'Uncoated (UC)', 'icon_type' => 'clear', 'description' => 'Standard bifocal without additional surface treatments.', 'best_for' => 'Basic Bifocal'],
    ['name' => 'Hard Coat', 'icon_type' => 'clear', 'description' => 'Industrial-grade scratch resistance for daily durability.', 'best_for' => 'Longevity'],
    ['name' => 'Photochromic', 'icon_type' => 'photochromic', 'description' => 'Smart light adaptation across both viewing zones in Grey or Brown.', 'best_for' => 'Indoor/Outdoor Use', 'sub_variants' => ['Grey', 'Brown']],
    ['name' => 'Blue Cut', 'icon_type' => 'blue_cut', 'description' => 'Digital eye-strain protection across both bifocal segments.', 'best_for' => 'Screen Users'],
    ['name' => 'HMC Antiglare', 'icon_type' => 'antiglare', 'description' => 'Makes the bifocal segment line less visible. Premium aesthetic in Green or Blue.', 'best_for' => 'Aesthetics & Eye Strain', 'sub_variants' => ['Emerald Green', 'Sapphire Blue']],
    ['name' => 'CR39 Lenticular KT', 'icon_type' => 'clear', 'description' => 'Specialized thin design for high-power prescriptions. Lightweight without sacrificing field of view.', 'best_for' => 'High Prescriptions'],
],
```

### For DBF (`drive-ease` or new `d-bifocal-flat-top`) variants array:
```php
'variants' => [
    ['name' => 'CR39 White', 'icon_type' => 'clear', 'description' => 'Ultra-clear CR-39 optical material. Lightweight for all-day comfort with a wide reading zone.', 'best_for' => 'Reading & Daily Use'],
],
```

---

## 10. Key UX Principles for This Refactor

1. **Variant is the Hero** — The variant selector is the most important interactive element. Give it generous spacing, clear visual affordance, and satisfying interactions.

2. **Grouped variants reduce clutter** — Photochromic (Grey/Brown) and HMC Antiglare (Green/Blue) should appear as ONE card each with a sub-toggle in the popup, not separate cards.

3. **Every variant card must communicate a benefit** — Not just a name. Include a 1-line benefit tagline under the variant name on the card.

4. **Mobile-first** — On mobile, the variant grid should be 2 columns. The modal popup should be bottom-sheet style on mobile.

5. **No infinite scroll / no pagination** — All variants visible at once in the grid.

6. **Accessibility** — Each variant card needs `role="button"`, `tabindex="0"`, `aria-label`, and keyboard support via `@keydown.enter`.

7. **Color Theme Consistency** — Product pages for EYE MEK brand are wrapped in `.theme-eyemek`, which overrides accent to gold. Use this intentionally — variant selection state, CTAs, and badges should use gold in this context.

---

## 11. File Change Scope

| File | Change Type |
|---|---|
| `resources/views/pages/products/show.blade.php` | **REFACTOR** — full redesign of variant selector, best-for tags, card layout |
| `resources/views/pages/products/index.blade.php` | **REFACTOR** — add variant count badge, best-for chips, improved card hover states |
| `resources/css/app.css` | **ADDITIVE** — add `.icon-antiglare_blue`, `.variant-sub-btn`, `.lifestyle-tag`, `.variant-count-badge`, `.lens-placeholder` |
| `database/seeders/DatabaseSeeder.php` | **UPDATE** — update variants arrays to include `best_for` and `sub_variants` fields |

**Do NOT change**: routes, controllers, models, layouts, header, footer, any other pages.

---

## 12. Marketing Copy Reference

### SV Tag Lines
- Option A (Professional): *"Precision in every pulse. HD Digital clarity meets premium protection."*
- Option B (Lifestyle): *"Your eyes, your signature. A lens for every outlook."*
- Option C (Social): *"Upgrade your view. HD Digital · Blue Cut · Photochromic · HMC Anti-Glare"*

### PRO Tag Lines
- Option A (Performance): *"Master Every Distance. Conquer Every Drive."*
- Option B (Digital): *"From Smartphones to the Horizon — Without the Lines."*
- Option C (Social): *"One Lens. Infinite Possibilities."*

### KBF Tag Lines
- *"Classic Precision, Modern Protection."*
- *"The Trusted Classic, Reimagined."*

### DBF Tag Lines
- *"The Wide-Angle View."*
- *"Where Focus Meets Function."*

### HMC Sub-variant Marketing Names
- Emerald Green → **"Classic Natural View"**
- Sapphire Blue → **"Modern Digital Aesthetic"**