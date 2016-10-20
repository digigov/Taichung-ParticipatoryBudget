<?php include(__DIR__."/../_header.php"); ?>


<div class="container">
  <div class="content-list" style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <span class="now">今年提案</span>

    </div>

    <table class="table table-bordered table-striped">
      <thead class="thead-inverse">
        <tr>
          <th>提案類別</th>
          <th>提案名稱</th>
          <th>公告日期</th>
          <th>閱讀數</th>
        </tr>
      </thead>

      <?php foreach($all_news as $new){ ?>

      <tr>
        <td class="category">[<?=h($new->category)?>]</td>
        <td><a style='color:black;' href="<?=site_url("news/view/".$new->id)?>"><?=h($new->title)?></a></td>
        <td><?=_date_format_utc($new->publish_date,"Y-m-d")?></td>
        <td><?=h($new->clicks)?></td>
      </tr>
      <?php } ?>
    </table>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>