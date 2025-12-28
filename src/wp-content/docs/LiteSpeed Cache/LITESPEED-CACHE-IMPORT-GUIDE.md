# LiteSpeed Cache v7.7 - Instrukcja Importu
## Hotel Nowy Dwór - Konfiguracja Wydajnościowa

**Data utworzenia:** 2025-12-28
**Wersja wtyczki:** LiteSpeed Cache v7.7
**Strona docelowa:** https://www.hotelnowydwor.eu/
**Środowisko testowe:** https://nowydwor.smarthost.pl/hotelnowydwor.eu-new/

---

## 📁 Dostarczone pliki

| Plik | Format | Rozmiar | Opis |
|------|--------|---------|------|
| `litespeed-cache-hotel-nowy-dwor-v7.7.json` | JSON | 11 KB | Główny plik konfiguracyjny (zalecany) |
| `litespeed-cache-hotel-nowy-dwor.data` | DATA | 13 KB | Alternatywny format z komentarzami |
| `litespeed-cache-hotelnowydwor.json` | JSON | 14 KB | Rozszerzona wersja z metadanymi |

**Zalecenie:** Użyj pliku `litespeed-cache-hotel-nowy-dwor-v7.7.json` jako głównego.

---

## 🚀 Instrukcja Importu

### Metoda 1: Import przez Panel WordPress (ZALECANA)

1. **Zaloguj się do WordPress Admin**
   ```
   https://www.hotelnowydwor.eu/wp-admin/
   ```

2. **Przejdź do LiteSpeed Cache**
   - Menu: `LiteSpeed Cache` → `Toolbox`

3. **Wybierz zakładkę Import/Export**
   - Kliknij tab `Import / Export`

4. **Importuj konfigurację**
   - W sekcji "Import Settings" kliknij `Choose File`
   - Wybierz plik: `litespeed-cache-hotel-nowy-dwor-v7.7.json`
   - Kliknij `Import`

5. **Potwierdź import**
   - System zapyta o potwierdzenie (nadpisze istniejące ustawienia)
   - Kliknij `OK` / `Confirm`

6. **Zapisz zmiany**
   - Kliknij `Save Changes`

7. **Wyczyść cache**
   - Przejdź do `LiteSpeed Cache` → `Toolbox` → `Purge`
   - Kliknij `Purge All`

### Metoda 2: Import przez FTP/SFTP

1. **Prześlij plik JSON na serwer**
   ```
   Lokalizacja: /wp-content/uploads/
   ```

2. **W WordPress Admin:**
   - `LiteSpeed Cache` → `Toolbox` → `Import / Export`
   - Wybierz przesłany plik
   - Wykonaj import jak w Metodzie 1

---

## ⚙️ Konfiguracja Manualna Po Imporcie

### KROK 1: Server IP (WYMAGANE dla Crawlera)

1. Przejdź do: `LiteSpeed Cache` → `Crawler` → `General Settings`
2. Uzupełnij pole `Server IP`
3. Aby uzyskać IP serwera:
   ```bash
   # SSH do serwera lub hosting panel
   hostname -I
   # lub
   curl ifconfig.me
   ```

### KROK 2: QUIC.cloud API Key (ZALECANE)

1. **Zarejestruj się na QUIC.cloud:**
   - Wejdź na: https://my.quic.cloud/
   - Załóż konto (darmowe)

2. **Dodaj domenę:**
   - Dodaj: `www.hotelnowydwor.eu`
   - Skopiuj wygenerowany `Domain Key`

3. **W WordPress:**
   - `LiteSpeed Cache` → `General` → `QUIC.cloud`
   - Wklej `Domain Key`
   - Zapisz zmiany

### KROK 3: Object Cache (OPCJONALNE)

Jeśli hosting oferuje Redis lub Memcached:

1. Sprawdź u hostingodawcy dostępność:
   - Redis (preferowany)
   - Memcached

2. W `LiteSpeed Cache` → `Cache` → `Object`:
   - Włącz `Object Cache`
   - Ustaw `Method`: Redis
   - `Host`: 127.0.0.1 (lub wskazany przez hosting)
   - `Port`: 6379 (domyślny Redis)
   - Kliknij `Test Connection`
   - Zapisz zmiany

