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
    label{
      padding:10px;
      border:1px solid black;
      border-radius: 5px;
      cursor:pointer;
    }

.navbar-nav>li>.dropdown-menu{
  max-height: 300px;
  overflow: scroll;
}

  </style>

<?php if(function_exists("css_section")) {
  css_section();
  }?>
</head>
<body class="jq">
  


  <div class="container">
    <nav class="navbar navbar-default" >
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
          <ul class="nav navbar-nav" style="">
            <li><a href="<?=site_url("/")?>">網站首頁</a></li>
          <?php if($is_login){ ?>
            <li class="dropdown">
              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                首頁與新聞內容管理
              </a>
              <ul class="dropdown-menu">
                <li><a class="nav-item" href="<?=site_url("/admin/news")?>">最新消息管理</a></li>
                <li><a class="nav-item" href="<?=site_url("/admin/events")?>">活動快訊管理</a></li>
                <li><a class="nav-item" href="<?=site_url("/admin/sliders")?>">輪播管理</a></li>
                <li><a class="nav-item" href="<?=site_url("/admin/qa")?>">QA 管理</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="<?=site_url("/admin/cases")?>" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">提案管理</a>
              <ul class="dropdown-menu">
                <?php foreach($_areas as $area){ ?>
                <li><a href="<?=site_url("/admin/cases/area/".$area->id)?>"><?=h($area->name)?></a></li>
                <?php } ?>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">記錄區管理</a>
              <ul class="dropdown-menu">
                <li><a href="<?=site_url("/admin/livingroom/")?>">客廳會紀錄管理</a></li>
                <li><a href="<?=site_url("/admin/hosttrain/")?>">主持人培訓記錄管理</a></li>
                <li><a href="<?=site_url("/admin/workshop/")?>">工作坊記錄管理</a></li>
                <li><a href="<?=site_url("/admin/seminar/")?>">地區說明會紀錄管理</a></li>
                <li><a href="<?=site_url("/admin/servant/")?>">公務員培訓紀錄管理</a></li>
                <li><a href="<?=site_url("/admin/speech/")?>">講座紀錄管理</a></li>
                <li><a href="<?=site_url("/admin/stall/")?>">擺攤紀錄管理</a></li>
              </ul>
            </li>
            <li><a href="<?=site_url("/admin/area/")?>">區域管理</a></li>
            <li><a class="nav-item" href="<?=site_url("/member/password")?>">變更密碼</a></li>
            <li><a class="nav-item" href="<?=site_url("/member/logout")?>">登出</a></li>
          <?php }else{ ?>
            <li><a class="nav-item" href="<?=site_url("/member/signin")?>">登入</a></li>
          <?php } ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>

