<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
    <h1><?=h($name)?> 頁面資料編輯 </h1>

    <h2>請選擇年份</h2>
    <table class="table table-bordered">
      <tr>
        <td>年份</td>
        <td>&nbsp;</td>
      </tr>
    <?php foreach(_get_years() as $ind => $year){  ?>
      <tr>
        <td><?=h($year)?></td>
        <td>
          <a class="btn btn-default" href="<?=admin_url("page/build/?name=".h($name)."&key=".h($key)."&year=".h($year))?>">建立或編輯</a>
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