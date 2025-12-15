# Roadmapa Projektu

Plan optymalizacji strony Hotelu Nowy Dwór rozpisany na 3 miesiące, zgodnie z priorytetami audytu.

## 📅 Miesiąc 1: Bezpieczeństwo i Wydajność (Priorytet 1)
**Cel:** PageSpeed Mobile > 90, pełne zabezpieczenie instancji.

- [ ] **Tydzień 1: Hardening & HTTPS**
    - [ ] Wdrożenie nagłówków bezpieczeństwa w `.htaccess`.
    - [ ] Blokada XML-RPC i edycji plików.
    - [ ] Wymuszenie HTTPS i HSTS.
- [ ] **Tydzień 2: Optymalizacja Obrazów**
    - [ ] Konwersja wszystkich grafik do WebP/AVIF.
    - [ ] Implementacja Lazy Loading i atrybutów `width`/`height`.
- [ ] **Tydzień 3: Cache & Minifikacja**
    - [ ] Konfiguracja GZIP/Brotli.
    - [ ] Minifikacja CSS/JS i optymalizacja Critical Path.
- [ ] **Tydzień 4: Audyt Końcowy Etapu 1**
    - [ ] Testy PageSpeed i Security.

## 📅 Miesiąc 2: SEO i Content (Priorytet 2)
**Cel:** Wzrost widoczności na frazy lokalne, poprawa struktury treści.

- [ ] **Tydzień 5: Meta Tagi i Struktura**
    - [ ] Optymalizacja Title/Description dla wszystkich podstron.
    - [ ] Poprawa hierarchii nagłówków H1-H6.
- [ ] **Tydzień 6: Schema.org**
    - [ ] Wdrożenie JSON-LD `Hotel`, `Restaurant`, `BreadcrumbList`.
- [ ] **Tydzień 7: Content Marketing**
    - [ ] Publikacja 3 artykułów blogowych (atrakcje, poradniki).
    - [ ] Rozbudowa opisów pokoi i oferty weselnej.
- [ ] **Tydzień 8: Content Marketing cz. 2**
    - [ ] Publikacja kolejnych 3 artykułów blogowych.
    - [ ] Optymalizacja sekcji FAQ.

## 📅 Miesiąc 3: Integracje i Porządki (Priorytet 3)
**Cel:** Pełna analityka, czyszczenie długu technologicznego.

- [ ] **Tydzień 9: Analityka**
    - [ ] Konfiguracja GA4, GTM i konwersji Google Ads.
    - [ ] Weryfikacja w Google Search Console.
- [ ] **Tydzień 10: Sprzątanie**
    - [ ] Usunięcie zbędnych podstron (np. z motywu NFHotel).
    - [ ] Czyszczenie bazy danych i `error_log`.
- [ ] **Tydzień 11: Aktualizacje**
    - [ ] Aktualizacja wtyczek i WordPressa.
    - [ ] Testy kompatybilności.
- [ ] **Tydzień 12: Finalizacja**
    - [ ] Generowanie sitemap.xml.
    - [ ] Końcowy audyt i przekazanie projektu.
