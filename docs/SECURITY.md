# Polityka Bezpieczeństwa

Bezpieczeństwo strony Hotelu Nowy Dwór oraz danych jego gości jest dla nas priorytetem. Poniżej znajdują się zasady i procedury dotyczące bezpieczeństwa w tym projekcie.

## Obsługiwane Wersje

| Wersja | Wspierana |
| ------ | --------- |
| WordPress 6.x | ✅ Tak |
| PHP 7.4+ | ✅ Tak |
| Oxygen 4.x | ✅ Tak |

## Zgłaszanie Podatności

Jeśli odkryłeś lukę bezpieczeństwa w kodzie lub konfiguracji:

1.  **NIE** otwieraj publicznego zgłoszenia (Issue).
2.  Wyślij szczegóły e-mailem na adres: `security@pbmedia.pl` lub `biuro@pbmedia.pl`.
3.  W zgłoszeniu podaj:
    *   Rodzaj podatności (np. XSS, SQL Injection).
    *   Lokalizację (plik, URL).
    *   Dowód koncepcji (PoC) lub kroki do reprodukcji.

Zespół PB MEDIA przeanalizuje zgłoszenie i podejmie działania naprawcze w ciągu 48 godzin.

## Standardy Bezpieczeństwa (PB MEDIA)

W tym projekcie stosujemy rygorystyczne zasady hardeningu WordPress:

1.  **Brak domyślnych prefiksów**: Tabela bazy danych nie używa `wp_`.
2.  **Ochrona plików**: Pliki `wp-config.php` i `.htaccess` są zablokowane przed dostępem z zewnątrz.
3.  **Nagłówki HTTP**: Wymagane `HSTS`, `X-Frame-Options`, `X-XSS-Protection`.
4.  **Sanityzacja**: Wszystkie dane wejściowe w kodzie PHP muszą być sanityzowane, a wyjściowe escapowane.
5.  **Aktualizacje**: Wtyczki i motywy są aktualizowane niezwłocznie po wydaniu łatek bezpieczeństwa.
6.  **Brak XML-RPC**: Interfejs XML-RPC jest całkowicie zablokowany.

## Audyty Automatyczne

Repozytorium jest regularnie skanowane przez GitHub Actions:
*   **WPScan**: Skanowanie znanych podatności WordPress.
*   **PHPCS Security Audit**: Statyczna analiza kodu pod kątem niebezpiecznych wzorców.
