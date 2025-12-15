# Architecture Documentation

## Project Overview

This document describes the technical architecture of the Hotel Nowy Dwór website SEO optimization project. The architecture is built on WordPress CMS with Oxygen Builder as the primary page construction system, replacing traditional WordPress themes.

**Website:** https://www.hotelnowydwor.eu/
**Technology:** WordPress + Oxygen Builder + ACF Pro
**Database:** MySQL (`nowydwor_hotelnowydworeunew`)
**PHP Version:** ≥7.4
**Primary Goal:** SEO optimization with PageSpeed score ≥90

## High-Level Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                     User Browser                             │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   Desktop    │  │    Mobile    │  │   Tablet     │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                          │ HTTPS
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                   Apache Web Server                          │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  .htaccess Rules                                      │   │
│  │  - HTTPS Enforcement                                  │   │
│  │  - GZIP/Brotli Compression                           │   │
│  │  - Browser Caching Headers                           │   │
│  │  - Security Headers                                   │   │
│  │  - WebP Content Negotiation                          │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                    WordPress Core                            │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  wp-config.php                                        │   │
│  │  - Database Connection                                │   │
│  │  - Security Keys & Salts                             │   │
│  │  - Debug Configuration                                │   │
│  │  - WordPress Constants                                │   │
│  └──────────────────────────────────────────────────────┘   │
│                          │                                    │
│     ┌────────────────────┼────────────────────┐             │
│     ▼                    ▼                    ▼             │
│  ┌─────────┐      ┌──────────┐        ┌──────────┐         │
│  │ Plugins │      │  Oxygen  │        │   ACF    │         │
│  │ (18)    │      │ Builder  │        │   Pro    │         │
│  └─────────┘      └──────────┘        └──────────┘         │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                MySQL Database                                │
│  nowydwor_hotelnowydworeunew                                 │
│  - Posts, Pages, Custom Post Types                          │
│  - ACF Field Data                                            │
│  - Oxygen Templates & Settings                              │
│  - Plugin Configurations                                     │
│  - User Data & Roles                                         │
└─────────────────────────────────────────────────────────────┘
```

## WordPress Core Architecture

### Directory Structure

```
src/
├── wp-admin/                    # WordPress admin interface (core)
├── wp-includes/                 # WordPress core libraries (core)
├── wp-content/                  # User-customizable content
│   ├── plugins/                # 18 installed plugins
│   │   ├── oxygen/             # Oxygen Builder (primary page builder)
│   │   ├── oxygen-attributes/  # Erropix extension
│   │   ├── oxyextras/          # OxyExtras plugin
│   │   ├── oxy-extended/       # Oxygen Extended
│   │   ├── hydrogen-pack/      # Erropix Hydrogen Pack
│   │   ├── advanced-custom-fields-pro/  # ACF Pro
│   │   ├── webp-express/       # Image optimization
│   │   ├── wp-speed-of-light/  # Performance optimization
│   │   ├── contact-form-7/     # Forms
│   │   ├── wps-hide-login/     # Security
│   │   └── [14 other plugins]
│   ├── themes/                 # 6 themes (twentynineteen active)
│   │   └── twentynineteen/     # Minimal theme (Oxygen handles design)
│   ├── uploads/                # Media library
│   ├── languages/              # Polish translations
│   └── mu-plugins/             # Must-use plugins (if any)
├── .htaccess                   # Apache configuration
├── wp-config.php               # WordPress configuration (PROTECTED)
├── index.php                   # WordPress entry point
└── nowydwor_hotelnowydworeunew.sql  # Database backup (~10.4 MB)
```

### WordPress Request Flow

```
1. Browser Request
   ↓
2. Apache (.htaccess processing)
   ↓
3. index.php (WordPress bootstrap)
   ↓
4. wp-config.php (configuration loading)
   ↓
5. WordPress Core Initialization
   ↓
6. Plugin Loading (18 plugins including Oxygen)
   ↓
7. Theme Loading (twentynineteen - minimal)
   ↓
8. Query Processing
   ↓
9. Oxygen Builder Template Rendering (NOT theme template)
   ↓
10. ACF Field Data Injection
   ↓
11. Content Output with SEO Optimizations
   ↓
