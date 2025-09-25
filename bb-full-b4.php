<?php
/*
 * Plugin Name: BB Full B4
 * Plugin URI: https://github.com/luisdelcid/bb-full-b4
 * Description: Full Bootstrap 4 - Beaver Builder Theme.
 * Version: 2025.9.25
 * Requires at least: 5.6
 * Requires PHP: 5.6
 * Author: Luis del Cid
 * Author URI: https://github.com/luisdelcid
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bb-full-b4
 * Update URI: https://github.com/luisdelcid/bb-full-b4
 */

/*
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

// Make sure we don't expose any info if called directly.
defined('ABSPATH') || die('Hi there! I\'m just a plugin, not much I can do when called directly.');

// Define constants.
define('BB_FULL_B4__PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BB_FULL_B4__VERSION', '2025.9.25');

// Load classes.
require_once(BB_FULL_B4__PLUGIN_DIR . 'classes/class-bb-full-b4.php');
