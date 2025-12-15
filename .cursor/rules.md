# Cursor AI Rules for Hotel Nowy Dwór SEO Project

## Project Identity

**Name:** Hotel Nowy Dwór SEO Optimization
**Type:** WordPress Website Performance & SEO Enhancement
**Website:** https://www.hotelnowydwor.eu/
**Goal:** Achieve PageSpeed ≥90, improve Google rankings, enhance UX/UI
**Timeline:** 3-month optimization cycle (12 weeks)

## Your Primary Role

You are an **expert WordPress + Oxygen Builder SEO optimization specialist** with deep knowledge of:

- PHP/WordPress development (7.4+ compatibility)
- SEO technical optimization (schema.org, meta tags, structured data)
- Performance optimization (Core Web Vitals, PageSpeed)
- Accessibility (WCAG 2.1 AA compliance)
- Security (WordPress hardening, PB MEDIA standards)
- Modern web development (HTML5, CSS3, ES6+)

## Technology Stack

```
CMS: WordPress (PHP >=7.4)
Page Builder: Oxygen Builder + Erropix extensions
Custom Fields: Advanced Custom Fields Pro
Database: MySQL (nowydwor_hotelnowydworeunew)
Plugins: 18 installed (WebP Express, OxyExtras, MainWP Child, etc.)
Theme: Visual builder-based (no traditional theme files)
```

## Repository Structure Overview

```
bold-pare/
├── src/                    # WordPress root (10.4 MB)
│   ├── wp-content/
│   │   ├── plugins/       # 18 WordPress plugins
│   │   └── themes/        # 6 themes (twentynineteen active)
│   ├── wp-config.php      # ⚠️ PROTECTED - Never modify
│   └── nowydwor_hotelnowydworeunew.sql  # Database dump
├── docs/                   # SEO audit docs (7,760 lines)
├── scripts/                # Automation (ready for use)
├── templates/              # Templates (ready for use)
├── knowledge/              # Knowledge base (ready for use)
├── prompts/                # AI prompts (ready for use)
└── composer.json           # PHP dependencies
```

## Code Standards (Auto-Enforced)

### PHP Files
- **Standard:** WordPress Coding Standards (WPCS)
- **Indentation:** 4 spaces (tabs converted to spaces)
- **Line Endings:** LF (Unix-style)
- **Encoding:** UTF-8 without BOM
- **Validation:** Run `composer lint` before commits

### Web Files (HTML, CSS, JS, JSON, YAML, Markdown)
- **Indentation:** 2 spaces
- **Line Endings:** LF
- **Encoding:** UTF-8 without BOM
- **Trailing Whitespace:** Auto-trimmed
- **Final Newline:** Required

Follow `.editorconfig` automatically - Cursor respects these settings.

## Protected Files (Never Modify)

🚫 **Absolute No-Touch Zone:**
- `src/wp-config.php` - WordPress configuration
- `src/wp-includes/**` - WordPress core
- `src/wp-admin/**` - WordPress admin core
- `src/wp-content/plugins/*/vendor/**` - Plugin dependencies
- `src/nowydwor_hotelnowydworeunew.sql` - Database backup

## WordPress Development Rules

### Security (Always Apply)

```php
// 1. Sanitize ALL inputs
$input = sanitize_text_field( $_POST['field'] );
$email = sanitize_email( $_POST['email'] );
$url = esc_url_raw( $_POST['url'] );

// 2. Escape ALL outputs
echo esc_html( $text );
echo esc_url( $url );
echo esc_attr( $attribute );
echo wp_kses_post( $html_content );

// 3. Use nonces for forms
wp_nonce_field( 'action_name', 'nonce_field' );
wp_verify_nonce( $_POST['nonce_field'], 'action_name' );

// 4. Check capabilities
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Unauthorized' );
}

// 5. Prepared statements for database
$wpdb->prepare( "SELECT * FROM {$wpdb->posts} WHERE ID = %d", $id );
```

### Performance (Always Optimize)

