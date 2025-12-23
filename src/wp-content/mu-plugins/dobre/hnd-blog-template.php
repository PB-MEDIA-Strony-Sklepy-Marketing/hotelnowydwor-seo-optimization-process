<?php
/**
 * Plugin Name: HND Premium Blog Template
 * Description: Niestandardowy szablon wpisów blogowych dla Hotelu Nowy Dwór (Mobile-First, Premium Design).
 * Version: 1.0.0
 * Author: PB MEDIA
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Przechwycenie szablonu dla pojedynczego wpisu (post_type = post)
 */
add_filter('template_include', 'hnd_load_custom_single_template', 99);

function hnd_load_custom_single_template($template) {
    if (is_singular('post')) {
        hnd_render_single_post();
        return false; // Zatrzymuje ładowanie standardowego szablonu
    }
    return $template;
}

/**
 * Główna funkcja renderująca HTML, CSS i JS
 */
function hnd_render_single_post() {
    get_header(); // Ładuje nagłówek WP/Oxygen (scripts, styles, meta)
    ?>
    
    <!-- STYLE CSS (Scoped & Mobile First) -->
    <style>
        :root {
            --hnd-teal: #0a97b0;
            --hnd-teal-dark: #087d91;
            --hnd-black: #000000;
            --hnd-white: #ffffff;
            --hnd-gray-light: #f7f7f7;
            --hnd-text: #374151;
            --hnd-text-meta: #6b7280;
            --hnd-font-main: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            --hnd-ease: cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* Reset kontenera */
        .hnd-single-wrapper {
            font-family: var(--hnd-font-main);
            color: var(--hnd-text);
            line-height: 1.6;
            background-color: var(--hnd-white);
            overflow-x: hidden;
            width: 100%;
        }

        .hnd-container {
            width: 100%;
            padding: 0 1rem; /* 16px mobile padding */
            margin: 0 auto;
            max-width: 800px; /* Czytelność tekstu */
        }
        
        .hnd-container-wide {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* --- HERO SECTION --- */
        .hnd-hero {
            position: relative;
            height: 60vh;
            min-height: 400px;
            display: flex;
            align-items: flex-end;
            padding-bottom: 3rem;
            color: var(--hnd-white);
            background-color: var(--hnd-black);
            overflow: hidden;
        }

        .hnd-hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
            transition: transform 10s ease;
            z-index: 0;
        }

        .hnd-hero:hover .hnd-hero-bg {
            transform: scale(1.05);
        }

        .hnd-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.8) 100%);
            z-index: 1;
        }

        .hnd-hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 0 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hnd-meta {
            display: flex;
            gap: 1rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            opacity: 0; /* JS Anim */
            transform: translateY(20px);
        }

        .hnd-category {
            color: var(--hnd-teal);
            font-weight: 700;
        }

        .hnd-title {
            font-size: 2rem; /* Mobile */
            font-weight: 700;
            line-height: 1.2;
            margin: 0;
            opacity: 0; /* JS Anim */
            transform: translateY(20px);
        }

        /* --- CONTENT SECTION --- */
        .hnd-content-area {
            padding: 3rem 0;
            background: var(--hnd-white);
            position: relative;
            z-index: 5;
            margin-top: -2rem; /* Overlap effect */
            border-radius: 20px 20px 0 0;
        }

        .hnd-breadcrumbs {
            font-size: 0.85rem;
            color: var(--hnd-text-meta);
            margin-bottom: 2rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }

        .hnd-breadcrumbs a {
            color: var(--hnd-text-meta);
            text-decoration: none;
            transition: color 0.3s;
        }

        .hnd-breadcrumbs a:hover {
            color: var(--hnd-teal);
        }

        /* Typography w treści */
        .hnd-entry-content p {
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
        }

        .hnd-entry-content h2 {
            font-size: 1.75rem;
            color: var(--hnd-black);
            margin: 3rem 0 1.5rem;
            position: relative;
            padding-left: 1rem;
        }

        .hnd-entry-content h2::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            bottom: 5px;
            width: 4px;
            background-color: var(--hnd-teal);
        }

        .hnd-entry-content h3 {
            font-size: 1.4rem;
            color: var(--hnd-text);
            margin: 2rem 0 1rem;
        }

        .hnd-entry-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin: 2rem 0;
        }

        .hnd-entry-content blockquote {
            border-left: 4px solid var(--hnd-teal);
            margin: 2rem 0;
            padding: 1rem 1.5rem;
            background: var(--hnd-gray-light);
            font-style: italic;
            border-radius: 0 8px 8px 0;
        }

        /* --- AUTHOR BOX --- */
        .hnd-author-box {
            margin-top: 4rem;
            padding: 2rem;
            background: var(--hnd-gray-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-direction: column; /* Mobile */
            text-align: center;
        }

        .hnd-author-avatar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--hnd-teal);
        }

        .hnd-author-info h4 {
            margin: 0 0 0.5rem 0;
            font-size: 1.2rem;
            color: var(--hnd-black);
        }

        /* --- RELATED POSTS (3D Cards) --- */
        .hnd-related {
            padding: 4rem 0;
            background: var(--hnd-gray-light);
        }

        .hnd-section-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: var(--hnd-black);
        }

        .hnd-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .hnd-card {
            background: var(--hnd-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.4s var(--hnd-ease), box-shadow 0.4s var(--hnd-ease);
            text-decoration: none;
            color: inherit;
            display: block;
            opacity: 0; /* Anim start */
        }

        .hnd-card:hover {
            transform: translateY(-10px) perspective(1000px) rotateX(2deg);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .hnd-card-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .hnd-card-body {
            padding: 1.5rem;
        }

        .hnd-card-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--hnd-black);
            transition: color 0.3s;
        }

        .hnd-card:hover .hnd-card-title {
            color: var(--hnd-teal);
        }

        /* --- ANIMATIONS --- */
        .hnd-anim-up {
            animation: hndFadeUp 0.8s var(--hnd-ease) forwards;
        }

        .hnd-anim-left {
            animation: hndSlideLeft 0.8s var(--hnd-ease) forwards;
        }

        .hnd-anim-right {
            animation: hndSlideRight 0.8s var(--hnd-ease) forwards;
        }

        @keyframes hndFadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes hndSlideLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes hndSlideRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* --- RESPONSIVE DESKTOP --- */
        @media (min-width: 768px) {
            .hnd-title { font-size: 3.5rem; }
            .hnd-hero { height: 70vh; }
            .hnd-author-box { 
                flex-direction: row; 
                text-align: left;
                padding: 3rem;
            }
            .hnd-grid { grid-template-columns: repeat(3, 1fr); }
            .hnd-content-area { border-radius: 40px 40px 0 0; }
        }
    </style>

    <!-- HTML STRUCTURE -->
    <div class="hnd-single-wrapper">
        
        <?php while (have_posts()) : the_post(); 
            // Przygotowanie danych
            $bg_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if (!$bg_image_url) {
                // Fallback image (zmień na URL z biblioteki mediów)
                $bg_image_url = 'https://www.hotelnowydwor.eu/wp-content/uploads/hotel-nowy-dwor-front.jpg'; 
            }
            $categories = get_the_category();
            $cat_name = !empty($categories) ? $categories[0]->name : 'Blog';
            $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
            $author_name = get_the_author();
            $author_avatar = get_avatar_url(get_the_author_meta('ID'), ['size' => 160]);
        ?>

        <!-- Hero Section -->
        <header class="hnd-hero">
            <img src="<?php echo esc_url($bg_image_url); ?>" alt="<?php the_title_attribute(); ?>" class="hnd-hero-bg">
            <div class="hnd-hero-overlay"></div>
            
            <div class="hnd-hero-content">
                <div class="hnd-meta" style="animation-delay: 0.2s;">
                    <a href="<?php echo esc_url($cat_link); ?>" class="hnd-category"><?php echo esc_html($cat_name); ?></a>
                    <span class="hnd-date"><?php echo get_the_date(); ?></span>
                </div>
                <h1 class="hnd-title" style="animation-delay: 0.4s;"><?php the_title(); ?></h1>
            </div>
        </header>

        <!-- Main Content -->
        <main class="hnd-content-area">
            <div class="hnd-container">
                
                <!-- Breadcrumbs -->
                <div class="hnd-breadcrumbs">
                    <a href="<?php echo home_url(); ?>">Strona Główna</a> &raquo; 
                    <a href="/blog/">Blog</a> &raquo; 
                    <span><?php the_title(); ?></span>
                </div>

                <!-- Article Content -->
                <article class="hnd-entry-content hnd-scroll-anim">
                    <?php the_content(); ?>
                </article>

                <!-- Author Box -->
                <div class="hnd-author-box hnd-scroll-anim">
                    <div class="hnd-author-avatar">
                        <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>">
                    </div>
                    <div class="hnd-author-info">
                        <h4>O Autorze: <?php echo esc_html($author_name); ?></h4>
                        <p>Eksperci Hotelu Nowy Dwór dzielą się wiedzą na temat organizacji wesel, turystyki w Trzebnicy oraz standardów hotelowych. Zapraszamy do lektury naszych poradników.</p>
                    </div>
                </div>

            </div>
        </main>

        <!-- Related Posts Section -->
        <section class="hnd-related">
            <div class="hnd-container-wide">
                <h3 class="hnd-section-title">Zobacz również</h3>
                
                <div class="hnd-grid">
                    <?php
                    $related = new WP_Query(array(
                        'category__in' => wp_get_post_categories(get_the_ID()),
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand'
                    ));

                    if ($related->have_posts()) :
                        while ($related->have_posts()) : $related->the_post();
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                            if(!$thumb) $thumb = $bg_image_url; // fallback
                    ?>
                        <a href="<?php the_permalink(); ?>" class="hnd-card hnd-scroll-anim-card">
                            <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="hnd-card-img">
                            <div class="hnd-card-body">
                                <span style="font-size:0.8rem; color:var(--hnd-teal); font-weight:700; text-transform:uppercase;"><?php echo get_the_date(); ?></span>
                                <h4 class="hnd-card-title"><?php the_title(); ?></h4>
                                <p style="font-size:0.9rem; color:#666;"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            </div>
                        </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <?php endwhile; ?>
    </div>

    <!-- JAVASCRIPT (Animacje Scroll) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Animacja Hero przy załadowaniu
            document.querySelector('.hnd-meta').classList.add('hnd-anim-up');
            document.querySelector('.hnd-title').classList.add('hnd-anim-up');

            // Intersection Observer dla treści
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries, obs) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('hnd-anim-up');
                            obs.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });

                // Obserwuj treść i box autora
                document.querySelectorAll('.hnd-scroll-anim').forEach(el => {
                    el.style.opacity = '0'; // Ukryj początkowo
                    observer.observe(el);
                });

                // Obserwuj karty (stagger effect manually via CSS transition or simple JS loop)
                const cards = document.querySelectorAll('.hnd-scroll-anim-card');
                cards.forEach((card, index) => {
                    card.style.animationDelay = (index * 0.15) + 's';
                    observer.observe(card); // Karty dostaną hnd-anim-up
                    card.classList.add('hnd-anim-up-ready'); // Marker class
                });
            } else {
                // Fallback dla starszych przeglądarek
                document.querySelectorAll('.hnd-meta, .hnd-title, .hnd-scroll-anim, .hnd-scroll-anim-card').forEach(el => {
                    el.style.opacity = '1';
                    el.style.transform = 'none';
                });
            }
        });
    </script>

    <?php
    get_footer(); // Ładuje stopkę WP/Oxygen
}
?>