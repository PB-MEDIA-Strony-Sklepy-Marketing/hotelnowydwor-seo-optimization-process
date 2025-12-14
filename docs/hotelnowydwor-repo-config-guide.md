# 📁 Kompletny Przewodnik Konfiguracji Repozytorium
## Hotel Nowy Dwór - SEO Optimization Process

**Data:** 14 grudnia 2025  
**Repozytorium:** `hotelnowydwor-seo-optimization-process`  
**Cel:** Konfiguracja wszystkich plików niezbędnych do automatyzacji procesu optymalizacji SEO

---

## 📋 Spis Treści

1. [Wprowadzenie](#wprowadzenie)
2. [Struktura Repozytorium](#struktura-repozytorium)
3. [Kolejność Implementacji Plików](#kolejność-implementacji)
4. [Pliki Konfiguracyjne - Szczegóły](#pliki-konfiguracyjne)
5. [GitHub Actions Workflows](#github-actions-workflows)
6. [Pliki dla AI i Agentów](#pliki-dla-ai-i-agentów)
7. [Pliki Knowledge i Prompts](#pliki-knowledge-i-prompts)
8. [Szablony i Templates](#szablony-i-templates)
9. [Instrukcja Wdrożenia Krok po Kroku](#instrukcja-wdrożenia)

---

## 🎯 Wprowadzenie

Ten przewodnik zawiera kompletną listę wszystkich plików konfiguracyjnych, które należy utworzyć w repozytorium `hotelnowydwor-seo-optimization-process`. Pliki są ułożone w kolejności od najważniejszych do pomocniczych.

### Dlaczego te pliki są potrzebne?

| Kategoria | Cel |
|-----------|-----|
| **GitHub Actions** | Automatyzacja testów, deploymentu i audytów |
| **AI/Agents** | Konfiguracja dla GitHub Copilot i innych AI |
| **Knowledge** | Baza wiedzy o projekcie dla AI |
| **Templates** | Szablony Issues, PR, dokumentacji |
| **Config** | Ustawienia projektu i narzędzi |

---

## 📂 Struktura Repozytorium

Oto docelowa struktura katalogów z wszystkimi plikami do utworzenia:

```
hotelnowydwor-seo-optimization-process/
│
├── .github/                              # [1] GitHub Configuration
│   ├── workflows/                        # GitHub Actions
│   │   ├── seo-audit.yml                # Automatyczny audyt SEO
│   │   ├── pagespeed-test.yml           # Testy PageSpeed
│   │   ├── security-scan.yml            # Skanowanie bezpieczeństwa
│   │   ├── deploy-staging.yml           # Deployment na staging
│   │   ├── deploy-production.yml        # Deployment na produkcję
│   │   └── lighthouse-ci.yml            # Lighthouse CI
│   │
│   ├── ISSUE_TEMPLATE/                  # Szablony Issues
│   │   ├── bug_report.md               
│   │   ├── seo_task.md                  
│   │   ├── performance_issue.md         
│   │   └── config.yml                   
│   │
│   ├── PULL_REQUEST_TEMPLATE.md         # Szablon PR
│   ├── CODEOWNERS                       # Właściciele kodu
│   ├── dependabot.yml                   # Automatyczne aktualizacje
│   └── FUNDING.yml                      # Sponsoring (opcjonalne)
│
├── .copilot/                            # [2] GitHub Copilot Config
│   └── instructions.md                  # Instrukcje dla Copilot
│
├── .cursor/                             # [3] Cursor AI Config
│   └── rules.md                         # Reguły dla Cursor
│
├── .claude/                             # [4] Claude AI Config
│   ├── settings.json                    # Ustawienia Claude
│   └── CLAUDE.md                        # Instrukcje dla Claude
│
├── agents/                              # [5] AI Agents Configuration
│   ├── seo-agent.yml                    # Agent SEO
│   ├── performance-agent.yml            # Agent wydajności
│   ├── security-agent.yml               # Agent bezpieczeństwa
│   └── content-agent.yml                # Agent contentu
│
├── knowledge/                           # [6] Knowledge Base
│   ├── hotel-info.md                    # Informacje o hotelu
│   ├── seo-best-practices.md            # Best practices SEO
│   ├── wordpress-oxygen-guide.md        # Przewodnik WordPress+Oxygen
│   └── project-context.md               # Kontekst projektu
│
├── prompts/                             # [7] Prompts Library
│   ├── seo-analysis.md                  # Prompt do analizy SEO
│   ├── content-generation.md            # Prompt do generowania treści
│   ├── code-review.md                   # Prompt do code review
│   └── performance-optimization.md      # Prompt do optymalizacji
│
├── templates/                           # [8] Document Templates
│   ├── blog-post-template.md            # Szablon posta blogowego
│   ├── seo-report-template.md           # Szablon raportu SEO
│   ├── changelog-template.md            # Szablon changelog
│   └── commit-message-template.txt      # Szablon commit message
│
├── docs/                                # [9] Documentation
│   ├── CONTRIBUTING.md                  # Jak współtworzyć projekt
│   ├── SECURITY.md                      # Polityka bezpieczeństwa
│   ├── CHANGELOG.md                     # Historia zmian
│   ├── ROADMAP.md                       # Plan rozwoju
│   └── reports/                         # Raporty z audytów
│       └── .gitkeep
│
├── src/                                 # [10] Source Files
│   ├── wp-content/
│   │   ├── themes/
│   │   ├── plugins/
│   │   └── uploads/
│   └── .htaccess.template               # Szablon .htaccess
│
├── dist/                                # [11] Distribution
│   └── .gitkeep
│
├── text/                                # [12] SEO Content
│   ├── blog-posts/
│   │   └── .gitkeep
│   └── page-content/
│       └── .gitkeep
│
├── scripts/                             # [13] Automation Scripts
│   ├── optimize-images.sh               # Skrypt optymalizacji obrazów
│   ├── generate-sitemap.sh              # Generator sitemap
│   └── run-lighthouse.sh                # Skrypt Lighthouse
│
├── .editorconfig                        # [14] Editor Configuration
├── .gitignore                           # Git ignore rules
├── .gitattributes                       # Git attributes
├── .nvmrc                               # Node.js version
├── .php-version                         # PHP version
├── .eslintrc.json                       # ESLint config
├── .prettierrc                          # Prettier config
├── composer.json                        # PHP dependencies
├── package.json                         # Node.js dependencies
├── README.md                            # Główna dokumentacja
├── LICENSE                              # Licencja projektu
└── CLAUDE.md                            # Główne instrukcje dla Claude
```

---

## 📌 Kolejność Implementacji

Implementuj pliki w następującej kolejności (od najważniejszych):

### Faza 1: Pliki podstawowe (Dzień 1)
1. `.github/CODEOWNERS`
2. `.editorconfig`
3. `CLAUDE.md` (główny)
4. `.github/dependabot.yml`

### Faza 2: AI Configuration (Dzień 2)
5. `.copilot/instructions.md`
6. `.claude/settings.json`
7. `.claude/CLAUDE.md`
8. `.cursor/rules.md`

### Faza 3: Knowledge Base (Dzień 3)
9. `knowledge/hotel-info.md`
10. `knowledge/project-context.md`
11. `knowledge/seo-best-practices.md`
12. `knowledge/wordpress-oxygen-guide.md`

### Faza 4: Prompts (Dzień 4)
13. `prompts/seo-analysis.md`
14. `prompts/content-generation.md`
15. `prompts/code-review.md`
16. `prompts/performance-optimization.md`

### Faza 5: GitHub Actions (Dzień 5-6)
17. `.github/workflows/pagespeed-test.yml`
18. `.github/workflows/security-scan.yml`
19. `.github/workflows/seo-audit.yml`
20. `.github/workflows/lighthouse-ci.yml`
21. `.github/workflows/deploy-staging.yml`
22. `.github/workflows/deploy-production.yml`

### Faza 6: Templates i Agents (Dzień 7)
23. `.github/ISSUE_TEMPLATE/` (wszystkie)
24. `.github/PULL_REQUEST_TEMPLATE.md`
25. `agents/` (wszystkie)
26. `templates/` (wszystkie)

### Faza 7: Dokumentacja (Dzień 8)
27. `docs/CONTRIBUTING.md`
28. `docs/SECURITY.md`
29. `docs/CHANGELOG.md`
30. `docs/ROADMAP.md`

---

## 📄 Pliki Konfiguracyjne - Szczegóły

### 1. `.github/CODEOWNERS`

**Lokalizacja:** `.github/CODEOWNERS`  
**Cel:** Automatyczne przypisywanie reviewerów do PR

```
# CODEOWNERS - Hotel Nowy Dwór SEO Optimization
# Dokumentacja: https://docs.github.com/en/repositories/managing-your-repositorys-settings-and-features/customizing-your-repository/about-code-owners

# Domyślni właściciele wszystkich plików
*       @PB-MEDIA-Strony-Sklepy-Marketing

# Pliki WordPress
/hotelnowydwor.eu/                       @PB-MEDIA-Strony-Sklepy-Marketing
/src/                                    @PB-MEDIA-Strony-Sklepy-Marketing

# Konfiguracja SEO
*.md                                     @PB-MEDIA-Strony-Sklepy-Marketing
/knowledge/                              @PB-MEDIA-Strony-Sklepy-Marketing
/prompts/                                @PB-MEDIA-Strony-Sklepy-Marketing

# GitHub Actions
/.github/workflows/                      @PB-MEDIA-Strony-Sklepy-Marketing

# Pliki konfiguracyjne
.editorconfig                            @PB-MEDIA-Strony-Sklepy-Marketing
.gitignore                               @PB-MEDIA-Strony-Sklepy-Marketing
```

---

### 2. `.editorconfig`

**Lokalizacja:** `.editorconfig`  
**Cel:** Spójne formatowanie kodu we wszystkich edytorach

```ini
# EditorConfig - Hotel Nowy Dwór SEO Project
# https://editorconfig.org

root = true

# Domyślne ustawienia dla wszystkich plików
[*]
charset = utf-8
end_of_line = lf
indent_style = space
indent_size = 2
insert_final_newline = true
trim_trailing_whitespace = true

# PHP files (WordPress)
[*.php]
indent_size = 4

# JavaScript
[*.{js,jsx,ts,tsx}]
indent_size = 2

# CSS/SCSS
[*.{css,scss,sass}]
indent_size = 2

# Markdown
[*.md]
trim_trailing_whitespace = false
max_line_length = off

# YAML (GitHub Actions, configs)
[*.{yml,yaml}]
indent_size = 2

# JSON
[*.json]
indent_size = 2

# Shell scripts
[*.sh]
indent_size = 4
shell_variant = bash

# Makefiles
[Makefile]
indent_style = tab

# WordPress specific
[wp-config.php]
indent_size = 4

# .htaccess
[.htaccess]
indent_style = tab
```

---

### 3. `.github/dependabot.yml`

**Lokalizacja:** `.github/dependabot.yml`  
**Cel:** Automatyczne aktualizacje zależności

```yaml
# Dependabot configuration
# https://docs.github.com/en/code-security/dependabot/dependabot-version-updates/configuration-options-for-the-dependabot.yml-file

version: 2

updates:
  # GitHub Actions
  - package-ecosystem: "github-actions"
    directory: "/"
    schedule:
      interval: "weekly"
      day: "monday"
      time: "09:00"
      timezone: "Europe/Warsaw"
    commit-message:
      prefix: "[ACTIONS]"
    labels:
      - "dependencies"
      - "github-actions"
    reviewers:
      - "PB-MEDIA-Strony-Sklepy-Marketing"

  # npm dependencies (jeśli używane)
  - package-ecosystem: "npm"
    directory: "/"
    schedule:
      interval: "weekly"
      day: "monday"
      time: "09:00"
      timezone: "Europe/Warsaw"
    commit-message:
      prefix: "[NPM]"
    labels:
      - "dependencies"
      - "javascript"
    open-pull-requests-limit: 5

  # Composer (PHP/WordPress)
  - package-ecosystem: "composer"
    directory: "/"
    schedule:
      interval: "weekly"
      day: "monday"
      time: "09:00"
      timezone: "Europe/Warsaw"
    commit-message:
      prefix: "[COMPOSER]"
    labels:
      - "dependencies"
      - "php"
    open-pull-requests-limit: 5
```

---

### 4. `CLAUDE.md` (Główny plik w root)

**Lokalizacja:** `CLAUDE.md`  
**Cel:** Główne instrukcje dla Claude AI przy pracy z repozytorium

```markdown
# CLAUDE.md - Hotel Nowy Dwór SEO Optimization

## 🎯 Cel Projektu

To repozytorium służy do optymalizacji SEO strony hotelu https://www.hotelnowydwor.eu/
opartej na WordPress z page builderem Oxygen.

## 📋 Kluczowe Cele (3 miesiące)

1. **PageSpeed ≥ 90 punktów** (mobile i desktop)
2. **Wyższe pozycje w Google** dla fraz hotelowych
3. **Lepszy UI/UX** zgodny z WCAG 2.1 AA
4. **6+ postów blogowych** o tematyce hotelarskiej
5. **Pełna optymalizacja SEO** wszystkich podstron

## 📁 Struktura Projektu

```
/hotelnowydwor.eu/    → Pliki WordPress (źródłowe)
/src/                  → Zmodyfikowane pliki do wdrożenia
/dist/                 → Gotowe pliki produkcyjne
/docs/                 → Dokumentacja i raporty
/text/                 → Treści SEO i posty blogowe
/knowledge/            → Baza wiedzy projektu
/prompts/              → Biblioteka promptów
```

## 🏨 Dane Hotelu

- **Nazwa:** Hotel "Nowy Dwór" Artur Balczun
- **Adres:** ul. Nowy Dwór 2, 55-100 Trzebnica
- **Telefon:** +48 71 312 07 14
- **E-mail:** rezerwacja@hotelnowydwor.eu
- **Strona:** https://www.hotelnowydwor.eu

## 🎨 Kolory Motywu

- Primary: `#0a97b0`
- Secondary: `#000000`
- Hover: `#000000`
- Background: `#ffffff`
- Second Background: `#f7f7f7`

## 📌 Hierarchia Priorytetów

### PRIORYTET 1 - Bezpieczeństwo i Wydajność (Miesiąc 1)
- [ ] Implementacja zabezpieczeń PB MEDIA
- [ ] HTTPS na wszystkich zasobach
- [ ] Kompresja GZIP/Brotli
- [ ] Konwersja obrazów WebP/AVIF
- [ ] Cache przeglądarki
- [ ] Minimalizacja CSS/JS

### PRIORYTET 2 - SEO i Content (Miesiąc 2)
- [ ] Meta tagi na wszystkich stronach
- [ ] Schema.org dla hotelu
- [ ] Hierarchia nagłówków H1-H6
- [ ] Content SEO na podstronach
- [ ] 6 postów blogowych

### PRIORYTET 3 - Integracje i Porządki (Miesiąc 3)
- [ ] Google Search Console + Analytics 4
- [ ] Naprawa błędów indeksowania
- [ ] Usunięcie podstron NFHotel
- [ ] Sitemap.xml i robots.txt
- [ ] Finalne testy

## ⚙️ Technologie

- **CMS:** WordPress 6.x
- **Page Builder:** Oxygen Builder
- **Snippety PHP:** WPCode Lite
- **Wtyczki:** ACF PRO, MainWP Child, OxyExtras

## 📝 Konwencja Commit Messages

Format: `[KATEGORIA] Krótki opis - szczegóły`

Kategorie:
- `[SEO]` - optymalizacja SEO
- `[PERFORMANCE]` - wydajność
- `[SECURITY]` - bezpieczeństwo
- `[ACCESSIBILITY]` - dostępność
- `[UX]` - user experience
- `[CONTENT]` - treści
- `[FIX]` - naprawy błędów

Przykład:
```
[PERFORMANCE] Kompresja GZIP - redukcja rozmiaru o 70%
```

## 🔗 Kluczowe Pliki

- `/audyt-strony.md` - Pełny audyt SEO
- `/pozycjonowanie-stron-i-sklepow-SEO-instructions.md` - Instrukcje SEO
- `/knowledge/hotel-info.md` - Dane hotelu
- `/knowledge/project-context.md` - Kontekst projektu

## ⚠️ Ważne Zasady

1. **NIE** modyfikuj plików bez zrozumienia kontekstu
2. **ZAWSZE** testuj zmiany przed commitem
3. **DOKUMENTUJ** każdą zmianę w commit message
4. **PRZESTRZEGAJ** kolejności priorytetów
5. **SPRAWDZAJ** PageSpeed po każdej zmianie wydajnościowej
```

---

## 🤖 Pliki dla AI i Agentów

### 5. `.copilot/instructions.md`

**Lokalizacja:** `.copilot/instructions.md`  
**Cel:** Instrukcje dla GitHub Copilot

```markdown
# GitHub Copilot Instructions
# Hotel Nowy Dwór SEO Optimization Project

## Context

This repository contains WordPress files for Hotel "Nowy Dwór" website optimization.
The main goal is to achieve PageSpeed score ≥90 and improve Google rankings.

## Technology Stack

- WordPress 6.x with Oxygen Builder (no traditional theme)
- PHP 8.x
- WPCode Lite for PHP snippets
- Plugins: ACF PRO, MainWP Child, OxyExtras

## Code Style Guidelines

### PHP
- Use WordPress coding standards
- Indent with 4 spaces
- Add PHPDoc comments for functions
- Prefix custom functions with `hnd_` (Hotel Nowy Dwór)

### CSS
- Mobile-first approach
- Use CSS custom properties for colors
- Breakpoints: 576px, 768px, 992px, 1200px

### JavaScript
- ES6+ syntax preferred
- Use async/await for promises
- Add JSDoc comments

## SEO Requirements

When generating code, always consider:
1. Semantic HTML5 structure
2. Proper heading hierarchy (one H1 per page)
3. Alt attributes for all images
4. Schema.org markup where applicable
5. Performance optimization (lazy loading, minification)

## Hotel Data

Use these values when needed:
- Name: Hotel "Nowy Dwór"
- Address: ul. Nowy Dwór 2, 55-100 Trzebnica
- Phone: +48 71 312 07 14
- Email: rezerwacja@hotelnowydwor.eu
- Primary Color: #0a97b0

## File Locations

- Source files: `/hotelnowydwor.eu/` and `/src/`
- Output files: `/dist/`
- Documentation: `/docs/`
- SEO content: `/text/`

## Do NOT

- Generate code that breaks WordPress functionality
- Skip security considerations
- Ignore performance implications
- Use deprecated PHP/JS functions
- Hardcode URLs without checking environment
```

---

### 6. `.claude/settings.json`

**Lokalizacja:** `.claude/settings.json`  
**Cel:** Ustawienia Claude AI dla projektu

```json
{
  "version": "1.0",
  "project": {
    "name": "Hotel Nowy Dwór SEO Optimization",
    "type": "wordpress-seo",
    "language": "pl",
    "framework": "wordpress-oxygen"
  },
  "context": {
    "primary_files": [
      "CLAUDE.md",
      "audyt-strony.md",
      "pozycjonowanie-stron-i-sklepow-SEO-instructions.md"
    ],
    "knowledge_base": "knowledge/",
    "prompts_library": "prompts/"
  },
  "preferences": {
    "code_style": "wordpress",
    "commit_format": "[CATEGORY] Description - details",
    "documentation_language": "pl",
    "code_comments_language": "en"
  },
  "priorities": {
    "1": {
      "name": "Security & Performance",
      "deadline": "month_1",
      "target": "PageSpeed >= 90"
    },
    "2": {
      "name": "SEO & Content",
      "deadline": "month_2",
      "target": "6 blog posts, meta tags"
    },
    "3": {
      "name": "Integrations & Cleanup",
      "deadline": "month_3",
      "target": "Google tools, final tests"
    }
  },
  "hotel_data": {
    "name": "Hotel Nowy Dwór",
    "owner": "Artur Balczun",
    "address": {
      "street": "ul. Nowy Dwór 2",
      "postal_code": "55-100",
      "city": "Trzebnica",
      "country": "PL"
    },
    "contact": {
      "phone": "+48 71 312 07 14",
      "email": "rezerwacja@hotelnowydwor.eu"
    },
    "website": "https://www.hotelnowydwor.eu"
  },
  "theme_colors": {
    "primary": "#0a97b0",
    "secondary": "#000000",
    "hover": "#000000",
    "background": "#ffffff",
    "background_alt": "#f7f7f7"
  }
}
```

---

### 7. `.claude/CLAUDE.md`

**Lokalizacja:** `.claude/CLAUDE.md`  
**Cel:** Szczegółowe instrukcje dla Claude w tym folderze

```markdown
# Claude AI Configuration

## Quick Reference

This file provides Claude-specific instructions for this project.
See root `CLAUDE.md` for full project context.

## Working with This Repository

### Before Making Changes

1. Read `/audyt-strony.md` for current audit findings
2. Check `/knowledge/project-context.md` for status
3. Verify which PRIORITY phase we're in
4. Review relevant prompts in `/prompts/`

### Making Code Changes

1. Always work in `/src/` directory
2. Test changes locally before committing
3. Use proper commit message format
4. Update `/docs/CHANGELOG.md`

### Generating Content

1. Use prompts from `/prompts/content-generation.md`
2. Follow SEO guidelines from `/knowledge/seo-best-practices.md`
3. Save blog posts to `/text/blog-posts/`
4. Save page content to `/text/page-content/`

## File Naming Conventions

- Blog posts: `YYYY-MM-DD-title-slug.md`
- Reports: `report-type-YYYY-MM-DD.md`
- Configs: `lowercase-with-dashes.ext`

## Quality Checklist

Before completing any task:
- [ ] Code follows WordPress standards
- [ ] SEO impact considered
- [ ] Performance tested
- [ ] Accessibility verified
- [ ] Documentation updated
```

---

### 8. `.cursor/rules.md`

**Lokalizacja:** `.cursor/rules.md`  
**Cel:** Reguły dla Cursor AI Editor

```markdown
# Cursor AI Rules
# Hotel Nowy Dwór SEO Project

## Project Type
WordPress SEO Optimization with Oxygen Builder

## Language
- Documentation: Polish (pl)
- Code comments: English (en)
- Commit messages: Polish (pl)

## Code Patterns

### PHP Functions
```php
/**
 * Function description
 *
 * @param string $param Description
 * @return mixed Description
 */
function hnd_function_name($param) {
    // Implementation
}
```

### CSS Classes
```css
/* Mobile-first */
.hnd-component {
    /* Base styles */
}

@media (min-width: 768px) {
    .hnd-component {
        /* Tablet styles */
    }
}
```

## File Structure Rules

1. WordPress files → `/hotelnowydwor.eu/` or `/src/`
2. Static assets → `/dist/`
3. Documentation → `/docs/`
4. Content → `/text/`

## Priority Order

Always follow: PRIORITY 1 → 2 → 3
Check current phase before starting work.

## SEO Requirements

Every HTML change must consider:
- Semantic structure
- Heading hierarchy
- Alt texts
- Schema markup
- Performance impact

## Forbidden Actions

- Modifying core WordPress files
- Removing existing functionality without backup
- Committing without testing
- Ignoring security implications
```

---

## 🔄 GitHub Actions Workflows

### 9. `.github/workflows/pagespeed-test.yml`

**Lokalizacja:** `.github/workflows/pagespeed-test.yml`  
**Cel:** Automatyczne testy PageSpeed przy każdym PR

```yaml
name: PageSpeed Insights Test

on:
  pull_request:
    branches: [main]
  push:
    branches: [main]
  schedule:
    # Codziennie o 6:00 rano
    - cron: '0 6 * * *'
  workflow_dispatch:

env:
  SITE_URL: https://www.hotelnowydwor.eu

jobs:
  pagespeed:
    name: Run PageSpeed Test
    runs-on: ubuntu-latest
    
    steps:
      - name: Checkout repository
        uses: actions/checkout@v4

      - name: Setup Node.js
        uses: actions/setup-node@v4
        with:
          node-version: '20'

      - name: Install dependencies
        run: npm install -g psi

      - name: Run PageSpeed - Mobile
        id: psi-mobile
        continue-on-error: true
        run: |
          echo "## 📱 Mobile PageSpeed Results" >> $GITHUB_STEP_SUMMARY
          psi ${{ env.SITE_URL }} --strategy=mobile --format=json > mobile-results.json
          MOBILE_SCORE=$(cat mobile-results.json | jq '.lighthouseResult.categories.performance.score * 100')
          echo "Mobile Score: $MOBILE_SCORE" >> $GITHUB_STEP_SUMMARY
          echo "MOBILE_SCORE=$MOBILE_SCORE" >> $GITHUB_OUTPUT

      - name: Run PageSpeed - Desktop
        id: psi-desktop
        continue-on-error: true
        run: |
          echo "## 🖥️ Desktop PageSpeed Results" >> $GITHUB_STEP_SUMMARY
          psi ${{ env.SITE_URL }} --strategy=desktop --format=json > desktop-results.json
          DESKTOP_SCORE=$(cat desktop-results.json | jq '.lighthouseResult.categories.performance.score * 100')
          echo "Desktop Score: $DESKTOP_SCORE" >> $GITHUB_STEP_SUMMARY
          echo "DESKTOP_SCORE=$DESKTOP_SCORE" >> $GITHUB_OUTPUT

      - name: Check Score Threshold
        run: |
          MOBILE=${{ steps.psi-mobile.outputs.MOBILE_SCORE }}
          DESKTOP=${{ steps.psi-desktop.outputs.DESKTOP_SCORE }}
          
          echo "Mobile: $MOBILE | Desktop: $DESKTOP"
          
          if [ "$MOBILE" -lt 90 ] || [ "$DESKTOP" -lt 90 ]; then
            echo "⚠️ Score below 90 threshold!"
            echo "::warning::PageSpeed score below target (90)"
          else
            echo "✅ All scores meet the 90+ threshold!"
          fi

      - name: Upload Results
        uses: actions/upload-artifact@v4
        with:
          name: pagespeed-results-${{ github.run_number }}
          path: |
            mobile-results.json
            desktop-results.json
          retention-days: 30

      - name: Comment PR with Results
        if: github.event_name == 'pull_request'
        uses: actions/github-script@v7
        with:
          script: |
            const fs = require('fs');
            const mobile = JSON.parse(fs.readFileSync('mobile-results.json', 'utf8'));
            const desktop = JSON.parse(fs.readFileSync('desktop-results.json', 'utf8'));
            
            const mobileScore = Math.round(mobile.lighthouseResult.categories.performance.score * 100);
            const desktopScore = Math.round(desktop.lighthouseResult.categories.performance.score * 100);
            
            const getEmoji = (score) => score >= 90 ? '✅' : score >= 50 ? '⚠️' : '🔴';
            
            const body = `## 📊 PageSpeed Insights Results
            
            | Device | Score | Status |
            |--------|-------|--------|
            | 📱 Mobile | ${mobileScore} | ${getEmoji(mobileScore)} |
            | 🖥️ Desktop | ${desktopScore} | ${getEmoji(desktopScore)} |
            
            **Target:** ≥90 points
            
            [View full report](https://pagespeed.web.dev/report?url=${{ env.SITE_URL }})`;
            
            github.rest.issues.createComment({
              issue_number: context.issue.number,
              owner: context.repo.owner,
              repo: context.repo.repo,
              body: body
            });
```

---

### 10. `.github/workflows/security-scan.yml`

**Lokalizacja:** `.github/workflows/security-scan.yml`  
**Cel:** Skanowanie bezpieczeństwa plików WordPress

```yaml
name: Security Scan

on:
  push:
    branches: [main]
    paths:
      - '**.php'
      - '**.js'
      - '.htaccess*'
  pull_request:
    branches: [main]
    paths:
      - '**.php'
      - '**.js'
      - '.htaccess*'
  schedule:
    # Co tydzień w poniedziałek o 8:00
    - cron: '0 8 * * 1'
  workflow_dispatch:

jobs:
  security-scan:
    name: Security Analysis
    runs-on: ubuntu-latest
    
    steps:
      - name: Checkout code
        uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          tools: composer

      - name: Install PHP Security Checker
        run: |
          composer global require enlightn/security-checker

      - name: Run PHP Security Check
        continue-on-error: true
        run: |
          echo "## 🔒 PHP Security Scan" >> $GITHUB_STEP_SUMMARY
          if [ -f "composer.lock" ]; then
            ~/.composer/vendor/bin/security-checker security:check composer.lock >> $GITHUB_STEP_SUMMARY || true
          else
            echo "No composer.lock found - skipping dependency check" >> $GITHUB_STEP_SUMMARY
          fi

      - name: Scan for Common Vulnerabilities
        run: |
          echo "## 🔍 Vulnerability Patterns Scan" >> $GITHUB_STEP_SUMMARY
          
          # Szukaj niebezpiecznych funkcji PHP
          echo "### Checking for dangerous PHP functions..." >> $GITHUB_STEP_SUMMARY
          
          DANGEROUS_PATTERNS="eval\(|exec\(|system\(|passthru\(|shell_exec\(|popen\(|proc_open\("
          
          if grep -rn --include="*.php" -E "$DANGEROUS_PATTERNS" . 2>/dev/null; then
            echo "⚠️ Found potentially dangerous functions!" >> $GITHUB_STEP_SUMMARY
          else
            echo "✅ No dangerous functions found" >> $GITHUB_STEP_SUMMARY
          fi

      - name: Check .htaccess Security
        run: |
          echo "## 📄 .htaccess Security Check" >> $GITHUB_STEP_SUMMARY
          
          HTACCESS_FILES=$(find . -name ".htaccess*" -o -name "*.htaccess" 2>/dev/null)
          
          if [ -n "$HTACCESS_FILES" ]; then
            for file in $HTACCESS_FILES; do
              echo "Checking: $file" >> $GITHUB_STEP_SUMMARY
              
              # Sprawdź czy ma podstawowe zabezpieczenia
              if grep -q "X-Frame-Options" "$file"; then
                echo "✅ X-Frame-Options present" >> $GITHUB_STEP_SUMMARY
              else
                echo "⚠️ Missing X-Frame-Options" >> $GITHUB_STEP_SUMMARY
              fi
              
              if grep -q "X-Content-Type-Options" "$file"; then
                echo "✅ X-Content-Type-Options present" >> $GITHUB_STEP_SUMMARY
              else
                echo "⚠️ Missing X-Content-Type-Options" >> $GITHUB_STEP_SUMMARY
              fi
            done
          else
            echo "No .htaccess files found" >> $GITHUB_STEP_SUMMARY
          fi

      - name: Generate Security Report
        run: |
          echo "---" >> $GITHUB_STEP_SUMMARY
          echo "📅 Scan completed: $(date)" >> $GITHUB_STEP_SUMMARY
```

---

### 11. `.github/workflows/seo-audit.yml`

**Lokalizacja:** `.github/workflows/seo-audit.yml`  
**Cel:** Automatyczny audyt SEO strony

```yaml
name: SEO Audit

on:
  schedule:
    # Co tydzień w środę o 10:00
    - cron: '0 10 * * 3'
  workflow_dispatch:
    inputs:
      full_audit:
        description: 'Run full comprehensive audit'
        required: false
        default: 'false'
        type: boolean

env:
  SITE_URL: https://www.hotelnowydwor.eu

jobs:
  seo-audit:
    name: Run SEO Audit
    runs-on: ubuntu-latest
    
    steps:
      - name: Checkout repository
        uses: actions/checkout@v4

      - name: Setup Node.js
        uses: actions/setup-node@v4
        with:
          node-version: '20'

      - name: Install SEO Tools
        run: |
          npm install -g lighthouse
          npm install -g unlighthouse

      - name: Run Lighthouse SEO Audit
        run: |
          mkdir -p reports
          lighthouse ${{ env.SITE_URL }} \
            --only-categories=seo,accessibility,best-practices \
            --output=json \
            --output-path=./reports/lighthouse-seo.json \
            --chrome-flags="--headless --no-sandbox"

      - name: Parse SEO Results
        id: seo-results
        run: |
          SEO_SCORE=$(cat reports/lighthouse-seo.json | jq '.categories.seo.score * 100')
          A11Y_SCORE=$(cat reports/lighthouse-seo.json | jq '.categories.accessibility.score * 100')
          BP_SCORE=$(cat reports/lighthouse-seo.json | jq '.categories["best-practices"].score * 100')
          
          echo "SEO_SCORE=$SEO_SCORE" >> $GITHUB_OUTPUT
          echo "A11Y_SCORE=$A11Y_SCORE" >> $GITHUB_OUTPUT
          echo "BP_SCORE=$BP_SCORE" >> $GITHUB_OUTPUT
          
          echo "## 📈 SEO Audit Results" >> $GITHUB_STEP_SUMMARY
          echo "" >> $GITHUB_STEP_SUMMARY
          echo "| Category | Score |" >> $GITHUB_STEP_SUMMARY
          echo "|----------|-------|" >> $GITHUB_STEP_SUMMARY
          echo "| 🔍 SEO | $SEO_SCORE |" >> $GITHUB_STEP_SUMMARY
          echo "| ♿ Accessibility | $A11Y_SCORE |" >> $GITHUB_STEP_SUMMARY
          echo "| ✅ Best Practices | $BP_SCORE |" >> $GITHUB_STEP_SUMMARY

      - name: Check Meta Tags
        run: |
          echo "## 🏷️ Meta Tags Check" >> $GITHUB_STEP_SUMMARY
          
          # Pobierz stronę główną
          curl -s ${{ env.SITE_URL }} > homepage.html
          
          # Sprawdź title
          TITLE=$(grep -oP '(?<=<title>).*(?=</title>)' homepage.html | head -1)
          echo "**Title:** $TITLE" >> $GITHUB_STEP_SUMMARY
          
          # Sprawdź meta description
          META_DESC=$(grep -oP '(?<=<meta name="description" content=").*(?=")' homepage.html | head -1)
          if [ -n "$META_DESC" ]; then
            echo "**Meta Description:** $META_DESC" >> $GITHUB_STEP_SUMMARY
          else
            echo "⚠️ **Meta Description:** Missing!" >> $GITHUB_STEP_SUMMARY
          fi

      - name: Upload Audit Reports
        uses: actions/upload-artifact@v4
        with:
          name: seo-audit-${{ github.run_number }}
          path: reports/
          retention-days: 90

      - name: Create Issue if Score Low
        if: steps.seo-results.outputs.SEO_SCORE < 80
        uses: actions/github-script@v7
        with:
          script: |
            const title = `⚠️ SEO Score Alert: ${${{ steps.seo-results.outputs.SEO_SCORE }}} points`;
            const body = `## SEO Audit Alert
            
            The latest SEO audit found issues that need attention.
            
            **Scores:**
            - 🔍 SEO: ${{ steps.seo-results.outputs.SEO_SCORE }}
            - ♿ Accessibility: ${{ steps.seo-results.outputs.A11Y_SCORE }}
            - ✅ Best Practices: ${{ steps.seo-results.outputs.BP_SCORE }}
            
            **Target:** ≥80 for all categories
            
            Please review the audit report and address the issues.
            
            ---
            *Automated by SEO Audit Workflow*`;
            
            github.rest.issues.create({
              owner: context.repo.owner,
              repo: context.repo.repo,
              title: title,
              body: body,
              labels: ['seo', 'automated', 'needs-attention']
            });
```

---

### 12. `.github/workflows/lighthouse-ci.yml`

**Lokalizacja:** `.github/workflows/lighthouse-ci.yml`  
**Cel:** Pełny raport Lighthouse przy każdym PR

```yaml
name: Lighthouse CI

on:
  pull_request:
    branches: [main]
  push:
    branches: [main]

env:
  SITE_URL: https://www.hotelnowydwor.eu

jobs:
  lighthouse:
    name: Lighthouse Audit
    runs-on: ubuntu-latest
    
    steps:
      - name: Checkout
        uses: actions/checkout@v4

      - name: Setup Node.js
        uses: actions/setup-node@v4
        with:
          node-version: '20'

      - name: Install Lighthouse CI
        run: npm install -g @lhci/cli

      - name: Create LHCI Config
        run: |
          cat > lighthouserc.json << 'EOF'
          {
            "ci": {
              "collect": {
                "url": ["${{ env.SITE_URL }}", "${{ env.SITE_URL }}/pokoje/", "${{ env.SITE_URL }}/kontakt/"],
                "numberOfRuns": 3,
                "settings": {
                  "preset": "desktop"
                }
              },
              "assert": {
                "assertions": {
                  "categories:performance": ["warn", {"minScore": 0.9}],
                  "categories:accessibility": ["warn", {"minScore": 0.9}],
                  "categories:best-practices": ["warn", {"minScore": 0.9}],
                  "categories:seo": ["warn", {"minScore": 0.9}]
                }
              },
              "upload": {
                "target": "temporary-public-storage"
              }
            }
          }
          EOF

      - name: Run Lighthouse CI
        run: lhci autorun
        continue-on-error: true

      - name: Upload Lighthouse Results
        uses: actions/upload-artifact@v4
        with:
          name: lighthouse-results-${{ github.run_number }}
          path: .lighthouseci/
          retention-days: 30
```

---

### 13. `.github/workflows/deploy-staging.yml`

**Lokalizacja:** `.github/workflows/deploy-staging.yml`  
**Cel:** Deployment na środowisko stagingowe

```yaml
name: Deploy to Staging

on:
  push:
    branches: [develop]
  workflow_dispatch:

jobs:
  deploy-staging:
    name: Deploy to Staging Server
    runs-on: ubuntu-latest
    environment: staging
    
    steps:
      - name: Checkout repository
        uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'

      - name: Validate PHP Syntax
        run: |
          find . -name "*.php" -type f | head -50 | xargs -I {} php -l {} || true

      - name: Prepare Deployment Package
        run: |
          mkdir -p deploy-package
          
          # Kopiuj pliki WordPress
          if [ -d "src" ]; then
            cp -r src/* deploy-package/
          fi
          
          if [ -d "hotelnowydwor.eu" ]; then
            cp -r hotelnowydwor.eu/* deploy-package/
          fi
          
          # Usuń niepotrzebne pliki
          find deploy-package -name ".git*" -delete
          find deploy-package -name "*.md" -delete
          find deploy-package -name ".DS_Store" -delete
          
          echo "📦 Deployment package created"
          ls -la deploy-package/

      - name: Deploy to Staging (SFTP)
        uses: wlixcc/SFTP-Deploy-Action@v1.2.4
        with:
          username: ${{ secrets.STAGING_SFTP_USER }}
          server: ${{ secrets.STAGING_SFTP_HOST }}
          ssh_private_key: ${{ secrets.STAGING_SSH_KEY }}
          local_path: './deploy-package/*'
          remote_path: '/var/www/staging.hotelnowydwor.eu/'
          sftpArgs: '-o ConnectTimeout=5'

      - name: Verify Deployment
        run: |
          echo "## 🚀 Staging Deployment Complete" >> $GITHUB_STEP_SUMMARY
          echo "URL: https://staging.hotelnowydwor.eu" >> $GITHUB_STEP_SUMMARY
          echo "Time: $(date)" >> $GITHUB_STEP_SUMMARY

      - name: Notify on Failure
        if: failure()
        run: |
          echo "❌ Deployment to staging failed!"
```

---

### 14. `.github/workflows/deploy-production.yml`

**Lokalizacja:** `.github/workflows/deploy-production.yml`  
**Cel:** Deployment na produkcję (wymaga approval)

```yaml
name: Deploy to Production

on:
  push:
    branches: [main]
    tags:
      - 'v*'
  workflow_dispatch:
    inputs:
      confirm:
        description: 'Type "DEPLOY" to confirm production deployment'
        required: true

jobs:
  validate:
    name: Validate Deployment
    runs-on: ubuntu-latest
    outputs:
      should_deploy: ${{ steps.check.outputs.deploy }}
    
    steps:
      - name: Check Confirmation
        id: check
        run: |
          if [[ "${{ github.event_name }}" == "workflow_dispatch" ]]; then
            if [[ "${{ github.event.inputs.confirm }}" == "DEPLOY" ]]; then
              echo "deploy=true" >> $GITHUB_OUTPUT
            else
              echo "deploy=false" >> $GITHUB_OUTPUT
              echo "❌ Invalid confirmation. Type 'DEPLOY' to proceed."
              exit 1
            fi
          else
            echo "deploy=true" >> $GITHUB_OUTPUT
          fi

  pre-deploy-tests:
    name: Pre-deployment Tests
    needs: validate
    if: needs.validate.outputs.should_deploy == 'true'
    runs-on: ubuntu-latest
    
    steps:
      - name: Checkout
        uses: actions/checkout@v4

      - name: Run PageSpeed Test
        run: |
          npm install -g psi
          psi https://www.hotelnowydwor.eu --strategy=mobile || true

      - name: Check Website Availability
        run: |
          STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://www.hotelnowydwor.eu)
          if [ "$STATUS" != "200" ]; then
            echo "⚠️ Website returned status $STATUS"
          fi

  deploy-production:
    name: Deploy to Production
    needs: pre-deploy-tests
    runs-on: ubuntu-latest
    environment: production
    
    steps:
      - name: Checkout repository
        uses: actions/checkout@v4

      - name: Create Backup Tag
        run: |
          BACKUP_TAG="backup-$(date +%Y%m%d-%H%M%S)"
          echo "Creating backup tag: $BACKUP_TAG"
          git tag $BACKUP_TAG || true

      - name: Prepare Production Package
        run: |
          mkdir -p production-package
          
          # Kopiuj tylko zoptymalizowane pliki
          if [ -d "dist" ]; then
            cp -r dist/* production-package/
          fi
          
          echo "📦 Production package ready"

      - name: Deploy to Production (SFTP)
        uses: wlixcc/SFTP-Deploy-Action@v1.2.4
        with:
          username: ${{ secrets.PROD_SFTP_USER }}
          server: ${{ secrets.PROD_SFTP_HOST }}
          ssh_private_key: ${{ secrets.PROD_SSH_KEY }}
          local_path: './production-package/*'
          remote_path: '/var/www/hotelnowydwor.eu/'
          sftpArgs: '-o ConnectTimeout=5'

      - name: Clear Cache (if applicable)
        run: |
          # Tutaj można dodać komendę czyszczenia cache
          echo "Cache cleared"

      - name: Post-deployment Verification
        run: |
          sleep 30
          STATUS=$(curl -s -o /dev/null -w "%{http_code}" https://www.hotelnowydwor.eu)
          if [ "$STATUS" == "200" ]; then
            echo "✅ Production deployment successful!"
          else
            echo "⚠️ Website returned status $STATUS - please verify manually"
          fi

      - name: Create Summary
        run: |
          echo "## 🎉 Production Deployment Complete" >> $GITHUB_STEP_SUMMARY
          echo "" >> $GITHUB_STEP_SUMMARY
          echo "**URL:** https://www.hotelnowydwor.eu" >> $GITHUB_STEP_SUMMARY
          echo "**Time:** $(date)" >> $GITHUB_STEP_SUMMARY
          echo "**Commit:** ${{ github.sha }}" >> $GITHUB_STEP_SUMMARY
```

---

## 📚 Pliki Knowledge i Prompts

### 15. `knowledge/hotel-info.md`

**Lokalizacja:** `knowledge/hotel-info.md`  
**Cel:** Pełne informacje o hotelu dla AI

```markdown
# Hotel Nowy Dwór - Informacje

## Dane Podstawowe

- **Pełna nazwa:** Hotel "Nowy Dwór" Artur Balczun
- **Strona:** https://www.hotelnowydwor.eu
- **NIP:** [do uzupełnienia]

## Lokalizacja

- **Adres:** ul. Nowy Dwór 2
- **Kod pocztowy:** 55-100
- **Miasto:** Trzebnica
- **Województwo:** dolnośląskie
- **Kraj:** Polska

### Współrzędne GPS
- Szerokość: 51.3095° N
- Długość: 17.0631° E

### Dojazd
- Z Wrocławia: ~25 km, około 30 minut
- Najbliższe lotnisko: Port Lotniczy Wrocław (30 km)
- Dworzec PKP Trzebnica: 1.5 km

## Kontakt

- **Telefon:** +48 71 312 07 14
- **E-mail:** rezerwacja@hotelnowydwor.eu
- **Recepcja:** czynna 24/7

## Opis Hotelu

Hotel "Nowy Dwór" to kameralny obiekt położony w malowniczej Trzebnicy, 
znanej z Bazyliki św. Jadwigi Śląskiej. Hotel oferuje komfortowe pokoje, 
restaurację z kuchnią polską i międzynarodową oraz doskonałą lokalizację 
dla gości biznesowych i turystów.

### Udogodnienia
- Bezpłatne WiFi
- Bezpłatny parking
- Restauracja
- Sala konferencyjna
- Recepcja 24h
- Ogród

### Typy pokoi
1. Pokój jednoosobowy
2. Pokój dwuosobowy
3. Pokój rodzinny
4. Apartament

## Atrakcje w okolicy

1. **Bazylika św. Jadwigi Śląskiej** - 1 km
2. **Muzeum Regionalne** - 1.2 km
3. **Park Miejski** - 0.5 km
4. **Kąpielisko "Leśna"** - 3 km
5. **Las Bukowy** - 2 km

## Słowa kluczowe SEO

### Główne frazy
- hotel Trzebnica
- noclegi Trzebnica
- hotel Nowy Dwór
- hotel blisko Wrocławia

### Długi ogon (long-tail)
- tani hotel w Trzebnicy
- hotel z restauracją Trzebnica
- nocleg blisko Bazyliki św. Jadwigi
- hotel biznesowy Trzebnica
- weekend w Trzebnicy hotel

### Frazy lokalne
- hotel 25 km od Wrocławia
- noclegi dolnośląskie
- hotel na wesele Trzebnica
- sala konferencyjna Trzebnica
```

---

### 16. `knowledge/project-context.md`

**Lokalizacja:** `knowledge/project-context.md`  
**Cel:** Kontekst projektu i status prac

```markdown
# Kontekst Projektu - SEO Optimization

## Status Projektu

**Data rozpoczęcia:** [data]  
**Deadline:** 3 miesiące od rozpoczęcia  
**Aktualny etap:** PRIORYTET 1

## Zakres Prac

### Cel główny
Osiągnięcie wyników:
1. PageSpeed ≥ 90 punktów (mobile i desktop)
2. Wyższe pozycje w Google
3. 6 postów blogowych
4. Pełna optymalizacja SEO

### Technologia
- WordPress 6.x
- Oxygen Builder (page builder)
- Brak tradycyjnego motywu
- WPCode Lite (snippety PHP)

### Kluczowe wtyczki
1. Advanced Custom Fields PRO
2. MainWP Child
3. OxyExtras
4. Oxygen Attributes
5. Oxygen Gutenberg Integration
6. WPCode Lite

## Problemy z audytu

### Krytyczne 🔴
- Brak meta description
- Niezoptymalizowane obrazy (brak WebP/AVIF)
- Brak kompresji GZIP
- Nieresponsywny design na mobile
- Podstrony w języku angielskim (NFHotel)

### Ważne 🟡
- Błędy w logach serwera
- Brak schema.org
- Słaba hierarchia nagłówków
- Brak postów blogowych
- Niezintegrowane Google Analytics

### Drobne 🟢
- Brak sitemap.xml
- Nieoptymalne robots.txt
- Brak Skip Navigation

## Postęp Prac

### PRIORYTET 1 - Bezpieczeństwo i Wydajność
- [ ] Zabezpieczenia PB MEDIA
- [ ] HTTPS na wszystkich zasobach
- [ ] Kompresja GZIP/Brotli
- [ ] Cache przeglądarki
- [ ] Konwersja obrazów WebP/AVIF
- [ ] Minimalizacja CSS/JS

### PRIORYTET 2 - SEO i Content
- [ ] Meta tagi
- [ ] Schema.org
- [ ] Hierarchia nagłówków
- [ ] Content SEO na podstronach
- [ ] Posty blogowe (0/6)

### PRIORYTET 3 - Integracje
- [ ] Google Search Console
- [ ] Google Analytics 4
- [ ] Google Tag Manager
- [ ] Sitemap.xml
- [ ] Naprawa błędów indeksowania

## Metryki do monitorowania

| Metryka | Wartość bazowa | Cel | Aktualna |
|---------|---------------|-----|----------|
| PageSpeed Mobile | ? | ≥90 | ? |
| PageSpeed Desktop | ? | ≥90 | ? |
| SEO Score | ? | ≥90 | ? |
| Accessibility | ? | ≥90 | ? |
| Liczba postów | 0 | 6 | 0 |

## Kontakty

- **Właściciel projektu:** PB MEDIA
- **Email:** biuro@pbmediaonline.pl
- **Tel:** +48 695 816 068
```

---

### 17. `knowledge/seo-best-practices.md`

**Lokalizacja:** `knowledge/seo-best-practices.md`  
**Cel:** Best practices SEO dla tego projektu

```markdown
# SEO Best Practices - Hotel Nowy Dwór

## 1. Meta Tagi

### Title Tag
- Długość: 50-60 znaków
- Format: `Słowo kluczowe - Nazwa hotelu | Lokalizacja`
- Przykład: `Hotel Nowy Dwór Trzebnica - Komfortowe Noclegi blisko Wrocławia`

### Meta Description
- Długość: 150-160 znaków
- Zawiera CTA (Call to Action)
- Przykład: `Hotel Nowy Dwór w Trzebnicy oferuje komfortowe pokoje, restaurację i parking. Rezerwuj online! ☎ +48 71 312 07 14`

### Meta Keywords (dla referencji)
- hotel trzebnica
- noclegi trzebnica
- hotel nowy dwór
- hotel blisko wrocławia

## 2. Struktura Nagłówków

```
H1: Jeden na stronę (nazwa strony/tytuł)
  H2: Główne sekcje
    H3: Podsekcje
      H4: Szczegóły
```

### Przykład dla strony głównej:
```html
<h1>Hotel Nowy Dwór - Komfortowe Noclegi w Trzebnicy</h1>
  <h2>Nasze Pokoje</h2>
    <h3>Pokój Jednoosobowy</h3>
    <h3>Pokój Dwuosobowy</h3>
  <h2>Restauracja</h2>
  <h2>Lokalizacja</h2>
```

## 3. Schema.org

### Hotel Schema
```json
{
  "@context": "https://schema.org",
  "@type": "Hotel",
  "name": "Hotel Nowy Dwór",
  "description": "Komfortowy hotel w Trzebnicy...",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Nowy Dwór 2",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressCountry": "PL"
  },
  "telephone": "+48713120714",
  "email": "rezerwacja@hotelnowydwor.eu",
  "url": "https://www.hotelnowydwor.eu",
  "priceRange": "$$",
  "starRating": {
    "@type": "Rating",
    "ratingValue": "3"
  },
  "amenityFeature": [
    {"@type": "LocationFeatureSpecification", "name": "Free WiFi"},
    {"@type": "LocationFeatureSpecification", "name": "Free Parking"},
    {"@type": "LocationFeatureSpecification", "name": "Restaurant"}
  ]
}
```

## 4. Optymalizacja Obrazów

### Format
- Preferowany: WebP (Android) / AVIF (Apple)
- Fallback: JPEG

### Implementacja
```html
<picture>
  <source srcset="image.avif" type="image/avif">
  <source srcset="image.webp" type="image/webp">
  <img src="image.jpg" alt="Opis obrazu" loading="lazy" width="800" height="600">
</picture>
```

### Alt teksty
- Opisowe, zawierające słowa kluczowe
- Przykład: `Przytulny pokój dwuosobowy w Hotelu Nowy Dwór Trzebnica`

## 5. Linkowanie Wewnętrzne

### Struktura
```
Strona główna
├── /pokoje/
│   ├── /pokoje/jednoosobowy/
│   ├── /pokoje/dwuosobowy/
│   └── /pokoje/apartament/
├── /restauracja/
│   └── /restauracja/menu/
├── /o-nas/
├── /galeria/
├── /kontakt/
└── /blog/
    ├── /blog/post-1/
    └── /blog/post-2/
```

### Anchor text
- Używaj opisowych anchor textów
- Unikaj "kliknij tutaj", "więcej"
- Przykład: `Sprawdź nasze [pokoje dwuosobowe](/pokoje/dwuosobowy/)`

## 6. Core Web Vitals

### Cele
- LCP (Largest Contentful Paint): < 2.5s
- FID (First Input Delay): < 100ms
- CLS (Cumulative Layout Shift): < 0.1

### Techniki optymalizacji
1. Lazy loading obrazów
2. Preload krytycznych zasobów
3. Kompresja GZIP/Brotli
4. Cache przeglądarki
5. Minimalizacja CSS/JS

## 7. Mobile-First

### Breakpoints
```css
/* Mobile first */
/* Base styles for mobile */

@media (min-width: 576px) { /* Small */ }
@media (min-width: 768px) { /* Medium */ }
@media (min-width: 992px) { /* Large */ }
@media (min-width: 1200px) { /* Extra large */ }
```

### Touch targets
- Minimum: 44x44px
- Padding: minimum 8px

## 8. Lokalne SEO

### Google My Business
- Aktualne dane kontaktowe
- Godziny otwarcia
- Zdjęcia
- Odpowiadanie na opinie

### NAP Consistency
Name, Address, Phone muszą być identyczne wszędzie:
- Strona www
- Google My Business
- Katalogi firm
- Social media
```

---

### 18. `prompts/seo-analysis.md`

**Lokalizacja:** `prompts/seo-analysis.md`  
**Cel:** Prompt do analizy SEO strony

```markdown
# Prompt: SEO Analysis

## Użycie
Użyj tego promptu do przeprowadzenia analizy SEO konkretnej podstrony.

## Prompt

```
Przeprowadź kompleksową analizę SEO dla strony: [URL]

## Kontekst
- Strona należy do Hotelu Nowy Dwór w Trzebnicy
- WordPress + Oxygen Builder
- Cel: PageSpeed ≥90, pozycje w Google dla fraz hotelowych

## Przeanalizuj:

### 1. Meta Tagi
- Title tag (długość, słowa kluczowe)
- Meta description (długość, CTA)
- Meta viewport
- Canonical URL

### 2. Struktura HTML
- Hierarchia nagłówków H1-H6
- Semantyczne znaczniki (header, nav, main, footer)
- Struktura DOM

### 3. Content
- Gęstość słów kluczowych
- Długość treści
- Unikalność
- Czytelność (Flesch-Kincaid)

### 4. Linki
- Linki wewnętrzne (anchor text, kontekst)
- Linki zewnętrzne (rel attributes)
- Broken links

### 5. Obrazy
- Alt teksty
- Format (WebP/AVIF/JPEG)
- Rozmiar/waga
- Lazy loading

### 6. Schema.org
- Obecność structured data
- Poprawność implementacji
- Sugerowane typy

### 7. Performance
- Rozmiar strony
- Liczba requestów
- Render-blocking resources

## Format odpowiedzi:

### Podsumowanie
[Krótkie podsumowanie stanu SEO]

### Problemy krytyczne 🔴
[Lista z opisem i wpływem na SEO]

### Do poprawy 🟡
[Lista z opisem i priorytetem]

### Rekomendacje 🟢
[Konkretne działania do podjęcia]

### Przykłady kodu
[Gotowe snippety do wdrożenia]
```

## Przykład użycia

```
Przeprowadź analizę SEO dla: https://www.hotelnowydwor.eu/pokoje/
```
```

---

### 19. `prompts/content-generation.md`

**Lokalizacja:** `prompts/content-generation.md`  
**Cel:** Prompt do generowania treści SEO

```markdown
# Prompt: Content Generation

## Użycie
Użyj tego promptu do generowania treści SEO dla strony hotelu.

## Prompt dla postów blogowych

```
Napisz post blogowy dla Hotelu Nowy Dwór w Trzebnicy.

## Temat
[Temat posta]

## Parametry
- Długość: minimum 800 słów
- Język: polski
- Ton: profesjonalny, przyjazny, zachęcający
- Grupa docelowa: turyści, goście biznesowi, pary, rodziny

## Struktura
1. **Tytuł** - chwytliwy, zawierający słowo kluczowe (50-60 znaków)
2. **Lead** - 2-3 zdania wprowadzające
3. **Treść główna** - podzielona na sekcje z H2/H3
4. **Podsumowanie** - CTA zachęcające do rezerwacji
5. **Meta description** - 150-160 znaków

## Słowa kluczowe do uwzględnienia
- hotel Trzebnica
- noclegi Trzebnica
- Hotel Nowy Dwór
- [dodatkowe dla tematu]

## Linkowanie wewnętrzne
Uwzględnij linki do:
- /pokoje/
- /restauracja/
- /kontakt/
- /galeria/

## Dane kontaktowe
- Tel: +48 71 312 07 14
- Email: rezerwacja@hotelnowydwor.eu
- Adres: ul. Nowy Dwór 2, 55-100 Trzebnica

## Format output
Zwróć w formacie Markdown gotowym do publikacji.
```

## Prompt dla treści podstron

```
Napisz treść SEO dla podstrony: [nazwa podstrony]

## Cel strony
[Opis celu]

## Wymagania
- 300-500 słów
- Naturalne użycie słów kluczowych
- Zgodność z brandingiem hotelu
- CTA na końcu

## Aktualna treść (jeśli istnieje)
[Aktualna treść do rozbudowania]
```

## Tematy na posty blogowe

1. "10 atrakcji turystycznych w okolicy Trzebnicy"
2. "Bazylika św. Jadwigi - historia i zwiedzanie"
3. "Weekend we dwoje w Trzebnicy - co zobaczyć?"
4. "Trzebnica - idealne miejsce na biznesowe spotkania"
5. "Najlepsze restauracje w Trzebnicy - przewodnik"
6. "Aktywny wypoczynek w okolicach Trzebnicy"
```

---

## 📋 Szablony i Templates

### 20. `.github/ISSUE_TEMPLATE/seo_task.md`

**Lokalizacja:** `.github/ISSUE_TEMPLATE/seo_task.md`  
**Cel:** Szablon dla zadań SEO

```markdown
---
name: "🔍 Zadanie SEO"
about: "Nowe zadanie związane z optymalizacją SEO"
title: "[SEO] "
labels: ["seo"]
assignees: []
---

## 📋 Opis zadania

<!-- Opisz co należy zrobić -->

## 🎯 Cel

<!-- Jaki efekt chcemy osiągnąć? -->

## 📍 Lokalizacja

- **URL strony:** 
- **Pliki do modyfikacji:** 

## ✅ Checklist

- [ ] Analiza obecnego stanu
- [ ] Implementacja zmian
- [ ] Test na staging
- [ ] Weryfikacja PageSpeed
- [ ] Dokumentacja zmian

## 📊 Metryki sukcesu

<!-- Jak zmierzymy sukces? -->

## 🔗 Powiązane

<!-- Linki do powiązanych issues, dokumentacji -->

## 📌 Priorytet

- [ ] PRIORYTET 1 - Bezpieczeństwo i Wydajność
- [ ] PRIORYTET 2 - SEO i Content
- [ ] PRIORYTET 3 - Integracje i Porządki
```

---

### 21. `.github/ISSUE_TEMPLATE/bug_report.md`

**Lokalizacja:** `.github/ISSUE_TEMPLATE/bug_report.md`  
**Cel:** Szablon zgłaszania błędów

```markdown
---
name: "🐛 Zgłoszenie błędu"
about: "Zgłoś błąd na stronie lub w kodzie"
title: "[BUG] "
labels: ["bug"]
assignees: []
---

## 🐛 Opis błędu

<!-- Opisz błąd jasno i zwięźle -->

## 🔄 Kroki reprodukcji

1. Wejdź na '...'
2. Kliknij w '...'
3. Przewiń do '...'
4. Pojawia się błąd

## ✅ Oczekiwane zachowanie

<!-- Co powinno się wydarzyć? -->

## ❌ Aktualne zachowanie

<!-- Co się dzieje zamiast tego? -->

## 📸 Zrzuty ekranu

<!-- Jeśli to możliwe, dodaj zrzuty ekranu -->

## 🌐 Środowisko

- **URL:** 
- **Przeglądarka:** 
- **Urządzenie:** 
- **System:** 

## 📝 Dodatkowy kontekst

<!-- Inne informacje, które mogą pomóc -->

## 📊 Wpływ na SEO/Performance

- [ ] Może wpływać na PageSpeed
- [ ] Może wpływać na SEO
- [ ] Może wpływać na dostępność
- [ ] Brak wpływu
```

---

### 22. `.github/ISSUE_TEMPLATE/config.yml`

**Lokalizacja:** `.github/ISSUE_TEMPLATE/config.yml`  
**Cel:** Konfiguracja szablonów Issues

```yaml
blank_issues_enabled: false
contact_links:
  - name: 📧 Kontakt
    url: mailto:biuro@pbmediaonline.pl
    about: Skontaktuj się bezpośrednio z zespołem PB MEDIA
  - name: 📖 Dokumentacja
    url: https://github.com/PB-MEDIA-Strony-Sklepy-Marketing/hotelnowydwor-seo-optimization-process/wiki
    about: Sprawdź dokumentację projektu
  - name: 🌐 Strona hotelu
    url: https://www.hotelnowydwor.eu
    about: Odwiedź stronę Hotel Nowy Dwór
```

---

### 23. `.github/PULL_REQUEST_TEMPLATE.md`

**Lokalizacja:** `.github/PULL_REQUEST_TEMPLATE.md`  
**Cel:** Szablon Pull Request

```markdown
## 📋 Opis zmian

<!-- Opisz wprowadzone zmiany -->

## 🎯 Związane Issues

Closes #

## 📌 Typ zmian

- [ ] 🔒 Bezpieczeństwo (PRIORYTET 1)
- [ ] ⚡ Wydajność (PRIORYTET 1)
- [ ] 🔍 SEO (PRIORYTET 2)
- [ ] 