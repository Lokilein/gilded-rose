<?php
namespace App\ItemFacade;

use App\Item;

class ItemFacade
{
    protected const MAX_QUALITY = 50;

    protected $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function passesOneDay(): void
    {
        $this->decreaseSellIn();
        $this->changeQuality();
    }

    protected function changeQuality(): void
    {
        $this->decreaseQuality();
        if ($this->isOverSellDate()) {
            $this->decreaseQuality();
        }
    }

    protected function decreaseSellIn(): void
    {
        $this->item->sell_in--;
    }

    protected function decreaseQuality(): void
    {
        if($this->item->quality > 0)
        {
            $this->item->quality--;
        }
    }

    protected function increaseQuality(): void
    {
        if($this->item->quality < self::MAX_QUALITY)
        {
            $this->item->quality++;
        }
    }

    protected function isOverSellDate(): bool
    {
        return $this->item->sell_in < 0;
    }
}