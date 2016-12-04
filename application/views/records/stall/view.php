<?php include(__DIR__."/../../_header.php"); ?>

<style>
  .table *{
    font-size:18px;
  }
  .table .title{
    
  }
</style>

<div class="container page-livingroom-view">
  <div  style="min-height:450px;">
    <?=_render_breadcrumb($breadcrumb)?>
    
    <div class="record-container clearfix">
      <div class="col-md-12 clearfix">
        <div class="row">
          <div class="col-xs-12 record-header">
            <div class="col-xs-2">
              名稱
            </div>
            <div class="col-xs-10">
              <?=h($item->title)?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 record-header">
            <div class="col-xs-2">
              日期
            </div>
            <div class="col-xs-10">
              <?=_date_format_utc($item->record_date,"Y-m-d")?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 record-header">
            <div class="col-xs-2">
              地點
            </div>
            <div class="col-xs-10">
              <?=h($item->location)?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 record-header">
            <div class="col-xs-12 header-text">
              簡介
            </div>
            <div class="col-xs-12 record-content">
              <br />
              <?=($item->content)?>
            </div>
          </div>
        </div>
        <?php 
        if(count($images) > 0 ){ ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="col-xs-12 header-text">
              活動照片
            </div>
            <div class="col-xs-12 row">
              <?php foreach($images as $image){ ?>
                <div class="col-xs-6">
                  <a href="<?=$image->url?>" target="_blank" class="thumbnail">
                    <img src="<?=$image->url?>" alt="活動照片">
                  </a>
                </div>              
              <?php } ?>
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