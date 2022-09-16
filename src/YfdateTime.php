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

/**
 * 时辰
 * @package yfdate
 */
class YfdateTime
{
  /**
   * 天干下标，0-9
   * @var int
   */
  private $ganIndex;

  /**
   * 地支下标，0-11
   * @var int
   */
  private $zhiIndex;

  /**
   * 阴历
   * @var Yfdate
   */
  private $Yfdate;

  private function __construct($YfdateYear, $YfdateMonth, $YfdateDay, $hour, $minute, $second)
  {
    $this->Yfdate = Yfdate::fromYmdHms($YfdateYear, $YfdateMonth, $YfdateDay, $hour, $minute, $second);
    $this->zhiIndex = YfdateUtil::getTimeZhiIndex(sprintf('%02d:%02d', $hour, $minute));
    $this->ganIndex = ($this->Yfdate->getDayGanIndexExact() % 5 * 2 + $this->zhiIndex) % 10;
  }

  /**
   * 通过指定农历年月日时分秒获取时辰
   * @param int $YfdateYear 年（农历）
   * @param int $YfdateMonth 月（农历），1到12，闰月为负，即闰2月=-2
   * @param int $YfdateDay 日（农历），1到30
   * @param int $hour 小时（阳历）
   * @param int $minute 分钟（阳历）
   * @param int $second 秒钟（阳历）
   * @return YfdateTime
   */
  public static function fromYmdHms($YfdateYear, $YfdateMonth, $YfdateDay, $hour, $minute, $second)
  {
    return new YfdateTime($YfdateYear, $YfdateMonth, $YfdateDay, $hour, $minute, $second);
  }

  /**
   * 获取时辰生肖
   *
   * @return string 时辰生肖，如虎
   */
  public function getShengXiao()
  {
    return YfdateUtil::$SHENG_XIAO[$this->zhiIndex + 1];
  }

  /**
   * 获取时辰（地支）
   * @return string 时辰（地支）
   */
  public function getZhi()
  {
    return YfdateUtil::$ZHI[$this->zhiIndex + 1];
  }

  /**
   * 获取时辰（天干）
   * @return string 时辰（天干）
   */
  public function getGan()
  {
    return YfdateUtil::$GAN[$this->ganIndex + 1];
  }

  /**
   * 获取时辰干支（时柱）
   * @return string 时辰干支（时柱）
   */
  public function getGanZhi()
  {
    return $this->getGan() . $this->getZhi();
  }

  /**
   * 获取时辰喜神方位
   * @return string 喜神方位，如艮
   */
  public function getPositionXi()
  {
    return YfdateUtil::$POSITION_XI[$this->ganIndex + 1];
  }

  /**
   * 获取时辰喜神方位描述
   * @return string 喜神方位描述，如东北
   */
  public function getPositionXiDesc()
  {
    return YfdateUtil::$POSITION_DESC[$this->getPositionXi()];
  }

  /**
   * 获取时辰阳贵神方位
   * @return string 阳贵神方位，如艮
   */
  public function getPositionYangGui()
  {
    return YfdateUtil::$POSITION_YANG_GUI[$this->ganIndex + 1];
  }

  /**
   * 获取时辰阳贵神方位描述
   * @return string 阳贵神方位描述，如东北
   */
  public function getPositionYangGuiDesc()
  {
    return YfdateUtil::$POSITION_DESC[$this->getPositionYangGui()];
  }

  /**
   * 获取时辰阴贵神方位
   * @return string 阴贵神方位，如艮
   */
  public function getPositionYinGui()
  {
    return YfdateUtil::$POSITION_YIN_GUI[$this->ganIndex + 1];
  }

  /**
   * 获取时辰阴贵神方位描述
   * @return string 阴贵神方位描述，如东北
   */
  public function getPositionYinGuiDesc()
  {
    return YfdateUtil::$POSITION_DESC[$this->getPositionYinGui()];
  }

  /**
   * 获取时辰福神方位，默认流派2
   * @return string 福神方位，如艮
   */
  public function getPositionFu()
  {
    return $this->getPositionFuBySect(2);
  }

  /**
   * 获取时辰福神方位
   * @param int $sect 流派，可选1或2
   * @return string 福神方位，如艮
   */
  public function getPositionFuBySect($sect)
  {
    $fu = 1 == $sect ? YfdateUtil::$POSITION_FU : YfdateUtil::$POSITION_FU_2;
    return $fu[$this->ganIndex + 1];
  }

  /**
   * 获取时辰福神方位描述，默认流派2
   * @return string 福神方位描述，如东北
   */
  public function getPositionFuDesc()
  {
    return $this->getPositionFuDescBySect(2);
  }

  /**
   * 获取时辰福神方位描述
   * @param int $sect 流派，可选1或2
   * @return string 福神方位描述，如东北
   */
  public function getPositionFuDescBySect($sect)
  {
    return YfdateUtil::$POSITION_DESC[$this->getPositionFuBySect($sect)];
  }

  /**
   * 获取时辰财神方位
   * @return string 财神方位，如艮
   */
  public function getPositionCai()
  {
    return YfdateUtil::$POSITION_CAI[$this->ganIndex + 1];
  }

  /**
   * 获取时辰财神方位描述
   * @return string 财神方位描述，如东北
   */
  public function getPositionCaiDesc()
  {
    return YfdateUtil::$POSITION_DESC[$this->getPositionCai()];
  }

  /**
   * 获取时冲
   * @return string 时冲，如申
   */
  public function getChong()
  {
    return YfdateUtil::$CHONG[$this->zhiIndex];
  }

