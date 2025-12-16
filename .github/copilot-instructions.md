# Hotel Nowy Dwór – SEO & Performance Optimization Repository

## Repository Overview

**Purpose:** Full WordPress environment and operational documentation for implementing SEO/Performance audit recommendations for [hotelnowydwor.eu](https://www.hotelnowydwor.eu/).

**Team:** PB MEDIA Strony Sklepy Marketing with AI agents and CI/CD automation.

**Size:** ~500MB with full WordPress installation, themes, plugins, and database dump.

**Primary Goals:**
- **Performance:** PageSpeed Mobile >90, LCP <2.5s
- **SEO:** Improve local keyword visibility (e.g., "hotel Trzebnica", "wesele Trzebnica")
- **Security:** Full WordPress hardening per PB MEDIA standards
- **Content:** 6+ evergreen blog articles

## Technology Stack

- **PHP:** 7.4+ (see `.php-version`)
- **Node.js:** 20+ (see `.nvmrc`)
- **WordPress:** 6.4+ with Oxygen Builder (visual page builder)
- **Package Managers:** Composer (PHP), npm (Node.js)
- **Key Plugins:** Oxygen Builder, Advanced Custom Fields Pro, WebP Express, WP Speed of Light
- **Build Tools:** PHPCS (WordPress Coding Standards), Prettier, Lighthouse CI
- **Image Tools:** cwebp, avifenc, jpegoptim, optipng (for scripts/optimize-images.sh)

## Build & Validation Commands

**CRITICAL: Always run commands in this exact order to avoid failures.**

### 1. Initial Setup (First Time Only)
```bash
# Install Node.js dependencies (required for Lighthouse testing and code formatting)
npm install

# Install PHP dependencies (required for linting and code quality checks)
composer install --no-interaction
```

**Expected Results:**
- npm: ~311 packages installed in ~10-15 seconds
- composer: 8 packages installed in ~60-80 seconds (may clone from GitHub if auth fails for dist)
- Both commands must complete successfully before proceeding

**Common Issues:**
- Composer may show "Could not authenticate against github.com" warnings but will fall back to source cloning - this is expected and OK
- npm may show deprecation warnings - these are safe to ignore for this project

### 2. Code Quality Checks

```bash
# PHP linting (WordPress Coding Standards) - TAKES 2-3 MINUTES on large src/ directory
# Only run when modifying PHP files in src/wp-content/
composer run lint

# PHP auto-fix (when possible)
composer run fix

# PHP security-focused checks
composer run lint:security

# PHP compatibility check (7.4-8.3)
composer run lint:compat

# JavaScript/CSS/JSON/Markdown formatting
npm run format
```

**When to Run:**
- Before committing PHP changes: `composer run lint`
- Before committing any changes: `npm run format`
- CI/CD runs `composer run lint` automatically on PR

### 3. Performance & SEO Testing

```bash
# Local Lighthouse CI test (requires live URL or local server)
npm run test:lighthouse

# Image optimization (WebP/AVIF conversion)
npm run optimize:images
# Note: Requires cwebp and optionally avifenc installed on system
# Script defaults to src/wp-content/uploads if no path specified
```

**Testing Prerequisites:**
- Lighthouse: Requires accessible URL (staging or production)
- Image optimization: Install libwebp and libavif-bin packages

### 4. Validation Workflow for Changes

**Always follow this sequence:**

1. Make changes to code
2. Run appropriate linter:
   - PHP changes: `composer run lint`
   - Any changes: `npm run format`
3. Test locally if possible
4. Commit and push
5. CI/CD will run: security-scan.yml, lighthouse-ci.yml (on PR)

## Project Layout & Architecture

### Directory Structure

```
├── .github/
│   ├── workflows/           # CI/CD automation
│   │   ├── security-scan.yml      # WPScan + PHPCS security (weekly + on push/PR)
│   │   ├── lighthouse-ci.yml      # Performance regression tests (on PR)
│   │   ├── pagespeed-test.yml     # Daily PageSpeed monitoring
│   │   ├── seo-audit.yml          # Link checker + SEO validation
│   │   ├── deploy-staging.yml     # Auto-deploy to staging
│   │   └── deploy-production.yml  # Auto-deploy to production
│   ├── lighthouse/          # Lighthouse configurations
│   │   ├── lhci-config.json       # Main config (3 runs, 90% performance/accessibility)
│   │   ├── mobile-config.json     # Mobile-specific
│   │   ├── desktop-config.json    # Desktop-specific
│   │   └── seo-config.json        # SEO-specific
│   ├── agents/              # AI agent role definitions (SEO Specialist, Performance Engineer, etc.)
│   └── prompts/             # Reusable AI prompts for audits, content, code review
│
├── src/                     # Full WordPress installation
│   ├── wp-config.php        # WordPress configuration (DO NOT MODIFY directly)
│   ├── wp-content/
│   │   ├── themes/          # WordPress themes (Oxygen Builder used, not traditional themes)
│   │   ├── plugins/         # WordPress plugins
│   │   │   ├── oxygen/                  # Visual page builder (primary)
│   │   │   ├── advanced-custom-fields-pro/  # Custom fields
│   │   │   ├── webp-express/            # Image optimization
│   │   │   └── wp-speed-of-light/       # Performance optimization
│   │   ├── uploads/         # Media files (images, videos)
│   │   └── wpsol-config/    # WP Speed of Light configuration
│   └── nowydwor_hotelnowydworeunew.sql  # Database backup (DO NOT MODIFY)
│
├── docs/                    # Project documentation
│   ├── CONTRIBUTING.md      # Development guidelines (READ FIRST for development)
│   ├── ROADMAP.md           # 3-month optimization plan
│   ├── SECURITY.md          # Security policies and PB MEDIA standards
│   ├── ARCHITECTURE.md      # Technical architecture
│   ├── SEO-STRATEGY.md      # SEO implementation strategy
│   └── audyt-*.md           # SEO audit reports
│
├── scripts/                 # Automation scripts
│   ├── optimize-images.sh   # WebP/AVIF conversion (requires cwebp/avifenc)
│   └── fix-line-endings.sh  # LF line ending normalization
│
├── templates/               # Code templates
│   └── (meta tags, Schema.org Hotel, Oxygen structures)
│
├── instructions/            # AI/Copilot instruction files
│   └── *.instructions.md    # Domain-specific coding standards
│
├── agents/                  # AI agent role definitions
├── prompts/                 # Reusable AI prompts
├── composer.json            # PHP dependencies (WPCS, PHPCS)
├── package.json             # Node.js dependencies (Lighthouse, Prettier)
├── .editorconfig            # Editor formatting rules (4 spaces PHP, 2 spaces web files)
├── .nvmrc                   # Node.js version (v20)
├── .php-version             # PHP version (7.4)
└── README.md                # Project overview
```

### Key Configuration Files

- **`.editorconfig`:** Enforces LF line endings, UTF-8, 4-space indents for PHP, 2-space for web files
- **`composer.json`:** Defines PHPCS standards (WordPress, WordPress-Extra, PHPCompatibilityWP)
- **`.github/lighthouse/lhci-config.json`:** Lighthouse CI thresholds (90% performance/accessibility)

### WordPress-Specific Details

**Important:** This project uses **Oxygen Builder**, NOT traditional WordPress themes:
- Pages are built visually, not with theme template files
- No traditional `header.php`, `footer.php`, `single.php` files
- Reusable components managed through Oxygen's component system
- Custom code added via Oxygen Code Blocks or custom plugins

**DO NOT MODIFY:**
- WordPress core files (`wp-includes/`, `wp-admin/`)
- Plugin vendor directories
- Database backup file (`src/nowydwor_hotelnowydworeunew.sql`)
- `wp-config.php` (**must NOT contain production credentials**; use environment variables or a secrets management system for all sensitive credentials)

**SAFE TO MODIFY:**
- Custom plugins in `src/wp-content/plugins/custom-*/`
- Theme customizations (use child theme approach)
- `.htaccess` (with caution - test thoroughly)
- Documentation files in `docs/`

## CI/CD Workflows

### Automated Checks (GitHub Actions)

1. **security-scan.yml** (Runs on: push to main, PR, weekly Monday)
   - WPScan vulnerability scanning (requires `WPSCAN_API_TOKEN` secret)
   - PHPCS security audit with WordPress-Extra standard
   - Validates all PHP files in `src/` directory

2. **lighthouse-ci.yml** (Runs on: PR to main)
   - Performance regression testing against production URL
   - 3 runs averaged for stability
   - Assertions: Performance ≥90%, Accessibility ≥90%
   - Uploads artifacts for analysis

3. **pagespeed-test.yml** (Runs: Daily)
   - Monitors production PageSpeed scores
   - Mobile and Desktop configurations
   - Trend tracking for performance metrics

4. **seo-audit.yml** (Runs on: schedule)
   - Broken link checking
   - Lighthouse SEO audit
   - Schema.org validation

5. **deploy-staging.yml / deploy-production.yml**
   - Automated deployment via SSH
   - Requires `STAGING_*` and `PROD_*` secrets

### Required Secrets

Configure in GitHub Settings → Secrets:
- `WPSCAN_API_TOKEN` - WPScan API key
- `STAGING_*` - Staging server credentials
- `PROD_*` - Production server credentials

## Common Pitfalls & Workarounds

### 1. Composer Install Hangs or Fails
**Symptom:** Composer install hangs for >60 seconds or shows GitHub auth errors

**Solution:** This is expected when GitHub rate limits are hit. Composer falls back to cloning from source (slower but works).
```bash
# Use no-interaction flag to prevent hanging
composer install --no-interaction
# May take 60-80 seconds instead of 10-20 seconds
```

### 2. PHPCS Linting Takes Forever
**Symptom:** `composer run lint` runs for 2+ minutes

**Expected Behavior:** This is normal. The `src/` directory contains full WordPress installation with 1000+ PHP files. Linting is slow but necessary for code quality.

**Optimization:** Only lint files you've changed:
```bash
./vendor/bin/phpcs --standard=WordPress path/to/your/file.php
```

### 3. Image Optimization Script Fails
**Symptom:** `npm run optimize:images` fails with "command not found"

**Solution:** Install required system packages:
```bash
# Ubuntu/Debian
sudo apt-get install webp libavif-bin jpegoptim optipng

# macOS
brew install webp libavif jpegoptim optipng
```

**Note:** Script will skip AVIF conversion if `avifenc` is not installed but will still process WebP.

### 4. Lighthouse CI Fails Locally
**Symptom:** `npm run test:lighthouse` fails with connection errors

**Expected:** This requires a live/accessible URL. It's designed to run in CI/CD against staging/production, not locally unless you have a local server running.

### 5. Line Ending Issues (Windows)
**Symptom:** Git shows thousands of file changes when you haven't changed anything

**Solution:** EditorConfig should prevent this, but if issues persist:
```bash
# Run line ending normalization script
./scripts/fix-line-endings.sh
```

## WordPress Security Standards (PB MEDIA)

**All code MUST follow these rules:**

1. **Input Sanitization:** Use `sanitize_text_field()`, `sanitize_email()`, `sanitize_key()`, etc.

   ```php
   // Example: Sanitizing user input from a form
   $name  = sanitize_text_field( $_POST['name'] );
   $email = sanitize_email( $_POST['email'] );
   $key   = sanitize_key( $_POST['key'] );
## Quick Reference

**Most Common Commands:**
```bash
npm install              # Install Node dependencies (first time)
composer install         # Install PHP dependencies (first time)
npm run format           # Format code before commit
composer run lint        # Check PHP code quality (slow, 2-3 min)
npm run test:lighthouse  # Test performance (requires live URL)
```

**File Locations:**
- WordPress files: `src/`
- Documentation: `docs/`
- CI/CD workflows: `.github/workflows/`
- Scripts: `scripts/`
- Agent definitions: `agents/`
- Prompts: `prompts/`

**Need Help?**
- Development guidelines: `docs/CONTRIBUTING.md`
- Security policies: `docs/SECURITY.md`
- Project roadmap: `docs/ROADMAP.md`
- AI Agents list: `AGENTS.md`

**Trust These Instructions:** Only search for additional information if these instructions are incomplete or proven incorrect through testing.
