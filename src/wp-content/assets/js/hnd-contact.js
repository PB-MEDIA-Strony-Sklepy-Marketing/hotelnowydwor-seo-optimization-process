document.addEventListener('DOMContentLoaded', function() {
    
    // Obsługa animacji wjazdu przy scrollowaniu (IntersectionObserver)
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('hnd-anim-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, observerOptions);

        const elements = document.querySelectorAll('.hnd-anim-fade-up, .hnd-anim-slide-left, .hnd-anim-slide-right');
        elements.forEach(el => {
            el.classList.add('hnd-anim-hidden');
            observer.observe(el);
        });
    } else {
        // Fallback dla starszych przeglądarek
        document.querySelectorAll('.hnd-anim-hidden').forEach(el => el.classList.remove('hnd-anim-hidden'));
    }

});