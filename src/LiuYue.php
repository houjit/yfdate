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
 * 流月
 * @package yfdate
 */
class LiuYue
{
  /**
   * 序数，0-9
   * @var int
   */
  private $index;

  /**
   * 流年
   * @var LiuNian
   */
  private $liuNian;

  /**
   * 初始化
   * @param LiuNian $liuNian
   * @param int $index
   */
  public function __construct(LiuNian $liuNian, $index)
  {
    $this->liuNian = $liuNian;
    $this->index = $index;
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
   * 获取流年
   * @return LiuNian
   */
  public function getLiuNian()
  {
    return $this->liuNian;
  }

  /**
   * 获取中文的月
   * @return string 中文月，如正
   */
  public function getMonthInChinese()
  {
    return YfdateUtil::$MONTH[$this->index + 1];
  }

  /**
   * 获取干支
   * @return string
   */
  public function getGanZhi()
  {
    $offset = 0;
    $liuNianGanZhi = $this->liuNian->getGanZhi();
    $yearGan = substr($liuNianGanZhi, 0, strlen($liuNianGanZhi) / 2);
    if ('甲' == $yearGan || '己' == $yearGan) {
      $offset = 2;
    } else if ('乙' == $yearGan || '庚' == $yearGan) {
      $offset = 4;
    } else if ('丙' == $yearGan || '辛' == $yearGan) {
      $offset = 6;
    } else if ('丁' == $yearGan || '壬' == $yearGan) {
      $offset = 8;
    }
    $gan = YfdateUtil::$GAN[($this->index + $offset) % 10 + 1];
    $zhi = YfdateUtil::$ZHI[($this->index + YfdateUtil::$BASE_MONTH_ZHI_INDEX) % 12 + 1];
    return $gan . $zhi;
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
