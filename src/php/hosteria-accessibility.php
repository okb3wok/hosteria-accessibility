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
 * Register plugin settings with sanitization callback.
 */
function %%PREFIX%%_register_settings() {
register_setting(
  '%%PREFIX%%_settings_group',
  '%%PREFIX%%_trigger_id',
  array(
    'type'              => 'string',
    'sanitize_callback' => 'sanitize_html_class',
    'default'           => '',
  )
);
}
add_action( 'admin_init', '%%PREFIX%%_register_settings' );

/**
 * Add options page to admin menu.
 */
function %%PREFIX%%_add_admin_menu() {
add_options_page(
  __( '%%PLUGIN_NAME%% Settings', '%%PLUGIN_SLUG%%' ),
  __( '%%PLUGIN_NAME%%', '%%PLUGIN_SLUG%%' ),
  'manage_options',
  '%%PLUGIN_SLUG%%',
  '%%PREFIX%%_settings_page_html'
);
}
add_action( 'admin_menu', '%%PREFIX%%_add_admin_menu' );

/**
 * Render Settings Page
 */
function %%PREFIX%%_settings_page_html() {
  if ( ! current_user_can( 'manage_options' ) ) return;

  $trigger_id = get_option( '%%PREFIX%%_trigger_id', '' );
  ?>
  <div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form method="post" action="options.php">
      <?php settings_fields( '%%PREFIX%%_settings_group' ); ?>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><?php esc_html_e( 'Custom Button ID', '%%PLUGIN_SLUG%%' ); ?></th>
          <td>
            <input
              type="text"
              name="%%PREFIX%%_trigger_id"
              value="<?php echo esc_attr( $trigger_id ); ?>"
              class="regular-text"
              placeholder="<?php echo esc_attr( '%%PREFIX%%-toggle-btn' ); ?>"
            />
            <p class="description">
              <?php esc_html_e( 'Leave blank to use the default floating button. Specify the element ID without the leading "#" (e.g., my-custom-button) if you want the panel to open when clicking your custom button.', '%%PLUGIN_SLUG%%' ); ?>
            </p>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
}

/**
 * Render accessibility UI.
 */
