<?php
/*
* Plugin Name: Minor Improvements
* Description: Lightweight package of several minor improvements for your WordPress. Why to install several plugins? You can have just this one.
* Version: 1.4
* Author: Michal Nov&aacute;k
* Author URI: https://www.novami.cz
* License: GPL3
* Text Domain: minor-improvements
*/

/* Disable direct file access */
if (!defined("ABSPATH")) {
	die();
}

/* Add action links on WP plugin overview page*/
function minor_improvements_action_links($links) {
	return array_merge(array("settings" => "<a href=\"options-general.php?page=minor-improvements-options\">".__("Settings", "minor-improvements")."</a>"), $links);
}
add_filter("plugin_action_links_".plugin_basename(__FILE__), "minor_improvements_action_links");

/* Build option page*/
function minor_improvements_options_page() {
	echo "<div class=\"wrap\">
	<h1>".__("Minor Improvements Options", "minor-improvements")."</h1>
	<form method=\"post\" action=\"options.php\">";
	settings_fields("minor_improvements_header_section");
	do_settings_sections("minor-improvements-options");
	submit_button();
	echo "</form>\n</div>";
}

/* Add menu item */
function minor_improvements_menu() {
	add_submenu_page("options-general.php", "Improvements", "Improvements", "manage_options", "minor-improvements-options", "minor_improvements_options_page");
}
add_action("admin_menu", "minor_improvements_menu");

/* Build admin options page */
function display_minor_improvements_options() {
	/* Custom header */
	add_settings_section("header_section_header", __("Custom header", "minor-improvements"), "display_minor_improvements_header_content", "minor-improvements-options");
	add_settings_field("minor_improvements_header", __("Insert custom header here", "minor-improvements"), "display_minor_improvements_header_element", "minor-improvements-options", "header_section_header");
	register_setting("minor_improvements_header_section", "minor_improvements_header");
	
	/* Google reCAPTCHA */
	add_settings_section("minor_improvements_recaptcha_header_section", __("What first?", "minor-improvements"), "display_minor_improvements_recaptcha", "minor-improvements-options");
	add_settings_field("minor_improvements_recaptcha_site_key", __("Site key", "minor-improvements"), "display_minor_improvements_recaptcha_site_key_element", "minor-improvements-options", "minor_improvements_recaptcha_header_section");
	add_settings_field("minor_improvements_recaptcha_secret_key", __("Secret key", "minor-improvements"), "display_minor_improvements_recaptcha_secret_key_element", "minor-improvements-options", "minor_improvements_recaptcha_header_section");
	register_setting("minor_improvements_header_section", "minor_improvements_recaptcha_site_key");
	register_setting("minor_improvements_header_section", "minor_improvements_recaptcha_secret_key");
	
	/* Auto Updates */
	add_settings_section("header_section_updates", "<hr/><br/><br/>".__("Auto updates", "minor-improvements"), "display_minor_improvements_updates_content", "minor-improvements-options");
	add_settings_field("minor_improvements_updates", __("Enable auto updates?", "minor-improvements"), "display_minor_improvements_updates_element", "minor-improvements-options", "header_section_updates");
	register_setting("minor_improvements_header_section", "minor_improvements_updates");
	
	/* Disable WWW from comment form */
	add_settings_section("header_section_www", "<hr/><br/><br/>".__("Disable www field", "minor-improvements"), "display_minor_improvements_www_content", "minor-improvements-options");
	add_settings_field("minor_improvements_www", __("Disable www field", "minor-improvements"), "display_minor_improvements_www_element", "minor-improvements-options", "header_section_www");
	register_setting("minor_improvements_header_section", "minor_improvements_www");
	
	/* Author Slug */
	add_settings_section("header_section_author", "<hr/><br/><br/>".__("Author slug", "minor-improvements"), "display_minor_improvements_author_content", "minor-improvements-options");
	add_settings_field("minor_improvements_author", __("Specify author slug here", "minor-improvements"), "display_minor_improvements_author_element", "minor-improvements-options", "header_section_author");
	register_setting("minor_improvements_header_section", "minor_improvements_author");
}
add_action("admin_init", "display_minor_improvements_options");

