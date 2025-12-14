# 📁 Kompletny Przewodnik Konfiguracji - Część 2
## Hotel Nowy Dwór - SEO Optimization Process

---

## 📋 Kontynuacja Plików Konfiguracyjnych

### 23. `.github/PULL_REQUEST_TEMPLATE.md` (dokończenie)

**Lokalizacja:** `.github/PULL_REQUEST_TEMPLATE.md`

```markdown
## 📋 Opis zmian

<!-- Opisz wprowadzone zmiany -->

## 🎯 Związane Issues

Closes #

## 📌 Typ zmian

- [ ] 🔒 Bezpieczeństwo (PRIORYTET 1)
- [ ] ⚡ Wydajność (PRIORYTET 1)
- [ ] 🔍 SEO (PRIORYTET 2)
- [ ] 📝 Content (PRIORYTET 2)
- [ ] 🔧 Integracje (PRIORYTET 3)
- [ ] 🐛 Naprawa błędu
- [ ] 📚 Dokumentacja

## ✅ Checklist

### Przed merge:
- [ ] Kod zgodny z WordPress coding standards
- [ ] Przetestowano na środowisku lokalnym/staging
- [ ] Sprawdzono wpływ na PageSpeed
- [ ] Sprawdzono SEO (meta tagi, nagłówki)
- [ ] Sprawdzono responsywność (mobile)
- [ ] Sprawdzono dostępność (WCAG)
- [ ] Zaktualizowano dokumentację
- [ ] Commit messages zgodne z konwencją

### Testy:
- [ ] PageSpeed Mobile: ___
- [ ] PageSpeed Desktop: ___
- [ ] Lighthouse SEO: ___
- [ ] Lighthouse Accessibility: ___

## 📸 Zrzuty ekranu

### Przed:
<!-- Zrzut ekranu przed zmianami -->

### Po:
<!-- Zrzut ekranu po zmianach -->

## 📊 Wpływ na metryki

| Metryka | Przed | Po | Zmiana |
|---------|-------|-----|--------|
| PageSpeed Mobile | | | |
| PageSpeed Desktop | | | |
| SEO Score | | | |

## 📝 Notatki dla reviewera

<!-- Dodatkowe informacje dla osoby przeglądającej PR -->

## ⚠️ Potencjalne ryzyka

<!-- Opisz potencjalne ryzyka związane z tymi zmianami -->
```

---

### 24. `agents/seo-agent.yml`

**Lokalizacja:** `agents/seo-agent.yml`  
**Cel:** Konfiguracja agenta SEO dla automatyzacji

```yaml
# SEO Agent Configuration
# Hotel Nowy Dwór SEO Optimization

name: seo-agent
version: "1.0"
description: "Agent do automatycznej analizy i optymalizacji SEO"

# Kontekst projektu
context:
  project: "Hotel Nowy Dwór"
  website: "https://www.hotelnowydwor.eu"
  technology: "WordPress + Oxygen Builder"
  
# Cele agenta
goals:
  primary:
    - "Osiągnięcie PageSpeed ≥90 punktów"
    - "Poprawa pozycji w Google"
    - "Optymalizacja meta tagów"
    - "Implementacja Schema.org"
  secondary:
    - "Monitoring konkurencji"
    - "Analiza słów kluczowych"
    - "Raportowanie postępów"

# Pliki źródłowe wiedzy
knowledge_sources:
  - path: "knowledge/hotel-info.md"
    priority: high
  - path: "knowledge/seo-best-practices.md"
    priority: high
  - path: "knowledge/project-context.md"
    priority: high
  - path: "audyt-strony.md"
    priority: critical
  - path: "pozycjonowanie-stron-i-sklepow-SEO-instructions.md"
    priority: critical

# Prompty do użycia
prompts:
  analysis: "prompts/seo-analysis.md"
  content: "prompts/content-generation.md"
  code_review: "prompts/code-review.md"

# Zadania cykliczne
scheduled_tasks:
  - name: "weekly-seo-audit"
    schedule: "0 10 * * 3"  # Środa 10:00
    action: "run_seo_audit"
    
  - name: "daily-pagespeed-check"
    schedule: "0 6 * * *"  # Codziennie 6:00
    action: "check_pagespeed"
    
  - name: "monthly-ranking-report"
    schedule: "0 9 1 * *"  # Pierwszy dzień miesiąca 9:00
    action: "generate_ranking_report"

# Wyzwalacze
triggers:
  on_pr:
    - check_meta_tags
    - validate_heading_structure
    - check_image_optimization
  on_push:
    - run_lighthouse
    - update_metrics

# Słowa kluczowe do monitorowania
keywords:
  primary:
    - "hotel trzebnica"
    - "noclegi trzebnica"
    - "hotel nowy dwór"
  secondary:
    - "hotel blisko wrocławia"
    - "tani hotel trzebnica"
    - "restauracja trzebnica"
    - "sala konferencyjna trzebnica"

# Konkurencja
competitors:
  - name: "Hotel & Restauracja Piast"
    url: "example.com"
  - name: "Pensjonat Trzebnica"
    url: "example.com"

# Limity i progi
thresholds:
  pagespeed_mobile_min: 90
  pagespeed_desktop_min: 90
  seo_score_min: 80
  accessibility_min: 90
  
# Alerty
alerts:
  - condition: "pagespeed < 90"
    action: "create_github_issue"
    severity: "high"
  - condition: "seo_score < 80"
    action: "send_notification"
    severity: "medium"
```