12. Browser Response (HTML + CSS + JS + Images)
```

### Configuration Files

#### wp-config.php (PROTECTED - Never commit changes)

```php
// Database Configuration
define( 'DB_NAME', 'nowydwor_hotelnowydworeunew' );
define( 'DB_USER', '[protected]' );
define( 'DB_PASSWORD', '[protected]' );
define( 'DB_HOST', '[protected]' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// Security Keys & Salts
define( 'AUTH_KEY', '[protected]' );
// ... other keys

// WordPress Settings
define( 'WP_DEBUG', false );  // Enable in development
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

// Custom Settings
define( 'DISALLOW_FILE_EDIT', true );  // Disable plugin/theme editor
define( 'WP_POST_REVISIONS', 5 );      // Limit revisions
```

#### .htaccess (Apache Configuration)

```apache
# WordPress Permalinks
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>

# Performance: GZIP Compression
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/css application/javascript
</IfModule>

# Performance: Browser Caching
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/jpg "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
</IfModule>

# Security: Headers
<IfModule mod_headers.c>
  Header set X-Content-Type-Options "nosniff"
  Header set X-Frame-Options "SAMEORIGIN"
  Header set X-XSS-Protection "1; mode=block"
</IfModule>

# WebP Express: Image Optimization
<IfModule mod_rewrite.c>
  RewriteCond %{HTTP_ACCEPT} image/webp
  RewriteCond %{REQUEST_FILENAME}.webp -f
  RewriteRule ^(.+)\.(jpe?g|png)$ $1.$2.webp [T=image/webp]
</IfModule>
```

## Oxygen Builder Architecture

### Why Oxygen Replaces Traditional Themes

Unlike typical WordPress sites that use PHP theme templates, this site uses **Oxygen Builder** as a complete design system, eliminating the need for traditional theme files.

**Traditional WordPress Architecture:**
```
WordPress Core → Theme Files (header.php, footer.php, etc.) → Content
```

**Our Architecture with Oxygen:**
```
WordPress Core → Oxygen Builder → Visual Templates → Content
```

### Oxygen Builder Components

```
Oxygen Builder System
├── Templates
│   ├── Header Template          # Global site header
│   ├── Footer Template          # Global site footer
│   ├── Page Templates           # Individual page designs
│   ├── Post Templates           # Blog post layouts
│   └── Archive Templates        # Category/archive layouts
├── Reusable Parts
│   ├── Navigation Menu
│   ├── Call-to-Action Blocks
│   ├── Contact Forms
│   └── Social Media Icons
├── Style Sheets
│   ├── Global Styles            # Site-wide CSS
│   ├── Component Styles         # Reusable component CSS
│   └── Page-Specific Styles     # Individual page CSS
└── Code Blocks
    ├── Custom PHP Functions
    ├── JavaScript Interactions
    └── Advanced Functionality
```

### Oxygen Builder Data Flow

```
┌─────────────────────────────────────────────────────────────┐
│                    Page Request                              │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│              Oxygen Builder Initialization                   │
│  - Load Oxygen settings from database                       │
│  - Identify template for current page/post                  │
│  - Load reusable parts                                       │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                 ACF Pro Data Injection                       │
│  - Query ACF fields for current page/post                   │
│  - Populate dynamic content placeholders                    │
│  - Handle repeater fields, relationships                    │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│              Erropix Extensions Processing                   │
│  Hydrogen Pack:                                              │
│  - Advanced animations                                       │
│  - Extra design options                                      │
│  OxyExtras:                                                  │
│  - Additional components                                     │
│  Oxygen Attributes:                                          │
│  - Custom HTML attributes                                    │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                  HTML/CSS Generation                         │
│  - Compile visual design to HTML                            │
│  - Generate inline CSS                                       │
│  - Minify output (if enabled)                               │
└─────────────────────────────────────────────────────────────┘
                          │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│                  Browser Rendering                           │
└─────────────────────────────────────────────────────────────┘
```

### Oxygen Template Storage

Oxygen templates are **NOT stored as PHP files**. Instead, they are:

1. **Stored in Database:** MySQL tables (wp_posts with post_type='ct_template')
2. **JSON Format:** Template structure saved as JSON in post_content
3. **No Theme Files:** No header.php, footer.php, single.php, etc.
4. **Visual Editor:** Modified through Oxygen's visual interface in WordPress admin

**Database Structure:**
```sql
SELECT * FROM wp_posts
WHERE post_type = 'ct_template';

-- Returns:
-- ID | post_title | post_content (JSON template structure)
-- 10 | Header Template | {"id":1,"name":"Header",...]
-- 11 | Footer Template | {"id":2,"name":"Footer",...]
-- 12 | Page Template  | {"id":3,"name":"Page",...]
```

### Oxygen + ACF Integration

```php
// Example: Displaying ACF field in Oxygen template
// This happens in Oxygen's visual builder, but equivalent PHP:

// Get ACF field value
$hotel_rooms = get_field( 'number_of_rooms' );
$hotel_features = get_field( 'hotel_features' ); // Repeater field

// Display in Oxygen component
echo '<div class="hotel-info">';
echo '<p>Liczba pokoi: ' . esc_html( $hotel_rooms ) . '</p>';

if ( $hotel_features ) :
    echo '<ul class="features">';
    foreach ( $hotel_features as $feature ) :
        echo '<li>' . esc_html( $feature['feature_name'] ) . '</li>';
    endforeach;
    echo '</ul>';
endif;
echo '</div>';
```

**In Oxygen Visual Builder:**
1. Add "Dynamic Data" component
2. Select "ACF Field" as source
3. Choose field name (e.g., 'number_of_rooms')
4. Apply styling via visual interface
5. Save template to database

## Plugin Ecosystem Architecture

### 18 Installed Plugins (Priority Order)

#### Tier 1: Core Functionality (Critical)

**1. Oxygen Builder**
- **Purpose:** Primary page builder, replaces theme
- **Storage:** Templates in database (wp_posts table)
- **Dependencies:** None (standalone)
- **Impact:** Site won't render without it

**2. Advanced Custom Fields Pro (ACF Pro)**
- **Purpose:** Custom field management for dynamic content
- **Storage:** Field definitions in database, field values in wp_postmeta
- **Integration:** Deep integration with Oxygen templates
- **Use Cases:**
  - Room details (number_of_rooms, room_amenities)
  - Hotel features (hotel_features repeater)
  - Event details (event_date, event_capacity)
  - SEO meta data (custom meta descriptions, schema data)

**3. Erropix Extensions (Hydrogen Pack, Oxygen Attributes)**
- **Purpose:** Extend Oxygen Builder functionality
- **Features:**
  - Advanced animations
  - Extra design options
  - Custom HTML attributes
  - Enhanced responsiveness

**4. OxyExtras**
- **Purpose:** Additional Oxygen Builder components
- **Features:**
  - Advanced navigation menus
  - Social media integration
  - Enhanced typography controls

#### Tier 2: Performance & SEO (High Priority)

**5. WebP Express**
- **Purpose:** Automatic image optimization
- **How It Works:**
  1. User uploads JPEG/PNG image
  2. Plugin converts to WebP format
  3. Stores both original and WebP versions
  4. Serves WebP to supported browsers via .htaccess
  5. Fallback to original for unsupported browsers
- **Storage:** wp-content/webp-express/
- **Performance Impact:** ~60-70% file size reduction

**6. WP Speed of Light**
- **Purpose:** Performance optimization
- **Features:**
  - CSS/JS minification
  - Browser caching headers
  - Database optimization
  - GZIP compression

**7. Google Sitemap Generator**
- **Purpose:** XML sitemap generation for SEO
- **Output:** /sitemap.xml
- **Auto-updates:** Yes (on content changes)

#### Tier 3: Forms & Communication

**8. Contact Form 7**
- **Purpose:** Contact forms
- **Forms Created:**
  - Main contact form (/kontakt/)
  - Room booking inquiry form
  - Event inquiry form
- **Email Integration:** Sends to rezerwacja@hotelnowydwor.eu

#### Tier 4: Security & Management

**9. WPS Hide Login**
- **Purpose:** Security - Change wp-login.php URL
- **Benefit:** Prevents brute force attacks on default login page

**10. MainWP Child**
- **Purpose:** Remote site management for PB MEDIA
- **Connection:** Connects to MainWP Dashboard for monitoring
- **Monitoring:** Uptime, updates, backups

#### Tier 5: Migration & Utilities

**11. All-in-One WP Migration**
- **Purpose:** Site migration, backup/restore
- **Use Cases:**
  - Database export/import
  - Full site backup
  - Staging to production migration

**12-18. Additional Plugins**
- Classic Editor
- Classic Widgets
- Code Snippets (for custom PHP)
- Regenerate Thumbnails
- WP Fastest Cache
- WP Mail SMTP
- Others (as needed for specific functionality)

### Plugin Interaction Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                     WordPress Core                           │
└─────────────────────────────────────────────────────────────┘
                          │
        ┌─────────────────┼─────────────────┐
        │                 │                 │
        ▼                 ▼                 ▼
┌─────────────┐   ┌─────────────┐   ┌─────────────┐
│   Oxygen    │◄─►│   ACF Pro   │   │  WebP       │
│   Builder   │   │             │   │  Express    │
└─────────────┘   └─────────────┘   └─────────────┘
        │                 │                 │
        │                 │                 │
        ▼                 ▼                 ▼
┌─────────────┐   ┌─────────────┐   ┌─────────────┐
│  Erropix    │   │  Contact    │   │  WP Speed   │
│ Extensions  │   │  Form 7     │   │  of Light   │
└─────────────┘   └─────────────┘   └─────────────┘
        │                 │                 │
        └─────────────────┴─────────────────┘
                          │
                          ▼
                   ┌─────────────┐
                   │   Browser   │
                   │   Output    │
                   └─────────────┘
```

### Plugin Hook Priority

Plugins execute in specific order using WordPress hook system:

```php
// Example hook priorities for this site
add_action( 'init', 'oxygen_init', 5 );              // Oxygen loads early
add_action( 'init', 'acf_init', 10 );                // ACF standard priority
add_action( 'wp_enqueue_scripts', 'oxygen_enqueue', 10 );
add_action( 'wp_enqueue_scripts', 'acf_enqueue', 20 );
add_filter( 'the_content', 'oxygen_render', 10 );    // Oxygen renders content
add_filter( 'the_content', 'webp_express_filter', 15 ); // WebP conversion after
```

## Database Architecture

### Database Overview

**Database Name:** nowydwor_hotelnowydworeunew
**Charset:** utf8mb4 (full Unicode support)
**Collation:** utf8mb4_unicode_ci
**Size:** ~10.4 MB (as of backup)
**Tables:** ~50 (WordPress core + plugins)

### Key Database Tables

#### WordPress Core Tables

```sql
wp_posts                    -- Posts, pages, Oxygen templates
├── ID (Primary Key)
├── post_title
├── post_content            -- Oxygen: JSON template structure
├── post_type               -- 'page', 'post', 'ct_template', etc.
├── post_status             -- 'publish', 'draft', 'private'
└── guid

wp_postmeta                 -- ACF field values, Oxygen settings
├── meta_id (Primary Key)
├── post_id (Foreign Key → wp_posts.ID)
├── meta_key                -- ACF: '_number_of_rooms'
└── meta_value              -- ACF: '28'

wp_options                  -- Site settings, plugin configurations
├── option_id (Primary Key)
├── option_name             -- 'siteurl', 'oxygen_settings', etc.
└── option_value

wp_users                    -- User accounts
├── ID (Primary Key)
├── user_login
├── user_email
└── user_registered

wp_usermeta                 -- User metadata
├── umeta_id (Primary Key)
├── user_id (Foreign Key → wp_users.ID)
├── meta_key
└── meta_value

wp_terms                    -- Categories, tags
wp_term_taxonomy           -- Term relationships
wp_term_relationships      -- Post-term connections
```

#### ACF Pro Tables (Custom Field Data)

```sql
-- ACF stores field definitions in wp_posts (post_type='acf-field-group')
-- ACF stores field values in wp_postmeta

-- Example field storage:
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(123, 'number_of_rooms', '28'),
(123, '_number_of_rooms', 'field_abc123'),  -- Field key reference
(123, 'hotel_features_0_feature_name', 'Restaurant'),
(123, 'hotel_features_1_feature_name', 'Event Halls'),
(123, 'hotel_features', '2');  -- Repeater count
```

#### Oxygen Builder Tables (Templates Stored in wp_posts)

```sql
-- Oxygen templates are special post types
SELECT * FROM wp_posts
WHERE post_type IN ('ct_template', 'oxy_user_library', 'oxygen_vsb_iframe');

-- Example Oxygen template structure:
{
  "id": 1,
  "name": "Header",
  "children": [
    {
      "id": 2,
      "name": "section",
      "options": {
        "ct_id": "header-section",
        "ct_classes": "header-main"
      },
      "children": [...]
    }
  ]
}
```

### Database Optimization Strategies

```php
// Limit post revisions (in wp-config.php)
define( 'WP_POST_REVISIONS', 5 );

// Auto-cleanup transients
delete_expired_transients();

// Optimize tables regularly
$wpdb->query( "OPTIMIZE TABLE wp_posts" );
$wpdb->query( "OPTIMIZE TABLE wp_postmeta" );

// Use object caching
wp_cache_set( 'hotel_features', $features, 'hotel', HOUR_IN_SECONDS );
$cached_features = wp_cache_get( 'hotel_features', 'hotel' );
```

### Database Backup & Migration

**Backup File:** `src/nowydwor_hotelnowydworeunew.sql` (~10.4 MB)

**Backup Contents:**
- All WordPress tables
- ACF field definitions and values
- Oxygen templates
- Plugin configurations
- User accounts and roles
- Media library metadata (not files)

**Migration Process:**
```bash
# Export database
mysqldump -u username -p nowydwor_hotelnowydworeunew > backup.sql

# Import to new environment
mysql -u username -p new_database < backup.sql

# Update site URLs in wp_options
UPDATE wp_options SET option_value = 'https://new-domain.com'
WHERE option_name IN ('siteurl', 'home');

# Update Oxygen templates (search/replace domain in JSON)
UPDATE wp_posts
SET post_content = REPLACE(post_content, 'old-domain.com', 'new-domain.com')
WHERE post_type = 'ct_template';
```

## SEO Optimization Architecture

### On-Page SEO Components

```
SEO Layer Architecture
├── Meta Tags
│   ├── Title Tag (Dynamic)
│   ├── Meta Description (Dynamic)
│   ├── Meta Keywords (Deprecated, not used)
│   ├── Open Graph Tags (Facebook/LinkedIn)
│   └── Twitter Card Tags
├── Structured Data (Schema.org)
│   ├── Hotel Schema
│   ├── LocalBusiness Schema
│   ├── BreadcrumbList Schema
│   ├── FAQPage Schema
│   └── Event Schema (for weddings/parties)
├── Heading Hierarchy
│   ├── H1 (Single per page)
│   ├── H2-H6 (Proper nesting)
│   └── Semantic Structure
├── Image Optimization
│   ├── WebP Conversion
│   ├── Alt Text (Required)
│   ├── Title Attributes
│   ├── Lazy Loading
│   └── Responsive Images (srcset)
└── Internal Linking
    ├── Navigation Menu
    ├── Contextual Links
    ├── Related Content
    └── Breadcrumbs
```

### Schema.org Implementation

**Hotel Schema (JSON-LD):**

```php
<?php
function hotel_nowydwor_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Hotel',
        'name' => 'Hotel Nowy Dwór',
        'description' => '28-room hotel in Trzebnica, Poland, 15 km from Wrocław.',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => 'ul. Nowy Dwór 2',
            'addressLocality' => 'Trzebnica',
            'postalCode' => '55-100',
            'addressCountry' => 'PL'
        ),
        'telephone' => '+48713120714',
        'email' => 'rezerwacja@hotelnowydwor.eu',
        'url' => 'https://www.hotelnowydwor.eu/',
        'numberOfRooms' => get_field( 'number_of_rooms' ) ?: '28',
        'starRating' => array(
            '@type' => 'Rating',
            'ratingValue' => '4'
        ),
        'amenityFeature' => array(
            array( '@type' => 'LocationFeatureSpecification', 'name' => 'Restaurant' ),
            array( '@type' => 'LocationFeatureSpecification', 'name' => 'Event Halls' ),
            array( '@type' => 'LocationFeatureSpecification', 'name' => 'Wedding Venue' ),
            array( '@type' => 'LocationFeatureSpecification', 'name' => 'Free WiFi' ),
            array( '@type' => 'LocationFeatureSpecification', 'name' => 'Parking' )
        ),
        'geo' => array(
            '@type' => 'GeoCoordinates',
            'latitude' => '51.3094',
            'longitude' => '17.0633'
        ),
        'priceRange' => '$$',
        'image' => 'https://www.hotelnowydwor.eu/wp-content/uploads/hotel-main.jpg'
    );

    echo '<script type="application/ld+json">' .
         wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) .
         '</script>';
}
add_action( 'wp_head', 'hotel_nowydwor_schema' );
?>
```

**FAQ Schema (for /faq/ page):**

```php
function faq_page_schema() {
    if ( ! is_page( 'faq' ) ) {
        return;
    }

    $faq_items = get_field( 'faq_items' ); // ACF Repeater

    if ( ! $faq_items ) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array()
    );

    foreach ( $faq_items as $item ) {
        $schema['mainEntity'][] = array(
            '@type' => 'Question',
            'name' => $item['question'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => $item['answer']
            )
        );
    }

    echo '<script type="application/ld+json">' .
         wp_json_encode( $schema, JSON_UNESCAPED_UNICODE ) .
         '</script>';
}
add_action( 'wp_head', 'faq_page_schema' );
```

### Meta Tag Generation

```php
function custom_meta_tags() {
    if ( is_singular() ) {
        // Use ACF custom fields if available, otherwise defaults
        $meta_title = get_field( 'seo_title' ) ?: get_the_title() . ' | Hotel Nowy Dwór';
        $meta_description = get_field( 'seo_description' ) ?: get_the_excerpt();

        echo '<meta name="description" content="' . esc_attr( $meta_description ) . '">';
        echo '<meta property="og:title" content="' . esc_attr( $meta_title ) . '">';
        echo '<meta property="og:description" content="' . esc_attr( $meta_description ) . '">';
        echo '<meta property="og:type" content="website">';
        echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">';

        if ( has_post_thumbnail() ) {
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
            echo '<meta property="og:image" content="' . esc_url( $thumbnail_url ) . '">';
        }
    }
}
add_action( 'wp_head', 'custom_meta_tags', 1 );
```

### Sitemap Architecture

**XML Sitemap Structure:**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.hotelnowydwor.eu/</loc>
    <lastmod>2025-01-15</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://www.hotelnowydwor.eu/pokoje/</loc>
    <lastmod>2025-01-10</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>
  <!-- Additional URLs -->
</urlset>
```

**Priority Pages for SEO (ordered by importance):**
1. Homepage (/) - Priority: 1.0
2. Rooms (/pokoje/) - Priority: 0.9
3. Contact (/kontakt/) - Priority: 0.9
4. FAQ (/faq/) - Priority: 0.8
5. About (/o-nas/) - Priority: 0.8
6. Gallery (/galeria/) - Priority: 0.7
7. Restaurant (/restauracja/menu/) - Priority: 0.7
8. Terms (/regulamin/) - Priority: 0.5

## Performance Architecture

### Current Performance Status

**Before Optimization:**
- Mobile PageSpeed: 52/100 ❌
- Desktop PageSpeed: 61/100 ❌
- LCP (Largest Contentful Paint): 4.2s ❌ (target: <2.5s)
- FID (First Input Delay): 150ms ⚠️ (target: <100ms)
- CLS (Cumulative Layout Shift): 0.15 ⚠️ (target: <0.1)

**Target After Optimization:**
- Mobile PageSpeed: ≥90/100 ✅
- Desktop PageSpeed: ≥90/100 ✅
- LCP: <2.5s ✅
- FID: <100ms ✅
- CLS: <0.1 ✅

### Performance Optimization Stack

```
Performance Layer
├── Server-Side Optimization
│   ├── Apache .htaccess Rules
│   │   ├── GZIP/Brotli Compression
│   │   ├── Browser Caching Headers
│   │   └── ETags Configuration
│   ├── PHP Optimization
│   │   ├── OPcache (if available)
│   │   ├── Object Caching (Redis/Memcached)
│   │   └── Database Query Optimization
│   └── CDN Integration (Future)
├── Asset Optimization
│   ├── Image Optimization
│   │   ├── WebP Express (60-70% size reduction)
│   │   ├── Lazy Loading
│   │   ├── Responsive Images (srcset)
│   │   └── Proper Image Sizing
│   ├── CSS Optimization
│   │   ├── Minification (WP Speed of Light)
│   │   ├── Critical CSS Inline
│   │   ├── Non-critical CSS Defer
│   │   └── Remove Unused CSS
│   └── JavaScript Optimization
│       ├── Minification
│       ├── Defer Non-Critical JS
│       ├── Async Loading
│       └── Remove jQuery Migrate
├── Database Optimization
│   ├── Limit Post Revisions (5)
│   ├── Clean Transients
│   ├── Optimize Tables
│   └── Remove Unused Post Meta
└── WordPress Optimization
    ├── Disable Embeds
    ├── Disable Emojis
    ├── Limit Heartbeat API
    └── Remove Query Strings
```

### Image Optimization Pipeline

```
Original Image Upload
        │
        ▼
┌─────────────────────────────────────────┐
│  User uploads image (e.g., hotel-room.jpg)│
│  Size: 2.5 MB, Dimensions: 3000x2000px │
└─────────────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────────────┐
│       WordPress Media Library          │
│  - Store original in wp-content/uploads/│
│  - Generate thumbnails (WP defaults)    │
└─────────────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────────────┐
│         WebP Express Plugin             │
│  - Convert JPEG/PNG to WebP             │
│  - Apply compression (quality: 85)      │
│  - Store: hotel-room.jpg.webp           │
│  - Size: 600 KB (76% reduction)         │
└─────────────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────────────┐
│      .htaccess Content Negotiation      │
│  - Check browser Accept header          │
│  - Serve WebP if supported              │
│  - Fallback to JPEG/PNG if not          │
└─────────────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────────────┐
│          Browser Receives               │
│  Chrome/Edge/Firefox: hotel-room.jpg.webp│
│  Safari (old): hotel-room.jpg           │
└─────────────────────────────────────────┘
```

### Critical Rendering Path Optimization

```
User Request
    │
    ▼
┌───────────────────────────────────────────────────┐
│  1. HTML Document (Inline Critical CSS)          │
│     - Above-the-fold styles inlined in <head>    │
│     - Remaining CSS deferred                      │
└───────────────────────────────────────────────────┘
    │
    ▼
┌───────────────────────────────────────────────────┐
│  2. Oxygen Builder Renders Above-Fold Content    │
│     - Hero section                                │
│     - Navigation                                  │
│     - First viewport content                      │
└───────────────────────────────────────────────────┘
    │
    ▼
┌───────────────────────────────────────────────────┐
│  3. Deferred Assets Load                         │
│     - Non-critical CSS                            │
│     - JavaScript (async/defer)                    │
│     - Below-fold images (lazy load)               │
└───────────────────────────────────────────────────┘
    │
    ▼
┌───────────────────────────────────────────────────┐
│  4. Full Page Interactive                         │
│     - All assets loaded                           │
│     - User can interact                           │
└───────────────────────────────────────────────────┘
```

### Caching Strategy

```php
// Browser Caching (.htaccess)
<IfModule mod_expires.c>
  ExpiresActive On

  # Images (1 year)
  ExpiresByType image/jpg "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/gif "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"

  # CSS/JS (1 month)
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"

  # Fonts (1 year)
  ExpiresByType font/woff "access plus 1 year"
  ExpiresByType font/woff2 "access plus 1 year"
</IfModule>

// WordPress Transients (for dynamic data)
// Cache hotel features for 1 hour
$features = get_transient( 'hotel_features' );
if ( false === $features ) {
    $features = get_field( 'hotel_features' ); // ACF query
    set_transient( 'hotel_features', $features, HOUR_IN_SECONDS );
}

// Object Caching (if Redis/Memcached available)
$rooms = wp_cache_get( 'all_rooms', 'hotel' );
if ( false === $rooms ) {
    $rooms = get_posts( array( 'post_type' => 'room' ) );
    wp_cache_set( 'all_rooms', $rooms, 'hotel', HOUR_IN_SECONDS );
}
```

## Security Architecture

### Security Layers

```
Security Defense-in-Depth
├── Layer 1: Server Configuration
│   ├── HTTPS/SSL Enforcement
│   ├── Security Headers (.htaccess)
│   ├── File Permissions (644 files, 755 directories)
│   └── Disable Directory Listing
├── Layer 2: WordPress Core
│   ├── Keep WordPress Updated
│   ├── Strong Admin Passwords
│   ├── Limit Login Attempts
│   └── Disable File Editing (wp-config.php)
├── Layer 3: Plugins & Themes
│   ├── Only Install Trusted Plugins
│   ├── Keep Plugins Updated
│   ├── Remove Unused Plugins
│   └── Regular Security Audits
├── Layer 4: Application Security
│   ├── Input Sanitization (sanitize_text_field)
│   ├── Output Escaping (esc_html, esc_url)
│   ├── Nonce Verification (wp_verify_nonce)
│   └── Capability Checks (current_user_can)
└── Layer 5: Database Security
    ├── Prepared Statements ($wpdb->prepare)
    ├── Regular Backups
    ├── Limit Database User Privileges
    └── Database Prefix (wp_ default, consider changing)
```

### Security Headers Implementation

```apache
# Add to src/.htaccess
<IfModule mod_headers.c>
  # Prevent MIME type sniffing
  Header set X-Content-Type-Options "nosniff"

  # Prevent clickjacking
  Header set X-Frame-Options "SAMEORIGIN"

  # Enable XSS protection
  Header set X-XSS-Protection "1; mode=block"

  # Referrer policy
  Header set Referrer-Policy "strict-origin-when-cross-origin"

  # Permissions policy (restrict features)
  Header set Permissions-Policy "geolocation=(), microphone=(), camera=()"

  # Content Security Policy (strict)
  Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.google-analytics.com; style-src 'self' 'unsafe-inline';"
</IfModule>
```

### WordPress Security Best Practices

```php
// wp-config.php security settings
define( 'DISALLOW_FILE_EDIT', true );  // Disable theme/plugin editor
define( 'DISALLOW_FILE_MODS', false ); // Allow plugin updates
define( 'WP_AUTO_UPDATE_CORE', 'minor' ); // Auto-update minor releases

// Force HTTPS
define( 'FORCE_SSL_ADMIN', true );

// Security keys (unique per installation)
define( 'AUTH_KEY', 'generate-unique-key-from-wordpress.org' );
// ... other keys
```

### Input Sanitization & Output Escaping

```php
// ALWAYS sanitize user inputs
$user_name = sanitize_text_field( $_POST['name'] );
$user_email = sanitize_email( $_POST['email'] );
$user_url = esc_url_raw( $_POST['website'] );
$user_message = sanitize_textarea_field( $_POST['message'] );

// ALWAYS escape outputs
echo esc_html( $user_name );  // For text
echo esc_url( $user_url );    // For URLs
echo esc_attr( $user_email ); // For HTML attributes
echo wp_kses_post( $user_message ); // For HTML content (allows safe tags)

// ALWAYS verify nonces for forms
if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'contact_form_action' ) ) {
    wp_die( 'Security check failed' );
}

