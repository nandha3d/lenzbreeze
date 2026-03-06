# LenzBreeze Warranty Management System — Implementation Plan

> **Fixed Price: ₹26,000 | Duration: 5–6 Weeks | Stack: Laravel + Blade | Build Type: On Existing Codebase**

---

## Executive Summary

Build a full-featured Warranty Management System on the existing Lenz Breeze Laravel website. The system covers the entire product lifecycle — from admin entering serial numbers, through retailer sale registration, to a premium digital warranty card that customers access by scanning a QR code.

The existing codebase already has: a `Warranty` model, admin warranty routes, a public warranty lookup page, and QR code infrastructure. This project extends that foundation — upgrading the database, enriching the admin panel with full lens and customer details, and building a digital warranty card.

---

## End-to-End Flow

| Step | Actor | Action |
|------|-------|--------|
| 1 | Admin | Logs into admin panel and registers the product unit with serial number, lens type, coating, manufacturing date, and batch number. |
| 2 | Retailer / Admin | Retailer sells lens to customer. Admin (or retailer) fills in sale registration: customer name, photo, address, eye power details, lens details, sale date. |
| 3 | System | On submission, product is marked `SOLD`, warranty expiry is auto-calculated, and a full warranty record is created tied to the serial number. |
| 4 | Customer | Scans QR code on packaging → lands on `lenzbreeze.com/warranty` → enters serial number → sees premium digital warranty card. |
| 5 | Retailer / Admin | Customer raises issue with retailer. Admin looks up serial and updates claim status with notes. |

---

## Scope — What Is Included (₹26,000)

### Module 1: Database Upgrade

- Extend existing `warranties` table with new columns (see Database Design section).
- Create new `retailers` table (see Database Design section).

### Module 2: Admin — Retailer Management

- Add / Edit / Deactivate retailer records.
- Retailer dropdown used throughout the warranty registration form.
- View count of warranties issued per retailer.

### Module 3: Admin — Warranty Registration Form (Full)

- Serial number lookup — auto-fills product details when serial is typed.
- Customer details: name, phone, email, full address.
- Customer photo upload with live preview (stored on server).
- Eye power section: Right Eye & Left Eye — SPH, CYL, AXIS, ADD.
- Pupillary Distance (PD).
- Sale details: retailer dropdown, purchase date, warranty duration (6m / 1yr / 2yr).
- Expiry date auto-calculated; serial status set to `SOLD` on save.

### Module 4: Admin — Warranty List & Claims

- Enhanced warranty list: search by serial / customer name / phone.
- Filter by status, retailer, date range.
- Statistics bar: Total Active, Expiring in 30 Days, Total Claims, Resolved.
- Warranty detail view: all customer, lens, and eye power info in one screen.
- Claim workflow: update status (Active → Under Review → Approved/Rejected → Resolved) + add claim notes.

### Module 5: Premium Customer Warranty Card (Public)

- Customer scans QR → enters serial → sees full premium card.
- Card shows: customer photo, name, serial number, product details, lens type & coating.
- Eye prescription table (Right Eye / Left Eye with all values).
- WARRANTY VALID UNTIL — large prominent date, green/red/amber status badge.
- Retailer name and purchase date.
- Print button — renders cleanly on A4 paper as a warranty certificate.

### Module 6: QR Code Flow

- One common QR code on packaging → `/warranty` page.
- Per-product QR links: `/warranty?serial=LB-XXXXXXXX` auto-fills serial field.
- Admin can generate and download QR for each warranty from the admin panel.

---

## Out of Scope (Not Included in ₹26,000)

The following features are NOT part of this project. They can be added separately in a future phase:

- Retailer login portal (retailers logging in to register sales themselves)
- SMS / WhatsApp / Email notifications to customers
- Customer login to view all their warranties
- Bulk serial number import via CSV
- Multi-language warranty card
- Analytics dashboard (claims rate, regional data)
- PDF generation via server (browser print IS included)

---

## Database Design

### `warranties` Table — New Columns

