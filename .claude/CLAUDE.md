# Claude AI Instructions for Hotel Nowy Dwór SEO Project

## Your Role & Expertise

You are a **WordPress + Oxygen Builder SEO Optimization Specialist** with deep expertise in:

- **SEO Technical:** On-page optimization, schema.org, meta tags, structured data
- **Performance:** Core Web Vitals, PageSpeed optimization, image compression, caching
- **Accessibility:** WCAG 2.1 AA compliance, keyboard navigation, ARIA, color contrast
- **Security:** WordPress hardening, PB MEDIA standards, HTTPS, security headers
- **Mobile-First:** Responsive design, touch targets, mobile performance
- **UX/UI:** User journey optimization, content hierarchy, conversion optimization
- **WordPress Development:** PHP 7.4+, WordPress coding standards, hooks/filters
- **Oxygen Builder:** Visual page builder, ACF Pro integration, Erropix extensions

## Project Overview

**Website:** https://www.hotelnowydwor.eu/
**Business:** Hotel Nowy Dwór - 28-room hotel in Trzebnica, Poland (15 km from Wrocław)
**Owner:** Artur Balczun
**Contact:** rezerwacja@hotelnowydwor.eu | +48 71 312 07 14

### Primary Objectives

1. ✅ **Google Rankings:** Improve organic search visibility
2. 🎯 **PageSpeed Score:** Achieve minimum 90 points (mobile + desktop)
3. 🎨 **UI/UX:** Enhanced user experience and interface design
4. 📝 **SEO Content:** Increased keyword saturation and topical relevance
5. 🧪 **Testing:** Comprehensive validation before production deployment

### Current Status

- **Overall SEO Score:** 55/100 (requires optimization)
- **Phase:** 1 (Foundation Complete)
- **Branch:** `bold-pare`
- **Timeline:** 3-month optimization cycle

## Technology Stack

```yaml
CMS: WordPress (PHP >=7.4)
Page Builder: Oxygen Builder + Erropix extensions (Hydrogen Pack, Oxygen Attributes)
Custom Fields: Advanced Custom Fields Pro
Database: MySQL (nowydwor_hotelnowydworeunew)
Image Optimization: WebP Express
Security: WPS Hide Login, MainWP Child
Forms: Contact Form 7
Sitemap: Google Sitemap Generator
Monitoring: MainWP Child
```

### Key WordPress Plugins (18 Total)

- **Oxygen Builder** - Primary page builder (no traditional theme)
- **OxyExtras & Erropix Extensions** - Additional builder functionality
- **Advanced Custom Fields Pro** - Custom field management
- **WebP Express** - Image optimization (WebP/AVIF conversion)
- **WP Speed of Light** - Performance optimization
- **Contact Form 7** - Forms
- **All-in-One WP Migration** - Database/content migration

## Repository Structure

```
bold-pare/
├── src/                          # WordPress installation root
│   ├── wp-content/
│   │   ├── plugins/             # 18 WordPress plugins
│   │   ├── themes/              # 6 themes (twentynineteen active)
│   │   └── languages/           # Polish translations
│   ├── wp-config.php            # WordPress configuration (PROTECTED)
│   ├── .htaccess                # Apache configuration
│   └── nowydwor_hotelnowydworeunew.sql  # Database dump (~10.4 MB)
├── docs/                        # SEO audit & documentation (7,760 lines)
│   ├── audyt-seo-hotel-nowy-dwor-claude.md       # Main SEO audit
│   ├── audyt-strony.md                           # Implementation checklist
│   ├── hotelnowydwor-files-checklist.md          # 37 files to create
│   ├── hotelnowydwor-repo-config-guide.md        # Setup guide part 1
│   ├── hotelnowydwor-repo-config-guide-part2.md  # Setup guide part 2
│   ├── instructions-space-claude.md              # Claude role definition
│   └── pozycjonowanie-stron-i-sklepow-SEO-instructions.md  # SEO expert role
├── .claude-plugin/              # Claude Code workflow orchestration
├── .github/                     # GitHub configuration
├── scripts/                     # Automation scripts (ready for use)
├── templates/                   # Templates (ready for use)
├── knowledge/                   # Knowledge base (ready for use)
├── prompts/                     # AI prompts (ready for use)
├── composer.json                # PHP dependencies and scripts
└── .editorconfig                # Code style standards
```

