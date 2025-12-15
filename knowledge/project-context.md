# Project Context: Hotel Nowy Dwór SEO Optimization

## 📋 Project Overview

**Project Name:** Hotel Nowy Dwór - SEO Optimization Process
**Repository:** hotelnowydwor-seo-optimization-process
**Current Branch:** quirky-mccarthy (worktree)
**Main Branch:** main
**Project Phase:** Phase 2 - AI Configuration
**Start Date:** ~2024-2025
**Timeline:** 3-month optimization cycle

### Mission Statement

Comprehensive SEO optimization and performance enhancement for Hotel Nowy Dwór's WordPress website to achieve:
1. Higher Google search rankings
2. PageSpeed score minimum 90 points (mobile + desktop)
3. Improved UI/UX experience
4. Enhanced SEO content saturation
5. Full testing and production deployment

---

## 🎯 Project Goals and Objectives

### Primary Goals

1. **SEO Improvement:**
   - Current score: 55/100
   - Target score: >90/100
   - Higher rankings for priority keywords (hotel Trzebnica, wesela, noclegi Wrocław)

2. **Performance Optimization:**
   - PageSpeed score ≥90 (mobile and desktop)
   - Core Web Vitals optimization (LCP, FID, CLS)
   - Image optimization (WebP/AVIF conversion)
   - Caching and compression implementation

3. **Accessibility Compliance:**
   - WCAG 2.1 AA standard
   - Keyboard navigation
   - ARIA labels and semantic HTML
   - Color contrast ratios

4. **Security Hardening:**
   - HTTPS enforcement
   - Security headers configuration
   - WordPress security standards (PB MEDIA)
   - Plugin updates and vulnerability patching

5. **Mobile-First Experience:**
   - Responsive design validation
   - Touch target sizing (48x48px minimum)
   - Mobile performance optimization
   - Google Mobile-Friendly compliance

6. **Content Expansion:**
   - SEO-optimized content on 8 priority pages
   - Schema.org structured data (Hotel, LocalBusiness)
   - Meta tags and Open Graph optimization
   - 6+ blog posts (hotel-related topics)

### Success Metrics

| Metric | Current | Target | Measurement Tool |
|--------|---------|--------|------------------|
| Overall SEO Score | 55/100 | >90/100 | SEO audit tools |
| PageSpeed Score (Mobile) | ~55 | ≥90 | PageSpeed Insights |
| PageSpeed Score (Desktop) | ~65 | ≥90 | PageSpeed Insights |
| Accessibility Score | 50/100 | ≥90/100 | WAVE, axe DevTools |
| Security Score | 60/100 | ≥90/100 | securityheaders.com, SSL Labs |
| Google Search Visibility | Low | Top 10 (priority keywords) | Google Search Console |
| Core Web Vitals | Failing | Passing | Google Search Console |

---

## 🏗️ Technology Stack

### CMS and Core Platform

- **WordPress:** PHP >=7.4 (latest stable)
- **Database:** MySQL (nowydwor_hotelnowydworeunew)
- **Server:** Apache with .htaccess configuration
- **PHP Standards:** WordPress Coding Standards (WPCS)
- **Encoding:** UTF-8 with LF line endings

### Page Builder and Development

- **Oxygen Builder:** Primary visual page builder (no traditional theme)
- **Erropix Extensions:**
  - Hydrogen Pack
  - Oxygen Attributes
- **Advanced Custom Fields Pro:** Custom field management and dynamic content
- **OxyExtras:** Additional Oxygen Builder components

### Performance and Optimization

- **WebP Express:** Image format conversion (JPEG/PNG → WebP/AVIF)
- **WP Speed of Light:** Performance optimization plugin
- **Caching:** Browser caching via .htaccess
- **Compression:** GZIP/Brotli (to be configured)
- **Minification:** CSS/JS (via optimization plugins)

### SEO and Content

- **Google Sitemap Generator:** XML sitemap generation
- **Schema.org:** Structured data implementation (manual/plugin)
- **Meta Tags:** Custom implementation or Yoast SEO (to be decided)
- **Open Graph:** Social media meta tags

### Forms and Communication

- **Contact Form 7:** Contact forms and inquiries
- **Email:** SMTP configuration for reliable email delivery

