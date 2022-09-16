<?php

use yfdate\Solar;
use PHPUnit\Framework\TestCase;

/**
 * 数九测试
 * Class ShuJiuTest
 */
class ShuJiuTest extends TestCase
{

  public function test1()
  {
    $solar = Solar::fromYmd(2020, 12, 21);
    $Yfdate = $solar->getYfdate();
    $shuJiu = $Yfdate->getShuJiu();
    $this->assertEquals('一九', $shuJiu->toString());
    $this->assertEquals('一九第1天', $shuJiu->toFullString());
  }

  public function test2()
  {
    $solar = Solar::fromYmd(2020, 12, 22);
    $Yfdate = $solar->getYfdate();
    $shuJiu = $Yfdate->getShuJiu();
    $this->assertEquals('一九', $shuJiu->toString());
    $this->assertEquals('一九第2天', $shuJiu->toFullString());
  }

  public function test3()
  {
    $solar = Solar::fromYmd(2020, 1, 7);
    $Yfdate = $solar->getYfdate();
    $shuJiu = $Yfdate->getShuJiu();
    $this->assertEquals('二九', $shuJiu->toString());
    $this->assertEquals('二九第8天', $shuJiu->toFullString());
  }

  public function test4()
  {
    $solar = Solar::fromYmd(2021, 1, 6);
    $Yfdate = $solar->getYfdate();
    $shuJiu = $Yfdate->getShuJiu();
    $this->assertEquals('二九', $shuJiu->toString());
    $this->assertEquals('二九第8天', $shuJiu->toFullString());
  }

  public function test5()
  {
    $solar = Solar::fromYmd(2021, 1, 8);
    $Yfdate = $solar->getYfdate();
    $shuJiu = $Yfdate->getShuJiu();
    $this->assertEquals('三九', $shuJiu->toString());
    $this->assertEquals('三九第1天', $shuJiu->toFullString());
  }

  public function test6()
  {
    $solar = Solar::fromYmd(2021, 3, 5);
    $Yfdate = $solar->getYfdate();
    $shuJiu = $Yfdate->getShuJiu();
    $this->assertEquals('九九', $shuJiu->toString());
    $this->assertEquals('九九第3天', $shuJiu->toFullString());
  }

  public function test7()
  {
    $solar = Solar::fromYmd(2021, 7, 5);
    $Yfdate = $solar->getYfdate();
    $shuJiu = $Yfdate->getShuJiu();
    $this->assertNull($shuJiu);
  }

}