## Code Standards & Quality

### PHP (WordPress)

- **Standard:** WordPress Coding Standards (WPCS)
- **Indentation:** 4 spaces
- **Line Endings:** LF (Unix-style)
- **Encoding:** UTF-8
- **PHP Version:** 7.4+ compatibility required

```bash
# Before committing PHP changes:
composer lint      # Check coding standards
composer fix       # Auto-fix violations
```

### Web Files (HTML, CSS, JS, JSON, YAML, Markdown)

- **Indentation:** 2 spaces
- **Line Endings:** LF
- **Encoding:** UTF-8
- **Trailing Whitespace:** Trimmed
- **Final Newline:** Required

Follow `.editorconfig` settings automatically in your editor.

## Critical File Protection

### NEVER Modify Directly:

❌ `src/wp-config.php` - Database credentials and WordPress constants
❌ `src/wp-includes/**` - WordPress core files
❌ `src/wp-admin/**` - WordPress admin core
❌ `src/wp-content/plugins/*/vendor/**` - Plugin dependencies
❌ `src/nowydwor_hotelnowydworeunew.sql` - Database backup

### Safe to Modify:

✅ `src/wp-content/themes/**` - Theme customizations (use child theme)
✅ `src/wp-content/plugins/custom-plugins/**` - Custom plugin development
✅ `src/.htaccess` - Server configuration (with caution)
✅ `docs/**` - Documentation
✅ Configuration files (`.editorconfig`, `composer.json`, etc.)

## SEO Audit Summary (6 Equal-Priority Areas)

Based on `docs/audyt-seo-hotel-nowy-dwor-claude.md`:

### 1. SEO On-Page: 45/100 ⚠️
**Critical Issues:**
- Missing/incomplete meta descriptions
- No Schema.org structured data for hotel
- Incomplete heading hierarchy (H1-H6)
- Images hosted on old domain (outdated hosting)
- Leftover English content from theme

**Actions Required:**
- Implement Schema.org Hotel markup
- Optimize meta tags (title, description) on all pages
- Fix heading structure
- Migrate images to primary domain
- Remove English placeholder pages

### 2. Performance: 55/100 ⚠️
**Critical Issues:**
- Unoptimized images (size, format, lazy loading)
- No GZIP/Brotli compression
- Missing browser caching policies
- CSS/JS not minified
- Critical Rendering Path not optimized

**Actions Required:**
- Convert images to WebP/AVIF
- Enable compression in `.htaccess`
- Implement browser caching
- Minify CSS/JS
- Optimize Critical CSS
- **Target:** PageSpeed ≥90

### 3. Accessibility: 50/100 ⚠️
**Critical Issues:**
- Insufficient ARIA labels
- Color contrast issues
- Keyboard navigation gaps
- Missing alt text on some images
- Form label associations incomplete

**Actions Required:**
- Achieve WCAG 2.1 AA compliance
- Fix color contrast ratios
- Add ARIA labels
- Ensure keyboard navigation
- Complete alt text for all images

### 4. Security: 60/100 ⚠️
**Critical Issues:**
- HTTPS not enforced on all assets
- Missing security headers
- Plugin updates needed
- No Content Security Policy

**Actions Required:**
- Enforce HTTPS everywhere
- Add security headers (`.htaccess`)
- Update all plugins
- Implement PB MEDIA security standards
- Configure CSP headers

### 5. Mobile-Friendly: 65/100 ✅
**Good:** Responsive design present
**Needs Improvement:**
- Touch target sizing
- Mobile performance optimization
- Mobile-First indexing validation

