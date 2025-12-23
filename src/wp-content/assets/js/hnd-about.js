document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15 // Animacja startuje gdy 15% elementu jest widoczne
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('hnd-anim-visible');
                entry.target.classList.remove('hnd-anim-hidden');
                observer.unobserve(entry.target); // Animuj tylko raz
            }
        });
    }, observerOptions);

    const animatedElements = document.querySelectorAll('.hnd-anim-up, .hnd-anim-left, .hnd-anim-right');
    animatedElements.forEach(el => {
        el.classList.add('hnd-anim-hidden'); // Ukryj na start
        observer.observe(el);
    });
});