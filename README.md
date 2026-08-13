# Hosteria Accessibility

[![WordPress Plugin](https://img.shields.io/badge/WordPress-Plugin-blue.svg)](https://wordpress.org/)
[![License: GPL v2+](https://img.shields.io/badge/License-GPL%20v2%2B-orange.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![Tested up to](https://img.shields.io/badge/WordPress-7.0%20tested-brightgreen.svg)](https://wordpress.org/)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%207.4-8892BF.svg)](https://www.php.net/)

A lightweight, zero-dependency WordPress accessibility toolbar and responsive settings panel designed to improve readability and usability for visually impaired users.

---

## 🌟 Key Features

* **🎨 High-Contrast Color Schemes** — Toggle between *Normal*, *Black*, *Black on Yellow*, *Yellow on Black*, and *High Contrast* modes.
* **🔤 Flexible Typography** — Easily increase or decrease font size and switch between Serif and Sans-Serif font families.
* **↔️ Text Spacing Controls** — Adjust both letter spacing and line spacing.
* **🖼️ Media Visibility** — Hide background and inline images with a single click to reduce visual clutter and improve focus.
* **💾 Local State Persistence** — Visitor preferences are automatically saved in the browser's `localStorage` and persist across page views.
* **⚡ Zero External Dependencies** — A 100% self-contained frontend plugin with no external scripts, APIs, or tracking.
* **📱 Fully Responsive UI** — Includes a floating accessibility button and an accessible responsive drawer/modal settings panel.

---

## 🚀 Installation

### Option 1: Manual Installation via ZIP or Git

1. Download or clone this repository:

   ```bash
   git clone https://github.com/dolzhenkov/hosteria-accessibility.git
   ```

2. Move the `hosteria-accessibility` folder into your site's:

   ```text
   /wp-content/plugins/
   ```

3. Log in to your WordPress Dashboard.

4. Go to **Plugins** and click **Activate** under **Hosteria Accessibility**.

### Option 2: Upload via WordPress Admin

1. Download the ZIP archive from the [Releases](https://github.com/dolzhenkov/hosteria-accessibility/releases) page.
2. Go to **Plugins → Add New → Upload Plugin** in your WordPress dashboard.
3. Choose the `.zip` file and click **Install Now**.
4. Activate the plugin.

---

## ⚙️ How It Works

Upon activation, the plugin automatically adds a floating accessibility toggle button to the frontend.

Clicking the button opens an accessible drawer/modal panel that allows visitors to adjust their viewing preferences in real time.

### Storage

Accessibility preferences are stored in the browser's `window.localStorage` using dedicated key namespaces.

### Performance

The plugin applies accessibility styles using lightweight frontend state classes without modifying your theme files or storing visitor preferences in the WordPress database.

### Scope

The plugin runs exclusively on the public frontend and does not affect the WordPress Dashboard (`wp-admin`).

---

## 🙋 Frequently Asked Questions

### Does the plugin require any external services?

No. Hosteria Accessibility is completely self-contained and does not use external APIs, scripts, tracking services, or third-party dependencies.

### Are visitor preferences stored on the server?

No. Accessibility preferences are stored locally in the visitor's browser using `localStorage`.

### Does the plugin modify my WordPress theme?

No. The plugin works independently of the active theme and does not modify theme files.

### Does it work in the WordPress Dashboard?

No. The accessibility toolbar is intended for the public-facing website and does not affect `wp-admin`.

---

## 📄 License

This plugin is open-source software licensed under the [GNU General Public License v2.0 or later](https://www.gnu.org/licenses/gpl-2.0.html).

---

## 👨‍💻 Author

Developed by **Alexander Dolzhenkov** ([@okb3wok](https://github.com/okb3wok)).
