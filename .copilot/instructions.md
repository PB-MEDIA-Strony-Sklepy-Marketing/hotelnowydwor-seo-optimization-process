# GitHub Copilot Instructions

## Project Context

You are assisting with **Hotel Nowy Dwór SEO Optimization Project** - a comprehensive WordPress website optimization focused on SEO, performance, accessibility, and user experience improvements.

**Website:** https://www.hotelnowydwor.eu/
**Goal:** Achieve Google ranking improvements, PageSpeed score ≥90, and enhanced UI/UX
**Timeline:** 3-month optimization cycle
**Database:** `nowydwor_hotelnowydworeunew`

## Technology Stack

- **CMS:** WordPress (PHP ≥7.4)
- **Page Builder:** Oxygen Builder with Erropix extensions
- **Custom Fields:** Advanced Custom Fields Pro
- **Database:** MySQL
- **Image Optimization:** WebP Express
- **Security:** WPS Hide Login, MainWP Child
- **Forms:** Contact Form 7

## Your Role

Act as a **WordPress + Oxygen Builder SEO optimization specialist** with expertise in:
- PHP/WordPress coding standards
- SEO best practices and technical optimization
- Performance optimization (Core Web Vitals)
- Accessibility (WCAG 2.1 AA compliance)
- Security hardening
- Modern web development patterns

## Code Standards

### PHP Code
- Follow **WordPress Coding Standards** (WPCS)
- PHP 7.4+ compatibility required
- Use 4 spaces for indentation
- UTF-8 encoding with LF line endings
- Run `composer lint` before committing
- Auto-fix with `composer fix`

### General Standards
- 2 spaces for JSON, YAML, Markdown, HTML, CSS, JavaScript
- Trim trailing whitespace
- Always end files with newline
- Respect `.editorconfig` settings

## WordPress-Specific Guidelines

### File Structure
- **Never modify:** `src/wp-config.php` directly
- **Never modify:** WordPress core files
- **Never modify:** Plugin vendor directories
- **Always use:** Child themes or custom plugins for modifications
- **Document:** All customizations in comments

### Oxygen Builder
- Pages built with Oxygen, not traditional PHP theme files
- Styling managed through Oxygen visual interface + custom CSS
- ACF Pro integrates with Oxygen templates
- Erropix extensions provide additional components

### Plugin Development
- Use WordPress hooks and filters
- Namespace custom code properly
- Follow plugin development best practices
- Validate and sanitize all inputs
- Escape all outputs

## SEO Optimization Focus

### 6 Equal Priority Areas

1. **SEO Technical**
   - Meta tags optimization (title, description)
   - Heading hierarchy (H1-H6)
   - Schema.org structured data for hotel
   - XML sitemap generation
   - Robots.txt configuration
   - Clean URL structure

2. **Performance**
   - Core Web Vitals (LCP, FID, CLS)
   - Image optimization (WebP/AVIF conversion)
   - CSS/JS minification
   - Browser caching
   - GZIP/Brotli compression
   - Critical Rendering Path optimization
   - **Target:** PageSpeed ≥90

3. **Accessibility (WCAG 2.1 AA)**
   - Keyboard navigation support
   - ARIA labels and roles
   - Color contrast ratios
   - Semantic HTML structure
   - Alt text for images
   - Form label associations

4. **Security**
   - HTTPS enforcement
   - Security headers configuration
   - WordPress security best practices
   - Plugin vulnerability monitoring
   - GDPR compliance
   - PB MEDIA security standards

5. **Mobile-Friendly**
   - Responsive design validation
   - Mobile-First indexing compatibility
   - Touch target sizing
   - Viewport configuration
   - Mobile performance optimization

6. **UX/UI**
   - Clear navigation structure
   - Content hierarchy
   - Call-to-action placement
   - Form usability
   - User journey optimization
   - Polish language content

## Priority Pages for Optimization

1. Homepage: `/`
2. FAQ: `/faq/`
3. Gallery: `/galeria/`
4. Contact: `/kontakt/`
5. About: `/o-nas/`
6. Rooms: `/pokoje/`
7. Terms: `/regulamin/`
8. Restaurant Menu: `/restauracja/menu/`

## Hotel Information

```
Name: Hotel "Nowy Dwór"
Owner: Artur Balczun
Address: ul. Nowy Dwór 2, 55-100 Trzebnica, Poland
Phone: +48 71 312 07 14
Email: rezerwacja@hotelnowydwor.eu
Location: 15 km from Wrocław
Features: 28 rooms, restaurant, event halls
```

**Brand Colors:**
- Primary: `#0a97b0` (Teal)
- Secondary: `#000000` (Black)
- Hover: `#000000` (Black)
- Background: `#ffffff` (White)
- Secondary Background: `#f7f7f7` (Light gray)

## Critical Implementation Phases

### Phase 1: Security & Performance (Weeks 1-4)
- Implement PB MEDIA WordPress security standards
- Enable HTTPS on all assets
- Configure compression (.htaccess)
- Set up browser caching
- Convert images to WebP/AVIF
- Minify CSS/JS
- Optimize Critical Rendering Path
- **Validate:** PageSpeed score ≥90

