# Hotel Nowy Dwór – SEO & Performance Optimization

![Status Projektu](https://img.shields.io/badge/status-active-success)
![PageSpeed Goal](https://img.shields.io/badge/PageSpeed_Goal-%3E90-blue)
![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-7957d5)
![Node Version](https://img.shields.io/badge/Node.js-20%2B-5fa04e)

Repozytorium zawiera pełną kopię środowiska WordPress oraz dokumentację operacyjną potrzebną do wdrożenia wniosków z audytu SEO/Performance dla strony [hotelnowydwor.eu](https://www.hotelnowydwor.eu/). Projekt prowadzi zespół **PB MEDIA Strony Sklepy Marketing** z wykorzystaniem agentów AI i automatyzacji CI/CD.

## 🎯 Cele Projektu
- **Wydajność:** osiągnięcie wyniku *PageSpeed Insights Mobile > 90* i LCP < 2.5 s.
- **SEO:** zwiększenie widoczności na frazy lokalne (m.in. „hotel Trzebnica”, „wesele Trzebnica”).
- **Bezpieczeństwo:** pełny hardening WordPress (PB MEDIA standards).
- **Content:** rozbudowa treści sprzedażowych i blogowych (minimum 6 artykułów evergreen).

## 🗂 Struktura Repozytorium
| Katalog / Plik | Opis |
| --- | --- |
| `src/` | Pełne pliki WordPress (motywy, wtyczki, uploads, baza `.sql`). |
| `docs/` | Audyty, roadmapa, polityki bezpieczeństwa, instrukcje kontrybucji. |
| `agents/` | Opisy ról agentów AI używanych w tym projekcie. |
| `prompts/` | Gotowe prompty do audytu SEO, contentu, code review i performance. |
| `scripts/` | Automaty skryptowe (np. `optimize-images.sh`). |
| `templates/` | Wzorce meta tagów, Schema Hotel, struktury Oxygen. |
| `.github/` | Workflows CI/CD: PageSpeed, SEO audit, security scan, deploy.* |
| `AGENTS.md` | Szybka lista ról agentów i kierunków komunikacji. |

> *Workflows wymagają zdefiniowania sekretów: `WPSCAN_API_TOKEN`, `STAGING_*`, `PROD_*` itd.

## ⚙️ Wymagania
- PHP 7.4+ (patrz `.php-version` i `composer.json`).
- Node.js 20+ (patrz `.nvmrc`).
- Composer oraz npm.
- Narzędzia obrazów: `cwebp`, `avifenc`, `jpegoptim`, `optipng` (dla `scripts/optimize-images.sh`).

## 🚀 Szybki Start
```bash
npm install
composer install

# Konwersja obrazów do WebP/AVIF
npm run optimize:images

# Audyt Lighthouse (lokalnie z LHCI)
npm run test:lighthouse

# Kontrola standardów PHP (WPCS)
composer run lint
```

## 🤖 Agenci & Prompty
- Pełna lista ról: [AGENTS.md](AGENTS.md).
- Dedykowane prompty do SEO/content/code review/performance: `prompts/*.md`.
- Zalecane jest adresowanie Issue/PR do konkretnego agenta (np. `@Performance Engineer`).

## 🔁 Automatyzacja CI/CD
| Workflow | Opis |
| --- | --- |
| `pagespeed-test.yml` | Codzienne testy Lighthouse Mobile/Desktop. |
| `seo-audit.yml` | Link checker + Lighthouse SEO. |
| `security-scan.yml` | WPScan + PHPCS (WordPress-Extra). |
| `lighthouse-ci.yml` | Testy regresyjne na PR. |
| `deploy-staging.yml` / `deploy-production.yml` | Automatyczne wdrożenia przez SSH.

## 🧭 Roadmapa & Dokumentacja
- Plan trzy‑miesięczny (Priorytety 1‑3): [docs/ROADMAP.md](docs/ROADMAP.md)
- Zasady kontrybucji: [docs/CONTRIBUTING.md](docs/CONTRIBUTING.md)
- Polityka bezpieczeństwa i zgłaszania podatności: [docs/SECURITY.md](docs/SECURITY.md)
- Historia zmian: [docs/CHANGELOG.md](docs/CHANGELOG.md)

## 📞 Kontakt
**PB MEDIA Strony Sklepy Marketing**  
📧 biuro@pbmedia.pl  
🌐 [pbmediaonline.pl](https://www.pbmediaonline.pl/)