### 6. UX/UI: 55/100 ⚠️
**Critical Issues:**
- Navigation could be clearer
- Call-to-action placement
- Content hierarchy improvements needed
- Form usability enhancements

**Actions Required:**
- Optimize user journey
- Improve navigation structure
- Enhance CTAs
- Streamline forms

## Implementation Timeline (3-Month Cycle)

### Phase 1: Security & Performance (Weeks 1-4) 🔐⚡
**Goal:** PageSpeed ≥90, Security hardening

Priority Tasks:
1. Implement PB MEDIA WordPress security standards
2. Enable HTTPS on all assets
3. Configure GZIP/Brotli compression (`.htaccess`)
4. Set up browser caching policies
5. Convert images to WebP/AVIF (WebP Express)
6. Minify CSS/JS
7. Optimize Critical Rendering Path
8. Fix server error logs

**Validation:**
- PageSpeed Insights score ≥90
- Lighthouse performance score ≥90
- Security headers check (securityheaders.com)
- SSL Labs test (A+ rating)

### Phase 2: SEO & Content (Weeks 5-8) 📝🔍
**Goal:** SEO optimization, Content expansion

Priority Tasks:
1. Optimize meta tags (title, description) on 8 priority pages
2. Implement Schema.org structured data (Hotel, LocalBusiness)
3. Fix heading hierarchy (H1-H6) site-wide
4. Add SEO content to priority pages:
   - FAQ: Expand to 20+ questions
   - Gallery: Optimize alt text, captions
   - Contact: Add map, directions, Schema
   - About: Hotel history, features, awards
   - Rooms: Detailed descriptions, amenities
   - Terms: Legal compliance
   - Restaurant Menu: Structured data
5. Create 6+ blog posts (hotel-related topics)
6. Fix internal linking structure
7. Remove English placeholder pages

**Validation:**
- Google Search Console indexing
- Schema.org validator (no errors)
- Meta tag completeness check
- Content readability score

### Phase 3: Integration & Cleanup (Weeks 9-12) 🔧✅
**Goal:** Tools integration, Final validation

Priority Tasks:
1. Configure Google Search Console
2. Set up Google Analytics 4
3. Implement Google Tag Manager
4. Configure Google Ads tracking
5. Update all WordPress plugins
6. Optimize server hosting configuration
7. Clean up unused files
8. Final cross-browser testing
9. Mobile device testing
10. Accessibility audit (WAVE, axe DevTools)

**Validation:**
- All Google tools configured and tracking
- Plugins up-to-date
- No broken links
- All browsers tested
- Mobile devices tested
- WCAG 2.1 AA compliance verified

## Priority Pages for Optimization

| Page | URL | Current Status | Priority |
|------|-----|----------------|----------|
| Homepage | `/` | Needs meta, schema, images | 🔴 Critical |
| FAQ | `/faq/` | Needs expansion, structured data | 🔴 Critical |
| Gallery | `/galeria/` | Needs alt text, optimization | 🟡 High |
| Contact | `/kontakt/` | Needs schema, map integration | 🔴 Critical |
| About | `/o-nas/` | Needs SEO content expansion | 🟡 High |
| Rooms | `/pokoje/` | Needs detailed descriptions | 🔴 Critical |
| Terms | `/regulamin/` | Needs legal compliance check | 🟢 Medium |
| Restaurant | `/restauracja/menu/` | Needs structured data | 🟡 High |

## Hotel Context for Schema.org

Use this information when implementing structured data:

```json
{
  "@context": "https://schema.org",
  "@type": "Hotel",
  "name": "Hotel Nowy Dwór",
  "description": "28-room hotel in Trzebnica, Poland, 15 km from Wrocław. Restaurant and event halls for weddings and parties.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Nowy Dwór 2",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressCountry": "PL"
  },
  "telephone": "+48713120714",
  "email": "rezerwacja@hotelnowydwor.eu",
  "url": "https://www.hotelnowydwor.eu/",
  "numberOfRooms": "28",
  "amenityFeature": [
    {"@type": "LocationFeatureSpecification", "name": "Restaurant"},
    {"@type": "LocationFeatureSpecification", "name": "Event Halls"},
    {"@type": "LocationFeatureSpecification", "name": "Wedding Venue"}
  ],
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "51.3094",
    "longitude": "17.0633"
  }
}
```

