<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PageHeader extends Component
{
    public string $title;
    public ?string $subtitle;
    public ?string $actionUrl;
    public ?string $actionLabel;
    public bool $showAction;
    public ?string $searchRoute;
    public ?string $searchPlaceholder;
    public bool $showSearch;
    public ?array $filters;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title,
        ?string $subtitle = null,
        ?string $actionUrl = null,
        ?string $actionLabel = null,
        bool $showAction = false,
        ?string $searchRoute = null,
        ?string $searchPlaceholder = 'Search...',
        bool $showSearch = false,
        ?array $filters = null
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->actionUrl = $actionUrl;
        $this->actionLabel = $actionLabel;
        $this->showAction = $showAction;
        $this->searchRoute = $searchRoute;
        $this->searchPlaceholder = $searchPlaceholder;
        $this->showSearch = $showSearch;
        $this->filters = $filters;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.page-header');
    }
}
