<?php
namespace Home\Event;
use Think\Controller;
class UserEvent extends Controller{
}

//UserEvent 负责内部的事件响应，并且只能在内部调用： A('User','Event');