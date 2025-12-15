# Contributing Guidelines

## Hotel Nowy Dwór - SEO Optimization Project

Thank you for contributing to the Hotel Nowy Dwór SEO optimization project! This guide will help you understand our workflow, standards, and best practices.

---

## Table of Contents

1. [Getting Started](#getting-started)
2. [Development Setup](#development-setup)
3. [Code Standards](#code-standards)
4. [Git Workflow](#git-workflow)
5. [Making Changes](#making-changes)
6. [Testing Requirements](#testing-requirements)
7. [Pull Request Process](#pull-request-process)
8. [SEO Optimization Guidelines](#seo-optimization-guidelines)
9. [Performance Guidelines](#performance-guidelines)
10. [Accessibility Guidelines](#accessibility-guidelines)
11. [Documentation](#documentation)
12. [Getting Help](#getting-help)

---

## Getting Started

### Project Overview

This is a WordPress-based SEO optimization project for Hotel Nowy Dwór (https://www.hotelnowydwor.eu/). Our primary goals are:

1. **Google Rankings:** Achieve top 3 positions for primary keywords
2. **PageSpeed Score:** Minimum 90 points (mobile and desktop)
3. **UI/UX:** Enhanced user experience and interface design
4. **SEO Content:** Increased keyword saturation and topical relevance
5. **Testing:** Comprehensive validation before production deployment

### Technology Stack

- **CMS:** WordPress (PHP >=7.4)
- **Page Builder:** Oxygen Builder with Erropix extensions
- **Custom Fields:** Advanced Custom Fields Pro
- **Image Optimization:** WebP Express
- **Key Plugins:** OxyExtras, WP Speed of Light, Contact Form 7

### Current Status

- **Branch:** `main`
- **SEO Score:** 55/100 (target: 90/100)
- **PageSpeed:** 55/100 (target: 90/100)
- **Phase:** Security & Performance (Weeks 1-4)

---

## Development Setup

### Prerequisites

- **PHP:** Version 7.4 or higher
- **Composer:** For PHP dependency management
- **Git:** Version control
- **Text Editor:** VS Code, PHPStorm, or similar with EditorConfig support
- **Local WordPress Environment:** XAMPP, MAMP, Local by Flywheel, or similar

### Installation Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-org/hotelnowydwor-seo-optimization-process.git
   cd hotelnowydwor-seo-optimization-process
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Set up WordPress locally:**
   - Copy the `src/` directory to your local WordPress installation
   - Import the database: `src/nowydwor_hotelnowydworeunew.sql`
   - Update `wp-config.php` with your local database credentials

4. **Configure your editor:**
   - Ensure EditorConfig plugin is installed
   - Settings will be applied automatically from `.editorconfig`

---

## Code Standards

### PHP Standards

We follow **WordPress Coding Standards** (WPCS) strictly.

#### Formatting

- **Indentation:** 4 spaces (no tabs)
- **Line Endings:** LF (Unix-style)
- **Encoding:** UTF-8
- **Final Newline:** Always end files with a newline

#### Before Committing

Always run code quality checks:

```bash
# Check for coding standard violations
composer lint

# Auto-fix violations (when possible)
composer fix
```

#### PHP Best Practices

```php
// ✅ GOOD: Sanitize inputs
$user_input = sanitize_text_field( $_POST['field_name'] );

// ✅ GOOD: Escape outputs
echo esc_html( $user_input );
echo esc_url( $url );
echo esc_attr( $attribute );

// ✅ GOOD: Use nonces for forms
wp_nonce_field( 'my_action_name', 'my_nonce_field' );

// ✅ GOOD: Verify nonces
if ( ! wp_verify_nonce( $_POST['my_nonce_field'], 'my_action_name' ) ) {
    die( 'Security check failed' );
}

// ✅ GOOD: Check capabilities
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Unauthorized' );
}

// ✅ GOOD: Use prepared statements
$wpdb->prepare( "SELECT * FROM {$wpdb->posts} WHERE ID = %d", $id );

// ❌ BAD: Never use unsanitized data
echo $_POST['field_name']; // NEVER DO THIS!
```

### Web Files (HTML, CSS, JS, JSON, YAML, Markdown)

- **Indentation:** 2 spaces
- **Line Endings:** LF
- **Encoding:** UTF-8

### CSS/SCSS Standards

We use **BEM (Block Element Modifier)** methodology:

```css
/* ✅ GOOD: BEM naming */
.hotel-card { }
.hotel-card__title { }
.hotel-card__title--highlighted { }

/* ✅ GOOD: Use CSS custom properties */
.button {
  background-color: var(--color-primary);
  color: var(--color-white);
}

/* ❌ BAD: Avoid !important */
.button {
  color: red !important; /* Avoid this */
}
```

### JavaScript Standards

```javascript
// ✅ GOOD: Use modern ES6+ syntax
const hotelData = {
  name: 'Hotel Nowy Dwór',
  rooms: 28
};

// ✅ GOOD: Use async/await
async function fetchHotelData() {
  try {
    const response = await fetch('/api/hotel');
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error:', error);
  }
}

// ✅ GOOD: Add error handling
if (!element) {
  console.error('Element not found');
  return;
}
```

---

## Git Workflow

### Branch Naming Convention

Use descriptive branch names with category prefixes:

```
seo/meta-tags-optimization
performance/image-webp-conversion
accessibility/aria-labels
security/https-enforcement
content/faq-expansion
fix/broken-links-homepage
```

### Commit Message Format

Follow this structure for clear, searchable commit history:

```
[PHASE] Category: Brief description

Detailed explanation of changes made.

- Specific change 1
- Specific change 2
- Performance impact: PageSpeed improved from X to Y
- SEO impact: Meta tags added to Z pages

Testing completed:
- PageSpeed Insights: 92/100
- Accessibility: WCAG 2.1 AA compliant
- Mobile-friendly: Passed
```

**Example:**

```
[PHASE 1] Performance: Implement WebP image conversion

Configured WebP Express plugin to auto-convert all images.

- Enabled WebP conversion for JPEG and PNG
- Configured AVIF fallback for modern browsers
- Added .htaccess rules for content negotiation
- Performance impact: PageSpeed improved from 55 to 78
- LCP improved by 1.2s

Testing completed:
- PageSpeed Insights: 78/100 (from 55/100)
- Image sizes reduced by average 65%
- All browsers tested (Chrome, Firefox, Safari, Edge)
```

---

## Making Changes

### Before You Start

1. **Check existing issues** to avoid duplicate work
2. **Create or assign an issue** for your task
3. **Pull latest changes** from main branch
4. **Create a new branch** from main

```bash
git checkout main
git pull origin main
git checkout -b seo/your-feature-name
```

### Critical Files (Do Not Modify Directly)

⚠️ **NEVER modify these files:**

- `src/wp-config.php` - Database credentials and WordPress constants
- `src/wp-includes/**` - WordPress core files
- `src/wp-admin/**` - WordPress admin core
- Plugin vendor directories
- `src/nowydwor_hotelnowydworeunew.sql` - Database backup

### Safe to Modify

✅ **Safe to edit:**

- `src/wp-content/themes/**` - Theme customizations (use child theme)
- `src/wp-content/plugins/custom-plugins/**` - Custom plugin development
- `src/.htaccess` - Server configuration (with caution)
- Documentation files in `docs/**`
- Configuration files (`.editorconfig`, `composer.json`)

---

## Testing Requirements

### Before Submitting PR

All changes must pass these validations:

#### 1. Code Quality

```bash
# PHP standards check
composer lint

# Auto-fix PHP violations
composer fix
```

#### 2. Performance Testing

- [ ] **PageSpeed Insights:** Score ≥90 (mobile and desktop)
- [ ] **Lighthouse:** Performance score ≥90
- [ ] **Core Web Vitals:**
  - LCP (Largest Contentful Paint): <2.5s
  - FID (First Input Delay): <100ms
  - CLS (Cumulative Layout Shift): <0.1

**Tools:**
- https://pagespeed.web.dev/
- Chrome DevTools → Lighthouse

#### 3. SEO Validation

- [ ] **Schema.org:** Validate at https://validator.schema.org/
- [ ] **Meta tags:** Complete and optimized
- [ ] **Heading hierarchy:** Proper H1-H6 structure
- [ ] **Image alt text:** All images have descriptive alt attributes
- [ ] **Internal links:** No broken links

**Tools:**
- https://validator.schema.org/
- https://validator.w3.org/

#### 4. Accessibility Testing

- [ ] **WCAG 2.1 AA compliance**
- [ ] **Color contrast:** Minimum 4.5:1 ratio
- [ ] **Keyboard navigation:** All interactive elements accessible
- [ ] **ARIA labels:** Present where needed
- [ ] **Screen reader:** Test with NVDA or JAWS

**Tools:**
- https://wave.webaim.org/
- axe DevTools browser extension
- Lighthouse Accessibility audit

#### 5. Security Testing

- [ ] **HTTPS:** All assets loaded securely
- [ ] **Security headers:** Check at https://securityheaders.com/
- [ ] **SSL certificate:** A+ rating at https://www.ssllabs.com/ssltest/
- [ ] **WordPress security:** No exposed sensitive files

#### 6. Mobile & Cross-Browser Testing

- [ ] **Mobile-friendly:** https://search.google.com/test/mobile-friendly
- [ ] **Responsive design:** Test on multiple screen sizes
- [ ] **Touch targets:** Minimum 48x48px
- [ ] **Browsers tested:**
  - Chrome (latest)
  - Firefox (latest)
  - Safari (latest)
  - Edge (latest)

---

## Pull Request Process

### Creating a Pull Request

1. **Push your branch:**
   ```bash
   git push origin your-branch-name
   ```

2. **Open PR on GitHub** with this template:

````markdown
## Description

Brief description of what this PR accomplishes.

## Changes Made

- Change 1
- Change 2
- Change 3

## SEO Impact

- Meta tags optimized on X pages
- Schema.org structured data added for Y
- PageSpeed score improved from X to Y

## Testing Completed

- [ ] PageSpeed Insights: XX/100 (mobile), XX/100 (desktop)
- [ ] Lighthouse: XX/100 performance
- [ ] WCAG 2.1 AA: Compliant
- [ ] Mobile-friendly: Passed
- [ ] Security headers: A+ rating
- [ ] Cross-browser: Chrome, Firefox, Safari, Edge tested

## Screenshots

### Before
[Add screenshot]

### After
[Add screenshot]

## Related Issues

Closes #XX
Related to #XX

## Checklist

- [ ] Code follows WordPress Coding Standards
- [ ] `composer lint` passes
- [ ] No console errors or warnings
- [ ] Documentation updated (if needed)
- [ ] Tested on mobile devices
- [ ] Tested in all major browsers
- [ ] No broken links
- [ ] Images optimized (WebP)
- [ ] Accessibility verified (WAVE)
````

### Code Review Process

1. **Automatic checks** run via GitHub Actions
2. **Manual review** by project maintainers
3. **Address feedback** if any changes requested
4. **Approval required** before merge
5. **Squash and merge** to keep history clean

---

## SEO Optimization Guidelines

### Meta Tags Best Practices

```html
<!-- ✅ GOOD: Descriptive, keyword-rich title -->
<title>Hotel Nowy Dwór Trzebnica - 28 Pokoi, Restauracja, Sale Weselne</title>

<!-- ✅ GOOD: Compelling meta description (150-160 characters) -->
<meta name="description" content="Hotel Nowy Dwór w Trzebnicy oferuje 28 komfortowych pokoi, restaurację oraz sale na wesela i imprezy. 15 km od Wrocławia. Rezerwuj teraz!">

<!-- ✅ GOOD: Open Graph tags -->
<meta property="og:title" content="Hotel Nowy Dwór Trzebnica">
<meta property="og:description" content="28-pokojowy hotel w Trzebnicy...">
<meta property="og:image" content="https://www.hotelnowydwor.eu/og-image.jpg">
```

### Schema.org Structured Data

Always implement structured data for:

- **Hotel:** Name, address, phone, amenities
- **LocalBusiness:** Business hours, location
- **BreadcrumbList:** Navigation breadcrumbs
- **FAQPage:** FAQ sections
- **MenuItem:** Restaurant menu items

```json
{
  "@context": "https://schema.org",
  "@type": "Hotel",
  "name": "Hotel Nowy Dwór",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Nowy Dwór 2",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressCountry": "PL"
  },
  "telephone": "+48713120714",
  "email": "rezerwacja@hotelnowydwor.eu",
  "numberOfRooms": "28"
}
```

### Heading Hierarchy

```html
<!-- ✅ GOOD: Proper hierarchy -->
<h1>Hotel Nowy Dwór - Trzebnica</h1>
  <h2>Nasze Pokoje</h2>
    <h3>Pokój Standard</h3>
    <h3>Pokój Komfort</h3>
  <h2>Restauracja</h2>
    <h3>Menu</h3>

<!-- ❌ BAD: Skipping levels -->
<h1>Tytuł</h1>
<h3>Podtytuł</h3> <!-- Missing H2 -->
```

### Image Optimization

```html
<!-- ✅ GOOD: Optimized image with alt text -->
<img src="hotel-room-webp.webp"
     alt="Przestronny pokój hotelowy z dwuosobowym łóżkiem i widokiem na ogród"
     width="800"
     height="600"
     loading="lazy">

<!-- ❌ BAD: Missing alt, not optimized -->
<img src="hotel-room.jpg">
```

---

## Performance Guidelines

### Image Optimization Rules

1. **Format:** Use WebP or AVIF (fallback to JPEG/PNG)
2. **Compression:** Maximum 85% quality for photos
3. **Lazy Loading:** Enable for below-fold images
4. **Responsive:** Use `srcset` and `sizes` attributes
5. **Dimensions:** Always specify `width` and `height`

### Caching Strategy

```apache
# Browser caching in .htaccess
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/jpg "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### CSS/JS Optimization

- **Minify** CSS and JavaScript files
- **Combine** files where possible (reduce HTTP requests)
- **Critical CSS:** Inline above-the-fold CSS
- **Defer non-critical JS:** Use `defer` or `async` attributes
- **Remove unused code:** Regularly audit and clean up

---

## Accessibility Guidelines

### WCAG 2.1 AA Compliance

All changes must meet these requirements:

#### Color Contrast

```css
/* ✅ GOOD: Contrast ratio ≥ 4.5:1 for normal text */
.text {
  color: #000000; /* Black */
  background-color: #ffffff; /* White */
  /* Ratio: 21:1 ✓ */
}

/* ❌ BAD: Insufficient contrast */
.text {
  color: #999999; /* Light gray */
  background-color: #ffffff; /* White */
  /* Ratio: 2.8:1 ✗ */
}
```

#### ARIA Labels

```html
<!-- ✅ GOOD: ARIA label for icon button -->
<button aria-label="Zamknij okno dialogowe">
  <svg><!-- X icon --></svg>
</button>

<!-- ✅ GOOD: ARIA label for navigation -->
<nav aria-label="Nawigacja główna">
  <!-- Menu items -->
</nav>

<!-- ❌ BAD: Missing label -->
<button>
  <svg><!-- Icon only, no text --></svg>
</button>
```

#### Keyboard Navigation

```html
<!-- ✅ GOOD: Focusable interactive elements -->
<button class="cta-button" tabindex="0">
  Zarezerwuj Pokój
</button>

<!-- ✅ GOOD: Skip link for keyboard users -->
<a href="#main-content" class="skip-link">
  Przejdź do treści głównej
</a>
```

---

## Documentation

### When to Update Documentation

Update documentation whenever you:

- Add new features or functionality
- Change configuration or setup process
- Modify WordPress plugins or themes
- Update SEO strategies or content guidelines
- Fix bugs that affect user experience

### Documentation Files

- **CLAUDE.md** - Project instructions for AI assistants
- **README.md** - Project overview and quick start
- **docs/audyt-seo-hotel-nowy-dwor-claude.md** - SEO audit report
- **docs/DESIGN-SYSTEM.md** - Design system and UI components
- **docs/SEO-STRATEGY.md** - Comprehensive SEO strategy
- **docs/CONTRIBUTING.md** - This file

---

## Getting Help

### Resources

- **Documentation:** Check `docs/` directory first
- **SEO Audit:** `docs/audyt-seo-hotel-nowy-dwor-claude.md`
- **Design System:** `docs/DESIGN-SYSTEM.md`
- **WordPress Codex:** https://codex.wordpress.org/
- **Oxygen Builder Docs:** https://oxygenbuilder.com/documentation/

### Communication

- **Issues:** Use GitHub Issues for bugs and feature requests
- **Discussions:** Use GitHub Discussions for questions
- **Email:** Contact project maintainers at biuro@pbmedia.pl

### Issue Templates

When creating issues, use our templates:

- **Bug Report:** For reporting bugs
- **SEO Task:** For SEO-related tasks
- **Performance Issue:** For performance problems

---

## Additional Notes

### WordPress + Oxygen Builder Specifics

- **No Traditional Theme Files:** Pages built with Oxygen visual builder
- **ACF Integration:** Custom fields integrate directly into Oxygen templates
- **Reusable Components:** Use Oxygen's component system
- **Custom Code:** Add via Oxygen Code Block or custom plugin

### PB MEDIA Standards

This project follows **PB MEDIA WordPress Security Standards**:

- Always sanitize user inputs
- Always escape outputs
- Use nonces for form submissions
- Check user capabilities
- Use prepared statements for database queries
- Keep plugins and WordPress core updated
- Enforce HTTPS on all assets
- Implement security headers

---

## Thank You!

Your contributions help improve Hotel Nowy Dwór's online presence and SEO performance. Every optimization, bug fix, and content improvement makes a difference!

**Questions?** Open an issue or contact the maintainers.

**Happy coding!** 🚀