---

### 25. `agents/performance-agent.yml`

**Lokalizacja:** `agents/performance-agent.yml`  
**Cel:** Agent do monitorowania wydajności

```yaml
# Performance Agent Configuration
# Hotel Nowy Dwór SEO Optimization

name: performance-agent
version: "1.0"
description: "Agent do monitorowania i optymalizacji wydajności strony"

# Cele
goals:
  - "PageSpeed Mobile ≥90"
  - "PageSpeed Desktop ≥90"
  - "LCP < 2.5s"
  - "FID < 100ms"
  - "CLS < 0.1"
  - "TTFB < 600ms"

# Metryki do monitorowania
metrics:
  core_web_vitals:
    - name: "LCP"
      target: "<2.5s"
      critical: ">4s"
    - name: "FID"
      target: "<100ms"
      critical: ">300ms"
    - name: "CLS"
      target: "<0.1"
      critical: ">0.25"
  
  additional:
    - name: "TTFB"
      target: "<600ms"
    - name: "FCP"
      target: "<1.8s"
    - name: "TTI"
      target: "<3.8s"
    - name: "Speed Index"
      target: "<3.4s"

# Strony do testowania
test_urls:
  - url: "https://www.hotelnowydwor.eu/"
    name: "Strona główna"
    priority: critical
  - url: "https://www.hotelnowydwor.eu/pokoje/"
    name: "Pokoje"
    priority: high
  - url: "https://www.hotelnowydwor.eu/kontakt/"
    name: "Kontakt"
    priority: high
  - url: "https://www.hotelnowydwor.eu/restauracja/"
    name: "Restauracja"
    priority: medium
  - url: "https://www.hotelnowydwor.eu/galeria/"
    name: "Galeria"
    priority: medium

# Optymalizacje do sprawdzenia
optimizations:
  images:
    - "WebP/AVIF format"
    - "Lazy loading"
    - "Responsive images"
    - "Correct dimensions"
  
  assets:
    - "CSS minification"
    - "JS minification"
    - "GZIP/Brotli compression"
    - "Browser caching"
  
  rendering:
    - "Critical CSS inline"
    - "Defer non-critical JS"
    - "Preload key resources"
    - "Font optimization"

# Harmonogram testów
schedule:
  full_audit: "weekly"
  quick_check: "daily"
  real_time_monitoring: false

# Raportowanie
reporting:
  format: "markdown"
  destination: "docs/reports/"
  include_screenshots: true
  compare_with_previous: true
```

---

### 26. `agents/content-agent.yml`

**Lokalizacja:** `agents/content-agent.yml`  
**Cel:** Agent do generowania i zarządzania treściami

