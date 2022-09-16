<?php

use houjit\yfdate\Solar;
use houjit\yfdate\Yfdate;
use PHPUnit\Framework\TestCase;

/**
 * 儒略日测试
 * Class JulianDayTest
 */
class JulianDayTest extends TestCase
{

  public function test1()
  {
    $solar = Solar::fromYmd(2020, 7, 15);
    $this->assertEquals(2459045.5, $solar->getJulianDay());
  }

  public function test2()
  {
    $solar = Solar::fromJulianDay(2459045.5);
    $this->assertEquals('2020-07-15 00:00:00', $solar->toYmdHms());
  }

  public function test7()
  {
    $Yfdate = Yfdate::fromYmd(2012, 9, 1);
    $jieQi = $Yfdate->getJieQiTable();
    $this->assertEquals('2012-09-07 13:29:00', $jieQi['白露']->toYmdHms());
  }

  public function test8()
  {
    $Yfdate = Yfdate::fromYmd(2050, 12, 1);
    $jieQi = $Yfdate->getJieQiTable();
    $this->assertEquals('2050-12-07 06:41:00', $jieQi['大雪']->toYmdHms());
  }

}