/* Custom Header */
function display_minor_improvements_header_content() {
	echo __("<p>You can set up your Google Analytics UA code for basic (no ecommerce data) tracking. Tracking code will be included into requested <head> section.</p>", "minor-improvements");
}

function display_minor_improvements_header_element() {
	echo "<textarea type=\"textarea\" name=\"minor_improvements_header\" class=\"large-text code\" id=\"minor_improvements_header\" rows=\"10\" cols=\"50\">".get_option("minor_improvements_header")."</textarea>";
}

/* Google reCAPTCHA */
function display_minor_improvements_recaptcha() {
	echo "<p>".__("You have to <a href=\"https://www.google.com/recaptcha/admin\" rel=\"external\">register your domain</a> first, get required keys from Google and save them bellow. If empty reCAPTCHA will be disabled.", "minor-improvements")."</p>";
}

function display_minor_improvements_recaptcha_site_key_element() {
	echo "<input type=\"text\" name=\"minor_improvements_recaptcha_site_key\" class=\"regular-text\" id=\"minor_improvements_recaptcha_site_key\" value=\"".get_option("minor_improvements_recaptcha_site_key")."\" />";
}

function display_minor_improvements_recaptcha_secret_key_element() {
	echo "<input type=\"text\" name=\"minor_improvements_recaptcha_secret_key\" class=\"regular-text\" id=\"minor_improvements_recaptcha_secret_key\" value=\"".get_option("minor_improvements_recaptcha_secret_key")."\" />";
}

/* Auto Updates */
function display_minor_improvements_updates_content() {
	echo __("<p>You can enable auto updates for WP core, plugins and themes. Don't check if you modified some files like themes and don't using child theme!</p>", "minor-improvements");
}

function display_minor_improvements_updates_element() {
	echo "<input type=\"checkbox\" name=\"minor_improvements_updates\" id=\"minor_improvements_updates\" value=\"1\" ".checked(1, get_option("minor_improvements_updates"), false)." />";
}

/* Disable WWW from comments */
function display_minor_improvements_www_content() {
	echo __("<p>You can disable website field from comments.</p>", "minor-improvements");
}

function display_minor_improvements_www_element() {
	echo "<input type=\"checkbox\" name=\"minor_improvements_www\" id=\"minor_improvements_www\" value=\"1\" ".checked(1, get_option("minor_improvements_www"), false)." />";
}

/* Author Slug */
function display_minor_improvements_author_content() {
	echo __("<p>You can change author slug from default \"author\". If you change it, you have to flush rewrite rules - go to WP Settings > Permalinks > Save otherwise you will get error 404!</p>", "minor-improvements");
}

function display_minor_improvements_author_element() {
	echo "<input type=\"text\" name=\"minor_improvements_author\" class=\"regular-text\" id=\"minor_improvements_author\" value=\"".get_option("minor_improvements_author")."\" />";
}

/* Set text domain for translators */
function load_language_minor_improvements_recaptcha() {
	load_plugin_textdomain("minor-improvements", false, dirname(plugin_basename(__FILE__)) . "/languages/");
}
add_action("plugins_loaded", "load_language_minor_improvements_recaptcha");

/* Show custom header */
function show_custom_header() {
	if (get_option("minor_improvements_header") != "") {
		$output = "\n".get_option("minor_improvements_header")."\n\n";
	}
	echo $output;
}
add_action("wp_head", "show_custom_header");

