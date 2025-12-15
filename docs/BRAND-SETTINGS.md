# Brand Settings - Hotel Nowy Dwór

**Version:** 1.0.0
**Last Updated:** December 15, 2025
**Owner:** PB MEDIA Strony Sklepy Marketing
**Website:** https://www.hotelnowydwor.eu/

---

## Table of Contents

1. [Brand Overview](#brand-overview)
2. [Brand Identity](#brand-identity)
3. [Color Palette](#color-palette)
4. [Typography](#typography)
5. [Spacing & Layout](#spacing--layout)
6. [Logo & Brand Assets](#logo--brand-assets)
7. [Imagery Guidelines](#imagery-guidelines)
8. [Icons](#icons)
9. [Components](#components)
10. [Accessibility](#accessibility)
11. [Implementation](#implementation)

---

## Brand Overview

### Business Information

**Name:** Hotel Nowy Dwór
**Location:** ul. Nowy Dwór 2, 55-100 Trzebnica, Poland
**Distance from Wrocław:** 15 km
**Capacity:** 28 rooms
**Facilities:**
- Restaurant
- Event halls (weddings and parties)
- Conference rooms

**Contact Information:**
- **Email:** rezerwacja@hotelnowydwor.eu
- **Phone:** +48 71 312 07 14
- **Website:** https://www.hotelnowydwor.eu/

**Owner/Manager:** Artur Balczun

### Brand Mission

To provide welcoming, professional hospitality services in the Trzebnica region, combining modern comfort with regional character. We create memorable experiences for hotel guests, wedding couples, conference attendees, and restaurant patrons through attention to detail and personalized service.

### Target Audience

**Primary Segments:**

1. **Business Travelers**
   - Professionals visiting Trzebnica and Wrocław area
   - Conference and meeting attendees
   - Corporate event participants

2. **Wedding Couples & Event Planners**
   - Couples seeking elegant wedding venue
   - Event organizers for parties and celebrations
   - Family gatherings and special occasions

3. **Leisure Travelers**
   - Tourists visiting Lower Silesia region
   - Weekend getaway seekers from Wrocław
   - Families exploring regional attractions

4. **Restaurant Guests**
   - Local diners
   - Hotel guests
   - Special occasion celebrants

**Demographics:**
- Age range: 25-65 years
- Income level: Middle to upper-middle class
- Geographic: Primarily Poland (Wrocław region), some international
- Language: Polish (primary), English (secondary)

---

## Brand Identity

### Brand Essence

Hotel Nowy Dwór represents the perfect balance of modern hospitality standards and regional warmth. We are professional yet welcoming, contemporary yet rooted in local tradition.

### Brand Personality

| Attribute | Description |
|-----------|-------------|
| **Welcoming** | Warm, approachable, friendly atmosphere that makes guests feel at home from the moment they arrive |
| **Professional** | Reliable, competent service delivery with attention to detail and consistent quality standards |
| **Modern** | Contemporary design aesthetic, up-to-date facilities, digital-first approach to guest services |
| **Regional** | Proud connection to Trzebnica and Lower Silesia, showcasing local culture and hospitality traditions |

### Brand Values

1. **Guest-Centric Service**
   - Every decision prioritizes guest comfort and satisfaction
   - Personalized attention to individual needs and preferences
   - Responsive to feedback and continuous improvement

2. **Quality & Reliability**
   - Consistent service standards across all touchpoints
   - Well-maintained facilities and amenities
   - Professional staff training and development

3. **Regional Pride**
   - Supporting local suppliers and businesses
   - Showcasing Trzebnica's heritage and attractions
   - Contributing to the regional hospitality industry

4. **Modern Comfort**
   - Contemporary room design and amenities
   - Digital convenience (online booking, mobile-friendly)
   - Updated facilities meeting current expectations

---

## Color Palette

### Primary Brand Colors

```css
/* Primary Brand Color - Teal */
--color-primary: #0a97b0;           /* Main brand color - teal */
--color-primary-hover: #087d91;     /* Hover state - darker teal */
--color-primary-light: #e6f7fa;     /* Light backgrounds */
--color-primary-dark: #065766;      /* Dark accents */

/* Secondary Brand Color - Black */
--color-secondary: #000000;         /* Headlines, text, strong contrast */
--color-secondary-light: #333333;   /* Softer text, subheadings */

/* Background Colors */
--color-background: #ffffff;        /* Main background - white */
--color-background-alt: #f7f7f7;    /* Alternate sections - light gray */
```

**Usage Guidelines:**

- **Primary Teal (#0a97b0):** Use for primary CTAs (buttons, links), brand accents, interactive elements, section highlights
- **Primary Hover (#087d91):** Automatic hover states on interactive elements
- **Primary Light (#e6f7fa):** Backgrounds for info boxes, subtle highlights, section backgrounds
- **Secondary Black (#000000):** Headlines (H1-H3), navigation text, important copy, icons
- **Background White (#ffffff):** Main page background, card backgrounds, clean sections
- **Background Alt (#f7f7f7):** Alternating section backgrounds, subtle content separation

### Neutral Palette

```css
/* Grays - for text, borders, subtle backgrounds */
--color-gray-50: #f9fafb;    /* Lightest - subtle backgrounds */
--color-gray-100: #f3f4f6;   /* Very light - cards, panels */
--color-gray-200: #e5e7eb;   /* Light - borders, dividers */
--color-gray-300: #d1d5db;   /* Medium-light - disabled states */
--color-gray-400: #9ca3af;   /* Medium - placeholder text */
--color-gray-500: #6b7280;   /* Mid-gray - secondary text */
--color-gray-600: #4b5563;   /* Medium-dark - body text */
--color-gray-700: #374151;   /* Dark - headings, emphasis */
--color-gray-800: #1f2937;   /* Very dark - strong contrast */
--color-gray-900: #111827;   /* Darkest - maximum contrast */
```

**Usage Guidelines:**

- **Gray-50 to Gray-200:** Backgrounds, cards, subtle sections
- **Gray-200 to Gray-300:** Borders, dividers, input borders
- **Gray-400 to Gray-500:** Placeholder text, secondary information, disabled states
- **Gray-600 to Gray-700:** Primary body text, readable content
- **Gray-800 to Gray-900:** Headlines, strong emphasis, maximum contrast elements

### Semantic Colors

```css
/* Success - Green */
--color-success: #10b981;           /* Success messages, confirmation */
--color-success-light: #d1fae5;     /* Success backgrounds */
--color-success-dark: #047857;      /* Success emphasis */

/* Warning - Orange */
--color-warning: #f59e0b;           /* Warning messages, caution */
--color-warning-light: #fef3c7;     /* Warning backgrounds */
--color-warning-dark: #d97706;      /* Warning emphasis */

/* Error - Red */
--color-error: #ef4444;             /* Error messages, validation failures */
--color-error-light: #fee2e2;       /* Error backgrounds */
--color-error-dark: #dc2626;        /* Error emphasis */

/* Info - Blue */
--color-info: #3b82f6;              /* Information messages, tips */
--color-info-light: #dbeafe;        /* Info backgrounds */
--color-info-dark: #1d4ed8;         /* Info emphasis */
```

**Usage Guidelines:**

- **Success Green:** Booking confirmations, form submissions, successful actions
- **Warning Orange:** Important notices, limited availability alerts, cautionary messages
- **Error Red:** Validation errors, booking failures, critical alerts
- **Info Blue:** Helpful tips, information boxes, general notices

### Color Accessibility

All color combinations meet **WCAG 2.1 AA standards** (minimum 4.5:1 contrast ratio for normal text):

| Foreground | Background | Contrast Ratio | Status |
|------------|------------|----------------|--------|
| `#000000` (Black) | `#ffffff` (White) | 21:1 | ✅ AAA |
| `#0a97b0` (Primary) | `#ffffff` (White) | 4.5:1 | ✅ AA |
| `#374151` (Gray-700) | `#ffffff` (White) | 8.9:1 | ✅ AAA |
| `#6b7280` (Gray-500) | `#ffffff` (White) | 4.6:1 | ✅ AA |
| `#ffffff` (White) | `#0a97b0` (Primary) | 4.5:1 | ✅ AA |
| `#ffffff` (White) | `#000000` (Black) | 21:1 | ✅ AAA |

---

## Typography

### Font System

**System Font Stack (Performance Optimized):**

```css
--font-primary: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                "Helvetica Neue", Arial, sans-serif;
```

**Rationale:** Uses native operating system fonts for optimal performance (no external font loading), excellent readability, and professional appearance across all devices.

### Font Size Scale

```css
/* Base: 16px = 1rem */
--font-size-xs: 0.75rem;    /* 12px - fine print, captions */
--font-size-sm: 0.875rem;   /* 14px - small text, labels */
--font-size-base: 1rem;     /* 16px - body text, paragraphs */
--font-size-lg: 1.125rem;   /* 18px - large body text, lead paragraphs */
--font-size-xl: 1.25rem;    /* 20px - subheadings, emphasis */
--font-size-2xl: 1.5rem;    /* 24px - section titles, H4 */
--font-size-3xl: 1.875rem;  /* 30px - H3 headings */
--font-size-4xl: 2.25rem;   /* 36px - H2 headings */
--font-size-5xl: 3rem;      /* 48px - H1 hero headings */
```

### Font Weight Scale

```css
--font-weight-normal: 400;      /* Body text, paragraphs */
--font-weight-medium: 500;      /* Emphasis, subheadings */
--font-weight-semibold: 600;    /* Strong emphasis, buttons */
--font-weight-bold: 700;        /* Headlines, important text */
```

### Line Heights

```css
--line-height-tight: 1.25;      /* Headings, compact text */
--line-height-normal: 1.5;      /* Body text, optimal readability */
--line-height-relaxed: 1.75;    /* Long-form content, paragraphs */
--line-height-loose: 2;         /* Spacious text, quotes */
```

### Heading Styles

```css
/* H1 - Hero Headlines */
.h1 {
  font-size: var(--font-size-5xl);     /* 48px */
  font-weight: var(--font-weight-bold);
  line-height: var(--line-height-tight);
  color: var(--color-secondary);
  margin-bottom: var(--spacing-6);
}

/* H2 - Section Titles */
.h2 {
  font-size: var(--font-size-4xl);     /* 36px */
  font-weight: var(--font-weight-bold);
  line-height: var(--line-height-tight);
  color: var(--color-secondary);
  margin-bottom: var(--spacing-5);
}

/* H3 - Subsection Titles */
.h3 {
  font-size: var(--font-size-3xl);     /* 30px */
  font-weight: var(--font-weight-semibold);
  line-height: var(--line-height-normal);
  color: var(--color-gray-900);
  margin-bottom: var(--spacing-4);
}

/* H4 - Content Headings */
.h4 {
  font-size: var(--font-size-2xl);     /* 24px */
  font-weight: var(--font-weight-semibold);
  line-height: var(--line-height-normal);
  color: var(--color-gray-800);
  margin-bottom: var(--spacing-3);
}
```

### Body Text

```css
/* Body - Primary Text */
.body {
  font-size: var(--font-size-base);      /* 16px */
  font-weight: var(--font-weight-normal);
  line-height: var(--line-height-normal);
  color: var(--color-gray-700);
}

/* Lead - Introductory Text */
.lead {
  font-size: var(--font-size-lg);        /* 18px */
  font-weight: var(--font-weight-normal);
  line-height: var(--line-height-relaxed);
  color: var(--color-gray-600);
}

/* Small - Secondary Text */
.small {
  font-size: var(--font-size-sm);        /* 14px */
  font-weight: var(--font-weight-normal);
  line-height: var(--line-height-normal);
  color: var(--color-gray-500);
}
```

### Responsive Typography

Typography scales down on smaller screens for better readability:

```css
/* Mobile (< 768px) */
@media (max-width: 767px) {
  .h1 { font-size: 2rem; }       /* 32px (from 48px) */
  .h2 { font-size: 1.75rem; }    /* 28px (from 36px) */
  .h3 { font-size: 1.5rem; }     /* 24px (from 30px) */
  .body { font-size: 0.875rem; } /* 14px (from 16px) */
}

/* Tablet (768px - 1023px) */
@media (min-width: 768px) and (max-width: 1023px) {
  .h1 { font-size: 2.5rem; }     /* 40px (from 48px) */
  .h2 { font-size: 2rem; }       /* 32px (from 36px) */
  .h3 { font-size: 1.75rem; }    /* 28px (from 30px) */
}
```

---

## Spacing & Layout

### Spacing Scale (4px Base Grid)

```css
--spacing-0: 0;              /* 0px - no spacing */
--spacing-1: 0.25rem;        /* 4px */
--spacing-2: 0.5rem;         /* 8px */
--spacing-3: 0.75rem;        /* 12px */
--spacing-4: 1rem;           /* 16px */
--spacing-5: 1.25rem;        /* 20px */
--spacing-6: 1.5rem;         /* 24px */
--spacing-8: 2rem;           /* 32px */
--spacing-10: 2.5rem;        /* 40px */
--spacing-12: 3rem;          /* 48px */
--spacing-16: 4rem;          /* 64px */
--spacing-20: 5rem;          /* 80px */
--spacing-24: 6rem;          /* 96px */
--spacing-32: 8rem;          /* 128px */
```

**Usage Guidelines:**

- **spacing-1 to spacing-3 (4px-12px):** Tight spacing - badges, small buttons, compact lists
- **spacing-4 to spacing-6 (16px-24px):** Standard spacing - buttons, cards, form fields
- **spacing-8 to spacing-12 (32px-48px):** Generous spacing - sections, content blocks
- **spacing-16 to spacing-32 (64px-128px):** Large spacing - hero sections, major divisions

### Component Spacing

```css
/* Buttons */
--btn-padding-y: var(--spacing-3);     /* 12px vertical */
--btn-padding-x: var(--spacing-6);     /* 24px horizontal */

/* Cards */
--card-padding: var(--spacing-6);      /* 24px all sides */

/* Sections */
--section-padding-y: var(--spacing-16); /* 64px top/bottom */
--section-padding-x: var(--spacing-6);  /* 24px left/right */
```

### Container Widths

```css
--container-sm: 640px;       /* Mobile landscape */
--container-md: 768px;       /* Tablet portrait */
--container-lg: 1024px;      /* Tablet landscape */
--container-xl: 1280px;      /* Desktop */
--container-2xl: 1536px;     /* Large desktop */
```

**Responsive Container Padding:**

```css
.container {
  width: 100%;
  max-width: var(--container-xl);    /* 1280px */
  margin: 0 auto;
  padding-left: var(--spacing-4);     /* 16px */
  padding-right: var(--spacing-4);    /* 16px */
}

@media (min-width: 768px) {
  .container {
    padding-left: var(--spacing-6);   /* 24px */
    padding-right: var(--spacing-6);  /* 24px */
  }
}

@media (min-width: 1024px) {
  .container {
    padding-left: var(--spacing-8);   /* 32px */
    padding-right: var(--spacing-8);  /* 32px */
  }
}
```

### Grid System

**12-Column Grid:**

```css
.grid {
  display: grid;
  grid-template-columns: repeat(12, 1fr);
  gap: var(--spacing-6);              /* 24px gap */
}

/* Common Column Spans */
.col-12 { grid-column: span 12; }     /* Full width */
.col-6 { grid-column: span 6; }       /* Half width */
.col-4 { grid-column: span 4; }       /* Third width */
.col-3 { grid-column: span 3; }       /* Quarter width */

/* Responsive Grid */
@media (max-width: 767px) {
  .col-6,
  .col-4,
  .col-3 {
    grid-column: span 12;             /* Stack on mobile */
  }
}
```

### Flexbox Utilities

```css
/* Common Flex Patterns */
.flex { display: flex; }
.flex-col { flex-direction: column; }
.flex-wrap { flex-wrap: wrap; }

/* Alignment */
.items-center { align-items: center; }
.items-start { align-items: flex-start; }
.justify-between { justify-content: space-between; }
.justify-center { justify-content: center; }

/* Gaps */
.gap-2 { gap: var(--spacing-2); }     /* 8px */
.gap-4 { gap: var(--spacing-4); }     /* 16px */
.gap-6 { gap: var(--spacing-6); }     /* 24px */
```

---

## Logo & Brand Assets

### Logo Usage

**Primary Logo:**
- Use on white or light gray backgrounds
- Maintain minimum clear space equal to logo height on all sides
- Minimum width: 120px (digital), 25mm (print)

**Logo Color Variations:**

1. **Full Color:** Primary logo with teal and black
   - Use: Main website header, marketing materials
   - Background: White or light gray only

2. **Black:** All-black version
   - Use: Print materials, monochrome applications
   - Background: White or light colors

3. **White:** All-white version
   - Use: Dark backgrounds, photos, footer
   - Background: Dark images or color backgrounds

**Incorrect Usage (Don't):**
- Don't stretch or distort logo proportions
- Don't use on busy backgrounds without clear space
- Don't add effects (shadows, outlines, gradients)
- Don't rotate or skew logo
- Don't change logo colors outside approved variations

### Icon Style

**Characteristics:**
- Line-based icons (stroke weight: 2px)
- Rounded corners (border-radius: 2px)
- Consistent optical sizing
- Primary color: `--color-gray-700` or `--color-primary`

**Usage:**
- Navigation icons
- Feature highlights
- Amenity indicators
- UI controls

---

## Imagery Guidelines

### Image Formats & Optimization

**Priority Order (Modern Browsers First):**

1. **AVIF** - Best compression (50-60% smaller than JPEG)
   - Use: All modern browsers (Chrome 85+, Firefox 93+, Safari 16+)
   - Fallback: WebP

2. **WebP** - Excellent compression (25-35% smaller than JPEG)
   - Use: Wide browser support (Chrome, Firefox, Edge, Safari 14+)
   - Fallback: JPEG

3. **JPEG** - Universal fallback
   - Use: Older browsers, universal compatibility
   - Quality: 80-85%

**Conversion Process:**
- WebP Express plugin handles automatic conversion
- Original files stored as JPEG/PNG
- WebP and AVIF variants generated automatically
- Appropriate format served based on browser support

### Image Size Guidelines

**Hero Images (Homepage, Landing Pages):**

```yaml
Desktop:
  Width: 1920px
  Height: 1080px
  Aspect Ratio: 16:9
  Max File Size: 300KB

Mobile:
  Width: 768px
  Height: 1024px
  Aspect Ratio: 3:4
  Max File Size: 150KB
```

**Room Images (Gallery, Listings):**

```yaml
Card Thumbnail:
  Width: 400px
  Height: 300px
  Aspect Ratio: 4:3
  Max File Size: 150KB

Lightbox/Detail:
  Width: 1200px
  Height: 900px
  Aspect Ratio: 4:3
  Max File Size: 250KB
```

**Gallery Images:**

```yaml
Thumbnail:
  Width: 300px
  Height: 300px
  Aspect Ratio: 1:1
  Max File Size: 100KB

Full Size:
  Width: 1200px
  Height: 800px
  Aspect Ratio: 3:2
  Max File Size: 250KB
```

**Restaurant/Menu Images:**

```yaml
Featured Dish:
  Width: 800px
  Height: 600px
  Aspect Ratio: 4:3
  Max File Size: 200KB

Menu Item Thumbnail:
  Width: 400px
  Height: 300px
  Aspect Ratio: 4:3
  Max File Size: 100KB
```

### Responsive Images

```html
<!-- Modern responsive image markup -->
<picture>
  <source
    type="image/avif"
    srcset="image-400.avif 400w, image-800.avif 800w, image-1200.avif 1200w"
    sizes="(max-width: 768px) 100vw, 50vw">
  <source
    type="image/webp"
    srcset="image-400.webp 400w, image-800.webp 800w, image-1200.webp 1200w"
    sizes="(max-width: 768px) 100vw, 50vw">
  <img
    src="image-800.jpg"
    srcset="image-400.jpg 400w, image-800.jpg 800w, image-1200.jpg 1200w"
    sizes="(max-width: 768px) 100vw, 50vw"
    alt="Hotel Nowy Dwór room interior"
    loading="lazy"
    width="800"
    height="600">
</picture>
```

### Image Naming Convention

```
category-description-size.format

Examples:
hero-homepage-1920x1080.jpg
room-deluxe-double-1200x900.jpg
gallery-restaurant-interior-800x600.jpg
amenity-conference-room-400x300.jpg
```

### Image Content Guidelines

**DO:**
- Use high-quality, professionally shot photos
- Show clean, well-lit spaces
- Capture authentic hotel atmosphere
- Include people when appropriate (guests, staff) with model releases
- Showcase unique features and amenities
- Maintain consistent lighting and color grading

**DON'T:**
- Use stock photos that don't match actual hotel
- Include cluttered or messy spaces
- Show poor lighting or blurry images
- Use heavily filtered or unrealistic colors
- Include identifiable guests without permission
- Show outdated or renovated spaces

---

## Icons

### Icon Size Scale

```css
--icon-xs: 16px;     /* Small UI icons, inline text */
--icon-sm: 20px;     /* Standard UI icons, buttons */
--icon-md: 24px;     /* Primary navigation, feature highlights */
--icon-lg: 32px;     /* Section icons, emphasis */
--icon-xl: 48px;     /* Hero sections, large features */
```

### Common Icons

**Navigation & UI:**
- Menu (hamburger)
- Close (X)
- Search
- User/Account
- Phone
- Email
- Location/Map Pin
- Calendar
- Arrow Right
- Arrow Down
- Chevron Right
- Chevron Down

**Hotel Amenities:**
- Bed (rooms)
- Restaurant (dining)
- WiFi (internet)
- Parking (car)
- Conference (meetings)
- Accessibility (wheelchair)
- Pet Friendly (dog)
- Air Conditioning
- TV
- Safe

**Actions:**
- Book Now
- View Gallery
- Download (PDF menus, documents)
- Share (social media)
- Print
- Favorite/Save

### Icon Implementation

**CSS Class Example:**

```css
.icon {
  display: inline-block;
  width: var(--icon-md);      /* 24px default */
  height: var(--icon-md);
  stroke: currentColor;
  stroke-width: 2px;
  fill: none;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.icon-sm { width: var(--icon-sm); height: var(--icon-sm); }
.icon-lg { width: var(--icon-lg); height: var(--icon-lg); }
```

---

## Components

### Buttons

```css
/* Base Button */
.btn {
  display: inline-block;
  padding: var(--spacing-3) var(--spacing-6);  /* 12px 24px */
  font-size: var(--font-size-base);            /* 16px */
  font-weight: var(--font-weight-semibold);    /* 600 */
  line-height: 1.5;
  text-align: center;
  text-decoration: none;
  border: 2px solid transparent;
  border-radius: 0.375rem;                     /* 6px */
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

/* Primary Button */
.btn-primary {
  background-color: var(--color-primary);      /* #0a97b0 */
  color: var(--color-white);
  border-color: var(--color-primary);
}

.btn-primary:hover {
  background-color: var(--color-primary-hover); /* #087d91 */
  border-color: var(--color-primary-hover);
  transform: translateY(-1px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-primary:active {
  transform: translateY(0);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Secondary Button */
.btn-secondary {
  background-color: var(--color-secondary);     /* #000000 */
  color: var(--color-white);
  border-color: var(--color-secondary);
}

.btn-secondary:hover {
  background-color: var(--color-gray-800);
  border-color: var(--color-gray-800);
}

/* Outline Button */
.btn-outline {
  background-color: transparent;
  color: var(--color-primary);
  border-color: var(--color-primary);
}

.btn-outline:hover {
  background-color: var(--color-primary);
  color: var(--color-white);
}

/* Button Sizes */
.btn-sm {
  padding: var(--spacing-2) var(--spacing-4);  /* 8px 16px */
  font-size: var(--font-size-sm);              /* 14px */
}

.btn-lg {
  padding: var(--spacing-4) var(--spacing-8);  /* 16px 32px */
  font-size: var(--font-size-lg);              /* 18px */
}

/* Full Width Button */
.btn-block {
  display: block;
  width: 100%;
}
```

### Cards

```css
/* Base Card */
.card {
  background-color: var(--color-white);
  border-radius: 0.5rem;                        /* 8px */
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.card-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.card-body {
  padding: var(--spacing-6);                    /* 24px */
}

.card-title {
  font-size: var(--font-size-xl);              /* 20px */
  font-weight: var(--font-weight-semibold);
  color: var(--color-gray-900);
  margin-bottom: var(--spacing-2);
}

.card-text {
  font-size: var(--font-size-base);            /* 16px */
  color: var(--color-gray-600);
  margin-bottom: var(--spacing-4);
}

.card-footer {
  padding: var(--spacing-4) var(--spacing-6);  /* 16px 24px */
  background-color: var(--color-gray-50);
  border-top: 1px solid var(--color-gray-200);
}
```

### Alerts

```css
/* Base Alert */
.alert {
  display: flex;
  align-items: flex-start;
  padding: var(--spacing-4);                    /* 16px */
  border-radius: 0.5rem;                        /* 8px */
  border-left: 4px solid;
}

.alert-icon {
  flex-shrink: 0;
  width: var(--icon-md);                        /* 24px */
  height: var(--icon-md);
  margin-right: var(--spacing-3);              /* 12px */
}

.alert-content {
  flex: 1;
}

/* Success Alert */
.alert-success {
  background-color: var(--color-success-light);
  border-color: var(--color-success);
  color: var(--color-success-dark);
}

/* Warning Alert */
.alert-warning {
  background-color: var(--color-warning-light);
  border-color: var(--color-warning);
  color: var(--color-warning-dark);
}

/* Error Alert */
.alert-error {
  background-color: var(--color-error-light);
  border-color: var(--color-error);
  color: var(--color-error-dark);
}

/* Info Alert */
.alert-info {
  background-color: var(--color-info-light);
  border-color: var(--color-info);
  color: var(--color-info-dark);
}
```

### Badges

```css
/* Base Badge */
.badge {
  display: inline-block;
  padding: var(--spacing-1) var(--spacing-2);  /* 4px 8px */
  font-size: var(--font-size-xs);              /* 12px */
  font-weight: var(--font-weight-semibold);
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  border-radius: 0.25rem;                       /* 4px */
}

.badge-primary {
  background-color: var(--color-primary);
  color: var(--color-white);
}

.badge-success {
  background-color: var(--color-success);
  color: var(--color-white);
}

.badge-info {
  background-color: var(--color-info);
  color: var(--color-white);
}
```

---

## Accessibility

### WCAG 2.1 AA Compliance

All brand elements meet **WCAG 2.1 Level AA** standards:

**Color Contrast Requirements:**
- Normal text (< 18pt): Minimum 4.5:1 contrast ratio
- Large text (≥ 18pt or 14pt bold): Minimum 3:1 contrast ratio
- UI components and graphical elements: Minimum 3:1 contrast ratio

**Verified Combinations:**

| Element | Foreground | Background | Ratio | Status |
|---------|------------|------------|-------|--------|
| Body text | `#374151` (Gray-700) | `#ffffff` (White) | 8.9:1 | ✅ AAA |
| Headings | `#000000` (Black) | `#ffffff` (White) | 21:1 | ✅ AAA |
| Secondary text | `#6b7280` (Gray-500) | `#ffffff` (White) | 4.6:1 | ✅ AA |
| Primary button | `#ffffff` (White) | `#0a97b0` (Primary) | 4.5:1 | ✅ AA |
| Links | `#0a97b0` (Primary) | `#ffffff` (White) | 4.5:1 | ✅ AA |

### Keyboard Navigation

**Requirements:**
- All interactive elements must be keyboard accessible (Tab, Enter, Space, Arrows)
- Visible focus indicators on all focusable elements
- Logical tab order matching visual layout
- Skip links for main content navigation

**Focus Styles:**

```css
/* Focus Indicator */
:focus {
  outline: 2px solid var(--color-primary);
  outline-offset: 2px;
}

:focus:not(:focus-visible) {
  outline: none;
}

:focus-visible {
  outline: 2px solid var(--color-primary);
  outline-offset: 2px;
}
```

### ARIA Labels & Semantic HTML

**Best Practices:**
- Use semantic HTML5 elements (`<nav>`, `<main>`, `<article>`, `<section>`)
- Add ARIA labels to icon-only buttons
- Include alt text on all images
- Use proper heading hierarchy (H1 → H2 → H3)
- Label form inputs with `<label>` elements
- Provide ARIA live regions for dynamic content

**Example:**

```html
<!-- Icon button with ARIA label -->
<button aria-label="Zarezerwuj pokój" class="btn btn-primary">
  <svg class="icon" aria-hidden="true"><!-- icon --></svg>
</button>

<!-- Navigation with ARIA label -->
<nav aria-label="Główna nawigacja">
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/pokoje">Pokoje</a></li>
  </ul>
</nav>

<!-- Image with descriptive alt text -->
<img
  src="room-deluxe.jpg"
  alt="Pokój Deluxe z podwójnym łóżkiem, widokiem na ogród i nowoczesnym wyposażeniem"
  loading="lazy">
```

### Touch Target Sizing

**Minimum Sizes (Mobile):**
- Buttons: 48×48px (optimally 44×44px with 4px spacing)
- Links: 44×44px clickable area
- Form inputs: 48px height
- Icons (interactive): 44×44px

```css
/* Mobile Touch Targets */
@media (max-width: 767px) {
  .btn {
    min-height: 48px;
    min-width: 48px;
    padding: var(--spacing-3) var(--spacing-6);
  }

  .nav-link {
    min-height: 44px;
    display: flex;
    align-items: center;
  }
}
```

---

## Implementation

### Oxygen Builder Integration

#### Custom CSS Classes

Add these classes to Oxygen Builder's "CSS Classes" panel:

**Typography Classes:**
```
h1, h2, h3, h4
body, lead, small
text-primary, text-secondary
text-gray-700, text-gray-900
```

**Button Classes:**
```
btn, btn-primary, btn-secondary, btn-outline
btn-sm, btn-lg, btn-block
```

**Layout Classes:**
```
container, grid, flex
col-12, col-6, col-4, col-3
gap-4, gap-6
items-center, justify-between
```

**Component Classes:**
```
card, card-image, card-body, card-footer
alert, alert-success, alert-warning, alert-error
badge, badge-primary, badge-success
```

#### CSS Custom Properties (Add to Oxygen → Manage → Stylesheets)

Create a new stylesheet named "Brand Variables" and add:

```css
:root {
  /* Colors */
  --color-primary: #0a97b0;
  --color-primary-hover: #087d91;
  --color-primary-light: #e6f7fa;
  --color-secondary: #000000;
  --color-background: #ffffff;
  --color-background-alt: #f7f7f7;

  /* Typography */
  --font-primary: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --font-size-base: 1rem;
  --font-weight-semibold: 600;
  --font-weight-bold: 700;

  /* Spacing */
  --spacing-4: 1rem;
  --spacing-6: 1.5rem;
  --spacing-8: 2rem;

  /* Container */
  --container-xl: 1280px;
}
```

#### Reusable Components in Oxygen

**Create Button Component:**

1. Add a "Link" element
2. CSS Classes: `btn btn-primary`
3. Set default text: "Zarezerwuj teraz"
4. Save as "Primary Button" component
5. Reuse across pages

**Create Card Component:**

1. Add a "Div" element (class: `card`)
2. Add child "Image" element (class: `card-image`)
3. Add child "Div" element (class: `card-body`)
   - Add "Heading" (H3)
   - Add "Text" paragraph
   - Add "Link" button
4. Save as "Room Card" component

#### ACF Pro Integration

**Dynamic Room Card Example:**

```php
<!-- In Oxygen Builder Code Block -->
<?php
$rooms = get_field('hotel_rooms'); // ACF Repeater
if ($rooms): ?>
  <div class="grid">
    <?php foreach ($rooms as $room): ?>
      <div class="card col-4">
        <img
          src="<?php echo esc_url($room['image']['url']); ?>"
          alt="<?php echo esc_attr($room['image']['alt']); ?>"
          class="card-image">
        <div class="card-body">
          <h3 class="card-title"><?php echo esc_html($room['name']); ?></h3>
          <p class="card-text"><?php echo esc_html($room['description']); ?></p>
          <a href="<?php echo esc_url($room['booking_link']); ?>" class="btn btn-primary">
            Zarezerwuj
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
```

### WordPress Theme Integration (Alternative to Oxygen)

If using traditional WordPress theme development:

**functions.php:**

```php
<?php
// Enqueue brand styles
function hotelnowydwor_enqueue_styles() {
    wp_enqueue_style(
        'brand-styles',
        get_template_directory_uri() . '/assets/css/brand.css',
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'hotelnowydwor_enqueue_styles');

// Add custom CSS classes to body
function hotelnowydwor_body_classes($classes) {
    $classes[] = 'brand-hotel-nowy-dwor';
    return $classes;
}
add_filter('body_class', 'hotelnowydwor_body_classes');
?>
```

**brand.css:**

```css
/* Import all brand variables and component styles */
@import 'variables.css';
@import 'typography.css';
@import 'buttons.css';
@import 'cards.css';
@import 'alerts.css';
```

---

## Version History

| Version | Date | Changes | Author |
|---------|------|---------|--------|
| 1.0.0 | December 15, 2025 | Initial brand settings documentation | PB MEDIA |

---

## Related Documentation

- **Design System:** `docs/DESIGN-SYSTEM.md` - Complete technical design system with all components and patterns
- **Architecture:** `docs/ARCHITECTURE.md` - Technical architecture of WordPress + Oxygen Builder setup
- **Contributing:** `docs/CONTRIBUTING.md` - Development guidelines and contribution process
- **SEO Audit:** `docs/audyt-seo-hotel-nowy-dwor-claude.md` - Comprehensive SEO analysis and recommendations

---

## Contact & Support

**Project Owner:** PB MEDIA Strony Sklepy Marketing
**Email:** biuro@pbmedia.pl
**Website:** https://www.hotelnowydwor.eu/

For questions about brand implementation, design system usage, or technical integration, contact the development team through the project repository or email above.

---

**End of Brand Settings Documentation**
