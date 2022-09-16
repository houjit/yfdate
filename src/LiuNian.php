<?php
// +----------------------------------------------------------------------
// | HouCMF [ 用心做好每个站 用心服务好每个客户 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://www.houjit.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Amos <amos@houjit.com>
// +----------------------------------------------------------------------
namespace yfdate;

use yfdate\util\YfdateUtil;

bcscale(12);

/**
 * 流年
 * @package yfdate
 */
class LiuNian
{
  /**
   * 序数，0-9
   * @var int
   */
  private $index;

  /**
   * 大运
   * @var DaYun
   */
  private $daYun;

  /**
   * 年
   * @var int
   */
  private $year;

  /**
   * 年龄
   * @var int
   */
  private $age;

  /**
   * 阴历
   * @var Yfdate
   */
  private $Yfdate;

  /**
   * 初始化
   * @param int $index
   * @param DaYun $daYun
   */
  public function __construct(DaYun $daYun, $index)
  {
    $this->daYun = $daYun;
    $this->Yfdate = $daYun->getYfdate();
    $this->index = $index;
    $this->year = $daYun->getStartYear() + $index;
    $this->age = $daYun->getStartAge() + $index;
  }

  /**
   * 获取序数
   * @return int
   */
  public function getIndex()
  {
    return $this->index;
  }

  /**
   * 获取大运
   * @return DaYun
   */
  public function getDaYun()
  {
    return $this->daYun;
  }

  /**
   * 获取年
   * @return int
   */
  public function getYear()
  {
    return $this->year;
  }

  /**
   * 获取年龄
   * @return int
   */
  public function getAge()
  {
    return $this->age;
  }

  /**
   * 获取阴历
   * @return Yfdate
   */
  public function getYfdate()
  {
    return $this->Yfdate;
  }

  /**
   * 获取干支
   * @return string
   */
  public function getGanZhi()
  {
    $jieQi = $this->Yfdate->getJieQiTable();
    $offset = YfdateUtil::getJiaZiIndex($jieQi['立春']->getYfdate()->getYearInGanZhiExact()) + $this->index;
    if ($this->daYun->getIndex() > 0) {
      $offset += $this->daYun->getStartAge() - 1;
    }
    $offset %= count(YfdateUtil::$JIA_ZI);
    return YfdateUtil::$JIA_ZI[$offset];
  }

  /**
   * 获取所在旬
   * @return string 旬
   */
  public function getXun()
  {
    return YfdateUtil::getXun($this->getGanZhi());
  }

  /**
   * 获取旬空(空亡)
   * @return string 旬空(空亡)
   */
  public function getXunKong()
  {
    return YfdateUtil::getXunKong($this->getGanZhi());
  }

  /**
   * 获取流月
   * @return LiuYue[]
   */
  public function getLiuYue()
  {
    $n = 12;
    $l = array();
    for ($i = 0; $i < $n; $i++) {
      $l[] = new LiuYue($this, $i);
    }
    return $l;
  }

}