```yaml
# Content Agent Configuration
# Hotel Nowy Dwór SEO Optimization

name: content-agent
version: "1.0"
description: "Agent do generowania i zarządzania treściami SEO"

# Cele
goals:
  - "6 postów blogowych minimum"
  - "Content SEO na wszystkich podstronach"
  - "Optymalizacja istniejących treści"
  - "Spójny tone of voice"

# Ton i styl
brand_voice:
  tone: "profesjonalny, przyjazny, zachęcający"
  language: "pl"
  avoid:
    - "zbyt formalny język"
    - "żargon techniczny"
    - "negatywne sformułowania"
  include:
    - "zaproszenia do działania"
    - "lokalne odniesienia"
    - "korzyści dla gościa"

# Słowa kluczowe
keywords:
  primary:
    - keyword: "hotel trzebnica"
      density: "1-2%"
    - keyword: "noclegi trzebnica"
      density: "1-2%"
    - keyword: "hotel nowy dwór"
      density: "1%"
  
  secondary:
    - "hotel blisko wrocławia"
    - "pokoje hotelowe trzebnica"
    - "restauracja trzebnica"
    - "weekend w trzebnicy"
    - "atrakcje trzebnica"

# Plan treści - Posty blogowe
blog_posts:
  - title: "10 atrakcji turystycznych w okolicy Trzebnicy"
    keywords: ["atrakcje trzebnica", "co zobaczyć trzebnica"]
    status: "planned"
    priority: high
    
  - title: "Bazylika św. Jadwigi Śląskiej - historia i zwiedzanie"
    keywords: ["bazylika trzebnica", "św jadwiga"]
    status: "planned"
    priority: high
    
  - title: "Weekend we dwoje w Trzebnicy - romantyczny przewodnik"
    keywords: ["weekend trzebnica", "romantyczny weekend"]
    status: "planned"
    priority: medium
    
  - title: "Trzebnica dla biznesu - konferencje i spotkania"
    keywords: ["sala konferencyjna trzebnica", "hotel biznesowy"]
    status: "planned"
    priority: medium
    
  - title: "Aktywny wypoczynek w okolicach Trzebnicy"
    keywords: ["aktywny wypoczynek", "rowery trzebnica"]
    status: "planned"
    priority: low
    
  - title: "Kuchnia regionalna w Restauracji Nowy Dwór"
    keywords: ["restauracja trzebnica", "kuchnia śląska"]
    status: "planned"
    priority: low

# Struktura treści
content_structure:
  blog_post:
    min_words: 800
    max_words: 1500
    sections:
      - "Lead (2-3 zdania)"
      - "Treść główna (H2/H3)"
      - "Podsumowanie z CTA"
    required:
      - "Meta title (50-60 znaków)"
      - "Meta description (150-160 znaków)"
      - "Min. 1 wewnętrzny link"
      - "Min. 1 zewnętrzny link (opcjonalnie)"
  
  page_content:
    min_words: 300
    max_words: 800
    required:
      - "Główne słowo kluczowe w H1"
      - "Naturalny tekst"
      - "CTA"

# Podstrony do uzupełnienia
pages_to_update:
  - url: "/faq/"
    current_words: 0
    target_words: 500
    priority: high
  - url: "/galeria/"
    current_words: 0
    target_words: 300
    priority: medium
  - url: "/o-nas/"
    current_words: 0
    target_words: 500
    priority: high
  - url: "/pokoje/"
    current_words: 0
    target_words: 600
    priority: critical
  - url: "/restauracja/menu/"
    current_words: 0
    target_words: 400
    priority: medium

# Output
output:
  directory: "text/"
  blog_posts_dir: "text/blog-posts/"
  page_content_dir: "text/page-content/"
  format: "markdown"
  naming: "YYYY-MM-DD-slug.md"
```

---

### 27. `templates/blog-post-template.md`

**Lokalizacja:** `templates/blog-post-template.md`  
**Cel:** Szablon posta blogowego

