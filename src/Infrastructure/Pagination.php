<?php

/*

 * PHP Pagination Class

 * @author admin@catchmyfame.com - http://www.catchmyfame.com

 * @version 2.0.0

 * @date October 18, 2011

 * @copyright (c) admin@catchmyfame.com (www.catchmyfame.com)

 * @license CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/

 */

namespace App\Infrastructure;
class Pagination
{

    public $items_per_page;

    public $items_total;

    public $current_page;

    public $num_pages;

    public $mid_range;

    public $low;

    public $limit;

    public $return;

    public $default_limit;

    public $querystring;

    public $ipp_array;

    protected $request_uri;

    public function __construct()
    {
        $explode = explode('?', $_SERVER['REQUEST_URI']);
        if ($explode) {
            $this->request_uri = $explode[0];
        }
        $this->current_page = 1;

        $this->mid_range = 7;

        $this->ipp_array = array(10, 25, 50, 100, 150, 200, 500, 1000, 'All');

        $this->items_per_page = (!empty($_GET['ipp'])) ? $_GET['ipp'] : $this->default_limit;
    }


    public function paginate(): void

    {

        if (!isset($this->default_limit)) $this->default_limit = 100;


        if (isset($_GET['ipp']) && $_GET['ipp'] === 'All') {

            $this->num_pages = 1;

        } else {

            if (!is_numeric($this->items_per_page) or $this->items_per_page <= 0) $this->items_per_page = $this->default_limit;

            $this->num_pages = ceil($this->items_total / $this->items_per_page);

        }


        $this->current_page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1; // must be numeric > 0

        $prev_page = $this->current_page - 1;

        $next_page = $this->current_page + 1;


        if ($_GET) {
            $args = explode("&", $_SERVER['QUERY_STRING']);
            foreach ($args as $arg) {
                $keyval = explode("=", $arg);
                if ($keyval[0] !== "page" && $keyval[0] !== "ipp") $this->querystring .= "&" . $arg;
            }
        }


        if ($_POST) {

            foreach ($_POST as $key => $val) {

                if ($key !== "page" && $key !== "ipp") @$this->querystring .= "&$key=$val";

            }

        }


        if ($this->num_pages > 1) {

            $this->return = ($this->current_page > 1 && $this->items_total >= 10) ? "<div class='row'><div class='col-xs'><ul class='pagination'><li class='page-item'><a class=\"page-link\" href=\"$this->request_uri?page=$prev_page&ipp=$this->items_per_page$this->querystring\"><span aria-hidden=\"true\"><i class=\"icon-arrow-circle-left\"></i></span> Prev </a></li> " : "<div class='row'><div class='col-xs '><ul class='pagination'><li class='page-item'><a href=\"javascript:;\" class=\"page-link disabled\" tabindex=\"-1\"><span aria-hidden=\"true\"><i class=\"icon-arrow-circle-left\"></i></span> Prev </a></li> ";


            $this->start_range = $this->current_page - floor($this->mid_range / 2);

            $this->end_range = $this->current_page + floor($this->mid_range / 2);


            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }


            if ($this->end_range > $this->num_pages) {

                $this->start_range -= $this->end_range - $this->num_pages;

                $this->end_range = $this->num_pages;

            }


            $this->range = range($this->start_range, $this->end_range);


            for ($i = 1; $i <= $this->num_pages; $i++) {

                //if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";

                if ($this->range[0] > 2 && $i == $this->range[0]) $this->return .= "";

                // loop through all pages. if first, last, or in range, display

                if ($i == 1 or $i == $this->num_pages or in_array($i, $this->range)) {

                    $this->return .= ($i == $this->current_page && (@$_GET['page'] != 'All')) ? "<li class='page-item active'><a title=\"Go to page $i of $this->num_pages\" class=\"page-link\" href=\"#\">$i</a></li> " : "<li class='page-item'><a class=\"page-link\" title=\"Go to page $i of $this->num_pages\" href=\"$this->request_uri?page=$i&ipp=$this->items_per_page$this->querystring\">$i</a></li> ";


                }

                //if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";

                if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 && $i == $this->range[$this->mid_range - 1]) $this->return .= "";

            }