function %%PREFIX%%_render_ui() {
  if ( is_admin() || is_feed() ) return;

  $custom_id = trim( get_option( '%%PREFIX%%_trigger_id', '' ) );

  ?>
  <div id="%%PREFIX%%-container">
  <?php
  if ( empty( $custom_id ) ) : ?>
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
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      </svg>
      <svg class="hosta11y-toggle-icon hosta11y-toggle-icon__hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
  <?php endif; ?>

  <div id="%%PREFIX%%-panel" class="%%PREFIX%%-panel %%PREFIX%%-hidden">
    <div class="%%PREFIX%%-header"><?php esc_html_e( 'Color schemes and font', '%%PLUGIN_SLUG%%' ); ?></div>
    <div class="%%PREFIX%%-controls-group">
      <div class="%%PREFIX%%-block">
        <span class="%%PREFIX%%-block-title"><?php esc_html_e( 'Color', '%%PLUGIN_SLUG%%' ); ?></span>
        <div class="%%PREFIX%%-btn-group">
          <button id="%%PREFIX%%-btn-theme-norm" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-norm"><?php esc_html_e( 'Normal', '%%PLUGIN_SLUG%%' ); ?></button>
          <button id="%%PREFIX%%-btn-theme-b" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-b"><?php esc_html_e( 'White', '%%PLUGIN_SLUG%%' ); ?></button>
          <button id="%%PREFIX%%-btn-theme-ch" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-ch"><?php esc_html_e( 'Black', '%%PLUGIN_SLUG%%' ); ?></button>
          <button id="%%PREFIX%%-btn-theme-g" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-g"><?php esc_html_e( 'Blue', '%%PLUGIN_SLUG%%' ); ?></button>
          <button id="%%PREFIX%%-btn-theme-k" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-theme-k"><?php esc_html_e( 'Brown', '%%PLUGIN_SLUG%%' ); ?></button>
        </div>
      </div>
      <div class="%%PREFIX%%-block">
        <span class="%%PREFIX%%-block-title"><?php esc_html_e( 'Font size', '%%PLUGIN_SLUG%%' ); ?></span>
        <div class="%%PREFIX%%-btn-group">
          <button id="%%PREFIX%%-btn-font-size-dec" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-default"><?php esc_html_e( '− Smaller', '%%PLUGIN_SLUG%%' ); ?></button>
          <button id="%%PREFIX%%-btn-font-size-inc" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-default"><?php esc_html_e( '+ Larger', '%%PLUGIN_SLUG%%' ); ?></button>
        </div>
      </div>
      <div class="%%PREFIX%%-block">
        <span class="%%PREFIX%%-block-title"><?php esc_html_e( 'Font', '%%PLUGIN_SLUG%%' ); ?></span>
        <div class="%%PREFIX%%-btn-group">
          <button id="%%PREFIX%%-btn-font-sans" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-sans"><?php esc_html_e( 'Sans Serif', '%%PLUGIN_SLUG%%' ); ?></button>
          <button id="%%PREFIX%%-btn-font-serif" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-serif"><?php esc_html_e( 'Serif', '%%PLUGIN_SLUG%%' ); ?></button>
        </div>
      </div>
      <div class="%%PREFIX%%-block">
        <span class="%%PREFIX%%-block-title"><?php esc_html_e( 'Letter spacing', '%%PLUGIN_SLUG%%' ); ?></span>
        <div class="%%PREFIX%%-btn-group">
          <button id="%%PREFIX%%-btn-kerning-dec" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-default"><?php esc_html_e( 'Less', '%%PLUGIN_SLUG%%' ); ?></button>
          <button id="%%PREFIX%%-btn-kerning-inc" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-tracking-widest"><?php esc_html_e( 'M o r e', '%%PLUGIN_SLUG%%' ); ?></button>
        </div>
      </div>
      <div class="%%PREFIX%%-block">
        <span class="%%PREFIX%%-block-title"><?php esc_html_e( 'Line spacing', '%%PLUGIN_SLUG%%' ); ?></span>
        <div class="%%PREFIX%%-btn-group">
          <button id="%%PREFIX%%-btn-line-height-dec" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-font-bold">///</button>
          <button id="%%PREFIX%%-btn-line-height-inc" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-font-bold">/ / /</button>
        </div>
      </div>
      <div class="%%PREFIX%%-block">
        <span class="%%PREFIX%%-block-title"><?php esc_html_e( 'Images', '%%PLUGIN_SLUG%%' ); ?></span>
        <button id="%%PREFIX%%-btn-toggle-img" type="button" class="%%PREFIX%%-btn %%PREFIX%%-btn-default %%PREFIX%%-btn-img" title="<?php echo esc_attr__( 'Toggle images', '%%PLUGIN_SLUG%%' ); ?>" aria-label="<?php echo esc_attr__( 'Toggle images', '%%PLUGIN_SLUG%%' ); ?>">
          <span class="%%PREFIX%%-img-icon" aria-hidden="true"></span>
        </button>
      </div>
    </div>
  </div>

  </div>
  <button
    id="%%PREFIX%%-top-reset-btn"
    type="button"
    class="%%PREFIX%%-reset-top-btn"
    title="<?php echo esc_attr__( 'Reset all accessibility settings', '%%PLUGIN_SLUG%%' ); ?>"
  >
    ↺ <?php esc_html_e( 'Reset View', '%%PLUGIN_SLUG%%' ); ?>
  </button>
<?php
}
add_action( 'wp_footer', '%%PREFIX%%_render_ui' );

/**
 * Register and enqueue plugin assets on frontend.
 */
function %%PREFIX%%_enqueue_assets() {
  if ( is_admin() || is_feed() ) return;

  wp_register_script(
    '%%PREFIX%%-main-script',
    plugin_dir_url( __FILE__ ) . 'assets/%%PLUGIN_SLUG%%.js',
    array(),
    '%%VERSION%%',
    true
  );

  $custom_id = get_option( '%%PREFIX%%_trigger_id', '' );
  wp_localize_script(
    '%%PREFIX%%-main-script',
    '%%PREFIX%%Config',
    array(
      'triggerId' => ! empty( $custom_id ) ? sanitize_html_class( $custom_id ) : '%%PREFIX%%-toggle-btn',
    )
  );

  wp_register_style(
    '%%PREFIX%%-main-style',
    plugin_dir_url( __FILE__ ) . 'assets/%%PLUGIN_SLUG%%.css',
    array(),
    '%%VERSION%%'
  );

  wp_enqueue_script( '%%PREFIX%%-main-script' );
  wp_enqueue_style( '%%PREFIX%%-main-style' );
}
add_action( 'wp_enqueue_scripts', '%%PREFIX%%_enqueue_assets' );