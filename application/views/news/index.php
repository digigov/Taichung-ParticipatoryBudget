<?php include(__DIR__."/../_header.php"); ?>

<style>
  .table *{
    font-size:18px;
  }
  .table .title{
    
  }
</style>

<div class="container page-news">
  <div  style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      最新消息 &gt; 
      <span class="now">相關新聞</span>
    </div>
    
    <div class="news-list clearfix">
      <div class="col-md-2 labels">
        <h3>歷年新聞</h3>
        <ul>
          <?php foreach($_years as $year){ ?>
          <li><a style='width:100%;' class="label-1" href="/news/list/<?=$year?>" /><?=$year?></a></li>
          <?php } ?>
          <!-- <li class="label-1">培訓</li>
          <li class="label-2">說明會</li>
          <li class="label-3">推廣活動</li>
          <li class="label-1">住民會議</li> -->
        </ul>
      </div>
      <div class="col-md-10 news-items clearfix">
        <h3><?=$current_year?>年最新消息</h3>

        <?php if(count($all_news) == 0){ ?>
          <p><?=$current_year?> 年該年度尚無最新消息</p>
        <?php }?>

        <?php foreach($all_news as $new){ ?>

        <div class="news-item row">
          <div class="col-xs-2 img">
            <a  href="<?=site_url("news/view/".$new->id)?>"><img style='width:100%;' alt="<?=h($new->title)?> 照片" src="<?=_get_news_image_url($new->image)?>" /></a>
          </div>
          <div class="col-xs-10 content-container">
            <div class="title" ><a  href="<?=site_url("news/view/".$new->id)?>"><?=h($new->title)?></a>
              <span class="pull-right"><?=_date_format_utc($new->publish_date,"Y-m-d")?></span>
            </div>
            <div class="content">
              <a  href="<?=site_url("news/view/".$new->id)?>"><?=_truncate(strip_tags($new->content),60)?></a>
            </div>
          </div>
        </div>
        <?php } ?>
      
    </div>
  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>