<?php

use yfdate\Solar;
use PHPUnit\Framework\TestCase;

class JieQiTest extends TestCase
{
  public function test()
  {
    $solar = Solar::fromYmd(2021, 12, 21);
    $Yfdate = $solar->getYfdate();
    $this->assertEquals('冬至', $Yfdate->getJieQi());
  }

}
