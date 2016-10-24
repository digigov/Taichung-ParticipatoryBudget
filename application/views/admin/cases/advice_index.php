<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
    <div class="breadcrumb">
      <a href="<?=site_url("/member/index")?>">首頁</a> &gt; 
      <a href="<?=site_url("/admin/cases/")?>">提案管理</a> &gt;
      <a href="<?=site_url("/admin/cases/advices/".$case->id)?>">提案 #<?=$case->id?> 的建議清單 </a> &gt; 

    </div>


    <h1><?=$case->name?></h1>

    <h2>專家學者市政顧問團建議管理</h2>
  
    <table class="table table-bordered">
      <tr>
        <td>#</td>
        <td>審查者</td>
        <td>建檔時間</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach($all_items as $ind => $item){  ?>
      <tr>
        <td><?=$ind +1 ?></td>
        <td><?=h($item->name)?></td>
        <td>
          <?=_date_format_utc($item->ctime) ?>
        </td>
        <td>
          <a class="btn btn-default" href="<?=admin_url("cases/advice_edit/".$item->id)?>">編輯</a>

          <a class="btn btn-default" href="<?=admin_url("cases/preview/".$item->case_id)?>" > 預覽 </a> 

          <a class="btn btn-default" href="<?=admin_url("cases/advice_delete/".$item->id)?>">刪除</a>
        </td>
      </tr>
    <?php }?>
    </table>
    
    <div style="clear:both"></div>
    <a href="<?=admin_url("cases/advice_add/".$case->id)?>" class="btn btn-default">新增專家學者市政顧問團建議 </a>
    
    <a href="<?=admin_url("cases")?>" class="btn btn-default">
      返回提案管理清單
    </a>

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>