```markdown
---
title: "[TYTUŁ POSTA - 50-60 znaków]"
slug: "[slug-posta]"
date: YYYY-MM-DD
author: "Hotel Nowy Dwór"
category: "[kategoria]"
tags: ["tag1", "tag2", "tag3"]
meta_description: "[Meta description - 150-160 znaków z CTA]"
featured_image: "/images/blog/[nazwa-obrazu].webp"
featured_image_alt: "[Opis alternatywny obrazu]"
status: "draft"
---

# [Tytuł H1 - zawiera główne słowo kluczowe]

[Lead - 2-3 zdania wprowadzające, zawierające słowo kluczowe. 
Powinien zachęcać do dalszego czytania i jasno określać, 
czego czytelnik się dowie.]

## [Nagłówek H2 - pierwsza sekcja]

[Treść pierwszej sekcji. Pamiętaj o naturalnym użyciu słów kluczowych.
Pisz w sposób angażujący i przystępny. Każdy akapit powinien mieć
3-5 zdań.]

[Kolejny akapit z wartościową treścią...]

### [Opcjonalny H3 dla podsekcji]

[Treść podsekcji jeśli potrzebna...]

## [Nagłówek H2 - druga sekcja]

[Treść drugiej sekcji...]

> **Wskazówka:** [Opcjonalny cytat lub tip dla czytelnika]

## [Nagłówek H2 - trzecia sekcja]

[Treść trzeciej sekcji...]

**Lista korzyści/punktów:**
- Punkt pierwszy
- Punkt drugi
- Punkt trzeci

## Podsumowanie

[Krótkie podsumowanie artykułu. Podkreśl najważniejsze wnioski
i przejdź do CTA.]

---

**Zaplanuj swój pobyt w Hotelu Nowy Dwór!**

Skontaktuj się z nami:
- 📞 Tel: +48 71 312 07 14
- 📧 Email: rezerwacja@hotelnowydwor.eu
- 📍 Adres: ul. Nowy Dwór 2, 55-100 Trzebnica

[Zarezerwuj teraz](/kontakt/) i odkryj urok Trzebnicy!

---

*Powiązane artykuły:*
- [Link do powiązanego artykułu 1](/blog/artykul-1/)
- [Link do powiązanego artykułu 2](/blog/artykul-2/)
```

---

### 28. `templates/seo-report-template.md`

**Lokalizacja:** `templates/seo-report-template.md`  
**Cel:** Szablon raportu SEO

```markdown
# 📊 Raport SEO - Hotel Nowy Dwór

**Data raportu:** YYYY-MM-DD  
**Okres:** [Data początkowa] - [Data końcowa]  
**Autor:** [Imię/System]

---

## 📈 Podsumowanie Wykonawcze

| Metryka | Poprzednio | Aktualnie | Zmiana |
|---------|------------|-----------|--------|
| PageSpeed Mobile | | | |
| PageSpeed Desktop | | | |
| SEO Score | | | |
| Accessibility | | | |
| Best Practices | | | |

### Status realizacji celów

- [ ] PageSpeed ≥90 Mobile
- [ ] PageSpeed ≥90 Desktop
- [ ] SEO Score ≥80
- [ ] 6 postów blogowych

---

## 🔍 Analiza SEO

### Meta Tagi

| Strona | Title | Description | Status |
|--------|-------|-------------|--------|
| Strona główna | | | ✅/❌ |
| /pokoje/ | | | ✅/❌ |
| /kontakt/ | | | ✅/❌ |
| /restauracja/ | | | ✅/❌ |

### Struktura Nagłówków

[Analiza hierarchii H1-H6 na głównych stronach]

### Schema.org

- [ ] Hotel Schema zaimplementowane
- [ ] LocalBusiness Schema
- [ ] BreadcrumbList

---

## ⚡ Wydajność

### Core Web Vitals

| Metryka | Mobile | Desktop | Cel | Status |
|---------|--------|---------|-----|--------|
| LCP | | | <2.5s | |
| FID | | | <100ms | |
| CLS | | | <0.1 | |

### Optymalizacje

- [ ] Kompresja GZIP/Brotli
- [ ] Cache przeglądarki
- [ ] Obrazy WebP/AVIF
- [ ] Lazy loading
- [ ] Minifikacja CSS/JS

---

## 📝 Content

### Posty blogowe

| Tytuł | Data | Status | Słowa |
|-------|------|--------|-------|
| | | Draft/Published | |

### Treści na podstronach

| Strona | Obecne słowa | Cel | Status |
|--------|--------------|-----|--------|
| /faq/ | | 500 | |
| /o-nas/ | | 500 | |
| /pokoje/ | | 600 | |

---

## 🔒 Bezpieczeństwo

- [ ] HTTPS na wszystkich zasobach
- [ ] Security headers
- [ ] Aktualne wtyczki
- [ ] Zabezpieczenia PB MEDIA

---

## 📋 Rekomendacje

### Priorytet Wysoki 🔴

1. [Rekomendacja 1]
2. [Rekomendacja 2]

### Priorytet Średni 🟡

1. [Rekomendacja 1]
2. [Rekomendacja 2]

### Priorytet Niski 🟢

1. [Rekomendacja 1]
2. [Rekomendacja 2]

---

## 📅 Plan na następny okres

| Zadanie | Deadline | Odpowiedzialny |
|---------|----------|----------------|
| | | |

---

*Raport wygenerowany: YYYY-MM-DD HH:MM*  
*Następny raport: YYYY-MM-DD*
```

