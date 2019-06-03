<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"C:\xampp\htdocs\pro\public/../application/admin\view\stuinfo\index.html";i:1559443594;s:68:"C:\xampp\htdocs\pro\public/../application/admin\view\common\top.html";i:1559464798;s:69:"C:\xampp\htdocs\pro\public/../application/admin\view\common\left.html";i:1559138579;}*/ ?>
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
    <link href="__PUBLIC__/style/fileinput.min.css" rel="stylesheet"/>
    <!--Beyond styles-->
    <link id="beyond-link" href="__PUBLIC__/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="__PUBLIC__/style/demo.css" rel="stylesheet">
    <link href="__PUBLIC__/style/typicons.css" rel="stylesheet">
    <link href="__PUBLIC__/style/animate.css" rel="stylesheet">   
</head>
<style>
    .uploadForm{
        margin:15px 0px;
    }
    .searchForm{
        margin:15px 0px; 
    }    
</style>
<body>
	<!-- 头部 -->
	<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                            无纸化仓库管理
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
                                    <img 
src="__PUBLIC__/images/userPhoto.png">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo \think\Request::instance()->session('username'); ?></span></span></h2>
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
                                    <a href="<?php echo url('admin/edit',array('id'=>\think\Request::instance()->session('uid'))); ?>">
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
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">管理员 </span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('admin/lst'); ?>">
                                    <span class="menu-text">
                                        管理列表                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li>
                        </ul>                            
                    </li> 
                    <li>
                        <a href="#" class="menu-dropdown">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text">仓库管理</span>
                            <i class="menu-expand"></i>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="<?php echo url('Storeman/lst'); ?>">
                                    <span class="menu-text">
                                            仓库列表                                   
                                    </span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li> 
                        </ul> 
                                                       
                    </li> 
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
                    <li>
                            <a href="#" class="menu-dropdown">
                                <i class="menu-icon fa fa-file-text"></i>
                                <span class="menu-text">学生信息管理</span>
                                <i class="menu-expand"></i>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="<?php echo url('stuinfo/index'); ?>">
                                        <span class="menu-text">
                                                学生信息列表                             
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
                                        <li class="active">仓库管理</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
<div class="page-body">
 
<div class="row">
    
    <div class="col-lg-12 col-sm-12 col-xs-12">

        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                    <form class="form-horizontal uploadForm" role="form" action="" enctype="multipart/form-data" method="post">  
                        <input id="input-1a" type="file" data-show-preview="false" name="excel"> 
                    </form>  
                    <form action="./search" method="get" class="searchForm">
                        <div class="row">
                            <div class="col-md-2">
                                    <input class="form-control" name="stusno" type="text" value="" placeholder="请输入学号">
                            </div>
                            <div class="col-md-2">
                                    <input class="form-control" name="uname"  type="text" value="" placeholder="请输入姓名">            
                            </div>
                            <div class="col-md-2">
                                   <button class="btn btn-primary">查询</button> 
                            </div>
                        </div>
                    </form> 
                    <div style="margin-bottom:20px;">
                             <button type="button" tooltip="下载excel" class="btn btn-danger download" onClick="warning('确实要全部删除吗?', '<?php echo url('stuinfo/allRemove'); ?>')"><i class="fa fa-trash-o"></i>全部删除</button>
                             <button type="button" tooltip="下载excel" class="btn btn-info download" onClick="jump('<?php echo url('stuinfo/exportExcel'); ?>')"><i class="fa fa-download"></i>导出Excel</button>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center" width="4%">ID</th>
                                <th class="text-center">姓名</th>
                                <th class="text-center">学号</th>
                                <th class="text-center" width="20%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr>
                                    <td align="center"><?php echo $vo['id']; ?></td>
                                    <td align="center"><?php echo $vo['uname']; ?></td>
                                    <td align="center"><?php echo $vo['stusno']; ?></td>
                                    <td align="center">
                                        <a href="<?php echo url('stuinfo/edit',array('id'=>$vo['id'])); ?>" class="btn btn-primary btn-sm shiny">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <a href="#" onClick="warning('确实要删除吗', '<?php echo url('stuinfo/del',array('id'=>$vo['id'])); ?>')" class="btn btn-danger btn-sm shiny">
                                            <i class="fa fa-trash-o"></i> 删除
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>    
                    </table>
                </div>
                <div style="text-align:right; margin-top:10px;">
                        <?php echo $list -> render(); ?>
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
    <script src="__PUBLIC__/style/fileinput.min.js"></script>
    <script src="__PUBLIC__/style/locales/zh.js"></script>
    <!--Beyond Scripts-->
    <script src="__PUBLIC__/style/beyond.js"></script>
    
    <script>
        $(function(){
            $('#input-1a').fileinput({
                language: 'zh',
                uploadUrl: './index',
                allowedFileExtensions: ["xls", "xlsx"],
            });
            $("#input-1a").on("fileuploaded", function (event, data, previewId, index) {
                console.log(data);
                if(data.response == 'succ')
                {
                    alert(data.files[index].name + "上传成功!");
                    location.href = './index';
                    //关闭
                    //$(".close").click();
                }else{
                    alert(data.files[index].name + "上传失败,模板有误!");
                    //重置
                    // $("#input-1a").fileinput("clear");
                    // $("#input-1a").fileinput("reset");
                    // $('#input-1a').fileinput('refresh');
                   // $('#input-1a').fileinput('enable');
                }
            });
        })
      
    </script>

</body></html>