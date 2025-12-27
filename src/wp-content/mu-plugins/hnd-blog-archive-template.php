<?php
/**
 * Plugin Name: HND Blog Archive Template (Fixed CSS v2)
 * Description: Wybieralny szablon dla Strony (post_type=page) renderujący archiwum wpisów (post_type=post). CSS ładowany w nagłówku dla poprawności.
 * Version: 1.1.0
 * Author: PB MEDIA
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1) Rejestracja „wirtualnego” szablonu dla Stron (page)
 */
add_filter('theme_page_templates', function ($templates) {
    $templates['hnd-blog-archive-layout'] = 'HND Blog Archive Layout';
    return $templates;
});

/**
 * 2) Ładowanie CSS w wp_head TYLKO gdy wyświetlamy nasze archiwum.
 *    Zapobiega to psuciu CSS przez filtry treści (wpautop).
 */
add_action('wp_head', 'hnd_archive_inject_styles');

function hnd_archive_inject_styles() {
    // Sprawdź czy to strona z naszym szablonem
    if (!is_singular('page')) return;
    
    $page_id = get_the_ID();
    $template_slug = get_page_template_slug($page_id);
    
    if ($template_slug !== 'hnd-blog-archive-layout') return;
    
    ?>
    <style>
        :root {
            --hndp-teal: #0a97b0;
            --hndp-black: #000000;
            --hndp-white: #ffffff;
            --hndp-gray: #f7f7f7;
            --hndp-text: #374151;
            --hndp-muted: #6b7280;
            --hndp-radius: 16px;
            --hndp-ease: cubic-bezier(0.23, 1, 0.32, 1);
            --hndp-shadow: 0 12px 30px rgba(0,0,0,0.10);
        }

        /* Reset kontenera */
        
        .pw-nav {
            background: radial-gradient(1200px 600px at 30% 50%, rgba(10,151,176,0.35), transparent 60%),
                radial-gradient(800px 300px at 80% 80%, rgba(255,255,255,0.10), transparent 60%)
        }
        
        .oxy-mega-dropdown_link {
            color: #000!important;
        }
        
        .contact-link {
            color: #000!important;
        }
        
        .hndp-archive {
            background: var(--hndp-white);
            color: var(--hndp-text);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            width: 100%;
            display: block;
            box-sizing: border-box;
            margin-top: 100px;
        }

        .hndp-archive__container {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
            padding: 2rem 1.25rem 3rem;
            box-sizing: border-box;
        }

        /* Hero */
        .hndp-archive__hero {
            position: relative;
            border-radius: calc(var(--hndp-radius) + 6px);
            overflow: hidden;
            background: linear-gradient(135deg, rgba(10,151,176,0.18), rgba(0,0,0,0.82));
            box-shadow: var(--hndp-shadow);
            padding: 2rem 1.25rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .hndp-archive__hero:before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(800px 300px at 20% 20%, rgba(10,151,176,0.35), transparent 60%),
                radial-gradient(800px 300px at 80% 80%, rgba(255,255,255,0.10), transparent 60%);
            pointer-events: none;
        }

        .hndp-archive__hero-inner {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            z-index: 1;
        }

        .hndp-archive__kicker {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.85);
            flex-wrap: wrap;
        }

        .hndp-archive__badge {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 0.75rem;
            border-radius: 999px;
            border: 1px solid rgba(10,151,176,0.45);
            background: rgba(10,151,176,0.18);
            backdrop-filter: blur(10px);
            color: var(--hndp-white);
            font-weight: 700;
            line-height: 1;
        }

        .hndp-archive__title {
            margin: 0;
            font-weight: 800;
            color: var(--hndp-white);
            line-height: 1.1;
            font-size: clamp(1.6rem, 5vw, 2.7rem);
            text-shadow: 0 10px 30px rgba(0,0,0,0.35);
        }

        .hndp-archive__subtitle {
            margin: 0;
            max-width: 70ch;
            color: rgba(255,255,255,0.86);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Toolbar */
        .hndp-archive__toolbar {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin: 1rem 0 1.5rem;
        }

        /* Usuwamy domyślne style p dla przycisków */
        .hndp-archive__toolbar p {
            margin: 0;
            padding: 0;
        }

        .hndp-archive__search {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            padding: 0.5rem 0.85rem;
            border-radius: 999px;
            border: 1px solid rgba(0,0,0,0.08);
            background: var(--hndp-gray);
            width: 100%;
            box-sizing: border-box;
        }

        .hndp-archive__search input[type="search"] {
            width: 100%;
            border: 0;
            background: transparent;
            font-size: 16px; /* iOS: brak zoom */
            outline: none;
            color: var(--hndp-text);
            padding: 0;
            margin: 0;
            height: auto;
            box-shadow: none;
        }
        
        /* Ukryj br dodane przez WP */
        .hndp-archive br,
        .hndp-archive__toolbar br,
        .hndp-archive__search br {
            display: none !important;
        }

        .hndp-archive__cta {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 44px;
            padding: 0.85rem 1rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 800;
            background: var(--hndp-teal);
            color: var(--hndp-white);
            transition: transform .35s var(--hndp-ease), filter .35s var(--hndp-ease);
            will-change: transform;
            line-height: 1;
            border: none;
        }

        .hndp-archive__cta:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            color: var(--hndp-white);
        }

        /* Grid */
        .hndp-archive__grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            width: 100%;
        }

        .hndp-card {
            background: var(--hndp-white);
            border-radius: var(--hndp-radius);
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.06);
            transform: translateZ(0);
            transition: transform .45s var(--hndp-ease), box-shadow .45s var(--hndp-ease);
            display: flex;
            flex-direction: column;
            min-height: 100%;
            text-decoration: none !important;
        }
        
        /* Usuwamy style linków dla kart */
        .hndp-card a {
            text-decoration: none !important;
            box-shadow: none !important;
            border-bottom: none !important;
        }

        .hndp-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 50px rgba(0,0,0,0.12);
        }

        .hndp-card__media {
            position: relative;
            background: #111;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            display: block;
            width: 100%;
        }

        .hndp-card__media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.2s var(--hndp-ease);
            display: block;
            margin: 0;
            padding: 0;
        }

        .hndp-card:hover .hndp-card__media img {
            transform: scale(1.06);
        }

        .hndp-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.55), rgba(0,0,0,0));
            pointer-events: none;
        }

        .hndp-card__body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex-grow: 1;
        }

        .hndp-card__meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
            color: var(--hndp-muted);
            font-size: 0.85rem;
            line-height: 1;
        }

        .hndp-card__cat {
            color: var(--hndp-teal) !important;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .hndp-card__title {
            margin: 0;
            font-size: 1.25rem;
            line-height: 1.35;
            font-weight: 800;
            color: var(--hndp-black);
        }
        
        .hndp-card__title a {
             color: var(--hndp-black) !important;
        }

        .hndp-card__excerpt {
            margin: 0;
            color: var(--hndp-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .hndp-card__link {
            margin-top: auto;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 800;
            color: var(--hndp-black) !important;
            font-size: 0.9rem;
        }

        .hndp-card__link:hover {
            color: var(--hndp-teal) !important;
        }

        /* Pagination */
        .hndp-pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .hndp-pagination .page-numbers {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
            padding: 0 0.75rem;
            border-radius: 999px;
            background: var(--hndp-white);
            border: 1px solid rgba(0,0,0,0.1);
            color: var(--hndp-text);
            text-decoration: none;
            font-weight: 700;
            transition: all .2s ease;
        }

        .hndp-pagination .page-numbers:hover {
            background: var(--hndp-gray);
            border-color: rgba(0,0,0,0.2);
            color: var(--hndp-black);
        }

        .hndp-pagination .page-numbers.current {
            background: var(--hndp-teal);
            border-color: var(--hndp-teal);
            color: var(--hndp-white);
        }

        /* Desktop */
        @media (min-width: 768px) {
            .hndp-archive__toolbar {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
            }

            .hndp-archive__search {
                max-width: 400px;
            }

            .hndp-archive__grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
             .hndp-archive__container {
                padding: 3rem 2rem 4rem;
            }
            
            .hndp-archive__hero {
                padding: 3rem 2.5rem;
            }
            
            .hndp-archive__title {
                font-size: 3rem;
            }
            
            .hndp-archive__grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }
    </style>
    <?php
}

/**
 * 3) Wstrzyknięcie archiwum wpisów do treści Strony, która ma ustawiony nasz template.
 */
add_filter('the_content', 'hnd_render_blog_archive_into_page', 9);

function hnd_render_blog_archive_into_page($content)
{
    static $processing = false;

    if ($processing) {
        return $content;
    }

    if (!is_singular('page') || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    $page_id = get_the_ID();
    $template_slug = get_page_template_slug($page_id);

    if ($template_slug !== 'hnd-blog-archive-layout') {
        return $content;
    }

    $processing = true;
    remove_filter('the_content', 'hnd_render_blog_archive_into_page', 9);

    // Parametry listy wpisów (archiwum)
    $paged = max(1, (int) get_query_var('paged'));
    if (get_query_var('page')) {
        $paged = max($paged, (int) get_query_var('page'));
    }

    $posts_per_page = 9;

    $q = new WP_Query(array(
        'post_type'              => 'post',
        'post_status'            => 'publish',
        'posts_per_page'         => $posts_per_page,
        'paged'                  => $paged,
        'ignore_sticky_posts'    => 1,
        'no_found_rows'          => false,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ));

    ob_start();
    ?>
    <section class="hndp-archive" aria-label="Archiwum wpisów blogowych">
        <div class="hndp-archive__container">

            <header class="hndp-archive__hero">
                <div class="hndp-archive__hero-inner">
                    <div class="hndp-archive__kicker">
                        <span class="hndp-archive__badge">Hotel Nowy Dwór</span>
                        <span>Blog</span>
                    </div>
                    <h1 class="hndp-archive__title">Aktualności i porady dla Gości</h1>
                    <p class="hndp-archive__subtitle">
                        Inspiracje na weekend w Trzebnicy, wskazówki podróżne, kulisy organizacji wesel i eventów oraz nowości z Hotelu Nowy Dwór.
                    </p>
                </div>
            </header>

            <div class="hndp-archive__toolbar">
                <form class="hndp-archive__search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <label class="screen-reader-text" for="hndp-s">Szukaj na blogu</label>
                    <input id="hndp-s" type="search" name="s" placeholder="Szukaj wpisu (np. hotel Trzebnica)..." value="<?php echo esc_attr(get_search_query()); ?>">
                    <input type="hidden" name="post_type" value="post">
                </form>

                <a class="hndp-archive__cta" href="<?php echo esc_url(home_url('/kontakt/')); ?>">
                    Zapytaj o pobyt
                </a>
            </div>

            <?php if ($q->have_posts()) : ?>
                <div class="hndp-archive__grid">
                    <?php
                    while ($q->have_posts()) :
                        $q->the_post();

                        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        if (!$thumb) {
                            $thumb = content_url('/uploads/hotel-nowy-dwor-front.jpg');
                        }

                        $cats = get_the_category(get_the_ID());
                        $cat_name = !empty($cats) ? $cats[0]->name : 'Blog';
                        $cat_link = !empty($cats) ? get_category_link($cats[0]->term_id) : '#';
                        ?>
                        <article class="hndp-card">
                            <a class="hndp-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" decoding="async">
                                <span class="hndp-card__overlay" aria-hidden="true"></span>
                            </a>

                            <div class="hndp-card__body">
                                <div class="hndp-card__meta">
                                    <a class="hndp-card__cat" href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a>
                                    <span aria-hidden="true">•</span>
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                                </div>

                                <h2 class="hndp-card__title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <p class="hndp-card__excerpt">
                                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?>
                                </p>

                                <a class="hndp-card__link" href="<?php the_permalink(); ?>">
                                    Czytaj więcej <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <nav class="hndp-pagination" aria-label="Paginacja bloga">
                    <?php
                    echo paginate_links(array(
                        'total'   => (int) $q->max_num_pages,
                        'current' => (int) $paged,
                        'mid_size' => 1,
                        'prev_text' => '‹',
                        'next_text' => '›',
                    ));
                    ?>
                </nav>

            <?php else : ?>
                <p style="text-align:center; color:var(--hndp-muted); padding: 4rem 0;">
                    Brak wpisów do wyświetlenia. Zapraszamy wkrótce!
                </p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </section>
    <?php

    $output = ob_get_clean();

    // Przywracamy filtr, by inne wywołania (choć mało prawdopodobne) działały
    add_filter('the_content', 'hnd_render_blog_archive_into_page', 9);
    $processing = false;

    return $output;
}