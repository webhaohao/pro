<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"C:\xampp\htdocs\appFactory\public/../application/index\view\register\index.html";i:1558347864;s:78:"C:\xampp\htdocs\appFactory\public/../application/index\view\common\header.html";i:1558314190;s:78:"C:\xampp\htdocs\appFactory\public/../application/index\view\common\footer.html";i:1558314190;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>IOS app生成</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="__PUBLIC__/css/font_780494_gi02bcyvmy5.css">
    <link rel="stylesheet" href="__PUBLIC__/css/main.css"/>
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
    <script src="__PUBLIC__/js/common.js"></script>
</head>
<body>

<nav role="navigation">
	<div class="container">
    <div class="login-nav">
            <div class="navbar-header">
                <a class="logo" href="#">
                        <img src="__IMG__/images/logo.png">
                </a>
            </div>
            <div class="userHandle">
                <?php if(\think\Request::instance()->session('uname')): ?>
                    <div class="login-in">
                            <!-- <li><a href="javascript:void (0);">欢迎您,<?php echo \think\Request::instance()->session('uname'); ?></a></li> -->
                                <div class="notification fl">
                                            <span class="iconfont icon-msg"></span>
                                            <span class="ms-badge">1</span>
                                </div>
                                <div class="login-user clear fl">
                                            <span class="fl">
                                                    <?php echo \think\Request::instance()->session('uname'); ?>
                                            </span>
                                            <span class="iconfont icon-arrow-bottom fl hidden-xs">
                                            </span>
                                            <div class="user-wrap">
                                                        <dl>
                                                                <!-- <dd>
                                                                        <a href="">我的订单</a>	
                                                                </dd> -->
                                                                <dd>
                                                                    <a href="">修改密码</a>
                                                                </dd>
                                                                <dd>
                                                                        <a href="/index/Main/loginOut">退出</a>	
                                                                </dd>
                                                        </dl>
                                            </div>
                                </div>
                    </div>
                
                <?php else: ?>
                    <ul class="pull-right">
                            <li class="active"><a href="" data-toggle="modal" data-target="#loginModal" class="ms-btn ms-btn-default">登录</a></li>
                            <li><a href="/index/Register"  class="ms-btn ms-btn-primary">注册</a></li>
                    </ul>
                <?php endif; ?>
            </div>
    </div>
	</div>
</nav>
<div class="register login-common">
        <div class="login-logo registered-logo">
                <img src="__PUBLIC__/images/logo.png" class="img-responsive hidden-xs" alt="">
                <div class="slogan-wrap">
                       <div class="slogan clearfix">
                              <div class="fl">
                                    <img src="__PUBLIC__/images/login-l.png" alt="">
                              </div>   
                              <div class="text fl">高效的移动应用服务平台</div>
                              <div class="fl">
                                    <img src="__PUBLIC__/images/login-r.png" alt="">
                             </div>   
                       </div> 
                </div>
        </div>
        <form action="" method="post" id="regForm">
                <div class="form-group">
                        <label for="" class="iconfont icon-user"></label>
                        <input type="text" class="form-control input-lg" name="uname" placeholder="请输入您的用户名(中文、英文、数字皆可)">
                </div>
                <div class="form-group">
                    <label for="" class="iconfont icon-tel"></label>
                    <input type="text" class="form-control input-lg" name="phone" placeholder="请输入手机号">
                </div>
                <div class="form-group">
                    <label for="" class="iconfont icon-email"></label>
                    <div class="clearfix verification-code">
                        <input type="text" class="form-control input-lg fl" name="yzm" placeholder="请输入短信验证码">
                        <button type="button" class="ms-btn ms-btn-primary input-lg fr">获取验证码</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="iconfont icon-pwd"></label>
                    <input type="password" class="form-control input-lg" name="upwd" placeholder="请输入密码，密码长度不能少于6位">
                </div>
                <button class="ms-btn ms-btn-primary input-lg mt20">注册</button>
        </form>
</div>
<script>
    $(function(){
        $('#regForm input[name=uname]').blur(checkUname);
        $('#regForm input[name=upwd]').blur(checkPwd);
        $('#regForm input[name=phone]').blur(isPoneAvailable);
        $("#regForm").on('click',function(e){
                e.preventDefault();
                if(checkUname()&&checkPwd()){
                    return false;
                }
                regFun();
        })
       
    })
    //用户名验证
    function checkUname(){
        var uname = $.trim($("#regForm input[name=uname]").val());
        if(!uname){
            toastr.error('用户不能为空!');
            return false;
        }
        else if(uname.length>10){
            toastr.error('用户不能超过10位字符!');
            return false;     
        }
        else{
            return true;
        }
    }
    function checkPwd(){
        var pwd = $.trim($("#regForm input[name=upwd]").val());
        if(!pwd){
            toastr.error('密码不能为空!'); 
        }
        else{
            return true;
        }
    }
    function checkPwd2(){
        var pwd = $.trim($("#regForm input[name=upwd]").val());
        var pwd2 = $.trim($("#regForm input[name=upwd2]").val());
        if(pwd !== pwd2){
            toastr.error('两次输入密码不一致!');
            return false;
        }
        else{
            return true;
        }
    }
    function isPoneAvailable() {
            var str = $.trim($("#regForm input[name='phone']").val());
            var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
            if (!myreg.test(str)) {
                toastr.error('请输入正确的手机号!');
                return false;
            } else {
                return true;
            }
        }
    function regFun(){
       //toastr.info('Are you the 6 fingered man?')
    //    if(checkUname()&&checkPwd()&&checkPwd2()){
    //        var data=$("#regForm").serialize();
           $.ajax({
               url:'/index/Register/index',
               type:'POST',
            //    data:data,
               success:function(data){
                    //    if(data.code==200){
                    //        toastr.info(data.msg);
                    //        setTimeout(function(){
                    //            location.href='/index/Main';
                    //        },1000);  
                          
                    //    }
                    //    else{
                    //        toastr.error(data.msg);
                    //    }                 
               }
           })
    //    }
  }
