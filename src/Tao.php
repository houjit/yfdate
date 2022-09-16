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

use yfdate\util\TaoUtil;
use yfdate\util\YfdateUtil;

/**
 * 道历
 * @package yfdate
 */
class Tao
{

  public static $BIRTH_YEAR = -2697;

  private $Yfdate;

  function __construct(Yfdate $Yfdate)
  {
    $this->Yfdate = $Yfdate;
  }

  public static function fromYfdate($Yfdate)
  {
    return new Tao($Yfdate);
  }

  public static function fromYmdHms($year, $month, $day, $hour, $minute, $second)
  {
    return Tao::fromYfdate(Yfdate::fromYmdHms($year + Tao::$BIRTH_YEAR, $month, $day, $hour, $minute, $second));
  }

  public static function fromYmd($year, $month, $day)
  {
    return Tao::fromYmdHms($year, $month, $day, 0, 0, 0);
  }

  public function getYfdate()
  {
    return $this->Yfdate;
  }

  public function getYear()
  {
    return $this->Yfdate->getYear() - Tao::$BIRTH_YEAR;
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
   * 获取节日
   *
   * @return TaoFestival[] 节日列表
   */
  public function getFestivals()
  {
    $l = TaoUtil::getFestivals($this->getMonth() . '-' . $this->getDay());
    $jq = $this->Yfdate->getJieQi();
    if (strcmp('冬至', $jq) === 0) {
      $l[] = new TaoFestival('元始天尊圣诞');
    } else if (strcmp('夏至', $jq) === 0) {
      $l[] = new TaoFestival('灵宝天尊圣诞');
    }
    // 八节日
    if (!empty(TaoUtil::$BA_JIE[$jq])) {
      $l[] = new TaoFestival(TaoUtil::$BA_JIE[$jq]);
    }
    // 八会日
    $gz = $this->Yfdate->getDayInGanZhi();
    if (!empty(TaoUtil::$BA_HUI[$gz])) {
      $l[] = new TaoFestival(TaoUtil::$BA_HUI[$gz]);
    }
    return $l;
  }

  private function isDayIn($days)
  {
    $md = $this->getMonth() . '-' . $this->getDay();
    foreach ($days as $d) {
      if (strcmp($md, $d) === 0) {
        return true;
      }
    }
    return false;
  }

  public function isDaySanHui()
  {
    return $this->isDayIn(TaoUtil::$SAN_HUI);
  }

  public function isDaySanYuan()
  {
    return $this->isDayIn(TaoUtil::$SAN_YUAN);
  }

  public function isDayWuLa()
  {
    return $this->isDayIn(TaoUtil::$WU_LA);
  }

  public function isDayBaJie()
  {
    return !empty(TaoUtil::$BA_JIE[$this->Yfdate->getJieQi()]);
  }

  public function isDayBaHui()
  {
    return !empty(TaoUtil::$BA_HUI[$this->Yfdate->getDayInGanZhi()]);
  }

  public function isDayMingWu()
  {
    return strcmp('戊', $this->Yfdate->getDayGan()) == 0;
  }

  public function isDayAnWu()
  {
    return strcmp($this->Yfdate->getDayZhi(), TaoUtil::$AN_WU[abs($this->getMonth()) - 1]) === 0;
  }

  public function isDayWu()
  {
    return $this->isDayMingWu() || $this->isDayAnWu();
  }

  public function isDayTianShe()
  {
    $ret = false;
    $mz = $this->Yfdate->getMonthZhi();
    $dgz = $this->Yfdate->getDayInGanZhi();
    if (strpos('寅卯辰', $mz) !== false) {
      if ('戊寅' === $dgz) {
        $ret = true;
      }
    } else if (strpos('巳午未', $mz) !== false) {
      if ('甲午' === $dgz) {
        $ret = true;
      }
    } else if (strpos('申酉戌', $mz) !== false) {
      if ('戊申' === $dgz) {
        $ret = true;
      }
    } else if (strpos('亥子丑', $mz) !== false) {
      if ('甲子' === $dgz) {
        $ret = true;
      }
    }
    return $ret;
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
    return sprintf('道歷%s年，天運%s年，%s月，%s日。%s月%s日，%s時。', $this->getYearInChinese(), $this->Yfdate->getYearInGanZhi(), $this->Yfdate->getMonthInGanZhi(), $this->Yfdate->getDayInGanZhi(), $this->getMonthInChinese(), $this->getDayInChinese(), $this->Yfdate->getTimeZhi());
  }

}