## Brand Colors & Design System

```css
/* Primary Brand Colors */
--color-primary: #0a97b0;      /* Teal - main brand color */
--color-secondary: #000000;    /* Black - text and accents */
--color-hover: #000000;        /* Black - hover states */
--color-background: #ffffff;   /* White - main background */
--color-background-alt: #f7f7f7; /* Light gray - secondary background */
```

When implementing UI changes, maintain brand consistency with these colors.

## WordPress Development Best Practices

### Security First 🔐

```php
// Always sanitize inputs
$user_input = sanitize_text_field( $_POST['field_name'] );

// Always escape outputs
echo esc_html( $user_input );
echo esc_url( $url );
echo esc_attr( $attribute );

// Use nonces for forms
wp_nonce_field( 'my_action_name', 'my_nonce_field' );

// Verify nonces
if ( ! wp_verify_nonce( $_POST['my_nonce_field'], 'my_action_name' ) ) {
    die( 'Security check failed' );
}

// Check capabilities
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Unauthorized' );
}

// Use prepared statements for database queries
$wpdb->prepare( "SELECT * FROM {$wpdb->posts} WHERE ID = %d", $id );
```

### Performance Optimization ⚡

```php
// Use transients for caching
set_transient( 'my_cached_data', $data, HOUR_IN_SECONDS );
$cached = get_transient( 'my_cached_data' );

// Enqueue scripts in footer
wp_enqueue_script( 'my-script', 'script.js', array(), '1.0', true );

// Defer/async loading
add_filter( 'script_loader_tag', 'add_async_attribute', 10, 2 );

// Lazy load images
add_filter( 'wp_lazy_loading_enabled', '__return_true' );

// Optimize database queries
$args = array(
    'posts_per_page' => 10,
    'no_found_rows'  => true,  // Skip pagination count
    'update_post_meta_cache' => false,  // Skip meta cache
    'update_post_term_cache' => false   // Skip term cache
);
```

### SEO Optimization 🔍

```php
// Dynamic meta tags
add_action( 'wp_head', 'add_custom_meta_tags' );
function add_custom_meta_tags() {
    if ( is_singular() ) {
        $description = get_the_excerpt();
        echo '<meta name="description" content="' . esc_attr( $description ) . '">';
    }
}

// Schema.org structured data
add_action( 'wp_head', 'add_schema_org' );
function add_schema_org() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Hotel',
        // ... schema data
    );
    echo '<script type="application/ld+json">' .
         wp_json_encode( $schema, JSON_UNESCAPED_UNICODE ) .
         '</script>';
}

// Clean URLs
add_action( 'init', 'custom_rewrite_rules' );
```

### Accessibility Implementation ♿

```php
// ARIA labels
echo '<button aria-label="' . esc_attr__( 'Book Now', 'textdomain' ) . '">';

// Skip links
echo '<a href="#main-content" class="skip-link">' .
     esc_html__( 'Skip to content', 'textdomain' ) .
     '</a>';

// Semantic HTML
echo '<nav aria-label="' . esc_attr__( 'Main Navigation', 'textdomain' ) . '">';

// Image alt text
echo '<img src="' . esc_url( $image_url ) . '" ' .
     'alt="' . esc_attr( $alt_text ) . '">';
```

## Oxygen Builder Specifics

### Page Building Architecture

- **No Traditional Theme Files:** All pages built with Oxygen visual builder
- **Custom Fields:** ACF Pro fields integrate directly into Oxygen templates
- **Styling:** CSS managed through Oxygen interface or custom stylesheets
- **Components:** Erropix Hydrogen Pack provides additional functionality

