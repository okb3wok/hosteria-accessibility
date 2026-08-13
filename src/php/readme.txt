=== %%PLUGIN_NAME%% ===
Contributors: dolzhenkov
Tags: accessibility, a11y, visually impaired, accessibility toolbar, accessible design
Requires at least: 5.8
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: %%VERSION%%
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Lightweight accessibility toolbar allowing visually impaired users to adjust colors, fonts, text spacing, and image visibility.

== Description ==

**%%PLUGIN_NAME%%** is a lightweight and user-friendly WordPress plugin that adds a floating accessibility button and a responsive settings panel to your website.

The plugin allows visitors to customize the appearance and readability of website content according to their individual needs.

Available options include:

- **Color Schemes:** Normal, Black, Black on Yellow, Yellow on Black, and High Contrast.
- **Font Size:** Quickly increase or decrease the font size.
- **Font:** Switch between sans-serif and serif fonts.
- **Letter Spacing:** Increase or decrease the spacing between letters.
- **Line Spacing:** Adjust the spacing between lines of text.
- **Images:** Quickly show or hide images and other visual content.

All selected settings are automatically saved in the visitor's browser using `localStorage` and remain active when navigating between pages.

The plugin works on the frontend and does not modify the WordPress administration area.

== Features ==

* Lightweight and easy to use.
* Floating accessibility toggle button.
* Responsive accessibility settings panel.
* Multiple high-contrast color schemes.
* Adjustable font size.
* Serif and sans-serif font options.
* Adjustable letter spacing.
* Adjustable line spacing.
* Ability to show or hide images.
* Settings persist between page views using browser `localStorage`.
* No external services or third-party APIs required.
* Designed to work with most WordPress themes without additional configuration.

== Installation ==

1. Upload the `%%PLUGIN_NAME%%` plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in the WordPress administration area.
3. The accessibility toggle button will automatically appear on the frontend of your website.
4. Click the accessibility button to open the settings panel.

== Frequently Asked Questions ==

= Do settings persist after page reload? =

Yes. All user preferences are saved in the browser's `localStorage` and are automatically restored when the visitor returns to the website.

= Does the plugin require additional theme configuration? =

No. The plugin applies its accessibility styles automatically and is designed to work with most WordPress themes without requiring additional CSS configuration.

= Does the plugin work with any WordPress theme? =

The plugin is designed to work with most WordPress themes. However, highly customized themes or themes with complex JavaScript-driven interfaces may require additional styling adjustments.

= Does the plugin modify the website content? =

No. The plugin only changes how the existing content is displayed to the visitor. It does not modify or permanently alter posts, pages, media files, or other WordPress content.

= Does the plugin use external services? =

No. The plugin works entirely on the website and does not require external services, APIs, or third-party platforms.

= Are accessibility settings stored on the server? =

No. Settings are stored locally in the visitor's browser using `localStorage`. No user accessibility preferences are sent to the server by the plugin.

== Changelog ==

= 1.0 =
* Initial official release.