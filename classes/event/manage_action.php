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
 * The mod_examregistrar course module viewed event.
 *
 * @package mod_examregistrar
 * @copyright 2015 onwards Enrique castro @ ULPGC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_examregistrar\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_examregistrar course module viewed event class.
 *
 * @package mod_examregistrar
 * @copyright 2015 onwards Enrique castro @ ULPGC
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class manage_action extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        $action = get_string($this->other['action'], 'examregistrar');
        $extra = '';
        if(isset($this->other['extra'])) {
            $extra = 'with '.$this->other['extra'];
        }
        return "The user with id '$this->userid' has done action '$action' $extra " .
            "in activity with cm id '$this->contextinstanceid'.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventmanageaction', 'examregistrar');
    }

    /**
     * Get URL related to the action.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url("/mod/examregistrar/manage.php", array('id' => $this->contextinstanceid, 'edit'=>$this->other['edit']));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->other['examregid'])) {
            throw new \coding_exception('The \'examregid\' value must be set in other.');
        }
    }
}


