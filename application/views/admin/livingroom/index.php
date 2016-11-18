<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
    <h1><?=$now_area?> 的查詢記錄</h1>
    <p>
      看看其他區域：
        <a href="<?=site_url("/admin/livingroom")
          ?>">全部</a>        
        <?php foreach(_get_areas() as $area){ ?>
        、<a href="<?=site_url("/admin/livingroom").
          "?area=".$area?>"><?=$area?></a>
        <?php }?>

    </p>
    <table class="table table-bordered">
      <tr>
        <td>#</td>
        <td>狀態</td>
        <td>區域</td>
        <td>類別</td>     
        <td>日期</td>
        <td>地點</td>
        <td>訪談者</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach($all_items as $ind => $item){  ?>
      <tr>
        <td><?=$ind +1 ?></td>
        <td>
          <?=$item->status=="1" ?"啟用":"草稿"?>
        </td>
        <td><?=h($item->area)?></td>
        <td>
          <?=h($item->type)?>
        </td>
        <td>
          <a href="<?=h($item->id)?>" target="_blank">
            <?=_date_format_utc($item->record_date)?>
          </a>
        </td>
        <td>
          <?=h($item->location)?>
        </td>
        <td>
          <?=h($item->interviewer)?>
        </td>
        <td>
          <a class="btn btn-default" href="<?=admin_url("livingroom/edit/".$item->id)?>">編輯</a>

          <a class="btn btn-default" href="<?=admin_url("livingroom/delete/".$item->id)?>">刪除</a>
        </td>
      </tr>
    <?php }?>
    </table>
    
    <div style="clear:both"></div>
    <a href="<?=admin_url("livingroom/add")?>" class="btn btn-default">新增客廳會記錄</a>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>