// ALWAYS check user capabilities
if ( ! current_user_can( 'edit_posts' ) ) {
    wp_die( 'Unauthorized access' );
}

// ALWAYS use prepared statements for database queries
$wpdb->get_results( $wpdb->prepare(
    "SELECT * FROM {$wpdb->posts} WHERE post_status = %s AND post_type = %s",
    'publish',
    'page'
) );
```

## Development Workflow

### Local Development Environment

```
Developer Machine
├── Code Editor (VS Code, PhpStorm, etc.)
│   └── Extensions
│       ├── PHP Intelephense
│       ├── EditorConfig
│       └── WordPress Snippets
├── Local WordPress Stack
│   ├── XAMPP / MAMP / Local by Flywheel
│   ├── PHP 7.4+
│   ├── MySQL 5.7+
│   └── Apache 2.4+
├── Git Repository (This Repo)
│   ├── Branch: bold-pare
│   └── Remote: GitHub
├── Composer (PHP dependencies)
│   └── PHPCodeSniffer (WPCS)
└── Browser DevTools
    ├── Chrome Lighthouse
    ├── Firefox DevTools
    └── WAVE Accessibility Extension
```

### Development Workflow Diagram

```
┌──────────────────────────────────────────────────────────────┐
│  1. Clone Repository                                          │
│     git clone [repo] && cd hotelnowydwor-seo-optimization    │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  2. Install Dependencies                                      │
│     composer install                                          │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  3. Import Database                                           │
│     mysql -u root -p < src/nowydwor_hotelnowydworeunew.sql   │
│     Update wp_options (siteurl, home) to localhost           │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  4. Configure Local Environment                              │
│     Update src/wp-config.php with local DB credentials       │
│     Set WP_DEBUG to true                                      │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  5. Create Feature Branch                                     │
│     git checkout -b feature/seo-meta-tags                    │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  6. Make Changes                                              │
│     - Edit files in src/                                      │
│     - Test in local WordPress admin                          │
│     - Verify in browser                                       │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  7. Run Code Quality Checks                                   │
│     composer lint        # Check coding standards             │
│     composer fix         # Auto-fix violations                │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  8. Test Changes                                              │
│     - PageSpeed Insights                                      │
│     - Lighthouse audit                                        │
│     - WAVE accessibility check                                │
│     - Cross-browser testing                                   │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  9. Commit Changes                                            │
│     git add .                                                 │
│     git commit -m "[PHASE 1] SEO: Add meta tags to pages"   │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  10. Push to GitHub                                           │
│      git push origin feature/seo-meta-tags                   │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  11. Create Pull Request                                      │
│      - Compare feature branch to bold-pare                    │
│      - Fill out PR template                                   │
│      - Request review                                         │
└──────────────────────────────────────────────────────────────┘
                           │
                           ▼