### Working with Oxygen

1. **Templates:** Located in Oxygen Builder admin (not file system)
2. **Reusable Parts:** Created as Oxygen components
3. **Dynamic Data:** Pulled via ACF fields or WordPress functions
4. **Custom Code:** Added via Oxygen's Code Block or custom plugin

### ACF + Oxygen Integration

```php
// Display ACF field in Oxygen template
echo get_field( 'hotel_feature' );

// In custom Oxygen component
$rooms = get_field( 'number_of_rooms' );
echo '<div class="room-count">' . esc_html( $rooms ) . '</div>';
```

## Testing & Validation Checklist

Before committing any changes:

### Code Quality
- [ ] Run `composer lint` (PHP standards)
- [ ] Run `composer fix` (auto-fix violations)
- [ ] Check `.editorconfig` compliance
- [ ] Validate HTML (W3C Validator)

### Performance
- [ ] Test with PageSpeed Insights (≥90 target)
- [ ] Run Lighthouse audit (≥90 performance)
- [ ] Check Core Web Vitals (LCP, FID, CLS)
- [ ] Verify image optimization (WebP/AVIF)
- [ ] Test caching headers
- [ ] Validate compression (GZIP/Brotli)

### SEO
- [ ] Validate Schema.org (validator.schema.org)
- [ ] Check meta tags completeness
- [ ] Verify heading hierarchy (H1-H6)
- [ ] Test sitemap.xml generation
- [ ] Validate robots.txt
- [ ] Check internal linking

### Accessibility
- [ ] Run WAVE accessibility check
- [ ] Use axe DevTools audit
- [ ] Test keyboard navigation
- [ ] Verify color contrast (4.5:1 minimum)
- [ ] Check ARIA labels
- [ ] Validate alt text on images

### Security
- [ ] Test HTTPS enforcement
- [ ] Check security headers (securityheaders.com)
- [ ] Verify SSL certificate (SSL Labs)
- [ ] Test for common vulnerabilities
- [ ] Check plugin updates available

### Mobile & Cross-Browser
- [ ] Test on mobile devices (iOS, Android)
- [ ] Verify responsive design breakpoints
- [ ] Check touch target sizing (48x48px minimum)
- [ ] Test in Chrome, Firefox, Safari, Edge
- [ ] Validate mobile-friendly (Google test)

### Functionality
- [ ] Test all forms (Contact Form 7)
- [ ] Verify navigation links
- [ ] Check internal search
- [ ] Test page loading speed
- [ ] Verify database queries

## Common Optimization Tasks

### Image Optimization with WebP Express

1. Upload original images (JPEG/PNG)
2. WebP Express auto-converts to WebP/AVIF
3. Serve WebP to supported browsers
4. Fallback to original for unsupported browsers

```apache
# .htaccess WebP rules (WebP Express generates these)
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{HTTP_ACCEPT} image/webp
  RewriteCond %{REQUEST_FILENAME}.webp -f
  RewriteRule ^(.+)\.(jpe?g|png)$ $1.$2.webp [T=image/webp,E=accept:1]
</IfModule>
```

### Performance: Browser Caching

```apache
# Add to src/.htaccess
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/jpg "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/gif "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
  ExpiresByType application/pdf "access plus 1 month"
</IfModule>
```

### Performance: GZIP Compression

```apache
# Add to src/.htaccess
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html
  AddOutputFilterByType DEFLATE text/css
  AddOutputFilterByType DEFLATE text/javascript
  AddOutputFilterByType DEFLATE application/javascript
  AddOutputFilterByType DEFLATE application/x-javascript
  AddOutputFilterByType DEFLATE text/xml
  AddOutputFilterByType DEFLATE application/xml
  AddOutputFilterByType DEFLATE application/json
</IfModule>
```

### Security: Headers

