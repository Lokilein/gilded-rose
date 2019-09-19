<?php


namespace App\ItemFacade;


final class ItemFacadeFactory
{
    public static function create($item){
        switch ($item->name){
            case AgedBrieItemFacade::AGED_BRIE:
                return new AgedBrieItemFacade($item);
            case BackstagePassItemFacade::BACKSTAGE_PASSES_TO_A_TAFKAL_80_ETC_CONCERT:
                return new BackstagePassItemFacade($item);
            case SulfurasItemFacade::SULFURAS_HAND_OF_RAGNAROS:
                return new SulfurasItemFacade($item);
            default:
                return new ItemFacade($item);
        }
    }
}