┌──────────────────────────────────────────────────────────────┐
│  12. Code Review & Merge                                      │
│      - Address review comments                                │
│      - Merge to bold-pare                                     │
│      - Delete feature branch                                  │
└──────────────────────────────────────────────────────────────┘
```

### Testing Strategy

```
Testing Pyramid
├── Unit Tests (PHP)
│   └── PHPUnit (not yet implemented, future consideration)
├── Integration Tests
│   ├── Test Oxygen + ACF integration
│   ├── Test WebP Express conversion
│   └── Test form submissions
├── Functional Tests
│   ├── Test all 8 priority pages load
│   ├── Test navigation works
│   ├── Test contact forms submit
│   └── Test room booking process
├── Performance Tests
│   ├── PageSpeed Insights (Mobile + Desktop)
│   ├── Lighthouse CI
│   ├── WebPageTest.org
│   └── GTmetrix
├── SEO Tests
│   ├── Schema.org Validator
│   ├── Google Rich Results Test
│   ├── Meta tag completeness
│   └── Sitemap validation
├── Accessibility Tests
│   ├── WAVE (automated scan)
│   ├── axe DevTools
│   ├── Keyboard navigation manual test
│   └── Screen reader test (NVDA/JAWS)
├── Security Tests
│   ├── Security headers check (securityheaders.com)
│   ├── SSL Labs test (ssllabs.com/ssltest)
│   ├── WordPress security scan (WPScan)
│   └── Plugin vulnerability check
└── Cross-Browser Tests
    ├── Chrome (desktop + mobile)
    ├── Firefox (desktop + mobile)
    ├── Safari (desktop + iOS)
    └── Edge (desktop)
