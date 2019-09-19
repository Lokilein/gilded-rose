<?php

namespace test;

use App\Item;
use PHPUnit\Framework\TestCase;
use App\GildedRose;

class GildedRoseTest extends TestCase
{
    /*
     * All items have a Quality value which denotes how valuable the item is.
     * At the end of each day our system lowers both values for every item
     */
    public function testNormalItemLowersQualityByOne_WhenSellInIsPositive(): void
    {
        $normalItem = new Item('Nothing special', 10, 1);
        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $normalItem->quality);
        $this->assertEquals('Nothing special, 9, 0', $normalItem->__toString());
    }

    /*
     * All items have a SellIn value which denotes the number of days we have to sell the item.
     * At the end of each day our system lowers both values for every item
     */
    public function testNormalItemLowersSellInByOne_WhenSellInIsPositive(): void
    {
        $normalItem = new Item('Nothing special', 10, 1);
        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertEquals(9, $normalItem->sell_in);
    }

    /**
     * Once the sell by date has passed, Quality degrades twice as fast
     */
    public function testNormalItemLowersQualityByTwo_WhenSellInIsNegative(): void
    {
        $normalItem = new Item('Nothing special', -1, 10);
        $gildedRose = new GildedRose([$normalItem]);
        $gildedRose->updateQuality();

        $this->assertEquals(8, $normalItem->quality);
    }

    /**
     * The Quality of an item is never negative
     */
    public function testNormalItemLowersQuality_WithoutGettingNegative(): void
    {
        $normalItem = new Item('Nothing special', 10, 1);
        $normalOldItem = new Item('Nothing special at all', -10, 0);
        $gildedRose = new GildedRose([$normalItem, $normalOldItem]);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $normalItem->quality);
        $this->assertEquals(0, $normalOldItem->quality);
    }

    /**
     * “Aged Brie” actually increases in Quality the older it gets.
     * The Quality of an item is never more than 50
     */
    public function testAgedBrieQuality_neverHigherThan50() : void
    {
        $agedBrie = new Item('Aged Brie', -10, 40);
        $agedBrie2 = new Item('Aged Brie', 10, 49);
        $agedBrie3 = new Item('Aged Brie', 10, 50);
        $gildedRose = new GildedRose([$agedBrie, $agedBrie2, $agedBrie3]);
        $gildedRose->updateQuality();

        $this->assertEquals(42, $agedBrie->quality);
        $this->assertEquals(50, $agedBrie2->quality);
        $this->assertEquals(50, $agedBrie3->quality);
    }

    public function testHandOfRagnaros_neverLowersQuality() : void
    {
        $hoR = new Item('Sulfuras, Hand of Ragnaros', -10, 80);
        $hoR2 = new Item('Sulfuras, Hand of Ragnaros', 1, 80);
        $hoR3 = new Item('Sulfuras, Hand of Ragnaros', 0, 80);
        $gildedRose = new GildedRose([$hoR, $hoR2, $hoR3]);
        $gildedRose->updateQuality();

        $this->assertEquals(80, $hoR->quality);
        $this->assertEquals(80, $hoR2->quality);
        $this->assertEquals(80, $hoR3->quality);
    }

    public function testIncreasingQualityOfBackstagePasses_atAnyState() : void {
        $pass = new Item('Backstage passes to a TAFKAL80ETC concert', 11, 25);
        $pass2 = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 25);
        $pass3 = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 25);
        $pass4 = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 25);
        $gildedRose = new GildedRose([$pass, $pass2, $pass3, $pass4]);
        $gildedRose->updateQuality();

        $this->assertEquals(26, $pass->quality);
        $this->assertEquals(27, $pass2->quality);
        $this->assertEquals(28, $pass3->quality);
        $this->assertEquals(0, $pass4->quality);
    }
}
