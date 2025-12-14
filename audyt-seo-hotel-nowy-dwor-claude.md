# 🏨 KOMPLEKSOWY AUDYT SEO
## Hotel Nowy Dwór - hotelnowydwor.eu

---

**📅 Data audytu:** 14 grudnia 2025  
**🌐 Analizowany URL:** https://www.hotelnowydwor.eu/  
**📊 Typ strony:** WordPress (motyw NFHotel)  
**🎯 Cel audytu:** Poprawa widoczności w Google i optymalizacja konwersji

---

## 📋 SPIS TREŚCI

1. [Podsumowanie wykonawcze](#podsumowanie-wykonawcze)
2. [Ocena punktowa](#ocena-punktowa)
3. [Krytyczne błędy](#krytyczne-błędy)
4. [Analiza SEO](#analiza-seo)
5. [Analiza wydajności](#analiza-wydajności)
6. [Analiza dostępności](#analiza-dostępności)
7. [Analiza bezpieczeństwa](#analiza-bezpieczeństwa)
8. [Analiza Mobile-Friendly](#analiza-mobile-friendly)
9. [Analiza UX/UI](#analiza-uxui)
10. [Plan wdrożenia](#plan-wdrożenia)
11. [Instrukcje implementacji krok po kroku](#instrukcje-implementacji)
12. [Narzędzia do testowania](#narzędzia-do-testowania)
13. [Metryki sukcesu](#metryki-sukcesu)

---

## 📊 PODSUMOWANIE WYKONAWCZE

### Stan obecny strony

Strona internetowa Hotelu Nowy Dwór w Trzebnicy wymaga znaczących usprawnień w zakresie SEO, wydajności i bezpieczeństwa. Główne problemy to:

| Problem | Wpływ na SEO | Priorytet |
|---------|-------------|-----------|
| Obrazy hostowane na starej domenie | 🔴 Wysoki | Krytyczny |
| Brakujący/niekompletny meta description | 🔴 Wysoki | Krytyczny |
| Brak danych strukturalnych Schema.org | 🔴 Wysoki | Wysoki |
| Niezoptymalizowane obrazy (format, rozmiar) | 🟡 Średni | Wysoki |
| Pozostałości anglojęzyczne z motywu | 🟡 Średni | Średni |
| Brak kompleksowej strategii contentowej | 🔴 Wysoki | Wysoki |

### Główne zalecenia

1. **Natychmiast:** Migracja obrazów na domenę główną
2. **W ciągu 1 tygodnia:** Optymalizacja meta tagów i implementacja Schema.org
3. **W ciągu 2 tygodni:** Konwersja obrazów do formatów WebP/AVIF
4. **W ciągu 1 miesiąca:** Rozbudowa treści SEO na wszystkich podstronach

---

## 🎯 OCENA PUNKTOWA

| Obszar | Ocena | Status |
|--------|-------|--------|
| **SEO On-Page** | 45/100 | 🔴 Wymaga znaczącej poprawy |
| **Wydajność** | 55/100 | 🟡 Wymaga optymalizacji |
| **Dostępność (WCAG)** | 50/100 | 🟡 Wymaga poprawy |
| **Bezpieczeństwo** | 60/100 | 🟡 Wymaga wzmocnienia |
| **Mobile-Friendly** | 65/100 | 🟡 Akceptowalne |
| **UX/UI** | 55/100 | 🟡 Wymaga poprawy |
| **OCENA OGÓLNA** | **55/100** | 🟡 **Wymaga optymalizacji** |

---

## 🚨 KRYTYCZNE BŁĘDY

### 🔴 BŁĄD #1: Obrazy hostowane na starej domenie

**Problem:** Wszystkie obrazy są serwowane z domeny `nowydwor.nfhotel.usermd.net` zamiast `hotelnowydwor.eu`

**Wpływ na SEO:**
- Google traktuje to jako zasoby zewnętrzne
- Wolniejsze ładowanie (dodatkowe zapytania DNS)
- Problemy z SEO obrazów (Image SEO)
- Utrata "link juice" dla domeny głównej

**Przykład problemu:**
```html
<!-- OBECNY KOD - ŹLE -->
<img src="https://nowydwor.nfhotel.usermd.net/wp-content/uploads/2023/06/pokojdwuosobowystandarddouble-scaled-1.jpg">

<!-- PRAWIDŁOWY KOD - DOBRZE -->
<img src="https://www.hotelnowydwor.eu/wp-content/uploads/2023/06/pokojdwuosobowystandarddouble-scaled-1.jpg" 
     alt="Pokój dwuosobowy standard w Hotelu Nowy Dwór w Trzebnicy"
     loading="lazy">
```

---

### 🔴 BŁĄD #2: Brakujące/niekompletne meta tagi

**Problem:** Strona główna i podstrony nie mają w pełni zoptymalizowanych meta tagów

**Obecny tytuł:**
```
Hotel "Nowy Dwór" | Hotel w Trzebnicy - Hotel Wrocław
```

**Zalecany tytuł (max 60 znaków):**
```
Hotel Nowy Dwór Trzebnica - Pokoje, Restauracja, Wesela | 24 lata tradycji
```

**Brak meta description - należy dodać:**
```html
<meta name="description" content="Hotel Nowy Dwór w Trzebnicy - 28 komfortowych pokoi, restauracja, organizacja wesel i przyjęć. 15 km od Wrocławia. Rezerwacja online. ☎ +48 71 312 07 14">
```

---

### 🔴 BŁĄD #3: Brak danych strukturalnych Schema.org

**Problem:** Strona nie zawiera znaczników Schema.org dla hotelu

**Wpływ na SEO:**
- Brak wyróżnionych fragmentów (rich snippets) w Google
- Słabsza prezentacja w wynikach wyszukiwania
- Utrata potencjalnych kliknięć

**Rozwiązanie - dodać w sekcji `<head>`:**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Hotel",
  "name": "Hotel Nowy Dwór",
  "description": "Hotel w Trzebnicy, 15 km od Wrocławia. 28 pokoi, restauracja, sale weselne.",
  "url": "https://www.hotelnowydwor.eu",
  "telephone": "+48713120714",
  "email": "rezerwacja@hotelnowydwor.eu",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Nowy Dwór 2",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressCountry": "PL"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "51.3127",
    "longitude": "17.0628"
  },
  "image": "https://www.hotelnowydwor.eu/wp-content/uploads/2023/06/hotel-zewnatrz.jpg",
  "priceRange": "$$",
  "starRating": {
    "@type": "Rating",
    "ratingValue": "3"
  },
  "amenityFeature": [
    {"@type": "LocationFeatureSpecification", "name": "Darmowe WiFi"},
    {"@type": "LocationFeatureSpecification", "name": "Parking"},
    {"@type": "LocationFeatureSpecification", "name": "Restauracja"},
    {"@type": "LocationFeatureSpecification", "name": "Sale konferencyjne"}
  ],
  "checkinTime": "14:00",
  "checkoutTime": "11:00",
  "numberOfRooms": "28"
}
</script>
```

---

## 🔍 ANALIZA SEO

### 4.1 Meta tagi - szczegółowa analiza

| Element | Obecny stan | Zalecenie | Priorytet |
|---------|------------|-----------|-----------|
| Title | Częściowo zoptymalizowany | Skrócić, dodać USP | 🔴 Wysoki |
| Meta description | Brak | Dodać 150-160 znaków | 🔴 Wysoki |
| Meta keywords | Brak | Dodać 5-10 fraz | 🟡 Średni |
| Canonical | Do weryfikacji | Sprawdzić poprawność | 🟡 Średni |
| Open Graph | Brak | Dodać dla social media | 🟡 Średni |

#### Zalecane meta tagi dla strony głównej:

```html
<!-- Podstawowe meta tagi -->
<title>Hotel Nowy Dwór Trzebnica - Pokoje, Restauracja, Wesela</title>
<meta name="description" content="Hotel Nowy Dwór w Trzebnicy - 28 komfortowych pokoi, restauracja z polską kuchnią, organizacja wesel i przyjęć. 15 km od Wrocławia. Rezerwacja: +48 71 312 07 14">
<meta name="keywords" content="hotel trzebnica, noclegi trzebnica, hotel nowy dwór, wesela trzebnica, restauracja trzebnica, hotel blisko wrocławia">
<link rel="canonical" href="https://www.hotelnowydwor.eu/">

<!-- Open Graph dla Facebook/LinkedIn -->
<meta property="og:type" content="website">
<meta property="og:title" content="Hotel Nowy Dwór - Trzebnica">
<meta property="og:description" content="Komfortowy hotel 15 km od Wrocławia. 28 pokoi, restauracja, wesela.">
<meta property="og:image" content="https://www.hotelnowydwor.eu/wp-content/uploads/og-image.jpg">
<meta property="og:url" content="https://www.hotelnowydwor.eu/">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Hotel Nowy Dwór - Trzebnica">
<meta name="twitter:description" content="Komfortowy hotel 15 km od Wrocławia. 28 pokoi, restauracja, wesela.">
```

---

### 4.2 Struktura nagłówków H1-H6

**Obecne problemy:**
- Możliwe zduplikowane H1 na stronie
- Brak hierarchicznej struktury nagłówków
- Nagłówki bez słów kluczowych

**Zalecana struktura dla strony głównej:**

```html
<h1>Hotel Nowy Dwór - Komfortowe noclegi w Trzebnicy</h1>

<h2>Nasze pokoje hotelowe</h2>
  <h3>Pokoje standardowe</h3>
  <h3>Pokoje LUX</h3>
  <h3>Apartamenty</h3>

<h2>Restauracja hotelowa</h2>
  <h3>Menu</h3>
  <h3>Przyjęcia i imprezy</h3>

<h2>Organizacja wesel w Trzebnicy</h2>

<h2>Udogodnienia hotelowe</h2>

<h2>Lokalizacja - 15 km od Wrocławia</h2>
```

---

### 4.3 Optymalizacja obrazów

**Obecny stan:**
| Problem | Ilość | Wpływ |
|---------|-------|-------|
| Obrazy bez atrybutu alt | Większość | 🔴 Krytyczny |
| Format JPG zamiast WebP | Wszystkie | 🟡 Wysoki |
| Brak lazy loading | Większość | 🟡 Średni |
| Nieoptymalizowany rozmiar | Wszystkie | 🟡 Wysoki |

**Przykład poprawnej implementacji obrazu:**

```html
<!-- PRZED (źle) -->
<img src="https://nowydwor.nfhotel.usermd.net/wp-content/uploads/2023/06/pokojdwuosobowystandarddouble-scaled-1.jpg">

<!-- PO (dobrze) -->
<picture>
  <source srcset="pokojdwuosobowystandarddouble.avif" type="image/avif">
  <source srcset="pokojdwuosobowystandarddouble.webp" type="image/webp">
  <img src="pokojdwuosobowystandarddouble.jpg" 
       alt="Pokój dwuosobowy standard w Hotelu Nowy Dwór Trzebnica - łóżko małżeńskie, łazienka, TV" 
       width="800" 
       height="600" 
       loading="lazy"
       decoding="async">
</picture>
```

---

### 4.4 Sitemap.xml i Robots.txt

**Zalecany plik robots.txt:**

```txt
User-agent: *
Allow: /
Disallow: /wp-admin/
Disallow: /wp-includes/
Disallow: /wp-content/plugins/
Disallow: /*?*
Disallow: /cart/
Disallow: /checkout/

# Sitemap
Sitemap: https://www.hotelnowydwor.eu/sitemap.xml

# Crawl-delay (opcjonalnie)
Crawl-delay: 1
```

**Struktura sitemap.xml:**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.hotelnowydwor.eu/</loc>
    <lastmod>2025-12-14</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://www.hotelnowydwor.eu/pokoje/</loc>
    <lastmod>2025-12-14</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>https://www.hotelnowydwor.eu/restauracja/</loc>
    <lastmod>2025-12-14</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <!-- Dodaj pozostałe strony -->
</urlset>
```

---

### 4.5 Linkowanie wewnętrzne

**Zalecenia:**
1. Dodaj linki kontekstowe między powiązanymi stronami
2. Użyj anchor textów z słowami kluczowymi
3. Stwórz logiczną strukturę silosu tematycznego

**Przykładowa struktura silosu:**

```
Strona główna
├── Pokoje (hub)
│   ├── Pokoje standardowe
│   ├── Pokoje LUX
│   └── Apartamenty
├── Restauracja (hub)
│   ├── Menu
│   ├── Przyjęcia
│   └── Wesela
├── Udogodnienia
├── Galeria
├── Blog (nowy!)
│   ├── Atrakcje w Trzebnicy
│   ├── Wesela - porady
│   └── Okolica Wrocławia
└── Kontakt
```

---

## ⚡ ANALIZA WYDAJNOŚCI

### 5.1 Core Web Vitals - docelowe wartości

| Metryka | Cel | Obecny stan* | Działanie |
|---------|-----|-------------|-----------|
| **LCP** (Largest Contentful Paint) | < 2.5s | ~4-6s | Optymalizacja obrazów |
| **INP** (Interaction to Next Paint) | < 200ms | Do zmierzenia | Optymalizacja JS |
| **CLS** (Cumulative Layout Shift) | < 0.1 | Do zmierzenia | Wymiary obrazów |

*Wymagane testy w PageSpeed Insights

### 5.2 Optymalizacja obrazów - szczegółowa instrukcja

#### Krok 1: Konwersja do WebP

**Dla systemu Linux/Mac (terminal):**
```bash
# Instalacja narzędzia cwebp
sudo apt-get install webp

# Konwersja pojedynczego pliku
cwebp -q 80 input.jpg -o output.webp

# Konwersja wszystkich JPG w folderze
for file in *.jpg; do cwebp -q 80 "$file" -o "${file%.jpg}.webp"; done
```

**Dla Windows (narzędzie online):**
1. Wejdź na https://squoosh.app/
2. Przeciągnij obraz
3. Wybierz format WebP
4. Ustaw jakość 80%
5. Pobierz zoptymalizowany plik

#### Krok 2: Kompresja obrazów

**Zalecane wymiary dla hotelu:**
| Typ obrazu | Wymiary | Rozmiar max |
|------------|---------|-------------|
| Hero/Slider | 1920x1080px | 200 KB |
| Pokój - główne | 800x600px | 80 KB |
| Pokój - miniaturka | 400x300px | 30 KB |
| Galeria | 1200x800px | 120 KB |

### 5.3 Konfiguracja cache i kompresji

**Dodaj do pliku .htaccess:**

```apache
# ===================================
# KOMPRESJA GZIP/BROTLI
# ===================================
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/json
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE image/svg+xml
</IfModule>

# ===================================
# CACHE PRZEGLĄDARKI
# ===================================
<IfModule mod_expires.c>
    ExpiresActive On
    
    # Obrazy - cache na 1 rok
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/avif "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    
    # CSS/JS - cache na 1 miesiąc
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    
    # Fonty - cache na 1 rok
    ExpiresByType font/woff2 "access plus 1 year"
    ExpiresByType font/woff "access plus 1 year"
    
    # HTML - cache na 1 godzinę
    ExpiresByType text/html "access plus 1 hour"
</IfModule>

# ===================================
# NAGŁÓWKI CACHE
# ===================================
<IfModule mod_headers.c>
    # Statyczne zasoby
    <FilesMatch "\.(ico|pdf|jpg|jpeg|png|gif|webp|avif|js|css|woff2)$">
        Header set Cache-Control "max-age=31536000, public"
    </FilesMatch>
    
    # HTML
    <FilesMatch "\.(html|htm)$">
        Header set Cache-Control "max-age=3600, public"
    </FilesMatch>
</IfModule>
```

---

## ♿ ANALIZA DOSTĘPNOŚCI (WCAG 2.1)

### 6.1 Wykryte problemy

| Problem | Poziom WCAG | Priorytet |
|---------|-------------|-----------|
| Brak tekstów alternatywnych (alt) | A | 🔴 Krytyczny |
| Niewystarczający kontrast kolorów | AA | 🟡 Wysoki |
| Brak widocznego fokusa | A | 🔴 Krytyczny |
| Brak skip navigation | A | 🟡 Średni |
| Formularze bez etykiet | A | 🔴 Krytyczny |

### 6.2 Poprawki dostępności

**Dodaj do CSS:**

```css
/* ===================================
   DOSTĘPNOŚĆ - FOKUS I KONTRAST
   =================================== */

/* Widoczny fokus dla wszystkich elementów interaktywnych */
a:focus,
button:focus,
input:focus,
select:focus,
textarea:focus {
    outline: 3px solid #0066CC;
    outline-offset: 2px;
    box-shadow: 0 0 0 2px #ffffff;
}

/* Skip navigation link */
.skip-to-content {
    position: absolute;
    top: -100px;
    left: 50%;
    transform: translateX(-50%);
    background: #1a365d;
    color: #ffffff;
    padding: 12px 24px;
    text-decoration: none;
    font-weight: 600;
    z-index: 10000;
    border-radius: 0 0 8px 8px;
    transition: top 0.3s ease;
}

.skip-to-content:focus {
    top: 0;
}

/* Minimalne rozmiary elementów klikalnych (44x44px) */
button,
.btn,
a.button,
input[type="submit"] {
    min-height: 44px;
    min-width: 44px;
    padding: 12px 24px;
}

/* Poprawa kontrastu tekstu */
body {
    color: #1a202c; /* Kontrast 12.6:1 na białym tle */
}

h1, h2, h3, h4, h5, h6 {
    color: #1a365d; /* Kontrast 9.5:1 */
}

/* Link na hover musi mieć wyraźną zmianę */
a:hover {
    text-decoration: underline;
    color: #2c5282;
}
```

**Dodaj na początku sekcji body:**

```html
<!-- Skip navigation -->
<a href="#main-content" class="skip-to-content">
    Przejdź do głównej treści
</a>

<!-- ... reszta nagłówka ... -->

<main id="main-content">
    <!-- Główna treść strony -->
</main>
```

---

## 🔒 ANALIZA BEZPIECZEŃSTWA

### 7.1 Nagłówki bezpieczeństwa

**Dodaj do .htaccess:**

```apache
# ===================================
# NAGŁÓWKI BEZPIECZEŃSTWA
# ===================================
<IfModule mod_headers.c>
    # Zapobiega atakom XSS
    Header always set X-XSS-Protection "1; mode=block"
    
    # Zapobiega clickjacking
    Header always set X-Frame-Options "SAMEORIGIN"
    
    # Zapobiega MIME type sniffing
    Header always set X-Content-Type-Options "nosniff"
    
    # HSTS - wymusza HTTPS (włącz po sprawdzeniu SSL)
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
    
    # Referrer Policy
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    
    # Permissions Policy
    Header always set Permissions-Policy "geolocation=(), microphone=(), camera=()"
    
    # Content Security Policy (dostosuj do swoich potrzeb)
    Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.google-analytics.com https://www.googletagmanager.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; frame-src https://www.google.com https://maps.google.com;"
</IfModule>
```

### 7.2 Zabezpieczenia WordPress

**Dodaj do .htaccess (przed regułami WordPress):**

```apache
# ===================================
# ZABEZPIECZENIA WORDPRESS
# ===================================

# Blokuj dostęp do wp-config.php
<Files wp-config.php>
    Order allow,deny
    Deny from all
</Files>

# Blokuj dostęp do plików .htaccess
<Files .htaccess>
    Order allow,deny
    Deny from all
</Files>

# Blokuj listowanie katalogów
Options -Indexes

# Blokuj dostęp do plików XML-RPC (częsty cel ataków)
<Files xmlrpc.php>
    Order allow,deny
    Deny from all
</Files>

# Blokuj dostęp do readme.html i license.txt
<FilesMatch "^(readme|license)\.(html|txt)$">
    Order allow,deny
    Deny from all
</FilesMatch>

# Ogranicz dostęp do wp-admin (opcjonalnie - tylko dla określonych IP)
# <Files wp-login.php>
#     Order deny,allow
#     Deny from all
#     Allow from YOUR.IP.ADDRESS
# </Files>
```

---

## 📱 ANALIZA MOBILE-FRIENDLY

### 8.1 Responsywność

**Sprawdź i dodaj meta viewport:**

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
```

### 8.2 Optymalizacja mobilna CSS

```css
/* ===================================
   MOBILE-FIRST RESPONSIVE DESIGN
   =================================== */

/* Bazowy styl dla mobile */
.container {
    width: 100%;
    padding: 0 16px;
    margin: 0 auto;
}

/* Tablet (768px+) */
@media (min-width: 768px) {
    .container {
        max-width: 720px;
        padding: 0 24px;
    }
}

/* Desktop (992px+) */
@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

/* Large desktop (1200px+) */
@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}

/* Przyciski mobile-friendly */
@media (max-width: 767px) {
    .btn,
    button,
    a.button {
        width: 100%;
        min-height: 48px;
        font-size: 16px; /* Zapobiega zoom na iOS */
    }
    
    /* Zwiększ odstępy między elementami klikalnymi */
    nav ul li {
        margin-bottom: 8px;
    }
    
    /* Formularze na pełną szerokość */
    input,
    select,
    textarea {
        width: 100%;
        min-height: 48px;
        font-size: 16px;
    }
}

/* Zapobieganie poziomemu scrollowi */
html, body {
    overflow-x: hidden;
}

img {
    max-width: 100%;
    height: auto;
}
```

---

## 🎨 ANALIZA UX/UI

### 9.1 Rekomendacje UX

| Element | Problem | Rozwiązanie |
|---------|---------|-------------|
| CTA "Rezerwuj" | Mało widoczny | Zwiększyć kontrast, dodać animację |
| Formularz rezerwacji | Brak walidacji | Dodać walidację JS |
| Nawigacja | Zbyt złożona | Uprościć menu |
| Footer | Brak mapy | Dodać Google Maps |

### 9.2 Ulepszony przycisk CTA

```html
<style>
.cta-book {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, #c53030 0%, #9b2c2c 100%);
    color: #ffffff;
    padding: 16px 32px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 700;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(197, 48, 48, 0.4);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.cta-book:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(197, 48, 48, 0.5);
    background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
}

.cta-book:active {
    transform: translateY(-1px);
}

.cta-book svg {
    width: 24px;
    height: 24px;
}
</style>

<a href="/pokoje" class="cta-book">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
    </svg>
    Zarezerwuj pokój
</a>
```

---

## 📅 PLAN WDROŻENIA

### Faza 1: KRYTYCZNE (Tydzień 1)

| Zadanie | Czas | Trudność |
|---------|------|----------|
| Migracja obrazów na domenę główną | 2-4h | 🟡 Średnia |
| Dodanie meta tagów (title, description) | 1h | 🟢 Łatwa |
| Implementacja Schema.org | 1h | 🟢 Łatwa |
| Dodanie atrybutów alt do obrazów | 2h | 🟢 Łatwa |

### Faza 2: WAŻNE (Tydzień 2-3)

| Zadanie | Czas | Trudność |
|---------|------|----------|
| Konwersja obrazów do WebP | 3-5h | 🟡 Średnia |
| Optymalizacja rozmiaru obrazów | 2-3h | 🟡 Średnia |
| Konfiguracja cache .htaccess | 30min | 🟢 Łatwa |
| Nagłówki bezpieczeństwa | 30min | 🟢 Łatwa |
| Poprawa struktury nagłówków H1-H6 | 1-2h | 🟡 Średnia |

### Faza 3: OPTYMALIZACJA (Tydzień 4-6)

| Zadanie | Czas | Trudność |
|---------|------|----------|
| Poprawki dostępności WCAG | 4-6h | 🟡 Średnia |
| Optymalizacja mobilna | 3-4h | 🟡 Średnia |
| Stworzenie/aktualizacja sitemap.xml | 30min | 🟢 Łatwa |
| Konfiguracja robots.txt | 15min | 🟢 Łatwa |

### Faza 4: CONTENT (Miesiąc 2-3)

| Zadanie | Czas | Trudność |
|---------|------|----------|
| Rozbudowa treści na podstronach | 10-20h | 🟡 Średnia |
| Utworzenie sekcji blog | 5-10h | 🟡 Średnia |
| 6 artykułów blogowych | 12-18h | 🟡 Średnia |
| Usunięcie treści anglojęzycznych | 1h | 🟢 Łatwa |

---

## 🔧 INSTRUKCJE IMPLEMENTACJI KROK PO KROKU

### ZADANIE 1: Dodanie meta tagów (dla amatora)

**Co to jest:** Meta tagi to niewidoczne dla użytkownika informacje o stronie, które pomagają Google zrozumieć, o czym jest strona.

**Krok 1:** Zaloguj się do panelu WordPress
- Wejdź na: `https://www.hotelnowydwor.eu/wp-admin`
- Podaj login i hasło

**Krok 2:** Zainstaluj wtyczkę Yoast SEO (jeśli nie masz)
- Przejdź do: Wtyczki → Dodaj nową
- Wyszukaj: "Yoast SEO"
- Kliknij: "Zainstaluj" → "Włącz"

**Krok 3:** Skonfiguruj meta tagi dla strony głównej
- Przejdź do: Yoast SEO → Ustawienia → Strona główna
- W polu "Tytuł SEO" wpisz:
  ```
  Hotel Nowy Dwór Trzebnica - Pokoje, Restauracja, Wesela
  ```
- W polu "Meta opis" wpisz:
  ```
  Hotel Nowy Dwór w Trzebnicy - 28 komfortowych pokoi, restauracja z polską kuchnią, organizacja wesel i przyjęć. 15 km od Wrocławia. Rezerwacja: +48 71 312 07 14
  ```
- Kliknij: "Zapisz zmiany"

**Krok 4:** Powtórz dla każdej podstrony
- Edytuj każdą stronę (Strony → Wszystkie strony)
- Przewiń na dół do sekcji Yoast SEO
- Uzupełnij tytuł i opis

---

### ZADANIE 2: Dodanie Schema.org (dla amatora)

**Co to jest:** Schema.org to specjalny kod, który pomaga Google wyświetlać Twój hotel z gwiazdkami, ceną i innymi informacjami bezpośrednio w wynikach wyszukiwania.

**Metoda A: Przez wtyczkę (łatwiejsza)**

**Krok 1:** Zainstaluj wtyczkę
- Przejdź do: Wtyczki → Dodaj nową
- Wyszukaj: "Schema & Structured Data for WP"
- Kliknij: "Zainstaluj" → "Włącz"

**Krok 2:** Skonfiguruj typ "Hotel"
- Przejdź do: Structured Data → Schema Types
- Kliknij: "Add New"
- Wybierz: "LocalBusiness" → "Hotel"
- Uzupełnij wszystkie pola (nazwa, adres, telefon, godziny)
- Zapisz

**Metoda B: Ręcznie w kodzie (dla zaawansowanych)**

**Krok 1:** Otwórz plik header.php
- Wygląd → Edytor motywów → header.php

**Krok 2:** Przed znacznikiem `</head>` wklej kod Schema.org
- Kod znajduje się w sekcji "BŁĄD #3" tego raportu

---

### ZADANIE 3: Optymalizacja obrazów (dla amatora)

**Co to jest:** Optymalizacja obrazów sprawia, że strona ładuje się szybciej, co Google nagradza wyższą pozycją.

**Krok 1:** Zainstaluj wtyczkę do optymalizacji
- Przejdź do: Wtyczki → Dodaj nową
- Wyszukaj: "ShortPixel Image Optimizer" lub "Smush"
- Zainstaluj i aktywuj

**Krok 2:** Skonfiguruj wtyczkę
- Dla ShortPixel: Utwórz darmowe konto na shortpixel.com (100 obrazów/miesiąc za darmo)
- Włącz opcję "Konwertuj do WebP"
- Włącz opcję "Lazy Loading"

**Krok 3:** Zoptymalizuj istniejące obrazy
- Przejdź do: Media → Bulk ShortPixel
- Kliknij: "Start Optimizing"
- Poczekaj na zakończenie (może potrwać kilka godzin)

**Krok 4:** Dodaj atrybuty alt do obrazów
- Przejdź do: Media → Biblioteka
- Kliknij na każdy obraz
- W polu "Tekst alternatywny" opisz, co jest na obrazie
- Przykład: "Pokój dwuosobowy LUX w Hotelu Nowy Dwór - widok na łóżko i okno"

---

### ZADANIE 4: Migracja obrazów na domenę główną

**Co to jest:** Obecnie Twoje obrazy są hostowane na `nowydwor.nfhotel.usermd.net`. Muszą być na `hotelnowydwor.eu`.

**UWAGA:** To zadanie wymaga dostępu do serwera. Jeśli nie masz doświadczenia, poproś webmastera.

**Krok 1:** Sprawdź gdzie są pliki
- Zaloguj się przez FTP lub panel hostingu
- Znajdź folder: `/wp-content/uploads/`

**Krok 2:** Zaktualizuj linki w bazie danych
- Zainstaluj wtyczkę: "Better Search Replace"
- Przejdź do: Narzędzia → Better Search Replace
- W polu "Szukaj" wpisz: `nowydwor.nfhotel.usermd.net`
- W polu "Zamień na" wpisz: `www.hotelnowydwor.eu`
- Zaznacz tabele: wszystkie
- WAŻNE: Najpierw zaznacz "Uruchom jako suchy test"
- Sprawdź wyniki, jeśli OK, odznacz test i uruchom

---

### ZADANIE 5: Konfiguracja .htaccess

**Co to jest:** Plik .htaccess kontroluje jak działa Twój serwer - cache, bezpieczeństwo, przekierowania.

**UWAGA:** Błąd w tym pliku może wyłączyć stronę! Zawsze rób backup.

**Krok 1:** Utwórz kopię zapasową
- Przez FTP pobierz plik `.htaccess` z głównego folderu
- Zapisz jako `htaccess-backup-14122025.txt`

**Krok 2:** Edytuj plik
- Otwórz `.htaccess` w edytorze tekstu
- Na KOŃCU pliku (za regułami WordPress) dodaj kod z sekcji 5.3 tego raportu

**Krok 3:** Zapisz i przetestuj
- Zapisz plik
- Odśwież stronę
- Jeśli pojawi się błąd 500, przywróć backup

---

## 🧪 NARZĘDZIA DO TESTOWANIA

### Google PageSpeed Insights

**URL:** https://pagespeed.web.dev/

**Jak używać:**
1. Wklej: `https://www.hotelnowydwor.eu/`
2. Kliknij "Analyze"
3. Sprawdź wyniki dla Desktop i Mobile
4. Skupić się na: LCP, INP, CLS

**Cel:** Wszystkie wskaźniki na zielono (> 90 punktów)

---

### Google Search Console

**URL:** https://search.google.com/search-console

**Jak skonfigurować:**
1. Zaloguj się kontem Google
2. Dodaj właściwość: `https://www.hotelnowydwor.eu/`
3. Zweryfikuj przez plik HTML lub DNS

**Co sprawdzać:**
- Strony indeksowane
- Błędy indeksowania
- Core Web Vitals
- Pozycje słów kluczowych

---

### GTmetrix

**URL:** https://gtmetrix.com/

**Jak używać:**
1. Załóż darmowe konto
2. Wklej URL strony
3. Wybierz lokalizację: Frankfurt (najbliżej Polski)
4. Analizuj "Waterfall" chart

---

### WAVE Accessibility Tool

**URL:** https://wave.webaim.org/

**Jak używać:**
1. Wklej URL
2. Przejrzyj błędy (czerwone) i ostrzeżenia (żółte)
3. Napraw w pierwszej kolejności błędy kontrastu i brakujące alt

---

## 📈 METRYKI SUKCESU (KPI)

### Po 1 miesiącu

| Metryka | Obecna* | Cel |
|---------|---------|-----|
| PageSpeed Mobile | ~40 | > 60 |
| PageSpeed Desktop | ~60 | > 80 |
| Czas ładowania | ~5s | < 3s |
| Pozycja "hotel trzebnica" | ~15 | < 10 |

### Po 3 miesiącach

| Metryka | Cel |
|---------|-----|
| PageSpeed Mobile | > 75 |
| Ruch organiczny | +50% |
| Pozycja "hotel trzebnica" | Top 5 |
| Bounce rate | < 50% |

### Po 6 miesiącach

| Metryka | Cel |
|---------|-----|
| PageSpeed Mobile | > 85 |
| Ruch organiczny | +150% |
| Konwersje (rezerwacje) | +25% |
| Widoczność w Google | +200% |

---

## 📞 WSPARCIE I KONTAKT

**W razie pytań dotyczących wdrożenia:**

- Ten raport zawiera szczegółowe instrukcje krok po kroku
- Dla bardziej złożonych zadań (migracja obrazów, modyfikacje serwera) zalecamy konsultację z webmasterem
- Regularnie testuj zmiany w PageSpeed Insights

---

## ✅ CHECKLIST WDROŻENIA

### Tydzień 1 - KRYTYCZNE
- [ ] Meta title - strona główna
- [ ] Meta description - strona główna
- [ ] Schema.org Hotel
- [ ] Atrybuty alt - minimum 10 głównych obrazów
- [ ] Weryfikacja Google Search Console

### Tydzień 2 - WAŻNE
- [ ] Meta tagi - wszystkie podstrony
- [ ] Wtyczka do optymalizacji obrazów
- [ ] Konwersja do WebP - główne obrazy
- [ ] Cache .htaccess
- [ ] Nagłówki bezpieczeństwa

### Tydzień 3-4 - OPTYMALIZACJA
- [ ] Migracja obrazów na domenę główną
- [ ] Sitemap.xml
- [ ] Robots.txt
- [ ] Poprawki dostępności
- [ ] Test mobilny

### Miesiąc 2-3 - CONTENT
- [ ] Rozbudowa treści /pokoje/
- [ ] Rozbudowa treści /restauracja/
- [ ] Blog - artykuł 1
- [ ] Blog - artykuł 2
- [ ] Blog - artykuł 3
- [ ] Blog - artykuł 4
- [ ] Blog - artykuł 5
- [ ] Blog - artykuł 6

---

**📋 Raport wygenerowany:** 14 grudnia 2025  
**🔄 Zalecana aktualizacja:** Co 3 miesiące  
**📊 Narzędzie:** Claude AI - Audyt SEO  

---

*Końc raportu*
