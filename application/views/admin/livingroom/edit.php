<?php include(__DIR__."/../../_admin_header.php"); ?>

<?php function css_section(){ ?> 

  <link rel="stylesheet" href="<?=base_url("js/jquery-ui-1.12.1.custom/jquery-ui.min.css")?>" />
<?php } ?>
<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/member/index")?>">首頁</a> &gt; 
      <a href="<?=site_url("/admin/livingroom/")?>">客廳會記錄管理</a> &gt; 
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
            <td class="field col-xs-2" >地區</td>
            <td class="col-xs-10" colspan="2">
              <?php _render_area_select("area",$news->area); ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >提案分類</td>
            <td class="col-xs-10" colspan="2">
              <?php _render_select(_get_case_types(),"type",$news->type) ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >記錄日期</td>
            <td class="col-xs-10" colspan="2">
              <input class="datepicker" type="text" name="record_date" value="<?=_date_format_utc($news->record_date,"Y/m/d")?>" />
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >記錄地點</td>
            <td class="col-xs-10" colspan="2">
              <input type="text" style="width:100%;" name="location" value="<?=h($news->location)?>"/>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >參與訪談者</td>
            <td class="col-xs-10" colspan="2">
              <input type="text" style="width:100%;" name="interviewer" value="<?=h($news->interviewer)?>"/>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >工作人員</td>
            <td class="col-xs-10" colspan="2">
              <input type="text" style="width:100%;" name="worker" value="<?=h($news->worker)?>"/>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >訪談內容</td>
            <td class="col-xs-10" colspan="2">
              <textarea class="tinymce" name="content" style="width:100%; height:400px;resize:vertical;"><?=h($news->content)?></textarea>
            </td>
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

<script src="<?=base_url("js/tinymce/tinymce.min.js")?>"></script>
<script src="<?=base_url("js/tinymce/jquery.tinymce.min.js")?>"></script>


<script>$( ".datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});</script>


<script type="text/javascript">

tinymce.init({
    selector: ".tinymce",
    language : 'zh_TW',
    content_css : "/css/custom_content.css",
    fontsize_formats: "12px 14px 16px 18px 20px 24px 26px 28px 30px 32px 34px 36px",
    plugins: [
        "nadminimage advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect fontselect | fontsizeselect | bold italic | "+
      " alignleft aligncenter alignright alignjustify  ",
    font_formats: "微軟正黑體=微軟正黑體;新細明體=新細明體;標楷體=標楷體,Andale Mono=andale mono,times;"+
        "Arial=arial,helvetica,sans-serif;"+
        "Arial Black=arial black,avant garde;",        
    toolbar2: "bullist numlist outdent indent | link image media | forecolor backcolor emoticons | nadminimage",
    image_advtab: true,
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
 });
</script>
<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>