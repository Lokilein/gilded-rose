<?php


namespace App\ItemFacade;


class SulfurasItemFacade extends ItemFacade
{
    private const QUALITY = 80;
    public const SULFURAS_HAND_OF_RAGNAROS = 'Sulfuras, Hand of Ragnaros';

    protected function changeQuality(): void
    {
        $this->item->quality = self::QUALITY;
    }
}