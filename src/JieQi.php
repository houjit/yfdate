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
namespace houjit\yfdate;

/**
 * 节气
 * @package yfdate
 */
class JieQi
{
  /**
   * 名称
   * @var string
   */
  private $name;

  /**
   * 阳历日期
   * @var Solar
   */
  private $solar;
  private $jie;
  private $qi;

  function __construct($name, $solar)
  {
    $this->setName($name);
    $this->solar = $solar;
  }

  /**
   * 获取名称
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * 设置名称
   * @param string $name 名称
   */
  public function setName($name)
  {
    $this->name = $name;
    for ($i = 0, $j = count(Yfdate::$JIE_QI); $i < $j; $i++) {
      if (strcmp($name, Yfdate::$JIE_QI[$i]) == 0) {
        if ($i % 2 == 0) {
          $this->qi = true;
        } else {
          $this->jie = true;
        }
        return;
      }
    }
  }

  /**
   * 获取阳历日期
   * @return Solar
   */
  public function getSolar()
  {
    return $this->solar;
  }

  /**
   * 设置阳历日期
   * @param Solar $solar 阳历日期
   */
  public function setSolar($solar)
  {
    $this->solar = $solar;
  }

  /**
   * 是否节令
   * @return true/false
   */
  public function isJie()
  {
    return $this->jie;
  }

  /**
   * 是否气令
   * @return true/false
   */
  public function isQi()
  {
    return $this->qi;
  }

  public function toString()
  {
    return $this->name;
  }

  public function __toString()
  {
    return $this->toString();
  }

}
