<?php include(__DIR__."/../_header.php"); ?>

<style>
  .question{
    font-size:24px;
  }
  .answer{
    font-size:16px;
  }
  .answer-highlight{
    font-size:24px;
    color:rgb(14,115,185);
  }
</style>
<div class="container page-records">
  <div >
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <span class="now">  工作成果與提案記錄 - <?=$year?>   </span> 
    </div>

    <div class="col-md-12 " style="min-height:400px;">

      <h3>該年度各區域提案紀錄</h3>
      <ul style='margin-top:30px;'>
            <?php 
              $year_ind = 0;
              foreach($_areas as $_area){
                if(!isset($_area->years) || $_area->years == null || !isset($_area->years->$year) ){
                  continue;
                }
                $year_ind++;
              ?>
        <li style='min-height:50px;'><a style='font-size:20px;' href="<?=site_url("/areas/view/".rawurlencode($_area->name)."/".$year)?>"><?=$_area->name?></a></li>
        <?php } ?>
        
        <?php if($year_ind == 0) { ?>
          <li>無區域提案紀錄</li>
        <?php } ?>
      </ul>
      <hr />
    </div>

	<?php if (0){ ?>
    <div class="col-md-12 records" style="">
      <?php foreach(_get_record_types() as $ind => $record){ 
        ?>
      <div class="col-md-4 <?=$record->enable?"record-enabled":""?>">
      <?php if($record->enable){ ?>
        <a href="/records/<?=$record->key?>/index/<?=$year?>">
      <?php } ?>
        <div class="<?=$ind%2== 0 ? "record-odd":"record-even"?> record record-<?=$ind?> col-md-12" >
          <div class="background"></div>
          <div class="icon"><img src="<?=base_url("img/records/".$record->key.".png")?>" alt="<?=h($record->name)?>" /></div>
          <div class="name">「<?=h($record->name)?>」</div>
        </div>
      <?php if($record->enable){ ?>
        </a>
      <?php } ?>
      </div>
      <?php } ?>
    </div>
    <div style="clear:both"></div>
	<?php }?>
  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>
