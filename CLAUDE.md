# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress website SEO optimization project for Hotel Nowy Dwór. The repository contains a complete WordPress installation focused on implementing SEO improvements and performance optimizations.

**Primary Goals:**
1. Higher Google search rankings
2. PageSpeed score minimum 90 points
3. Improved UI/UX
4. Enhanced SEO content saturation
5. Testing and deployment

## Technology Stack

- **CMS:** WordPress (PHP >=7.4)
- **Page Builder:** Oxygen Builder with Erropix extensions (Hydrogen Pack, Oxygen Attributes)
- **Custom Fields:** Advanced Custom Fields Pro
- **Database:** MySQL (database name: `nowydwor_hotelnowydworeunew`)
- **Key Plugins:**
  - WebP Express (image optimization)
  - OxyExtras (Oxygen Builder extensions)
  - MainWP Child (site management)
  - Classic Editor

## Repository Structure

```
├── src/                          # WordPress installation root
│   ├── wp-content/
│   │   ├── plugins/             # WordPress plugins (Oxygen, ACF Pro, etc.)
│   │   └── themes/              # WordPress themes (twentynineteen)
│   └── wp-config.php            # WordPress configuration
├── docs/                        # SEO audit documentation
├── scripts/                     # Automation scripts (empty, ready for use)
├── templates/                   # Templates (empty, ready for use)
├── knowledge/                   # Knowledge base (empty, ready for use)
├── prompts/                     # AI prompts (empty, ready for use)
└── composer.json                # PHP dependencies and scripts
```

## Development Commands

### PHP Code Quality

```bash
# Run PHP CodeSniffer lint check (WordPress coding standards)
composer lint

# Auto-fix PHP coding standard violations
composer fix
```

### Installing Dependencies

```bash
# Install PHP development dependencies (PHPCS, WPCS)
composer install
```

## WordPress Context

### File Locations

- **WordPress Core:** `src/` directory
- **Configuration:** `src/wp-config.php`
- **Custom Code:** Primarily through Oxygen Builder and plugins
- **Database:** Access via WordPress admin or direct MySQL connection

### Oxygen Builder Architecture

This site uses Oxygen Builder as the primary page builder. Key considerations:

1. **Page Templates:** Built with Oxygen, not traditional PHP theme files
2. **Styling:** Managed through Oxygen's visual interface and custom CSS
3. **Components:** Erropix extensions provide additional functionality
4. **Custom Fields:** ACF Pro integrates with Oxygen templates

### Critical Files (Do Not Modify Directly)

- `src/wp-config.php` - Contains database credentials and WordPress constants
- WordPress core files in `src/` (except wp-content)
- Plugin vendor directories

## SEO Optimization Workflow

The project follows a comprehensive SEO audit and implementation process documented in:

- `pozycjonowanie-stron-i-sklepow-SEO-instructions.md` - SEO expert role and audit guidelines
- `audyt-seo-hotel-nowy-dwor-claude.md` - Specific SEO audit for this site
- `docs/` directory - Additional documentation and guides

### Audit Areas (Equal Priority)

When performing SEO work, analyze all areas equally:

1. **SEO Technical:** Meta tags, headings, sitemap, robots.txt, schema.org, URL structure
2. **Performance:** Core Web Vitals (LCP, FID, CLS), image optimization, minification, caching
3. **Accessibility:** WCAG 2.1 AA compliance, keyboard navigation, ARIA labels, color contrast
4. **Security:** HTTPS, headers, WordPress security, plugin vulnerabilities
5. **Mobile-Friendly:** Responsive design, touch targets, mobile performance
6. **UX/UI:** Navigation, content hierarchy, calls-to-action, forms

## Code Standards

### PHP

- Follow WordPress Coding Standards
- PHP 7.4+ compatibility required
- Use spaces (4 spaces) for indentation
- UTF-8 encoding with LF line endings

### General

- EditorConfig is configured - ensure your editor respects `.editorconfig`
- 2-space indentation for JSON, YAML, Markdown, HTML, JS, CSS
- Trim trailing whitespace
- Always end files with a newline

## GitHub Configuration

The repository includes:

- **GitHub Actions:** Workflows directory ready for CI/CD automation
- **Issue Templates:** Located in `.github/ISSUE_TEMPLATE/`
- **CODEOWNERS:** Defines code ownership
- **Dependabot:** Configured for automatic dependency updates

## Working with AI Assistants

This repository is configured for AI-assisted development:

- `.copilot/` - GitHub Copilot instructions (empty, ready for configuration)
- `.cursor/` - Cursor AI rules (empty, ready for configuration)
- `.claude/` - Claude AI settings (empty, ready for configuration)
- SEO instructions in `pozycjonowanie-stron-i-sklepow-SEO-instructions.md` provide expert role context

## Important Notes

### Database and Content

- WordPress database is separate from repository
- Database dump location should be documented if available
- Content changes happen through WordPress admin, not git

### Plugin Management

- Never modify plugin core files directly
- Use child themes or custom plugins for modifications
- Document any plugin customizations in pull requests

### Deployment Considerations

- This is a development repository; production deployment requires separate process
- Test all changes locally before pushing
- SEO changes should be validated with tools (PageSpeed, Lighthouse, SEO analyzers)
- Always backup before major changes

### Performance Optimization

When optimizing performance:
- Compress and optimize images (WebP Express plugin is installed)
- Minimize HTTP requests
- Enable browser caching
- Minify CSS/JS (check if plugins handle this)
- Test Core Web Vitals after each change
- Target: PageSpeed score ≥90

### SEO Implementation

When implementing SEO improvements:
- Verify changes don't break existing functionality
- Test on multiple devices and browsers
- Validate structured data with Google's testing tools
- Check mobile-friendliness
- Monitor Core Web Vitals impact
- Document all changes in pull requests with before/after metrics
