<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Foundation theme.
 *
 * @package    theme_foundation
 * @copyright  &copy; 2018-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
if (file_exists("$CFG->dirroot/course/format/topcoll/renderer.php")) {
    include_once($CFG->dirroot."/course/format/topcoll/renderer.php");

    class theme_foundation_format_topcoll_renderer extends format_topcoll_renderer {

        /**
         * The grid row class.
         *
         * @return string CSS class.
         */
        protected function get_row_class() {
            return 'row';
        }

        /**
         * The grid column class depending on the number of columns.
         *
         * @param byte $columns Number of columns.
         * @return string CSS class.
         */
        protected function get_column_class($columns) {
            $colclasses = array(
                1 => 'col-sm-12 col-md-12 col-lg-12',
                2 => 'col-sm-6 col-md-6 col-lg-6',
                3 => 'col-md-4 col-lg-4',
                4 => 'col-lg-3');

            return $colclasses[$columns];
        }
    }
}