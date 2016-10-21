<?php include(__DIR__."/../../_admin_header.php"); ?>

<?php function css_section(){ ?> 

  <link rel="stylesheet" href="<?=base_url("js/jquery-ui-1.12.1.custom/jquery-ui.min.css")?>" />
<?php } ?>
<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/member/index")?>">首頁</a> &gt; 
      <a href="<?=site_url("/admin/sliders/")?>">輪播管理</a> &gt; 
      <span class="now"><?=$pageTitle?></span>

    </div>

    <div class="col-md-10 col-md-offset-1">

    <form id="form" action="<?=$action?>" enctype="multipart/form-data" method="post">
    <div id="member_all">
     <div class="form_post">
        <hr style="clear:both;margin-top:20px;" />
        <table class="table table-bordered">
          <tbody>

          <tr>
            <td class="field col-xs-2" >圖片替代文字</td>
            <td class="col-xs-10" colspan="2"><input  style='width:100%;' type="text" name="text" value="<?=h($news->text)?>" class="title"></td>
          </tr>
          <tr>

            <td class="field col-xs-2" >上傳新圖片</td>
            <td class="col-xs-10" colspan="2">

            <?php if($news->img_url != null){ ?>
              既有圖片：<br />
              <a href="<?=h($news->img_url)?>" target="_blank"><img src="<?=h($news->img_url)?>"  style='max-width:200px;max-height:200px;' /></a>
              <hr />
            <?php } ?>

              <input type="file" name="image" />
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >連結網址</td>
            <td class="col-xs-10" colspan="2">
              <input type="text" style="width:100%;" name="url" value="<?=h($news->url)?>"/>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >上架時間</td>
            <td class="col-xs-10" colspan="2">
              <input class="datepicker" type="text" name="start_time" value="<?=_date_format_utc($news->start_time,"Y/m/d")?>" />
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >下架時間</td>
            <td class="col-xs-10" colspan="2">
              <input class="datepicker" type="text" name="end_time" value="<?=_date_format_utc($news->end_time,"Y/m/d")?>"  />
            </td>
          </tr>
          <tr>
            <td>啟用</td>
            <td>
              <label><input <?=$news->status == 1 ?"checked":""?> type="radio" value="1" name="status">啟用</label>
              <label><input <?=$news->status == 0 ?"checked":""?> type="radio" value="0" name="status">草稿</label>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
    <div class="button pull-right" >
      <input type="hidden" name="id" value="<?=h($news->id)?>" />
      <?php if(0) { ?>  <a href="">預覽</a>&nbsp;&nbsp;&nbsp; 
      <button onclick="$('#form').attr('action','<?=site_url("member/posting/0")?>')" class="btn">暫存</button>&nbsp;&nbsp;&nbsp;
      <?php } ?>
      <button class="btn-primary btn">存檔</button>&nbsp;&nbsp;&nbsp;
      <a href="<?=admin_url("sliders")?>">返回</a>
    </div>
  </form>
        <br />
      <br />
      <br />
      <br />
      
</div>

    <div style="clear:both"></div>

  </div>
</div>

<?php function js_section(){ ?>
  
<script src="<?=base_url("js/jquery-ui-1.12.1.custom/jquery-ui.min.js")?>"></script>

<script>$( ".datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});</script>
<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>