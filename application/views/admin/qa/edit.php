<?php include(__DIR__."/../../_admin_header.php"); ?>

<?php function css_section(){ ?> 

  <link rel="stylesheet" href="<?=base_url("js/jquery-ui-1.12.1.custom/jquery-ui.min.css")?>" />
<?php } ?>
<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/member/index")?>">首頁</a> &gt; 
      <a href="<?=site_url("/admin/qa/")?>">QA管理</a> &gt; 
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
            <td class="field col-xs-2" >標題</td>
            <td class="col-xs-10" colspan="2"><input  style='width:100%;' type="text" name="question" value="<?=h($news->question)?>" class="title"></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >回答</td>
            <td class="col-xs-10" colspan="2">
            <textarea class="tinymce" name="answer" style="width:770px; height:400px;resize:vertical;"><?=h($news->answer)?></textarea>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
    <div class="button pull-right" >
      <input type="hidden" name="id" value="<?=h($news->id)?>" />
      <button class="btn-primary btn">存檔</button>&nbsp;&nbsp;&nbsp;
      <a href="<?=admin_url("/qa")?>">返回</a>
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

<script>$( ".datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});</script>
<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>