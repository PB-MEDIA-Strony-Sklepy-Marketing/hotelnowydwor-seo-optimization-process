# WordPress + Oxygen Builder Development Guide

## 📋 Spis Treści

1. [WordPress Basics](#wordpress-basics)
2. [Oxygen Builder Architecture](#oxygen-builder-architecture)
3. [ACF Pro Integration](#acf-pro-integration)
4. [Development Workflow](#development-workflow)
5. [Erropix Extensions](#erropix-extensions)
6. [Security Best Practices](#security-best-practices)
7. [Performance Optimization](#performance-optimization)
8. [Database Management](#database-management)
9. [Plugin Development](#plugin-development)
10. [Theme Development](#theme-development)
11. [Debugging & Troubleshooting](#debugging--troubleshooting)
12. [Deployment & Migration](#deployment--migration)

---

## 🔧 WordPress Basics

### WordPress File Structure

```
src/
├── wp-admin/              # WordPress Admin Panel (DO NOT MODIFY)
├── wp-content/            # Customizable content
│   ├── plugins/          # WordPress plugins (18 installed)
│   │   ├── oxygen/       # Oxygen Builder core
│   │   ├── advanced-custom-fields-pro/  # ACF Pro
│   │   ├── oxy-ultimate/ # Erropix Hydrogen Pack
│   │   ├── oxyextras/    # OxyExtras
│   │   ├── webp-express/ # WebP Express
│   │   └── ...           # Other plugins
│   ├── themes/           # WordPress themes (6 installed)
│   │   ├── twentynineteen/  # Active theme
│   │   └── ...
│   ├── uploads/          # Media library
│   └── languages/        # Polish translations
├── wp-includes/          # WordPress core libraries (DO NOT MODIFY)
├── wp-config.php         # WordPress configuration (PROTECTED)
├── .htaccess            # Apache configuration
├── index.php            # WordPress entry point
└── nowydwor_hotelnowydworeunew.sql  # Database dump (~10.4 MB)
```

### wp-config.php Configuration

**CRITICAL: This file contains database credentials and security keys. NEVER commit to git!**

**Current Configuration:**

```php
<?php
// Database settings
define( 'DB_NAME', 'nowydwor_hotelnowydworeunew' );
define( 'DB_USER', 'your_db_user' );
define( 'DB_PASSWORD', 'your_db_password' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// Authentication Unique Keys and Salts
// Generate new keys at: https://api.wordpress.org/secret-key/1.1/salt/
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );

// WordPress Database Table prefix
$table_prefix = 'wp_';

// WordPress debugging mode (DISABLE IN PRODUCTION!)
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

// Performance optimizations
define( 'WP_POST_REVISIONS', 3 );  // Limit post revisions
define( 'AUTOSAVE_INTERVAL', 300 );  // 5 minutes
define( 'EMPTY_TRASH_DAYS', 7 );  // 7 days

// Memory limits
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );

// Disable file editing in admin
define( 'DISALLOW_FILE_EDIT', true );

// Enable WordPress Multisite (if needed)
// define( 'WP_ALLOW_MULTISITE', true );

// Force HTTPS
define( 'FORCE_SSL_ADMIN', true );

// Absolute path to the WordPress directory
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

// Sets up WordPress vars and included files
require_once ABSPATH . 'wp-settings.php';
```

### WordPress Coding Standards

**PHP Standards:**
- **Indentation:** 4 spaces (no tabs)
- **Line Length:** Max 100 characters
- **Naming:** `snake_case` for functions/variables, `PascalCase` for classes
- **Documentation:** PHPDoc for all functions/classes

**Example:**

```php
<?php
/**
 * Get hotel rooms from ACF fields
 *
 * @param int $post_id Post ID
 * @return array Array of rooms
 */
function get_hotel_rooms( $post_id ) {
    // Sanitize input
    $post_id = absint( $post_id );

    // Get ACF field
    $rooms = get_field( 'rooms', $post_id );

    // Validate
    if ( ! is_array( $rooms ) ) {
        return array();
    }

    return $rooms;
}
```

### WordPress Hooks System

**Actions vs. Filters:**
- **Action:** Do something at a specific point (`do_action`)
- **Filter:** Modify data before returning (`apply_filters`)

**Common Hooks:**

```php
<?php
// Add custom meta tags to <head>
add_action( 'wp_head', 'add_custom_meta_tags' );
function add_custom_meta_tags() {
    if ( is_singular( 'post' ) ) {
        echo '<meta name="author" content="Hotel Nowy Dwór">';
    }
}

// Modify excerpt length
add_filter( 'excerpt_length', 'custom_excerpt_length' );
function custom_excerpt_length( $length ) {
    return 25;  // 25 words
}

// Enqueue custom scripts
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );
function enqueue_custom_scripts() {
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/css/custom.css', array(), '1.0' );
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0', true );
}
```

---

## 🎨 Oxygen Builder Architecture

### What is Oxygen Builder?

**Oxygen Builder** is a **visual page builder** for WordPress that:
- Replaces traditional PHP themes
- Generates clean, optimized HTML/CSS
- Provides drag-and-drop interface
- Integrates with ACF Pro for dynamic content
- Supports custom code (PHP, JavaScript, CSS)
- Outputs minimal code (no bloat)

### Oxygen vs. Traditional Themes

| Feature | Oxygen Builder | Traditional Theme |
|---------|---------------|------------------|
| **Page Building** | Visual drag-and-drop | PHP template files |
| **Code Output** | Clean, minimal | Often bloated |
| **Flexibility** | Very high | Limited by theme |
| **Performance** | Optimized | Varies |
| **Learning Curve** | Medium | Low (for users) / High (for developers) |
| **Customization** | Unlimited | Limited without child theme |

### Oxygen Builder Components

**Core Components:**
- **Structure:** Section, Div, Link Wrapper
- **Basics:** Heading, Text, Button, Image, Icon, Video
- **Layout:** Columns, Flexbox, Grid
- **Interactive:** Tabs, Accordion, Toggle, Modal
- **Forms:** Input, Textarea, Select, Checkbox, Radio
- **WordPress:** Menu, Posts Grid, Sidebar, Comments
- **Dynamic Data:** ACF fields, Custom Fields, Post Meta

### Oxygen Builder File Structure

```
wp-content/
├── plugins/
│   ├── oxygen/                 # Oxygen Builder core plugin
│   │   ├── component-framework/  # Components library
│   │   ├── includes/             # Core functionality
│   │   └── vendor/               # Dependencies (DO NOT MODIFY)
│   ├── oxy-ultimate/           # Erropix Hydrogen Pack
│   │   ├── modules/              # Extended components
│   │   └── assets/               # CSS, JS, fonts
│   └── oxyextras/              # OxyExtras plugin
│       ├── components/           # Additional components
│       └── assets/               # CSS, JS
```

**Storage:**
- **Templates:** Stored in WordPress database (`postmeta` table)
- **Reusable Parts:** Saved as Custom Post Types (`ct_template`)
- **CSS:** Inline or external stylesheets
- **Settings:** Stored in `wp_options` table

### Creating a Page with Oxygen

**Step 1: Create New Page**
```
WordPress Admin → Pages → Add New
```

**Step 2: Edit with Oxygen**
```
Click "Edit with Oxygen" button
```

**Step 3: Add Components**
```
Drag & Drop components from left sidebar:
Section → Div → Heading → Text → Button
```

**Step 4: Style Components**
```
Select component → Advanced → Size & Spacing → Colors → Typography
```

**Step 5: Add Dynamic Content**
```
Select component → Data → Dynamic Data → ACF Field
```

**Step 6: Publish**
```
Save → Publish → View Page
```

### Oxygen Global Styles

**Location:** Oxygen → Settings → Stylesheets

**Global Colors:**
```css
:root {
  --color-primary: #0a97b0;     /* Teal */
  --color-secondary: #000000;   /* Black */
  --color-hover: #000000;       /* Black */
  --color-background: #ffffff;  /* White */
  --color-background-alt: #f7f7f7;  /* Light Gray */
  --color-text: #333333;        /* Dark Gray */
  --color-text-light: #666666;  /* Medium Gray */
}
```

**Global Fonts:**
```css
:root {
  --font-primary: 'Arial', sans-serif;
  --font-heading: 'Georgia', serif;
  --font-size-base: 16px;
  --font-size-h1: 2.5rem;   /* 40px */
  --font-size-h2: 2rem;     /* 32px */
  --font-size-h3: 1.5rem;   /* 24px */
  --line-height-base: 1.6;
}
```

### Oxygen Reusable Parts

**Creating Reusable Parts:**

1. Build a component (e.g., Header, Footer, CTA)
2. Select the component
3. Right-click → "Save as Re-usable Part"
4. Name it (e.g., "Header", "Footer", "CTA Button")
5. Use it anywhere: Add+ → Re-usable → Select your part

**Best Practices:**
- **Header/Footer:** Always save as reusable parts
- **CTA Buttons:** Create once, use everywhere
- **Forms:** Reusable contact forms
- **Testimonials:** Reusable testimonial cards

### Oxygen Custom Code

**Adding Custom PHP:**

```php
<?php
// In Oxygen Code Block component
$hotel_name = get_field( 'hotel_name' );
$rooms_count = get_field( 'rooms_count' );

echo "<h2>{$hotel_name}</h2>";
echo "<p>Liczba pokoi: {$rooms_count}</p>";
?>
```

**Adding Custom CSS:**

```css
/* In Oxygen Stylesheets or Code Block */
.hotel-card {
  background: var(--color-background-alt);
  border-radius: 8px;
  padding: 2rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
}

.hotel-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}
```

**Adding Custom JavaScript:**

```javascript
// In Oxygen Code Block (JavaScript)
document.addEventListener('DOMContentLoaded', function() {
  const bookingButton = document.querySelector('.booking-button');

  bookingButton.addEventListener('click', function(e) {
    e.preventDefault();

    // Track booking click in Google Analytics
    if (typeof gtag !== 'undefined') {
      gtag('event', 'booking_click', {
        'event_category': 'engagement',
        'event_label': 'Booking Button'
      });
    }

    // Redirect to booking page
    window.location.href = '/kontakt/';
  });
});
```

---

## 🔌 ACF Pro Integration

### Advanced Custom Fields (ACF) Pro

**What is ACF Pro?**
- Plugin for creating custom fields in WordPress
- Integrates seamlessly with Oxygen Builder
- Supports 20+ field types
- Flexible content layouts
- Repeater fields
- Gallery fields

### ACF Field Types

**Basic Fields:**
- Text (single line)
- Textarea (multi-line)
- Number
- Email
- URL
- Password

**Content Fields:**
- WYSIWYG Editor
- Oembed (YouTube, Vimeo, etc.)
- Image
- File
- Gallery

**Choice Fields:**
- Select (dropdown)
- Checkbox
- Radio Button
- True/False (toggle)

**Relational Fields:**
- Link
- Post Object
- Page Link
- Relationship
- Taxonomy
- User

**Advanced Fields:**
- Repeater (Pro)
- Flexible Content (Pro)
- Clone (Pro)
- Group

### Creating ACF Field Groups

**Example: Hotel Room Fields**

```
Field Group: "Hotel Room Details"
Location: Post Type = "room"

Fields:
├── Room Name (Text)
├── Room Type (Select: Standard, LUX)
├── Room Description (WYSIWYG Editor)
├── Room Price (Number)
├── Room Capacity (Number)
├── Room Amenities (Checkbox: WiFi, TV, Bathroom, Mini-bar)
├── Room Images (Gallery)
└── Room Availability (True/False)
```

### Displaying ACF Fields in Oxygen

**Method 1: Dynamic Data Selector**

```
1. Select Oxygen component (Heading, Text, Image)
2. Click "Data" → "Dynamic Data"
3. Select "Advanced Custom Field"
4. Choose your field name
5. Done!
```

**Method 2: Code Block (PHP)**

```php
<?php
// Single field
$room_name = get_field( 'room_name' );
echo '<h2>' . esc_html( $room_name ) . '</h2>';

// Image field
$room_image = get_field( 'room_image' );
if ( $room_image ) {
    echo '<img src="' . esc_url( $room_image['url'] ) . '"
               alt="' . esc_attr( $room_image['alt'] ) . '">';
}

// Gallery field
$gallery = get_field( 'room_images' );
if ( $gallery ) {
    echo '<div class="gallery">';
    foreach ( $gallery as $image ) {
        echo '<img src="' . esc_url( $image['url'] ) . '"
                   alt="' . esc_attr( $image['alt'] ) . '">';
    }
    echo '</div>';
}

// Repeater field
if ( have_rows( 'room_amenities' ) ) {
    echo '<ul class="amenities">';
    while ( have_rows( 'room_amenities' ) ) {
        the_row();
        $amenity_name = get_sub_field( 'amenity_name' );
        $amenity_icon = get_sub_field( 'amenity_icon' );

        echo '<li>';
        echo '<img src="' . esc_url( $amenity_icon['url'] ) . '" alt="">';
        echo esc_html( $amenity_name );
        echo '</li>';
    }
    echo '</ul>';
}
?>
```

### ACF Options Pages

**Creating Global Site Settings:**

```php
<?php
// functions.php or custom plugin
if ( function_exists( 'acf_add_options_page' ) ) {

    // Main options page
    acf_add_options_page( array(
        'page_title' => 'Hotel Settings',
        'menu_title' => 'Hotel Settings',
        'menu_slug'  => 'hotel-settings',
        'capability' => 'manage_options',
        'icon_url'   => 'dashicons-admin-home',
        'position'   => 30,
    ) );

    // Sub-pages
    acf_add_options_sub_page( array(
        'page_title'  => 'Contact Info',
        'menu_title'  => 'Contact',
        'parent_slug' => 'hotel-settings',
    ) );

    acf_add_options_sub_page( array(
        'page_title'  => 'Social Media',
        'menu_title'  => 'Social',
        'parent_slug' => 'hotel-settings',
    ) );
}
?>
```

**Accessing Options Page Fields:**

```php
<?php
// Get option field
$phone = get_field( 'contact_phone', 'option' );
$email = get_field( 'contact_email', 'option' );
$facebook = get_field( 'facebook_url', 'option' );

echo '<a href="tel:' . esc_attr( $phone ) . '">' . esc_html( $phone ) . '</a>';
echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
echo '<a href="' . esc_url( $facebook ) . '" target="_blank">Facebook</a>';
?>
```

---

## 🛠️ Development Workflow

### Local Development Setup

**Requirements:**
- PHP 7.4+ (recommended 8.0+)
- MySQL 5.7+ or MariaDB 10.3+
- Apache 2.4+ or Nginx
- Composer (for PHP dependencies)
- Git (for version control)

**Recommended Local Environment:**
- **XAMPP** (Windows, Mac, Linux)
- **MAMP** (Mac, Windows)
- **Local by Flywheel** (WordPress-specific, recommended!)
- **Docker** (for advanced users)

### Git Workflow

**Current Setup:**
- **Main Branch:** `main`
- **Current Worktree:** `quirky-mccarthy`
- **Main Repository:** `C:\Users\konta\Documents\GitHub\hotelnowydwor-seo-optimization-process`
- **Worktree Path:** `C:\Users\konta\.claude-worktrees\hotelnowydwor-seo-optimization-process\quirky-mccarthy`

**Commit Message Format:**

```
[PHASE] Category: Brief description

Detailed explanation of changes made.

- Specific change 1
- Specific change 2
- Performance/SEO impact

Testing completed:
- Tool/metric 1
- Tool/metric 2
```

**Example:**

```
[PHASE 2] SEO: Add Schema.org Hotel markup

Implemented structured data for Hotel Nowy Dwór on homepage.

- Added Hotel schema with all required properties
- Included LocalBusiness schema
- Added address, contact info, amenities
- SEO impact: Enhanced Google rich results eligibility

Testing completed:
- Schema.org validator: No errors
- Google Rich Results Test: Passed
```

### WordPress Development Best Practices

**1. Never Modify Core Files**
```
❌ DO NOT modify: wp-admin/, wp-includes/
✅ DO modify: wp-content/plugins/, wp-content/themes/
```

**2. Use Child Themes**
```php
<?php
// Child theme style.css
/*
Theme Name: Hotel Nowy Dwór Child
Template: twentynineteen
*/

// Child theme functions.php
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );
function child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
?>
```

**3. Sanitize Inputs, Escape Outputs**
```php
<?php
// Input sanitization
$user_name = sanitize_text_field( $_POST['name'] );
$user_email = sanitize_email( $_POST['email'] );
$user_message = sanitize_textarea_field( $_POST['message'] );

// Output escaping
echo esc_html( $user_name );
echo esc_url( $link_url );
echo esc_attr( $attribute_value );
echo wp_kses_post( $post_content );  // Allow safe HTML
?>
```

**4. Use Nonces for Security**
```php
<?php
// Create nonce
wp_nonce_field( 'booking_form_action', 'booking_form_nonce' );

// Verify nonce
if ( ! isset( $_POST['booking_form_nonce'] ) ||
     ! wp_verify_nonce( $_POST['booking_form_nonce'], 'booking_form_action' ) ) {
    wp_die( 'Security check failed' );
}
?>
```

**5. Check User Capabilities**
```php
<?php
// Check if user can manage options
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Unauthorized access' );
}

// Check if user can edit posts
if ( ! current_user_can( 'edit_posts' ) ) {
    wp_die( 'You cannot edit posts' );
}
?>
```

---

## 🧩 Erropix Extensions

### Hydrogen Pack (Oxy Ultimate)

**Components:**
- Advanced Heading
- Info Box
- Price Box
- Progress Bar
- Counter
- Countdown Timer
- Flip Box
- Image Comparison
- Modal Popup
- Tabs Advanced
- Accordion Advanced
- Testimonials
- Team Members
- Contact Form 7 Styler

**Usage Example: Price Box for Room Prices**

```
Add+ → Oxy Ultimate → Price Box

Settings:
- Title: "Pokój LUX"
- Price: "250"
- Currency: "zł"
- Period: "/ noc"
- Features: WiFi, Łazienka, TV, Mini-bar
- Button Text: "Rezerwuj"
- Button Link: /kontakt/

Styling:
- Primary Color: #0a97b0 (Teal)
- Hover Color: #000000 (Black)
- Border Radius: 8px
```

### OxyExtras

**Components:**
- Burger Trigger (Mobile Menu)
- Off-Canvas (Slide-in Menu)
- Slide Menu (Horizontal Slider)
- Search Box
- Social Icons
- Alert Box
- Breadcrumbs
- Read More / Less
- Back to Top
- Fluent Forms Styler

**Usage Example: Mobile Menu**

```
1. Add Burger Trigger component
2. Add Off-Canvas component
3. Link Burger Trigger to Off-Canvas ID
4. Add Menu component inside Off-Canvas
5. Style mobile menu with brand colors
```

---

## 🔐 Security Best Practices

### WordPress Security Hardening

**1. Strong Passwords**
```
✅ Use 16+ character passwords
✅ Mix uppercase, lowercase, numbers, symbols
✅ Use password manager (1Password, LastPass)
✅ Change passwords every 3-6 months
```

**2. Two-Factor Authentication (2FA)**
```
Install: Wordfence Security or Google Authenticator
Enable: 2FA for admin accounts
```

**3. Limit Login Attempts**
```
Install: Limit Login Attempts Reloaded
Settings: 3 attempts, 20-minute lockout
```

**4. Hide Login Page**
```
Plugin: WPS Hide Login (already installed)
Custom URL: /secret-admin-login/ (not /wp-admin/)
```

**5. Disable File Editing**
```php
// wp-config.php
define( 'DISALLOW_FILE_EDIT', true );
```

**6. Security Headers (.htaccess)**
```apache
<IfModule mod_headers.c>
  # Prevent XSS attacks
  Header set X-XSS-Protection "1; mode=block"

  # Prevent clickjacking
  Header set X-Frame-Options "SAMEORIGIN"

  # Prevent MIME type sniffing
  Header set X-Content-Type-Options "nosniff"

  # Referrer Policy
  Header set Referrer-Policy "strict-origin-when-cross-origin"

  # Content Security Policy
  Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.google-analytics.com; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' data:; connect-src 'self' https://www.google-analytics.com;"

  # HSTS (HTTP Strict Transport Security)
  Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
</IfModule>
```

**7. Disable XML-RPC**
```apache
# .htaccess
<Files xmlrpc.php>
  Order Deny,Allow
  Deny from all
</Files>
```

**8. Regular Backups**
```
Plugin: UpdraftPlus or All-in-One WP Migration
Schedule: Daily backups
Storage: Google Drive, Dropbox, or Amazon S3
```

**9. Keep WordPress Updated**
```
✅ Update WordPress core
✅ Update all plugins
✅ Update all themes
✅ Remove unused plugins/themes
```

**10. File Permissions**
```
Directories: 755
Files: 644
wp-config.php: 440 or 400
```

---

## ⚡ Performance Optimization

### WordPress Performance Best Practices

**1. Use Caching Plugin**
```
Recommended: WP Rocket (paid) or WP Super Cache (free)
Features:
- Page caching
- Browser caching
- GZIP compression
- Minification (CSS/JS/HTML)
- Lazy loading
- Database optimization
```

**2. Optimize Database**
```php
// wp-config.php
define( 'WP_POST_REVISIONS', 3 );  // Limit revisions
define( 'AUTOSAVE_INTERVAL', 300 );  // 5 minutes
define( 'EMPTY_TRASH_DAYS', 7 );  // 7 days

// Use WP-Optimize plugin for cleanup:
- Delete post revisions
- Clean auto-drafts
- Remove spam comments
- Optimize database tables
```

**3. Image Optimization**
```
Plugin: WebP Express (already installed)
Settings:
- Convert to WebP on upload
- Quality: 80%
- Enable AVIF fallback
- Lazy loading: enabled

Additional: ShortPixel or Imagify for bulk optimization
```

**4. Disable Unused Features**
```php
<?php
// Disable emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Disable embeds
add_action( 'init', function() {
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    add_filter( 'embed_oembed_discover', '__return_false' );
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}, 9999 );

// Disable Dashicons for non-admin users
add_action( 'wp_enqueue_scripts', function() {
    if ( ! is_admin() && ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
} );
?>
```

**5. CDN Integration**
```
Recommended: Cloudflare (free tier)
Benefits:
- Distributed content delivery
- DDoS protection
- SSL/TLS encryption
- Automatic caching
- Performance optimization
```

**6. Lazy Loading**
```php
<?php
// Enable native lazy loading (WordPress 5.5+)
add_filter( 'wp_lazy_loading_enabled', '__return_true' );

// Or use plugin: a3 Lazy Load
?>
```

**7. Optimize WordPress Queries**
```php
<?php
// Bad: Get all posts
$posts = get_posts();

// Good: Get only what you need
$posts = get_posts( array(
    'posts_per_page' => 10,
    'no_found_rows'  => true,  // Skip pagination count
    'update_post_meta_cache' => false,  // Skip meta cache
    'update_post_term_cache' => false,  // Skip term cache
    'fields' => 'ids',  // Get only IDs
) );
?>
```

---

## 💾 Database Management

### Database Structure

**WordPress Core Tables:**
```
wp_posts              # Posts, pages, custom post types
wp_postmeta           # Post metadata
wp_users              # User accounts
wp_usermeta           # User metadata
wp_options            # Site options and settings
wp_terms              # Categories, tags, custom taxonomies
wp_term_taxonomy      # Term relationships
wp_term_relationships # Post-term relationships
wp_comments           # Comments
wp_commentmeta        # Comment metadata
wp_links              # Blogroll links (legacy)
```

**Oxygen Builder Tables:**
```
wp_postmeta           # Oxygen templates stored here
wp_options            # Oxygen settings
```

**ACF Pro Tables:**
```
wp_postmeta           # ACF fields stored here
wp_options            # ACF field groups configuration
```

### Database Optimization

**1. Clean Up Revisions**
```sql
-- Delete all post revisions
DELETE FROM wp_posts WHERE post_type = 'revision';

-- Optimize table after deletion
OPTIMIZE TABLE wp_posts;
```

**2. Clean Up Spam Comments**
```sql
-- Delete spam comments
DELETE FROM wp_comments WHERE comment_approved = 'spam';

-- Delete orphaned comment meta
DELETE FROM wp_commentmeta WHERE comment_id NOT IN (SELECT comment_id FROM wp_comments);

-- Optimize tables
OPTIMIZE TABLE wp_comments;
OPTIMIZE TABLE wp_commentmeta;
```

**3. Clean Up Transients**
```sql
-- Delete expired transients
DELETE FROM wp_options WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP();
DELETE FROM wp_options WHERE option_name LIKE '_transient_%' AND option_name NOT LIKE '_transient_timeout_%' AND option_name IN (SELECT REPLACE(option_name, '_transient_timeout_', '') FROM wp_options WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP());

-- Optimize table
OPTIMIZE TABLE wp_options;
```

**4. Repair and Optimize All Tables**
```sql
-- Repair all tables
REPAIR TABLE wp_posts, wp_postmeta, wp_users, wp_usermeta, wp_options, wp_terms, wp_term_taxonomy, wp_term_relationships, wp_comments, wp_commentmeta;

-- Optimize all tables
OPTIMIZE TABLE wp_posts, wp_postmeta, wp_users, wp_usermeta, wp_options, wp_terms, wp_term_taxonomy, wp_term_relationships, wp_comments, wp_commentmeta;
```

### Database Backup & Restore

**Export Database:**
```bash
# Via command line (mysqldump)
mysqldump -u username -p nowydwor_hotelnowydworeunew > backup_2025-01-15.sql

# Or use phpMyAdmin: Export → SQL → Go
```

**Import Database:**
```bash
# Via command line
mysql -u username -p nowydwor_hotelnowydworeunew < backup_2025-01-15.sql

# Or use phpMyAdmin: Import → Choose File → Go
```

**Search & Replace URLs (after migration):**
```bash
# Use WP-CLI
wp search-replace 'http://oldsite.com' 'https://www.hotelnowydwor.eu' --dry-run
wp search-replace 'http://oldsite.com' 'https://www.hotelnowydwor.eu'

# Or use plugin: Better Search Replace
```

---

## 🔌 Plugin Development

### Creating a Custom Plugin

**Plugin Structure:**
```
wp-content/
├── plugins/
│   └── hotel-nowy-dwor-custom/
│       ├── hotel-nowy-dwor-custom.php  # Main plugin file
│       ├── includes/
│       │   ├── class-hotel-rooms.php
│       │   ├── class-booking-form.php
│       │   └── class-seo-meta.php
│       ├── admin/
│       │   ├── admin-settings.php
│       │   └── admin-dashboard.php
│       ├── public/
│       │   ├── css/
│       │   │   └── public-styles.css
│       │   └── js/
│       │       └── public-scripts.js
│       └── templates/
│           ├── booking-form.php
│           └── room-card.php
```

**Main Plugin File Example:**

```php
<?php
/**
 * Plugin Name: Hotel Nowy Dwór Custom
 * Plugin URI: https://www.hotelnowydwor.eu/
 * Description: Custom functionality for Hotel Nowy Dwór website
 * Version: 1.0.0
 * Author: Hotel Nowy Dwór
 * Author URI: https://www.hotelnowydwor.eu/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: hotel-nowy-dwor
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants
define( 'HND_VERSION', '1.0.0' );
define( 'HND_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'HND_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include dependencies
require_once HND_PLUGIN_DIR . 'includes/class-hotel-rooms.php';
require_once HND_PLUGIN_DIR . 'includes/class-booking-form.php';
require_once HND_PLUGIN_DIR . 'includes/class-seo-meta.php';

// Initialize plugin
function hnd_init() {
    // Load text domain for translations
    load_plugin_textdomain( 'hotel-nowy-dwor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

    // Initialize classes
    new HND_Hotel_Rooms();
    new HND_Booking_Form();
    new HND_SEO_Meta();
}
add_action( 'plugins_loaded', 'hnd_init' );

// Activation hook
register_activation_hook( __FILE__, 'hnd_activate' );
function hnd_activate() {
    // Create custom database tables if needed
    // Flush rewrite rules
    flush_rewrite_rules();
}

// Deactivation hook
register_deactivation_hook( __FILE__, 'hnd_deactivate' );
function hnd_deactivate() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
?>
```

### Creating Custom Post Types

**Example: Hotel Rooms**

```php
<?php
// includes/class-hotel-rooms.php

class HND_Hotel_Rooms {

    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'init', array( $this, 'register_taxonomy' ) );
    }

    public function register_post_type() {
        $labels = array(
            'name'                  => 'Pokoje',
            'singular_name'         => 'Pokój',
            'menu_name'             => 'Pokoje Hotelowe',
            'add_new'               => 'Dodaj Pokój',
            'add_new_item'          => 'Dodaj Nowy Pokój',
            'edit_item'             => 'Edytuj Pokój',
            'view_item'             => 'Zobacz Pokój',
            'all_items'             => 'Wszystkie Pokoje',
            'search_items'          => 'Szukaj Pokoi',
            'not_found'             => 'Nie znaleziono pokoi',
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'pokoje' ),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-admin-home',
            'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
            'show_in_rest'          => true,  // Gutenberg support
        );

        register_post_type( 'hotel_room', $args );
    }

    public function register_taxonomy() {
        $labels = array(
            'name'              => 'Typy Pokoi',
            'singular_name'     => 'Typ Pokoju',
            'search_items'      => 'Szukaj Typów',
            'all_items'         => 'Wszystkie Typy',
            'edit_item'         => 'Edytuj Typ',
            'update_item'       => 'Zaktualizuj Typ',
            'add_new_item'      => 'Dodaj Nowy Typ',
            'menu_name'         => 'Typy Pokoi',
        );

        $args = array(
            'hierarchical'      => true,  // Like categories
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'typ-pokoju' ),
            'show_in_rest'      => true,
        );

        register_taxonomy( 'room_type', array( 'hotel_room' ), $args );
    }
}
?>
```

---

## 🎨 Theme Development

### Child Theme Creation

**1. Create Child Theme Directory:**
```
wp-content/themes/hotel-nowy-dwor-child/
```

**2. Create style.css:**
```css
/*
Theme Name: Hotel Nowy Dwór Child
Template: twentynineteen
Description: Child theme for Hotel Nowy Dwór
Version: 1.0.0
Author: Hotel Nowy Dwór
*/

/* Custom styles below */
:root {
  --color-primary: #0a97b0;
  --color-secondary: #000000;
}

body {
  font-family: Arial, sans-serif;
}

.site-header {
  background-color: var(--color-primary);
}
```

**3. Create functions.php:**
```php
<?php
// Enqueue parent and child theme styles
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );
function child_theme_enqueue_styles() {
    // Parent theme style
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Child theme style
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'parent-style' ),
        wp_get_theme()->get('Version')
    );
}

// Custom functions below
function hotel_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'hotel_custom_excerpt_length' );
?>
```

---

## 🐛 Debugging & Troubleshooting

### WordPress Debug Mode

**Enable Debug Mode (wp-config.php):**

```php
<?php
// Enable WP_DEBUG
define( 'WP_DEBUG', true );

// Log errors to debug.log
define( 'WP_DEBUG_LOG', true );

// Don't display errors on screen
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Log database queries
define( 'SAVEQUERIES', true );

// Script debug (use non-minified versions)
define( 'SCRIPT_DEBUG', true );
?>
```

**Debug Log Location:**
```
wp-content/debug.log
```

### Common Issues & Solutions

**1. White Screen of Death (WSOD)**
```
Causes:
- PHP syntax error
- Memory limit exceeded
- Plugin conflict

Solutions:
- Check error_log or debug.log
- Increase memory: WP_MEMORY_LIMIT = '256M'
- Disable all plugins, enable one by one
- Switch to default theme
```

**2. Database Connection Error**
```
Causes:
- Wrong database credentials
- Database server down
- Corrupted wp-config.php

Solutions:
- Verify DB_NAME, DB_USER, DB_PASSWORD, DB_HOST
- Check if MySQL service is running
- Restore wp-config.php from backup
```

**3. 500 Internal Server Error**
```
Causes:
- Corrupted .htaccess
- PHP memory limit
- Plugin/theme conflict

Solutions:
- Rename .htaccess, regenerate via Settings → Permalinks
- Increase PHP memory_limit in php.ini
- Disable plugins/theme
```

**4. Oxygen Builder Not Loading**
```
Causes:
- JavaScript conflict
- Caching issue
- Permission issue

Solutions:
- Clear browser cache and WordPress cache
- Disable other plugins temporarily
- Check file permissions (755 for directories, 644 for files)
```

---

## 🚀 Deployment & Migration

### Pre-Deployment Checklist

- [ ] Backup database and files
- [ ] Test all functionality locally
- [ ] Update all plugins and themes
- [ ] Disable debug mode (WP_DEBUG = false)
- [ ] Optimize database
- [ ] Minify CSS/JS
- [ ] Compress images
- [ ] Test on staging server
- [ ] Update wp-config.php for production
- [ ] Configure security headers
- [ ] Enable HTTPS
- [ ] Set up SSL certificate
- [ ] Configure caching
- [ ] Test PageSpeed (≥90)
- [ ] Verify SEO meta tags
- [ ] Test forms and contact info
- [ ] Check Google Analytics tracking
- [ ] Submit sitemap to Google Search Console

### Migration Steps

**1. Export from Local:**
```
Plugin: All-in-One WP Migration
Export: File → Download

Or manually:
- Export database via phpMyAdmin
- Download wp-content/ folder via FTP
```

**2. Import to Production:**
```
1. Upload WordPress files to server
2. Create database on production
3. Import database
4. Update wp-config.php with production database credentials
5. Search & replace URLs (old → new)
6. Update file permissions
7. Flush permalinks (Settings → Permalinks → Save)
```

**3. Post-Migration:**
```
- Test all pages and links
- Verify images load correctly
- Test forms and functionality
- Check Google Analytics tracking
- Submit sitemap to Google Search Console
- Monitor for errors in Google Search Console
- Test mobile responsiveness
- Run PageSpeed Insights
```

---

## 📚 Resources

### Official Documentation

- **WordPress Codex:** https://codex.wordpress.org/
- **WordPress Developer Handbook:** https://developer.wordpress.org/
- **Oxygen Builder Docs:** https://oxygenbuilder.com/documentation/
- **ACF Pro Docs:** https://www.advancedcustomfields.com/resources/

### Learning Resources

- **WP Beginner:** https://www.wpbeginner.com/
- **Oxygen Builder Academy:** https://oxygenbuilder.com/academy/
- **ACF Tutorials:** https://www.advancedcustomfields.com/blog/

### Development Tools

- **WordPress CLI:** https://wp-cli.org/
- **Query Monitor:** Plugin for debugging
- **Debug Bar:** Plugin for debugging
- **Theme Check:** Plugin for theme validation

---

**Document Version:** 1.0
**Last Updated:** 2025-01-15
**Author:** Claude AI - WordPress Developer
**Project:** Hotel Nowy Dwór SEO Optimization
