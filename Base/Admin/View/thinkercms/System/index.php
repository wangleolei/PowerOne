<?php if (!defined('THINK_PATH')) exit;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <title><?php echo C('SITE_NAME');?>- 后台管理中心首页</title>
    <link href="<?php echo C('CSS_PATH');?>reset.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo C('CSS_PATH');?>zh-cn-system.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo C('CSS_PATH');?>table_form.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles1.css" title="styles1" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles2.css" title="styles2" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles3.css" title="styles3" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="<?php echo C('CSS_PATH');?>style/zh-cn-styles4.css" title="styles4" media="screen" />
    <script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>admin_common.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo C('JS_PATH');?>styleswitch.js"></script>
    <script src="<?php echo C('JS_PATH');?>echarts-2.2.1/build/dist/echarts.js"></script>
     <script src="<?php echo C('JS_PATH');?>echarts-2.2.1/build/dist/theme/blue.js"></script>
    <script type="text/javascript">    
        require.config({
            paths: {
                echarts: '<?php echo C('JS_PATH');?>echarts-2.2.1/build/dist'
            }
        });
        require(
            [
                'echarts',
                'echarts/chart/line',
                'echarts/chart/bar'
            ],
            function (ec) {
                var theme = {
    // 默认色板
    color: [
        '#1790cf','#1bb2d8','#99d2dd','#88b0bb',
        '#1c7099','#038cc4','#75abd0','#afd6dd'
    ],

    // 图表标题
    title: {
        textStyle: {
            fontWeight: 'normal',
            color: '#1790cf'
        }
    },
    
    // 值域
    dataRange: {
        color:['#1178ad','#72bbd0']
    },

    // 工具箱
    toolbox: {
        color : ['#1790cf','#1790cf','#1790cf','#1790cf']
    },

    // 提示框
    tooltip: {
        backgroundColor: 'rgba(0,0,0,0.5)',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'line',         // 默认为直线，可选为：'line' | 'shadow'
            lineStyle : {          // 直线指示器样式设置
                color: '#1790cf',
                type: 'dashed'
            },
            crossStyle: {
                color: '#1790cf'
            },
            shadowStyle : {                     // 阴影指示器样式设置
                color: 'rgba(200,200,200,0.3)'
            }
        }
    },

    // 区域缩放控制器
    dataZoom: {
        dataBackgroundColor: '#eee',            // 数据背景颜色
        fillerColor: 'rgba(144,197,237,0.2)',   // 填充颜色
        handleColor: '#1790cf'     // 手柄颜色
    },
    
    // 网格
    grid: {
        borderWidth: 0
    },

    // 类目轴
    categoryAxis: {
        axisLine: {            // 坐标轴线
            lineStyle: {       // 属性lineStyle控制线条样式
                color: '#1790cf'
            }
        },
        splitLine: {           // 分隔线
            lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                color: ['#eee']
            }
        }
    },

    // 数值型坐标轴默认参数
    valueAxis: {
        axisLine: {            // 坐标轴线
            lineStyle: {       // 属性lineStyle控制线条样式
                color: '#1790cf'
            }
        },
        splitArea : {
            show : true,
            areaStyle : {
                color: ['rgba(250,250,250,0.1)','rgba(200,200,200,0.1)']
            }
        },
        splitLine: {           // 分隔线
            lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                color: ['#eee']
            }
        }
    },

    timeline : {
        lineStyle : {
            color : '#1790cf'
        },
        controlStyle : {
            normal : { color : '#1790cf'},
            emphasis : { color : '#1790cf'}
        }
    },

    // K线图默认参数
    k: {
        itemStyle: {
            normal: {
                color: '#1bb2d8',          // 阳线填充颜色
                color0: '#99d2dd',      // 阴线填充颜色
                lineStyle: {
                    width: 1,
                    color: '#1c7099',   // 阳线边框颜色
                    color0: '#88b0bb'   // 阴线边框颜色
                }
            }
        }
    },
    
    map: {
        itemStyle: {
            normal: {
                areaStyle: {
                    color: '#ddd'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            },
            emphasis: {                 // 也是选中样式
                areaStyle: {
                    color: '#99d2dd'
                },
                label: {
                    textStyle: {
                        color: '#c12e34'
                    }
                }
            }
        }
    },
    
    force : {
        itemStyle: {
            normal: {
                linkStyle : {
                    color : '#1790cf'
                }
            }
        }
    },
    
    chord : {
        padding : 4,
        itemStyle : {
            normal : {
                borderWidth: 1,
                borderColor: 'rgba(128, 128, 128, 0.5)',
                chordStyle : {
                    lineStyle : {
                        color : 'rgba(128, 128, 128, 0.5)'
                    }
                }
            },
            emphasis : {
                borderWidth: 1,
                borderColor: 'rgba(128, 128, 128, 0.5)',
                chordStyle : {
                    lineStyle : {
                        color : 'rgba(128, 128, 128, 0.5)'
                    }
                }
            }
        }
    },
    
    gauge : {
        axisLine: {            // 坐标轴线
            show: true,        // 默认显示，属性show控制显示与否
            lineStyle: {       // 属性lineStyle控制线条样式
                color: [[0.2, '#1bb2d8'],[0.8, '#1790cf'],[1, '#1c7099']], 
                width: 8
            }
        },
        axisTick: {            // 坐标轴小标记
            splitNumber: 10,   // 每份split细分多少段
            length :12,        // 属性length控制线长
            lineStyle: {       // 属性lineStyle控制线条样式
                color: 'auto'
            }
        },
        axisLabel: {           // 坐标轴文本标签，详见axis.axisLabel
            textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                color: 'auto'
            }
        },
        splitLine: {           // 分隔线
            length : 18,         // 属性length控制线长
            lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                color: 'auto'
            }
        },
        pointer : {
            length : '90%',
            color : 'auto'
        },
        title : {
            textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                color: '#333'
            }
        },
        detail : {
            textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                color: 'auto'
            }
        }
    },
    
    textStyle: {
        fontFamily: '微软雅黑, Arial, Verdana, sans-serif'
    }
};                
                var myChart = ec.init(document.getElementById('admin_behavior_count'),theme);
                var option = {
    tooltip : {
        trigger: 'axis'
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType: {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    legend: {
        data:['执行耗时','平均执行时间']
    },
    xAxis : [
        {
            type : 'category',
            data : <?php echo json_encode($date);?>
        }
    ],
    yAxis : [
        {
            type : 'value',
            name : '执行耗时',
            axisLabel : {
                formatter: '{value} s'
            }
        },
        {
            type : 'value',
            name : '平均执行时间',
            axisLabel : {
                formatter: '{value} s'
            }
        }
    ],
    series : [

        {
            name:'执行耗时',
            type:'bar',
            data:<?php echo json_encode($sum);?>
        },
        {
            name:'平均执行时间',
            type:'line',
            yAxisIndex: 1,
            data:<?php echo json_encode($avg);?>
        }
    ]
};
                //myChart.setTheme('blue');
                myChart.setOption(option);
            }
        );
    </script>
    </head>
    <body>