### Security and Management

- **WPS Hide Login:** Login URL customization
- **MainWP Child:** Remote site management and monitoring
- **Security Headers:** Custom .htaccess configuration
- **SSL/TLS:** HTTPS enforcement

### Development Tools

- **Composer:** PHP dependency management
- **PHP_CodeSniffer (PHPCS):** Code quality and standards
- **WordPress Coding Standards:** WPCS ruleset
- **EditorConfig:** Code style consistency
- **Git:** Version control (main, quirky-mccarthy, bold-pare branches)

---

## 📁 Repository Structure

```
quirky-mccarthy/ (current worktree)
├── src/                          # WordPress installation root
│   ├── wp-content/
│   │   ├── plugins/             # 18 WordPress plugins
│   │   │   ├── oxygen/          # Oxygen Builder (primary)
│   │   │   ├── advanced-custom-fields-pro/
│   │   │   ├── webp-express/    # Image optimization
│   │   │   ├── wp-speed-of-light/
│   │   │   ├── contact-form-7/
│   │   │   └── ...              # 13 more plugins
│   │   ├── themes/              # 6 themes (twentynineteen active)
│   │   └── languages/           # Polish translations
│   ├── wp-config.php            # WordPress configuration (PROTECTED)
│   ├── .htaccess                # Apache configuration
│   └── nowydwor_hotelnowydworeunew.sql  # Database dump (~10.4 MB)
│
├── docs/                        # Documentation (7,939 lines total)
│   ├── audyt-seo-hotel-nowy-dwor-claude.md       # Main SEO audit (1,081 lines)
│   ├── audyt-strony.md                           # Implementation checklist (651 lines)
│   ├── hotelnowydwor-files-checklist.md          # File creation roadmap (162 lines)
│   ├── hotelnowydwor-repo-config-guide.md        # Setup guide part 1 (827 lines)
│   ├── hotelnowydwor-repo-config-guide-part2.md  # Setup guide part 2 (4,813 lines)
│   ├── instructions-space-claude.md              # Claude role definition (87 lines)
│   └── pozycjonowanie-stron-i-sklepow-SEO-instructions.md  # SEO expert role (218 lines)
│
├── text/                        # Source data and content
│   └── all-info-text-hotel.md   # Comprehensive hotel information (677 lines)
│
├── knowledge/                   # Knowledge base (NEW - Phase 2)
│   ├── hotel-info.md            # Hotel comprehensive info (525 lines) ✅
│   ├── project-context.md       # This file (in progress) 🔄
│   ├── seo-best-practices.md    # SEO guidelines (to be created)
│   └── wordpress-oxygen-guide.md # Development guide (to be created)
│
├── .claude-plugin/              # Claude Code workflow orchestration
│   ├── plugin.json              # Claude plugin configuration
│   └── INSTRUCTIONS.md          # Plugin usage instructions
│
├── .github/                     # GitHub configuration
│   ├── workflows/               # CI/CD automation (ready for use)
│   ├── ISSUE_TEMPLATE/          # Issue templates
│   ├── CODEOWNERS               # Code ownership
│   └── dependabot.yml           # Dependency updates
│
├── scripts/                     # Automation scripts (empty, ready for use)
├── templates/                   # Templates (empty, ready for use)
├── prompts/                     # AI prompts (empty, ready for use)
│
├── .claude/                     # Claude AI configuration
│   └── CLAUDE.md                # Claude-specific instructions
│
├── CLAUDE.md                    # Main project instructions for Claude
├── composer.json                # PHP dependencies and scripts
├── .editorconfig                # Code style standards
├── .gitignore                   # Git ignore patterns
└── README.md                    # Project documentation
```

### Directory Purpose

