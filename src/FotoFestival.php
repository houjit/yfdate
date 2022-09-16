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

/**
 * 佛历因果犯忌
 * @package yfdate
 */
class FotoFestival
{

  private $name;

  private $result;

  private $everyMonth;

  private $remark;

  function __construct($name, $result = null, $everyMonth = false, $remark = null)
  {
    $this->name = $name;
    $this->result = null == $result ? '' : $result;
    $this->everyMonth = $everyMonth;
    $this->remark = null == $remark ? '' : $remark;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getResult()
  {
    return $this->result;
  }

  public function isEveryMonth()
  {
    return $this->everyMonth;
  }

  public function getRemark()
  {
    return $this->remark;
  }

  public function toString()
  {
    return $this->name;
  }

  public function toFullString()
  {
    $s = $this->name;
    if (null != $this->result && strlen($this->result) > 0) {
      $s .= ' ' . $this->result;
    }
    if (null != $this->remark && strlen($this->remark) > 0) {
      $s .= ' ' . $this->remark;
    }
    return $s;
  }

  public function __toString()
  {
    return $this->toString();
  }

}
