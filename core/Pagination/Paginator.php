<?php

namespace Core\Pagination;


class Paginator
{
    protected $totalItems;
    protected $itemsPerPage;
    protected $currentPage;
    protected $urlPattern;

    public function __construct(int $totalItems, int $itemsPerPage, int $currentPage, string $urlPattern)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
        $this->urlPattern = $urlPattern;
    }

    public function render(): string
    {
        $totalPages = ceil($this->totalItems / $this->itemsPerPage);

        $output = '<div class="pagination">';
        for ($page = 1; $page <= $totalPages; $page++) {
            $output .= '<a href="' . sprintf($this->urlPattern, $page) . '"';
            if ($page == $this->currentPage) {
                $output .= ' class="active"';
            }
            $output .= '>' . $page . '</a>';
        }
        $output .= '</div>';

        return $output;
    }

    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function getTotalPages(): int
    {
        return ceil($this->totalItems / $this->itemsPerPage);
    }
}
