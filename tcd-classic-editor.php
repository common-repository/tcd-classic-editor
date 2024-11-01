<?php
/**
 * Plugin Name: TCD Classic Editor
 * Plugin URI:
 * Description: This is a classic editor extension plug-in for TCD users. It is currently offered as a beta board.
 * Version: 1.0
 * Author: TCD
 * Author URI: https://tcd-theme.com/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: tcd-classic-editor
 * Domain Path: /languages
 */


/**
 * NOTE: 説明文
 * NOTE: 言語ファイルを公式ディレクトリから読み込む
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

__( 'This is a classic editor extension plug-in for TCD users. It is currently offered as a beta board.', 'tcd-classic-editor' );

// Plugin Path
if ( ! defined( 'TCDCE_PATH' ) ) {
	define(
		'TCDCE_PATH',
		plugin_dir_path( __FILE__ )
	);
}

// Plugin Url
if ( ! defined( 'TCDCE_URL' ) ) {
	define(
		'TCDCE_URL',
		plugins_url( '/', __FILE__ )
	);
}

// Plugin Ver
if ( ! defined( 'TCDCE_VER' ) ) {
	define(
		'TCDCE_VER',
		current( get_file_data( __FILE__ , array( 'Version' ), 'plugin' ) )
	);
}

// Plugin base name
if ( ! defined( 'TCDCE_BASE_NAME' ) ) {
	define(
		'TCDCE_BASE_NAME',
		plugin_basename( __FILE__ )
	);
}

// load textdomain
// TODO: 日本語ファイルはプラグインから読み込む、それ意外は公式ディレクトリから読み込む
load_textdomain(
	'tcd-classic-editor',
	TCDCE_PATH . 'languages/' . get_locale() . '.mo'
);

// helper
require_once TCDCE_PATH . 'helper.php';

// 管理画面用アイコン
require_once TCDCE_PATH . 'assets/admin-icons.php';

// classes
require_once TCDCE_PATH . 'classes/class-tcdce-qt-fields.php';
require_once TCDCE_PATH . 'classes/class-tcdce-admin-menu.php';
require_once TCDCE_PATH . 'classes/class-tcdce-editor.php';
require_once TCDCE_PATH . 'classes/class-tcdce-toc.php';

// classic editor切り替え機能（setup_themeで実行）
if ( ! class_exists( 'Classic_Editor' ) ) {
	require_once TCDCE_PATH . 'classes/class-tcdce-support.php';
}

// setting

// Start Guide
require_once TCDCE_PATH . 'setting/start-guide.php';

// Quicltag
require_once TCDCE_PATH . 'setting/quicktag.php';
require_once TCDCE_PATH . 'setting/quicktag/heading.php';
require_once TCDCE_PATH . 'setting/quicktag/ul.php';
require_once TCDCE_PATH . 'setting/quicktag/ol.php';
require_once TCDCE_PATH . 'setting/quicktag/box.php';
require_once TCDCE_PATH . 'setting/quicktag/marker.php';
require_once TCDCE_PATH . 'setting/quicktag/button.php';
require_once TCDCE_PATH . 'setting/quicktag/sb.php';
require_once TCDCE_PATH . 'setting/quicktag/cardlink.php';
require_once TCDCE_PATH . 'setting/quicktag/gmap.php';
require_once TCDCE_PATH . 'setting/quicktag/custom_tag.php';

// Google Maps
require_once TCDCE_PATH . 'setting/google-maps.php';

// Table of contents
require_once TCDCE_PATH . 'setting/table-of-contents.php';

// 管理画面メニューの初期化
add_action( 'admin_menu', array( new TCDCE_Admin_Menu, 'init_menu' ) );

// 管理画面メニュー設定の初期化
add_action( 'init', array( new TCDCE_Admin_Menu, 'init_setting' ) );

// tcd theme support
require_once TCDCE_PATH . 'theme-support/tcd.php';