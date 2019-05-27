<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"C:\xampp\htdocs\pro\public/../application/store\view\storelist\lst.html";i:1558964703;s:68:"C:\xampp\htdocs\pro\public/../application/store\view\common\top.html";i:1558963113;s:69:"C:\xampp\htdocs\pro\public/../application/store\view\common\left.html";i:1558882260;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>无纸化仓库管理</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__PUBLIC__/style/bootstrap.css" rel="stylesheet">
    <link href="__PUBLIC__/style/font-awesome.css" rel="stylesheet">
    <link href="__PUBLIC__/style/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="__PUBLIC__/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="__PUBLIC__/style/demo.css" rel="stylesheet">
    <link href="__PUBLIC__/style/typicons.css" rel="stylesheet">
    <link href="__PUBLIC__/style/animate.css" rel="stylesheet">
    
</head>
<style>
      table tr td span{
          margin-right:20px;
      }  
      .search{
          background:#fff;
          margin:10px 0px;
          padding:10px;
      }
</style>
<body>
	<!-- 头部 -->
	<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand" style="font-size:16px;">
                    <small>
                            无纸化仓库管理(仓库管理员)
                    </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="__PUBLIC__/images/userPhoto.png">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo \think\Request::instance()->session('sname'); ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a>David Stevenson</a></li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/logout'); ?>">
                                            退出登录
                                        </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('Storeman/edit',array('id'=>\think\Request::instance()->session('sid'))); ?>">
                                            修改密码
                                        </a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                        <!-- /Account Area -->
                        <!--Note: notice that setting div must start right after account area list.
                            no space must be between these elements-->
                        <!-- Settings -->
                    </ul>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>
</div>
	<!-- /头部 -->
	
	<div class="main-container container-fluid">
		<div class="page-container">
			            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input class="searchinput" type="text">
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-file-text"></i>
                            <span class="menu-text">仓库信息管理</span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('storelist/lst'); ?>">
                                    <span class="menu-text">
                                            仓库信息列表                             
                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        </ul>                            
                    </li>                   
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">系统</a>
                        </li>
                        <li class="active">仓库信息管理</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
<div class="page-body"> 
<div class="row">
    <div class="search">
            <form action="./search" method="get" class="searchForm">
                    <div class="row">
                        <div class="col-md-2">
                                <input class="form-control" name="stusno" type="text" value="" placeholder="请输入学号">
                        </div>
                        <div class="col-md-2">
                                <input class="form-control" name="uname"  type="text" value="" placeholder="请输入姓名">            
                        </div>
                        <div class="col-md-2">
                                <select class="form-control" name="type">
                                            <option value="" selected disabled>请选择类型</option>
                                            <option value="1">领取</option>
                                            <option value="0">清退</option>
                                </select>
                        </div>
                        <div class="col-md-2">
                               <button class="btn btn-primary">查询</button> 
                        </div>
                    </div>
            </form>
    </div>  
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <button type="button" tooltip="下载excel" class="btn btn-sm btn-azure btn-addon" onclick="javascript:window.location.href='<?php echo url('storelist/out'); ?>'"><i class="fa fa-download"></i>导出Excel</button>
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                    <table class="table table-bordered table-hover">
                        <!-- <thead class="">
                            <tr>
                                <th class="text-center" width="4%">ID</th>
                                <th class="text-center">姓名</th>
                                <th class="text-center">学号</th>
                                <th class="text-center" width="20%">操作</th>
                            </tr>
                        </thead> -->
                        <tbody>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td colspan="5">
                                        <span>姓名:<?php echo $vo['uname']; ?></span>
                                        <span>学号:<?php echo $vo['stusno']; ?></span>
                                        <span><?php echo !empty($vo['type'])?'领取时间:':'清退时间:'; ?><?php echo date("Y-m-d H:i:s",$vo['time']); ?></span>
                                </td>
                            </tr>
                                <tr>
                                        <td>
                                            资产编号
                                        </td>
                                        <td>
                                            资产描述
                                        </td>
                                        <td>
                                            配件描述
                                        </td>
                                        <td>配件数量</td>
                                        <td>备注</td>
                                </tr>
                                <?php if(is_array($vo['partinfo']) || $vo['partinfo'] instanceof \think\Collection || $vo['partinfo'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['partinfo'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td>
                                        <?php echo $p['serialnum']; ?>    
                                    </td>
                                    <td>
                                        <?php echo $p['serialdes']; ?>
                                    </td>
                                    <td>
                                        <?php echo $p['partIntr']; ?>
                                    </td>
                                    <td>
                                        <?php echo $p['count']; ?>
                                    </td>
                                    <td>    
                                        <?php echo $p['remarks']; ?>
                                    </td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <tr>
                                        <td colspan="5">
                                             <p>电子签名:</p>
                                              <img src="<?php echo $vo['path']; ?>" alt="" style="width:200px;">  
                                        </td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="5">
                                        <!-- <a href="<?php echo url('storelist/edit',array('id'=>$vo['id'])); ?>" class="btn btn-primary btn-sm shiny">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a> -->
                                        <a href="#" onClick="warning('确实要删除吗', '<?php echo url('storelist/del',array('id'=>$vo['id'])); ?>')" class="btn btn-danger btn-sm shiny">
                                            <i class="fa fa-trash-o"></i> 删除
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <div style="text-align:right; margin-top:10px;">
                            <?php echo $list->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

	    <!--Basic Scripts-->
    <script src="__PUBLIC__/style/jquery_002.js"></script>
    <script src="__PUBLIC__/style/bootstrap.js"></script>
    <script src="__PUBLIC__/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="__PUBLIC__/style/beyond.js"></script>
    
    <script>
            $(function(){
                $(".searchForm").submit(function(e){
                        var flag=[];
                        var t = $(this).serializeArray();
                        $.each(t,function(i,item){
                               if(item['value']==""){
                                   flag.push('false')
                               } 
                               else{
                                    flag.push('true');
                               }
                        })
                        if(flag.indexOf('true')==-1){
                                alert("请输入查找的内容!");
                                return false;
                        }
                });
            })
    </script>

</body></html>