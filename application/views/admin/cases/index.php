<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
  <h1><?=h($pageTitle)?></h1>
  <table class="table table-bordered">
    <tr>
      <td>#</td>
      <td>提案年度</td>        
      <td>名稱</td>
      <td style="width:20%;">提案人</td>
      <td style="width:100px;">專家建議</td>
      <td>所屬局處</td>
      <td>建檔時間</td>
      <td>&nbsp;</td>
    </tr>
  <?php foreach($all_items as $ind => $item){  ?>
    <tr>
      <td><?=$ind +1 ?></td>
      <td><?=h($item->year)?></td>
      <td>
        <a href="<?=site_url("cases/view/".$item->id)?>"><?=h($item->name)?></a>
      </td>
      <td>
        <?=h($item->author)?>
      </td>
      <td>
        <a href="<?=admin_url("cases/advices/".$item->id)?>">
          建議管理(<?=$item->case_cnt?>)
        </a>
      </td>
      <td>
        <?=h($item->departname== null ?"尚未設定":$item->departname)?>
      </td>
      <td>
        <?=_date_format_utc($item->ctime) ?>
      </td>
      <td>
        <a class="btn btn-default" href="<?=admin_url("cases/edit/".$item->id)?>">編輯</a>

        <a class="btn btn-default" href="<?=site_url("admin/cases/preview/".$item->id)?>"> 預覽 </a> 

        <a class="btn btn-default" href="<?=admin_url("cases/delete/".$item->id)?>">刪除</a>
      </td>
    </tr>
  <?php }?>

  <?php if(trim($_SESSION["user"]->depart)!="" && count($all_items) == 0 ){ ?> 
      <tr><td colspan="12">您所屬局處尚無該區相關案件.</td></tr>
  <?php } ?>
  </table>
  
  <div style="clear:both"></div>
  <a href="<?=admin_url("cases/add")?>" class="btn btn-default">新增提案 </a>
  
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>