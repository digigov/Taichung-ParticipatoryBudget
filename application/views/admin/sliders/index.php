<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
  
    <table class="table table-bordered">
      <tr>
        <td>#</td>
        <td>啟用</td>        
        <td>圖片</td>
        <td>文字描述</td>
        <td>網址</td>
        <td>上架日期</td>
        <td>下架日期</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach($all_items as $ind => $item){  ?>
      <tr>
        <td><?=$ind +1 ?></td>
        <td>
          <?=$item->status=="1" ?"啟用":"草稿"?>
        </td>
        <td>
          <a href="<?=h($item->img_url)?>" target="_blank">
            <img style='width:300px' src="<?=h($item->img_url)?>" />
          </a>
        </td>
        <td>
          <?=h($item->text)?>
        </td>
        <td>
          <?=h($item->url)?>
        </td>
        <td>
          <?=_date_format_utc($item->start_time) ?>
        </td>
        <td>
          <?=_date_format_utc($item->end_time) ?>
        </td>
        <td>
          <a class="btn btn-default" href="<?=admin_url("sliders/edit/".$item->id)?>">編輯</a>

          <a class="btn btn-default" href="<?=admin_url("sliders/delete/".$item->id)?>">刪除</a>
        </td>
      </tr>
    <?php }?>
    </table>
    
    <div style="clear:both"></div>
    <a href="<?=admin_url("sliders/add")?>" class="btn btn-default">新增輪播</a>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>