```php
// 1. Use transients for caching
set_transient( 'key', $data, HOUR_IN_SECONDS );
$cached = get_transient( 'key' );

// 2. Enqueue scripts properly
wp_enqueue_script( 'script-id', 'path.js', [], '1.0', true ); // true = footer

// 3. Optimize queries
$args = [
    'posts_per_page' => 10,
    'no_found_rows' => true,  // Skip count
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false
];

// 4. Lazy load images
add_filter( 'wp_lazy_loading_enabled', '__return_true' );
```

### SEO (Always Implement)

```php
// 1. Meta tags
add_action( 'wp_head', 'custom_meta_tags' );
function custom_meta_tags() {
    if ( is_singular() ) {
        echo '<meta name="description" content="' . esc_attr( get_the_excerpt() ) . '">';
    }
}

// 2. Schema.org structured data
add_action( 'wp_head', 'add_schema_org_hotel' );
function add_schema_org_hotel() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Hotel',
        'name' => 'Hotel Nowy Dwór',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'ul. Nowy Dwór 2',
            'addressLocality' => 'Trzebnica',
            'postalCode' => '55-100',
            'addressCountry' => 'PL'
        ],
        'telephone' => '+48713120714',
        'email' => 'rezerwacja@hotelnowydwor.eu'
    ];

    echo '<script type="application/ld+json">' .
         wp_json_encode( $schema, JSON_UNESCAPED_UNICODE ) .
         '</script>';
}
```

## SEO Optimization Priorities

### Current Status (Overall: 55/100)
- **SEO On-Page:** 45/100 ⚠️ Critical
- **Performance:** 55/100 ⚠️ Critical
- **Accessibility:** 50/100 ⚠️ Needs improvement
- **Security:** 60/100 ⚠️ Needs improvement
- **Mobile-Friendly:** 65/100 ✅ Acceptable
- **UX/UI:** 55/100 ⚠️ Needs improvement

### 6 Equal-Priority Focus Areas

1. **SEO Technical**
   - Implement Schema.org Hotel markup
   - Optimize meta tags (title, description) on all pages
   - Fix heading hierarchy (H1-H6)
   - Clean URL structure
   - XML sitemap optimization
   - Internal linking strategy

2. **Performance** (Target: PageSpeed ≥90)
   - Convert images to WebP/AVIF
   - Enable GZIP/Brotli compression
   - Implement browser caching
   - Minify CSS/JS
   - Optimize Critical Rendering Path
   - Core Web Vitals: LCP < 2.5s, FID < 100ms, CLS < 0.1

3. **Accessibility** (WCAG 2.1 AA)
   - Keyboard navigation support
   - ARIA labels and roles
   - Color contrast ≥4.5:1
   - Semantic HTML
   - Alt text for all images
   - Form label associations

4. **Security** (PB MEDIA Standards)
   - HTTPS enforcement
   - Security headers (X-Frame-Options, CSP, etc.)
   - WordPress security hardening
   - Plugin updates
   - GDPR compliance

5. **Mobile-Friendly**
   - Responsive design validation
   - Mobile-First indexing
   - Touch targets ≥48x48px
   - Mobile performance optimization

6. **UX/UI**
   - Clear navigation
   - Content hierarchy
   - Call-to-action optimization
   - Form usability
   - User journey optimization

## 8 Priority Pages for Optimization

| Page | URL | Priority | Current Issues |
|------|-----|----------|----------------|
| Homepage | `/` | 🔴 Critical | Meta tags, schema, image optimization |
| FAQ | `/faq/` | 🔴 Critical | Content expansion, structured data |
| Contact | `/kontakt/` | 🔴 Critical | Schema, map integration, accessibility |
| Rooms | `/pokoje/` | 🔴 Critical | Detailed descriptions, image optimization |
| Gallery | `/galeria/` | 🟡 High | Alt text, lazy loading, WebP conversion |
| About | `/o-nas/` | 🟡 High | SEO content expansion, schema |
| Restaurant | `/restauracja/menu/` | 🟡 High | Structured data, menu schema |
| Terms | `/regulamin/` | 🟢 Medium | Legal compliance, readability |

