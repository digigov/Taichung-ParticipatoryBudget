<?php include(__DIR__."/../../_header.php"); ?>

<style>
  .table *{
    font-size:18px;
  }
  .table .title{
    
  }
</style>

<div class="container page-area-view">
  <div  style="min-height:450px;">
    <?=_render_breadcrumb($breadcrumb)?>
    
    <div class="news-list clearfix">
      <div class="col-md-12 news-items clearfix">
      
      <?php if(count($items) == 0){ ?>
      <p>暫無資料</p>
      <?php } ?>
      <?php foreach($items as $new){ ?>

        <div class="news-item row">
          <div class="col-xs-2 img">
            <a  href="<?=site_url("records/livingroom/view/".$new->id)?>"><img style='width:100%;' alt="<?=h($new->title)?> 照片" src="<?=_get_news_image_url($new->img_url)?>" /></a>
          </div>
          <div class="col-xs-10 content-container">
            <div class="title" ><a  href="<?=site_url("records/livingroom/view/".$new->id)?>">訪談者：<?=h($new->interviewer)?></a>
              <span class="pull-right"><?=_date_format_utc($new->record_date,"Y-m-d")?></span>
            </div>
            <div class="content">
              <a  href="<?=site_url("records/livingroom/view/".$new->id)?>"><?=_truncate(strip_tags($new->content),60)?>
                <br />
                <img width="30" src="<?="/img/icons/".$new->type.".png"?>" title="<?=h($new->type)?>"  alt="<?=h($new->type)?>" />
                <?=h($new->type)?>

              </a>
            </div>
          </div>
        </div>
      <?php } ?>
      
    </div>
  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_footer.php"); ?>