  /**
   * 获取无情之克的时冲天干
   * @return string 无情之克的时冲天干，如甲
   */
  public function getChongGan()
  {
    return YfdateUtil::$CHONG_GAN[$this->ganIndex];
  }

  /**
   * 获取有情之克的时冲天干
   * @return string 有情之克的时冲天干，如甲
   */
  public function getChongGanTie()
  {
    return YfdateUtil::$CHONG_GAN_TIE[$this->ganIndex];
  }

  /**
   * 获取时冲生肖
   * @return string 时冲生肖，如猴
   */
  public function getChongShengXiao()
  {
    $chong = $this->getChong();
    for ($i = 0, $j = count(YfdateUtil::$ZHI); $i < $j; $i++) {
      if (strcmp(YfdateUtil::$ZHI[$i], $chong) === 0) {
        return YfdateUtil::$SHENG_XIAO[$i];
      }
    }
    return '';
  }

  /**
   * 获取时冲描述
   * @return string 时冲描述，如(壬申)猴
   */
  public function getChongDesc()
  {
    return '(' . $this->getChongGan() . $this->getChong() . ')' . $this->getChongShengXiao();
  }

  /**
   * 获取时煞
   * @return string 时煞，如北
   */
  public function getSha()
  {
    return YfdateUtil::$SHA[$this->getZhi()];
  }

  /**
   * 获取时辰纳音
   * @return string 时辰纳音，如剑锋金
   */
  public function getNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getGanZhi()];
  }

  /**
   * 获取值时天神
   * @return string 值时天神
   */
  public function getTianShen()
  {
    $dayZhi = $this->Yfdate->getDayZhiExact();
    $offset = YfdateUtil::$ZHI_TIAN_SHEN_OFFSET[$dayZhi];
    return YfdateUtil::$TIAN_SHEN[($this->zhiIndex + $offset) % 12 + 1];
  }

  /**
   * 获取值时天神类型：黄道/黑道
   * @return string 值时天神类型：黄道/黑道
   */
  public function getTianShenType()
  {
    return YfdateUtil::$TIAN_SHEN_TYPE[$this->getTianShen()];
  }

  /**
   * 获取值时天神吉凶
   * @return string 吉/凶
   */
  public function getTianShenLuck()
  {
    return YfdateUtil::$TIAN_SHEN_TYPE_LUCK[$this->getTianShenType()];
  }

  /**
   * 获取时宜
   * @return string[] 宜
   */
  public function getYi()
  {
    return YfdateUtil::getTimeYi($this->Yfdate->getDayInGanZhiExact(), $this->getGanZhi());
  }

  /**
   * 获取时忌
   * @return string[] 忌
   */
  public function getJi()
  {
    return YfdateUtil::getTimeJi($this->Yfdate->getDayInGanZhiExact(), $this->getGanZhi());
  }

  /**
   * 获取值时九星（时家紫白星歌诀：三元时白最为佳，冬至阳生顺莫差，孟日七宫仲一白，季日四绿发萌芽，每把时辰起甲子，本时星耀照光华，时星移入中宫去，顺飞八方逐细查。夏至阴生逆回首，孟归三碧季加六，仲在九宫时起甲，依然掌中逆轮跨。）
   * @return NineStar 值时九星
   */
  public function getNineStar()
  {
    //顺逆
    $solarYmd = $this->Yfdate->getSolar()->toYmd();
    $jieQi = $this->Yfdate->getJieQiTable();
    $asc = false;
    if (strcmp($solarYmd, $jieQi['冬至']->toYmd()) >= 0 && strcmp($solarYmd, $jieQi['夏至']->toYmd()) < 0) {
      $asc = true;
    }
    $start = $asc ? 7 : 3;
    $dayZhi = $this->Yfdate->getDayZhi();
    if (strpos('子午卯酉', $dayZhi) !== false) {
      $start = $asc ? 1 : 9;
    } else if (strpos('辰戌丑未', $dayZhi) !== false) {
      $start = $asc ? 4 : 6;
    }
    $index = $asc ? $start + $this->zhiIndex - 1 : $start - $this->zhiIndex - 1;
    if ($index > 8) {
      $index -= 9;
    }
    if ($index < 0) {
      $index += 9;
    }
    return new NineStar($index);
  }

  public function getGanIndex()
  {
    return $this->ganIndex;
  }

  public function getZhiIndex()
  {
    return $this->zhiIndex;
  }

  /**
   * @return string
   */
  public function toString()
  {
    return $this->getGanZhi();
  }

  public function __toString()
  {
    return $this->toString();
  }

  /**
   * 获取时辰所在旬
   * @return string 旬
   */
  public function getXun()
  {
    return YfdateUtil::getXun($this->getGanZhi());
  }

  /**
   * 获取值时空亡
   * @return string 空亡(旬空)
   */
  public function getXunKong()
  {
    return YfdateUtil::getXunKong($this->getGanZhi());
  }

  public function getMinHm()
  {
    $hour = $this->Yfdate->getHour();
    if ($hour <1){
      return '00:00';
    } else if ($hour > 22) {
      return '23:00';
    }
    return sprintf('%02d:00', $hour % 2 == 0? $hour - 1 : $hour);
  }

  public function getMaxHm()
  {
    $hour = $this->Yfdate->getHour();
    if ($hour <1){
      return '00:59';
    } else if ($hour > 22) {
      return '23:59';
    }
    return sprintf('%02d:59', $hour % 2 == 0? $hour : $hour + 1);
  }

}
