<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
  
    <table class="table table-bordered">
      <tr>
        <td>#</td>
        <td>分類</td>
        <td>標題</td>
        <td>發佈時間</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach($all_news as $ind => $new){  ?>
      <tr>
        <td><?=$ind +1 ?></td>
        <td>
          <?=h($new->category)?>
        </td>
        <td>
          <?=h($new->title)?>
        </td>
        <td>
          <?=_date_format_utc($new->publish_date) ?>
        </td>
        <td>
          <a class="btn btn-default" href="<?=admin_url("news/edit/".$new->id)?>">編輯</a>

          <a class="btn btn-default" href="<?=admin_url("news/delete/".$new->id)?>">刪除</a>
        </td>
      </tr>
    <?php }?>
    </table>
    
    <div style="clear:both"></div>
    <a href="<?=admin_url("news/add")?>" class="btn btn-default">新增新聞</a>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>