| Column | Description | Required |
|--------|-------------|----------|
| `retailer_id` | FK to `retailers` table | Yes |
| `retailer_name` | Denormalized retailer name | Yes |
| `customer_phone` | Customer phone number | Yes |
| `customer_email` | Customer email | Optional |
| `customer_address` | Full address text | Yes |
| `customer_photo` | File path to uploaded photo | Yes |
| `right_eye_sph` | Right eye SPH value | Yes |
| `right_eye_cyl` | Right eye CYL value | Yes |
| `right_eye_axis` | Right eye AXIS value | Yes |
| `right_eye_add` | Right eye ADD value | Yes |
| `left_eye_sph` | Left eye SPH value | Yes |
| `left_eye_cyl` | Left eye CYL value | Yes |
| `left_eye_axis` | Left eye AXIS value | Yes |
| `left_eye_add` | Left eye ADD value | Yes |
| `pupillary_distance` | PD in mm | Optional |
| `lens_type` | Single Vision / Bifocal / Progressive etc. | Yes |
| `lens_coating` | Anti-Glare / Blue Cut / Photochromic etc. | Yes |
| `lens_index` | e.g. 1.56, 1.67 | Optional |
| `manufacturing_date` | Date lens was manufactured | Yes |
| `batch_number` | Manufacturing batch ID | Optional |
| `warranty_months` | 6, 12, or 24 | Yes |
| `claim_date` | Auto-set when claim is raised | Auto |
| `claim_notes` | Retailer/admin notes on claim | Optional |

### `retailers` Table — New Table

| Column | Description | Required |
|--------|-------------|----------|
| `id` | Primary key | Auto |
| `name` | Shop / retailer name | Yes |
| `owner_name` | Owner or contact person name | Yes |
| `phone` | Contact phone | Yes |
| `address` | Street address | Yes |
| `city` | City | Yes |
| `state` | State | Yes |
| `retailer_code` | Auto-generated: RET-001, RET-002... | Auto |
| `is_active` | Active / inactive toggle (boolean) | Yes |
| `created_at` | Timestamp | Auto |
| `updated_at` | Timestamp | Auto |

---

## Implementation Phases

### Phase 1: Database Migrations & Models
**Duration:** Week 1 — 3 days | **Cost: ₹5,000**

- [ ] Migration: alter `warranties` table — add all new columns listed above
- [ ] Migration: create `retailers` table
- [ ] Update `Warranty` model: fillable fields, casts, `belongsTo(Retailer)` relationship
- [ ] Create `Retailer` model with `hasMany(Warranty)` relationship
- [ ] Create `RetailerController` with full admin CRUD
- [ ] Create admin Blade views for retailer list and form
- [ ] Seed demo data: sample retailers and 5 warranty records

---

### Phase 2: Admin Warranty Registration Form
**Duration:** Week 1–2 — 4 days | **Cost: ₹7,500**

- [ ] Serial number lookup input — AJAX/Livewire call to auto-fill product details
- [ ] Customer details section: name, phone, email, address (textarea)
- [ ] Customer photo upload with Alpine.js live preview; store file on server
- [ ] Eye power section: Right Eye fields (SPH, CYL, AXIS, ADD) and Left Eye fields (SPH, CYL, AXIS, ADD) + PD field
- [ ] Retailer dropdown populated from active retailers
- [ ] Purchase date picker
- [ ] Warranty duration selector: 6 months / 1 year / 2 years
- [ ] Auto-calculate and display expiry date on selection of purchase date + duration
- [ ] On save: set serial status to `SOLD`, create warranty record
- [ ] Validation: block re-registration of already-sold serials with clear error message

---

### Phase 3: Admin List, Detail & Claims
**Duration:** Week 2 — 3 days | **Cost: ₹5,000**

- [ ] Enhanced warranty list view with columns: serial, customer name, retailer, purchase date, expiry date, status
- [ ] Search bar: filter by serial number, customer name, phone
- [ ] Dropdown filters: status, retailer, date range
- [ ] Statistics bar at top: Total Active | Expiring in 30 Days | Total Claims | Resolved
- [ ] Warranty detail modal or page: all customer info, lens info, eye power prescription table
- [ ] Claim status dropdown: Active → Under Review → Approved / Rejected → Resolved
- [ ] Claim notes textarea: admin/retailer notes
- [ ] Auto-set `claim_date` when status first moves to "Under Review"
- [ ] Retailer management: list view (with warranty count per retailer), add/edit form, activate/deactivate toggle

