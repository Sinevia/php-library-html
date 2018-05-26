<?php

// ========================================================================= //
// SINEVIA PUBLIC                                        http://sinevia.com  //
// ------------------------------------------------------------------------- //
// COPYRIGHT (c) 2018 Sinevia Ltd                        All rights resrved! //
// ------------------------------------------------------------------------- //
// LICENCE: All information contained herein is, and remains, property of    //
// Sinevia Ltd at all times.  Any intellectual and technical concepts        //
// are proprietary to Sinevia Ltd and may be covered by existing patents,    //
// patents in process, and are protected by trade secret or copyright law.   //
// Dissemination or reproduction of this information is strictly forbidden   //
// unless prior written permission is obtained from Sinevia Ltd per domain.  //
//===========================================================================//

namespace Sinevia\Html;

class Table extends Element {

    public $headers = [];
    public $rows = [];

    /**
     * The constructor of this Table.
     * @construct
     */
    function __construct() {
        parent::__construct();
    }

    function setHeaders($headers) {
        $this->headers = $headers;
        return $this;
    }

    function setRows($rows) {
        $this->rows = $rows;
        return $this;
    }

    function addRow($row) {
        $this->rows[] = $row;
        return $this;
    }

    function toHtml($compressed = true, $level = 0) {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        $html = $indent . '<table' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        if (count($this->headers) > 0) {
            $html .= $indent . $tab . '<thead>' . $nl;
            $html .= $indent . $tab . $tab . '<tr>' . $nl;
            foreach ($this->headers as $index => $header) {
                $html .= $indent . $tab . $tab . $tab . '<th class="column' . ($index + 1) . '">';
                if (is_object($header) && is_subclass_of($header, "Sinevia\Html\Element")) {
                    $html .= $header->toHtml($compressed, $level + 1) . $nl;
                } else {
                    $html .= $header;
                }
                $html .= '</th>' . $nl;
            }
            $html .= $indent . $tab . $tab . '</tr>' . $nl;
            $html .= $indent . $tab . '</thead>' . $nl;
        }
        if (count($this->rows) > 0) {
            $html .= $indent . $tab . '<tbody>' . $nl;
            foreach ($this->rows as $row) {
                $html .= $indent . $tab . $tab . '<tr>' . $nl;
                foreach ($row as $cell) {
                    $html .= $indent . $tab . $tab . $tab . '<td>';
                    if (is_object($cell) && is_subclass_of($cell, "Sinevia\Html\Element")) {
                        $html .= $cell->toHtml($compressed, $level + 1) . $nl;
                    } else {
                        $html .= $cell;
                    }
                    $html .= '</td>' . $nl;
                }
                $html .= $indent . $tab . $tab . '</tr>' . $nl;
            }
            $html .= $indent . $tab . '</tbody>' . $nl;
        }
        $html .= $indent . '</table>' . $nl;
        return $html;
    }

}
