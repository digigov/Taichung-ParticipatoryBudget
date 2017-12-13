<?php include(__DIR__."/_header.php"); ?>
<?php function css_section(){ ?>
<?php } ?>

<div class="container" style="max-width:960px;margin:0 auto;">
  
  <?php if(count($slides) > 0){ ?>
  <div class="slides" style="background:rgb(128,208,205);">

    <div id="slides">
      <?php 
      shuffle($slides);
      if(count($slides) == 1){
        $slides[] = $slides[0];
      }
      foreach($slides as $slide) { ?>
        <a href="<?=$slide->url?>"><img style='width:100%;' alt="<?=$slide->text?>" src="<?=h($slide->img_url)?>" /></a>
      <?php } ?>

      <a href="#" class="slidesjs-previous slidesjs-navigation"> 
        <img src="<?=base_url("img/arrow_left.png")?>" />
      </a>
      <a href="#" class="slidesjs-next slidesjs-navigation"> 
        <img src="<?=base_url("img/arrow_right.png")?>" />
      </a>
    </div>
  </div>
  <?php } ?>
  <div class="content-introduce">
    <a href="<?=site_url("/introduce")?>"><img style="width:100%;" src="<?=base_url("img/introduce.png")?>" /></a>
    <div style='clear:both;'></div>
  </div>
  <div class="cube cube-text cube-active cube-blue">
    <div class="cube-title">
      活動快訊
    </div>
    <div class="cube-cover">
    </div>
    <div class="cube-content-container">
      <div class="cube-content-pre ">
      </div>
      <div class="cube-content">
        <?php foreach($latest_news as $news){ ?> 
          <a href="<?=site_url("/news/view/".$news->id)?>">
            <div class="news">
              <div class="news-title"> 
                <?=h($news->title)?>
              </div>
              <div class="news-desc"> 
                <?=h(_truncate(strip_tags($news->content),30))?>
              </div>
              <div class="news-date"> 
                <?=_date_format_utc($news->publish_date,"Y-m-d") ?>
              </div>
            </div>
          </a>
          <br />
        <?php } ?>
      </div>
      <div class="cube-content-after">
      </div>
    </div>
    <div class="cube-thumb">
      <a href="<?=site_url("/news")?>">
        <img class="on-active" alt="相關新聞" src="<?=base_url("img/home_news_close.png")?>" />
        <img class="on-inactive"  alt="相關新聞" src="<?=base_url("img/home_news.png")?>" />
      </a>
    </div>
  </div>
  <?php if(0){ ?>
  <div class="cube cube-red">
    <div class="cube-title">
      今年推動流程
    </div>
    <div class="cube-content-all">
      <div class="cube-cover">
        <a href="<?=site_url("/process")?>"><img alt="今年推動流程" src="<?=base_url("img/home_this_year.png")?>" /></a>
      </div>
      <div class="cube-content-container">
        <div class="cube-content-pre ">
        </div>
        <div class="cube-content">
          <a href="<?=site_url("/process")?>"><img src="<?=base_url("img/home_this_year_content.png")?>" /></a>
        </div>
        <div class="cube-content-after">
        </div>
      </div>
    </div>
    <div class="cube-thumb">
      <a href="<?=site_url("/process")?>">
        <img class="on-inactive"  alt="工作成果" src="<?=base_url("img/home_work_result.png")?>" />
        <img class="on-active" alt="工作成果" src="<?=base_url("img/home_work_close.png")?>" />

      </a>
    </div>
  </div>
  <?php } ?>
  

  <div class="cube cube-orange">
    <div class="cube-title">
      歷年提案
    </div>
    <div class="cube-content-all">
      <div class="cube-cover">
        <a target="_blank" href="http://2015taichungivoting.weebly.com/"><img alt="歷年提案" src="<?=base_url("img/home_past_cases_cover.png")?>" /></a>
      </div>
      <div class="cube-content-container">
        <div class="cube-content-pre ">
        </div>
        <div class="cube-content">
          <a target="_blank" href="http://2015taichungivoting.weebly.com/">
            <img alt="歷年提案" src="<?=base_url("img/home_past_cases.png")?>" />

          </a>
        </div>
        <div class="cube-content-after">
        </div>
      </div>
    </div>
    <div class="cube-thumb">
      <a href="<?=site_url("/areas/map")?>">
        <img class="on-active" alt="區域地圖" src="<?=base_url("img/home_map.png")?>" />
        <img class="on-inactive" alt="區域地圖" src="<?=base_url("img/home_area_map.png")?>" />
      </a>
    </div>
  </div>
  <div class="related-link">
    <a href="<?=site_url("links")?>" >
      -友站連結-
    </a>
  </div>
  

</div>

<?php function js_section(){ ?>
<script src="<?=base_url("/js/jquery.slides.min.js")?>"></script>
<script>
  $('#slides').slidesjs({
    width: 930,
    height:465,
    navigation: false,
    play: {
      active: true,
      effect: "slide",
      interval: 5000,
      auto: true,
        // [boolean] Start playing the slideshow on load.
      swap: true,
        // [boolean] show/hide stop and play buttons
      pauseOnHover: true,
        // [boolean] pause a playing slideshow on hover
      restartDelay: 2500
        // [number] restart delay on inactive slideshow
    }
  });
</script>
<?php } ?>

<?php include(__DIR__."/_footer.php"); ?>