<?php
/**
 * DokuWiki Plugin taskstatus (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Michael Hamann <michael@content-space.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_taskstatus extends DokuWiki_Syntax_Plugin {
    var $patterns = array('NEXT', 'WAITINGFOR', 'URGENT', 'OPEN', 'DONE');
    function getType() {
        return 'substition';
    }

    function getPType() {
        return 'normal';
    }

    function getSort() {
        return 100;
    }


    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('('.join('|', $this->patterns).')',$mode,'plugin_taskstatus');
    }

    function handle($match, $state, $pos, &$handler){
        return $match;
    }

    function render($mode, &$renderer, $data) {
        if($mode != 'xhtml') return false;

        if (in_array($data, $this->patterns))
            $renderer->doc .= '<strong class="taskstatus_'.strtolower($data).'">'.$data.'</strong>';
        return true;
    }
}

// vim:ts=4:sw=4:et:enc=utf-8:
