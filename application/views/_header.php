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

    <!--給FB看的設定-->
    <?php if(isset($og_image)){ ?>
<meta property="og:image" content="<?=$og_image?>" />
    <?php } ?>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="<?=base_url("bootstrap/css/bootstrap.min.css")?>" />

  <link rel="stylesheet" href="<?=base_url("bootstrap/css/bootstrap-theme.min.css")?>" />
  
  <link rel="stylesheet" href="<?=base_url("css/main.css")?>" />
  <style>

      .logo-img{
        width:40%;max-width:100%;display:block;margin:0 auto;
      }
      
      @media only screen and (max-device-width: 500px) {
        .logo-img{
          max-width:100%;
          width:auto;
        }
      }

  </style>

<?php if(function_exists("css_section")) {
  css_section();
  }?>
</head>
<body>
  
  <div class="container"  style="max-width:960px;margin:0 auto;">
    <div style="position:relative;min-height:117px;"> 
      <div style="width:100%;">
        <a href="<?=site_url("/")?>"><img class='logo-img' src="<?=base_url("img/header_logo.png")?>" /></a>
      </div>
    </div>

    <nav class="navbar navbar-default" style="margin-bottom:0;background:#d5edf7;border:none;">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" aria-expanded="true">
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
          <div class="nav-social">
              <a target="_blank" href="<?=site_url("https://www.facebook.com/pbtaichung/")?>"><img src="<?=base_url("img/social_fb.png")?>" /></a>
              <?php if(0){ ?>
              <a href="#"><img src="<?=base_url("img/social_gplus.png")?>" /></a>
              <a href="#"><img src="<?=base_url("img/social_twitter.png")?>" /></a>
              <a href="#"><img src="<?=base_url("img/social_plurk.png")?>" /></a>
              <?php } ?>
          </div>        
          <ul class="nav navbar-nav">

            <li class="dropdown">

              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 最新消息 </a>
              <ul class="dropdown-menu">
                <li><a class="nav-item" href="<?=site_url("/news")?>">相關新聞</a></li>
                <li><a class="nav-item"  href="<?=site_url("/events")?>">活動快訊</a></li>
              </ul>
            </li>

            <li class="dropdown">

              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">   認識參與式預算 </a>
              <ul class="dropdown-menu">
                <li><a class="nav-item" href="<?=site_url("/introduce")?>">何謂參與式預算</a></li>
                <li><a class="nav-item" href="<?=site_url("/process")?>">推動流程</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">105年提案</a>
              <ul class="dropdown-menu">
                <?php $areas_list = ["中區","大里區","清水區","豐原區"]; ?>
                <?php foreach($areas_list as $____area){ ?>
                <li><a class="nav-item"  href="<?=site_url("/areas/view/".$____area)?>"><?=$____area?></a></li>
                <?php } ?>
              </ul>

            </li>
            <li class="dropdown">
              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">各區推動概況</a>
              <ul class="dropdown-menu">
                <li>
                  <a class="nav-item" href="<?=site_url("areas/map")?>">地圖呈現</a>
                </li>
                <li class="divider">
                </li>
                <?php $areas_list = ["中區","大里區","清水區","豐原區"]; ?>
                <?php foreach($areas_list as $___area){ ?>
                <li><a class="nav-item"  href="<?=site_url("/areas/location/".$___area)?>"><?=$___area?></a></li>
                <?php } ?>
              </ul>
            </li>
            
  
            <!--
            <li><a class="nav-item" href="<?=site_url("/areas")?>">各區推動概況</a></li>
            -->
            <li><a class="nav-item" href="http://pb.taichung.gov.tw/news/view/34">票選系統</a></li>

            <li class="dropdown">
              <a href="#" class="nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">工作成果與提案記錄</a>
              <ul class="dropdown-menu">
                <li><a  class="nav-item"  href="<?=site_url("/record/year/2016")?>">2016</a></li>
                <li><a  class="nav-item"  href="http://2015taichungivoting.weebly.com/">2015</a></li>
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
    <div class="search-container">
      <div class="search">
        <gcse:search></gcse:search>
      </div>
    </div>
  </div>
