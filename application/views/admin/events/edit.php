<?php include(__DIR__."/../../_admin_header.php"); ?>


<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <a href="<?=site_url("/events/")?>">活動管理</a> &gt; 
      <span class="now"><?=h($news->title)?></span>

    </div>

    <div class="col-md-10 col-md-offset-1">

    <form id="form" action="<?=$action?>" method="post">
    <div id="member_all">
     <div class="form_post">
        <hr style="clear:both;margin-top:20px;" />
        <table class="table table-bordered">
          <tbody><tr>
            <td class="field col-xs-2" >文章標題：</td>
            <td class="col-xs-10" colspan="2"><input  style='width:100%;' type="text" name="title" value="<?=h($news->title)?>" class="title"></td>
          </tr>


          <tr>
            <td class="col-xs-10" colspan="2"> 
              <textarea class="tinymce" name="content" style="width:770px; height:600px;resize:vertical;"><?=h($news->content)?></textarea>
            </td>
          </tr>
          <?php if(0){ ?>
          <tr>
            <td height="20px;" style="padding-top:30px;">&nbsp;</td>
            <td colspan="2"><div class="button_upload" style="float:left; margin-top:10px;"><a href="">插入圖檔</a></div><div style="padding-left:150px; font-size:12px; color:#aeaeae; letter-spacing:0.5px; line-height:20px;">先將游標停在想要插入圖檔的段落，再點選上傳圖檔即可。<br>若要改變圖檔在內文中顯示的大小，點一下圖檔反白，可用滑鼠拉動圖檔邊角調整。</div></td>
          </tr>
            
          <tr>
            <td height="20px;" style="padding-top:80px;">&nbsp;</td>
            <td colspan="2">插入影片： <input type="text" name="youtube" class="youtube"><span style="padding-left:20px; font-size:12px; color:#aeaeae; letter-spacing:0.5px; line-height:20px;">請將影片先上傳至youtube，再貼上該影片的youtube連結。</span></td>
          </tr>
            <?php } ?>
            
            <!--
            <tr>
              <td>發佈</td>
              <td>
                <label><input <?=$news->status == 1 ?"checked":""?> type="radio" value="1" name="status">發佈</label>
                <label><input <?=$news->status == 0 ?"checked":""?> type="radio" value="0" name="status">下架</label>
              </td>
            </tr>
            -->
        </tbody>
      </table>

    </div>
    <div class="button pull-right" >
      <input type="hidden" name="postid" value="<?=h($news->id)?>" />
      <?php if(0) { ?>  <a href="">預覽</a>&nbsp;&nbsp;&nbsp; 
      <button onclick="$('#form').attr('action','<?=site_url("member/posting/0")?>')" class="btn">暫存</button>&nbsp;&nbsp;&nbsp;
      <?php } ?>
      <button class="btn-primary btn">發布</button>&nbsp;&nbsp;&nbsp;
      <a href="<?=admin_url("events")?>">返回</a>
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
    content_css : "/css/custom_content.css",
    selector: ".tinymce",
    language : 'zh_TW',
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