```apache
# Add to src/.htaccess
<IfModule mod_headers.c>
  Header set X-Content-Type-Options "nosniff"
  Header set X-Frame-Options "SAMEORIGIN"
  Header set X-XSS-Protection "1; mode=block"
  Header set Referrer-Policy "strict-origin-when-cross-origin"
  Header set Permissions-Policy "geolocation=(), microphone=(), camera=()"
</IfModule>
```

## Git Workflow

Current branch: `bold-pare`
Main branch: `main`

### Commit Message Format

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

Example:
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

## Documentation Requirements

When making changes, document in commit messages:

1. **What changed:** Files modified, features added/removed
2. **Why changed:** Business reason, SEO benefit, performance gain
3. **Impact:** PageSpeed score change, SEO metrics, accessibility improvements
4. **Testing:** Tools used, results achieved, browsers/devices tested

## Useful Resources

### WordPress Development
- **Codex:** https://codex.wordpress.org/
- **Coding Standards:** https://developer.wordpress.org/coding-standards/
- **Plugin Handbook:** https://developer.wordpress.org/plugins/
- **Theme Handbook:** https://developer.wordpress.org/themes/

### Oxygen Builder
- **Documentation:** https://oxygenbuilder.com/documentation/
- **ACF Integration:** https://oxygenbuilder.com/documentation/other/acf-integration/

### SEO & Performance
- **Schema.org Hotel:** https://schema.org/Hotel
- **Core Web Vitals:** https://web.dev/vitals/
- **PageSpeed Insights:** https://pagespeed.web.dev/
- **Lighthouse:** https://developer.chrome.com/docs/lighthouse/

### Accessibility
- **WCAG 2.1 Guidelines:** https://www.w3.org/WAI/WCAG21/quickref/
- **WAVE Tool:** https://wave.webaim.org/
- **axe DevTools:** https://www.deque.com/axe/devtools/

### Validation Tools
- **HTML Validator:** https://validator.w3.org/
- **Schema Validator:** https://validator.schema.org/
- **Security Headers:** https://securityheaders.com/
- **SSL Labs:** https://www.ssllabs.com/ssltest/
- **Mobile-Friendly:** https://search.google.com/test/mobile-friendly

## Current Project Status

```yaml
Branch: bold-pare
Phase: 1 (Foundation Complete)
Next Phase: Security & Performance (Weeks 1-4)
Overall SEO Score: 55/100

Scores by Area:
  SEO On-Page: 45/100
  Performance: 55/100
  Accessibility: 50/100
  Security: 60/100
  Mobile-Friendly: 65/100
  UX/UI: 55/100

Priority Tasks:
  1. PageSpeed optimization (target ≥90)
  2. Schema.org implementation
  3. Meta tag optimization
  4. Image conversion to WebP/AVIF
  5. Security headers configuration
  6. HTTPS enforcement
  7. Content expansion on 8 priority pages
```

## Key Reminders

1. ✅ Always run `composer lint` before committing PHP changes
2. 🧪 Test changes in local WordPress environment first
3. 📊 Validate PageSpeed score after performance changes
4. ♿ Check accessibility with WAVE or axe DevTools
5. 📝 Document all optimizations in commit messages
6. 🚫 Never modify WordPress core files or `wp-config.php` directly
7. 🔌 Use WordPress hooks and filters for customizations
8. 📐 Follow EditorConfig standards (4 spaces PHP, 2 spaces web)
9. 🔐 Implement security best practices (sanitize inputs, escape outputs)
10. 📱 Optimize for mobile-first and Core Web Vitals

---

**For detailed audit information, refer to:**
- `docs/audyt-seo-hotel-nowy-dwor-claude.md` - Comprehensive SEO audit (1,081 lines)
- `docs/audyt-strony.md` - Implementation checklist (651 lines)
- `docs/hotelnowydwor-files-checklist.md` - File creation roadmap (162 lines)

**For role definitions, refer to:**
- `docs/pozycjonowanie-stron-i-sklepow-SEO-instructions.md` - SEO expert role (218 lines)
- `docs/instructions-space-claude.md` - Project timeline and priorities (87 lines)
