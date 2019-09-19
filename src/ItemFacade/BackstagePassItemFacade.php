<?php


namespace App\ItemFacade;


class BackstagePassItemFacade extends ItemFacade
{
    const FIRST_QUALITIY_LINE = 10;
    const SECOND_QUALITY_LINE = 5;
    public const BACKSTAGE_PASSES_TO_A_TAFKAL_80_ETC_CONCERT = 'Backstage passes to a TAFKAL80ETC concert';

    protected function changeQuality(): void
    {
        if($this->isOverSellDate()){
            $this->resetItem();
        }else{
            $this->increaseQuality();
            $this->handleFirstQualityLine();
            $this->handleSecondQualityLine();
        }
    }

    /**
     * @return int
     */
    private function resetItem(): int
    {
        return $this->item->quality = 0;
    }

    protected function handleFirstQualityLine(): void
    {
        if ($this->item->sell_in < self::FIRST_QUALITIY_LINE) {
            $this->increaseQuality();
        }
    }

    protected function handleSecondQualityLine(): void
    {
        if ($this->item->sell_in < self::SECOND_QUALITY_LINE) {
            $this->increaseQuality();
        }
    }
}