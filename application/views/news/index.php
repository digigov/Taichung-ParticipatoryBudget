<?php include(__DIR__."/../_header.php"); ?>

<style>
  .table *{
    font-size:18px;
  }
  .table .title{
    
  }
</style>

<div class="container">
  <div class="content-list" style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <a href="<?=site_url("/news")?>">最新消息</a> &gt; 
      <span class="now">相關新聞</span>
    </div>

    <table class="table table-bordered table-striped">
      <thead class="thead-inverse">
        <tr>
          <th style="width:120px;text-align:center;">公告類別</th>
          <th>公告事項</th>
          <th>公告日期</th>
          <th>閱讀數</th>
        </tr>
      </thead>

      <?php foreach($all_news as $new){ ?>

      <tr>
        <td style="text-align:center;" class="category">[<?=h($new->category)?>]</td>
        <td class="title"><a style='color:black;' href="<?=site_url("news/view/".$new->id)?>"><?=h($new->title)?></a></td>
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