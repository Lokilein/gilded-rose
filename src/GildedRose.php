<?php
namespace App;

use App\ItemFacade\ItemFacadeFactory;

final class GildedRose
{
    private $items = [];

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item)
        {
            ItemFacadeFactory::create($item)->passesOneDay();
        }
    }
}
