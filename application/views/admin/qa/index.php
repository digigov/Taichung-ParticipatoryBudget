<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
  
    <table class="table table-bordered">
      <tr>
        <td>#</td>
        <td>問題</td>
        <td>新增日期</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach($all_items as $ind => $item){  ?>
      <tr>
        <td><?=$ind +1 ?></td>
        <td>
          <?=h($item->question)?>
        </td>
        <td>
          <?=_date_format_utc($item->ctime) ?>
        </td>
        <td>
          <a class="btn btn-default" href="<?=admin_url("qa/edit/".$item->id)?>">編輯</a>

          <a class="btn btn-default" href="<?=admin_url("qa/delete/".$item->id)?>">刪除</a>
        </td>
      </tr>
    <?php }?>
    </table>
    
    <div style="clear:both"></div>
    <a href="<?=admin_url("qa/add")?>" class="btn btn-default">新增問題 </a>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>