<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="zh-TW">
  <head>
  <meta charset="utf-8">
  <title> 
      <?php if(isset($pageTitle) ){ ?>
          <?=h($pageTitle)?> | <?=SITE_TITLE?>
      <?php }else{ ?>
          <?=SITE_TITLE?>
      <?php } ?>
  </title>

    <?php if(isset($og_desc)) { ?>
    <meta name="description" content="<?=h($og_desc)?>" /> 
    <?php } ?>

    <!-- Mobile Specifics -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--給FB看的設定-->
    <?php if(isset($og_image)){ ?>
<meta property="og:image" content="<?=$og_image?>" />
    <?php } ?>

<meta property="og:type" content="website" />
<meta property="fb:app_id" content="1631332217194428" />
<!-- <meta property="fb:admins" content="107507809341864"/> -->

  <meta property="og:site_name" content="<?=SITE_TITLE?>" />


    <?php if(isset($pageTitle) ){ ?>
        <meta property="og:title" content="<?=h($pageTitle)?> | <?=SITE_TITLE?>" />
    <?php }else{ ?>
        <meta property="og:title" content="<?=SITE_TITLE?>" />
    <?php } ?>

    <?php if(isset($og_url)) { ?>
        <meta property="og:url" content="<?=h($og_url)?>" />
    <?php } ?>

    <?php if(isset($og_desc)) { ?>
    <meta name="og:description" content="<?=h($og_desc)?>" /> 
    <?php } ?>