---

## ✅ Checklist Po Imporcie

```markdown
### Natychmiast po imporcie:
- [ ] Import zakończony bez błędów
- [ ] Wykonano "Purge All Cache"
- [ ] Strona główna ładuje się poprawnie
- [ ] Edytor Oxygen Builder działa
- [ ] Widget rezerwacji NFHotel funkcjonuje

### W ciągu 24 godzin:
- [ ] Dodano Server IP do ustawień Crawlera
- [ ] Zarejestrowano domenę w QUIC.cloud
- [ ] Uruchomiono pierwszy Crawl
- [ ] Sprawdzono logi błędów (/wp-content/debug.log)

### W ciągu 48 godzin:
- [ ] QUIC.cloud wygenerował Critical CSS
- [ ] Test PageSpeed Insights (Mobile ≥90)
- [ ] Test PageSpeed Insights (Desktop ≥90)
- [ ] Test Core Web Vitals

### W ciągu tygodnia:
- [ ] Monitoring wydajności przez 7 dni
- [ ] Analiza cache hit ratio
- [ ] Optymalizacja ewentualnych problemów
```

---

## 🎯 Oczekiwane Wyniki

### Przed optymalizacją (Baseline)

| Metryka | Wartość | Status |
|---------|---------|--------|
| PageSpeed Mobile | 52/100 | ⚠️ Słaby |
| PageSpeed Desktop | 61/100 | ⚠️ Średni |
| LCP | 4.2s | ❌ Przekroczony |
| FID | 180ms | ❌ Przekroczony |
| CLS | 0.18 | ❌ Przekroczony |
| SEO Score | 55/100 | ⚠️ Wymaga pracy |

### Po optymalizacji (Cele)

| Metryka | Cel | Oczekiwana poprawa |
|---------|-----|-------------------|
| PageSpeed Mobile | ≥90/100 | +38 punktów |
| PageSpeed Desktop | ≥90/100 | +29 punktów |
| LCP | <2.5s | -40% czasu |
| FID | <100ms | -44% czasu |
| CLS | <0.1 | -44% wartości |
| SEO Score | ≥90/100 | +35 punktów |

---

## 🔧 Kluczowe Ustawienia Konfiguracji

### Optymalizacja CSS
- ✅ Minifikacja CSS
- ✅ Łączenie plików CSS
- ✅ Asynchroniczne ładowanie CSS
- ✅ Critical CSS (via QUIC.cloud)
- ✅ Unique CSS (UCSS)
- ✅ Font display: swap

### Optymalizacja JavaScript
- ✅ Minifikacja JS
- ✅ Łączenie plików JS
- ✅ Defer JS
- ✅ Delay JS (analytics, tracking - 2000ms)

### Optymalizacja Obrazów
- ✅ Lazy Loading (obrazy, tła, video, iframe)
- ✅ LQIP (Low Quality Image Placeholders)
- ✅ Automatyczna konwersja WebP (jakość 82%)
- ✅ Max wymiary: 1920x1920px
- ✅ Responsive placeholders

### Cache
- ✅ Public cache TTL: 7 dni
- ✅ Private cache TTL: 30 minut
- ✅ Browser cache włączony
- ✅ Stale cache: 24h
- ✅ Auto-purge przy aktualizacji

### Crawler
- ✅ Sitemap-based crawling
- ✅ Interwał: co 8 godzin
- ✅ 2 wątki, 500ms delay
- ✅ Timeout: 30s

---

## 🛡️ Kompatybilność Oxygen Builder

### Wykluczenia CSS
```
oxygen
ct-
oxygen.css
oxygen.min.css
universal.css
ct-*.css
```

### Wykluczenia JavaScript
```
jquery.js
jquery.min.js
oxygen
ct-
nfhotel-booking
booking-engine
```

### Whitelista UCSS (Selektory Oxygen)
```
.ct-
.oxy-
.oxygen-
#ct-
[class*="ct-"]
[class*="oxy-"]
```

