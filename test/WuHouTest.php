<?php

use houjit\yfdate\Solar;
use PHPUnit\Framework\TestCase;

/**
 * 物候测试
 * Class WuHouTest
 */
class WuHouTest extends TestCase
{

  public function test1()
  {
    $solar = Solar::fromYmd(2020, 4, 23);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('萍始生', $Yfdate->getWuHou());
  }

  public function test2()
  {
    $solar = Solar::fromYmd(2021, 1, 15);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('雉始雊', $Yfdate->getWuHou());
  }

  public function test3()
  {
    $solar = Solar::fromYmd(2017, 1, 5);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('雁北乡', $Yfdate->getWuHou());
  }

  public function test4()
  {
    $solar = Solar::fromYmd(2020, 4, 10);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('田鼠化为鴽', $Yfdate->getWuHou());
  }

  public function test5()
  {
    $solar = Solar::fromYmd(2020, 6, 11);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('鵙始鸣', $Yfdate->getWuHou());
  }

  public function test6()
  {
    $solar = Solar::fromYmd(2020, 6, 1);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('麦秋至', $Yfdate->getWuHou());
  }

  public function test7()
  {
    $solar = Solar::fromYmd(2020, 12, 8);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('鹖鴠不鸣', $Yfdate->getWuHou());
  }

  public function test8()
  {
    $solar = Solar::fromYmd(2020, 12, 11);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('鹖鴠不鸣', $Yfdate->getWuHou());
  }

  public function test9()
  {
    $solar = Solar::fromYmd(1982,12,22);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('蚯蚓结', $Yfdate->getWuHou());
  }

}
