<?php

use houjit\yfdate\Foto;
use houjit\yfdate\Yfdate;
use PHPUnit\Framework\TestCase;

class FotoTest extends TestCase
{
  public function test()
  {
    $foto = Foto::fromYfdate(Yfdate::fromYmd(2021, 10, 14));
    $this->assertEquals('二五六五年十月十四 (三元降) (四天王巡行)', $foto->toFullString());
  }

}