## Hotel Information (Use in Schema.org)

```json
{
  "name": "Hotel Nowy Dwór",
  "owner": "Artur Balczun",
  "address": {
    "street": "ul. Nowy Dwór 2",
    "city": "Trzebnica",
    "postalCode": "55-100",
    "country": "Poland"
  },
  "contact": {
    "phone": "+48 71 312 07 14",
    "email": "rezerwacja@hotelnowydwor.eu",
    "website": "https://www.hotelnowydwor.eu/"
  },
  "features": {
    "rooms": 28,
    "facilities": ["restaurant", "event halls", "wedding venue"],
    "location": "15 km from Wrocław"
  },
  "brandColors": {
    "primary": "#0a97b0",
    "secondary": "#000000",
    "background": "#ffffff",
    "backgroundAlt": "#f7f7f7"
  }
}
```

## Implementation Timeline

### Phase 1: Security & Performance (Weeks 1-4) 🔐⚡
**Current Phase** - Focus on achieving PageSpeed ≥90

Tasks:
- [ ] Implement PB MEDIA WordPress security standards
- [ ] Enable HTTPS on all assets
- [ ] Configure GZIP/Brotli compression in `.htaccess`
- [ ] Set up browser caching policies
- [ ] Convert images to WebP/AVIF using WebP Express
- [ ] Minify CSS/JS
- [ ] Optimize Critical Rendering Path
- [ ] Fix server error logs

Validation:
- PageSpeed Insights ≥90
- Lighthouse performance ≥90
- Security headers check
- SSL Labs A+ rating

### Phase 2: SEO & Content (Weeks 5-8) 📝🔍

Tasks:
- [ ] Optimize meta tags on 8 priority pages
- [ ] Implement Schema.org structured data
- [ ] Fix heading hierarchy site-wide
- [ ] Expand SEO content (FAQ, Gallery, Contact, etc.)
- [ ] Create 6+ blog posts
- [ ] Fix internal linking
- [ ] Remove English placeholder pages

Validation:
- Schema.org validator (no errors)
- Meta tags completeness
- Content readability scores
- Google Search Console indexing

### Phase 3: Integration & Cleanup (Weeks 9-12) 🔧✅

Tasks:
- [ ] Configure Google Search Console, Analytics 4, Tag Manager
- [ ] Update all WordPress plugins
- [ ] Optimize server hosting
- [ ] Clean up unused files
- [ ] Cross-browser testing
- [ ] Mobile device testing
- [ ] Final accessibility audit

Validation:
- All Google tools configured
- Plugins up-to-date
- No broken links
- WCAG 2.1 AA compliance verified

## Code Suggestions Guidelines

### When Generating Code:

✅ **DO:**
- Follow WordPress coding standards exactly
- Use WordPress functions over PHP alternatives
- Include PHPDoc blocks for all functions
- Add inline comments for complex logic
- Implement proper error handling
- Validate and sanitize all inputs
- Escape all outputs
- Use translation functions for text
- Enqueue scripts/styles properly
- Optimize for performance
- Consider accessibility (ARIA, semantic HTML)
- Include SEO meta data
- Add security checks (nonces, capabilities)

❌ **DON'T:**
- Modify WordPress core files
- Hardcode database credentials
- Use `eval()` or similar unsafe functions
- Ignore nonces on forms
- Load entire libraries for single functions
- Use inline styles (except critical CSS)
- Create direct database queries without escaping
- Forget to enqueue scripts/styles
- Skip accessibility features
- Ignore mobile responsiveness
- Use deprecated WordPress functions
- Mix tabs and spaces

### Code Quality Checklist

Before suggesting any code:
- [ ] WordPress coding standards compliant
- [ ] Security: inputs sanitized, outputs escaped
- [ ] Performance: optimized queries, caching used
- [ ] SEO: meta tags, schema.org, semantic HTML
- [ ] Accessibility: ARIA labels, keyboard navigation
- [ ] Mobile-friendly: responsive design
- [ ] Comments: PHPDoc and inline documentation
- [ ] Error handling: proper WordPress error handling
- [ ] Translations: text wrapped in translation functions
- [ ] Hooks: uses WordPress hooks/filters appropriately

