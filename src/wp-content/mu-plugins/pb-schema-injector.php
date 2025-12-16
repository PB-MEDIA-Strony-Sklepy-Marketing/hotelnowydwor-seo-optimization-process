<?php
/**
 * Plugin Name: PB MEDIA - Schema.org Custom Injector
 * Description: Dodaje pole do wklejania kodu JSON-LD Schema.org dla stron i wpisów. Kod jest wstrzykiwany do sekcji <head>.
 * Version: 1.0.0
 * Author: PB MEDIA (AI Agent)
 * Text Domain: pb-schema
 */

// Zabezpieczenie przed bezpośrednim dostępem
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Konfiguracja klucza meta danych
 */
define( 'PB_SCHEMA_META_KEY', '_pb_custom_schema_json' );

/**
 * 1. Rejestracja Meta Boxa (Pola w edytorze)
 * Wyświetla się dla 'page' i 'post'.
 */
function pb_add_schema_meta_box() {
	$screens = [ 'post', 'page' ];

	foreach ( $screens as $screen ) {
		add_meta_box(
			'pb_schema_meta_box',                 // Unikalne ID
			'Dane strukturalne (Schema.org JSON-LD)', // Tytuł widoczny dla użytkownika
			'pb_render_schema_meta_box',          // Funkcja renderująca HTML
			$screen,                              // Gdzie wyświetlić (post, page)
			'normal',                             // Kontekst (główna kolumna pod edytorem)
			'high'                                // Priorytet (wyświetl wysoko)
		);
	}
}
add_action( 'add_meta_boxes', 'pb_add_schema_meta_box' );

/**
 * 2. Wyświetlanie pola HTML w panelu admina
 */
function pb_render_schema_meta_box( $post ) {
	// Pobierz aktualną wartość z bazy danych
	$value = get_post_meta( $post->ID, PB_SCHEMA_META_KEY, true );

	// Dodaj pole nonce dla bezpieczeństwa
	wp_nonce_field( 'pb_save_schema_data', 'pb_schema_nonce' );

	?>
	<p class="description">
		Wklej tutaj <strong>pełny kod</strong> Schema.org (wraz ze znacznikami <code>&lt;script type="application/ld+json"&gt;</code>).
		<br>Ten kod zostanie dodany do sekcji <code>&lt;head&gt;</code> tylko na tej podstronie.
	</p>
	<textarea 
		name="pb_custom_schema" 
		id="pb_custom_schema" 
		rows="10" 
		style="width: 100%; font-family: monospace; background: #f7f7f7; border: 1px solid #ccc;"
		placeholder='<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  ...
}
</script>'
	><?php echo esc_textarea( $value ); ?></textarea>
	<?php
}

/**
 * 3. Zapisywanie danych do bazy
 */
function pb_save_schema_meta_box( $post_id ) {
	// Sprawdź nonce (zabezpieczenie CSRF)
	if ( ! isset( $_POST['pb_schema_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['pb_schema_nonce'], 'pb_save_schema_data' ) ) {
		return;
	}

	// Sprawdź czy to nie autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Sprawdź uprawnienia użytkownika
	if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Zapisz lub usuń dane
	if ( isset( $_POST['pb_custom_schema'] ) ) {
		// UWAGA: Nie używamy sanitize_text_field, ponieważ niszczy to strukturę JSON i tagi HTML.
		// Zamiast tego polegamy na uprawnieniach administratora/edytora.
		// Wartość jest zapisywana "as is", aby zachować strukturę skryptu.
		$schema_content = $_POST['pb_custom_schema']; // Raw input

		if ( ! empty( $schema_content ) ) {
			update_post_meta( $post_id, PB_SCHEMA_META_KEY, $schema_content );
		} else {
			delete_post_meta( $post_id, PB_SCHEMA_META_KEY );
		}
	}
}
add_action( 'save_post', 'pb_save_schema_meta_box' );

/**
 * 4. Wstrzykiwanie kodu do <head> na frontendzie
 */
function pb_inject_schema_to_head() {
	// Działaj tylko na pojedynczych stronach i wpisach
	if ( ! is_singular( [ 'post', 'page' ] ) ) {
		return;
	}

	global $post;
	$schema_code = get_post_meta( $post->ID, PB_SCHEMA_META_KEY, true );

	// Jeśli pole nie jest puste, wyświetl kod
	if ( ! empty( $schema_code ) ) {
		echo "\n<!-- PB MEDIA Custom Schema Start -->\n";
		// Wyświetlamy bez escapowania, ponieważ to kod JS wklejony przez admina
		echo $schema_code; 
		echo "\n<!-- PB MEDIA Custom Schema End -->\n";
	}
}
// Priorytet 99 sprawia, że kod ładuje się nisko w <head>, tuż przed zamknięciem
add_action( 'wp_head', 'pb_inject_schema_to_head', 99 );