            $this->return .= (($this->current_page < $this->num_pages && $this->items_total >= 10) && (@$_GET['page'] !== 'All') && $this->current_page > 0) ? "<li class='page-item'><a class=\"page-link\" href=\"$this->request_uri?page=$next_page&ipp=$this->items_per_page$this->querystring\"> Next <span aria-hidden=\"true\"><i class=\"icon-arrow-circle-right\"></i></span></a></li>\n" : "<li class='page-item'><a href=\"javascript:;\" class=\"page-link disabled\" href=\"javascript:;\" tabindex=\"-1\"> Next <span aria-hidden=\"true\"><i class=\"icon-arrow-circle-right\"></i></span></a></li>\n";

            $this->return .= (@$_GET['page'] === 'All') ? "<li class='page-item active'><a class=\"page-link\" hidden href=\"javascript:;\">All</a></li> \n" : "<li class='page-item'><a class=\"page-link\" hidden href=\"$this->request_uri?page=1&ipp=All$this->querystring\">All</a></li></ul></div> \n";

        } else {

            for ($i = 1; $i <= $this->num_pages; $i++) {

                $this->return .= ($i === $this->current_page) ? "<div class='row'><div class='col-xs'><ul class='pagination'><li class='page-item active'><a class=\"page-link\" href=\"#\">$i</a></li> " : "<li class='page-item'><a class=\"page-link\" href=\"$this->request_uri?page=$i&ipp=$this->items_per_page$this->querystring\">$i</a></li> ";

            }

            $this->return .= "<li class='page-item'><a class=\"page-link\" href=\"$this->request_uri?page=1&ipp=All$this->querystring\">All</a></li></ul></div> \n";

        }

        @$this->low = ($this->current_page <= 0) ? 0 : ($this->current_page - 1) * @$this->items_per_page;

        if ($this->current_page <= 0) $this->items_per_page = 0;

        $this->limit = (isset($_GET['ipp']) && $_GET['ipp'] === 'All') ? "" : " LIMIT $this->low,$this->items_per_page";

    }

    public function display_items_per_page(): string
    {
        $items = '';
        if (!isset($_GET['ipp'])) {
            $this->items_per_page = $this->default_limit;
        }
        foreach ($this->ipp_array as $ipp_opt) {
            $items .= ($ipp_opt === $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n" : "<option value=\"$ipp_opt\">$ipp_opt</option> \n";
        }
        return "<div class='col-xs ml-auto mb-xs-0 mb-3'><div class='form-row  text-right'> <div class='col-auto'> <div class='input-group bg-transparent'> <div class='input-group-prepend'><span class='input-group-text border-0' style='font-size: .79rem !important;'>Show:</span> </div> <select class=' text-muted custom-select' onchange=\"window.location='$this->request_uri?page=1&ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select> </div> </div>\n";
    }

    public function display_jump_menu(): string
    {
        $option = '';
        for ($i = 1; $i <= $this->num_pages; $i++) {
            $option .= ($i === $this->current_page) ? "<option value=\"$i\" selected>$i</option>\n" : "<option value=\"$i\">$i</option> \n";
        }
        return "<div class='col-auto'><div class='input-group'> <div class='input-group-prepend'> <span class='input-group-text bg-transparent ' style='font-size: .79rem !important;'>Page:</span> </div>  <select class=' text-muted custom-select ' onchange=\"window.location='$this->request_uri?page='+this[this.selectedIndex].value+'&ipp=$this->items_per_page$this->querystring';return false\">$option</select> </div> </div><div class='col'> <span class='input-group-text bg-transparent br-0 ' style='font-size: .79rem !important;'> <span class='text-danger text-right'>Total: " . $this->items_total . "</span> </span> </div></div></div></div>\n";
    }

    public function display_pages()
    {
        return $this->return;
    }

    public function items_per_page(): string
    {
        $items = '';
        if (!isset($_GET['ipp'])) {
            $this->items_per_page = $this->default_limit;
        }
        foreach ($this->ipp_array as $ipp_opt) {
            $items .= ($ipp_opt === $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n" : "<option value=\"$ipp_opt\">$ipp_opt</option> \n";
        }
        return "<select class='text-muted custom-select ' onchange=\"window.location='$this->request_uri?page=1&ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>";
    }
}