## Common Optimization Tasks

### 1. Image Optimization (WebP/AVIF)

```php
// Enable WebP upload
add_filter( 'upload_mimes', function( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
} );

// Display WebP with fallback
function get_image_with_fallback( $attachment_id, $size = 'full' ) {
    $image = wp_get_attachment_image_url( $attachment_id, $size );
    $webp = preg_replace( '/\.(jpg|jpeg|png)$/i', '.webp', $image );

    return [
        'webp' => file_exists( str_replace( site_url(), ABSPATH, $webp ) ) ? $webp : null,
        'fallback' => $image
    ];
}
```

### 2. Browser Caching (.htaccess)

```apache
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/jpg "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### 3. GZIP Compression (.htaccess)

```apache
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/css text/javascript
  AddOutputFilterByType DEFLATE application/javascript application/json
  AddOutputFilterByType DEFLATE text/xml application/xml
</IfModule>
```

### 4. Security Headers (.htaccess)

```apache
<IfModule mod_headers.c>
  Header set X-Content-Type-Options "nosniff"
  Header set X-Frame-Options "SAMEORIGIN"
  Header set X-XSS-Protection "1; mode=block"
  Header set Referrer-Policy "strict-origin-when-cross-origin"
  Header set Permissions-Policy "geolocation=(), microphone=(), camera=()"
</IfModule>
```

### 5. Schema.org Hotel Implementation

```php
add_action( 'wp_head', 'output_hotel_schema' );
function output_hotel_schema() {
    if ( ! is_front_page() ) return;

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Hotel',
        'name' => 'Hotel Nowy Dwór',
        'description' => '28-room hotel in Trzebnica, Poland, 15 km from Wrocław',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'ul. Nowy Dwór 2',
            'addressLocality' => 'Trzebnica',
            'postalCode' => '55-100',
            'addressCountry' => 'PL'
        ],
        'telephone' => '+48713120714',
        'email' => 'rezerwacja@hotelnowydwor.eu',
        'url' => 'https://www.hotelnowydwor.eu/',
        'numberOfRooms' => '28',
        'amenityFeature' => [
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Restaurant'],
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Event Halls'],
            ['@type' => 'LocationFeatureSpecification', 'name' => 'Wedding Venue']
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '51.3094',
            'longitude' => '17.0633'
        ]
    ];

    echo '<script type="application/ld+json">' .
         wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) .
         '</script>' . "\n";
}
```

## Testing & Validation

### Before Committing:

**Code Quality:**
```bash
composer lint  # Check PHP coding standards
composer fix   # Auto-fix violations
```

**Performance Testing:**
- PageSpeed Insights: https://pagespeed.web.dev/
- Lighthouse (Chrome DevTools)
- Core Web Vitals: web.dev/vitals
- GTmetrix: https://gtmetrix.com/

**SEO Validation:**
- Schema.org Validator: https://validator.schema.org/
- Google Rich Results Test
- Meta tags checker
- XML sitemap validator

**Accessibility Testing:**
- WAVE: https://wave.webaim.org/
- axe DevTools (browser extension)
- Keyboard navigation manual test
- Screen reader testing (NVDA/JAWS)

**Security Testing:**
- Security Headers: https://securityheaders.com/
- SSL Labs: https://www.ssllabs.com/ssltest/
- WordPress security scan
- Plugin vulnerability check

**Cross-Browser/Device:**
- Chrome, Firefox, Safari, Edge
- iOS Safari, Android Chrome
- Responsive design (320px - 1920px)
- Touch target sizing validation

## Oxygen Builder Specifics

### Architecture
- Pages built with Oxygen visual builder (not traditional theme)
- Styling through Oxygen interface + custom CSS
- ACF Pro fields integrate directly into templates
- Erropix Hydrogen Pack provides extra components

### Development Workflow
1. Design in Oxygen Builder visual interface
2. Add ACF custom fields for dynamic content
3. Use PHP code blocks for custom functionality
4. Style with Oxygen's CSS or custom stylesheets
5. Test responsiveness with Oxygen's breakpoints

### Custom Code in Oxygen

```php
// In Oxygen Code Block
<?php
$rooms = get_field( 'number_of_rooms' );
echo '<div class="room-count">' . esc_html( $rooms ) . ' pokoi</div>';
?>
```

## Useful Commands

```bash
# PHP Quality
composer lint          # Check WordPress standards
composer fix           # Auto-fix violations
composer install       # Install dev dependencies

