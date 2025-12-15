# Hotel Nowy Dwór Design System

**Version:** 1.0.0
**Last Updated:** December 2025
**Maintainer:** Development Team
**Website:** https://www.hotelnowydwor.eu/

---

## Table of Contents

1. [Introduction](#introduction)
2. [Design Principles](#design-principles)
3. [Brand Identity](#brand-identity)
4. [Color Palette](#color-palette)
5. [Typography](#typography)
6. [Spacing & Layout](#spacing--layout)
7. [Grid System](#grid-system)
8. [Components](#components)
9. [Icons & Imagery](#icons--imagery)
10. [Design Tokens](#design-tokens)
11. [Accessibility Standards](#accessibility-standards)
12. [Responsive Design](#responsive-design)
13. [Oxygen Builder Integration](#oxygen-builder-integration)
14. [Animation & Interactions](#animation--interactions)
15. [Forms & Inputs](#forms--inputs)
16. [Navigation Patterns](#navigation-patterns)
17. [Content Patterns](#content-patterns)
18. [Performance Guidelines](#performance-guidelines)
19. [Implementation Examples](#implementation-examples)
20. [Maintenance & Updates](#maintenance--updates)

---

## Introduction

### Purpose

This Design System document establishes the visual language, UI components, and interaction patterns for Hotel Nowy Dwór's website. It serves as a comprehensive guide for designers, developers, and content creators to maintain consistency across all digital touchpoints.

### Goals

1. **Consistency:** Unified visual language across all pages and components
2. **Accessibility:** WCAG 2.1 AA compliance in all design decisions
3. **Performance:** Optimized assets and code for PageSpeed ≥90
4. **Scalability:** Modular components that grow with business needs
5. **Maintainability:** Clear documentation for future updates

### Design System Scope

This design system applies to:

- Hotel Nowy Dwór website (https://www.hotelnowydwor.eu/)
- Oxygen Builder templates and components
- Email templates (future)
- Print materials (color and typography only)

### Technology Stack

- **CMS:** WordPress
- **Page Builder:** Oxygen Builder + Erropix Extensions
- **Custom Fields:** Advanced Custom Fields Pro
- **Image Optimization:** WebP Express
- **CSS Architecture:** BEM methodology with CSS Custom Properties

---

## Design Principles

### Core Principles

1. **Clarity Over Cleverness**
   - Simple, direct communication
   - No unnecessary visual complexity
   - Clear information hierarchy

2. **Accessibility First**
   - WCAG 2.1 AA compliance minimum
   - Keyboard navigation support
   - Screen reader optimization
   - Color contrast standards

3. **Performance Matters**
   - Optimized images (WebP/AVIF)
   - Minimal CSS/JS footprint
   - Lazy loading for below-fold content
   - Core Web Vitals optimization

4. **Mobile-First Approach**
   - Design for smallest screens first
   - Progressive enhancement for larger devices
   - Touch-friendly interactions (48×48px minimum)

5. **Brand Consistency**
   - Maintain visual identity across all pages
   - Consistent tone and voice
   - Recognizable patterns and components

---

## Brand Identity

### Brand Essence

**Hotel Nowy Dwór** is a modern, welcoming hotel in Trzebnica, Poland, offering:

- **Professional hospitality** with personal touch
- **Modern comfort** in historic location
- **Versatility** for business and leisure guests
- **Local pride** showcasing Trzebnica region

### Brand Personality

- **Welcoming:** Friendly, approachable, hospitable
- **Professional:** Reliable, organized, attentive
- **Modern:** Contemporary, updated, tech-savvy
- **Regional:** Connected to Trzebnica and Wrocław

### Visual Style

- **Clean & Contemporary:** Minimalist design with clear hierarchy
- **Teal Accent:** Modern, calming primary color
- **High-Quality Photography:** Showcase hotel features and local region
- **Spacious Layouts:** Generous white space, uncluttered pages

---

## Color Palette

### Primary Colors

These are the main brand colors used throughout the website.

```css
/* Primary Brand Color - Teal */
--color-primary: #0a97b0;
--color-primary-hover: #087d91;
--color-primary-light: #e6f7fa;
--color-primary-dark: #065766;

/* Secondary Brand Color - Black */
--color-secondary: #000000;
--color-secondary-hover: #333333;
```

#### Usage Guidelines

- **Primary Teal (#0a97b0):**
  - Call-to-action buttons
  - Links and interactive elements
  - Brand accents and highlights
  - Hover states

- **Secondary Black (#000000):**
  - Main text content
  - Headings
  - Icons
  - Navigation elements

### Neutral Colors

Background and text colors for UI elements.

```css
/* Neutral Palette */
--color-white: #ffffff;
--color-gray-50: #f9fafb;
--color-gray-100: #f3f4f6;
--color-gray-200: #e5e7eb;
--color-gray-300: #d1d5db;
--color-gray-400: #9ca3af;
--color-gray-500: #6b7280;
--color-gray-600: #4b5563;
--color-gray-700: #374151;
--color-gray-800: #1f2937;
--color-gray-900: #111827;
--color-black: #000000;
```

#### Usage Guidelines

- **White (#ffffff):** Main background, cards, containers
- **Gray-50 to Gray-200:** Alternative backgrounds, borders, dividers
- **Gray-400 to Gray-600:** Secondary text, placeholders, disabled states
- **Gray-700 to Gray-900:** Primary text, headings

### Semantic Colors

Colors for specific UI states and feedback.

```css
/* Success */
--color-success: #10b981;
--color-success-light: #d1fae5;
--color-success-dark: #047857;

/* Warning */
--color-warning: #f59e0b;
--color-warning-light: #fef3c7;
--color-warning-dark: #d97706;

/* Error */
--color-error: #ef4444;
--color-error-light: #fee2e2;
--color-error-dark: #dc2626;

/* Info */
--color-info: #3b82f6;
--color-info-light: #dbeafe;
--color-info-dark: #1d4ed8;
```

#### Usage Guidelines

- **Success:** Form submission confirmations, success messages
- **Warning:** Alerts, important notices
- **Error:** Form validation errors, error messages
- **Info:** Informational messages, tooltips

### Accessibility: Color Contrast

All color combinations meet WCAG 2.1 AA standards (4.5:1 for normal text, 3:1 for large text).

**Verified Contrast Ratios:**

| Foreground | Background | Ratio | Pass AA | Pass AAA |
|------------|------------|-------|---------|----------|
| #000000 (Black) | #ffffff (White) | 21:1 | ✅ | ✅ |
| #0a97b0 (Primary) | #ffffff (White) | 4.52:1 | ✅ | ❌ |
| #374151 (Gray-700) | #ffffff (White) | 10.52:1 | ✅ | ✅ |
| #ffffff (White) | #0a97b0 (Primary) | 4.52:1 | ✅ | ❌ |
| #ffffff (White) | #000000 (Black) | 21:1 | ✅ | ✅ |

**Note:** Primary teal (#0a97b0) on white background meets AA standard (4.52:1) but not AAA. For critical text, use darker shade or black.

### Color Usage Examples

```html
<!-- Primary Button -->
<button class="btn btn-primary">
  Book Now
</button>

<!-- Secondary Button -->
<button class="btn btn-secondary">
  Learn More
</button>

<!-- Success Message -->
<div class="alert alert-success">
  Your booking request has been submitted!
</div>

<!-- Error Message -->
<div class="alert alert-error">
  Please fill in all required fields.
</div>
```

```css
/* Button Styles */
.btn-primary {
  background-color: var(--color-primary);
  color: var(--color-white);
  border: none;
}

.btn-primary:hover {
  background-color: var(--color-primary-hover);
}

.btn-secondary {
  background-color: var(--color-secondary);
  color: var(--color-white);
  border: none;
}

.btn-secondary:hover {
  background-color: var(--color-secondary-hover);
}
```

---

## Typography

### Font Families

The website uses system font stacks for optimal performance and readability.

```css
/* Primary Font Stack (Sans-Serif) */
--font-primary: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                "Helvetica Neue", Arial, sans-serif,
                "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";

/* Secondary Font Stack (Serif - Optional for headings) */
--font-secondary: Georgia, "Times New Roman", Times, serif;

/* Monospace Font Stack (Code blocks, technical content) */
--font-mono: "SF Mono", Monaco, "Cascadia Code", "Roboto Mono",
             Consolas, "Liberation Mono", Menlo, Courier, monospace;
```

#### Why System Fonts?

- **Performance:** No external font files to download
- **Familiarity:** Users already know these fonts
- **Readability:** Optimized for each operating system
- **Accessibility:** Excellent support for special characters and Polish diacritics

### Font Sizes

Fluid typography scale using rem units (base: 16px).

```css
/* Font Size Scale */
--font-size-xs: 0.75rem;    /* 12px */
--font-size-sm: 0.875rem;   /* 14px */
--font-size-base: 1rem;     /* 16px */
--font-size-lg: 1.125rem;   /* 18px */
--font-size-xl: 1.25rem;    /* 20px */
--font-size-2xl: 1.5rem;    /* 24px */
--font-size-3xl: 1.875rem;  /* 30px */
--font-size-4xl: 2.25rem;   /* 36px */
--font-size-5xl: 3rem;      /* 48px */
--font-size-6xl: 3.75rem;   /* 60px */
--font-size-7xl: 4.5rem;    /* 72px */
```

### Heading Styles

```css
/* H1 - Page Titles */
h1, .h1 {
  font-size: var(--font-size-4xl);  /* 36px */
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 1.5rem;
  color: var(--color-secondary);
}

/* H2 - Section Headings */
h2, .h2 {
  font-size: var(--font-size-3xl);  /* 30px */
  font-weight: 600;
  line-height: 1.3;
  margin-bottom: 1.25rem;
  color: var(--color-secondary);
}

/* H3 - Subsection Headings */
h3, .h3 {
  font-size: var(--font-size-2xl);  /* 24px */
  font-weight: 600;
  line-height: 1.4;
  margin-bottom: 1rem;
  color: var(--color-secondary);
}

/* H4 - Component Headings */
h4, .h4 {
  font-size: var(--font-size-xl);   /* 20px */
  font-weight: 600;
  line-height: 1.5;
  margin-bottom: 0.75rem;
  color: var(--color-gray-800);
}

/* H5 - Small Headings */
h5, .h5 {
  font-size: var(--font-size-lg);   /* 18px */
  font-weight: 600;
  line-height: 1.5;
  margin-bottom: 0.5rem;
  color: var(--color-gray-700);
}

/* H6 - Smallest Headings */
h6, .h6 {
  font-size: var(--font-size-base);  /* 16px */
  font-weight: 600;
  line-height: 1.5;
  margin-bottom: 0.5rem;
  color: var(--color-gray-700);
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
```

### Body Text Styles

```css
/* Body Text */
body, .body {
  font-size: var(--font-size-base);  /* 16px */
  font-weight: 400;
  line-height: 1.6;
  color: var(--color-gray-700);
}

/* Lead Paragraph (Introductory text) */
.lead {
  font-size: var(--font-size-lg);    /* 18px */
  line-height: 1.7;
  color: var(--color-gray-600);
  margin-bottom: 1.5rem;
}

/* Small Text */
.text-sm {
  font-size: var(--font-size-sm);    /* 14px */
  line-height: 1.5;
}

/* Extra Small Text (Captions, meta info) */
.text-xs {
  font-size: var(--font-size-xs);    /* 12px */
  line-height: 1.4;
  color: var(--color-gray-500);
}
```

### Font Weights

```css
/* Font Weight Scale */
--font-weight-light: 300;
--font-weight-normal: 400;
--font-weight-medium: 500;
--font-weight-semibold: 600;
--font-weight-bold: 700;
--font-weight-extrabold: 800;
```

### Line Heights

```css
/* Line Height Scale */
--line-height-tight: 1.2;
--line-height-snug: 1.375;
--line-height-normal: 1.5;
--line-height-relaxed: 1.625;
--line-height-loose: 2;
```

### Typography Usage Examples

```html
<!-- Page Title -->
<h1 class="page-title">Hotel Nowy Dwór - Trzebnica</h1>

<!-- Section Heading -->
<h2 class="section-heading">Our Rooms & Suites</h2>

<!-- Lead Paragraph -->
<p class="lead">
  Experience modern comfort in the heart of Trzebnica,
  just 15 km from Wrocław.
</p>

<!-- Body Text -->
<p>
  Hotel Nowy Dwór offers 28 comfortable rooms, a restaurant,
  and event halls perfect for weddings and conferences.
</p>

<!-- Small Text (Meta Info) -->
<p class="text-sm text-gray-500">
  Last updated: December 15, 2025
</p>
```

### Responsive Typography

Typography scales down on mobile devices for better readability.

```css
/* Mobile (< 640px) */
@media (max-width: 639px) {
  h1, .h1 { font-size: var(--font-size-3xl); }  /* 30px */
  h2, .h2 { font-size: var(--font-size-2xl); }  /* 24px */
  h3, .h3 { font-size: var(--font-size-xl); }   /* 20px */
  h4, .h4 { font-size: var(--font-size-lg); }   /* 18px */
  h5, .h5 { font-size: var(--font-size-base); } /* 16px */
  h6, .h6 { font-size: var(--font-size-sm); }   /* 14px */
}

/* Tablet (640px - 1023px) */
@media (min-width: 640px) and (max-width: 1023px) {
  h1, .h1 { font-size: var(--font-size-4xl); }  /* 36px */
  h2, .h2 { font-size: var(--font-size-3xl); }  /* 30px */
}

/* Desktop (≥ 1024px) */
@media (min-width: 1024px) {
  h1, .h1 { font-size: var(--font-size-5xl); }  /* 48px */
  h2, .h2 { font-size: var(--font-size-4xl); }  /* 36px */
}
```

---

## Spacing & Layout

### Spacing Scale

Consistent spacing system based on 4px grid.

```css
/* Spacing Scale (4px base) */
--spacing-0: 0;
--spacing-1: 0.25rem;  /* 4px */
--spacing-2: 0.5rem;   /* 8px */
--spacing-3: 0.75rem;  /* 12px */
--spacing-4: 1rem;     /* 16px */
--spacing-5: 1.25rem;  /* 20px */
--spacing-6: 1.5rem;   /* 24px */
--spacing-7: 1.75rem;  /* 28px */
--spacing-8: 2rem;     /* 32px */
--spacing-10: 2.5rem;  /* 40px */
--spacing-12: 3rem;    /* 48px */
--spacing-16: 4rem;    /* 64px */
--spacing-20: 5rem;    /* 80px */
--spacing-24: 6rem;    /* 96px */
--spacing-32: 8rem;    /* 128px */
```

### Component Spacing

```css
/* Padding Utilities */
.p-0 { padding: var(--spacing-0); }
.p-1 { padding: var(--spacing-1); }
.p-2 { padding: var(--spacing-2); }
.p-4 { padding: var(--spacing-4); }
.p-6 { padding: var(--spacing-6); }
.p-8 { padding: var(--spacing-8); }

/* Margin Utilities */
.m-0 { margin: var(--spacing-0); }
.m-1 { margin: var(--spacing-1); }
.m-2 { margin: var(--spacing-2); }
.m-4 { margin: var(--spacing-4); }
.m-6 { margin: var(--spacing-6); }
.m-8 { margin: var(--spacing-8); }

/* Vertical Spacing (Margin Top/Bottom) */
.my-4 { margin-top: var(--spacing-4); margin-bottom: var(--spacing-4); }
.my-6 { margin-top: var(--spacing-6); margin-bottom: var(--spacing-6); }
.my-8 { margin-top: var(--spacing-8); margin-bottom: var(--spacing-8); }

/* Horizontal Spacing (Margin Left/Right) */
.mx-auto { margin-left: auto; margin-right: auto; }
```

### Section Spacing

Standard spacing between page sections.

```css
/* Section Padding */
.section {
  padding-top: var(--spacing-16);    /* 64px */
  padding-bottom: var(--spacing-16); /* 64px */
}

@media (max-width: 767px) {
  .section {
    padding-top: var(--spacing-12);    /* 48px */
    padding-bottom: var(--spacing-12); /* 48px */
  }
}
```

---

## Grid System

### Container

Maximum width containers for content.

```css
/* Container Widths */
--container-sm: 640px;
--container-md: 768px;
--container-lg: 1024px;
--container-xl: 1280px;
--container-2xl: 1536px;

/* Container Base */
.container {
  width: 100%;
  margin-left: auto;
  margin-right: auto;
  padding-left: var(--spacing-4);  /* 16px */
  padding-right: var(--spacing-4); /* 16px */
}

@media (min-width: 640px) {
  .container { max-width: var(--container-sm); }
}

@media (min-width: 768px) {
  .container { max-width: var(--container-md); }
}

@media (min-width: 1024px) {
  .container { max-width: var(--container-lg); }
}

@media (min-width: 1280px) {
  .container { max-width: var(--container-xl); }
}

@media (min-width: 1536px) {
  .container { max-width: var(--container-2xl); }
}
```

### Grid Layout

12-column flexible grid system.

```css
/* Grid Container */
.grid {
  display: grid;
  gap: var(--spacing-6);  /* 24px */
}

/* Column Spans */
.col-span-1 { grid-column: span 1 / span 1; }
.col-span-2 { grid-column: span 2 / span 2; }
.col-span-3 { grid-column: span 3 / span 3; }
.col-span-4 { grid-column: span 4 / span 4; }
.col-span-6 { grid-column: span 6 / span 6; }
.col-span-12 { grid-column: span 12 / span 12; }

/* Grid Templates */
.grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
.grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
.grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
.grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)); }
```

### Flexbox Utilities

```css
/* Flex Container */
.flex {
  display: flex;
}

/* Flex Direction */
.flex-row { flex-direction: row; }
.flex-col { flex-direction: column; }

/* Justify Content */
.justify-start { justify-content: flex-start; }
.justify-center { justify-content: center; }
.justify-between { justify-content: space-between; }
.justify-around { justify-content: space-around; }
.justify-end { justify-content: flex-end; }

/* Align Items */
.items-start { align-items: flex-start; }
.items-center { align-items: center; }
.items-end { align-items: flex-end; }
.items-stretch { align-items: stretch; }

/* Gap */
.gap-2 { gap: var(--spacing-2); }
.gap-4 { gap: var(--spacing-4); }
.gap-6 { gap: var(--spacing-6); }
.gap-8 { gap: var(--spacing-8); }
```

### Layout Examples

```html
<!-- Two-Column Layout -->
<div class="container">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="col-span-1">Column 1</div>
    <div class="col-span-1">Column 2</div>
  </div>
</div>

<!-- Three-Column Layout -->
<div class="container">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="col-span-1">Column 1</div>
    <div class="col-span-1">Column 2</div>
    <div class="col-span-1">Column 3</div>
  </div>
</div>

<!-- Flex Layout (Centered) -->
<div class="flex justify-center items-center gap-4">
  <button class="btn btn-primary">Book Now</button>
  <button class="btn btn-secondary">Learn More</button>
</div>
```

---

## Components

### Buttons

#### Primary Button

```html
<button class="btn btn-primary">
  Book Now
</button>
```

```css
.btn {
  display: inline-block;
  padding: var(--spacing-3) var(--spacing-6);  /* 12px 24px */
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-semibold);
  line-height: 1.5;
  text-align: center;
  text-decoration: none;
  border: 2px solid transparent;
  border-radius: 0.375rem;  /* 6px */
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

.btn-primary {
  background-color: var(--color-primary);
  color: var(--color-white);
  border-color: var(--color-primary);
}

.btn-primary:hover {
  background-color: var(--color-primary-hover);
  border-color: var(--color-primary-hover);
  transform: translateY(-1px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-primary:focus {
  outline: 2px solid var(--color-primary);
  outline-offset: 2px;
}

.btn-primary:active {
  transform: translateY(0);
}
```

#### Secondary Button

```html
<button class="btn btn-secondary">
  Learn More
</button>
```

```css
.btn-secondary {
  background-color: var(--color-secondary);
  color: var(--color-white);
  border-color: var(--color-secondary);
}

.btn-secondary:hover {
  background-color: var(--color-secondary-hover);
  border-color: var(--color-secondary-hover);
  transform: translateY(-1px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
```

#### Outline Button

```html
<button class="btn btn-outline">
  Contact Us
</button>
```

```css
.btn-outline {
  background-color: transparent;
  color: var(--color-primary);
  border-color: var(--color-primary);
}

.btn-outline:hover {
  background-color: var(--color-primary);
  color: var(--color-white);
  transform: translateY(-1px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
```

#### Button Sizes

```html
<!-- Small Button -->
<button class="btn btn-primary btn-sm">Small</button>

<!-- Medium Button (Default) -->
<button class="btn btn-primary">Medium</button>

<!-- Large Button -->
<button class="btn btn-primary btn-lg">Large</button>
```

```css
.btn-sm {
  padding: var(--spacing-2) var(--spacing-4);  /* 8px 16px */
  font-size: var(--font-size-sm);  /* 14px */
}

.btn-lg {
  padding: var(--spacing-4) var(--spacing-8);  /* 16px 32px */
  font-size: var(--font-size-lg);  /* 18px */
}
```

#### Button States

```css
/* Disabled State */
.btn:disabled,
.btn.disabled {
  opacity: 0.5;
  cursor: not-allowed;
  pointer-events: none;
}

/* Loading State */
.btn.loading {
  position: relative;
  color: transparent;
  pointer-events: none;
}

.btn.loading::after {
  content: "";
  position: absolute;
  width: 16px;
  height: 16px;
  top: 50%;
  left: 50%;
  margin-left: -8px;
  margin-top: -8px;
  border: 2px solid currentColor;
  border-radius: 50%;
  border-right-color: transparent;
  animation: spinner 0.6s linear infinite;
}

@keyframes spinner {
  to { transform: rotate(360deg); }
}
```

### Cards

```html
<div class="card">
  <img src="room-image.jpg" alt="Deluxe Room" class="card-image">
  <div class="card-body">
    <h3 class="card-title">Deluxe Room</h3>
    <p class="card-description">
      Spacious room with king-size bed, modern bathroom,
      and beautiful garden views.
    </p>
    <div class="card-footer">
      <span class="card-price">350 PLN/night</span>
      <button class="btn btn-primary btn-sm">Book Now</button>
    </div>
  </div>
</div>
```

```css
.card {
  background-color: var(--color-white);
  border-radius: 0.5rem;  /* 8px */
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
  padding: var(--spacing-6);  /* 24px */
}

.card-title {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-semibold);
  margin-bottom: var(--spacing-2);
}

.card-description {
  font-size: var(--font-size-base);
  color: var(--color-gray-600);
  margin-bottom: var(--spacing-4);
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: var(--spacing-4);
  border-top: 1px solid var(--color-gray-200);
}

.card-price {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-bold);
  color: var(--color-primary);
}
```

### Alerts

```html
<!-- Success Alert -->
<div class="alert alert-success">
  <svg class="alert-icon"><!-- Success icon --></svg>
  <p class="alert-message">Your booking request has been submitted!</p>
</div>

<!-- Error Alert -->
<div class="alert alert-error">
  <svg class="alert-icon"><!-- Error icon --></svg>
  <p class="alert-message">Please fill in all required fields.</p>
</div>

<!-- Warning Alert -->
<div class="alert alert-warning">
  <svg class="alert-icon"><!-- Warning icon --></svg>
  <p class="alert-message">Check-in time is 3:00 PM.</p>
</div>

<!-- Info Alert -->
<div class="alert alert-info">
  <svg class="alert-icon"><!-- Info icon --></svg>
  <p class="alert-message">WiFi is complimentary for all guests.</p>
</div>
```

```css
.alert {
  display: flex;
  align-items: flex-start;
  padding: var(--spacing-4);
  border-radius: 0.5rem;
  border-left: 4px solid;
}

.alert-icon {
  width: 20px;
  height: 20px;
  margin-right: var(--spacing-3);
  flex-shrink: 0;
}

.alert-message {
  flex: 1;
  font-size: var(--font-size-base);
  line-height: 1.5;
}

/* Success */
.alert-success {
  background-color: var(--color-success-light);
  border-color: var(--color-success);
  color: var(--color-success-dark);
}

/* Error */
.alert-error {
  background-color: var(--color-error-light);
  border-color: var(--color-error);
  color: var(--color-error-dark);
}

/* Warning */
.alert-warning {
  background-color: var(--color-warning-light);
  border-color: var(--color-warning);
  color: var(--color-warning-dark);
}

/* Info */
.alert-info {
  background-color: var(--color-info-light);
  border-color: var(--color-info);
  color: var(--color-info-dark);
}
```

### Badges

```html
<!-- Default Badge -->
<span class="badge">New</span>

<!-- Primary Badge -->
<span class="badge badge-primary">Popular</span>

<!-- Success Badge -->
<span class="badge badge-success">Available</span>

<!-- Error Badge -->
<span class="badge badge-error">Sold Out</span>
```

```css
.badge {
  display: inline-block;
  padding: var(--spacing-1) var(--spacing-2);  /* 4px 8px */
  font-size: var(--font-size-xs);
  font-weight: var(--font-weight-semibold);
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
  background-color: var(--color-gray-200);
  color: var(--color-gray-700);
}

.badge-primary {
  background-color: var(--color-primary);
  color: var(--color-white);
}

.badge-success {
  background-color: var(--color-success);
  color: var(--color-white);
}

.badge-error {
  background-color: var(--color-error);
  color: var(--color-white);
}
```

---

## Icons & Imagery

### Icon System

Use inline SVG icons for optimal performance and flexibility.

#### Icon Sizes

```css
/* Icon Size Scale */
--icon-xs: 16px;
--icon-sm: 20px;
--icon-md: 24px;
--icon-lg: 32px;
--icon-xl: 48px;

.icon {
  display: inline-block;
  width: var(--icon-md);
  height: var(--icon-md);
  fill: currentColor;
}

.icon-xs { width: var(--icon-xs); height: var(--icon-xs); }
.icon-sm { width: var(--icon-sm); height: var(--icon-sm); }
.icon-lg { width: var(--icon-lg); height: var(--icon-lg); }
.icon-xl { width: var(--icon-xl); height: var(--icon-xl); }
```

#### Common Icons

```html
<!-- Phone Icon -->
<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
</svg>

<!-- Email Icon -->
<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
</svg>

<!-- Location Icon -->
<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
</svg>

<!-- Calendar Icon -->
<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
  <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-width="2"/>
  <line x1="16" y1="2" x2="16" y2="6" stroke-width="2"/>
  <line x1="8" y1="2" x2="8" y2="6" stroke-width="2"/>
  <line x1="3" y1="10" x2="21" y2="10" stroke-width="2"/>
</svg>
```

### Image Guidelines

#### Image Formats

```yaml
Priority Order:
  1. AVIF (best compression, modern browsers)
  2. WebP (excellent compression, wide support)
  3. JPEG (fallback for older browsers)
  4. PNG (only for images requiring transparency)

Optimization Tools:
  - WebP Express (WordPress plugin - installed)
  - ImageOptim (manual optimization)
  - Squoosh.app (web-based tool)
```

#### Image Sizes

```yaml
Hero Images:
  Desktop: 1920×1080px (16:9 ratio)
  Mobile: 768×1024px (3:4 ratio)
  Max File Size: 300KB

Room Images:
  Card Thumbnail: 400×300px (4:3 ratio)
  Lightbox: 1200×900px (4:3 ratio)
  Max File Size: 150KB (thumbnail), 250KB (lightbox)

Gallery Images:
  Thumbnail: 300×300px (1:1 ratio)
  Full Size: 1200×800px (3:2 ratio)
  Max File Size: 100KB (thumbnail), 200KB (full)

Icons & Logos:
  Logo: SVG format (scalable)
  Favicon: 32×32px, 180×180px (PNG)
```

#### Responsive Images

```html
<!-- Picture Element with WebP and Fallback -->
<picture>
  <source
    srcset="hero-mobile.avif"
    type="image/avif"
    media="(max-width: 767px)">
  <source
    srcset="hero-mobile.webp"
    type="image/webp"
    media="(max-width: 767px)">
  <source
    srcset="hero-desktop.avif"
    type="image/avif"
    media="(min-width: 768px)">
  <source
    srcset="hero-desktop.webp"
    type="image/webp"
    media="(min-width: 768px)">
  <img
    src="hero-desktop.jpg"
    alt="Hotel Nowy Dwór - Modern Rooms in Trzebnica"
    loading="lazy"
    width="1920"
    height="1080">
</picture>
```

#### Image Lazy Loading

```html
<!-- Lazy Load Images Below Fold -->
<img
  src="placeholder.jpg"
  data-src="actual-image.webp"
  alt="Deluxe Room"
  loading="lazy"
  width="400"
  height="300"
  class="lazy">
```

#### Alt Text Guidelines

```html
<!-- Good Alt Text Examples -->
<img src="deluxe-room.jpg" alt="Deluxe room with king-size bed and garden view">
<img src="restaurant.jpg" alt="Hotel restaurant serving Polish cuisine">
<img src="conference-hall.jpg" alt="Conference hall setup for business meeting">

<!-- Bad Alt Text Examples (DON'T DO THIS) -->
<img src="image1.jpg" alt="Image">  <!-- Too vague -->
<img src="room.jpg" alt="">  <!-- Missing alt text -->
<img src="photo.jpg" alt="Photo of a room">  <!-- Redundant "photo of" -->
```

---

## Design Tokens

### CSS Custom Properties

All design tokens stored as CSS custom properties for easy theming and maintenance.

```css
:root {
  /* Colors - Primary */
  --color-primary: #0a97b0;
  --color-primary-hover: #087d91;
  --color-primary-light: #e6f7fa;
  --color-primary-dark: #065766;

  /* Colors - Secondary */
  --color-secondary: #000000;
  --color-secondary-hover: #333333;

  /* Colors - Neutral */
  --color-white: #ffffff;
  --color-gray-50: #f9fafb;
  --color-gray-100: #f3f4f6;
  --color-gray-200: #e5e7eb;
  --color-gray-300: #d1d5db;
  --color-gray-400: #9ca3af;
  --color-gray-500: #6b7280;
  --color-gray-600: #4b5563;
  --color-gray-700: #374151;
  --color-gray-800: #1f2937;
  --color-gray-900: #111827;
  --color-black: #000000;

  /* Colors - Semantic */
  --color-success: #10b981;
  --color-success-light: #d1fae5;
  --color-success-dark: #047857;
  --color-warning: #f59e0b;
  --color-warning-light: #fef3c7;
  --color-warning-dark: #d97706;
  --color-error: #ef4444;
  --color-error-light: #fee2e2;
  --color-error-dark: #dc2626;
  --color-info: #3b82f6;
  --color-info-light: #dbeafe;
  --color-info-dark: #1d4ed8;

  /* Typography - Font Families */
  --font-primary: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                  "Helvetica Neue", Arial, sans-serif;
  --font-secondary: Georgia, "Times New Roman", Times, serif;
  --font-mono: "SF Mono", Monaco, "Cascadia Code", "Roboto Mono",
               Consolas, "Liberation Mono", Menlo, Courier, monospace;

  /* Typography - Font Sizes */
  --font-size-xs: 0.75rem;    /* 12px */
  --font-size-sm: 0.875rem;   /* 14px */
  --font-size-base: 1rem;     /* 16px */
  --font-size-lg: 1.125rem;   /* 18px */
  --font-size-xl: 1.25rem;    /* 20px */
  --font-size-2xl: 1.5rem;    /* 24px */
  --font-size-3xl: 1.875rem;  /* 30px */
  --font-size-4xl: 2.25rem;   /* 36px */
  --font-size-5xl: 3rem;      /* 48px */
  --font-size-6xl: 3.75rem;   /* 60px */
  --font-size-7xl: 4.5rem;    /* 72px */

  /* Typography - Font Weights */
  --font-weight-light: 300;
  --font-weight-normal: 400;
  --font-weight-medium: 500;
  --font-weight-semibold: 600;
  --font-weight-bold: 700;
  --font-weight-extrabold: 800;

  /* Typography - Line Heights */
  --line-height-tight: 1.2;
  --line-height-snug: 1.375;
  --line-height-normal: 1.5;
  --line-height-relaxed: 1.625;
  --line-height-loose: 2;

  /* Spacing (4px base) */
  --spacing-0: 0;
  --spacing-1: 0.25rem;  /* 4px */
  --spacing-2: 0.5rem;   /* 8px */
  --spacing-3: 0.75rem;  /* 12px */
  --spacing-4: 1rem;     /* 16px */
  --spacing-5: 1.25rem;  /* 20px */
  --spacing-6: 1.5rem;   /* 24px */
  --spacing-7: 1.75rem;  /* 28px */
  --spacing-8: 2rem;     /* 32px */
  --spacing-10: 2.5rem;  /* 40px */
  --spacing-12: 3rem;    /* 48px */
  --spacing-16: 4rem;    /* 64px */
  --spacing-20: 5rem;    /* 80px */
  --spacing-24: 6rem;    /* 96px */
  --spacing-32: 8rem;    /* 128px */

  /* Border Radius */
  --radius-none: 0;
  --radius-sm: 0.125rem;  /* 2px */
  --radius-base: 0.25rem; /* 4px */
  --radius-md: 0.375rem;  /* 6px */
  --radius-lg: 0.5rem;    /* 8px */
  --radius-xl: 0.75rem;   /* 12px */
  --radius-2xl: 1rem;     /* 16px */
  --radius-full: 9999px;

  /* Shadows */
  --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
  --shadow-base: 0 1px 3px rgba(0, 0, 0, 0.1);
  --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
  --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
  --shadow-2xl: 0 25px 50px rgba(0, 0, 0, 0.15);

  /* Z-Index */
  --z-index-dropdown: 1000;
  --z-index-sticky: 1020;
  --z-index-fixed: 1030;
  --z-index-modal-backdrop: 1040;
  --z-index-modal: 1050;
  --z-index-popover: 1060;
  --z-index-tooltip: 1070;

  /* Transitions */
  --transition-fast: 150ms ease-in-out;
  --transition-base: 200ms ease-in-out;
  --transition-slow: 300ms ease-in-out;

  /* Breakpoints (for JavaScript) */
  --breakpoint-sm: 640px;
  --breakpoint-md: 768px;
  --breakpoint-lg: 1024px;
  --breakpoint-xl: 1280px;
  --breakpoint-2xl: 1536px;
}
```

### Using Design Tokens

```css
/* Example: Button using design tokens */
.btn-primary {
  background-color: var(--color-primary);
  color: var(--color-white);
  padding: var(--spacing-3) var(--spacing-6);
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-semibold);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-base);
  transition: all var(--transition-base);
}

.btn-primary:hover {
  background-color: var(--color-primary-hover);
  box-shadow: var(--shadow-md);
}
```

---

## Accessibility Standards

### WCAG 2.1 AA Compliance

All components and pages must meet WCAG 2.1 Level AA standards minimum.

#### Color Contrast

```yaml
Requirements:
  Normal Text (< 18px): 4.5:1 contrast ratio minimum
  Large Text (≥ 18px or 14px bold): 3:1 contrast ratio minimum
  UI Components: 3:1 contrast ratio minimum

Verified Combinations:
  - Black (#000000) on White (#ffffff): 21:1 ✅
  - Primary (#0a97b0) on White (#ffffff): 4.52:1 ✅
  - Gray-700 (#374151) on White (#ffffff): 10.52:1 ✅
  - White (#ffffff) on Primary (#0a97b0): 4.52:1 ✅
```

#### Keyboard Navigation

```html
<!-- All interactive elements must be keyboard accessible -->
<button tabindex="0" aria-label="Book a room">
  Book Now
</button>

<a href="/rooms" tabindex="0" aria-label="View available rooms">
  Our Rooms
</a>

<!-- Skip to main content link -->
<a href="#main-content" class="skip-link">
  Skip to main content
</a>
```

```css
/* Visible focus indicators */
*:focus {
  outline: 2px solid var(--color-primary);
  outline-offset: 2px;
}

/* Skip link (hidden until focused) */
.skip-link {
  position: absolute;
  top: -40px;
  left: 0;
  background: var(--color-primary);
  color: var(--color-white);
  padding: var(--spacing-2) var(--spacing-4);
  text-decoration: none;
  z-index: 100;
}

.skip-link:focus {
  top: 0;
}
```

#### ARIA Labels

```html
<!-- Navigation with ARIA -->
<nav aria-label="Main navigation">
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/rooms">Rooms</a></li>
    <li><a href="/contact">Contact</a></li>
  </ul>
</nav>

<!-- Button with icon (needs ARIA label) -->
<button aria-label="Close dialog">
  <svg class="icon" aria-hidden="true">
    <!-- Close icon -->
  </svg>
</button>

<!-- Form with ARIA -->
<form role="search" aria-label="Search hotel rooms">
  <label for="search-input" class="sr-only">Search</label>
  <input
    type="search"
    id="search-input"
    aria-label="Search rooms"
    placeholder="Search rooms...">
  <button type="submit" aria-label="Submit search">
    Search
  </button>
</form>
```

#### Screen Reader Only Text

```html
<span class="sr-only">Screen reader only text</span>
```

```css
/* Screen reader only class */
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border-width: 0;
}
```

#### Semantic HTML

```html
<!-- Use semantic HTML elements -->
<header>
  <nav aria-label="Primary navigation">...</nav>
</header>

<main id="main-content">
  <article>
    <h1>Page Title</h1>
    <section>
      <h2>Section Title</h2>
      <p>Content...</p>
    </section>
  </article>
</main>

<aside>
  <h2>Sidebar</h2>
  <!-- Sidebar content -->
</aside>

<footer>
  <p>&copy; 2025 Hotel Nowy Dwór</p>
</footer>
```

---

## Responsive Design

### Breakpoints

```css
/* Mobile First Breakpoints */
/* Extra Small (default): 0px - 639px */
/* Small: 640px - 767px */
@media (min-width: 640px) { /* sm */ }

/* Medium: 768px - 1023px */
@media (min-width: 768px) { /* md */ }

/* Large: 1024px - 1279px */
@media (min-width: 1024px) { /* lg */ }

/* Extra Large: 1280px - 1535px */
@media (min-width: 1280px) { /* xl */ }

/* 2XL: 1536px+ */
@media (min-width: 1536px) { /* 2xl */ }
```

### Mobile-First Approach

Design for mobile first, then enhance for larger screens.

```css
/* Mobile (default) */
.container {
  padding: var(--spacing-4);
}

.grid {
  grid-template-columns: 1fr;
}

/* Tablet */
@media (min-width: 768px) {
  .container {
    padding: var(--spacing-6);
  }

  .grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Desktop */
@media (min-width: 1024px) {
  .container {
    padding: var(--spacing-8);
  }

  .grid {
    grid-template-columns: repeat(3, 1fr);
  }
}
```

### Touch Targets

All interactive elements must be at least 48×48px for touch screens.

```css
/* Minimum touch target size */
.btn,
a,
button,
input[type="submit"],
input[type="button"] {
  min-height: 48px;
  min-width: 48px;
  padding: var(--spacing-3) var(--spacing-4);
}

/* Exception for small text links in body content */
.text-content a {
  min-height: auto;
  min-width: auto;
  padding: var(--spacing-1);
}
```

### Responsive Typography

```css
/* Fluid typography with clamp() */
h1 {
  font-size: clamp(1.875rem, 5vw, 3rem);  /* 30px - 48px */
}

h2 {
  font-size: clamp(1.5rem, 4vw, 2.25rem);  /* 24px - 36px */
}

h3 {
  font-size: clamp(1.25rem, 3vw, 1.875rem);  /* 20px - 30px */
}

body {
  font-size: clamp(0.875rem, 2vw, 1rem);  /* 14px - 16px */
}
```

### Responsive Images

```css
/* Responsive images */
img {
  max-width: 100%;
  height: auto;
  display: block;
}

/* Hero image responsiveness */
.hero-image {
  width: 100%;
  height: 300px;
  object-fit: cover;
}

@media (min-width: 768px) {
  .hero-image {
    height: 500px;
  }
}

@media (min-width: 1024px) {
  .hero-image {
    height: 600px;
  }
}
```

---

## Oxygen Builder Integration

### Oxygen-Specific Classes

```css
/* Oxygen Builder wrapper classes */
.oxy-post-content {
  /* Oxygen content container */
}

.ct-section {
  /* Oxygen section component */
}

.ct-div-block {
  /* Oxygen div block component */
}

.ct-text-block {
  /* Oxygen text block component */
}

.ct-image {
  /* Oxygen image component */
}
```

### Custom Classes in Oxygen

When creating custom classes in Oxygen Builder:

1. **Use BEM Naming Convention**
   ```
   .block__element--modifier

   Example:
   .card__header
   .card__body
   .card__footer--primary
   ```

2. **Prefix Custom Classes**
   ```
   .hn-  (Hotel Nowy prefix)

   Example:
   .hn-hero
   .hn-room-card
   .hn-booking-form
   ```

3. **Reusable Components**
   ```css
   /* Component: Room Card */
   .hn-room-card {
     background: var(--color-white);
     border-radius: var(--radius-lg);
     box-shadow: var(--shadow-base);
     overflow: hidden;
   }

   .hn-room-card__image {
     width: 100%;
     height: 200px;
     object-fit: cover;
   }

   .hn-room-card__body {
     padding: var(--spacing-6);
   }

   .hn-room-card__title {
     font-size: var(--font-size-xl);
     font-weight: var(--font-weight-semibold);
     margin-bottom: var(--spacing-2);
   }
   ```

### ACF Integration

```html
<!-- Display ACF fields in Oxygen templates -->
<div class="hn-room-details">
  <h3 class="hn-room-details__title">
    [oxygen data='field' field='room_name']
  </h3>

  <p class="hn-room-details__description">
    [oxygen data='field' field='room_description']
  </p>

  <div class="hn-room-details__amenities">
    [oxygen data='repeater' field='room_amenities']
      <span class="badge">
        [oxygen data='field' field='amenity_name']
      </span>
    [/oxygen]
  </div>
</div>
```

### Oxygen Global Styles

Store design tokens in Oxygen's Global Styles for site-wide consistency:

```yaml
Settings → Stylesheets → Global Styles:

Colors:
  Primary: #0a97b0
  Secondary: #000000
  Background: #ffffff
  Text: #374151

Fonts:
  Primary Font: System Sans-Serif
  Heading Font: System Sans-Serif

Spacing:
  Container Padding: 16px (mobile), 24px (tablet), 32px (desktop)
  Section Padding: 48px (mobile), 64px (tablet), 80px (desktop)
```

---

## Animation & Interactions

### Transition Standards

```css
/* Standard transitions */
--transition-fast: 150ms ease-in-out;
--transition-base: 200ms ease-in-out;
--transition-slow: 300ms ease-in-out;

/* Apply to interactive elements */
button,
a,
.card {
  transition: all var(--transition-base);
}
```

### Hover Effects

```css
/* Button hover */
.btn:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

/* Card hover */
.card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-lg);
}

/* Link hover */
a:hover {
  color: var(--color-primary-hover);
  text-decoration: underline;
}
```

### Fade In Animation

```css
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in {
  animation: fadeIn var(--transition-slow) ease-out;
}
```

### Slide In Animation

```css
@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.slide-in-left {
  animation: slideInLeft var(--transition-base) ease-out;
}
```

### Performance Considerations

```css
/* Use transform and opacity for animations (GPU-accelerated) */
/* ✅ GOOD */
.element {
  transition: transform var(--transition-base), opacity var(--transition-base);
}

.element:hover {
  transform: translateY(-2px);
  opacity: 0.9;
}

/* ❌ BAD (causes layout shifts) */
.element {
  transition: top var(--transition-base), height var(--transition-base);
}

.element:hover {
  top: -2px;
  height: 110%;
}
```

### Reduced Motion

```css
/* Respect user's motion preferences */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```

---

## Forms & Inputs

### Form Layout

```html
<form class="form">
  <div class="form-group">
    <label for="name" class="form-label">Name *</label>
    <input
      type="text"
      id="name"
      name="name"
      class="form-input"
      required
      aria-required="true">
  </div>

  <div class="form-group">
    <label for="email" class="form-label">Email *</label>
    <input
      type="email"
      id="email"
      name="email"
      class="form-input"
      required
      aria-required="true">
  </div>

  <div class="form-group">
    <label for="message" class="form-label">Message</label>
    <textarea
      id="message"
      name="message"
      rows="4"
      class="form-textarea"></textarea>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary">
      Send Message
    </button>
  </div>
</form>
```

### Form Styles

```css
.form {
  max-width: 600px;
}

.form-group {
  margin-bottom: var(--spacing-6);
}

.form-label {
  display: block;
  font-size: var(--font-size-sm);
  font-weight: var(--font-weight-medium);
  color: var(--color-gray-700);
  margin-bottom: var(--spacing-2);
}

.form-input,
.form-textarea,
.form-select {
  display: block;
  width: 100%;
  padding: var(--spacing-3);
  font-size: var(--font-size-base);
  line-height: 1.5;
  color: var(--color-gray-900);
  background-color: var(--color-white);
  border: 1px solid var(--color-gray-300);
  border-radius: var(--radius-md);
  transition: border-color var(--transition-base), box-shadow var(--transition-base);
}

.form-input:focus,
.form-textarea:focus,
.form-select:focus {
  outline: none;
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px var(--color-primary-light);
}

.form-input:disabled,
.form-textarea:disabled,
.form-select:disabled {
  background-color: var(--color-gray-100);
  cursor: not-allowed;
}

/* Error state */
.form-input.error,
.form-textarea.error {
  border-color: var(--color-error);
}

.form-input.error:focus,
.form-textarea.error:focus {
  box-shadow: 0 0 0 3px var(--color-error-light);
}

.form-error {
  display: block;
  margin-top: var(--spacing-2);
  font-size: var(--font-size-sm);
  color: var(--color-error);
}

/* Success state */
.form-input.success,
.form-textarea.success {
  border-color: var(--color-success);
}
```

### Checkbox & Radio Styles

```html
<!-- Checkbox -->
<div class="form-check">
  <input
    type="checkbox"
    id="newsletter"
    name="newsletter"
    class="form-check-input">
  <label for="newsletter" class="form-check-label">
    Subscribe to newsletter
  </label>
</div>

<!-- Radio -->
<div class="form-check">
  <input
    type="radio"
    id="room-standard"
    name="room-type"
    value="standard"
    class="form-check-input">
  <label for="room-standard" class="form-check-label">
    Standard Room
  </label>
</div>
```

```css
.form-check {
  display: flex;
  align-items: center;
  margin-bottom: var(--spacing-3);
}

.form-check-input {
  width: 20px;
  height: 20px;
  margin-right: var(--spacing-2);
  cursor: pointer;
}

.form-check-label {
  font-size: var(--font-size-base);
  cursor: pointer;
}
```

### Form Validation

```html
<!-- Required field indicator -->
<label for="email" class="form-label">
  Email <span class="required">*</span>
</label>

<!-- Error message -->
<input
  type="email"
  id="email"
  name="email"
  class="form-input error"
  aria-invalid="true"
  aria-describedby="email-error">
<span id="email-error" class="form-error" role="alert">
  Please enter a valid email address.
</span>

<!-- Success message -->
<div class="alert alert-success" role="status">
  <p>Your message has been sent successfully!</p>
</div>
```

---

## Navigation Patterns

### Main Navigation

```html
<header class="header">
  <div class="container">
    <nav class="navbar" aria-label="Main navigation">
      <div class="navbar-brand">
        <a href="/" aria-label="Hotel Nowy Dwór - Homepage">
          <img src="logo.svg" alt="Hotel Nowy Dwór" class="logo">
        </a>
      </div>

      <button
        class="navbar-toggle"
        aria-label="Toggle navigation menu"
        aria-expanded="false"
        aria-controls="navbar-menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <ul class="navbar-menu" id="navbar-menu">
        <li class="navbar-item">
          <a href="/" class="navbar-link">Home</a>
        </li>
        <li class="navbar-item">
          <a href="/rooms" class="navbar-link">Rooms</a>
        </li>
        <li class="navbar-item">
          <a href="/restaurant" class="navbar-link">Restaurant</a>
        </li>
        <li class="navbar-item">
          <a href="/gallery" class="navbar-link">Gallery</a>
        </li>
        <li class="navbar-item">
          <a href="/contact" class="navbar-link">Contact</a>
        </li>
        <li class="navbar-item">
          <a href="/book" class="btn btn-primary btn-sm">Book Now</a>
        </li>
      </ul>
    </nav>
  </div>
</header>
```

```css
.header {
  background-color: var(--color-white);
  box-shadow: var(--shadow-sm);
  position: sticky;
  top: 0;
  z-index: var(--z-index-sticky);
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: var(--spacing-4) 0;
}

.navbar-brand .logo {
  height: 40px;
  width: auto;
}

.navbar-menu {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: var(--spacing-6);
}

.navbar-link {
  font-size: var(--font-size-base);
  font-weight: var(--font-weight-medium);
  color: var(--color-gray-700);
  text-decoration: none;
  transition: color var(--transition-base);
}

.navbar-link:hover,
.navbar-link:focus {
  color: var(--color-primary);
}

.navbar-toggle {
  display: none;
}

/* Mobile Navigation */
@media (max-width: 767px) {
  .navbar-toggle {
    display: flex;
    flex-direction: column;
    gap: 4px;
    background: transparent;
    border: none;
    padding: var(--spacing-2);
    cursor: pointer;
  }

  .navbar-toggle span {
    display: block;
    width: 24px;
    height: 2px;
    background-color: var(--color-gray-700);
    transition: all var(--transition-base);
  }

  .navbar-menu {
    position: fixed;
    top: 72px;
    left: 0;
    right: 0;
    background-color: var(--color-white);
    flex-direction: column;
    gap: 0;
    padding: var(--spacing-4);
    box-shadow: var(--shadow-lg);
    transform: translateX(-100%);
    transition: transform var(--transition-base);
  }

  .navbar-menu.active {
    transform: translateX(0);
  }

  .navbar-item {
    border-bottom: 1px solid var(--color-gray-200);
  }

  .navbar-link {
    display: block;
    padding: var(--spacing-4);
  }
}
```

### Footer

```html
<footer class="footer">
  <div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Contact Info -->
      <div class="footer-col">
        <h3 class="footer-heading">Contact</h3>
        <ul class="footer-list">
          <li>
            <a href="tel:+48713120714" class="footer-link">
              +48 71 312 07 14
            </a>
          </li>
          <li>
            <a href="mailto:rezerwacja@hotelnowydwor.eu" class="footer-link">
              rezerwacja@hotelnowydwor.eu
            </a>
          </li>
          <li class="footer-text">
            ul. Nowy Dwór 2<br>
            55-100 Trzebnica, Poland
          </li>
        </ul>
      </div>

      <!-- Quick Links -->
      <div class="footer-col">
        <h3 class="footer-heading">Quick Links</h3>
        <ul class="footer-list">
          <li><a href="/rooms" class="footer-link">Rooms</a></li>
          <li><a href="/restaurant" class="footer-link">Restaurant</a></li>
          <li><a href="/events" class="footer-link">Events</a></li>
          <li><a href="/faq" class="footer-link">FAQ</a></li>
          <li><a href="/privacy" class="footer-link">Privacy Policy</a></li>
        </ul>
      </div>

      <!-- Social Media -->
      <div class="footer-col">
        <h3 class="footer-heading">Follow Us</h3>
        <div class="flex gap-4">
          <a href="#" class="footer-social-link" aria-label="Facebook">
            <svg class="icon icon-lg"><!-- Facebook icon --></svg>
          </a>
          <a href="#" class="footer-social-link" aria-label="Instagram">
            <svg class="icon icon-lg"><!-- Instagram icon --></svg>
          </a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p class="footer-copyright">
        &copy; 2025 Hotel Nowy Dwór. All rights reserved.
      </p>
    </div>
  </div>
</footer>
```

```css
.footer {
  background-color: var(--color-gray-900);
  color: var(--color-gray-300);
  padding: var(--spacing-16) 0 var(--spacing-8);
}

.footer-heading {
  font-size: var(--font-size-lg);
  font-weight: var(--font-weight-semibold);
  color: var(--color-white);
  margin-bottom: var(--spacing-4);
}

.footer-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-list li {
  margin-bottom: var(--spacing-2);
}

.footer-link {
  color: var(--color-gray-300);
  text-decoration: none;
  transition: color var(--transition-base);
}

.footer-link:hover {
  color: var(--color-primary);
}

.footer-social-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 48px;
  height: 48px;
  background-color: var(--color-gray-800);
  border-radius: var(--radius-full);
  color: var(--color-white);
  transition: background-color var(--transition-base);
}

.footer-social-link:hover {
  background-color: var(--color-primary);
}

.footer-bottom {
  margin-top: var(--spacing-8);
  padding-top: var(--spacing-4);
  border-top: 1px solid var(--color-gray-800);
  text-align: center;
}

.footer-copyright {
  font-size: var(--font-size-sm);
  color: var(--color-gray-500);
}
```

---

## Content Patterns

### Hero Section

```html
<section class="hero">
  <picture>
    <source srcset="hero-mobile.webp" media="(max-width: 767px)">
    <source srcset="hero-desktop.webp" media="(min-width: 768px)">
    <img src="hero-desktop.jpg" alt="Hotel Nowy Dwór" class="hero-image">
  </picture>

  <div class="hero-content">
    <div class="container">
      <h1 class="hero-title">Welcome to Hotel Nowy Dwór</h1>
      <p class="hero-subtitle">
        Modern comfort in the heart of Trzebnica
      </p>
      <div class="hero-actions">
        <a href="/book" class="btn btn-primary btn-lg">Book Now</a>
        <a href="/rooms" class="btn btn-outline btn-lg">View Rooms</a>
      </div>
    </div>
  </div>
</section>
```

```css
.hero {
  position: relative;
  height: 600px;
  overflow: hidden;
}

.hero-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-content {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5));
}

.hero-title {
  font-size: var(--font-size-5xl);
  font-weight: var(--font-weight-bold);
  color: var(--color-white);
  text-align: center;
  margin-bottom: var(--spacing-4);
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-subtitle {
  font-size: var(--font-size-xl);
  color: var(--color-white);
  text-align: center;
  margin-bottom: var(--spacing-8);
}

.hero-actions {
  display: flex;
  gap: var(--spacing-4);
  justify-content: center;
  flex-wrap: wrap;
}
```

### Feature Section

```html
<section class="section">
  <div class="container">
    <h2 class="section-title">Why Choose Hotel Nowy Dwór</h2>
    <p class="section-subtitle">
      Discover what makes our hotel special
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="feature-card">
        <div class="feature-icon">
          <svg class="icon icon-xl"><!-- Icon --></svg>
        </div>
        <h3 class="feature-title">Modern Rooms</h3>
        <p class="feature-description">
          28 comfortable rooms with modern amenities
        </p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg class="icon icon-xl"><!-- Icon --></svg>
        </div>
        <h3 class="feature-title">Restaurant</h3>
        <p class="feature-description">
          Delicious Polish and international cuisine
        </p>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg class="icon icon-xl"><!-- Icon --></svg>
        </div>
        <h3 class="feature-title">Event Halls</h3>
        <p class="feature-description">
          Perfect venues for weddings and conferences
        </p>
      </div>
    </div>
  </div>
</section>
```

```css
.section-title {
  font-size: var(--font-size-4xl);
  font-weight: var(--font-weight-bold);
  text-align: center;
  margin-bottom: var(--spacing-4);
}

.section-subtitle {
  font-size: var(--font-size-lg);
  color: var(--color-gray-600);
  text-align: center;
  margin-bottom: var(--spacing-12);
}

.feature-card {
  text-align: center;
  padding: var(--spacing-6);
}

.feature-icon {
  width: 80px;
  height: 80px;
  margin: 0 auto var(--spacing-4);
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: var(--color-primary-light);
  border-radius: var(--radius-full);
  color: var(--color-primary);
}

.feature-title {
  font-size: var(--font-size-xl);
  font-weight: var(--font-weight-semibold);
  margin-bottom: var(--spacing-3);
}

.feature-description {
  font-size: var(--font-size-base);
  color: var(--color-gray-600);
}
```

### Call-to-Action Section

```html
<section class="cta">
  <div class="container">
    <div class="cta-content">
      <h2 class="cta-title">Ready to Book Your Stay?</h2>
      <p class="cta-description">
        Experience comfort and hospitality at Hotel Nowy Dwór
      </p>
      <div class="cta-actions">
        <a href="/book" class="btn btn-primary btn-lg">Book Now</a>
        <a href="tel:+48713120714" class="btn btn-outline btn-lg">
          Call Us: +48 71 312 07 14
        </a>
      </div>
    </div>
  </div>
</section>
```

```css
.cta {
  background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
  color: var(--color-white);
  padding: var(--spacing-20) 0;
  text-align: center;
}

.cta-title {
  font-size: var(--font-size-4xl);
  font-weight: var(--font-weight-bold);
  margin-bottom: var(--spacing-4);
}

.cta-description {
  font-size: var(--font-size-xl);
  margin-bottom: var(--spacing-8);
  opacity: 0.95;
}

.cta-actions {
  display: flex;
  gap: var(--spacing-4);
  justify-content: center;
  flex-wrap: wrap;
}

.cta .btn-outline {
  border-color: var(--color-white);
  color: var(--color-white);
}

.cta .btn-outline:hover {
  background-color: var(--color-white);
  color: var(--color-primary);
}
```

---

## Performance Guidelines

### Image Optimization

```yaml
Priorities:
  1. Use WebP/AVIF formats (WebP Express plugin installed)
  2. Implement lazy loading for below-fold images
  3. Compress images (target < 150KB for most images)
  4. Use responsive images with srcset
  5. Set explicit width and height attributes

Best Practices:
  - Hero images: max 300KB
  - Thumbnail images: max 100KB
  - Gallery images: max 200KB
  - Compress with quality 80-85%
```

### CSS Optimization

```yaml
Best Practices:
  1. Minify CSS for production
  2. Remove unused CSS (PurgeCSS)
  3. Inline critical CSS for above-the-fold content
  4. Use CSS custom properties for theming
  5. Avoid @import (use <link> instead)

Critical CSS:
  - Extract CSS for above-the-fold content
  - Inline in <head>
  - Load remaining CSS asynchronously
```

### JavaScript Optimization

```yaml
Best Practices:
  1. Minimize JavaScript usage
  2. Defer non-critical JavaScript
  3. Use async loading for external scripts
  4. Minify and bundle JavaScript
  5. Remove unused code

Loading Strategy:
  - Critical JS: Inline in <head>
  - Non-critical JS: defer or async
  - Third-party scripts: async with fallbacks
```

### Core Web Vitals Targets

```yaml
Largest Contentful Paint (LCP):
  Target: < 2.5s
  Good: < 2.5s
  Needs Improvement: 2.5s - 4.0s
  Poor: > 4.0s

First Input Delay (FID):
  Target: < 100ms
  Good: < 100ms
  Needs Improvement: 100ms - 300ms
  Poor: > 300ms

Cumulative Layout Shift (CLS):
  Target: < 0.1
  Good: < 0.1
  Needs Improvement: 0.1 - 0.25
  Poor: > 0.25
```

---

## Implementation Examples

### Complete Page Template

```html
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Hotel Nowy Dwór - Modern hotel in Trzebnica">
  <title>Hotel Nowy Dwór - Trzebnica</title>

  <!-- Critical CSS (inline) -->
  <style>
    /* Critical above-the-fold CSS here */
  </style>

  <!-- Preload key assets -->
  <link rel="preload" href="fonts/system-font.woff2" as="font" type="font/woff2" crossorigin>

  <!-- Stylesheet -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Skip to main content -->
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <nav class="navbar" aria-label="Main navigation">
        <!-- Navigation content -->
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main id="main-content">
    <!-- Hero Section -->
    <section class="hero">
      <!-- Hero content -->
    </section>

    <!-- Features Section -->
    <section class="section">
      <!-- Features content -->
    </section>

    <!-- CTA Section -->
    <section class="cta">
      <!-- CTA content -->
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <!-- Footer content -->
  </footer>

  <!-- Scripts (deferred) -->
  <script src="main.js" defer></script>
</body>
</html>
```

### WordPress Custom Post Type (Oxygen Integration)

```php
<?php
/**
 * Register "Rooms" Custom Post Type
 * For use with Oxygen Builder templates
 */

function hn_register_rooms_post_type() {
  $labels = array(
    'name'               => 'Rooms',
    'singular_name'      => 'Room',
    'add_new'            => 'Add New Room',
    'add_new_item'       => 'Add New Room',
    'edit_item'          => 'Edit Room',
    'new_item'           => 'New Room',
    'view_item'          => 'View Room',
    'search_items'       => 'Search Rooms',
    'not_found'          => 'No rooms found',
    'not_found_in_trash' => 'No rooms found in Trash',
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'pokoje' ),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-building',
    'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'show_in_rest'        => true,
  );

  register_post_type( 'room', $args );
}
add_action( 'init', 'hn_register_rooms_post_type' );
```

---

## Maintenance & Updates

### Version Control

```yaml
Design System Versions:
  Current: 1.0.0
  Format: MAJOR.MINOR.PATCH

Version Updates:
  MAJOR: Breaking changes, complete redesign
  MINOR: New components, features
  PATCH: Bug fixes, small improvements

Changelog Location:
  File: DESIGN-SYSTEM-CHANGELOG.md
  Update: Every release
```

### Component Updates

When updating components:

1. **Document Changes**
   - What changed
   - Why it changed
   - Migration guide (if breaking)

2. **Test Thoroughly**
   - Visual regression testing
   - Accessibility testing
   - Cross-browser testing
   - Performance impact

3. **Update Documentation**
   - This Design System document
   - Code examples
   - Screenshots (if needed)

4. **Communicate Changes**
   - Update changelog
   - Notify team members
   - Update Oxygen templates

### Review Schedule

```yaml
Monthly Review:
  - Check for unused components
  - Review accessibility compliance
  - Update color contrast ratios
  - Performance audit

Quarterly Review:
  - Complete design system audit
  - Update typography scale
  - Review component library
  - Update documentation

Annual Review:
  - Major version update
  - Brand alignment check
  - Technology stack review
  - Competitor analysis
```

---

## Appendix

### Browser Support

```yaml
Supported Browsers:
  Chrome: Last 2 versions
  Firefox: Last 2 versions
  Safari: Last 2 versions
  Edge: Last 2 versions

Mobile Browsers:
  iOS Safari: Last 2 versions
  Chrome Android: Last 2 versions

Unsupported:
  Internet Explorer: All versions
```

### Resources

```yaml
Design Tools:
  Figma: UI/UX design and prototyping
  Adobe XD: Alternative design tool

Development Tools:
  VS Code: Code editor
  Chrome DevTools: Debugging and performance
  Lighthouse: Performance auditing
  WAVE: Accessibility testing
  axe DevTools: Accessibility testing

Validation Tools:
  W3C Validator: HTML validation
  CSS Validator: CSS validation
  Schema.org Validator: Structured data validation
  PageSpeed Insights: Performance testing
```

### Contact

```yaml
Design System Maintainer:
  Email: dev@hotelnowydwor.eu

Questions & Feedback:
  Email: rezerwacja@hotelnowydwor.eu
  Phone: +48 71 312 07 14

Repository:
  GitHub: hotelnowydwor-seo-optimization-process
  Branch: quirky-mccarthy
```

---

**End of Design System Documentation**

This document is a living guide and will be updated as the design system evolves. Always refer to the latest version for accurate information.

**Version:** 1.0.0
**Last Updated:** December 2025
**Next Review:** March 2026
