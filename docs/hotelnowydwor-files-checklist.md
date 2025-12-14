# 📋 Szybka Lista Plików do Utworzenia
## Hotel Nowy Dwór - SEO Optimization Repository

---

## Całkowita liczba plików: **37**

---

## ✅ Lista plików w kolejności tworzenia

### FAZA 1: Pliki podstawowe (4 pliki)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 1 | CODEOWNERS | `.github/CODEOWNERS` | Właściciele kodu |
| 2 | .editorconfig | `.editorconfig` | Formatowanie kodu |
| 3 | CLAUDE.md | `CLAUDE.md` | Główne instrukcje AI |
| 4 | dependabot.yml | `.github/dependabot.yml` | Auto-aktualizacje |

### FAZA 2: Konfiguracja AI (4 pliki)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 5 | instructions.md | `.copilot/instructions.md` | GitHub Copilot |
| 6 | settings.json | `.claude/settings.json` | Ustawienia Claude |
| 7 | CLAUDE.md | `.claude/CLAUDE.md` | Instrukcje Claude |
| 8 | rules.md | `.cursor/rules.md` | Cursor AI |

### FAZA 3: Knowledge Base (4 pliki)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 9 | hotel-info.md | `knowledge/hotel-info.md` | Dane hotelu |
| 10 | project-context.md | `knowledge/project-context.md` | Kontekst projektu |
| 11 | seo-best-practices.md | `knowledge/seo-best-practices.md` | Best practices |
| 12 | wordpress-oxygen-guide.md | `knowledge/wordpress-oxygen-guide.md` | Przewodnik tech |

### FAZA 4: Prompts Library (4 pliki)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 13 | seo-analysis.md | `prompts/seo-analysis.md` | Analiza SEO |
| 14 | content-generation.md | `prompts/content-generation.md` | Generowanie treści |
| 15 | code-review.md | `prompts/code-review.md` | Code review |
| 16 | performance-optimization.md | `prompts/performance-optimization.md` | Optymalizacja |

### FAZA 5: GitHub Actions (6 plików)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 17 | pagespeed-test.yml | `.github/workflows/pagespeed-test.yml` | Testy PageSpeed |
| 18 | security-scan.yml | `.github/workflows/security-scan.yml` | Skan bezpieczeństwa |
| 19 | seo-audit.yml | `.github/workflows/seo-audit.yml` | Audyt SEO |
| 20 | lighthouse-ci.yml | `.github/workflows/lighthouse-ci.yml` | Lighthouse CI |
| 21 | deploy-staging.yml | `.github/workflows/deploy-staging.yml` | Deploy staging |
| 22 | deploy-production.yml | `.github/workflows/deploy-production.yml` | Deploy produkcja |

### FAZA 6: Templates & Agents (8 plików)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 23 | seo_task.md | `.github/ISSUE_TEMPLATE/seo_task.md` | Szablon Issue SEO |
| 24 | bug_report.md | `.github/ISSUE_TEMPLATE/bug_report.md` | Szablon błędu |
| 25 | config.yml | `.github/ISSUE_TEMPLATE/config.yml` | Konfiguracja Issues |
| 26 | PULL_REQUEST_TEMPLATE.md | `.github/PULL_REQUEST_TEMPLATE.md` | Szablon PR |
| 27 | seo-agent.yml | `agents/seo-agent.yml` | Agent SEO |
| 28 | performance-agent.yml | `agents/performance-agent.yml` | Agent wydajności |
| 29 | content-agent.yml | `agents/content-agent.yml` | Agent contentu |
| 30 | security-agent.yml | `agents/security-agent.yml` | Agent bezpieczeństwa |

### FAZA 7: Templates & Scripts (4 pliki)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 31 | blog-post-template.md | `templates/blog-post-template.md` | Szablon posta |
| 32 | seo-report-template.md | `templates/seo-report-template.md` | Szablon raportu |
| 33 | optimize-images.sh | `scripts/optimize-images.sh` | Skrypt obrazów |
| 34 | .nvmrc | `.nvmrc` | Wersja Node.js |

### FAZA 8: Dokumentacja & Config (7 plików)

| # | Plik | Lokalizacja | Cel |
|---|------|-------------|-----|
| 35 | CONTRIBUTING.md | `docs/CONTRIBUTING.md` | Wytyczne |
| 36 | SECURITY.md | `docs/SECURITY.md` | Polityka bezpieczeństwa |
| 37 | CHANGELOG.md | `docs/CHANGELOG.md` | Historia zmian |
| 38 | ROADMAP.md | `docs/ROADMAP.md` | Plan rozwoju |
| 39 | .php-version | `.php-version` | Wersja PHP |
| 40 | package.json | `package.json` | npm config |
| 41 | composer.json | `composer.json` | PHP config |

---

## 📁 Struktura katalogów do utworzenia

```bash
mkdir -p .github/workflows
mkdir -p .github/ISSUE_TEMPLATE
mkdir -p .copilot
mkdir -p .claude
mkdir -p .cursor
mkdir -p agents
mkdir -p knowledge
mkdir -p prompts
mkdir -p templates
mkdir -p docs/reports
mkdir -p src/wp-content/themes
mkdir -p src/wp-content/plugins
mkdir -p dist
mkdir -p text/blog-posts
mkdir -p text/page-content
mkdir -p scripts
```

---

## 🚀 Szybki start (bash)

```bash
# 1. Sklonuj repo
git clone https://github.com/PB-MEDIA-Strony-Sklepy-Marketing/hotelnowydwor-seo-optimization-process.git
cd hotelnowydwor-seo-optimization-process

# 2. Utwórz branch
git checkout -b feature/repo-configuration

# 3. Utwórz katalogi
mkdir -p .github/{workflows,ISSUE_TEMPLATE} .copilot .claude .cursor agents knowledge prompts templates docs/reports src/wp-content/{themes,plugins} dist text/{blog-posts,page-content} scripts

# 4. Kopiuj pliki z przewodnika...

# 5. Commit
git add .
git commit -m "[DOCS] Pełna konfiguracja repozytorium"
git push origin feature/repo-configuration
```

---

## 📌 Priorytety plików

### 🔴 Krytyczne (utworzyć najpierw)
- `CLAUDE.md`
- `.github/CODEOWNERS`
- `.editorconfig`
- `knowledge/hotel-info.md`
- `knowledge/project-context.md`

### 🟡 Ważne (utworzyć w 2. kolejności)
- Wszystkie workflows
- Pliki w `.copilot/`, `.claude/`
- `prompts/`

### 🟢 Pomocnicze (utworzyć na końcu)
- Templates
- Agents
- Dokumentacja w `docs/`

---

*Pełna implementacja każdego pliku znajduje się w głównym przewodniku.*
