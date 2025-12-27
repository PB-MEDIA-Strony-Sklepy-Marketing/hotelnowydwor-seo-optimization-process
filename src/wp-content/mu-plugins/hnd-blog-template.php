<?php
/**
 * Plugin Name: HND Premium Blog Template (Safe & Premium v8)
 * Description: Szablon wpisu "HND Premium Blog Layout" dla pojedynczych postów. Bezpieczeństwo (brak pętli), wygląd premium (hero, author, related).
 * Version: 3.1.3
 * Author: PB MEDIA
 */

if (!defined('ABSPATH')) {
    exit;
}

add_filter('theme_post_templates', function ($templates) {
    $templates['hnd-premium-layout'] = 'HND Premium Blog Layout';
    return $templates;
});

add_filter('the_content', 'hnd_inject_premium_layout_v8', 9);
function hnd_inject_premium_layout_v8($content)
{
    global $post;

    static $processing = false;
    if ($processing) {
        return $content;
    }

    if (!is_singular('post') || !in_the_loop() || !is_main_query()) {
        return $content;
    }

    $template_slug = get_page_template_slug($post->ID);
    if ($template_slug !== 'hnd-premium-layout') {
        return $content;
    }

    $processing = true;
    remove_filter('the_content', 'hnd_inject_premium_layout_v8', 9);

    $post_id      = get_the_ID();
    $bg_image_url = get_the_post_thumbnail_url($post_id, 'full');
    if (!$bg_image_url) {
        $bg_image_url = content_url('/uploads/hotel-nowy-dwor-front.jpg');
    }

    $categories = get_the_category($post_id);
    $cat_name   = !empty($categories) ? $categories[0]->name : 'Blog';
    $cat_link   = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';

    $author_id     = $post->post_author;
    $author_name   = get_the_author_meta('display_name', $author_id);
    $author_avatar = get_avatar_url($author_id, ['size' => 160]);

    ob_start();
    ?>
    <!-- SCOPED CSS (wygląd premium) -->
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
        .hnd-layout-wrapper { font-family: var(--hnd-font-main); color: var(--hnd-text); line-height: 1.7; background: var(--hnd-white); width: 100%; overflow: hidden; margin-bottom: 2rem; }
        .hnd-container { width: 100%; padding: 0 1.25rem; margin: 0 auto; max-width: 1280px; padding-top: 125px; }
        .hnd-container-wide { max-width: 1240px; margin: 0 auto; padding: 0 1.25rem; }

        /* HERO */
        .hnd-hero { position: relative; height: 60vh; min-height: 400px; display: flex; align-items: flex-end; padding-bottom: 3rem; color: var(--hnd-white); background: var(--hnd-black); margin-bottom: 0; z-index: 1; }
        .hnd-hero-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.6; transition: transform 10s ease; z-index: 0; }
        .hnd-hero:hover .hnd-hero-bg { transform: scale(1.05); }
        .hnd-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.85) 100%); z-index: 1; height: 500px;}
        .hnd-hero-content { position: relative; z-index: 2; width: 100%; padding: 0 1.25rem 0 1.25rem; max-width: 1240px; margin: 0 auto; display: flex; flex-direction: column; gap: 0.5rem; margin-top: 200px;}
        .hnd-meta { display: inline-flex; flex-wrap: wrap; gap: 0.6rem; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin: 0; color: rgba(255,255,255,0.9); align-items: center; }
        .hnd-meta br { display: none; }
        .hnd-category { color: var(--hnd-teal); font-weight: 700; text-decoration: none; }
        .hnd-title { font-size: 2.1rem; font-weight: 700; line-height: 1.25; margin: 0; color: #fff; text-shadow: 0 2px 10px rgba(0,0,0,0.35); }

        /* CONTENT */
        .hnd-content-area { padding: 4rem 0 4rem; background: var(--hnd-white); position: relative; z-index: 2; border-radius: 20px 20px 0 0; box-shadow: 0 -10px 30px rgba(0,0,0,0.05); }
        .hnd-content-area::before { content: ""; display: block; height: 1rem; }
        .hnd-breadcrumbs { font-size: 0.85rem; color: var(--hnd-text-meta); margin-bottom: 2rem; border-bottom: 1px solid #eee; padding-bottom: 1rem; display: flex; flex-wrap: wrap; gap: 0.35rem; align-items: center; }
        .hnd-breadcrumbs br { display: none; }
        .hnd-breadcrumbs a { color: var(--hnd-text-meta); text-decoration: none; transition: color 0.3s; }
        .hnd-breadcrumbs a:hover { color: var(--hnd-teal); }
        .hnd-entry-content p { margin-bottom: 1.5rem; font-size: 1.125rem; }
        .hnd-entry-content h2 { font-size: 1.75rem; color: var(--hnd-black); margin: 3rem 0 1.5rem; padding-left: 1rem; border-left: 4px solid var(--hnd-teal); }
        .hnd-entry-content h3 { font-size: 1.4rem; margin: 2rem 0 1rem; font-weight: 600; }
        .hnd-entry-content img { max-width: 100%; height: auto; border-radius: 8px; margin: 2rem 0; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .hnd-entry-content blockquote { border-left: 4px solid var(--hnd-teal); margin: 2rem 0; padding: 1rem 1.5rem; background: var(--hnd-gray-light); font-style: italic; border-radius: 0 8px 8px 0; }

        /* AUTHOR */
        .hnd-author-box { margin-top: 4rem; padding: 2rem; background: var(--hnd-gray-light); border-radius: 12px; display: flex; align-items: center; gap: 1.5rem; flex-direction: column; text-align: center; }
        .hnd-author-avatar img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--hnd-teal); }
        .hnd-author-info h4 { margin: 0 0 0.5rem 0; font-size: 1.2rem; color: var(--hnd-black); }
        .hnd-author-info p { font-size: 0.9rem; color: var(--hnd-text-meta); margin: 0; }

        /* RELATED */
        .hnd-related { padding: 4rem 0; background: var(--hnd-gray-light); margin-top: 0; }
        .hnd-section-title { text-align: center; font-size: 1.8rem; margin-bottom: 2rem; color: var(--hnd-black); }
        .hnd-grid { display: flex; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; align-items: stretch; }
        .hnd-card { background: var(--hnd-white); border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: transform 0.4s var(--hnd-ease), box-shadow 0.4s var(--hnd-ease); text-decoration: none; color: inherit; display: flex; flex-direction: column; min-height: 100%; }
        .hnd-card:hover { transform: translateY(-8px); box-shadow: 0 18px 36px rgba(0,0,0,0.12); }
        .hnd-card br { display: none; }
        .hnd-card-img { height: 200px; width: 100%; object-fit: cover; flex-shrink: 0; }
        .hnd-card-body { padding: 1.25rem; display: flex; flex-direction: column; gap: 0.35rem; flex: 1; }
        .hnd-card-title { font-size: 1.15rem; font-weight: 700; margin: 0; color: var(--hnd-black); transition: color 0.3s; }
        .hnd-card:hover .hnd-card-title { color: var(--hnd-teal); }

        @media (min-width: 768px) {
            .hnd-title { font-size: 3.1rem; }
            .hnd-hero { height: 68vh!important; }
            .hnd-author-box { flex-direction: row; text-align: left; padding: 3rem; }
            .hnd-content-area { border-radius: 40px 40px 0 0; }
        }

        @media (min-width: 1200px) {
            .hnd-container { max-width: 1100px; }
            .hnd-container-wide { max-width: 1320px; }
            .hnd-title { font-size: 3.6rem; }
        }
    </style>

    <div class="hnd-layout-wrapper">

        <!-- Content -->
        <!-- Hero -->
        <section class="hnd-hero">
            <img src="<?php echo esc_url($bg_image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="hnd-hero-bg" style="height: 500px;">
            <div class="hnd-hero-overlay"></div>
            <div class="hnd-hero-content">
                <div class="hnd-meta">
                    <a href="<?php echo esc_url($cat_link); ?>" class="hnd-category"><?php echo esc_html($cat_name); ?></a>
                    <span>•</span>
                    <span><?php echo get_the_date(); ?></span>
                </div>
                <h1 class="hnd-title"><?php echo get_the_title(); ?></h1>
            </div>
        </section>
            
            <div class="hnd-container">
                <nav class="hnd-breadcrumbs" role="navigation" aria-label="Nawigacja strony">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Strona Główna</a> »
                    <a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a> »
                    <span><?php echo get_the_title(); ?></span>
                </nav>

                <article class="hnd-entry-content">
                    <?php echo $content; ?>
                </article>

                <aside class="hnd-author-box">
                    <div class="hnd-author-avatar">
                        <img src="https://nowydwor.smarthost.pl/hotelnowydwor.eu-new/wp-content/uploads/2025/12/logologo.png" alt="<?php echo esc_attr($author_name); ?>">
                    </div>
                    <div class="hnd-author-info">
                        <h4>O Autorze: <?php echo esc_html($author_name); ?></h4>
                        <p>Eksperci Hotelu Nowy Dwór. Dzielimy się pasją do hotelarstwa, organizacji wesel i miłością do regionu Trzebnicy.</p>
                    </div>
                </aside>
            </div>

        <!-- Related Posts -->
        <section class="hnd-related">
            <div class="hnd-container-wide">
                <h3 class="hnd-section-title">Zobacz również</h3>
                <div class="hnd-grid">
                    <?php
                    $related_args = array(
                        'category__in'            => wp_get_post_categories($post_id),
                        'posts_per_page'          => 3,
                        'post__not_in'            => array($post_id),
                        'orderby'                 => 'rand',
                        'post_status'             => 'publish',
                        'ignore_sticky_posts'     => 1,
                        'no_found_rows'           => true,
                        'update_post_meta_cache'  => false,
                        'update_post_term_cache'  => false,
                    );
                    $related = new WP_Query($related_args);

                    if ($related->have_posts()) :
                        while ($related->have_posts()) : $related->the_post();
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                            if (!$thumb) {
                                $thumb = $bg_image_url;
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>" class="hnd-card">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" class="hnd-card-img" loading="lazy">
                                <div class="hnd-card-body">
                                    <span style="font-size: 0.75rem; color:var(--hnd-teal); font-weight:700; text-transform:uppercase;"><?php echo get_the_date(); ?></span>
                                    <h4 class="hnd-card-title"><?php the_title(); ?></h4>
                                    <p style="font-size: 0.9rem; color:#666; margin:0;"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                                </div>
                            </a>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p style="text-align:center; color:#999;">Więcej artykułów już wkrótce.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </section>
    </div>
    <?php

    $output = ob_get_clean();

    add_filter('the_content', 'hnd_inject_premium_layout_v8', 9);
    $processing = false;

    return $output;
}