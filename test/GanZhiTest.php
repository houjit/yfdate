<?php

use yfdate\Solar;
use PHPUnit\Framework\TestCase;

/**
 * 干支测试
 * Class GanZhiTest
 */
class GanZhiTest extends TestCase
{

  public function test1()
  {
    $solar = Solar::fromYmdHms(2020, 1, 1, 13, 22, 0);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("己亥", $Yfdate->getYearInGanZhi());
    $this->assertEquals("己亥", $Yfdate->getYearInGanZhiByLiChun());
    $this->assertEquals("己亥", $Yfdate->getYearInGanZhiExact());
  }

  public function test2()
  {
    $solar = Solar::fromYmd(2012, 12, 27);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("壬辰", $Yfdate->getYearInGanZhi());
    $this->assertEquals("壬子", $Yfdate->getMonthInGanZhi());
    $this->assertEquals("壬戌", $Yfdate->getDayInGanZhi());
  }

  public function test3()
  {
    $solar = Solar::fromYmd(2012, 12, 20);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("壬辰", $Yfdate->getYearInGanZhi());
    $this->assertEquals("壬子", $Yfdate->getMonthInGanZhi());
    $this->assertEquals("乙卯", $Yfdate->getDayInGanZhi());
  }

  public function test4()
  {
    $solar = Solar::fromYmd(2012, 11, 20);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("壬辰", $Yfdate->getYearInGanZhi());
    $this->assertEquals("辛亥", $Yfdate->getMonthInGanZhi());
    $this->assertEquals("乙酉", $Yfdate->getDayInGanZhi());
  }

  public function test15()
  {
    $solar = Solar::fromYmd(1988, 2, 15);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("丁卯", $Yfdate->getYearInGanZhi());
  }

  public function test16()
  {
    $solar = Solar::fromYmdHms(1988, 2, 15, 23, 30,0);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("丁卯", $Yfdate->getYearInGanZhi());
    $this->assertEquals("戊辰", $Yfdate->getYearInGanZhiByLiChun());
    $this->assertEquals("戊辰", $Yfdate->getYearInGanZhiExact());
  }

  public function test17()
  {
    $solar = Solar::fromYmdHms(2019, 2, 8, 13, 22, 0);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("己亥", $Yfdate->getYearInGanZhi());
    $this->assertEquals("己亥", $Yfdate->getYearInGanZhiByLiChun());
    $this->assertEquals("己亥", $Yfdate->getYearInGanZhiExact());

    $this->assertEquals("丙寅", $Yfdate->getMonthInGanZhi());
    $this->assertEquals("丙寅", $Yfdate->getMonthInGanZhiExact());
  }

  public function test18()
  {
    $solar = Solar::fromYmdHms(2020,2,4,13,22,0);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals("庚子", $Yfdate->getYearInGanZhi());
    $this->assertEquals("庚子", $Yfdate->getYearInGanZhiByLiChun());
    $this->assertEquals("己亥", $Yfdate->getYearInGanZhiExact());

    $this->assertEquals("戊寅", $Yfdate->getMonthInGanZhi());
    $this->assertEquals("丁丑", $Yfdate->getMonthInGanZhiExact());
  }

}
