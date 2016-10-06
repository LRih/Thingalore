<?php

/**
 * Determines how many and which page buttons to show based on current page
 * and number of pages.
 */
class Paginator
{
    public $page;
    public $totalItems;
    public $itemsPerPage;


    function __construct($page, $totalItems, $itemsPerPage)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;

        $this->page = intval(min(max($page, 1), $this->pageCount())); // limit to page bounds
    }


    /**
     * First and last item on page.
     */
    function firstItem()
    {
        return ($this->page - 1) * $this->itemsPerPage;
    }

    function lastItem()
    {
        return min($this->page * $this->itemsPerPage, $this->totalItems);
    }


    /**
     * Show left/right navigate buttons.
     */
    function showLeft()
    {
        return $this->page > 1;
    }

    function showRight()
    {
        return $this->page < $this->pageCount();
    }


    function pageCount()
    {
        return max(ceil($this->totalItems / $this->itemsPerPage), 1);
    }
}

?>