</script>
<!--底部-->
<footer>
  <div class="container">
       <div class="clearfix f-con">
                   <div class="left fl clearfix">
                           <a href="" class="footer-logo">
                                   <img src="__IMG__/images/footer_logo.png" alt="">
                           </a> 
                   </div>
                   <div class="fr right clearfix">
                           <dl class="fl r-1">
                               <dt class="clearfix">
                                     <img src="__IMG__/images/f-1.png" alt="">
                                     <span>产品服务</span>  
                               </dt>
                               <dd class="line"></dd>
                               <dd>
                                   <span class="icon-jiantou iconfont"></span>
                                   <a href="" target="_blank">APP制作</a>
                               </dd>
                               <dd>
                                   <span class="icon-jiantou iconfont"></span>
                                   <a href="" target="_blank">APP制作</a>
                               </dd>
                               <dd>
                                   <span class="icon-jiantou iconfont"></span>
                                   <a href="" target="_blank">APP制作</a>
                               </dd>
                           </dl>
                           <dl class="fl r-2">
                               <dt class="clearfix">
                                       <img src="__IMG__/images/f-2.png" alt="">
                                       <span>关于我们</span>  
                               </dt>
                               <dd class="line"></dd>
                               <dd>
                                   <span class="icon-jiantou iconfont"></span>
                                   <a href="" target="_blank">APP制作</a>
                               </dd>
                               <dd>
                                   <span class="icon-jiantou iconfont"></span>
                                   <a href="" target="_blank">APP制作</a>
                               </dd>
                               <dd>
                                   <span class="icon-jiantou iconfont"></span>
                                   <a href="" target="_blank">APP制作</a>
                               </dd>
                           </dl>
                           <dl class="fl r-2">
                                   <dt class="clearfix">
                                           <img src="__IMG__/images/f-3.png" alt="">
                                           <span>联系我们</span>  
                                   </dt>
                                   <dd class="line"></dd>
                                   <dd>
                                      <a href="javascript:;">QQ:734714852</a>
                                   </dd>
                                   <dd>
                                       <a href="javascript:;">邮箱:</a> 
                                   </dd>
                                   <dd>
                                       <a href="">地址:</a>
                                   </dd>
                           </dl>
                   </div>
       </div> 
       <div class="copy-right">
               海南竞游网络游戏有限责任公司 kuaifabu.com 版权所有  
               <a href="" href="http://www.beian.miit.gov.cn">琼ICP备18004564号-2</a> 
       </div>
   </div> 
</footer>
<!--登陆模态框-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
   <div class="modal-content">
       <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title" id="loginModalLabel">用户登录</h4>
       </div>
       <div class="modal-body">
           <form class="form-horizontal" role="form" id="loginForm">
               <div class="form-group">
                   <div class="col-sm-12">
                       <input type="text" class="form-control"  placeholder="请输入您的用户名" name="uname">
                   </div>
               </div>
               <div class="form-group">
                   <div class="col-sm-12">
                       <input type="password" class="form-control"  placeholder="请输入密码" name="upwd">
                   </div>
               </div>
               <!--<div class="form-group">-->
               <!--<div class="col-sm-offset-2 col-sm-10">-->
               <!--<div class="checkbox">-->
               <!--<label>-->
               <!--<input type="checkbox">请记住我-->
               <!--</label>-->
               <!--</div>-->
               <!--</div>-->
               <!--</div>-->
           </form>
       </div>
       <div class="modal-footer">
           <!--<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>-->
           <button type="button" class="ms-btn ms-btn-primary" id="loginBtn">登录</button>
       </div>
   </div><!-- /.modal-content -->
</div><!-- /.modal -->
</div>
<script>
  $(function(){
        //用户登录
        $("#loginBtn").on('click',loginFun);
  }) 
 
//   function regFun(){
//        //toastr.info('Are you the 6 fingered man?')
//        if(checkUname()&&checkPwd()&&checkPwd2()){
//            var data=$("#regForm").serialize();
//            $.ajax({
//                url:'/index/index/Reg',
//                type:'POST',
//                data:data,
//                success:function(data){
//                        if(data.code==200){
//                            toastr.info(data.msg);
//                            setTimeout(function(){
//                                location.href='/index/Main';
//                            },1000);  
                          
//                        }
//                        else{
//                            toastr.error(data.msg);
//                        }                 
//                }
//            })
//        }
//   }
  function loginFun(){
      var data=$("#loginForm").serialize();
      $.ajax({
          url:'/index/index/login',
          type:'POST',
          data:data,
          success:function(data){
               if(data.code==200){
                       //toastr.info(data.msg);
                       location.href='/index/Main';
               }
               else{
                       toastr.error(data.msg);
               }
          }
      })
  }
</script>
</body>
</html>