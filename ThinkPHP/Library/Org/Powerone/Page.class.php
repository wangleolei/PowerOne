<?php
// +----------------------------------------------------------------------
// | Toilove个人博客 [ 让学习之路更轻松 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 - now  http://toilove.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 伊始 <774694235@qq.com> <http://www.toilove.com>
// +----------------------------------------------------------------------
// | 更多 分享尽在 Toilove.com
// +----------------------------------------------------------------------

namespace Org\Powerone;

class Page{
    public $type;               // 分页类型，0数据分页 1内容分页，默认 = 0
    public $parameter = 'page'; // 分页参数 
    public $now;                // 当前页
    public $only = false;       // 仅数据 布尔
    // 0：数据分页参数
    public $whole;              // 数据总数
    public $limit;              // 起始行数
    public $single = 10;        // 单页的个数
    // 1：内容分页
    public $content;            // 内容数据
    public $contents;           // 分页后内容数据
    public $symbol = '#PAGE#';  // 分页标识符
    // 分页信息
    public $pages;              // 无页数
    public $display = 5;        // 栏目显示页数
    public $ulcss = 'page-ul';  // ul的css
    public $licss = 'page-on';  // 当前li的css
    // 显示设置
    private $config  = array(
        // 上一页、下一页
        'previous'  => '上一页',
        'next'      => '下一页',
        // 首页、尾页
        'first'     => '首页',
        'end'       => '尾页',
    );

    /*
     *  架构函数
     *  $type 分页模式 0数据分页 1文本分页
     *  $type 为 0 -> $data 数据总数，$where 单页数据个数
     *  $type 为 1 -> $data 文本内容，$where 分页符号
     *  $only 仅返回原始数据
     */
    public function __construct($data,$where,$type=0,$only){
        // 是否有get分页信息
        $this->now  = empty($_GET[$this->parameter])?1:intval($_GET[$this->parameter]);
        // 根据类型传入数据
        if($type)$this->type = $type;
        if($this->type){
            if (is_string($data))$this->content = $data;
            else return '';
            if($where)$this->symbol = $where;
        }
        else
        {
            if(is_numeric($data))$this->whole  = $data;
            else return '';
            if($where)$this->single = $where;
        }
        if($only)$this->only = $only;
    }

    // 函数处理
    public function show(){
        // 以类型获取总页数
        if($this->type){
            $this->contents = explode($this->symbol,$this->content);
            $sum = count($this->contents);
        }
        else
        {
            $sum = ceil($this->whole/$this->single);
            $this->limit = ($this->now-1)*$this->single;
        }
        if(($this->now)>$sum)return false;
        $this->pages = $sum;
        // 上一页、下一页的值
        $this->previous = $this->now>1?($this->now-1):1;
        $this->next     = $this->now<$sum?($this->now+1):$sum;
        // 前后页码
        $sides = intval(floor($this->display/2));
        // 页码起点
        if($sum<=$this->display)$start = 1;
        elseif(($this->now-$sides)>0&&($this->now+$sides)<=$sum)$start = $this->now-$sides;
        elseif(($this->now+$sides)>$sum)$start = $sum-$this->display+1;
        else $start = 1;
        // 中间数字页码个数
        if($sum<$this->display)$number = $sum;
        else $number = $this->display;
        if($this->only){
            if($sum>$this->display){
                // 首页
                if(($this->now+$sides)>$this->display)$return['first'] = 1;
                // 尾页
                if(($this->now-$sides)<=($sum-$this->display))$return['end'] = $sum;
            }
            if($sum != '1'){
                // 上一页
                if($this->now>1)$return['previous'] = $this->previous;
                // 下一页
                if($this->now<$sum)$return['next'] =  $this->next;
            }
            // 当前页数和总页数
            $return['on'] = $this->now;
            $return['sum'] = $sum;
            // 数字栏目拼接
            for($i=0;$i<$number;$i++){
                $return['num'][$i] = $i+$start;
            }
            // 分页参数
            $return['parameter'] = $this->parameter;
        }
        else
        {
            // URL链接
            $on_url = explode('?',$_SERVER['REQUEST_URI']);
            $url    = $on_url[0];
            if($sum>$this->display){
                // 首页
                if(($this->now+$sides)>$this->display)$first ='<li><a href="'.$url.'?'.$this->parameter.'=1">'.$this ->config['first'].'</a></li>';
                // 尾页
                if(($this->now-$sides)<=($sum-$this->display))$end='<li><a href="'.$url.'?'.$this->parameter.'='.$sum.'">'.$this ->config['end'].'</a></li>';
            }
            if($sum != '1'){
                // 上一页
                if($this->now>1)$previous='<li><a href="'.$url.'?'.$this->parameter.'='.$this->previous.'">'.$this ->config['previous'].'</a></li>';
                // 下一页
                if($this->now<$sum)$next='<li><a href="'.$url.'?'.$this->parameter.'='.$this->next.'">'.$this ->config['next'].'</a></li>';
            }
            // 数字栏目拼接
            for($i=0;$i<$number;$i++){
                if($this->now == $i+$start)$num = $num.'<li class="'.$this->licss.'"><a>'.($this->now).'</a></li>';
                else $num = $num.'<li><a href="'.$url.'?'.$this->parameter.'='.($i+$start).'">'.($i+$start).'</a></li>';
            }
            $return = '<ul class="'.$this->ulcss.'">'.$first.$previous.$num.$next.$end.'</ul>';
            return $return;
        }
        return $return;


    }
    
}