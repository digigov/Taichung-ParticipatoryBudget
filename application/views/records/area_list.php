<?php include(__DIR__."/../_header.php"); ?>

<style>
  .table *{
    font-size:18px;
  }
  .table .title{
    
  }
</style>

<div class="container page-area-list">
  <div  style="min-height:450px;">
    <?=_render_breadcrumb($breadcrumb)?>
    
    <div class=" area-container clearfix">
      <div class="col-xs-12 area-header">
        <img src="<?=base_url("img/records/".$record->key.".png")?>" alt="<?=h($record->name)?>" />
        &nbsp;
        「<?=$record->name?>」
      </div>

      <div class="area-items col-xs-12">
        <?php foreach($areas as $ind => $area){ ?>
        <a href="<?=$area->link?>">
          <div class="col-xs-6 col-md-3 area-item area-item-bg-<?=$ind %4 ?>">
            <div class="area-item-header"><?=$area->city?><br /><?=$area->name?>(<?=$area->cnt?>)</div>
            <div class="area-item-photo">
              <img src="<?=$area->pic?>" alt="<?=$area->city.$area->name?>" />
            </div>
          </div>
        </a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>