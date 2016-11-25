<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
    <h1><?=$now_area?> 審議主持人培訓查詢記錄</h1>
    <!-- <p> 
      看看其他區域：
        <a href="<?=site_url("/admin/hosttrain")
          ?>">全部</a>        
        <?php foreach(_get_areas() as $area){ ?>
        、<a href="<?=site_url("/admin/hosttrain").
          "?area=".$area?>"><?=$area?></a>
        <?php }?>
    </p> -->
    <table class="table table-bordered">
      <tr>
        <td>#</td>
        <td>培訓名稱</td>
        <td>日期時間</td>
        <td>地點</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach($all_items as $ind => $item){  ?>
      <tr>
        <td><?=$ind +1 ?></td>
        <td>
          <?=$item->status=="1" ?"啟用":"草稿"?>
        </td>
        <td>
          <?=_date_format_utc($item->record_date)?>
        </td>
        <td>
          <?=h($item->location)?>
        </td>
        <td>
          <a class="btn btn-default" href="<?=admin_url("hosttrain/edit/".$item->id)?>">編輯</a>

          <a class="btn btn-default" href="<?=admin_url("hosttrain/delete/".$item->id)?>">刪除</a>
        </td>
      </tr>
    <?php }?>
    </table>
    
    <div style="clear:both"></div>
    <a href="<?=admin_url("hosttrain/add")?>" class="btn btn-default">新增主持人記錄</a>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>