---

### Phase 4: Premium Customer Warranty Card (Public)
**Duration:** Week 2 — 4 days | **Cost: ₹6,000**

**Route:** `GET /warranty` (existing) + `GET /warranty?serial=LB-XXXXXXXX`

#### Card Layout

**Top Section:**
- Lenz Breeze / EYE MEK brand header
- "PRODUCT WARRANTY CERTIFICATE" title
- Customer photo — circular, prominent
- Customer name — large, bold
- Serial number — monospace, teal colour
- WARRANTY VALID UNTIL — large date
- Status badge: `ACTIVE` (green) / `EXPIRED` (red) / `UNDER CLAIM` (amber)

**Bottom Section:**
- Product: lens type and coating
- Eye Prescription Table:
  - Right Eye — SPH / CYL / AXIS / ADD
  - Left Eye — SPH / CYL / AXIS / ADD
- Purchase date + Manufacturing date
- Retailer name and city
- Warranty terms summary (short)
- Print button (hidden via `@media print`)

#### Technical Requirements
- [ ] Blade template: `resources/views/warranty/card.blade.php`
- [ ] Status badge logic based on `expiry_date` vs `now()` and `status` field
- [ ] Print-optimised CSS: A4 layout, hide navigation/print button, preserve colours
- [ ] Mobile responsive for card page
- [ ] Handle "serial not found" and "not yet sold" states gracefully

---

### Phase 5: QR Integration, Testing & Deployment
**Duration:** Week 3 — 3 days | **Cost: ₹2,500**

- [ ] URL auto-fill: `/warranty?serial=LB-XXXXXXXX` pre-fills serial input field on page load
- [ ] Admin panel: per-warranty QR code generator (QR encodes the serial-specific URL)
- [ ] Admin panel: download QR as PNG for each warranty record
- [ ] End-to-end testing: register serial → sell → QR → warranty card → raise claim → resolve
- [ ] Edge case tests: duplicate serial registration, missing photo, expired warranty display, void status
- [ ] Deploy to Hostinger production server
- [ ] Admin handover walkthrough

---

## Warranty Status Lifecycle

```
ACTIVE → UNDER CLAIM → APPROVED → RESOLVED
                      ↘ REJECTED
         ↓
       EXPIRED  (auto, based on expiry_date)
         ↓
        VOID    (manual admin action)
```

| Status | Meaning |
|--------|---------|
| `ACTIVE` | Warranty is valid. Expiry date is in the future. Customer sees full premium card. |
| `EXPIRED` | Warranty period has ended. Card shows expired status badge. |
| `UNDER CLAIM` | Customer has raised an issue. Retailer informed admin. In review. |
| `APPROVED` | Claim reviewed and approved, pending resolution. |
| `RESOLVED` | Claim processed and resolved. Notes recorded. |
| `REJECTED` | Claim reviewed and rejected (damage, misuse, etc.). |
| `VOID` | Warranty cancelled — fraud, duplicate, or admin action. |

---

## Cost Breakdown

| Module / Phase | Days | Cost (₹) |
|----------------|------|-----------|
| Phase 1: DB Migrations, Models, Retailer Module | 3 days | ₹5,000 |
| Phase 2: Admin Warranty Registration Form | 4 days | ₹7,500 |
| Phase 3: Admin List, Detail & Claims Workflow | 3 days | ₹5,000 |
| Phase 4: Premium Customer Warranty Card Design | 4 days | ₹6,000 |
| Phase 5: QR Flow, Testing & Deployment | 3 days | ₹2,500 |
| **TOTAL (Fixed Price)** | **17 days** | **₹26,000** |

> Fixed-price project. ₹26,000 total regardless of actual hours spent. No hidden charges or change fees for scope defined above.


## Technical Stack Reference

| Layer | Technology |
|-------|------------|
| Backend framework | Laravel (existing) |
| Templating | Blade (existing) |
| Frontend interactivity | Alpine.js (photo preview, serial lookup) |
| QR code generation | Existing QR infrastructure + per-warranty download |
| File storage | Local server storage (Hostinger) |
| Deployment target | Hostinger production server |

---

*Confidential — prepared for Lenz Breeze internal use only.*
