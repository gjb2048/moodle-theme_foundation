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
 * @package    theme
 * @subpackage foundation
 * @copyright  &copy; 2018-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace theme_foundation\output;

//use html_writer;

defined('MOODLE_INTERNAL') || die();

trait core_renderer_toolbox {
    public function render_page() {
        echo $this->doctype();

        $mustache = $this->page->theme->layouts[$this->page->pagelayout]['mustache'];
        $blockshtml = $this->blocks('side-pre');
        $hasblocks = strpos($blockshtml, 'data-block=') !== false;
        $data = new \stdClass();
        $data->output = $this;
        $data->sidepreblocks = $blockshtml;
        $data->hasblocks = $hasblocks;

        echo $this->render_from_template('theme_foundation/'.$mustache, $data);
    }
}
