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

use yfdate\util\FotoUtil;
use yfdate\util\YfdateUtil;

/**
 * 佛历
 * @package yfdate
 */
class Foto
{

  public static $DEAD_YEAR = -543;

  private $Yfdate;

  function __construct(Yfdate $Yfdate)
  {
    $this->Yfdate = $Yfdate;
  }

  public static function fromYfdate($Yfdate)
  {
    return new Foto($Yfdate);
  }

  public static function fromYmdHms($year, $month, $day, $hour, $minute, $second)
  {
    return Foto::fromYfdate(Yfdate::fromYmdHms($year + Foto::$DEAD_YEAR - 1, $month, $day, $hour, $minute, $second));
  }

  public static function fromYmd($year, $month, $day)
  {
    return Foto::fromYmdHms($year, $month, $day, 0, 0, 0);
  }

  public function getYfdate()
  {
    return $this->Yfdate;
  }

  public function getYear()
  {
    $sy = $this->Yfdate->getSolar()->getYear();
    $y = $sy - Foto::$DEAD_YEAR;
    if ($sy == $this->Yfdate->getYear()) {
      $y++;
    }
    return $y;
  }

  public function getMonth()
  {
    return $this->Yfdate->getMonth();
  }

  public function getDay()
  {
    return $this->Yfdate->getDay();
  }

  public function getYearInChinese()
  {
    $y = $this->getYear() . '';
    $s = '';
    for ($i = 0, $j = strlen($y); $i < $j; $i++) {
      $s .= YfdateUtil::$NUMBER[ord(substr($y, $i, 1)) - 48];
    }
    return $s;
  }

  public function getMonthInChinese()
  {
    return $this->Yfdate->getMonthInChinese();
  }

  public function getDayInChinese()
  {
    return $this->Yfdate->getDayInChinese();
  }

  /**
   * 获取因果犯忌
   *
   * @return FotoFestival[] 因果犯忌列表
   */
  public function getFestivals()
  {
    return FotoUtil::getFestivals($this->getMonth() . '-' . $this->getDay());
  }

  public function isMonthZhai()
  {
    $m = $this->getMonth();
    return 1 == $m || 5 == $m || 9 == $m;
  }

  public function isDayYangGong()
  {
    foreach ($this->getFestivals() as $f) {
      if (strcmp('杨公忌', $f->getName()) == 0) {
        return true;
      }
    }
    return false;
  }

  public function isDayZhaiShuoWang()
  {
    $d = $this->getDay();
    return 1 == $d || 15 == $d;
  }

  public function isDayZhaiSix()
  {
    $d = $this->getDay();
    if (8 == $d || 14 == $d || 15 == $d || 23 == $d || 29 == $d || 30 == $d) {
      return true;
    } else if (28 == $d) {
      $m = YfdateMonth::fromYm($this->Yfdate->getYear(), $this->getMonth());
      return null != $m && 30 != $m->getDayCount();
    }
    return false;
  }

  public function isDayZhaiTen()
  {
    $d = $this->getDay();
    return 1 == $d || 8 == $d || 14 == $d || 15 == $d || 18 == $d || 23 == $d || 24 == $d || 28 == $d || 29 == $d || 30 == $d;
  }

  public function isDayZhaiGuanYin()
  {
    $k = $this->getMonth() . '-' . $this->getDay();
    foreach (FotoUtil::$DAY_ZHAI_GUAN_YIN as $d) {
      if (strcmp($k, $d) == 0) {
        return true;
      }
    }
    return false;
  }

  /**
   * 获取星宿
   *
   * @return string 星宿
   */
  public function getXiu()
  {
    return FotoUtil::getXiu($this->getMonth(), $this->getDay());
  }

  /**
   * 获取宿吉凶
   *
   * @return string 吉/凶
   */
  public function getXiuLuck()
  {
    return YfdateUtil::$XIU_LUCK[$this->getXiu()];
  }

  /**
   * 获取宿歌诀
   *
   * @return string 宿歌诀
   */
  public function getXiuSong()
  {
    return YfdateUtil::$XIU_SONG[$this->getXiu()];
  }

  /**
   * 获取政
   *
   * @return string 政
   */
  public function getZheng()
  {
    return YfdateUtil::$ZHENG[$this->getXiu()];
  }

  /**
   * 获取动物
   *
   * @return string 动物
   */
  public function getAnimal()
  {
    return YfdateUtil::$ANIMAL[$this->getXiu()];
  }

  /**
   * 获取宫
   *
   * @return string 宫
   */
  public function getGong()
  {
    return YfdateUtil::$GONG[$this->getXiu()];
  }

  /**
   * 获取兽
   *
   * @return string 兽
   */
  public function getShou()
  {
    return YfdateUtil::$SHOU[$this->getGong()];
  }

  public function toString()
  {
    return sprintf('%s年%s月%s', $this->getYearInChinese(), $this->getMonthInChinese(), $this->getDayInChinese());
  }

  public function __toString()
  {
    return $this->toString();
  }

  public function toFullString()
  {
    $s = $this->toString();
    foreach ($this->getFestivals() as $f) {
      $s .= ' (' . $f . ')';
    }
    return $s;
  }

}
