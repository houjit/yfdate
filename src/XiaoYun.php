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
 * 小运
 * @package yfdate
 */
class XiaoYun
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
   * 是否顺推
   * @var bool
   */
  private $forward;

  /**
   * 初始化
   * @param int $index 序数
   * @param DaYun $daYun 大运
   * @param bool $forward 是否顺推
   */
  public function __construct(DaYun $daYun, $index, $forward)
  {
    $this->daYun = $daYun;
    $this->Yfdate = $daYun->getYfdate();
    $this->index = $index;
    $this->year = $daYun->getStartYear() + $index;
    $this->age = $daYun->getStartAge() + $index;
    $this->forward = $forward;
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
   * 是否顺推
   * @return bool
   */
  public function isForward()
  {
    return $this->forward;
  }

  /**
   * 获取干支
   * @return string
   */
  public function getGanZhi()
  {
    $offset = YfdateUtil::getJiaZiIndex($this->Yfdate->getTimeInGanZhi());
    $add = $this->index + 1;
    if ($this->daYun->getIndex() > 0) {
      $add += $this->daYun->getStartAge() - 1;
    }
    $offset += $this->forward ? $add : -$add;
    $size = count(YfdateUtil::$JIA_ZI);
    while ($offset < 0) {
      $offset += $size;
    }
    $offset %= $size;
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

}
