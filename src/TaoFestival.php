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
 * 道历节日
 * @package yfdate
 */
class TaoFestival
{

  private $name;

  private $remark;

  function __construct($name, $remark = null)
  {
    $this->name = $name;
    $this->remark = null == $remark ? '' : $remark;
  }

  public function getName()
  {
    return $this->name;
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
    if (null != $this->remark && strlen($this->remark) > 0) {
      $s .= '[' . $this->remark . ']';
    }
    return $s;
  }

  public function __toString()
  {
    return $this->toString();
  }

}
