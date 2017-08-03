=== Minor Improvements ===
Contributors: Minor
Tags: recaptcha, spam, captcha, bots, brute-force, protect, comments, secure, google, analytics, updates, auto, slug, author, custom, css, disable, www, form, header, theme, plugin, login
Requires at least: 4.2.0
Tested up to: 4.7.2
Stable tag: 1.4
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Lightweight package of several minor improvements for your WordPress. Why to install several plugins? You can have just this one.

== Description ==
Protect your WordPress against spam comments and brute-force attacks (login, registration, comments, new password) thanks to Google reCAPTCHA, add custom header like tracking code (Google Analytics) or custom css, change author slug, activate auto updates for theme, plugins and WordPress core + possibility to disable www field in the comment form.

== Installation ==
1. Upload the plugin files to the "/wp-content/plugins/minor-imporvements" directory, or install the plugin through the WordPress plugins screen directly.

2. Activate the plugin through the "Plugins" screen in WordPress.

3. Use the Settings => Improvements screen to configure the plugin.

== Frequently Asked Questions ==
= Why to install this plugin? =
No ads and any other needless changes in the WordPress core. I'm using this plugin on my several commercial websites. You are NOT my tester! :-)

= How to disable this plugin? =
Just use standard Plugin overview page in WordPress admin section and deactivate it or rename plugin folder /wp-content/plugins/minor-improvements over FTP access.

== Screenshots ==
1. Options page - Custom header
2. Options page - Google reCAPTCHA
3. Options page - Auto updates
4. Options page - Disable www field from comments
5. Options page - Change author slug

== Changelog ==
= 1.4 =
* Bugfix: No more unnecessary loading reCAPTCHA on the other pages
* Bugfix: No more reCAPTCHA window over Clef waves (if you are using Clef plugin) on the login page

= 1.3 =
* Warning: reCAPTCHA verification on the Add new comment form for logged in users has been removed
* New: Language settings of reCAPTCHA is based on WordPress locale now
* New: Default WordPress submit buttons are disabled until reCAPTCHA isn't solved
* New: Added reCAPTCHA for Resset password form
* Bugfix: reCAPTCHA verification just on the standard WordPress pages (unmodified by plugins/templates)

= 1.2 =
* Bugfix: reCAPCTHA will be required only If the form has been submitted

= 1.1 =
* Bugfix: If you forget to disable some previous reCAPTCHA plugin
* Update: Screenshots updated

= 1.0 =
* New: Initial release!