---

### 29. `scripts/optimize-images.sh`

**Lokalizacja:** `scripts/optimize-images.sh`  
**Cel:** Skrypt do optymalizacji obrazów

```bash
#!/bin/bash
#
# optimize-images.sh
# Skrypt do optymalizacji obrazów dla Hotel Nowy Dwór
# Konwertuje obrazy do WebP i AVIF z fallbackiem JPEG
#

set -e

# Kolory dla outputu
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Konfiguracja
INPUT_DIR="${1:-./hotelnowydwor.eu/wp-content/uploads}"
OUTPUT_DIR="${2:-./dist/wp-content/uploads}"
QUALITY_WEBP=80
QUALITY_AVIF=65
QUALITY_JPEG=85
MAX_WIDTH=1920

echo -e "${GREEN}🖼️  Optymalizacja obrazów - Hotel Nowy Dwór${NC}"
echo "================================================"
echo "Input:  $INPUT_DIR"
echo "Output: $OUTPUT_DIR"
echo ""

# Sprawdź wymagane narzędzia
check_dependencies() {
    local missing=0
    
    if ! command -v cwebp &> /dev/null; then
        echo -e "${RED}❌ cwebp nie jest zainstalowany${NC}"
        echo "   Zainstaluj: sudo apt-get install webp"
        missing=1
    fi
    
    if ! command -v convert &> /dev/null; then
        echo -e "${RED}❌ ImageMagick nie jest zainstalowany${NC}"
        echo "   Zainstaluj: sudo apt-get install imagemagick"
        missing=1
    fi
    
    if ! command -v avifenc &> /dev/null; then
        echo -e "${YELLOW}⚠️  avifenc nie jest zainstalowany (opcjonalnie)${NC}"
        echo "   Zainstaluj: sudo apt-get install libavif-bin"
    fi
    
    if [ $missing -eq 1 ]; then
        exit 1
    fi
}

# Optymalizuj pojedynczy obraz
optimize_image() {
    local input_file="$1"
    local relative_path="${input_file#$INPUT_DIR/}"
    local output_base="$OUTPUT_DIR/${relative_path%.*}"
    local output_dir=$(dirname "$output_base")
    
    # Utwórz katalog wyjściowy
    mkdir -p "$output_dir"
    
    local filename=$(basename "$input_file")
    echo -n "  Processing: $filename... "
    
    # Konwertuj do WebP
    cwebp -q $QUALITY_WEBP "$input_file" -o "${output_base}.webp" 2>/dev/null
    
    # Konwertuj do AVIF (jeśli dostępne)
    if command -v avifenc &> /dev/null; then
        avifenc --min 0 --max 63 -a end-usage=q -a cq-level=30 "$input_file" "${output_base}.avif" 2>/dev/null || true
    fi
    
    # Zoptymalizuj JPEG jako fallback
    convert "$input_file" -quality $QUALITY_JPEG -resize "${MAX_WIDTH}x${MAX_WIDTH}>" "${output_base}.jpg"
    
    # Pokaż oszczędności
    local original_size=$(stat -f%z "$input_file" 2>/dev/null || stat -c%s "$input_file")
    local webp_size=$(stat -f%z "${output_base}.webp" 2>/dev/null || stat -c%s "${output_base}.webp")
    local savings=$(( (original_size - webp_size) * 100 / original_size ))
    
    echo -e "${GREEN}✓${NC} WebP: -${savings}%"
}

# Główna funkcja
main() {
    check_dependencies
    
    # Znajdź wszystkie obrazy
    local count=0
    local total=$(find "$INPUT_DIR" -type f \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.png" \) | wc -l)
    
    echo -e "${YELLOW}Znaleziono $total obrazów do optymalizacji${NC}"
    echo ""
    
    find "$INPUT_DIR" -type f \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.png" \) | while read -r file; do
        optimize_image "$file"
        ((count++)) || true
    done
    
    echo ""
    echo -e "${GREEN}✅ Optymalizacja zakończona!${NC}"
    echo "   Obrazy zapisane w: $OUTPUT_DIR"
}

# Uruchom
main
```

