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
      border-top:2px solid black !important;
      border-bottom:2px solid black;
    }

    .content-list .category{
      color:rgb(151,51,14);
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
  </style>

<?php if(function_exists("css_section")) {
  css_section();
  }?>
</head>
<body>
  


  <div class="container">
    <div> 
      <a href="<?=site_url("/")?>"><img style='width:100%;' src="<?=base_url("img/_header.png")?>" /></a>
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
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a class="nav-item" href="<?=site_url("/news")?>">最新消息</a></li>
            <li><a class="nav-item" href="<?=site_url("/events")?>">活動快訊</a></li>
            <li><a class="nav-item" href="<?=site_url("/")?>">推動流程</a></li>
            <li><a class="nav-item" href="<?=site_url("/")?>">各區推動概況</a></li>
            <li><a class="nav-item" href="<?=site_url("/")?>">票選系統</a></li>
            <li><a class="nav-item" href="<?=site_url("/welcome/QA")?>"> Q &amp; A</a></li>
            <li><a class="nav-item" href="<?=site_url("/")?>"> 歷年提案 </a></li>
            <li><a class="nav-item" href="<?=site_url("/")?>"> 記錄區 </a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>

