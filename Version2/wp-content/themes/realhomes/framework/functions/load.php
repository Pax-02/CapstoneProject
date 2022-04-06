<?php
/**
 * This file loads other files containing various functions used in this theme
 *
 * @package RH
 */

// Basic functions.
require_once INSPIRY_FRAMEWORK . 'functions/basic.php';

// Theme Registration.
require_once INSPIRY_FRAMEWORK . 'functions/theme-registration.php';

// Header functions.
require_once INSPIRY_FRAMEWORK . 'functions/header.php';

// Contains Enqueue and Render functions related to Google Map
require_once INSPIRY_FRAMEWORK . 'functions/google-map.php';

// Contains Enqueue and Render functions related to Open Street Map
require_once INSPIRY_FRAMEWORK . 'functions/open-street-map.php';

// Load required styles and scripts
require_once INSPIRY_FRAMEWORK . 'functions/design-variations-handler.php';

// Pagination functions.
require_once INSPIRY_FRAMEWORK . 'functions/pagination.php';

// Price functions.
require_once INSPIRY_FRAMEWORK . 'functions/price.php';

// Real Estate functions.
require_once INSPIRY_FRAMEWORK . 'functions/real-estate.php';

// Real Estate Search Functions.
require_once INSPIRY_FRAMEWORK . 'functions/real-estate-search.php';

// Home related functions.
require_once INSPIRY_FRAMEWORK . 'functions/home.php';

// Contact related functions.
require_once INSPIRY_FRAMEWORK . 'functions/contact.php';

// Breadcrumbs functions.
require_once INSPIRY_FRAMEWORK . 'functions/breadcrumbs.php';

// Users / Members related functions.
require_once INSPIRY_FRAMEWORK . 'functions/member.php';

// Property submit and edit.
require_once INSPIRY_FRAMEWORK . 'functions/submit-edit.php';

// Favorites functions.
require_once INSPIRY_FRAMEWORK . 'functions/favorites.php';

// My properties functions.
require_once INSPIRY_FRAMEWORK . 'functions/my-properties.php';

// Property submit handler.
require_once INSPIRY_FRAMEWORK . 'functions/property-submit-handler.php';

// User profile.
require_once INSPIRY_FRAMEWORK . 'functions/user-profile.php';

// Edit profile handler.
require_once INSPIRY_FRAMEWORK . 'functions/edit-profile-handler.php';

// Theme's custom comment.
require_once INSPIRY_FRAMEWORK . 'functions/theme-comment.php';

// Compare functions.
require_once INSPIRY_FRAMEWORK . 'functions/compare.php';

// Compare functions.
require_once INSPIRY_FRAMEWORK . 'functions/property-custom-fields.php';

// If inspiry-memberships plugin is active then include this file.
if ( class_exists( 'IMS_Functions' ) ) {
	// Memberships functions.
	require_once INSPIRY_FRAMEWORK . 'functions/membership.php';
}

// Property Rating functions.
require_once INSPIRY_FRAMEWORK . 'functions/property-ratings.php';

// If realhomes-vacation-rentals plugin is activated and enabled from its settings
if ( inspiry_is_rvr_enabled() ) {
	// Realhomes Vacation Rentals Search Functions.
	require_once INSPIRY_FRAMEWORK . 'functions/rvr-search.php';
}

// Theme update functions.
if ( inspiry_is_realhomes_registered() ) {
	require_once INSPIRY_FRAMEWORK . 'functions/theme-update.php';
}