---

### 30. `docs/CONTRIBUTING.md`

**Lokalizacja:** `docs/CONTRIBUTING.md`  
**Cel:** Wytyczne dla współtwórców projektu

```markdown
# Wytyczne dla Współtwórców

Dziękujemy za zainteresowanie projektem Hotel Nowy Dwór SEO Optimization!

## 🚀 Jak rozpocząć

### 1. Fork i Clone

```bash
# Forkuj repozytorium na GitHubie, następnie:
git clone https://github.com/TWOJ-USERNAME/hotelnowydwor-seo-optimization-process.git
cd hotelnowydwor-seo-optimization-process
```

### 2. Utwórz branch

```bash
git checkout -b feature/nazwa-funkcji
# lub
git checkout -b fix/opis-naprawy
```

### 3. Wprowadź zmiany

Pracuj zgodnie z priorytetami projektu (PRIORYTET 1 → 2 → 3).

### 4. Commit i Push

```bash
git add .
git commit -m "[KATEGORIA] Opis zmian"
git push origin feature/nazwa-funkcji
```

### 5. Pull Request

Utwórz PR używając szablonu.

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
- `[DOCS]` - dokumentacja

Przykłady:
```
[PERFORMANCE] Kompresja GZIP - redukcja rozmiaru o 70%
[SEO] Meta description strony głównej - dodano keyword "hotel trzebnica"
[FIX] Naprawa broken link na /kontakt/
```

## ✅ Checklist przed PR

- [ ] Kod zgodny z WordPress coding standards
- [ ] Przetestowano lokalnie
- [ ] PageSpeed sprawdzony (jeśli dotyczy wydajności)
- [ ] Dokumentacja zaktualizowana
- [ ] Commit messages zgodne z konwencją

## 🔍 Code Review

Każdy PR wymaga review. Przy review sprawdzamy:

1. **Zgodność z celami projektu**
2. **Wpływ na SEO/PageSpeed**
3. **Bezpieczeństwo**
4. **Jakość kodu**
5. **Dokumentację**

## 📁 Struktura Plików

```
/src/           → Pliki do modyfikacji
/dist/          → Gotowe pliki (nie edytuj ręcznie)
/docs/          → Dokumentacja
/text/          → Treści SEO
/knowledge/     → Baza wiedzy
/prompts/       → Prompty dla AI
```

## 🤝 Kontakt

- Issues: Użyj szablonów
- Email: biuro@pbmediaonline.pl

Dziękujemy za wkład w projekt! 🎉
```

---

### 31. `docs/SECURITY.md`

**Lokalizacja:** `docs/SECURITY.md`  
**Cel:** Polityka bezpieczeństwa

```markdown
# Polityka Bezpieczeństwa

## Zgłaszanie Luk Bezpieczeństwa

Jeśli odkryjesz lukę bezpieczeństwa, **NIE** twórz publicznego Issue.

### Jak zgłosić

1. Wyślij email na: biuro@pbmediaonline.pl
2. Temat: `[SECURITY] Opis problemu`
3. Dołącz:
   - Opis luki
   - Kroki reprodukcji
   - Potencjalny wpływ
   - Sugerowane rozwiązanie (jeśli masz)

### Czas reakcji

- Potwierdzenie otrzymania: 24h
- Wstępna ocena: 72h
- Plan naprawy: 7 dni
- Naprawa: zależnie od severity

## Wspierane Wersje

| Wersja | Wsparcie |
|--------|----------|
| main   | ✅ Tak   |
| develop| ✅ Tak   |
| inne   | ❌ Nie   |

## Zabezpieczenia w Projekcie

### Implementowane

- HTTPS wymuszony
- Security headers (.htaccess)
- Regularne aktualizacje wtyczek
- Monitorowanie logów błędów

### Planowane

- WAF (Web Application Firewall)
- 2FA dla wp-admin
- Automatyczne skanowanie kodu

## Best Practices

1. Nigdy nie commituj danych wrażliwych
2. Używaj zmiennych środowiskowych dla secrets
3. Regularnie aktualizuj zależności
4. Przeglądaj logi błędów

## Kontakt

Zespół bezpieczeństwa: biuro@pbmediaonline.pl
```

---

