document.addEventListener('DOMContentLoaded', function() {
    // Sprawdź czy przeglądarka obsługuje IntersectionObserver
    if (!('IntersectionObserver' in window)) {
        // Fallback: pokaż wszystko natychmiast jeśli brak obsługi
        document.querySelectorAll('.hnd-anim-hidden').forEach(el => {
            el.classList.remove('hnd-anim-hidden');
        });
        return;
    }

    const observerOptions = {
        root: null, // viewport
        rootMargin: '0px',
        threshold: 0.15 // Uruchom gdy 15% elementu jest widoczne
    };

    const appearOnScroll = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;

            // Dodaj klasę widoczności
            entry.target.classList.add('hnd-anim-visible');
            
            // Przestań obserwować po animacji (jednorazowa animacja)
            observer.unobserve(entry.target);
        });
    }, observerOptions);

    // Znajdź wszystkie elementy do animacji
    const elementsToAnimate = document.querySelectorAll('.hnd-anim-fade-up, .hnd-anim-slide-left, .hnd-anim-slide-right');
    
    elementsToAnimate.forEach(el => {
        el.classList.add('hnd-anim-hidden'); // Ukryj początkowo
        appearOnScroll.observe(el);
    });
});