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
 * 八字
 * @package yfdate
 */
class EightChar
{

  /**
   * 流派
   * @var int
   */
  private $sect = 2;

  /**
   * 阴历
   * @var Yfdate
   */
  private $Yfdate;

  private static $CHANG_SHENG_OFFSET = array(
    '甲' => 1,
    '丙' => 10,
    '戊' => 10,
    '庚' => 7,
    '壬' => 4,
    '乙' => 6,
    '丁' => 9,
    '己' => 9,
    '辛' => 0,
    '癸' => 3
  );

  /**
   * 月支，按正月起寅排列
   * @var array
   */
  public static $MONTH_ZHI = array('', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', '亥', '子', '丑');

  /**
   * 长生十二神
   * @var array
   */
  public static $CHANG_SHENG = array('长生', '沐浴', '冠带', '临官', '帝旺', '衰', '病', '死', '墓', '绝', '胎', '养');

  function __construct($Yfdate)
  {
    $this->Yfdate = $Yfdate;
  }

  public static function fromYfdate($Yfdate)
  {
    return new EightChar($Yfdate);
  }

  public function toString()
  {
    return $this->getYear() . ' ' . $this->getMonth() . ' ' . $this->getDay() . ' ' . $this->getTime();
  }

  public function __toString()
  {
    return $this->toString();
  }

  /**
   * 获取流派
   * @return int 流派，2晚子时日柱按当天，1晚子时日柱按明天
   */
  public function getSect()
  {
    return $this->sect;
  }

  /**
   * 设置流派
   * @param int $sect 流派，2晚子时日柱按当天，1晚子时日柱按明天
   */
  public function setSect($sect)
  {
    $this->sect = (1 == $sect) ? 1 : 2;
  }

  /**
   * 获取阴历对象
   * @return Yfdate 阴历对象
   */
  public function getYfdate()
  {
    return $this->Yfdate;
  }

  /**
   * 获取年柱
   * @return string 年柱
   */
  public function getYear()
  {
    return $this->Yfdate->getYearInGanZhiExact();
  }

  /**
   * 获取年干
   * @return string 天干
   */
  public function getYearGan()
  {
    return $this->Yfdate->getYearGanExact();
  }

  /**
   * 获取年支
   * @return string 地支
   */
  public function getYearZhi()
  {
    return $this->Yfdate->getYearZhiExact();
  }

  /**
   * 获取年柱地支藏干，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 天干
   */
  public function getYearHideGan()
  {
    return YfdateUtil::$ZHI_HIDE_GAN[$this->getYearZhi()];
  }

  /**
   * 获取年柱五行
   * @return string 五行
   */
  public function getYearWuXing()
  {
    return YfdateUtil::$WU_XING_GAN[$this->getYearGan()] . YfdateUtil::$WU_XING_ZHI[$this->getYearZhi()];
  }

  /**
   * 获取年柱纳音
   * @return string 纳音
   */
  public function getYearNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getYear()];
  }

  /**
   * 获取年柱天干十神
   * @return string 十神
   */
  public function getYearShiShenGan()
  {
    return YfdateUtil::$SHI_SHEN_GAN[$this->getDayGan() . $this->getYearGan()];
  }

  /**
   * 获取十神地支
   * @param $zhi string 地支
   * @return string[]
   */
  private function getShiShenZhi($zhi)
  {
    $hideGan = YfdateUtil::$ZHI_HIDE_GAN[$zhi];
    $l = array();
    foreach ($hideGan as $gan) {
      $l[] = YfdateUtil::$SHI_SHEN_ZHI[$this->getDayGan() . $zhi . $gan];
    }
    return $l;
  }

  /**
   * 获取年柱地支十神，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 十神
   */
  public function getYearShiShenZhi()
  {
    return $this->getShiShenZhi($this->getYearZhi());
  }

  private function getDiShi($zhiIndex)
  {
    $offset = EightChar::$CHANG_SHENG_OFFSET[$this->getDayGan()];
    $index = $offset + ($this->getDayGanIndex() % 2 == 0 ? $zhiIndex : 0 - $zhiIndex);
    if ($index >= 12) {
      $index -= 12;
    }
    if ($index < 0) {
      $index += 12;
    }
    return EightChar::$CHANG_SHENG[$index];
  }

  /**
   * 获取年柱地势（长生十二神）
   * @return string 地势
   */
  public function getYearDiShi()
  {
    return $this->getDiShi($this->Yfdate->getYearZhiIndexExact());
  }

  /**
   * 获取月柱
   * @return string 月柱
   */
  public function getMonth()
  {
    return $this->Yfdate->getMonthInGanZhiExact();
  }

  /**
   * 获取月干
   * @return string 天干
   */
  public function getMonthGan()
  {
    return $this->Yfdate->getMonthGanExact();
  }

  /**
   * 获取月支
   * @return string 地支
   */
  public function getMonthZhi()
  {
    return $this->Yfdate->getMonthZhiExact();
  }

  /**
   * 获取月柱地支藏干，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 天干
   */
  public function getMonthHideGan()
  {
    return YfdateUtil::$ZHI_HIDE_GAN[$this->getMonthZhi()];
  }

  /**
   * 获取月柱五行
   * @return string 五行
   */
  public function getMonthWuXing()
  {
    return YfdateUtil::$WU_XING_GAN[$this->getMonthGan()] . YfdateUtil::$WU_XING_ZHI[$this->getMonthZhi()];
  }

  /**
   * 获取月柱纳音
   * @return string 纳音
   */
  public function getMonthNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getMonth()];
  }

  /**
   * 获取月柱天干十神
   * @return string 十神
   */
  public function getMonthShiShenGan()
  {
    return YfdateUtil::$SHI_SHEN_GAN[$this->getDayGan() . $this->getMonthGan()];
  }

  /**
   * 获取月柱地支十神，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 十神
   */
  public function getMonthShiShenZhi()
  {
    return $this->getShiShenZhi($this->getMonthZhi());
  }

  /**
   * 获取月柱地势（长生十二神）
   * @return string 地势
   */
  public function getMonthDiShi()
  {
    return $this->getDiShi($this->Yfdate->getMonthZhiIndexExact());
  }

  /**
   * 获取日柱
   * @return string 日柱
   */
  public function getDay()
  {
    return (2 == $this->sect) ? $this->Yfdate->getDayInGanZhiExact2() : $this->Yfdate->getDayInGanZhiExact();
  }

  /**
   * 获取日干
   * @return string 天干
   */
  public function getDayGan()
  {
    return (2 == $this->sect) ? $this->Yfdate->getDayGanExact2() : $this->Yfdate->getDayGanExact();
  }

  /**
   * 获取日支
   * @return string 地支
   */
  public function getDayZhi()
  {
    return (2 == $this->sect) ? $this->Yfdate->getDayZhiExact2() : $this->Yfdate->getDayZhiExact();
  }

  /**
   * 获取日柱地支藏干，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 天干
   */
  public function getDayHideGan()
  {
    return YfdateUtil::$ZHI_HIDE_GAN[$this->getDayZhi()];
  }

  /**
   * 获取日柱五行
   * @return string 五行
   */
  public function getDayWuXing()
  {
    return YfdateUtil::$WU_XING_GAN[$this->getDayGan()] . YfdateUtil::$WU_XING_ZHI[$this->getDayZhi()];
  }

  /**
   * 获取日柱纳音
   * @return string 纳音
   */
  public function getDayNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getDay()];
  }

  /**
   * 获取日柱天干十神，也称日元、日干
   * @return string 十神
   */
  public function getDayShiShenGan()
  {
    return '日主';
  }

  /**
   * 获取日柱地支十神，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 十神
   */
  public function getDayShiShenZhi()
  {
    return $this->getShiShenZhi($this->getDayZhi());
  }

  /**
   * 获取日柱天干序号
   * @return int 日柱天干序号，0-9
   */
  public function getDayGanIndex()
  {
    return (2 == $this->sect) ? $this->Yfdate->getDayGanIndexExact2() : $this->Yfdate->getDayGanIndexExact();
  }

  /**
   * 获取日柱地支序号
   * @return int 日柱地支序号，0-11
   */
  public function getDayZhiIndex()
  {
    return (2 == $this->sect) ? $this->Yfdate->getDayZhiIndexExact2() : $this->Yfdate->getDayZhiIndexExact();
  }

  /**
   * 获取日柱地势（长生十二神）
   * @return string 地势
   */
  public function getDayDiShi()
  {
    return $this->getDiShi($this->getDayZhiIndex());
  }

  /**
   * 获取时柱
   * @return string 时柱
   */
  public function getTime()
  {
    return $this->Yfdate->getTimeInGanZhi();
  }

  /**
   * 获取时干
   * @return string 天干
   */
  public function getTimeGan()
  {
    return $this->Yfdate->getTimeGan();
  }

  /**
   * 获取时支
   * @return string 地支
   */
  public function getTimeZhi()
  {
    return $this->Yfdate->getTimeZhi();
  }

  /**
   * 获取时柱地支藏干，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 天干
   */
  public function getTimeHideGan()
  {
    return YfdateUtil::$ZHI_HIDE_GAN[$this->getTimeZhi()];
  }

  /**
   * 获取时柱五行
   * @return string 五行
   */
  public function getTimeWuXing()
  {
    return YfdateUtil::$WU_XING_GAN[$this->Yfdate->getTimeGan()] . YfdateUtil::$WU_XING_ZHI[$this->Yfdate->getTimeZhi()];
  }

  /**
   * 获取时柱纳音
   * @return string 纳音
   */
  public function getTimeNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getTime()];
  }

  /**
   * 获取时柱天干十神
   * @return string 十神
   */
  public function getTimeShiShenGan()
  {
    return YfdateUtil::$SHI_SHEN_GAN[$this->getDayGan() . $this->getTimeGan()];
  }

  /**
   * 获取时柱地支十神，由于藏干分主气、余气、杂气，所以返回结果可能为1到3个元素
   * @return string[] 十神
   */
  public function getTimeShiShenZhi()
  {
    return $this->getShiShenZhi($this->getTimeZhi());
  }

  /**
   * 获取时柱地势（长生十二神）
   * @return string 地势
   */
  public function getTimeDiShi()
  {
    return $this->getDiShi($this->Yfdate->getTimeZhiIndex());
  }

  /**
   * 获取胎元
   * @return string 胎元
   */
  public function getTaiYuan()
  {
    $ganIndex = $this->Yfdate->getMonthGanIndexExact() + 1;
    if ($ganIndex >= 10) {
      $ganIndex -= 10;
    }
    $zhiIndex = $this->Yfdate->getMonthZhiIndexExact() + 3;
    if ($zhiIndex >= 12) {
      $zhiIndex -= 12;
    }
    return YfdateUtil::$GAN[$ganIndex + 1] . YfdateUtil::$ZHI[$zhiIndex + 1];
  }

  /**
   * 获取胎元纳音
   * @return string 纳音
   */
  public function getTaiYuanNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getTaiYuan()];
  }

  /**
   * 获取胎息
   * @return string 胎息
   */
  public function getTaiXi()
  {
    $ganIndex = (2 == $this->sect) ? $this->Yfdate->getDayGanIndexExact2() : $this->Yfdate->getDayGanIndexExact();
    $zhiIndex = (2 == $this->sect) ? $this->Yfdate->getDayZhiIndexExact2() : $this->Yfdate->getDayZhiIndexExact();
    return YfdateUtil::$HE_GAN_5[$ganIndex] . YfdateUtil::$HE_ZHI_6[$zhiIndex];
  }

  /**
   * 获取胎息纳音
   * @return string 纳音
   */
  public function getTaiXiNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getTaiXi()];
  }

  /**
   * 获取命宫
   * @return string 命宫
   */
  public function getMingGong()
  {
    $monthZhiIndex = 0;
    $timeZhiIndex = 0;
    for ($i = 0, $j = count(EightChar::$MONTH_ZHI); $i < $j; $i++) {
      $zhi = EightChar::$MONTH_ZHI[$i];
      if ($this->Yfdate->getMonthZhiExact() == $zhi) {
        $monthZhiIndex = $i;
      }
      if ($this->Yfdate->getTimeZhi() == $zhi) {
        $timeZhiIndex = $i;
      }
    }
    $zhiIndex = 26 - ($monthZhiIndex + $timeZhiIndex);
    if ($zhiIndex > 12) {
      $zhiIndex -= 12;
    }
    $jiaZiIndex = YfdateUtil::getJiaZiIndex($this->Yfdate->getMonthInGanZhiExact()) - ($monthZhiIndex - $zhiIndex);
    if ($jiaZiIndex >= 60) {
      $jiaZiIndex -= 60;
    }
    if ($jiaZiIndex < 0) {
      $jiaZiIndex += 60;
    }
    return YfdateUtil::$JIA_ZI[$jiaZiIndex];
  }

  /**
   * 获取命宫纳音
   * @return string 纳音
   */
  public function getMingGongNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getMingGong()];
  }

  /**
   * 获取身宫
   * @return string 身宫
   */
  public function getShenGong()
  {
    $monthZhiIndex = 0;
    $timeZhiIndex = 0;
    for ($i = 0, $j = count(EightChar::$MONTH_ZHI); $i < $j; $i++) {
      $zhi = EightChar::$MONTH_ZHI[$i];
      if ($this->Yfdate->getMonthZhiExact() == $zhi) {
        $monthZhiIndex = $i;
      }
      if ($this->Yfdate->getTimeZhi() == $zhi) {
        $timeZhiIndex = $i;
      }
    }
    $zhiIndex = 2 + $monthZhiIndex + $timeZhiIndex;
    if ($zhiIndex > 12) {
      $zhiIndex -= 12;
    }
    $jiaZiIndex = YfdateUtil::getJiaZiIndex($this->Yfdate->getMonthInGanZhiExact()) - ($monthZhiIndex - $zhiIndex);
    if ($jiaZiIndex >= 60) {
      $jiaZiIndex -= 60;
    }
    if ($jiaZiIndex < 0) {
      $jiaZiIndex += 60;
    }
    return YfdateUtil::$JIA_ZI[$jiaZiIndex];
  }

  /**
   * 获取身宫纳音
   * @return string 纳音
   */
  public function getShenGongNaYin()
  {
    return YfdateUtil::$NAYIN[$this->getShenGong()];
  }

  /**
   * 获取运
   * @param int $gender 性别，1男，0女
   * @return Yun 运
   */
  public function getYun($gender)
  {
    return $this->getYunBySect($gender, 1);
  }

  /**
   * 获取运
   * @param int $gender 性别，1男，0女
   * @param int $sect 流派，1按天数和时辰数计算，3天1年，1天4个月，1时辰10天；2按分钟数计算
   * @return Yun 运
   */
  public function getYunBySect($gender, $sect)
  {
    return new Yun($this, $gender, $sect);
  }

  /**
   * 获取年柱所在旬
   * @return string 旬
   */
  public function getYearXun()
  {
    return $this->Yfdate->getYearXunExact();
  }

  /**
   * 获取年柱旬空(空亡)
   * @return string 旬空(空亡)
   */
  public function getYearXunKong()
  {
    return $this->Yfdate->getYearXunKongExact();
  }

  /**
   * 获取月柱所在旬
   * @return string 旬
   */
  public function getMonthXun()
  {
    return $this->Yfdate->getMonthXunExact();
  }

  /**
   * 获取月柱旬空(空亡)
   * @return string 旬空(空亡)
   */
  public function getMonthXunKong()
  {
    return $this->Yfdate->getMonthXunKongExact();
  }

  /**
   * 获取日柱所在旬
   * @return string 旬
   */
  public function getDayXun()
  {
    return (2 == $this->sect) ? $this->Yfdate->getDayXunExact2() : $this->Yfdate->getDayXunExact();
  }

  /**
   * 获取日柱旬空(空亡)
   * @return string 旬空(空亡)
   */
  public function getDayXunKong()
  {
    return (2 == $this->sect) ? $this->Yfdate->getDayXunKongExact2() : $this->Yfdate->getDayXunKongExact();
  }

  /**
   * 获取时柱所在旬
   * @return string 旬
   */
  public function getTimeXun()
  {
    return $this->Yfdate->getTimeXun();
  }

  /**
   * 获取时柱旬空(空亡)
   * @return string 旬空(空亡)
   */
  public function getTimeXunKong()
  {
    return $this->Yfdate->getTimeXunKong();
  }
}