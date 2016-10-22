<?php include(__DIR__."/../../_admin_header.php"); ?>

<?php function css_section(){ ?> 

  <link rel="stylesheet" href="<?=base_url("js/jquery-ui-1.12.1.custom/jquery-ui.min.css")?>" />
<?php } ?>
<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/member/index")?>">首頁</a> &gt; 
      <a href="<?=site_url("/admin/cases/")?>">提案管理</a> &gt; 
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
            <td class="field col-xs-2" >提案年度</td>
            <td class="col-xs-10" colspan="2">
              <select name="year">
                <?php 
                $now_year = date("Y");
                for($ind=$now_year;$ind >= 2014 ; --$ind){
                ?>
                  <option <?=$ind==$news->year?"selected":""?>><?=$ind?></option>
                <?php
                }
                ?>
                
              </select>

            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >分區</td>
            <td class="col-xs-10" colspan="2">
              
              <select>
              <?php 
              $areas = ["中區", "東區", "南區", "西區", "北區", "西屯區", "南屯區", "北屯區", "豐原區", "東勢區", "大甲區", "清水區", "沙鹿區", "梧棲區", "后里區", "神岡區", "潭子區", "大雅區", "新社區", "石岡區", "外埔區", "大安區", "烏日區", "大肚區", "龍井區", "霧峰區", "太平區", "大里區", "和平區"];
              foreach($areas as $area){ ?>
                <option <?=$area==$news->area?"selected":""?>><?=$area?></option>
              <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >標題</td>
            <td class="col-xs-10" colspan="2"><input  style='width:100%;' type="text" name="name" value="<?=h($news->name)?>" class="title"></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >預算金額</td>
            <td class="col-xs-10" colspan="2"><input  style='width:100%;' type="text" name="budget" value="<?=h($news->budget)?>" class="title"></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >提案人</td>
            <td class="col-xs-10" colspan="2"><input  style='width:100%;' type="text" name="author" value="<?=h($news->author)?>" class="title"></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >目的</td>
            <td class="col-xs-10" colspan="2">

            <textarea class="tinymce" name="purpose" style="width:770px; height:400px;resize:vertical;"><?=h($news->purpose)?></textarea>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >內容</td>
            <td class="col-xs-10" colspan="2">
            <textarea class="tinymce" name="content" style="width:770px; height:400px;resize:vertical;"><?=h($news->content)?></textarea>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >專家學者市政顧問團建議</td>
            <td class="col-xs-10" colspan="2">
            <textarea class="tinymce" name="advice" style="width:770px; height:400px;resize:vertical;"><?=h($news->advice)?></textarea>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >住民會議提案</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_source" value="1" <?=$news->step_source?"checked":""?> /></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >專家學者意見</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_expert" value="1" <?=$news->step_expert?"checked":""?> /></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >第一階段 ivoting</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_ivoting_1" value="1" <?=$news->step_ivoting_1?"checked":""?> /></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >第二階段 ivoting</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_ivoting_2" value="1" <?=$news->step_ivoting_2?"checked":""?> /></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >優先執行</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_advance" value="1" <?=$news->step_advance?"checked":""?> /></td>
          </tr>
          <tr>
            <td class="field col-xs-2" >執行進度</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_running" value="1" <?=$news->step_running?"checked":""?> /></td>
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