```

## Deployment Architecture

### Environments

```
┌─────────────────────────────────────────────────────────────┐
│  Development (Local)                                         │
│  - Developer machines                                        │
│  - Local WordPress installation                             │
│  - Database: localhost MySQL                                │
│  - Purpose: Feature development, testing                    │
└─────────────────────────────────────────────────────────────┘
                          │
                  git push │ git pull
                          ▼
┌─────────────────────────────────────────────────────────────┐
│  Version Control (GitHub)                                    │
│  - Repository: hotelnowydwor-seo-optimization-process       │
│  - Branch: bold-pare (current development)                  │
│  - Branch: main (production-ready)                          │
└─────────────────────────────────────────────────────────────┘
                          │
                  deploy  │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│  Staging (Optional - Not Yet Configured)                     │
│  - Near-production environment                              │
│  - Full testing before production                           │
│  - Client preview                                            │
└─────────────────────────────────────────────────────────────┘
                          │
                  deploy  │
                          ▼
┌─────────────────────────────────────────────────────────────┐
│  Production (Live Site)                                      │
│  - https://www.hotelnowydwor.eu/                            │
│  - Public-facing website                                     │
│  - High availability, performance optimized                 │
└─────────────────────────────────────────────────────────────┘
```

### Deployment Process (Manual - Current State)

```
1. Export Database from Local
   ↓