### Chronione Inline Scripts
```
oxygenVSBFrontendData
ct_
ctc
CDATA
```

---

## 🏨 Ustawienia Specyficzne dla Hotelu

### Wykluczenia URL (bez cache)
- `/rezerwacja/` - strona rezerwacji
- `/booking/` - alternatywna strona rezerwacji
- `/koszyk/` - koszyk (jeśli używany)
- `/moje-konto/` - panel klienta

### Wykluczenia Lazy Load
- `.hero-bg` - tła hero section
- `.lcp-image` - obrazy LCP
- `#site-logo` - logo strony
- `.booking-widget` - widget rezerwacji

### Strony Priorytetowe (Crawler)
1. `/` - Strona główna
2. `/pokoje/` - Pokoje
3. `/restauracja/` - Restauracja
4. `/kontakt/` - Kontakt
5. `/wesela/` - Wesela

---

## 🔍 Troubleshooting

### Problem: Strona nie ładuje się po imporcie

**Rozwiązanie:**
1. Wyczyść cache przeglądarki (Ctrl+Shift+Del)
2. W WordPress: `LiteSpeed Cache` → `Toolbox` → `Purge All`
3. Jeśli nie pomaga, wyłącz tymczasowo:
   - CSS Combine
   - JS Combine
   - UCSS

### Problem: Oxygen Builder nie działa

**Rozwiązanie:**
1. Sprawdź czy URL edytora jest wykluczony:
   - `/?ct_builder=`
   - `/?oxygen_iframe=`
2. Wyłącz cache dla roli `administrator`

### Problem: Widget rezerwacji nie działa

**Rozwiązanie:**
1. Sprawdź wykluczenia JS:
   - `nfhotel-booking`
   - `booking-engine`
2. Dodaj URL `/rezerwacja/` do wykluczeń cache

### Problem: Obrazy hero ładują się z opóźnieniem

**Rozwiązanie:**
1. Dodaj klasę `no-lazy` lub `lcp-image` do obrazów
2. Sprawdź wykluczenia lazy load:
   - `.hero-bg`
   - `.above-fold`

### Problem: Critical CSS nie generuje się

**Rozwiązanie:**
1. Sprawdź czy QUIC.cloud Domain Key jest dodany
2. Poczekaj 24-48h na generację
3. Ręcznie wygeneruj: `LiteSpeed Cache` → `Page Optimization` → `CCSS` → `Generate`

---

## 📊 Monitorowanie Wydajności

### Narzędzia testowe

1. **Google PageSpeed Insights**
   - https://pagespeed.web.dev/
   - Testuj wersję mobilną i desktopową

2. **GTmetrix**
   - https://gtmetrix.com/
   - Lokalizacja: Europe (Frankfurt)

3. **WebPageTest**
   - https://www.webpagetest.org/
   - Lokalizacja: EC2 Europe

4. **Lighthouse (Chrome DevTools)**
   - F12 → Tab "Lighthouse"
   - Wszystkie kategorie

### Harmonogram testów

| Częstotliwość | Test | Cel |
|---------------|------|-----|
| Po imporcie | PageSpeed, GTmetrix | Baseline |
| Po 24h | PageSpeed | Weryfikacja CCSS |
| Po 48h | Pełny audit | Wszystkie metryki |
| Co tydzień | PageSpeed | Monitoring |
| Co miesiąc | Pełny audit | Optymalizacja |

---

## 📞 Wsparcie

**Dokumentacja LiteSpeed Cache:**
- https://docs.litespeedtech.com/lscache/lscwp/

**QUIC.cloud Dashboard:**
- https://my.quic.cloud/

**Oxygen Builder Support:**
- https://oxygenbuilder.com/documentation/

**Kontakt PB MEDIA:**
- https://www.pbmediaonline.pl/

---

## 📝 Historia zmian

| Data | Wersja | Opis |
|------|--------|------|
| 2025-12-28 | 1.0.0 | Pierwsza wersja konfiguracji |

---

*Konfiguracja przygotowana w ramach projektu SEO Optimization dla Hotel Nowy Dwór.*
*© 2025 PB MEDIA - Wszystkie prawa zastrzeżone.*
