<!-- Sekcja: Formularz Kontaktowy -->
<section class="hnd-contact-wrapper hnd-contact-section" id="formularz">
    <div class="hnd-contact-container">
        <div class="hnd-anim-fade-up" style="max-width: 800px; margin: 0 auto; text-align: center;">
            <span class="hnd-contact-subtitle">Napisz do nas</span>
            <h2 class="hnd-contact-title">Formularz Kontaktowy</h2>
            <p class="hnd-contact-lead">Szanujemy Twój czas. Odpowiadamy na wszystkie zapytania tak szybko, jak to możliwe.</p>
            
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: var(--hnd-shadow); text-align: left;">
                <!-- Tutaj wstaw shortcode Contact Form 7 w edytorze Oxygen -->
                <!-- Poniżej przykładowa struktura HTML dla wizualizacji -->
                <?php echo do_shortcode('[contact-form-7 id="123" title="Formularz kontaktowy"]'); ?>
                
                <!-- Fallback info jeśli CF7 nie jest skonfigurowany -->
                <p style="font-size: 0.8rem; color: #999; margin-top: 1rem; text-align: center;">
                    *Jeśli formularz nie jest widoczny, prosimy o kontakt mailowy: <a href="mailto:rezerwacja@hotelnowydwor.eu">rezerwacja@hotelnowydwor.eu</a>
                </p>
            </div>
        </div>
    </div>
</section>