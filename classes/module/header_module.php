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
 * @copyright  &copy; 2021-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

namespace theme_foundation\module;

defined('MOODLE_INTERNAL') || die();

use html_writer;
use moodle_url;
use theme_foundation\admin_setting_configselect;
use theme_foundation\admin_setting_configinteger;

/**
 * Header module.
 *
 * Implements the header of the theme.
 *
 * @copyright  &copy; 2021-onwards G J Barnard.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class header_module extends \theme_foundation\module_basement {

    /**
     * Add the header settings.
     *
     * @param array $settingspages The setting pages.
     * @param toolbox $toolbox The theme toolbox.
     */
    public function add_settings(&$settingspages, $toolbox) {
        // Create our own settings page.
        $settingspages['header'] = array(\theme_foundation\toolbox::SETTINGPAGE => new \admin_settingpage('theme_foundation_header',
            get_string('headerheading', 'theme_foundation')), \theme_foundation\toolbox::HASSETTINGS => true);

        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add(
            new \admin_setting_heading(
                'theme_foundation_headerheading',
                get_string('headerheadingsub', 'theme_foundation'),
                format_text(get_string('headerheadingdesc', 'theme_foundation'), FORMAT_MARKDOWN)
            )
        );

        // Header background image.
        $name = 'theme_foundation/headerbackground';
        $title = get_string('headerbackground', 'theme_foundation');
        $description = get_string('headerbackgrounddesc', 'theme_foundation');
        $setting = new \admin_setting_configstoredfile($name, $title, $description, 'headerbackground', 0,
            array('accepted_types' => array('jpg', 'png')));
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add($setting);

        // Header background style.
        $name = 'theme_foundation/headerbackgroundstyle';
        $title = get_string('headerbackgroundstyle', 'theme_foundation');
        $description = get_string('headerbackgroundstyledesc', 'theme_foundation');
        $default = 'cover';
        $setting = new admin_setting_configselect($name, $title, $description, $default,
            array(
                'contain' => get_string('stylecontain', 'theme_foundation'),
                'cover' => get_string('stylecover', 'theme_foundation'),
                'stretch' => get_string('stylestretch', 'theme_foundation')
            )
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add($setting);

        // Header background position.
        $name = 'theme_foundation/headerbackgroundposition';
        $title = get_string('headerbackgroundposition', 'theme_foundation');
        $description = get_string('headerbackgroundpositiondesc', 'theme_foundation');
        $default = 'center';
        $setting = new admin_setting_configselect($name, $title, $description, $default,
            array(
                'center' => get_string('stylecenter', 'theme_foundation'),
                'top' => get_string('styletop', 'theme_foundation'),
                'bottom' => get_string('stylebottom', 'theme_foundation'),
                'left' => get_string('styleleft', 'theme_foundation'),
                'right' => get_string('styleright', 'theme_foundation')
            )
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add($setting);

        // Header top background opacity setting.
        $name = 'theme_foundation/headerbackgroundtopopacity';
        $title = get_string('headerbackgroundtopopacity', 'theme_foundation');
        $description = get_string('headerbackgroundtopopacitydesc', 'theme_foundation');
        $default = '0.1';
        $setting = new admin_setting_configselect($name, $title, $description, $default,
            \theme_foundation\toolbox::$settingopactitychoices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add($setting);

        // Header bottom background opacity setting.
        $name = 'theme_foundation/headerbackgroundbottomopacity';
        $title = get_string('headerbackgroundbottomopacity', 'theme_foundation');
        $description = get_string('headerbackgroundbottomopacitydesc', 'theme_foundation');
        $default = '0.9';
        $setting = new admin_setting_configselect($name, $title, $description, $default,
            \theme_foundation\toolbox::$settingopactitychoices);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add($setting);

        // Header background top colour setting.
        $name = 'theme_foundation/headerbackgroundtopcolour';
        $title = get_string('headerbackgroundtopcolour', 'theme_foundation');
        $description = get_string('headerbackgroundtopcolourdesc', 'theme_foundation');
        $default = '-';
        $defaultcolour = array('colour' => '#ffaabb', 'selector' => '.pageheadingtop', 'element' => 'color');
        $setting = new \theme_foundation\admin_setting_configcolourpicker(
            $name,
            $title,
            $description,
            $default,
            $defaultcolour
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add($setting);

        // Header background bottom colour setting.
        $name = 'theme_foundation/headerbackgroundbottomcolour';
        $title = get_string('headerbackgroundbottomcolour', 'theme_foundation');
        $description = get_string('headerbackgroundbottomcolourdesc', 'theme_foundation');
        $default = '-';
        $defaultcolour = array('colour' => '#ffaabb', 'selector' => '.pageheadingbottom', 'element' => 'color');
        $setting = new \theme_foundation\admin_setting_configcolourpicker(
            $name,
            $title,
            $description,
            $default,
            $defaultcolour
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settingspages['header'][\theme_foundation\toolbox::SETTINGPAGE]->add($setting);
    }

    /**
     * Gets the module pre SCSS.
     *
     * @param string $themename The theme name the SCSS is for.
     * @param toolbox $toolbox The toolbox instance.
     *
     * @return string SCSS.
     */
    public function pre_scss($themename, $toolbox) {
        $prescss = '';

        $headerbackgroundbottomcolour = $toolbox->get_setting('headerbackgroundbottomcolour', $themename);
        if ((!empty($headerbackgroundbottomcolour)) && ($headerbackgroundbottomcolour[0] != '-')) {
            $prescss .= '$breadcrumb-divider-color: '.$headerbackgroundbottomcolour.';'.PHP_EOL;
        }

        return $prescss;
    }

    /**
     * Gets the module extra SCSS.
     *
     * @param string $themename The theme name the SCSS is for.
     * @param toolbox $toolbox The toolbox instance.
     * @return string SCSS.
     */
    public function extra_scss($themename, $toolbox) {
        $scss = '';

        $headerbackgroundurl = $toolbox->setting_file_url('headerbackground', 'headerbackground', $themename);

        if (!empty($headerbackgroundurl)) {
            $scss .= '#page-header {'.PHP_EOL;

            $scss .= 'background-image: linear-gradient(';
            $scss .= 'rgba(red($body-bg), green($body-bg), blue($body-bg), '.
                $toolbox->get_setting('headerbackgroundtopopacity', $themename).'), ';
            $scss .= 'rgba(red($body-bg), green($body-bg), blue($body-bg), '.
                $toolbox->get_setting('headerbackgroundbottomopacity', $themename).')),';
            $scss .= 'url("'.$headerbackgroundurl.'");'.PHP_EOL;
            $scss .= 'background-position: '.$toolbox->get_setting('headerbackgroundposition', $themename).';'.PHP_EOL;
            $headerbackgroundstyle = $toolbox->get_setting('headerbackgroundstyle', $themename);
            if ($headerbackgroundstyle === 'stretch') {
                $headerbackgroundstyle = '100% 100%';
            }
            $scss .= 'background-size: '.$headerbackgroundstyle.';'.PHP_EOL;
            $scss .= '.card {'.PHP_EOL;
            $scss .= 'background-color: transparent;'.PHP_EOL;
            $scss .= '}'.PHP_EOL;

            $scss .= '.breadcrumb-item a,'.PHP_EOL;
            $scss .= '.pageheadingbutton .btn {'.PHP_EOL;
            $scss .= 'color: inherit;'.PHP_EOL;
            $scss .= '}'.PHP_EOL;

            $headerbackgroundtopcolour = $toolbox->get_setting('headerbackgroundtopcolour', $themename);
            if ((!empty($headerbackgroundtopcolour)) && ($headerbackgroundtopcolour[0] != '-')) {
                $scss .= '.pageheadingtop {'.PHP_EOL;
                $scss .= 'color: '.$headerbackgroundtopcolour.';'.PHP_EOL;
                $scss .= '}'.PHP_EOL;
            }
            $headerbackgroundbottomcolour = $toolbox->get_setting('headerbackgroundbottomcolour', $themename);
            if ((!empty($headerbackgroundbottomcolour)) && ($headerbackgroundbottomcolour[0] != '-')) {
                $scss .= '.pageheadingbottom {'.PHP_EOL;
                $scss .= 'color: '.$headerbackgroundbottomcolour.';'.PHP_EOL;
                $scss .= '}'.PHP_EOL;
            }

            $scss .= '}'.PHP_EOL;
        }

        return $scss;
    }

    /**
     * Wrapper for header elements.
     *
     * @param core_renderer $output The core renderer instance.
     * @return string HTML to display the main header.
     */
    public function header($output) {
        global $PAGE, $USER;
        $header = new \stdClass();
        if (empty($PAGE->theme->layouts[$PAGE->pagelayout]['options']['nocontextheader'])) {
            $header->contextheader = $output->context_header();
        } else {
            $header->contextheader = '';
        }
        $header->hasbreadcrumb = (empty($PAGE->theme->layouts[$PAGE->pagelayout]['options']['nobreadcrumb']));
        if ($header->hasbreadcrumb) {
            if ((!empty($USER->auth)) && ($USER->auth == 'lti')) {
                $header->breadcrumb = '';
            } else {
                $header->breadcrumb = $output->navbar();
            }
        } else {
            $header->breadcrumb = '';
        }
        $header->pageheadingbutton = $output->page_heading_button();
        $header->courseheader = $output->course_header();
        $header->headeractions = $PAGE->get_header_actions();
        return $output->render_from_template('core/full_header', $header);
    }
}
