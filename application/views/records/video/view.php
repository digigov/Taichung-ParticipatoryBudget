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
              <?=_date_format_utc($item->publish_date,"Y-m-d")?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 record-header">
            <div class="col-xs-12 header-text">
              內容
            </div>
            <div class="col-xs-12 record-content">
              <br />
              <?=($item->content)?>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_footer.php"); ?>