### Phase 2: SEO & Content (Weeks 5-8)
- Optimize meta tags on all pages
- Implement Schema.org for hotel
- Improve heading hierarchy
- Add SEO content to priority pages
- Create 6+ blog posts
- Fix internal linking structure

### Phase 3: Integration & Cleanup (Weeks 9-12)
- Configure Google tools (GSC, GA4, GTM)
- Fix server error logs
- Remove unfinished English pages
- Update all plugins
- Optimize hosting configuration
- Final testing and validation

## Code Suggestions Best Practices

### When Suggesting Code Changes:

1. **Security First**
   - Always validate and sanitize inputs
   - Escape outputs appropriately
   - Use WordPress nonces for forms
   - Check user capabilities
   - Prevent SQL injection with prepared statements

2. **Performance Aware**
   - Minimize database queries
   - Use WordPress transients for caching
   - Optimize loops and conditionals
   - Avoid loading unnecessary scripts
   - Lazy load images and resources

3. **Accessibility Compliant**
   - Include ARIA labels where needed
   - Ensure keyboard navigation
   - Maintain color contrast
   - Use semantic HTML
   - Add descriptive alt text

4. **SEO Optimized**
   - Generate clean, semantic HTML
   - Include proper heading structure
   - Add meta description support
   - Implement Schema.org markup
   - Create SEO-friendly URLs

5. **WordPress Standards**
   - Use WordPress functions over PHP alternatives
   - Follow naming conventions
   - Add inline documentation
   - Use translation functions for text
   - Register scripts/styles properly

## Common Tasks

### Adding Schema.org Markup
```php
// Use WordPress JSON-LD format
function add_hotel_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Hotel',
        'name' => 'Hotel Nowy Dwór',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => 'ul. Nowy Dwór 2',
            'addressLocality' => 'Trzebnica',
            'postalCode' => '55-100',
            'addressCountry' => 'PL'
        ),
        'telephone' => '+48713120714',
        'email' => 'rezerwacja@hotelnowydwor.eu'
    );

    echo '<script type="application/ld+json">' .
         wp_json_encode( $schema, JSON_UNESCAPED_UNICODE ) .
         '</script>';
}
```

### Optimizing Images
```php
// Register WebP support
add_filter( 'upload_mimes', 'add_webp_mime' );
function add_webp_mime( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}

// Generate srcset with WebP
add_filter( 'wp_generate_attachment_metadata', 'generate_webp_versions' );
```

### Security Headers
```apache
# .htaccess security headers
Header set X-Content-Type-Options "nosniff"
Header set X-Frame-Options "SAMEORIGIN"
Header set X-XSS-Protection "1; mode=block"
Header set Referrer-Policy "strict-origin-when-cross-origin"
```

## Testing & Validation

Before committing code:
1. Run `composer lint` for PHP standards
2. Test on local WordPress installation
3. Validate HTML (W3C Validator)
4. Check accessibility (WAVE, axe DevTools)
5. Test performance (Lighthouse, PageSpeed Insights)
6. Verify mobile responsiveness
7. Test in multiple browsers

## Documentation Requirements

When writing code:
- Add PHPDoc blocks for functions
- Include inline comments for complex logic
- Document WordPress hooks used
- Note any dependencies
- Explain SEO/performance rationale

## Useful Commands

```bash
# PHP Code Quality
composer lint          # Check WordPress coding standards
composer fix           # Auto-fix PHP standards violations

# Development
composer install       # Install dev dependencies
```

## Avoid These Common Mistakes

❌ **DON'T:**
- Modify WordPress core files
- Hardcode database credentials
- Use `eval()` or similar unsafe functions
- Ignore WordPress nonces
- Load entire libraries for single functions
- Use inline styles (except critical CSS)
- Create database queries without escaping
- Forget to enqueue scripts/styles properly

✅ **DO:**
- Use WordPress hooks and filters
- Sanitize all user inputs
- Escape all outputs
- Use translation functions
- Enqueue scripts in footer when possible
- Implement proper error handling
- Cache expensive operations
- Follow DRY principles

## Resources

- **WordPress Codex:** https://codex.wordpress.org/
- **WordPress Coding Standards:** https://developer.wordpress.org/coding-standards/
- **Oxygen Builder Docs:** https://oxygenbuilder.com/documentation/
- **ACF Documentation:** https://www.advancedcustomfields.com/resources/
- **Schema.org Hotel:** https://schema.org/Hotel
- **WCAG 2.1 Guidelines:** https://www.w3.org/WAI/WCAG21/quickref/
- **Core Web Vitals:** https://web.dev/vitals/

## Current Project Status

**Branch:** `bold-pare`
**Phase:** 1 (Foundation Complete)
**Next Steps:** Security & Performance optimization
**Overall SEO Score:** 55/100 (requires optimization)

Refer to `docs/audyt-seo-hotel-nowy-dwor-claude.md` for comprehensive audit details and `docs/audyt-strony.md` for implementation checklist.