<?php if(0){ ?>
    <!-- Fav Icon -->
    <link rel="shortcut icon" href="<?=cdn_url("sys_images/favicon.ico") ?>" type="image/x-icon" />
    <link rel="icon" href="<?=cdn_url("sys_images/favicon.ico") ?>" type="image/x-icon" />
<?php } ?>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="<?=base_url("bootstrap/css/bootstrap.min.css")?>" />

  <link rel="stylesheet" href="<?=base_url("bootstrap/css/bootstrap-theme.min.css")?>" />
  
  <style>
  
    /* Common */

    .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.open>a{
      background:rgb(128,208,205);
    }
    .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{
      background:rgb(118,198,195);
    }

    .navbar-nav .dropdown-menu{
      position:relative;
    }
    .nav-item{
      border:1px solid white;
      color:rgb(52,91,89) !important;
      font-size:16px;
    }

    .breadcrumb,.breadcrumb a{
      color:rgb(127,127,127);
      background:transparent;
    }
    .breadcrumb .now{
      color:rgb(176,52,18);
    }
  

    /* PB */
    .content-deep{
      background:rgb(24,160,152);
      padding-bottom:30px;
      padding-top:50px;
    }

    .content-deep .block{
      margin-top:-44px;
    }

    .block-left{
      padding-left:3%;
    }

    .block-right{
      padding-right:5%;
    }

    .block-header{
      padding:10%;
    }


    .block-header h2{
      margin-top:0;
      margin-bottom:0;
      background: #ffffff;
      background-image: -webkit-linear-gradient(top, #ffffff, #999999);
      background-image: -moz-linear-gradient(top, #ffffff, #999999);
      background-image: -ms-linear-gradient(top, #ffffff, #999999);
      background-image: -o-linear-gradient(top, #ffffff, #999999);
      background-image: linear-gradient(to bottom, #ffffff, #999999);
      -webkit-border-radius: 28;
      -moz-border-radius: 28;
      border-radius: 28px;
      -webkit-box-shadow: 2px 4px 7px #666666;
      -moz-box-shadow: 2px 4px 7px #666666;
      box-shadow: 2px 4px 7px #666666;
      font-family: Arial;
      color: #000000;
      font-size: 20px;
      padding: 10px 20px 10px 20px;
      border: solid #000000 1px;
      text-decoration: none;

      width:160px;
      margin:0 auto;
      font-size:20px;
      text-align:center;

      position:relative;
    }

    .block-body{
      border:1px solid black;
      border-radius: 20px;
      min-height: 200px;
      background:white;
      margin-top:-50px;
      padding-top:40px;
      padding-bottom:25px;

      padding-left:5%;
      padding-right:5%;
    }

    .block-body .block-item{
      background:rgb(36,89,103);
      border-radius: 60px;

      display:block;
      width:90%;
      margin-left:5%;
      margin-right:5%;
      min-height:30px;
      padding-left:20px;
      padding-right:20px;
      margin-top:10px;

      color:white;
      font-size:18px;
      padding-top:4px;
    }

    .block-body .block-item-active{
      background:rgb(190,81,80);
    }

    .block-body .block-item:hover{
      background:rgb(140,41,40); 
      text-decoration: none;
    }


    .content-info{
      border: 2px solid rgb(0,22,116);
      background: rgb(220,238,244);
      min-height:400px;
      padding:20px;
    }

    .content-info h2{
      font-size:20px;
      color:rgb(2,34,94);
    }

    .content-info ul,.content-info ol{
      padding-left:22px;
    }

    .content-info li{
      margin-top:10px;
      margin-bottom:10px;
    }
    /* end PB  */


    /* News */

    .content-list{
      background:rgb(226,238,196);
      padding:20px;
      padding-left:5%;
      padding-right:5%;
    }
  
    .content-list .thead-inverse th{
      background:white;
      border:none;
      border-top:2px solid rgb(23,161,152) !important;
      border-bottom:2px solid  rgb(23,161,152);
    }

    .content-list .category{
      color:rgb(151,51,14);
    }

    /* events */
  
    .event-item-container{
      padding:20px;
    }
    .event-item{
      height: 300px;
      padding: 20px;
      border-radius: 30px;
      background: rgb(230,230,230);
      -webkit-box-shadow: 3px 3px 15px 0px rgba(102,102,102,0.39);
      -moz-box-shadow: 3px 3px 15px 0px rgba(102,102,102,0.39);
      box-shadow: 3px 3px 15px 0px rgba(102,102,102,0.39);

    }

    .event-item img{
      width:100%;
    }

    .event-item h2{
      font-size:16px;
      color:rgb(14,115,185);
    }
    .event-item div{
      color:black;
    }

    /* News */

    .footer{
      background:rgb(131,208,204);
    }

    .footer-header{
      -webkit-box-shadow: inset 0px -9px 8px -8px rgba(0,0,0,0.89);
      -moz-box-shadow: inset 0px -9px 8px -8px rgba(0,0,0,0.89);
      box-shadow: inset 0px -9px 8px -8px rgba(0,0,0,0.89);
      padding-bottom:4px;
    }

    .footer-body{
      padding-bottom:30px;
      padding-top:30px;
    }

    .word-content img{
      max-width:100%;
      max-height:800px;
    }

    .menu{
      padding: 20px;
      background: white;
      border: 1px solid black;
      border-radius: 16px;
    }

    .menu ul{
      padding-left: 0px;
      list-style: none;
    }
  </style>

<?php if(function_exists("css_section")) {
  css_section();
  }?>
</head>
<body>
  


  <div class="container">
    <div style="position:relative;min-height:117px;"> 
      <div style="position:absolute;bottom:20px;left:5%;width:100%;">
        <a href="<?=site_url("/")?>"><img style='width:150px;' src="<?=base_url("img/taichung.png")?>" /></a>
        <img style='margin-bottom:10px;margin-left:10%;width:150px;' src="<?=base_url("img/pb_logo.png")?>" /></a>
      </div>
      <img style='width:100%;min-height:117px;' src="<?=base_url("img/_header.png")?>" />

    </div>

    <nav class="navbar navbar-default" style="margin-bottom:0;background:rgb(128,208,205);border:none;">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- 
          <a class="navbar-brand" href="<?=site_url("/")?>"><?=SITE_TITLE?></a>
          -->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" >
          <ul class="nav navbar-nav" style="margin: 0 auto;width: 800px;float:none;">

            <li class="dropdown">
              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">最新消息</a>
              <ul class="dropdown-menu">
                <li><a href="<?=site_url("/news")?>">相關新聞</a></li>
                <li><a href="<?=site_url("/events")?>">活動快訊</a></li>
              </ul>
            </li>
            <li><a class="nav-item" href="<?=site_url("/process")?>">推動流程</a></li>
            <!--
            <li><a class="nav-item" href="<?=site_url("/cases")?>">今年提案</a></li>
            -->
  
            <!--
            <li><a class="nav-item" href="<?=site_url("/areas")?>">各區推動概況</a></li>
            -->
            <!-- <li><a class="nav-item" href="<?=site_url("/")?>">票選系統</a></li> -->

            <li class="dropdown">
              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">歷年提案</a>
              <ul class="dropdown-menu">
                <li><a href="http://2015taichungivoting.weebly.com/">2015</a></li>
              </ul>
            </li>

            <li><a class="nav-item" href="<?=site_url("/QA")?>"> Q &amp; A</a></li>
            
            
            <!--
            <li><a class="nav-item" href="<?=site_url("/")?>"> 記錄區 </a></li>
            -->
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>

