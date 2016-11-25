<?php include(__DIR__."/../_header.php"); ?>


<div class="container">
  <div class="content-list" style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <a href="<?=site_url("/news")?>">最新消息</a> &gt; 
      <span class="now">活動快訊</span>
      
    </div>

    <div class="event-list col-md-12">

      <?php 
      // for($i=0;$i<10;++$i){
      //   $all_news[] = $all_news[0];
      // }
      foreach($all_news as $new){ 
        ?>

      <div class="col-md-4 event-item-container">
        <a href="<?=site_url("events/view/".$new->id)?>">
          <div class="event-item">
            <p style='min-height:100px;'><img style='max-height: 100px;' src="<?=($new->image)?>" /></p>
            <h2><?=h($new->title)?></h2>
            <div><?=_truncate(strip_tags($new->content),30)?></div>
          </div>
        </a>
      </div>
      <?php } ?>
      <div style="clear:both"></div>
    </div>  
    <div style="clear:both"></div>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>