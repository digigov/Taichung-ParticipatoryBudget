<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
  <div class="content-list">

    <div class="col-md-10 col-md-offset-1">

    <form id="form" action="<?=$action?>" method="post">
    <div id="member_all">
     <div class="form_post">
        <hr style="clear:both;margin-top:20px;" />
        <?php if($ok == "1"){ ?>
        <div class="alert alert-info">存檔成功</div>
        <?php } ?>
        <table class="table table-bordered">
          <tbody>
          <?php if($news->year != -1){ ?>
          <tr>
            <td class="field col-xs-2" >年度</td>
            <td class="col-xs-10" colspan="2">
              <?=h($news->year)?>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td class="field col-xs-2" >頁面名稱</td>
            <td class="col-xs-10" colspan="2">
              <?=h($news->name)?>
            </td>
          </tr>
          <tr>
            <td class="col-xs-10" colspan="2"> 
              <textarea class="tinymce" name="content" style="width:770px; height:600px;resize:vertical;"><?=h($news->content)?></textarea>
            </td>
          </tr>

        </tbody>
      </table>

    </div>
    <div class="button pull-right" >
      <input type="hidden" name="name" value="<?=h($news->name)?>" />
      <input type="hidden" name="year" value="<?=h($news->year)?>" />
      <input type="hidden" name="key" value="<?=h($news->key)?>" />
      <button class="btn-primary btn">發布</button>&nbsp;&nbsp;&nbsp;
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

<script src="<?=base_url("js/tinymce/tinymce.min.js")?>"></script>
<script src="<?=base_url("js/tinymce/jquery.tinymce.min.js")?>"></script>

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