2. Compress WordPress Files (wp-content)
   ↓
3. Upload to Production Server (FTP/SFTP)
   ↓
4. Import Database to Production MySQL
   ↓
5. Update wp-config.php with Production DB Credentials
   ↓
6. Run Search-Replace on Database URLs
   ↓
7. Clear All Caches (WP Speed of Light)
   ↓
8. Test Live Site Functionality
   ↓
9. Monitor for Errors
```

### Deployment Checklist

**Pre-Deployment:**
- [ ] All changes committed to Git
- [ ] Code passes `composer lint`
- [ ] Local testing complete (all 8 priority pages)
- [ ] PageSpeed score ≥90 on local
- [ ] Schema.org validated
- [ ] Accessibility WCAG 2.1 AA compliant
- [ ] Cross-browser tested
- [ ] Backup current production database
- [ ] Backup current production files

**Deployment:**
- [ ] Export updated database from local
- [ ] Compress wp-content directory
- [ ] Upload files to production via SFTP
- [ ] Import database to production
- [ ] Run search-replace for URLs
- [ ] Update wp-config.php if needed
- [ ] Set file permissions (644/755)
- [ ] Clear all caches
- [ ] Regenerate thumbnails if needed

**Post-Deployment:**
- [ ] Test homepage loads correctly
- [ ] Test all 8 priority pages
- [ ] Verify forms submit (contact, booking)
- [ ] Check HTTPS/SSL certificate
- [ ] Run PageSpeed Insights (production)
- [ ] Validate Schema.org on live site
- [ ] Check sitemap.xml accessibility
- [ ] Monitor error logs (24 hours)
- [ ] Submit updated sitemap to Google Search Console

### Future: CI/CD Pipeline (Recommended)