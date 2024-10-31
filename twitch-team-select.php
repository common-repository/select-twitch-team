<?php
/*
  Plugin Name: Twitch Team Select
  Description: Insert Twitch.tv Team Page in WordPress
  Version: 0.0.4
  Author: Anthony Lester
  Author URI: http://www.friendlyneighborhoodgeeks.com
  License: GPL v2

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

 */



define( 'TWITCH_TEAM_SELECT_BASE', plugin_dir_path( __FILE__ ) );
define( 'TWITCH_TEAM_SELECT_VER', '0.0.7' );
define( 'TWITCH_TEAM_SELECT_URL', plugins_url( '/' . basename( dirname( __FILE__ ) ) ) );
define( 'TWITCH_TEAM_SELECT_CLIENT_ID', 'lwqbybuqzps6racd00a4kkor0zkn6k' );
define( 'TWITCH_TEAM_SELECT_CACHE_TTL', 15 );
define( 'TWITCH_TEAM_SELECT_UPDATE_CRON_INTERVAL', 300 );

if (!defined('ABSPATH')) {
    exit;
  }

include_once(TWITCH_TEAM_SELECT_BASE . 'includes/twitch-team-select-options.php');

/**
 * Enqueue scripts and CSS for admin
 */
// add_action( 'admin_enqueue_scripts', function() {
// // wp_register_script( 'twitch_team_select_admin', TWITCH_TEAM_SELECT_URL . '/js/twitch-team-select-admin.js', array(), TWITCH_TEAM_SELECT_VER, true );
// // wp_enqueue_script( 'twitch_team_select' , TWITCH_TEAM_SELECT_URL . '/js/twitch-team-select-admin.js' , array( 'jquery' ), TWITCH_TEAM_SELECT_VER, true );
// // wp_localize_script( 'twitch_team_select', 'passBall' , $options['teamName'] );
// // wp_enqueue_style( 'twitch_team_select', TWITCH_TEAM_SELECT_URL . '/css/team-select-admin.css', false, TWITCH_TEAM_SELECT_VER );
// } );

/**
 * Enqueue scripts and CSS
 * Called by enqueue_scripts action
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {
  wp_register_script( 'twitch_team_select', TWITCH_TEAM_SELECT_URL . '/js/twitch-team-select.js', array(), TWITCH_TEAM_SELECT_VER, true );
  wp_enqueue_script( 'twitch_team_select' , TWITCH_TEAM_SELECT_URL . '/js/twitch-team-select.js' , array( 'jquery' ), TWITCH_TEAM_SELECT_VER, true );
  // wp_localize_script( 'twitch_team_select', 'passBall' , $options['teamName'] );
  wp_enqueue_style( 'twitch_team_select', TWITCH_TEAM_SELECT_URL . '/css/twitch-team-select.css', false, TWITCH_TEAM_SELECT_VER );
  // wp_enqueue_style( 'twitch_team_select_admin', TWITCH_TEAM_SELECT_URL . '/css/team-select-admin.css', false, TWITCH_TEAM_SELECT_VER );
} );