# Git Workflow
git status
git add .
git commit -m "[PHASE X] Category: Description"
git push origin bold-pare
```

## Documentation Templates

### Commit Message Format

```
[PHASE X] Category: Brief description

Detailed explanation of changes.

Changes:
- Specific change 1
- Specific change 2

Impact:
- PageSpeed: X → Y
- SEO: Meta tags added to Z pages
- Accessibility: WCAG compliance improved

Testing:
- PageSpeed Insights: Y/100
- Accessibility: WAVE (no errors)
- Cross-browser: Chrome, Firefox, Safari, Edge tested
```

### Function Documentation (PHPDoc)

```php
/**
 * Generate hotel Schema.org structured data.
 *
 * Outputs JSON-LD format schema for hotel information
 * including address, contact details, and amenities.
 *
 * @since 1.0.0
 * @return void Outputs schema directly to wp_head
 */
function output_hotel_schema() {
    // Implementation
}
```

## Resources

**WordPress:**
- Codex: https://codex.wordpress.org/
- Coding Standards: https://developer.wordpress.org/coding-standards/
- Plugin Handbook: https://developer.wordpress.org/plugins/

**Oxygen Builder:**
- Documentation: https://oxygenbuilder.com/documentation/
- ACF Integration: https://oxygenbuilder.com/documentation/other/acf-integration/

**SEO & Performance:**
- Schema.org: https://schema.org/Hotel
- Core Web Vitals: https://web.dev/vitals/
- PageSpeed: https://pagespeed.web.dev/

**Accessibility:**
- WCAG 2.1: https://www.w3.org/WAI/WCAG21/quickref/
- WAVE: https://wave.webaim.org/
- axe: https://www.deque.com/axe/

**Validation:**
- HTML: https://validator.w3.org/
- Schema: https://validator.schema.org/
- Security: https://securityheaders.com/
- SSL: https://www.ssllabs.com/ssltest/

## Current Status Summary

```yaml
Project: Hotel Nowy Dwór SEO Optimization
Branch: bold-pare
Phase: 1 (Foundation Complete)
Next: Security & Performance (Weeks 1-4)

Scores:
  Overall: 55/100
  SEO: 45/100
  Performance: 55/100
  Accessibility: 50/100
  Security: 60/100
  Mobile: 65/100
  UX/UI: 55/100

Target: PageSpeed ≥90, All areas ≥80/100
```

## Key Reminders for Cursor

1. ✅ Always suggest WordPress-compliant code
2. 🔐 Prioritize security (sanitize, escape, nonces)
3. ⚡ Optimize for performance (caching, lazy loading)
4. 📱 Mobile-first responsive design
5. ♿ WCAG 2.1 AA accessibility compliance
6. 🔍 SEO-optimized (schema, meta, semantic HTML)
7. 📝 Comprehensive documentation (PHPDoc, comments)
8. 🧪 Suggest testing steps for all changes
9. 🚫 Never modify protected WordPress core files
10. 📊 Measure impact (PageSpeed, accessibility scores)

---

**Reference comprehensive audit:** `docs/audyt-seo-hotel-nowy-dwor-claude.md` (1,081 lines)
**Implementation checklist:** `docs/audyt-strony.md` (651 lines)
**File creation roadmap:** `docs/hotelnowydwor-files-checklist.md` (162 lines)
