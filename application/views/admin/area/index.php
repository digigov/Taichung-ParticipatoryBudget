<?php include(__DIR__."/../../_admin_header.php"); ?>

<div class="container">
    <h1>所有區域記錄</h1>
    <table class="table table-bordered">
      <tr>
        <td>#</td>
        <td>縣市名稱</td>
        <td>區域名稱</td>
        <td>建立日期</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach($all_items as $ind => $item){  ?>
      <tr>
        <td><?=$ind +1 ?></td>
        <td>
          <?=h($item->city)?>
        </td>
        <td>
          <?=h($item->name)?>
        </td>
        <td>
          <?=_date_format($item->ctime)?>
        </td>
        <td>
          <a class="btn btn-default" href="<?=admin_url($_type."/edit/".$item->id)?>">編輯</a>

         <!--  <a class="btn btn-default" href="<?=admin_url($_type."/delete/".$item->id)?>">刪除</a> -->
        </td>
      </tr>
    <?php }?>
    </table>
    
    <div style="clear:both"></div>
    <a href="<?=admin_url($_type."/add")?>" class="btn btn-default">新增<?=$_name?></a>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>