# SEO Best Practices - Hotel Nowy Dwór

## 📋 Spis Treści

1. [SEO On-Page](#seo-on-page)
2. [SEO Technical](#seo-technical)
3. [Performance Optimization](#performance-optimization)
4. [Schema.org & Structured Data](#schemaorg--structured-data)
5. [Content Strategy](#content-strategy)
6. [Local SEO](#local-seo)
7. [Mobile-First Indexing](#mobile-first-indexing)
8. [Core Web Vitals](#core-web-vitals)
9. [WordPress SEO](#wordpress-seo)
10. [Oxygen Builder SEO](#oxygen-builder-seo)
11. [Image Optimization](#image-optimization)
12. [Link Building](#link-building)
13. [Analytics & Monitoring](#analytics--monitoring)

---

## 🎯 SEO On-Page

### Meta Tags Optimization

#### Title Tags (Najważniejsze!)

**Best Practices:**
- **Długość:** 50-60 znaków (max 70)
- **Format:** `Keyword | Brand Name` lub `Main Keyword - Secondary Keyword | Brand`
- **Unikalne:** Każda strona musi mieć unikalny title
- **Keyword na początku:** Najważniejsze słowo kluczowe na początku
- **Brand na końcu:** Nazwa marki zawsze na końcu

**Przykłady dla Hotel Nowy Dwór:**

```html
<!-- Homepage -->
<title>Hotel Trzebnica - Hotel Nowy Dwór ⭐⭐⭐ Blisko Wrocławia</title>

<!-- Pokoje -->
<title>Pokoje Hotelowe Trzebnica - Komfortowe Noclegi | Hotel Nowy Dwór</title>

<!-- Restauracja -->
<title>Restauracja Trzebnica - Kuchnia Polska | Hotel Nowy Dwór</title>

<!-- Wesela -->
<title>Sale Weselne Trzebnica - Organizacja Wesel | Hotel Nowy Dwór</title>

<!-- Konferencje -->
<title>Sale Konferencyjne Trzebnica - Sala Szkoleniowa | Hotel Nowy Dwór</title>

<!-- Kontakt -->
<title>Kontakt - Rezerwacje Hotel Nowy Dwór Trzebnica | +48 71 312 07 14</title>

<!-- O Nas -->
<title>O Hotelu Nowy Dwór - 28 Pokoi w Trzebnicy k. Wrocławia</title>

<!-- FAQ -->
<title>FAQ - Najczęściej Zadawane Pytania | Hotel Nowy Dwór Trzebnica</title>
```

#### Meta Descriptions (Drugie Najważniejsze!)

**Best Practices:**
- **Długość:** 150-160 znaków (max 170)
- **Call-to-Action:** Zachęta do kliknięcia
- **Słowa kluczowe:** 2-3 główne słowa kluczowe
- **Unikalne:** Każda strona musi mieć unikalny opis
- **Bez duplikatów:** Unikaj kopiowania fragmentów z treści strony

**Przykłady:**

```html
<!-- Homepage -->
<meta name="description" content="Hotel Nowy Dwór Trzebnica ⭐⭐⭐ - 28 komfortowych pokoi, 15 km od Wrocławia. Restauracja, sale weselne i konferencyjne. Rezerwuj: 71 312 07 14">

<!-- Pokoje -->
<meta name="description" content="Komfortowe pokoje hotelowe w Trzebnicy. 10 pokoi LUX, łazienki z prysznicem, Wi-Fi, parking. Hotel Nowy Dwór 15 km od Wrocławia. Sprawdź dostępność!">

<!-- Restauracja -->
<meta name="description" content="Restauracja Hotelu Nowy Dwór - smaczna kuchnia polska w Trzebnicy. Menu obiadowe, catering, przyjęcia rodzinne. Zarezerwuj stolik: 71 312 07 14">

<!-- Wesela -->
<meta name="description" content="Organizacja wesel w Trzebnicy - sale weselne dla 40-120 osób. Hotel Nowy Dwór oferuje kompleksową obsługę, catering, nocleg dla gości. Sprawdź ofertę!">

<!-- Konferencje -->
<meta name="description" content="Sale konferencyjne Trzebnica - wynajem sal szkoleniowych dla 15-120 osób. Sprzęt audio-video, catering, parking. Hotel Nowy Dwór k. Wrocławia">

<!-- Kontakt -->
<meta name="description" content="Kontakt Hotel Nowy Dwór Trzebnica: ul. Nowy Dwór 2, tel. +48 71 312 07 14, email: rezerwacja@hotelnowydwor.eu. Rezerwacje 24/7. Dojazd z Wrocławia 15 min">

<!-- O Nas -->
<meta name="description" content="Hotel Nowy Dwór to 3-gwiazdkowy hotel w Trzebnicy k. Wrocławia. 28 pokoi, restauracja, sale weselne i konferencyjne. Idealna lokalizacja blisko A4">

<!-- FAQ -->
<meta name="description" content="FAQ Hotel Nowy Dwór - odpowiedzi na najczęściej zadawane pytania o rezerwacje, pokoje, restaurację, wesela i konferencje. Wszystko co musisz wiedzieć!">
```

#### Meta Keywords (Opcjonalne - Google ignoruje)

```html
<meta name="keywords" content="hotel trzebnica, hotel nowy dwór, hotel wrocław, noclegi trzebnica, pokoje hotelowe trzebnica">
```

**Uwaga:** Google oficjalnie nie używa meta keywords do rankingu, ale nie szkodzi ich dodać.

#### Open Graph Tags (Social Media)

**Best Practices:**
- **Obowiązkowe:** og:title, og:description, og:image, og:url, og:type
- **Rozmiar obrazu:** Min. 1200x630px (proporcje 1.91:1)
- **Format obrazu:** JPEG lub PNG
- **Unikalne dla każdej strony**

```html
<!-- Homepage -->
<meta property="og:title" content="Hotel Nowy Dwór Trzebnica ⭐⭐⭐ - 15 km od Wrocławia">
<meta property="og:description" content="Hotel Nowy Dwór - 28 pokoi, restauracja, sale weselne i konferencyjne w Trzebnicy">
<meta property="og:image" content="https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-og-image.jpg">
<meta property="og:url" content="https://www.hotelnowydwor.eu/">
<meta property="og:type" content="website">
<meta property="og:locale" content="pl_PL">
<meta property="og:site_name" content="Hotel Nowy Dwór">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Hotel Nowy Dwór Trzebnica ⭐⭐⭐">
<meta name="twitter:description" content="Hotel Nowy Dwór - 28 pokoi, restauracja, sale weselne i konferencyjne">
<meta name="twitter:image" content="https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-twitter-card.jpg">
```

### Heading Structure (H1-H6)

**Best Practices:**
- **Tylko jeden H1 na stronie** - główne słowo kluczowe
- **Hierarchia H1 → H2 → H3 → H4 → H5 → H6** - bez przeskakiwania poziomów
- **Słowa kluczowe w nagłówkach** - naturalne użycie keywords
- **Długość H1:** 20-70 znaków

**Przykładowa struktura dla strony głównej:**

```html
<h1>Hotel Nowy Dwór Trzebnica - 3-Gwiazdkowy Hotel k. Wrocławia</h1>

<h2>Komfortowe Pokoje Hotelowe</h2>
  <h3>Pokoje Standard</h3>
  <h3>Pokoje LUX</h3>

<h2>Restauracja Hotelu Nowy Dwór</h2>
  <h3>Menu Restauracji</h3>
  <h3>Catering na Zamówienie</h3>

<h2>Sale Weselne i Bankietowe</h2>
  <h3>Sala Bankietowa - do 120 osób</h3>
  <h3>Sala Mniejsza - do 40 osób</h3>

<h2>Sale Konferencyjne</h2>
  <h3>Wyposażenie Sal</h3>
  <h3>Catering Konferencyjny</h3>

<h2>Lokalizacja - Trzebnica k. Wrocławia</h2>
  <h3>Dojazd z Wrocławia</h3>
  <h3>Atrakcje w Okolicy</h3>
```

**Przykładowa struktura dla strony "Pokoje":**

```html
<h1>Pokoje Hotelowe w Trzebnicy - Hotel Nowy Dwór</h1>

<h2>Rodzaje Pokoi</h2>
  <h3>Pokoje Standard</h3>
    <h4>Wyposażenie Pokoju Standard</h4>
    <h4>Cena Pokoju Standard</h4>
  <h3>Pokoje LUX</h3>
    <h4>Wyposażenie Pokoju LUX</h4>
    <h4>Cena Pokoju LUX</h4>

<h2>Udogodnienia w Pokojach</h2>
  <h3>Łazienki</h3>
  <h3>Wi-Fi</h3>
  <h3>Telewizor</h3>

<h2>Rezerwacja Pokoju</h2>
  <h3>Jak Zarezerwować?</h3>
  <h3>Polityka Anulowania</h3>
  <h3>Godziny Meldunku</h3>
```

### URL Structure (Permalinki)

**Best Practices:**
- **Krótkie i opisowe:** Max 5-7 słów
- **Lowercase:** Tylko małe litery
- **Myślniki:** Użyj `-` zamiast `_` lub spacji
- **Słowa kluczowe:** Główne słowo kluczowe w URL
- **Bez polskich znaków:** Użyj transkrypcji (ą→a, ć→c, etc.)
- **Bez parametrów:** Unikaj ?id=123, ?page=2

**Dobre przykłady:**

```
https://www.hotelnowydwor.eu/
https://www.hotelnowydwor.eu/pokoje/
https://www.hotelnowydwor.eu/pokoje-lux/
https://www.hotelnowydwor.eu/restauracja/
https://www.hotelnowydwor.eu/restauracja/menu/
https://www.hotelnowydwor.eu/sale-weselne/
https://www.hotelnowydwor.eu/sale-konferencyjne/
https://www.hotelnowydwor.eu/kontakt/
https://www.hotelnowydwor.eu/o-nas/
https://www.hotelnowydwor.eu/faq/
https://www.hotelnowydwor.eu/galeria/
https://www.hotelnowydwor.eu/regulamin/
https://www.hotelnowydwor.eu/polityka-prywatnosci/
https://www.hotelnowydwor.eu/blog/
https://www.hotelnowydwor.eu/blog/atrakcje-trzebnica/
https://www.hotelnowydwor.eu/blog/wesela-w-trzebnicy/
```

**Złe przykłady (do poprawy):**

```
❌ https://www.hotelnowydwor.eu/?page_id=123
❌ https://www.hotelnowydwor.eu/index.php?p=pokoje
❌ https://www.hotelnowydwor.eu/POKOJE_HOTELOWE
❌ https://www.hotelnowydwor.eu/pokoje-hotelowe-trzebnica-wroclaw-dolny-slask-polska
❌ https://www.hotelnowydwor.eu/restauracja_menu.html
```

### Internal Linking

**Best Practices:**
- **Anchor Text:** Opisowy tekst linku (nie "kliknij tutaj")
- **Ilość:** 3-5 linków wewnętrznych na stronę
- **Kontekst:** Linki powiązane tematycznie
- **dofollow:** Wszystkie linki wewnętrzne powinny być dofollow

**Przykłady:**

```html
<!-- Dobry anchor text -->
<a href="/pokoje-lux/">komfortowe pokoje LUX z łazienkami</a>
<a href="/restauracja/menu/">sprawdź nasze menu restauracji</a>
<a href="/sale-weselne/">sale weselne dla 40-120 gości</a>

<!-- Zły anchor text -->
<a href="/pokoje-lux/">kliknij tutaj</a>
<a href="/restauracja/menu/">więcej</a>
<a href="/sale-weselne/">czytaj dalej</a>
```

**Strategia linkowania:**

```
Homepage
├─→ Pokoje
│   ├─→ Pokoje Standard
│   └─→ Pokoje LUX
├─→ Restauracja
│   ├─→ Menu
│   └─→ Catering
├─→ Sale Weselne
├─→ Sale Konferencyjne
├─→ Galeria
├─→ O Nas
├─→ Kontakt
└─→ FAQ
```

### Alt Text dla Obrazów

**Best Practices:**
- **Opisowy:** Dokładny opis tego, co jest na obrazku
- **Słowa kluczowe:** Naturalne użycie keywords
- **Długość:** 10-15 słów (max 125 znaków)
- **Bez "obraz", "zdjęcie":** Google wie, że to obraz
- **Unikalne:** Każdy obraz musi mieć unikalny alt

**Przykłady:**

```html
<!-- Pokoje -->
<img src="pokoj-lux-hotel-nowy-dwor.jpg"
     alt="Pokój LUX z podwójnym łóżkiem w Hotelu Nowy Dwór Trzebnica">

<img src="lazienka-prysznic-hotel-nowy-dwor.jpg"
     alt="Łazienka z prysznicem w pokoju hotelowym Hotel Nowy Dwór">

<!-- Restauracja -->
<img src="restauracja-hotel-nowy-dwor.jpg"
     alt="Wnętrze restauracji Hotelu Nowy Dwór z ustawionymi stolikami">

<img src="danie-glowne-menu-restauracji.jpg"
     alt="Polędwica wołowa z ziemniakami i warzywami - menu Hotelu Nowy Dwór">

<!-- Sale Weselne -->
<img src="sala-weselna-hotel-nowy-dwor.jpg"
     alt="Sala weselna dla 120 gości w Hotelu Nowy Dwór Trzebnica">

<img src="dekoracje-weselne-sala-bankietowa.jpg"
     alt="Dekoracje kwiatowe w sali bankietowej Hotelu Nowy Dwór">

<!-- Zewnętrzne -->
<img src="hotel-nowy-dwor-zewnatrz.jpg"
     alt="Budynek Hotelu Nowy Dwór w Trzebnicy widok z zewnątrz">

<img src="parking-hotel-nowy-dwor.jpg"
     alt="Bezpłatny parking dla gości Hotelu Nowy Dwór">
```

---

## 🔧 SEO Technical

### Robots.txt

**Lokalizacja:** `https://www.hotelnowydwor.eu/robots.txt`

**Zawartość (zalecana):**

```
User-agent: *
Allow: /
Disallow: /wp-admin/
Disallow: /wp-includes/
Disallow: /wp-content/plugins/
Disallow: /wp-content/themes/
Disallow: /trackback/
Disallow: */trackback/
Disallow: */comments/
Disallow: */feed/
Disallow: */rss/
Disallow: /xmlrpc.php
Disallow: *?replytocom=
Disallow: /tag/
Disallow: /author/
Disallow: /page/
Disallow: /*?s=
Disallow: /*?

Allow: /wp-content/uploads/

Sitemap: https://www.hotelnowydwor.eu/sitemap.xml
```

### XML Sitemap

**Lokalizacja:** `https://www.hotelnowydwor.eu/sitemap.xml`

**Best Practices:**
- **Tylko ważne strony:** Homepage, Pokoje, Restauracja, Wesela, Konferencje, Kontakt, O Nas, FAQ
- **Priorytet:** Homepage (1.0), Główne strony (0.8), Podstrony (0.5)
- **Częstotliwość:** Homepage (daily), Główne strony (weekly), Podstrony (monthly)
- **Ostatnia modyfikacja:** Aktualna data ostatniej zmiany

**Przykład:**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  <!-- Homepage -->
  <url>
    <loc>https://www.hotelnowydwor.eu/</loc>
    <lastmod>2025-01-15</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>

  <!-- Pokoje -->
  <url>
    <loc>https://www.hotelnowydwor.eu/pokoje/</loc>
    <lastmod>2025-01-10</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Restauracja -->
  <url>
    <loc>https://www.hotelnowydwor.eu/restauracja/</loc>
    <lastmod>2025-01-10</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Sale Weselne -->
  <url>
    <loc>https://www.hotelnowydwor.eu/sale-weselne/</loc>
    <lastmod>2025-01-10</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Sale Konferencyjne -->
  <url>
    <loc>https://www.hotelnowydwor.eu/sale-konferencyjne/</loc>
    <lastmod>2025-01-10</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Kontakt -->
  <url>
    <loc>https://www.hotelnowydwor.eu/kontakt/</loc>
    <lastmod>2025-01-05</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>

  <!-- O Nas -->
  <url>
    <loc>https://www.hotelnowydwor.eu/o-nas/</loc>
    <lastmod>2025-01-05</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>

  <!-- FAQ -->
  <url>
    <loc>https://www.hotelnowydwor.eu/faq/</loc>
    <lastmod>2025-01-10</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.6</priority>
  </url>

  <!-- Galeria -->
  <url>
    <loc>https://www.hotelnowydwor.eu/galeria/</loc>
    <lastmod>2025-01-08</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.6</priority>
  </url>

  <!-- Blog Posts -->
  <url>
    <loc>https://www.hotelnowydwor.eu/blog/atrakcje-trzebnica/</loc>
    <lastmod>2025-01-12</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>

</urlset>
```

### Canonical URLs

**Best Practices:**
- **Każda strona:** Dodaj canonical do każdej strony
- **Self-referencing:** Strona wskazuje na samą siebie
- **Absolutne URL:** Zawsze pełny adres URL
- **HTTPS:** Zawsze używaj HTTPS

```html
<!-- Homepage -->
<link rel="canonical" href="https://www.hotelnowydwor.eu/">

<!-- Pokoje -->
<link rel="canonical" href="https://www.hotelnowydwor.eu/pokoje/">

<!-- Restauracja -->
<link rel="canonical" href="https://www.hotelnowydwor.eu/restauracja/">

<!-- Kontakt -->
<link rel="canonical" href="https://www.hotelnowydwor.eu/kontakt/">
```

### Hreflang (Multi-language)

**Jeśli strona będzie dostępna w wielu językach:**

```html
<!-- Polska -->
<link rel="alternate" hreflang="pl" href="https://www.hotelnowydwor.eu/">
<link rel="alternate" hreflang="pl-PL" href="https://www.hotelnowydwor.eu/">

<!-- Angielska -->
<link rel="alternate" hreflang="en" href="https://www.hotelnowydwor.eu/en/">
<link rel="alternate" hreflang="en-GB" href="https://www.hotelnowydwor.eu/en/">

<!-- Niemiecka -->
<link rel="alternate" hreflang="de" href="https://www.hotelnowydwor.eu/de/">
<link rel="alternate" hreflang="de-DE" href="https://www.hotelnowydwor.eu/de/">

<!-- Default -->
<link rel="alternate" hreflang="x-default" href="https://www.hotelnowydwor.eu/">
```

### HTTPS Enforcement

**Best Practices:**
- **Redirect HTTP → HTTPS:** Automatyczne przekierowanie
- **HSTS Header:** HTTP Strict Transport Security
- **SSL Certificate:** Ważny certyfikat SSL/TLS
- **Mixed Content:** Wszystkie zasoby przez HTTPS

**`.htaccess` Configuration:**

```apache
# Force HTTPS
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteCond %{HTTPS} off
  RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>

# HSTS Header
<IfModule mod_headers.c>
  Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
</IfModule>
```

---

## ⚡ Performance Optimization

### PageSpeed Score Target: ≥90

**Core Performance Metrics:**
- **LCP (Largest Contentful Paint):** <2.5s
- **FID (First Input Delay):** <100ms
- **CLS (Cumulative Layout Shift):** <0.1
- **FCP (First Contentful Paint):** <1.8s
- **TTI (Time to Interactive):** <3.8s

### Critical Rendering Path Optimization

1. **Minimize Critical Resources**
2. **Optimize Critical Bytes**
3. **Shorten Critical Path Length**

**Implementation:**

```html
<!-- Critical CSS (Inline) -->
<style>
  /* Critical above-the-fold CSS */
  body { margin: 0; font-family: Arial, sans-serif; }
  .header { background: #0a97b0; padding: 1rem; }
  .hero { min-height: 400px; background: url('hero-min.jpg'); }
</style>

<!-- Defer Non-Critical CSS -->
<link rel="preload" href="/css/main.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/css/main.css"></noscript>

<!-- Defer JavaScript -->
<script src="/js/main.js" defer></script>
```

### Image Optimization

**Best Practices:**
- **Format:** WebP dla nowoczesnych przeglądarek, JPEG/PNG jako fallback
- **Compression:** Quality 80-85% dla JPEG
- **Responsive:** Różne rozmiary dla różnych urządzeń
- **Lazy Loading:** Ładuj obrazy tylko gdy są widoczne
- **Dimensions:** Zawsze określaj width i height

**WordPress Implementation:**

```php
// Enable lazy loading
add_filter( 'wp_lazy_loading_enabled', '__return_true' );

// WebP support
function add_webp_upload_mimes( $mimes ) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter( 'upload_mimes', 'add_webp_upload_mimes' );
```

**HTML Implementation:**

```html
<!-- Responsive Image with WebP -->
<picture>
  <source type="image/webp"
          srcset="hotel-nowy-dwor-320.webp 320w,
                  hotel-nowy-dwor-640.webp 640w,
                  hotel-nowy-dwor-1024.webp 1024w,
                  hotel-nowy-dwor-1920.webp 1920w"
          sizes="(max-width: 640px) 320px,
                 (max-width: 1024px) 640px,
                 (max-width: 1920px) 1024px,
                 1920px">
  <source type="image/jpeg"
          srcset="hotel-nowy-dwor-320.jpg 320w,
                  hotel-nowy-dwor-640.jpg 640w,
                  hotel-nowy-dwor-1024.jpg 1024w,
                  hotel-nowy-dwor-1920.jpg 1920w"
          sizes="(max-width: 640px) 320px,
                 (max-width: 1024px) 640px,
                 (max-width: 1920px) 1024px,
                 1920px">
  <img src="hotel-nowy-dwor-1024.jpg"
       alt="Hotel Nowy Dwór Trzebnica widok z zewnątrz"
       width="1024"
       height="768"
       loading="lazy">
</picture>
```

### Browser Caching

**`.htaccess` Configuration:**

```apache
<IfModule mod_expires.c>
  ExpiresActive On

  # Images
  ExpiresByType image/jpg "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/gif "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/svg+xml "access plus 1 year"
  ExpiresByType image/x-icon "access plus 1 year"

  # CSS and JavaScript
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType text/javascript "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
  ExpiresByType application/x-javascript "access plus 1 month"

  # Fonts
  ExpiresByType font/ttf "access plus 1 year"
  ExpiresByType font/otf "access plus 1 year"
  ExpiresByType font/woff "access plus 1 year"
  ExpiresByType font/woff2 "access plus 1 year"
  ExpiresByType application/font-woff "access plus 1 year"

  # Other
  ExpiresByType application/pdf "access plus 1 month"
  ExpiresByType text/html "access plus 0 seconds"
</IfModule>
```

### GZIP/Brotli Compression

**`.htaccess` Configuration:**

```apache
# GZIP Compression
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html
  AddOutputFilterByType DEFLATE text/css
  AddOutputFilterByType DEFLATE text/javascript
  AddOutputFilterByType DEFLATE text/xml
  AddOutputFilterByType DEFLATE text/plain
  AddOutputFilterByType DEFLATE application/javascript
  AddOutputFilterByType DEFLATE application/x-javascript
  AddOutputFilterByType DEFLATE application/json
  AddOutputFilterByType DEFLATE application/xml
  AddOutputFilterByType DEFLATE application/xhtml+xml
  AddOutputFilterByType DEFLATE application/rss+xml
  AddOutputFilterByType DEFLATE application/atom+xml
  AddOutputFilterByType DEFLATE image/svg+xml
</IfModule>

# Brotli Compression (if available)
<IfModule mod_brotli.c>
  AddOutputFilterByType BROTLI_COMPRESS text/html
  AddOutputFilterByType BROTLI_COMPRESS text/css
  AddOutputFilterByType BROTLI_COMPRESS text/javascript
  AddOutputFilterByType BROTLI_COMPRESS application/javascript
  AddOutputFilterByType BROTLI_COMPRESS application/json
</IfModule>
```

### Minification (CSS, JS, HTML)

**WordPress Plugin:** WP Speed of Light (już zainstalowany)

**Manual Minification:**

```php
// Minify HTML output
function minify_html_output( $buffer ) {
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags
        '/[^\S ]+\</s',  // strip whitespaces before tags
        '/(\s)+/s',      // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // remove HTML comments
    );
    $replace = array( '>', '<', '\\1', '' );
    $buffer = preg_replace( $search, $replace, $buffer );
    return $buffer;
}
ob_start( 'minify_html_output' );
```

### Database Optimization

**WordPress Best Practices:**
- **Clean up revisions:** Max 3 revisions per post
- **Delete spam comments:** Regularly clean spam
- **Optimize tables:** Monthly database optimization
- **Remove unused plugins/themes:** Delete completely

```php
// wp-config.php
define( 'WP_POST_REVISIONS', 3 );
define( 'AUTOSAVE_INTERVAL', 300 ); // 5 minutes
define( 'EMPTY_TRASH_DAYS', 7 ); // 7 days
```

---

## 🏢 Schema.org & Structured Data

### Hotel Schema (Priority!)

**Lokalizacja:** Homepage lub każda strona

```json
{
  "@context": "https://schema.org",
  "@type": "Hotel",
  "name": "Hotel Nowy Dwór",
  "image": [
    "https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-front.jpg",
    "https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-lobby.jpg",
    "https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-room-lux.jpg"
  ],
  "description": "Hotel Nowy Dwór to 3-gwiazdkowy hotel w Trzebnicy, 15 km od Wrocławia. Oferujemy 28 komfortowych pokoi, restaurację z kuchnią polską oraz sale weselne i konferencyjne.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Nowy Dwór 2",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressRegion": "Dolnośląskie",
    "addressCountry": "PL"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "51.3094",
    "longitude": "17.0633"
  },
  "url": "https://www.hotelnowydwor.eu/",
  "telephone": "+48713120714",
  "email": "rezerwacja@hotelnowydwor.eu",
  "priceRange": "$$",
  "starRating": {
    "@type": "Rating",
    "ratingValue": "3"
  },
  "numberOfRooms": "28",
  "checkinTime": "15:00",
  "checkoutTime": "11:00",
  "petsAllowed": "False",
  "amenityFeature": [
    {
      "@type": "LocationFeatureSpecification",
      "name": "Free WiFi",
      "value": true
    },
    {
      "@type": "LocationFeatureSpecification",
      "name": "Free Parking",
      "value": true
    },
    {
      "@type": "LocationFeatureSpecification",
      "name": "Restaurant",
      "value": true
    },
    {
      "@type": "LocationFeatureSpecification",
      "name": "Conference Rooms",
      "value": true
    },
    {
      "@type": "LocationFeatureSpecification",
      "name": "Wedding Venue",
      "value": true
    },
    {
      "@type": "LocationFeatureSpecification",
      "name": "Event Halls",
      "value": true
    }
  ],
  "potentialAction": {
    "@type": "ReserveAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "https://www.hotelnowydwor.eu/kontakt/",
      "actionPlatform": [
        "http://schema.org/DesktopWebPlatform",
        "http://schema.org/MobileWebPlatform"
      ]
    },
    "result": {
      "@type": "LodgingReservation",
      "name": "Book a room"
    }
  }
}
```

### LocalBusiness Schema

```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Hotel Nowy Dwór",
  "image": "https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-logo.png",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Nowy Dwór 2",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressCountry": "PL"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "51.3094",
    "longitude": "17.0633"
  },
  "url": "https://www.hotelnowydwor.eu/",
  "telephone": "+48713120714",
  "email": "rezerwacja@hotelnowydwor.eu",
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
      ],
      "opens": "00:00",
      "closes": "23:59"
    }
  ],
  "priceRange": "$$"
}
```

### Restaurant Schema

**Lokalizacja:** Strona `/restauracja/` lub `/restauracja/menu/`

```json
{
  "@context": "https://schema.org",
  "@type": "Restaurant",
  "name": "Restauracja Hotel Nowy Dwór",
  "image": "https://www.hotelnowydwor.eu/wp-content/uploads/restauracja-hotel-nowy-dwor.jpg",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Nowy Dwór 2",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressCountry": "PL"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "51.3094",
    "longitude": "17.0633"
  },
  "url": "https://www.hotelnowydwor.eu/restauracja/",
  "telephone": "+48713120714",
  "servesCuisine": "Polish",
  "priceRange": "$$",
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday"
      ],
      "opens": "12:00",
      "closes": "21:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Saturday",
        "Sunday"
      ],
      "opens": "12:00",
      "closes": "22:00"
    }
  ],
  "menu": "https://www.hotelnowydwor.eu/restauracja/menu/"
}
```

### FAQ Schema

**Lokalizacja:** Strona `/faq/`

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Jaka jest godzina meldunku w Hotelu Nowy Dwór?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Meldunek w Hotelu Nowy Dwór odbywa się od godziny 15:00. Jeśli potrzebujesz wcześniejszego meldunku, skontaktuj się z recepcją pod numerem +48 71 312 07 14."
      }
    },
    {
      "@type": "Question",
      "name": "Jaka jest godzina wymeldowania?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Wymeldowanie w Hotelu Nowy Dwór następuje do godziny 11:00. Późniejsze wymeldowanie możliwe jest po wcześniejszym uzgodnieniu z recepcją."
      }
    },
    {
      "@type": "Question",
      "name": "Czy hotel posiada bezpłatny parking?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tak, Hotel Nowy Dwór oferuje bezpłatny, monitorowany parking dla wszystkich gości hotelowych."
      }
    },
    {
      "@type": "Question",
      "name": "Czy w pokojach jest darmowe WiFi?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tak, wszystkie pokoje w Hotelu Nowy Dwór wyposażone są w bezpłatny dostęp do szybkiego WiFi."
      }
    },
    {
      "@type": "Question",
      "name": "Jak daleko jest hotel od Wrocławia?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Hotel Nowy Dwór znajduje się w Trzebnicy, około 15 km od Wrocławia. Dojazd samochodem trwa około 20 minut."
      }
    }
  ]
}
```

### BreadcrumbList Schema

```json
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Strona Główna",
      "item": "https://www.hotelnowydwor.eu/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Pokoje",
      "item": "https://www.hotelnowydwor.eu/pokoje/"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Pokoje LUX",
      "item": "https://www.hotelnowydwor.eu/pokoje-lux/"
    }
  ]
}
```

---

## 📝 Content Strategy

### Content Quality Guidelines

**Best Practices:**
- **Unikalna treść:** 100% oryginalna, nie kopiowana
- **Długość:** Min. 300 słów na stronę (ideally 500-1000)
- **Readability:** Krótkie akapity (2-3 zdania), bullet points
- **Słowa kluczowe:** Naturalne użycie 2-3% density
- **Nagłówki:** H2, H3 co 200-300 słów
- **CTA:** Call-to-action w każdej sekcji

### Keyword Density

**Zalecenia:**
- **Primary Keyword:** 1-2% (np. "hotel trzebnica")
- **Secondary Keywords:** 0.5-1% (np. "pokoje hotelowe", "sale weselne")
- **LSI Keywords:** Naturalnie (np. "nocleg", "rezerwacja", "wypoczynek")

**Przykład dla strony głównej:**

```
Target: 1000 słów
Primary Keyword "hotel trzebnica": 10-20 użyć
Secondary Keywords: 5-10 użyć każde
LSI Keywords: Naturalnie rozrzucone
```

### Content Calendar (Blog)

**Częstotliwość:** 2-4 wpisy miesięcznie

**Tematy dla Hotelu Nowy Dwór:**

1. **Atrakcje turystyczne Trzebnicy i okolic**
2. **Jak zorganizować wesele w stylu rustykalnym?**
3. **Najlepsze miejsca na konferencje biznesowe k. Wrocławia**
4. **10 powodów, żeby odwiedzić Trzebnicę**
5. **Historia Bazyliki Św. Jadwigi w Trzebnicy**
6. **Weekendowy wypad z Wrocławia - gdzie jechać?**
7. **Kuchnia polska w Hotelu Nowy Dwór - nasze specjały**
8. **Jak wybrać idealną salę weselną? Poradnik**
9. **Organizacja eventów firmowych - checklist**
10. **Sezonowe menu w restauracji Hotelu Nowy Dwór**

### Content Optimization Checklist

**Przed publikacją sprawdź:**

- [ ] Title tag (50-60 znaków)
- [ ] Meta description (150-160 znaków)
- [ ] H1 heading (tylko jeden, z keyword)
- [ ] H2, H3 headings (hierarchia)
- [ ] Alt text na wszystkich obrazach
- [ ] Internal links (3-5 na stronę)
- [ ] External links (2-3 do wiarygodnych źródeł)
- [ ] Keyword density (1-2% primary)
- [ ] Readability (krótkie akapity)
- [ ] CTA buttons (min. 2 na stronę)
- [ ] Schema.org (jeśli dotyczy)
- [ ] Mobile-friendly (responsywność)

---

## 📍 Local SEO

### Google Business Profile

**Priorytet:** Bardzo wysoki!

**Setup Checklist:**

- [ ] Claim and verify Google Business Profile
- [ ] Complete all business information:
  - Name: Hotel Nowy Dwór
  - Address: ul. Nowy Dwór 2, 55-100 Trzebnica
  - Phone: +48 71 312 07 14
  - Website: https://www.hotelnowydwor.eu/
  - Category: Hotel, Restaurant, Event Venue
  - Hours: 24/7 (hotel), Restaurant hours
- [ ] Add high-quality photos (min. 10):
  - Exterior
  - Lobby
  - Rooms
  - Restaurant
  - Event halls
  - Amenities
- [ ] Encourage reviews (Google, TripAdvisor, Booking.com)
- [ ] Respond to all reviews (within 24-48h)
- [ ] Post updates regularly (weekly)
- [ ] Add Q&A section

### NAP Consistency

**NAP = Name, Address, Phone**

**Ensure consistent information across:**
- Website footer
- Contact page
- Google Business Profile
- Social media profiles
- Online directories
- Citations

**Correct NAP:**
```
Hotel Nowy Dwór
ul. Nowy Dwór 2
55-100 Trzebnica
Polska
+48 71 312 07 14
rezerwacja@hotelnowydwor.eu
```

### Local Citations

**Submit to:**
- **Polish Directories:**
  - Panoramafirm.pl
  - TuOnet.pl
  - Cylex.pl
  - Yelp.pl
  - GoldenLine.pl

- **Hotel Directories:**
  - Booking.com
  - TripAdvisor.pl
  - Hotels.com
  - Expedia.pl
  - Trivago.pl

- **Local Business:**
  - Dolny Śląsk tourism sites
  - Wrocław tourism sites
  - Trzebnica city website

### Local Keywords

**Target:**
- Hotel Trzebnica
- Hotel Nowy Dwór
- Hotele Trzebnica
- Noclegi Trzebnica
- Hotel k. Wrocławia
- Hotel Dolny Śląsk
- Wesela Trzebnica
- Sale weselne Trzebnica
- Sale konferencyjne Trzebnica
- Restauracja Trzebnica
- Hotel 15 km od Wrocławia

---

## 📱 Mobile-First Indexing

### Mobile Optimization

**Best Practices:**
- **Responsive Design:** Automatically adapt to all screen sizes
- **Touch Targets:** Min. 48x48px buttons
- **Font Size:** Min. 16px for body text
- **Viewport Meta:** Properly configured
- **No Flash:** Use HTML5, CSS3, JavaScript
- **Mobile Speed:** PageSpeed ≥90

**Viewport Meta Tag:**

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
```

### Mobile-Specific Features

**Implement:**
- Click-to-call buttons: `<a href="tel:+48713120714">+48 71 312 07 14</a>`
- Maps integration: Google Maps embed
- Mobile-friendly forms: Large inputs, clear labels
- Hamburger menu: For navigation on mobile
- Sticky header: Easy access to contact/booking

---

## 🚀 Core Web Vitals

### LCP (Largest Contentful Paint)

**Target:** <2.5s

**Optimization:**
- Optimize hero images (WebP, compression)
- Use CDN for static assets
- Implement lazy loading
- Preload critical resources
- Minimize render-blocking resources

**Example:**

```html
<!-- Preload Hero Image -->
<link rel="preload" href="/images/hero-hotel-nowy-dwor.webp" as="image">

<!-- Preconnect to external domains -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://www.google-analytics.com">
```

### FID (First Input Delay)

**Target:** <100ms

**Optimization:**
- Minimize JavaScript execution time
- Code splitting
- Remove unused JavaScript
- Use Web Workers for heavy tasks

### CLS (Cumulative Layout Shift)

**Target:** <0.1

**Optimization:**
- Always specify image dimensions (width/height)
- Reserve space for ads/embeds
- Avoid inserting content above existing content
- Use CSS aspect-ratio

**Example:**

```html
<!-- Specify dimensions -->
<img src="hotel.jpg" alt="Hotel Nowy Dwór" width="800" height="600" loading="lazy">

<!-- CSS aspect-ratio -->
<style>
  .image-container {
    aspect-ratio: 16 / 9;
  }
</style>
```

---

## 🔌 WordPress SEO

### Essential WordPress SEO Settings

**Permalinks:**
```
Settings → Permalinks → Post name
```

**Discourage Search Engines (MUST BE UNCHECKED!):**
```
Settings → Reading → Uncheck "Discourage search engines"
```

**Remove Category/Tag Base:**
```
Settings → Permalinks → Optional → Leave blank
```

### Recommended SEO Plugins

**Option 1: Yoast SEO (Most Popular)**
- Meta tag management
- XML sitemap generation
- Breadcrumbs
- Schema.org markup
- Readability analysis

**Option 2: Rank Math (Alternative)**
- Similar features to Yoast
- Google Search Console integration
- More detailed analytics

**Option 3: All in One SEO Pack**
- Lightweight alternative

### WordPress Performance Plugins

**Already Installed:**
- WP Speed of Light

**Consider Adding:**
- WP Rocket (caching, minification, lazy load)
- Autoptimize (CSS/JS optimization)
- ShortPixel (image optimization)

---

## 🎨 Oxygen Builder SEO

### Oxygen SEO Settings

**Global Settings:**
- Enable SEO meta fields
- Configure default title/description
- Set up Open Graph defaults
- Configure Schema.org defaults

### Per-Page SEO

**Each Oxygen template should have:**
- Custom title tag
- Custom meta description
- Custom Open Graph image
- Structured data (Schema.org)

### Dynamic Content SEO

**Use ACF fields for:**
- Dynamic titles
- Dynamic descriptions
- Dynamic Schema.org data

**Example:**

```php
// Dynamic title from ACF
<title><?php the_field('seo_title'); ?> | Hotel Nowy Dwór</title>

// Dynamic meta description
<meta name="description" content="<?php the_field('seo_description'); ?>">
```

---

## 🖼️ Image Optimization

### Image Best Practices

**Format:**
- **WebP:** Modern browsers (80-90% smaller than JPEG)
- **AVIF:** Next-gen format (even smaller than WebP)
- **JPEG:** Fallback for photos
- **PNG:** Fallback for graphics with transparency

**Dimensions:**
- **Hero:** 1920x1080px (Full HD)
- **Gallery:** 1200x800px
- **Thumbnails:** 400x300px
- **Icons:** 64x64px (SVG preferred)

**Compression:**
- **JPEG:** Quality 80-85%
- **PNG:** TinyPNG or similar
- **WebP:** Quality 80%

### WebP Express Plugin (Installed)

**Configuration:**
- Enable WebP conversion for all uploads
- Enable AVIF as fallback
- Configure quality: 80%
- Enable picture element
- Enable .htaccess rules

---

## 🔗 Link Building

### Internal Linking Strategy

**Best Practices:**
- Link from high-authority pages to low-authority pages
- Use descriptive anchor text
- Create content silos
- Link to related content
- Update old posts with new links

**Example Structure:**

```
Homepage (Authority: High)
├─→ Pokoje (Authority: High)
│   ├─→ Pokoje Standard (Authority: Medium)
│   └─→ Pokoje LUX (Authority: Medium)
├─→ Restauracja (Authority: High)
│   ├─→ Menu (Authority: Medium)
│   └─→ Catering (Authority: Medium)
└─→ Blog (Authority: Medium)
    ├─→ Post 1 (Authority: Low)
    └─→ Post 2 (Authority: Low)
```

### External Link Building

**White Hat Techniques:**
- **Guest Posting:** Write for tourism blogs
- **Local Partnerships:** Link exchanges with local businesses
- **Press Releases:** Announce events, renovations
- **Social Media:** Share content on Facebook, Instagram
- **Directories:** Submit to quality directories
- **Reviews:** Encourage guest reviews with links

**Avoid:**
- Buying links
- Link farms
- Low-quality directories
- Excessive reciprocal linking
- Spammy comments

---

## 📊 Analytics & Monitoring

### Google Analytics 4

**Setup:**
- Create GA4 property
- Install tracking code
- Configure goals/conversions:
  - Contact form submissions
  - Phone clicks
  - Email clicks
  - Booking page visits
  - Room page visits

**Key Metrics to Track:**
- **Traffic:** Sessions, users, page views
- **Engagement:** Bounce rate, time on site, pages/session
- **Conversions:** Form submissions, phone calls, bookings
- **Sources:** Organic, direct, referral, social

### Google Search Console

**Setup:**
- Verify website ownership
- Submit sitemap.xml
- Monitor search performance
- Fix crawl errors
- Check mobile usability

**Key Reports:**
- **Performance:** Clicks, impressions, CTR, position
- **Coverage:** Indexed pages, errors, warnings
- **Enhancements:** Core Web Vitals, mobile usability
- **Links:** Internal links, external links, top linking sites

### PageSpeed Insights

**Monitor:**
- Monthly PageSpeed tests
- Track LCP, FID, CLS
- Compare mobile vs desktop
- Monitor field data (real users)

**Target Scores:**
- **Mobile:** ≥90
- **Desktop:** ≥95

### Rank Tracking

**Tools:**
- SEMrush
- Ahrefs
- SE Ranking
- SERPWatcher

**Keywords to Track:**
- Hotel Trzebnica (Primary)
- Hotel Nowy Dwór (Brand)
- Hotele Trzebnica
- Noclegi Trzebnica
- Hotel k. Wrocławia
- Wesela Trzebnica
- Sale konferencyjne Trzebnica
- Restauracja Trzebnica

**Frequency:** Weekly checks

---

## ✅ SEO Checklist - Implementation

### Phase 1: Technical SEO (Week 1-2)

- [ ] Install SSL certificate (HTTPS)
- [ ] Configure robots.txt
- [ ] Generate XML sitemap
- [ ] Submit sitemap to Google Search Console
- [ ] Set up Google Analytics 4
- [ ] Configure canonical URLs
- [ ] Implement 301 redirects (HTTP → HTTPS)
- [ ] Fix broken links
- [ ] Optimize URL structure
- [ ] Configure breadcrumbs

### Phase 2: On-Page SEO (Week 3-4)

- [ ] Optimize title tags (all pages)
- [ ] Write meta descriptions (all pages)
- [ ] Fix heading hierarchy (H1-H6)
- [ ] Add alt text to all images
- [ ] Optimize internal linking
- [ ] Add Schema.org markup (Hotel, LocalBusiness, Restaurant, FAQ)
- [ ] Configure Open Graph tags
- [ ] Implement Twitter Cards

### Phase 3: Performance (Week 5-6)

- [ ] Convert images to WebP/AVIF
- [ ] Implement lazy loading
- [ ] Enable GZIP compression
- [ ] Configure browser caching
- [ ] Minify CSS/JS/HTML
- [ ] Optimize Critical Rendering Path
- [ ] Test PageSpeed (target ≥90)
- [ ] Fix Core Web Vitals issues

### Phase 4: Content (Week 7-8)

- [ ] Expand FAQ page (20+ questions)
- [ ] Optimize hotel description
- [ ] Add detailed room descriptions
- [ ] Create restaurant menu page
- [ ] Write about event/wedding services
- [ ] Add blog posts (4-6 articles)
- [ ] Optimize image gallery
- [ ] Update contact page

### Phase 5: Local SEO (Week 9-10)

- [ ] Claim Google Business Profile
- [ ] Complete GBP information
- [ ] Upload GBP photos (10+)
- [ ] Submit to local directories
- [ ] Submit to hotel booking sites
- [ ] Ensure NAP consistency
- [ ] Encourage guest reviews
- [ ] Create location-based content

### Phase 6: Monitoring (Week 11-12)

- [ ] Set up rank tracking
- [ ] Configure Google Search Console
- [ ] Configure Google Analytics goals
- [ ] Set up weekly reports
- [ ] Monitor PageSpeed scores
- [ ] Track Core Web Vitals
- [ ] Review backlink profile
- [ ] Analyze competitor SEO

---

## 🎓 SEO Resources

### Official Documentation

- **Google Search Central:** https://developers.google.com/search
- **Schema.org:** https://schema.org/
- **WordPress SEO:** https://wordpress.org/support/article/search-engine-optimization/
- **Core Web Vitals:** https://web.dev/vitals/

### SEO Tools

**Free:**
- Google Search Console
- Google Analytics
- PageSpeed Insights
- Lighthouse
- Google Business Profile

**Paid:**
- SEMrush
- Ahrefs
- Moz Pro
- SE Ranking

### Testing Tools

- **PageSpeed:** https://pagespeed.web.dev/
- **Mobile-Friendly:** https://search.google.com/test/mobile-friendly
- **Structured Data:** https://validator.schema.org/
- **Rich Results:** https://search.google.com/test/rich-results
- **Security Headers:** https://securityheaders.com/

---

## 📌 Key Takeaways

1. ✅ **Meta tags** are critical - unique title/description for every page
2. ✅ **Schema.org** Hotel markup is essential for Google rich results
3. ✅ **PageSpeed ≥90** is the target - optimize images, enable caching, minify
4. ✅ **Mobile-first** - ensure responsive design and mobile usability
5. ✅ **Local SEO** - claim Google Business Profile, get reviews
6. ✅ **Content quality** - unique, valuable content with natural keyword usage
7. ✅ **Core Web Vitals** - LCP <2.5s, FID <100ms, CLS <0.1
8. ✅ **Internal linking** - connect related pages with descriptive anchors
9. ✅ **Analytics** - track everything, measure results, iterate
10. ✅ **Consistency** - NAP, URL structure, content updates

---

**Document Version:** 1.0
**Last Updated:** 2025-01-15
**Author:** Claude AI - SEO Specialist
**Project:** Hotel Nowy Dwór SEO Optimization
