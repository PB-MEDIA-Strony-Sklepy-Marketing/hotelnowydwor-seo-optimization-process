#!/bin/bash

# Skrypt do optymalizacji obrazów dla Hotelu Nowy Dwór
# Wymagania: cwebp (libwebp), avifenc (libavif-bin), jpegoptim, optipng
# Użycie: ./scripts/optimize-images.sh [ścieżka_do_katalogu]

DIRECTORY=${1:-"src/wp-content/uploads"}
QUALITY_WEBP=80
QUALITY_AVIF=65

echo "🚀 Rozpoczynam optymalizację obrazów w katalogu: $DIRECTORY"

# Sprawdzenie narzędzi
if ! command -v cwebp &> /dev/null; then
    echo "❌ Błąd: cwebp nie jest zainstalowany. Zainstaluj pakiet 'webp'."
    exit 1
fi

if ! command -v avifenc &> /dev/null; then
    echo "⚠️ Ostrzeżenie: avifenc nie jest zainstalowany. Pomijam konwersję do AVIF."
    HAS_AVIF=false
else
    HAS_AVIF=true
fi

# Funkcja optymalizacji
optimize_image() {
    local file="$1"
    local filename=$(basename -- "$file")
    local extension="${filename##*.}"
    local filename_no_ext="${filename%.*}"
    local dir=$(dirname "$file")

    echo "Processing: $file"

    # Generowanie WebP
    if [ ! -f "$dir/$filename_no_ext.webp" ]; then
        cwebp -q $QUALITY_WEBP "$file" -o "$dir/$filename_no_ext.webp" -quiet
        echo "  ✅ Utworzono WebP"
    fi

    # Generowanie AVIF
    if [ "$HAS_AVIF" = true ] && [ ! -f "$dir/$filename_no_ext.avif" ]; then
        # avifenc może być wolny, używamy ustawień speed 6 dla balansu
        avifenc -s 6 -q $QUALITY_AVIF "$file" "$dir/$filename_no_ext.avif" > /dev/null 2>&1
        echo "  ✅ Utworzono AVIF"
    fi
}

# Znajdź wszystkie obrazy JPG/PNG i przetwórz je
find "$DIRECTORY" -type f \( -iname "*.jpg" -o -iname "*.jpeg" -o -iname "*.png" \) | while read -r img; do
    optimize_image "$img"
done

echo "🎉 Zakończono optymalizację obrazów."