<style type="text/css">
	html{_overflow-y:scroll}
</style>
<div id="main_frameid" class="pad-10" style="_margin-right:-12px;_width:98.9%;">
        <div class="col-2 lf mr10" style="width:100%">
        <h6>时间长度：<a href="<?php echo U('index')?>" target="_self">今天</a> | <a href="<?php echo U('index',array('cycle'=>1))?>" target="_self">一个月</a> |　<a href="<?php echo U('index',array('cycle'=>3))?>" target="_self">三个月</a> | <a href="<?php echo U('index',array('cycle'=>12))?>">一年</a> </h6>
        <div class="content" id="admin_panel">
                <div id="admin_behavior_count" style="height:250px;padding:10px; width:100%;"> </div>
            </div>
    </div>
        <div class="bk10"></div>        
		<div class="col-2 lf mr10" style="width:48%">
		<h6>服务器信息</h6>
		<div class="content">
				操作系统：<?php if(PATH_SEPARATOR==':') echo 'Linux';else echo 'Windows';?><br />
				服务器软件：<?php echo $_SERVER['SERVER_SOFTWARE'];?> <br />
				MySQL 版本：<?php echo $mysql_vesrsion;?><br />
				上传文件：<?php echo ini_get('upload_max_filesize');?><br />
                最长执行时间：<?php echo ini_get('max_execution_time');?>s<br />
			</div>
	</div>	
	<div class="col-2 col-auto">
		<h6>系统信息</h6>
		<div class="content">
        	系统名称：<a href="http://cms.thinkerphp.com" target="_blank">ThinkerCMS</a><br/>
            版本号：<?PHP echo C('version');?> <br/>
            技术社区：<a href="http://bbs.thinkerphp.com/forum.php?gid=1" target="_blank">点击访问</a><br/>
            Bug反馈：<a href="http://bbs.thinkerphp.com/forum.php?mod=forumdisplay&fid=42" target="_blank">去反馈BUG</a><br/>
            下载更新：<a href="http://cms.thinkerphp.com/home/index/detail/catid/18/id/8.html" target="_blank">去看是否有最新版本</a>
		</div>
	</div>	    	
<!--<div class="col-2 lf mr10" style="width:100%" style="display:none">
		<h6>系统用户登陆统计</h6>
		<div class="content" id="admin_panel">
				<div id="admin_login_count" style="height:250px;padding:10px; width:100%;"> </div>
			</div>
	</div>-->		
	</div>
</body>
</html>
