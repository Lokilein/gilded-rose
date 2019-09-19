<?php


namespace App\ItemFacade;


class AgedBrieItemFacade extends ItemFacade
{
    public const AGED_BRIE = 'Aged Brie';

    protected function changeQuality(): void
    {
        $this->increaseQuality();
        if ($this->isOverSellDate()) {
            $this->increaseQuality();
        }
    }
}