- **src/**: WordPress installation, plugins, themes, database
- **docs/**: Comprehensive SEO audits, implementation guides, role definitions
- **text/**: Source content extracted from the website
- **knowledge/**: AI-generated knowledge base for project context (Phase 2)
- **.claude-plugin/**: Workflow orchestration and automation
- **.github/**: CI/CD workflows, issue templates, code owners
- **scripts/**: Automation scripts (deployment, testing, optimization)
- **templates/**: Reusable templates (documentation, code, configurations)
- **prompts/**: AI prompts for content generation and optimization

---

## 🔄 Project Phases and Timeline

### Phase 1: Foundation and Analysis (Weeks -2 to 0) ✅ COMPLETED

**Status:** Completed
**Branch:** bold-pare

**Completed Tasks:**
- ✅ Repository setup and configuration
- ✅ WordPress installation analysis
- ✅ Comprehensive SEO audit (1,081 lines)
- ✅ Documentation structure creation
- ✅ Priority page identification (8 pages)
- ✅ Technology stack assessment
- ✅ Plugin inventory and security check
- ✅ Database dump creation
- ✅ Git workflow establishment

**Deliverables:**
- docs/audyt-seo-hotel-nowy-dwor-claude.md (SEO audit)
- docs/audyt-strony.md (implementation checklist)
- Repository structure and file organization
- Branch strategy (main, bold-pare, quirky-mccarthy)

### Phase 2: AI Configuration and Knowledge Base (Weeks 1-2) 🔄 IN PROGRESS

**Status:** In Progress
**Branch:** quirky-mccarthy (current)

**Current Tasks:**
- 🔄 Claude plugin workflow setup
- 🔄 Knowledge base generation (knowledge/ directory)
- 🔄 AI-powered documentation creation
- ⏳ SEO strategy documentation
- ⏳ Design system documentation

**Goals:**
- Complete knowledge/ directory with 4 files
- Generate docs/ strategy files (5 files)
- Configure Claude Code workflows
- Establish AI-assisted development patterns

**Deliverables:**
- knowledge/hotel-info.md ✅
- knowledge/project-context.md (this file) 🔄
- knowledge/seo-best-practices.md ⏳
- knowledge/wordpress-oxygen-guide.md ⏳
- docs/SEO-STRATEGY.md ⏳
- docs/DESIGN-SYSTEM.md ⏳
- docs/CONTRIBUTING.md ⏳
- docs/ARCHITECTURE.md ⏳
- docs/BRAND-SETTINGS.md ⏳

### Phase 3: Security & Performance (Weeks 3-6) ⏳ PENDING

**Goal:** PageSpeed ≥90, Security hardening

**Priority Tasks:**
1. Implement PB MEDIA WordPress security standards
2. Enable HTTPS on all assets (images, scripts, styles)
3. Configure GZIP/Brotli compression (.htaccess)
4. Set up browser caching policies
5. Convert images to WebP/AVIF (WebP Express)
6. Minify CSS/JS
7. Optimize Critical Rendering Path
8. Fix server error logs
9. Add security headers (.htaccess)
10. Update all WordPress plugins

**Validation:**
- PageSpeed Insights score ≥90
- Lighthouse performance score ≥90
- Security headers check (securityheaders.com) - A rating
- SSL Labs test - A+ rating
- Core Web Vitals passing (LCP, FID, CLS)

### Phase 4: SEO & Content (Weeks 7-10) ⏳ PENDING

**Goal:** SEO optimization, Content expansion

**Priority Tasks:**
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
   - Homepage: Comprehensive content
5. Create 6+ blog posts (hotel-related topics)
6. Fix internal linking structure
7. Remove English placeholder pages
8. Migrate images from old domain (nowydwor.nfhotel.usermd.net)
9. Configure XML sitemap
10. Set up robots.txt

**Validation:**
- Google Search Console indexing (100% pages)
- Schema.org validator (no errors)
- Meta tag completeness check (100% pages)
- Content readability score (Flesch Reading Ease >60)
- Keyword density analysis

### Phase 5: Integration & Cleanup (Weeks 11-12) ⏳ PENDING

**Goal:** Tools integration, Final validation

**Priority Tasks:**
1. Configure Google Search Console
2. Set up Google Analytics 4
3. Implement Google Tag Manager
4. Configure Google Ads tracking (if applicable)
5. Update all WordPress plugins (final check)
6. Optimize server hosting configuration
7. Clean up unused files and plugins
8. Final cross-browser testing (Chrome, Firefox, Safari, Edge)
9. Mobile device testing (iOS, Android)
10. Accessibility audit (WAVE, axe DevTools)
11. Load testing and stress testing
12. Final SEO audit and comparison

**Validation:**
- All Google tools configured and tracking
- Plugins up-to-date (100%)
- No broken links (0 errors)
- All browsers tested (4+ browsers)
- Mobile devices tested (2+ devices)
- WCAG 2.1 AA compliance verified
- PageSpeed ≥90 (maintained)
- SEO score >90/100

### Phase 6: Production Deployment (Week 13+) ⏳ PENDING

**Goal:** Live deployment and monitoring

**Tasks:**
1. Final backup (database + files)
2. Production deployment
3. DNS configuration (if needed)
4. Post-deployment testing
5. Monitoring setup
6. 30-day performance tracking
7. Google Search Console monitoring
8. User feedback collection

---

## 📊 Current Status Summary

### Overall Progress

- **Phase 1:** ✅ Completed (100%)
- **Phase 2:** 🔄 In Progress (~20%)
- **Phase 3:** ⏳ Pending (0%)
- **Phase 4:** ⏳ Pending (0%)
- **Phase 5:** ⏳ Pending (0%)
- **Phase 6:** ⏳ Pending (0%)

### SEO Scores by Area

| Area | Current Score | Target Score | Status |
|------|---------------|--------------|--------|
| SEO On-Page | 45/100 | >90/100 | ⚠️ Needs Work |
| Performance | 55/100 | ≥90/100 | ⚠️ Critical |
| Accessibility | 50/100 | ≥90/100 | ⚠️ Needs Work |
| Security | 60/100 | ≥90/100 | ⚠️ Needs Work |
| Mobile-Friendly | 65/100 | ≥90/100 | ✅ Good |
| UX/UI | 55/100 | ≥90/100 | ⚠️ Needs Work |
| **Overall** | **55/100** | **>90/100** | **⚠️ Critical** |

### Priority Pages Status

| Page | URL | SEO Status | Content Status | Schema Status |
|------|-----|------------|----------------|---------------|
| Homepage | `/` | ⚠️ Missing meta | 🔴 Needs expansion | ❌ No schema |
| FAQ | `/faq/` | ⚠️ Incomplete | 🔴 Needs 20+ questions | ❌ No schema |
| Gallery | `/galeria/` | ⚠️ Missing alt text | 🟡 Needs optimization | ❌ No schema |
| Contact | `/kontakt/` | ⚠️ Missing schema | 🟡 Needs map integration | ❌ No schema |
| About | `/o-nas/` | ⚠️ Thin content | 🔴 Needs expansion | ❌ No schema |
| Rooms | `/pokoje/` | ⚠️ Missing details | 🔴 Needs descriptions | ❌ No schema |
| Terms | `/regulamin/` | ✅ Legal OK | ✅ Complete | ❌ No schema |
| Restaurant | `/restauracja/menu/` | ⚠️ Missing schema | 🟡 Menu needs structuring | ❌ No schema |

---

## 👥 Team and Roles

### Project Owner

**Artur Balczun**
- Owner of Hotel Nowy Dwór
- Primary stakeholder and decision maker
- Contact: rezerwacja@hotelnowydwor.eu, +48 71 312 07 14

### Development Team

**AI Assistant (Claude Code)**
- Role: SEO Optimization Specialist, WordPress Developer
- Responsibilities:
  - SEO audit and implementation
  - Performance optimization
  - Accessibility compliance
  - Security hardening
  - Content optimization
  - Documentation generation

**Human Developer/Coordinator**
- Role: Project coordinator and validator
- Responsibilities:
  - Final decision making
  - Testing validation
  - Deployment execution
  - Stakeholder communication

### External Dependencies

- **PB MEDIA:** WordPress security standards provider
- **Google:** Search Console, Analytics, Tag Manager integration
- **Hosting Provider:** Server configuration and optimization support
- **Domain Registrar:** DNS configuration if needed

---

## 🔧 Development Workflow

### Git Workflow

**Main Branch:** `main`
- Production-ready code
- Stable releases
- Protected branch (no direct commits)

**Development Branches:**
- `bold-pare`: Phase 1 foundation work ✅
- `quirky-mccarthy`: Phase 2 AI configuration 🔄 (current worktree)
- Future branches: Feature-specific branches for Phase 3-6

### Worktree Strategy

**Main Repository:** C:\Users\konta\Documents\GitHub\hotelnowydwor-seo-optimization-process

**Active Worktree:** C:\Users\konta\.claude-worktrees\hotelnowydwor-seo-optimization-process\quirky-mccarthy

**Benefits:**
- Isolated development environment
- Multiple concurrent branches
- No branch switching overhead
- Safe experimentation

### Commit Message Format

```
[PHASE X] Category: Brief description

Detailed explanation of changes made.

- Specific change 1
- Specific change 2
- Performance impact: PageSpeed improved from X to Y
- SEO impact: Meta tags added to Z pages

Testing completed:
- PageSpeed Insights: 92/100
- Accessibility: WCAG 2.1 AA compliant
- Mobile-friendly: Passed

Related: #issue-number
```

**Categories:**
- SEO: On-page optimization, meta tags, schema
- Performance: Speed, caching, compression
- Accessibility: WCAG compliance, ARIA, keyboard nav
- Security: Headers, HTTPS, hardening
- Content: Page content, blog posts, descriptions
- UX/UI: Design, navigation, user experience
- Config: Configuration changes, plugin settings
- Docs: Documentation updates
- Fix: Bug fixes
- Chore: Maintenance, cleanup, updates

### Code Quality Standards

**PHP (WordPress):**
```bash
composer lint      # Check coding standards (WPCS)
composer fix       # Auto-fix violations
```

**Standards:**
- WordPress Coding Standards (WPCS)
- PHP 7.4+ compatibility
- 4-space indentation
- UTF-8 encoding, LF line endings

**Web Files (HTML, CSS, JS):**
- 2-space indentation
- UTF-8 encoding, LF line endings
- EditorConfig compliance
- Trim trailing whitespace
- Final newline required

---

## 🎯 Key Challenges and Solutions

### Challenge 1: Performance (PageSpeed <60)

**Problem:**
- Unoptimized images (JPEG/PNG, large sizes)
- No GZIP/Brotli compression
- Missing browser caching
- CSS/JS not minified
- Critical Rendering Path not optimized

**Solution:**
- WebP Express: Auto-convert images to WebP/AVIF
- .htaccess: Configure GZIP/Brotli compression
- .htaccess: Set browser caching policies (1 year for images, 1 month for CSS/JS)
- WP Speed of Light: Minify CSS/JS
- Critical CSS: Inline critical styles, defer non-critical
- Target: PageSpeed ≥90

### Challenge 2: SEO On-Page (Score 45/100)

**Problem:**
- Missing/incomplete meta descriptions
- No Schema.org structured data
- Incomplete heading hierarchy
- Images hosted on old domain (nowydwor.nfhotel.usermd.net)
- Leftover English content from theme

**Solution:**
- Add meta descriptions to all 8 priority pages
- Implement Schema.org Hotel + LocalBusiness markup
- Fix H1-H6 hierarchy site-wide
- Migrate images to primary domain (hotelnowydwor.eu)
- Remove English placeholder pages
- Target: SEO score >90/100

### Challenge 3: Content Gaps

**Problem:**
- Thin content on key pages (About, Rooms, Homepage)
- FAQ only 5 questions (needs 20+)
- No blog posts
- Missing internal linking strategy

**Solution:**
- Expand content on 8 priority pages (1,000+ words each)
- Create FAQ with 20+ questions covering common inquiries
- Write 6+ blog posts (hotel tips, local attractions, event guides)
- Implement internal linking strategy (3+ links per page)
- Use knowledge/hotel-info.md as source material

### Challenge 4: Accessibility (Score 50/100)

**Problem:**
- Insufficient ARIA labels
- Color contrast issues
- Keyboard navigation gaps
- Missing alt text on some images
- Form label associations incomplete

**Solution:**
- Add ARIA labels to all interactive elements
- Fix color contrast ratios (4.5:1 minimum for text)
- Ensure keyboard navigation works site-wide (Tab, Enter, Esc)
- Complete alt text for all images (descriptive, SEO-friendly)
- Associate all form labels with inputs
- Use WAVE and axe DevTools for validation
- Target: WCAG 2.1 AA compliance

### Challenge 5: Oxygen Builder Learning Curve

**Problem:**
- No traditional PHP theme files (all Oxygen visual builder)
- Custom fields (ACF Pro) integration needed
- Dynamic content rendering
- Component-based architecture

**Solution:**
- Study Oxygen Builder documentation
- Use knowledge/wordpress-oxygen-guide.md (to be created)
- Leverage ACF Pro fields in Oxygen templates
- Create reusable Oxygen components
- Test changes in staging environment

---

## 📚 Key Resources and Documentation

### Internal Documentation

1. **docs/audyt-seo-hotel-nowy-dwor-claude.md** (1,081 lines)
   - Comprehensive SEO audit
   - Current scores and issues
   - Detailed recommendations

2. **docs/audyt-strony.md** (651 lines)
   - Implementation checklist
   - Task breakdown by phase

3. **docs/hotelnowydwor-files-checklist.md** (162 lines)
   - 37 files to create
   - File creation roadmap

4. **docs/pozycjonowanie-stron-i-sklepow-SEO-instructions.md** (218 lines)
   - SEO expert role definition
   - Best practices and methodologies

5. **text/all-info-text-hotel.md** (677 lines)
   - Complete hotel information
   - Menu, services, contact details

6. **knowledge/hotel-info.md** (525 lines)
   - Structured hotel data
   - SEO keywords, brand identity

7. **CLAUDE.md** (main project instructions)
   - Project overview and tech stack
   - Development standards
   - Workflow and guidelines

8. **.claude/CLAUDE.md** (Claude-specific instructions)
   - AI assistant role and expertise
   - Phase-by-phase implementation guide
   - Code standards and best practices

### External Resources

**WordPress Development:**
- WordPress Codex: https://codex.wordpress.org/
- WordPress Coding Standards: https://developer.wordpress.org/coding-standards/
- Plugin Handbook: https://developer.wordpress.org/plugins/

**Oxygen Builder:**
- Documentation: https://oxygenbuilder.com/documentation/
- ACF Integration: https://oxygenbuilder.com/documentation/other/acf-integration/

**SEO & Performance:**
- Schema.org Hotel: https://schema.org/Hotel
- Core Web Vitals: https://web.dev/vitals/
- PageSpeed Insights: https://pagespeed.web.dev/
- Lighthouse: https://developer.chrome.com/docs/lighthouse/

**Accessibility:**
- WCAG 2.1 Guidelines: https://www.w3.org/WAI/WCAG21/quickref/
- WAVE Tool: https://wave.webaim.org/
- axe DevTools: https://www.deque.com/axe/devtools/

**Validation Tools:**
- HTML Validator: https://validator.w3.org/
- Schema Validator: https://validator.schema.org/
- Security Headers: https://securityheaders.com/
- SSL Labs: https://www.ssllabs.com/ssltest/
- Mobile-Friendly Test: https://search.google.com/test/mobile-friendly

---

## 🔐 Security and Compliance

### WordPress Security Standards (PB MEDIA)

1. **HTTPS Enforcement:**
   - All assets (images, scripts, styles) served over HTTPS
   - Force SSL redirect (.htaccess)
   - HSTS header enabled

2. **Security Headers:**
   ```apache
   Header set X-Content-Type-Options "nosniff"
   Header set X-Frame-Options "SAMEORIGIN"
   Header set X-XSS-Protection "1; mode=block"
   Header set Referrer-Policy "strict-origin-when-cross-origin"
   ```

3. **Plugin Security:**
   - Regular updates (monthly minimum)
   - Vulnerability scanning
   - Remove unused plugins
   - Use reputable sources only

4. **Access Control:**
   - Strong passwords (12+ characters)
   - Custom login URL (WPS Hide Login)
   - Limit login attempts
   - Two-factor authentication (optional)

### GDPR Compliance

- Privacy policy page (required)
- Cookie consent (Contact Form 7)
- Data processing documentation
- Right to erasure implementation

### Backup Strategy

- **Database:** Weekly backups (automated)
- **Files:** Monthly backups (full site)
- **Version Control:** Git repository (daily commits)
- **Disaster Recovery:** Documented restoration procedure

---

## 📈 Monitoring and Reporting

### Performance Monitoring

**Tools:**
- Google PageSpeed Insights (weekly checks)
- Lighthouse (weekly audits)
- Core Web Vitals (Google Search Console)
- GTmetrix (monthly full reports)

**Metrics Tracked:**
- LCP (Largest Contentful Paint) - Target: <2.5s
- FID (First Input Delay) - Target: <100ms
- CLS (Cumulative Layout Shift) - Target: <0.1
- PageSpeed Score - Target: ≥90

### SEO Monitoring

**Tools:**
- Google Search Console (daily checks)
- Google Analytics 4 (daily traffic analysis)
- Keyword ranking tracker (weekly position checks)
- Backlink monitor (monthly analysis)

**Metrics Tracked:**
- Organic search impressions
- Average position for priority keywords
- Click-through rate (CTR)
- Indexed pages count
- Mobile usability issues

### Accessibility Monitoring

**Tools:**
- WAVE (monthly audits)
- axe DevTools (monthly audits)
- Keyboard navigation testing (monthly)
- Screen reader testing (quarterly)

**Metrics Tracked:**
- WCAG 2.1 violations (target: 0)
- Color contrast errors (target: 0)
- Missing alt text (target: 0)
- Form label issues (target: 0)

---

## 🚀 Next Steps

### Immediate Actions (Phase 2 - Current)

1. ✅ Complete knowledge/hotel-info.md
2. 🔄 Complete knowledge/project-context.md (this file)
3. ⏳ Generate knowledge/seo-best-practices.md
4. ⏳ Generate knowledge/wordpress-oxygen-guide.md
5. ⏳ Generate docs/SEO-STRATEGY.md
6. ⏳ Generate docs/DESIGN-SYSTEM.md
7. ⏳ Generate docs/CONTRIBUTING.md
8. ⏳ Generate docs/ARCHITECTURE.md
9. ⏳ Generate docs/BRAND-SETTINGS.md

### Upcoming Actions (Phase 3 - Security & Performance)

1. Configure HTTPS enforcement (.htaccess)
2. Add security headers (.htaccess)
3. Enable GZIP/Brotli compression
4. Set up browser caching policies
5. Convert images to WebP/AVIF (WebP Express)
6. Minify CSS/JS
7. Optimize Critical Rendering Path
8. Update all WordPress plugins
9. Run PageSpeed Insights audit
10. Validate security headers (securityheaders.com)

---

## 📝 Notes and Considerations

### Critical Files (Never Modify Directly)

❌ `src/wp-config.php` - Database credentials and WordPress constants
❌ `src/wp-includes/**` - WordPress core files
❌ `src/wp-admin/**` - WordPress admin core
❌ `src/wp-content/plugins/*/vendor/**` - Plugin dependencies
❌ `src/nowydwor_hotelnowydworeunew.sql` - Database backup

### Safe to Modify

✅ `src/wp-content/themes/**` - Theme customizations (use child theme)
✅ `src/wp-content/plugins/custom-plugins/**` - Custom plugin development
✅ `src/.htaccess` - Server configuration (with caution)
✅ `docs/**` - Documentation
✅ Configuration files (`.editorconfig`, `composer.json`, etc.)

### Testing Requirements

Before committing changes:
- Run `composer lint` for PHP files
- Test in local WordPress environment
- Validate HTML (W3C Validator)
- Check PageSpeed score
- Run accessibility audit (WAVE or axe)
- Test in multiple browsers (Chrome, Firefox, Safari, Edge)
- Test on mobile devices (iOS, Android)
- Verify security headers

### Deployment Considerations

- This is a development repository
- Production deployment requires separate process
- Test all changes locally before pushing
- SEO changes should be validated with tools
- Always backup before major changes
- Document all changes in commit messages with before/after metrics

---

**Last Updated:** 2025-01-15 (Claude AI - Phase 2)
**Document Version:** 1.0
**Status:** Complete
**Next Review:** Phase 3 start

**Author:** Claude Code AI Assistant
**Purpose:** Provide comprehensive project context for all team members and AI assistants working on Hotel Nowy Dwór SEO optimization.