/* Process settings */
function minor_improvements() {
	if (get_option("minor_improvements_updates") == "1") {
		add_filter("allow_major_auto_core_updates", "__return_true");
		add_filter("auto_update_plugin", "__return_true");
		add_filter("auto_update_theme", "__return_true");
	}
	
	if (get_option("minor_improvements_www") == "1") {
		function disable_comment_url($fields) { 
			unset($fields["url"]);
			return $fields;
		}
		add_filter("comment_form_default_fields", "disable_comment_url");
	}
	
	if (get_option("minor_improvements_author") != "") {
		global $wp_rewrite;
		$author_slug = get_option("minor_improvements_author");
		$wp_rewrite->author_base = $author_slug;
	}
}
add_action("init", "minor_improvements");

function frontend_minor_improvements_recaptcha_script() {
	if ((!is_user_logged_in() && comments_open() && is_single()) || did_action("login_init")) {
		wp_register_script("minor_improvements_recaptcha", "https://www.google.com/recaptcha/api.js?hl=".get_locale());
		wp_enqueue_script("minor_improvements_recaptcha");
		wp_register_script("minor_improvements_recaptcha_check", plugin_dir_url(__FILE__)."check.js");
		wp_enqueue_script("minor_improvements_recaptcha_check");
		wp_localize_script("minor_improvements_recaptcha_check", "minor_improvements_recaptcha_trans", array("title" => __("Are you a Robot?", "minor-improvements")));
		wp_enqueue_style("style", plugin_dir_url(__FILE__)."style.css");
	}
}

function minor_improvements_recaptcha_display() {
	echo "<div class=\"g-recaptcha\" data-sitekey=\"".get_option("minor_improvements_recaptcha_site_key")."\" data-callback=\"enableBtn\"></div>";
}

function minor_improvements_recaptcha_verify($input) {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["g-recaptcha-response"])) {
			$recaptcha_response = sanitize_text_field($_POST["g-recaptcha-response"]);
			$recaptcha_secret = get_option("minor_improvements_recaptcha_secret_key");
			$response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$recaptcha_response);
			$response = json_decode($response["body"], true);
			
			if ($response["success"] == true) {
				return $input;
			} else {
				wp_die("<p><strong>".__("ERROR:", "minor-improvements")."</strong> ".__("Google reCAPTCHA verification failed.", "minor-improvements")."</p>\n\n<p><a href=".wp_get_referer().">&laquo; ".__("Back", "minor-improvements")."</a>");
				return null;
			}
		} else {
			wp_die("<p><strong>".__("ERROR:", "minor-improvements")."</strong> ".__("Google reCAPTCHA verification failed.", "minor-improvements")." ".__("Do you have JavaScript enabled?", "minor-improvements")."</p>\n\n<p><a href=".wp_get_referer().">&laquo; ".__("Back", "minor-improvements")."</a>");
			return null;
		}
	}
}

function minor_improvements_recaptcha_check() {
	if (get_option("minor_improvements_recaptcha_site_key") != "" && get_option("minor_improvements_recaptcha_secret_key") != "") {
		add_action("login_enqueue_scripts", "frontend_minor_improvements_recaptcha_script");
		add_action("wp_enqueue_scripts", "frontend_minor_improvements_recaptcha_script");
		
		if (!is_user_logged_in()) {
			add_action("comment_form_after_fields", "minor_improvements_recaptcha_display");
			add_action("preprocess_comment", "minor_improvements_recaptcha_verify");
		}
		
		add_action("login_form", "minor_improvements_recaptcha_display");
		add_action("wp_authenticate_user", "minor_improvements_recaptcha_verify");

		add_action("register_form", "minor_improvements_recaptcha_display");
		add_action("registration_errors", "minor_improvements_recaptcha_verify");		
	
		add_action("lostpassword_form", "minor_improvements_recaptcha_display");
		add_action("lostpassword_post", "minor_improvements_recaptcha_verify");
	
		add_action("resetpass_form", "minor_improvements_recaptcha_display");
		add_action("resetpass_post", "minor_improvements_recaptcha_verify");
	}
}
add_action("init", "minor_improvements_recaptcha_check");