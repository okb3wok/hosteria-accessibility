<?php
/*
Plugin Name: %%PLUGIN_NAME%%
Plugin URI: https://wordpress.org/plugins/%%PLUGIN_SLUG%%/
Description: Make your site accessible to visually impaired users: customize colors, text spacing, font sizes, and images.
Author: Alexander Dolzhenkov <okb3wok@yandex.ru>
Version: %%VERSION%%
Author URI: https://hosteria.ru/
Text Domain: %%PLUGIN_SLUG%%
Domain Path: /languages
License: GPLv2 or later
*/

if ( ! defined( 'ABSPATH' ) ) {
  header( 'HTTP/1.1 403 Forbidden' );
  echo 'Forbidden';
  exit;
}


/**
 * Render accessibility UI.
 *
 * @return void
 */
function %%PREFIX%%_render_ui() {
	?>

  <button
    id="%%PREFIX%%-toggle-btn"
    type="button"
    class="%%PREFIX%%-toggle-btn"
    title="<?php echo esc_attr__( 'Accessibility version', '%%PLUGIN_SLUG%%' ); ?>"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="%%PREFIX%%-toggle-icon"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      aria-hidden="true"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
      />
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
      />
    </svg>
  </button>

  <div
    id="%%PREFIX%%-panel"
    class="%%PREFIX%%-panel %%PREFIX%%-hidden"
  >
    <div class="%%PREFIX%%-header">
      <?php esc_html_e( 'Color schemes and font', '%%PLUGIN_SLUG%%' ); ?>
    </div>

    <div class="%%PREFIX%%-controls-group">

      <div class="%%PREFIX%%-block">
				<span class="%%PREFIX%%-block-title">
					<?php esc_html_e( 'Color', '%%PLUGIN_SLUG%%' ); ?>
				</span>

        <div class="%%PREFIX%%-btn-group">
          <button
            id="%%PREFIX%%-btn-theme-norm"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-norm"
          >
            <?php esc_html_e( 'Normal', '%%PLUGIN_SLUG%%' ); ?>
          </button>

          <button
            id="%%PREFIX%%-btn-theme-b"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-b"
          >
            <?php esc_html_e( 'White', '%%PLUGIN_SLUG%%' ); ?>
          </button>

          <button
            id="%%PREFIX%%-btn-theme-ch"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-ch"
          >
            <?php esc_html_e( 'Black', '%%PLUGIN_SLUG%%' ); ?>
          </button>

          <button
            id="%%PREFIX%%-btn-theme-g"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-g"
          >
            <?php esc_html_e( 'Blue', '%%PLUGIN_SLUG%%' ); ?>
          </button>

          <button
            id="%%PREFIX%%-btn-theme-k"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-k"
          >
            <?php esc_html_e( 'Brown', '%%PLUGIN_SLUG%%' ); ?>
          </button>
        </div>
      </div>


      <div class="%%PREFIX%%-block">
				<span class="%%PREFIX%%-block-title">
					<?php esc_html_e( 'Font size', '%%PLUGIN_SLUG%%' ); ?>
				</span>

        <div class="%%PREFIX%%-btn-group">
          <button
            id="%%PREFIX%%-btn-font-size-dec"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-default"
          >
            <?php esc_html_e( '− Smaller', '%%PLUGIN_SLUG%%' ); ?>
          </button>

          <button
            id="%%PREFIX%%-btn-font-size-inc"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-default"
          >
            <?php esc_html_e( '+ Larger', '%%PLUGIN_SLUG%%' ); ?>
          </button>
        </div>
      </div>


      <div class="%%PREFIX%%-block">
				<span class="%%PREFIX%%-block-title">
					<?php esc_html_e( 'Font', '%%PLUGIN_SLUG%%' ); ?>
				</span>

        <div class="%%PREFIX%%-btn-group">
          <button
            id="%%PREFIX%%-btn-font-sans"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-sans"
          >
            <?php esc_html_e( 'Sans Serif', '%%PLUGIN_SLUG%%' ); ?>
          </button>

          <button
            id="%%PREFIX%%-btn-font-serif"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-serif"
          >
            <?php esc_html_e( 'Serif', '%%PLUGIN_SLUG%%' ); ?>
          </button>
        </div>
      </div>


      <div class="%%PREFIX%%-block">
				<span class="%%PREFIX%%-block-title">
					<?php esc_html_e( 'Letter spacing', '%%PLUGIN_SLUG%%' ); ?>
				</span>

        <div class="%%PREFIX%%-btn-group">
          <button
            id="%%PREFIX%%-btn-kerning-dec"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-default"
          >
            <?php esc_html_e( 'Less', '%%PLUGIN_SLUG%%' ); ?>
          </button>

          <button
            id="%%PREFIX%%-btn-kerning-inc"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-tracking-widest"
          >
            <?php esc_html_e( 'M o r e', '%%PLUGIN_SLUG%%' ); ?>
          </button>
        </div>
      </div>


      <div class="%%PREFIX%%-block">
				<span class="%%PREFIX%%-block-title">
					<?php esc_html_e( 'Line spacing', '%%PLUGIN_SLUG%%' ); ?>
				</span>

        <div class="%%PREFIX%%-btn-group">
          <button
            id="%%PREFIX%%-btn-line-height-dec"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-font-bold"
          >
            ///
          </button>

          <button
            id="%%PREFIX%%-btn-line-height-inc"
            type="button"
            class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-font-bold"
          >
            / / /
          </button>
        </div>
      </div>


      <div class="%%PREFIX%%-block">
				<span class="%%PREFIX%%-block-title">
					<?php esc_html_e( 'Images', '%%PLUGIN_SLUG%%' ); ?>
				</span>

        <button
          id="%%PREFIX%%-btn-toggle-img"
          type="button"
          class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-btn-img"
          title="<?php echo esc_attr__( 'Toggle images', '%%PLUGIN_SLUG%%' ); ?>"
          aria-label="<?php echo esc_attr__( 'Toggle images', '%%PLUGIN_SLUG%%' ); ?>"
        >
          <span class="%%PREFIX%%-img-icon" aria-hidden="true"></span>
        </button>
      </div>

    </div>
  </div>

<?php
}
add_action( 'wp_footer', '%%PREFIX%%_render_ui' );


/**
 * Register plugin assets.
 *
 * @return void
 */
function %%PREFIX%%_register_assets() {

wp_register_script(
  '%%PREFIX%%-main-script',
  plugin_dir_url( __FILE__ ) . 'assets/%%PLUGIN_SLUG%%.js',
  array(),
  '%%VERSION%%',
  true
);

	wp_register_style(
    '%%PREFIX%%-main-style',
    plugin_dir_url( __FILE__ ) . 'assets/%%PLUGIN_SLUG%%.css',
    array(),
    '%%VERSION%%'
  );
}
add_action( 'wp_enqueue_scripts', '%%PREFIX%%_register_assets' );


/**
 * Enqueue plugin assets on the frontend.
 *
 * @return void
 */
function %%PREFIX%%_conditionally_enqueue() {

	if ( is_admin() || is_feed() ) {
    return;
  }

	wp_enqueue_script( '%%PREFIX%%-main-script' );
	wp_enqueue_style( '%%PREFIX%%-main-style' );
}
add_action( 'wp_enqueue_scripts', '%%PREFIX%%_conditionally_enqueue', 20 );
