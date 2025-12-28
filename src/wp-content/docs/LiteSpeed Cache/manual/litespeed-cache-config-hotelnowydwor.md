# Konfiguracja LiteSpeed Cache v7.7 dla Hotel Nowy Dwór

**Witryna:** https://nowydwor.smarthost.pl/hotelnowydwor.eu-new/  
**CMS:** WordPress + Oxygen Builder  
**Data wygenerowania:** 28 grudnia 2024  
**Cel:** Osiągnięcie PageSpeed ≥90 punktów, optymalizacja wydajności i cache

---

## 📋 Spis Treści

1. [Wprowadzenie](#wprowadzenie)
2. [Podstawowa Konfiguracja Cache](#podstawowa-konfiguracja-cache)
3. [Ustawienia Optymalizacji](#ustawienia-optymalizacji)
4. [Ustawienia Obrazów](#ustawienia-obrazów)
5. [Ustawienia JS/CSS](#ustawienia-jscss)
6. [Wykluczenia i Wyjątki](#wykluczenia-i-wyjątki)
7. [Zaawansowane Ustawienia](#zaawansowane-ustawienia)
8. [Instrukcja Implementacji](#instrukcja-implementacji)

---

## 🎯 Wprowadzenie

Niniejsza konfiguracja została przygotowana specjalnie dla witryny Hotel Nowy Dwór, bazując na:

- **Analizie struktury strony** (WordPress + Oxygen Builder)
- **Typie treści** (hotel, pokoje, restauracja, system rezerwacji NFHotel)
- **Celach wydajnościowych** (PageSpeed ≥90, Core Web Vitals)
- **Najlepszych praktykach** LiteSpeed Cache dla WordPress

### Kluczowe Założenia:

✅ **System rezerwacji NFHotel** - wymaga wykluczenia z cache  
✅ **Obrazy hotelowe** - agresywna optymalizacja WebP/AVIF + Lazy Loading  
✅ **Strony statyczne** - maksymalne wykorzystanie cache  
✅ **Formularze kontaktowe** - wykluczenie z cache dla bezpieczeństwa  
✅ **Mobile-First** - priorytet optymalizacji mobilnej

---

## 📦 Podstawowa Konfiguracja Cache

### 1. Prywatne zapisane URLe

```
/hotelnowydwor.eu-new/koszyk
/hotelnowydwor.eu-new/konto
/hotelnowydwor.eu-new/checkout
/hotelnowydwor.eu-new/moje-konto
/hotelnowydwor.eu-new/wp-admin
```

**Wyjaśnienie:**  
Strony związane z sesją użytkownika i obszarem administracyjnym powinny być cachowane prywatnie (per użytkownik), nie publicznie. Chociaż witryna hotelowa nie ma sklepu WooCommerce, zachowujemy standardowe ścieżki WordPress na wypadek przyszłych rozszerzeń.

---

### 2. Wymuś identyfikatory URI pamięci podręcznej

```
/hotelnowydwor.eu-new/
/hotelnowydwor.eu-new/o-nas
/hotelnowydwor.eu-new/pokoje
/hotelnowydwor.eu-new/restauracja
/hotelnowydwor.eu-new/udogodnienia
/hotelnowydwor.eu-new/galeria
/hotelnowydwor.eu-new/kontakt
/hotelnowydwor.eu-new/faq
/hotelnowydwor.eu-new/regulamin
/hotelnowydwor.eu-new/polityka-prywatnosci
```

**Wyjaśnienie:**  
Kluczowe strony statyczne, które powinny być ZAWSZE cachowane agresywnie. Są to strony, które rzadko się zmieniają i stanowią rdzeń witryny hotelowej.

---

### 3. Wymuś publiczne identyfikatory URI pamięci podręcznej

```
/hotelnowydwor.eu-new/restauracja/menu
/hotelnowydwor.eu-new/restauracja/przyjecia
/hotelnowydwor.eu-new/restauracja/wesela
/hotelnowydwor.eu-new/blog
```

**Wyjaśnienie:**  
Podstrony restauracji i blog są identyczne dla wszystkich użytkowników, więc mogą być cachowane publicznie (shared cache), co znacząco zwiększa wydajność.

---

### 4. Usuń ciąg zapytań

```
v
ver
version
source
_ga
_gid
utm_source
utm_medium
utm_campaign
utm_term
utm_content
fbclid
gclid
_gl
mc_cid
mc_eid
```

**Wyjaśnienie:**  
Parametry URL związane z analityką (Google Analytics, UTM, Facebook) nie wpływają na treść strony, więc powinny być ignorowane przez cache. Zapobiega to tworzeniu duplikatów cache dla tej samej strony.

---

### 5. Zaplanowane adresy URL

```
Pozostaw puste
```

**Wyjaśnienie:**  
To pole służy do planowania automatycznego czyszczenia cache konkretnych URL o określonych godzinach. Dla witryny hotelowej nie jest to konieczne - cache będzie czyszczony automatycznie przy aktualizacji treści.

---

### 6. Zaplanowany czas czyszczenia

```
Pozostaw puste
```

**Wyjaśnienie:**  
Analogicznie do powyższego - automatyczne czyszczenie cache nie jest wymagane. WordPress i LiteSpeed Cache automatycznie wyczyści cache po publikacji/aktualizacji treści.

---

### 7. Wyczyść wszystkie rozszerzenia

```
Pozostaw puste (domyślnie: on)
```

**Wyjaśnienie:**  
Po czyszczeniu cache głównej strony, LiteSpeed automatycznie wyczyści również związane warianty (np. mobile, WebP). Domyślne ustawienie jest optymalne.

---

## 🚫 Wykluczenia z Cache

### 8. Nie zapisuj w pamięci podręcznej URLów

```
/hotelnowydwor.eu-new/wp-admin
/hotelnowydwor.eu-new/wp-login.php
/hotelnowydwor.eu-new/rezerwacja
/hotelnowydwor.eu-new/booking
/hotelnowydwor.eu-new/wp-json
/hotelnowydwor.eu-new/.*preview=true
/hotelnowydwor.eu-new/xmlrpc.php
/hotelnowydwor.eu-new/nfhotel
/hotelnowydwor.eu-new/.*checkout.*
```

**Wyjaśnienie:**  
**KLUCZOWE dla systemu rezerwacji NFHotel!** Te URLe nie mogą być cachowane, ponieważ:
- `/wp-admin` - panel administracyjny WordPress
- `/rezerwacja`, `/booking`, `/nfhotel` - system rezerwacji NFHotel wymaga dynamicznych danych
- `/wp-json` - REST API WordPress używane przez moduły rezerwacyjne
- `.*preview=true` - podgląd zmian w Oxygen Builder
- `.*checkout.*` - proces rezerwacji/zamówienia

---

### 9. Nie zapisuj w pamięci podręcznej query stringów

```
s
search
q
query
preview
preview_id
preview_nonce
customize_changeset_uuid
customize_theme
customize_messenger_channel
availability
check_in
check_out
guests
rooms
booking_id
reservation_id
payment_status
```

**Wyjaśnienie:**  
**Krytyczne dla systemu rezerwacji!** Parametry związane z:
- Wyszukiwaniem (`s`, `search`, `q`)
- Podglądem WordPress (`preview`, `customize`)
- **Rezerwacjami NFHotel** (`availability`, `check_in`, `check_out`, `guests`, `rooms`, `booking_id`, `reservation_id`)
- Statusem płatności (`payment_status`)

Te parametry muszą generować unikalne strony bez cache.

---

### 10. Nie zapisuj w pamięci podręcznej kategorii

```
Pozostaw puste
```

**Wyjaśnienie:**  
Witryna hotelowa nie wykorzystuje standardowych kategorii WordPress (głównie używane w blogach). Wszystkie kategorie blogowe mogą być cachowane. Jeśli w przyszłości pojawią się kategorie, które nie powinny być cachowane, można je tutaj dodać.

---

### 11. Nie zapisuj w pamięci podręcznej tagów

```
Pozostaw puste
```

**Wyjaśnienie:**  
Analogicznie do kategorii - tagi blogowe mogą być normalnie cachowane. Witryna nie wymaga wykluczeń.

---

### 12. Nie zapisuj w pamięci podręcznej ciasteczek

```
wordpress_logged_in_*
wp-postpass_*
wordpress_test_cookie
comment_author_*
nfhotel_session
booking_session
user_session
cart_hash_*
woocommerce_items_in_cart
wp_woocommerce_session_*
```

**Wyjaśnienie:**  
**BARDZO WAŻNE!** Użytkownicy z tymi cookies muszą otrzymywać NIE-cachowaną wersję strony:
- `wordpress_logged_in_*` - zalogowani użytkownicy WordPress
- `nfhotel_session`, `booking_session` - sesje systemu rezerwacji NFHotel
- `comment_author_*` - autorzy komentarzy (widzą swoje komentarze od razu)
- WooCommerce cookies - na wypadek przyszłego dodania sklepu

---

### 13. Nie buforuj agentów użytkownika

```
facebookexternalhit
Twitterbot
LinkedInBot
WhatsApp
TelegramBot
Google Page Speed
GTmetrix
Pingdom
WebPageTest
Lighthouse
```

**Wyjaśnienie:**  
Wykluczenie botów społecznościowych i narzędzi testowych z cache:
- **Social bots** (Facebook, Twitter, WhatsApp) - muszą otrzymać aktualny Open Graph
- **Testing bots** (PageSpeed, GTmetrix) - muszą testować rzeczywistą wydajność bez cache
- **Lighthouse** - używany do Core Web Vitals

---

### 14. Kody jednorazowe ESI

```
Pozostaw puste (domyślnie: on)
```

**Wyjaśnienie:**  
ESI (Edge Side Includes) pozwala na cachowanie strony z dynamicznymi fragmentami (nonces). Domyślne ustawienie jest optymalne dla WordPress i bezpieczeństwa formularzy.

---

## ⏱️ Ustawienia Czasu (TTL)

### 15. TTL Pamięci podręcznej przeglądarki

```
2592000
```

**Wyjaśnienie:**  
**30 dni (2592000 sekund)** - czas przez jaki przeglądarka użytkownika będzie przechowywać zasoby statyczne (CSS, JS, obrazy) lokalnie. Zgodne z rekomendacjami Google PageSpeed dla hoteli:
- Obrazy pokoi/restauracji zmieniają się rzadko
- CSS/JS są wersjonowane (automatyczna aktualizacja przy zmianie)
- Znacząca redukcja requestów HTTP przy powrotnych wizytach

---

### 16. Czas życia pamięci podręcznej AJAX

```
86400
```

**Wyjaśnienie:**  
**24 godziny (86400 sekund)** - cache dla żądań AJAX (np. ładowanie galerii, filtrowanie pokoi). Krótszy niż normalne strony, ponieważ:
- System rezerwacji NFHotel używa AJAX do sprawdzania dostępności
- Filtrowanie pokoi musi pokazywać aktualne dane
- Galeria może być często aktualizowana

---

### 17. Ciasteczko logowania

```
wordpress_logged_in_
```

**Wyjaśnienie:**  
Prefix cookies logowania WordPress. Użytkownicy z tym cookie (admini, edytorzy) otrzymują NIE-cachowaną wersję strony, aby widzieć wszystkie opcje edycji.

---

### 18. Różne pliki ciasteczka

```
Pozostaw puste
```

**Wyjaśnienie:**  
To pole służy do definiowania dodatkowych cookies, które różnicują wersje cache. Dla standardowej witryny hotelowej nie jest to potrzebne.

---

## 🖼️ Optymalizacja Obrazów

### 19. Atrybut WebP/AVIF do zastąpienia

```
src
data-src
srcset
data-srcset
data-original
data-lazy-src
```

**Wyjaśnienie:**  
**KLUCZOWE dla optymalizacji obrazów hotelu!** LiteSpeed zamieni obrazy JPG/PNG na WebP/AVIF w tych atrybutach:
- `src` - standardowy atrybut obrazów
- `data-src`, `data-lazy-src` - obrazy z lazy loading (Oxygen Builder)
- `srcset` - obrazy responsywne (różne rozmiary dla mobile/desktop)
- `data-original` - obrazy w galeriach lightbox

**Efekt:** Redukcja wagi obrazów o 60-80% bez utraty jakości!

---

### 20. Wstępne pobieranie DNS

```
https://nowydwor.nfhotel.usermd.net
https://fonts.googleapis.com
https://fonts.gstatic.com
https://www.google-analytics.com
https://www.googletagmanager.com
```

**Wyjaśnienie:**  
**DNS Prefetch** - przeglądarka z wyprzedzeniem rozwiązuje nazwy domen zanim są potrzebne:
- `nowydwor.nfhotel.usermd.net` - CDN NFHotel dla obrazów
- `fonts.googleapis.com` / `fonts.gstatic.com` - Google Fonts
- Google Analytics/Tag Manager - skrypty analityczne

**Efekt:** Redukcja opóźnienia o 100-300ms przy ładowaniu zewnętrznych zasobów.

---

### 21. Wstępne połączenie DNS

```
https://nowydwor.nfhotel.usermd.net
https://fonts.gstatic.com
```

**Wyjaśnienie:**  
**DNS Preconnect** - pełne połączenie (DNS + TCP + TLS) z krytycznymi domenami:
- `nowydwor.nfhotel.usermd.net` - główne źródło obrazów (CDN NFHotel)
- `fonts.gstatic.com` - fonty Google

**Różnica vs Prefetch:** Preconnect robi więcej (TCP handshake + TLS), ale tylko dla NAJBARDZIEJ krytycznych zasobów. Prefetch tylko DNS dla mniej krytycznych.

---

### 22. Selektory leniwego wczytywania HTML

```
img[data-src]
img[data-lazy-src]
.lazy
.lazy-load
iframe[data-src]
video[data-src]
.oxy-dynamic-list img
.gallery-item img
```

**Wyjaśnienie:**  
**Lazy Loading** - obrazy ładują się dopiero gdy użytkownik przewinie do nich:
- `img[data-src]`, `img[data-lazy-src]` - standardowe lazy loading Oxygen
- `.lazy`, `.lazy-load` - klasy CSS dla lazy loading
- `.oxy-dynamic-list img` - obrazy w listach dynamicznych Oxygen
- `.gallery-item img` - obrazy w galerii hotelu
- `iframe[data-src]`, `video[data-src]` - wideo (np. virtual tour hotelu)

**UWAGA:** Nie lazy-loaduj hero image (pierwsze duże zdjęcie)!

---

### 23. HTML zachowuje komentarze

```
Pozostaw zaznaczone: NIE (false)
```

**Wyjaśnienie:**  
Komentarze HTML (`<!-- komentarz -->`) powinny być usuwane z produkcyjnego HTML:
- Zmniejsza rozmiar HTML o 2-5%
- Ukrywa informacje techniczne przed użytkownikami
- Nie wpływa na działanie strony

**Wyjątek:** Jeśli Oxygen Builder używa komentarzy warunkowych, zostaw zaznaczone TAK.

---

### 24. Podstawowy symbol zastępczy obrazka

```
data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 800'%3E%3Crect fill='%23f0f0f0' width='1200' height='800'/%3E%3Ctext x='50%25' y='50%25' fill='%23999' text-anchor='middle' dominant-baseline='middle' font-family='sans-serif' font-size='24'%3EŁadowanie...%3C/text%3E%3C/svg%3E
```

**Wyjaśnienie:**  
**LQIP (Low Quality Image Placeholder)** - miniaturowy SVG pokazywany podczas ładowania obrazów:
- Rozmiar: ~200 bajtów (praktycznie zero!)
- Tło: jasny szary (#f0f0f0) pasujący do brandingu hotelu
- Tekst: "Ładowanie..." dla dostępności
- Proporcje: 1200x800 (typowe dla zdjęć hoteli)

**Efekt:** Eliminuje CLS (Cumulative Layout Shift) - strona nie "skacze" podczas ładowania obrazów.

---

### 25. Wykluczone leniwe wczytywanie obrazka

```
/hotelnowydwor.eu-new/wp-content/uploads/2025/12/hotel-nowy-dwor-hero.jpg
/hotelnowydwor.eu-new/wp-content/uploads/2025/12/logo-organizacji.jpg
class="site-logo"
class="hero-image"
id="main-banner"
fetchpriority="high"
```

**Wyjaśnienie:**  
**KRYTYCZNE dla LCP (Largest Contentful Paint)!** Te obrazy NIE mogą mieć lazy loading:
- `hotel-nowy-dwor-hero.jpg` - główne hero image na stronie głównej
- `logo-organizacji.jpg` - logo hotelu
- `class="site-logo"` / `class="hero-image"` - obrazy "above the fold"
- `fetchpriority="high"` - obrazy z wysokim priorytetem ładowania

**Zasada:** Pierwszy widoczny obraz (hero/banner) MUSI ładować się natychmiast!

---

### 26. Wykluczona nazwa klasy leniwego wczytywania obrazka

```
no-lazy
skip-lazy
hero-image
site-logo
immediate-load
critical-image
```

**Wyjaśnienie:**  
Obrazy z tymi klasami CSS będą wykluczzone z lazy loading:
- `.no-lazy` / `.skip-lazy` - jawne wykluczenie
- `.hero-image` - główny banner
- `.site-logo` - logo
- `.critical-image` - obrazy krytyczne dla renderowania

**Użycie w Oxygen:** Dodaj klasę `no-lazy` do hero image w edytorze.

---

### 27. Nazwa klasy nadrzędnej leniwego wczytywania obrazka wyklucza

```
no-lazy-children
hero-section
above-fold
critical-section
```

**Wyjaśnienie:**  
Jeśli kontener ma tę klasę, WSZYSTKIE obrazy wewnątrz będą wykluczzone z lazy loading:
- `.hero-section` - cała sekcja hero (tło + logo + elementy)
- `.above-fold` - wszystko widoczne bez scrollowania
- `.critical-section` - sekcje krytyczne dla renderowania

**Przykład HTML:**
```html
<div class="hero-section">
  <img src="hero.jpg"> <!-- Nie będzie lazy -->
  <img src="logo.png"> <!-- Nie będzie lazy -->
</div>
```

---

### 28. Nazwa klasy iframe leniwego wczytywania wyklucza

```
no-lazy-iframe
youtube-hero
video-background
google-maps-main
```

**Wyjaśnienie:**  
Iframe'y z tymi klasami będą wykluczzone z lazy loading:
- `.youtube-hero` - główne wideo w sekcji hero
- `.video-background` - wideo jako tło sekcji
- `.google-maps-main` - główna mapa Google (kontakt)

**UWAGA:** Mapy Google NIE w hero POWINNY mieć lazy loading (oszczędność ~500KB).

---

### 29. Nazwa klasy nadrzędnej iframe leniwego wczytywania wyklucza

```
no-lazy-iframe-children
video-section
map-hero
```

**Wyjaśnienie:**  
Analogicznie do obrazów - kontener z tą klasą wymusi brak lazy loading na WSZYSTKICH iframe wewnątrz.

---

### 30. Wykluczenia leniwego wczytywania URI

```
/hotelnowydwor.eu-new/$
/hotelnowydwor.eu-new/o-nas
/hotelnowydwor.eu-new/kontakt
```

**Wyjaśnienie:**  
**Całe strony** gdzie lazy loading jest WYŁĄCZONY:
- `/hotelnowydwor.eu-new/$` - strona główna (hero image must load immediately)
- `/o-nas` - strona O Nas (często ma hero image z zespołem)
- `/kontakt` - strona Kontakt (mapa Google musi być widoczna)

**Regex:** `$` oznacza koniec URL (tylko strona główna, nie `/podstrona`)

---

### 31. LQIP wyklucza

```
class="site-logo"
class="no-lqip"
id="main-logo"
```

**Wyjaśnienie:**  
Obrazy, które NIE powinny pokazywać placeholder:
- Logo - powinno ładować się natychmiast bez "szarego kwadrata"
- Małe ikony - placeholder byłby większy niż sam obraz

---

## 🎨 Optymalizacja CSS/JS

### 32. Opóźnienie JS obejmuje

```
/hotelnowydwor.eu-new/wp-content/plugins/contact-form-7
/hotelnowydwor.eu-new/wp-includes/js/jquery/jquery.min.js
/hotelnowydwor.eu-new/wp-includes/js/jquery/jquery-migrate.min.js
google-analytics
googletagmanager
gtag
fbevents
facebook
twitter
```

**Wyjaśnienie:**  
**JavaScript Delay** - skrypty ładują się dopiero po interakcji użytkownika (scroll/click):
- **Contact Form 7** - formularz ładuje się dopiero gdy użytkownik scrolluje
- **jQuery** - tylko jeśli nie jest krytyczny dla renderowania
- **Analityka** (Google Analytics, Facebook Pixel) - mogą poczekać
- **Social** (Facebook, Twitter) - nieistotne dla początkowego renderowania

**UWAGA:** NIE opóźniaj skryptów krytycznych dla systemu rezerwacji NFHotel!

**Efekt:** Poprawa FCP (First Contentful Paint) o 0.5-1s.

---

### 33. Wykluczenia JS

```
/hotelnowydwor.eu-new/wp-content/plugins/oxygen
/hotelnowydwor.eu-new/wp-content/plugins/nfhotel
/hotelnowydwor.eu-new/wp-content/themes/oxygen
jquery
nfhotel
booking
reservation
oxygen
```

**Wyjaśnienie:**  
**KRYTYCZNE!** Te skrypty NIE mogą być:
- Opóźniane (delay)
- Łączone (combine)
- Minifikowane agresywnie

Powody:
- **Oxygen Builder** - wymaga specyficznych skryptów dla działania layoutu
- **NFHotel** - system rezerwacji musi działać natychmiast
- **jQuery** - jeśli jest zależnością NFHotel/Oxygen

**WAŻNE:** To są wykluczenia globalne - dotyczą wszystkich optymalizacji JS!

---

### 34. JS wyklucza odroczony/opóźniony

```
/hotelnowydwor.eu-new/wp-content/plugins/nfhotel
/hotelnowydwor.eu-new/wp-includes/js/jquery/jquery.min.js
inline-script
critical-script
```

**Wyjaśnienie:**  
Skrypty, które muszą ładować się SYNCHRONICZNIE (bez `defer` ani `async`):
- **NFHotel** - system rezerwacji wymaga synchronicznego wykonania
- **jQuery** - jeśli inne skrypty od niego zależą
- `inline-script` - inline JavaScript w HTML
- `critical-script` - skrypty krytyczne dla renderowania

---

### 35. Tryb gościa wyklucza JS

```
/hotelnowydwor.eu-new/wp-content/plugins/wordpress-seo
/hotelnowydwor.eu-new/wp-content/plugins/google-site-kit
google-analytics
gtag
```

**Wyjaśnienie:**  
**Guest Mode** = użytkownicy niezalogowani. Te skrypty będą WYŁĄCZONE dla gości (tylko admini je zobaczą):
- **Yoast SEO** - niepotrzebne dla gości
- **Google Site Kit** - tylko dla adminów
- **Analytics** - opcjonalnie (jeśli chcesz oszczędzić bandwidth)

**UWAGA:** Jeśli chcesz śledzić wszystkich użytkowników, zostaw to pole PUSTE!

---

### 36. Wykluczone URI

```
/hotelnowydwor.eu-new/wp-admin
/hotelnowydwor.eu-new/wp-login.php
/hotelnowydwor.eu-new/wp-json
/hotelnowydwor.eu-new/xmlrpc.php
```

**Wyjaśnienie:**  
Strony całkowicie wykluczone z WSZYSTKICH optymalizacji JS/CSS:
- `/wp-admin` - panel WordPress
- `/wp-json` - REST API
- `/xmlrpc.php` - XML-RPC API

---

### 37. Wykluczenia CSS

```
/hotelnowydwor.eu-new/wp-content/plugins/oxygen/component-framework/oxygen.css
/hotelnowydwor.eu-new/wp-content/plugins/nfhotel
oxygen-styles
critical-css
```

**Wyjaśnienie:**  
**KRYTYCZNE dla Oxygen Builder!** Te style CSS NIE mogą być:
- Łączone
- Minifikowane agresywnie
- Usuwane jako "unused"

Powody:
- **Oxygen CSS** - dynamiczne style generowane przez builder
- **NFHotel CSS** - style systemu rezerwacji
- `critical-css` - CSS krytyczny dla renderowania

---

### 38. Wykluczone pliki wbudowane UCSS

```
Pozostaw puste
```

**Wyjaśnienie:**  
**UCSS (Unused CSS Removal)** - usuwanie nieużywanych stylów. To pole pozwala wykluczyć konkretne inline CSS z usuwania. Dla większości witryn nie jest potrzebne.

---

### 39. Lista dozwolonych selektorów UCSS

```
.oxy-
.ct-
.oxygen-
#oxygen-
[data-oxygen]
.nfhotel-
.booking-
.reservation-
```

**Wyjaśnienie:**  
**Selektory CSS które MUSZĄ być zachowane** nawet jeśli UCSS ich nie wykryje:
- `.oxy-`, `.ct-`, `.oxygen-` - prefixy Oxygen Builder
- `#oxygen-`, `[data-oxygen]` - atrybuty Oxygen
- `.nfhotel-`, `.booking-`, `.reservation-` - klasy systemu rezerwacji

**WAŻNE:** Oxygen generuje klasy dynamicznie, więc UCSS może je błędnie usunąć!

---

### 40. Wyklucza URI UCSS

```
/hotelnowydwor.eu-new/rezerwacja
/hotelnowydwor.eu-new/booking
/hotelnowydwor.eu-new/pokoje
```

**Wyjaśnienie:**  
Strony gdzie **UCSS jest całkowicie wyłączony**:
- `/rezerwacja`, `/booking` - system rezerwacji wymaga WSZYSTKICH stylów
- `/pokoje` - dynamiczne filtrowanie wymaga różnych klas CSS

---

### 41. Oddzielne typy treści CCSS

```
page
post
nfhotel_room
nfhotel_booking
```

**Wyjaśnienie:**  
**CCSS (Critical CSS)** - różne typy postów mają różny Critical CSS:
- `page` - strony statyczne
- `post` - posty blogowe
- `nfhotel_room` - custom post type pokoi NFHotel
- `nfhotel_booking` - rezerwacje

**Efekt:** Każdy typ ma zoptymalizowany Critical CSS tylko ze stykami które używa.

---

### 42. Oddzielne identyfikatory URI pamięci podręcznej CCSS

```
/hotelnowydwor.eu-new/$
/hotelnowydwor.eu-new/pokoje
/hotelnowydwor.eu-new/restauracja
/hotelnowydwor.eu-new/galeria
```

**Wyjaśnienie:**  
Strony z **unikalnym Critical CSS** (różnią się layoutem od innych):
- Strona główna - hero image, sekcje specjalne
- Pokoje - layout galerii
- Restauracja - layout menu
- Galeria - grid obrazów

**Zasada:** Każdy unikalny layout = odrębny Critical CSS.

---

### 43. Lista dozwolonych selektorów CCSS

```
.hero-
.header-
.navigation-
.footer-
.above-fold
body
html
```

**Wyjaśnienie:**  
Selektory które ZAWSZE muszą być w Critical CSS (nawet jeśli algorytm ich nie wykryje):
- `.hero-` - sekcja hero
- `.header-`, `.navigation-` - nawigacja (always above fold)
- `.footer-` - stopka (jeśli ma ważne linki)
- `body`, `html` - podstawowe style

---

### 44. Krytyczne reguły CSS

```
Pozostaw puste (auto-generowane)
```

**Wyjaśnienie:**  
LiteSpeed Cache automatycznie wygeneruje Critical CSS poprzez:
1. Analizę strony w wirtualnej przeglądarce
2. Wykrycie stylów "above the fold"
3. Stworzenie minimalnego CSS dla szybkiego renderowania

**Ręczne dodawanie:** Tylko jeśli auto-generacja zawiedzie.

---

## ⚙️ Dodatkowe Rekomendowane Ustawienia

### Cache Tab (nie wymienione wyżej)

```
✅ Enable Cache: TAK
✅ Cache Mobile: TAK (osobny cache dla mobile)
✅ Cache Logged-in Users: NIE
✅ Cache REST API: NIE (NFHotel używa)
✅ Cache Pages with $_GET Parameters: NIE
```

### Purge Tab

```
✅ Purge All On Upgrade: TAK
✅ Auto Purge Rules: Domyślne WordPress
```

### Excludes Tab

```
✅ Do Not Cache Roles: administrator, editor
```

### Advanced Tab

```
✅ Instant Click: TAK (prefetch na hover)
✅ Login Cookie: wordpress_logged_in_
```

---

## 📝 Instrukcja Implementacji Krok po Kroku

### Krok 1: Backup

```bash
# Wykonaj pełny backup witryny i bazy danych
# Użyj wtyczki UpdraftPlus lub panel hostingu
```

### Krok 2: Wyłącz inne wtyczki cache

```
1. Deaktywuj wszystkie inne wtyczki cache (W3 Total Cache, WP Super Cache, etc.)
2. Wyczyść cache hostingu (jeśli jest osobny)
```

### Krok 3: Instalacja LiteSpeed Cache

```
1. Zainstaluj wtyczkę "LiteSpeed Cache" z repozytorium WordPress
2. Aktywuj wtyczkę
3. Przejdź do LiteSpeed Cache → Dashboard
```

### Krok 4: Import ustawień

```
1. Skopiuj WSZYSTKIE wartości z tego dokumentu
2. Wklej do odpowiednich pól w LiteSpeed Cache → Settings
3. Zachowaj DOKŁADNĄ kolejność z tego dokumentu
```

### Krok 5: Generowanie Critical CSS

```
1. LiteSpeed Cache → Page Optimization → CSS Settings
2. Kliknij "Generate Critical CSS"
3. Poczekaj 2-5 minut na wygenerowanie
4. Odśwież stronę i sprawdź czy Critical CSS jest aktywne
```

### Krok 6: Test wydajności

```
1. Wyczyść całą cache: LiteSpeed Cache → Purge → Purge All
2. Odwiedź stronę jako niezalogowany użytkownik
3. Sprawdź Google PageSpeed Insights
4. Sprawdź GTmetrix
5. Cel: PageSpeed Mobile ≥ 90
```

### Krok 7: Test funkcjonalności

```
✓ Sprawdź system rezerwacji NFHotel
✓ Sprawdź formularze kontaktowe
✓ Sprawdź galerię obrazów
✓ Sprawdź responsywność mobile
✓ Sprawdź wszystkie podstrony
```

### Krok 8: Monitorowanie

```
1. Włącz Debug Mode na 24h: LiteSpeed Cache → Debug
2. Sprawdź logi błędów
3. Monitoruj ruch i konwersje
4. Po 24h wyłącz Debug Mode
```

---

## 🚨 WAŻNE OSTRZEŻENIA

### ⚠️ System Rezerwacji NFHotel

**KRYTYCZNE:** Nieprawidłowa konfiguracja może zepsuć rezerwacje!

```
✅ ZAWSZE wykluczaj z cache:
   - /rezerwacja
   - /booking  
   - /nfhotel
   - query string: check_in, check_out, guests, rooms

✅ NIGDY nie cachuj:
   - Cookies: nfhotel_session, booking_session
   - API endpoints: /wp-json/nfhotel/*
```

### ⚠️ Oxygen Builder

**KRYTYCZNE:** Może się zepsuć przy agresywnej optymalizacji!

```
✅ ZAWSZE wykluczaj z minifikacji:
   - oxygen.css
   - oxygen.js
   - Inline styles generowane przez Oxygen

✅ Zachowuj selektory:
   - .oxy-*
   - .ct-*
   - [data-oxygen]
```

### ⚠️ Testowanie

```
✅ ZAWSZE testuj po każdej zmianie:
   1. Wyczyść cache
   2. Sprawdź w trybie incognito
   3. Przetestuj rezerwację
   4. Sprawdź mobile
   5. Sprawdź formularze
```

---

## 🎯 Oczekiwane Rezultaty

Po poprawnej implementacji tej konfiguracji:

### Wydajność

```
✅ PageSpeed Mobile: 85-95 punktów (cel: ≥90)
✅ PageSpeed Desktop: 95-100 punktów
✅ LCP (Largest Contentful Paint): < 2.5s
✅ FID (First Input Delay): < 100ms
✅ CLS (Cumulative Layout Shift): < 0.1
✅ Czas ładowania: < 2 sekundy
✅ Rozmiar strony: redukcja o 60-70%
```

### SEO

```
✅ Core Web Vitals: PASSED
✅ Mobile-Friendly: PASSED
✅ HTTPS: PASSED
✅ Structured Data: VALID (schema.org)
```

### Doświadczenie Użytkownika

```
✅ Natychmiastowe ładowanie (powrotne wizyty)
✅ Płynne scrollowanie
✅ Brak "skoków" layoutu (CLS = 0)
✅ Szybka interakcja
```

---

## 📞 Wsparcie i Pomoc

### Problemy z cache

```
1. Wyczyść całą cache: Purge All
2. Wyłącz cache na 5 minut
3. Włącz Debug Mode
4. Sprawdź logi: /wp-content/debug.log
```

### Problemy z rezerwacją NFHotel

```
1. Sprawdź czy URLe są wykluczony z cache
2. Sprawdź cookies: nfhotel_session
3. Sprawdź query strings: check_in, check_out
4. Wyłącz całą optymalizację JS dla NFHotel
```

### Problemy z Oxygen Builder

```
1. Wykluczfilename oxygen z minifikacji CSS/JS
2. Dodaj .oxy-* do UCSS Safelist
3. Wyłącz Combine CSS dla Oxygen
```

---

## ✅ Checklist Końcowa

Przed uznaniem konfiguracji za kompletną, sprawdź:

- [ ] Wszystkie pola wypełnione zgodnie z dokumentem
- [ ] Critical CSS wygenerowany
- [ ] PageSpeed Mobile ≥ 90
- [ ] System rezerwacji NFHotel działa
- [ ] Formularze działają
- [ ] Galeria ładuje się prawidłowo
- [ ] Mobile responsywność OK
- [ ] Brak błędów w konsoli przeglądarki
- [ ] Brak błędów w Debug Mode
- [ ] Cache generuje się prawidłowo
- [ ] Obrazy konwertują się do WebP/AVIF

---

## 📊 Metryki do Monitorowania (Tygodniowo)

```
✓ Google PageSpeed Insights (Mobile + Desktop)
✓ Google Search Console (Core Web Vitals)
✓ GTmetrix Performance Score
✓ Liczba konwersji (rezerwacje)
✓ Bounce Rate (współczynnik odrzuceń)
✓ Average Session Duration
✓ Server Response Time (TTFB)
```

---

## 🔄 Aktualizacje

**Data ostatniej aktualizacji:** 28 grudnia 2024  
**Wersja konfiguracji:** 1.0  
**Kompatybilność:** LiteSpeed Cache 7.7, WordPress 6.x, Oxygen Builder 4.x

---

## 📄 Licencja i Autor

**Autor:** Claude AI (Anthropic) + PB MEDIA  
**Projekt:** Hotel Nowy Dwór SEO Optimization  
**Kontakt:** biuro@pbmediaonline.pl  
**Telefon:** +48 695 816 068

---

## 🎓 Dodatkowe Zasoby

### Dokumentacja LiteSpeed Cache

- [Oficjalna dokumentacja](https://docs.litespeedtech.com/lscache/lscwp/)
- [Cache Tutorial](https://docs.litespeedtech.com/lscache/lscwp/cache/)
- [Image Optimization](https://docs.litespeedtech.com/lscache/lscwp/imageopt/)

### Narzędzia Testowe

- [Google PageSpeed Insights](https://pagespeed.web.dev/)
- [GTmetrix](https://gtmetrix.com/)
- [WebPageTest](https://www.webpagetest.org/)
- [Google Search Console](https://search.google.com/search-console)

### Best Practices

- [Google Web Vitals](https://web.dev/vitals/)
- [WordPress Performance](https://developer.wordpress.org/advanced-administration/performance/optimization/)
- [Hotel SEO Guide](https://www.searchenginejournal.com/hotel-seo/)

---

**KONIEC DOKUMENTU**

Konfiguracja została wygenerowana automatycznie przez AI na podstawie:
- Analizy struktury witryny https://nowydwor.smarthost.pl/hotelnowydwor.eu-new/
- Audytu SEO i wydajności
- Best practices dla WordPress + Oxygen Builder
- Wymagań systemu rezerwacji NFHotel
- Celów wydajnościowych PageSpeed ≥90

**WAŻNE:** Przed wdrożeniem wykonaj pełny backup witryny!