### 32. `docs/CHANGELOG.md`

**Lokalizacja:** `docs/CHANGELOG.md`  
**Cel:** Historia zmian projektu

```markdown
# Changelog

Wszystkie znaczące zmiany w tym projekcie są dokumentowane w tym pliku.

Format bazuje na [Keep a Changelog](https://keepachangelog.com/pl/1.0.0/).

## [Unreleased]

### Planowane
- PageSpeed ≥90 punktów
- 6 postów blogowych
- Pełna optymalizacja SEO

---

## [0.1.0] - YYYY-MM-DD

### Dodano
- Inicjalna struktura repozytorium
- Pliki audytu SEO
- Dokumentacja projektu
- GitHub Actions workflows
- Konfiguracja AI (Copilot, Claude)

### Zmienione
- [opis zmian]

### Naprawione
- [opis napraw]

### Usunięte
- [opis usuniętych elementów]

---

## Template dla nowych wersji

```
## [X.Y.Z] - YYYY-MM-DD

### Dodano
- Nowe funkcje

### Zmienione
- Zmiany w istniejących funkcjach

### Naprawione
- Naprawy błędów

### Usunięte
- Usunięte funkcje

### Bezpieczeństwo
- Poprawki bezpieczeństwa
```

---

*Changelog jest aktualizowany przy każdym mergu do main.*
```

---

### 33. `docs/ROADMAP.md`

**Lokalizacja:** `docs/ROADMAP.md`  
**Cel:** Plan rozwoju projektu

```markdown
# 🗺️ Roadmap - Hotel Nowy Dwór SEO

## Oś Czasu (3 miesiące)

```
Miesiąc 1          Miesiąc 2          Miesiąc 3
[========]         [========]         [========]
PRIORYTET 1        PRIORYTET 2        PRIORYTET 3
Bezpieczeństwo     SEO & Content      Integracje
& Wydajność                           & Porządki
```

---

## 📅 MIESIĄC 1: Bezpieczeństwo i Wydajność

### Tydzień 1-2
- [ ] Implementacja zabezpieczeń PB MEDIA
- [ ] Konfiguracja HTTPS
- [ ] Security headers w .htaccess

### Tydzień 3-4
- [ ] Kompresja GZIP/Brotli
- [ ] Cache przeglądarki
- [ ] Konwersja obrazów WebP/AVIF
- [ ] Minimalizacja CSS/JS
- [ ] **CEL: PageSpeed ≥90**

---

## 📅 MIESIĄC 2: SEO i Content

### Tydzień 5-6
- [ ] Meta tagi na wszystkich stronach
- [ ] Schema.org dla hotelu
- [ ] Naprawa hierarchii nagłówków

### Tydzień 7-8
- [ ] Content SEO na podstronach
- [ ] Posty blogowe (6 sztuk)
- [ ] Optymalizacja słów kluczowych

---

## 📅 MIESIĄC 3: Integracje i Porządki

### Tydzień 9-10
- [ ] Google Search Console
- [ ] Google Analytics 4
- [ ] Google Tag Manager

### Tydzień 11-12
- [ ] Naprawa błędów indeksowania
- [ ] Usunięcie podstron NFHotel
- [ ] Sitemap.xml i robots.txt
- [ ] Finalne testy
- [ ] **DEPLOYMENT PRODUKCYJNY**

---

## 🎯 Cele Końcowe

| Cel | Metryka | Status |
|-----|---------|--------|
| PageSpeed Mobile | ≥90 | ⏳ |
| PageSpeed Desktop | ≥90 | ⏳ |
| Posty blogowe | 6 | 0/6 |
| SEO Score | ≥80 | ⏳ |
| Accessibility | ≥90 | ⏳ |

---

## 🔮 Plany Długoterminowe (po 3 miesiącach)

### Q1 Następnego roku
- Rozbudowa bloga (12 postów)
- Lokalne SEO (Google My Business)
- Link building

### Q2 Następnego roku
- Testy A/B
- Optymalizacja konwersji
- Rozszerzenie contentu

---

*Roadmap aktualizowany: YYYY-MM-DD*
```

---

## 📦 Dodatkowe Pliki Konfiguracyjne

### 34. `.nvmrc`

**Lokalizacja:** `.nvmrc`

```
20
```

### 35. `.php-version`

**Lokalizacja:** `.php-version`

