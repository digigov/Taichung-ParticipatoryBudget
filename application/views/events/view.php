<?php include(__DIR__."/../_header.php"); ?>


<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <a href="<?=site_url("/news/")?>">最新消息</a> &gt; 
      <span class="now"><?=h($news->title)?></span>

    </div>

    <div class="col-md-10 col-md-offset-1">
      <table class="table table-bordered table-striped ">
        <thead class="thead-inverse">
          <tr>
            <th class="category"> [<?=h($news->category)?>] </th>
            <th><?=h($news->title)?></th>
            <th><?=_date_format_utc($news->publish_date,"Y-m-d") ?></th>
          </tr>
        </thead>

        <tr>
          <td colspan="3" >
            <div  class="word-content" style="min-height:400px;padding:10px;line-height:160%;">
              <?=$news->content?>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <div style="clear:both"></div>

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>