```
8.2
```

### 36. `package.json`

**Lokalizacja:** `package.json`

```json
{
  "name": "hotelnowydwor-seo-optimization",
  "version": "0.1.0",
  "description": "SEO optimization for Hotel Nowy Dwór website",
  "private": true,
  "scripts": {
    "lighthouse": "lighthouse https://www.hotelnowydwor.eu --output=json --output-path=./reports/lighthouse.json",
    "pagespeed": "psi https://www.hotelnowydwor.eu --strategy=mobile",
    "optimize:images": "bash scripts/optimize-images.sh",
    "lint:css": "stylelint '**/*.css'",
    "lint:js": "eslint '**/*.js'"
  },
  "devDependencies": {
    "lighthouse": "^11.0.0",
    "psi": "^4.0.0",
    "eslint": "^8.0.0",
    "stylelint": "^15.0.0"
  },
  "engines": {
    "node": ">=20.0.0"
  },
  "repository": {
    "type": "git",
    "url": "https://github.com/PB-MEDIA-Strony-Sklepy-Marketing/hotelnowydwor-seo-optimization-process.git"
  },
  "keywords": [
    "seo",
    "wordpress",
    "optimization",
    "hotel"
  ],
  "author": "PB MEDIA",
  "license": "UNLICENSED"
}
```

### 37. `composer.json`

**Lokalizacja:** `composer.json`

```json
{
    "name": "pb-media/hotelnowydwor-seo",
    "description": "SEO optimization for Hotel Nowy Dwór WordPress site",
    "type": "project",
    "license": "proprietary",
    "minimum-stability": "stable",
    "prefer-stable": true,
    "require": {
        "php": ">=8.2"
    },
    "require-dev": {
        "squizlabs/php_codesniffer": "^3.7",
        "wp-coding-standards/wpcs": "^3.0",
        "phpcompatibility/phpcompatibility-wp": "^2.1"
    },
    "config": {
        "allow-plugins": {
            "dealerdirect/phpcodesniffer-composer-installer": true
        }
    },
    "scripts": {
        "lint": "phpcs --standard=WordPress",
        "lint:fix": "phpcbf --standard=WordPress"
    }
}
```

---

## 🎯 Instrukcja Wdrożenia Krok po Kroku

### Krok 1: Przygotowanie

```bash
# Sklonuj repozytorium
git clone https://github.com/PB-MEDIA-Strony-Sklepy-Marketing/hotelnowydwor-seo-optimization-process.git
cd hotelnowydwor-seo-optimization-process

# Utwórz nowy branch
git checkout -b feature/repo-configuration
```

### Krok 2: Utwórz strukturę katalogów

```bash
# Utwórz wszystkie potrzebne katalogi
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

### Krok 3: Kopiuj pliki

Skopiuj każdy plik z tego przewodnika do odpowiedniej lokalizacji.

### Krok 4: Nadaj uprawnienia skryptom

```bash
chmod +x scripts/*.sh
```

### Krok 5: Commit i Push

```bash
git add .
git commit -m "[DOCS] Konfiguracja repozytorium - struktura, workflows, AI config"
git push origin feature/repo-configuration
```

### Krok 6: Utwórz Pull Request

Przejdź do GitHub i utwórz PR z branch `feature/repo-configuration` do `main`.

---

## ✅ Checklist Wdrożenia

- [ ] Struktura katalogów utworzona
- [ ] `.github/CODEOWNERS` dodany
- [ ] `.editorconfig` dodany
- [ ] `CLAUDE.md` (root) dodany
- [ ] `.copilot/instructions.md` dodany
- [ ] `.claude/settings.json` dodany
- [ ] `.claude/CLAUDE.md` dodany
- [ ] Wszystkie workflows w `.github/workflows/` dodane
- [ ] Szablony Issues dodane
- [ ] Szablon PR dodany
- [ ] Pliki w `knowledge/` dodane
- [ ] Pliki w `prompts/` dodane
- [ ] Pliki w `agents/` dodane
- [ ] Pliki w `templates/` dodane
- [ ] Dokumentacja w `docs/` dodana
- [ ] `package.json` dodany
- [ ] `composer.json` dodany
- [ ] Skrypty w `scripts/` dodane

---

**Autor:** Claude AI  
**Data:** 14 grudnia 2025  
**Wersja:** 1.0
