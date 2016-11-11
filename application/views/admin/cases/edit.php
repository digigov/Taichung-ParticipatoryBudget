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
            <td class="field col-xs-2" >提案編號</td>
            <td class="col-xs-10" colspan="2">
              <input type="text" name="caseno" value="<?=h($news->caseno)?>" />
            </td>
          </tr>
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
              <?php _render_area_select("area",$news->area) ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >提案分類</td>
            <td class="col-xs-10" colspan="2">
              <?php _render_select(_get_case_types(),"type",$news->type) ?>
            </td>
          </tr>

          <tr>
            <td class="field col-xs-2" >發佈日期</td>
            <td class="col-xs-10" colspan="2"><input class="datepicker" style='width:100%;' type="text" name="publish_date" value="<?=_date_format_utc($news->publish_date,"Y/m/d")?>" class="title"></td>
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
            <td class="field col-xs-2" >預算內容</td>
            <td class="col-xs-10" colspan="2">

            <textarea class="tinymce" name="budget_desc" style="width:770px; height:200px;resize:vertical;"><?=h($news->budget_desc)?></textarea>
            </td>
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
            <td class="field col-xs-2" >地圖網址</td>
            <td class="col-xs-10" colspan="2">
              <textarea class="tinymce" name="location_urls" style="width:770px; height:400px;resize:vertical;"><?=h($news->location_urls)?></textarea>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >海報照片</td>
            <td class="col-xs-10" colspan="2">
              <input type="file" name="dm_file" />
              <?php if($news->dm_file != null){ ?>
                <hr />
                <a href="<?=$news->dm_file?>" target="_blank"> 下載已上傳檔案</a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >住民會議提案</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_source" value="1" <?=$news->step_source?"checked":""?> />
              啟用<input type="file" name="step_source_files" />

              <?php if($news->step_source_files != null){ ?>
                <hr />
                <a href="<?=$news->step_source_files?>" target="_blank"> 下載已上傳檔案</a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >專家學者意見</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_expert" value="1" <?=$news->step_expert?"checked":""?> />
              啟用<input type="file" name="step_expert_files" />
              
              <?php if($news->step_expert_files != null){ ?>
                <hr />
                <a href="<?=$news->step_expert_files?>" target="_blank"> 下載已上傳檔案</a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >第一階段 ivoting</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_ivoting_1" value="1" <?=$news->step_ivoting_1?"checked":""?> />
              啟用<input type="file" name="step_ivoting_1_files" />
              <?php if($news->step_ivoting_1_files != null){ ?>
                <hr />
                <a href="<?=$news->step_ivoting_1_files?>" target="_blank"> 下載已上傳檔案</a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >第二階段 ivoting</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_ivoting_2" value="1" <?=$news->step_ivoting_2?"checked":""?> />
              啟用<input type="file" name="step_ivoting_2_files" />
              <?php if($news->step_ivoting_2_files != null){ ?>
                <hr />
                <a href="<?=$news->step_ivoting_2_files?>" target="_blank"> 下載已上傳檔案</a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >優先執行</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_advance" value="1" <?=$news->step_advance?"checked":""?> />
              啟用<input type="file" name="step_advance_files" />
              <?php if($news->step_advance_files != null){ ?>
                <hr />
                <a href="<?=$news->step_advance_files?>" target="_blank"> 下載已上傳檔案</a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >執行進度</td>
            <td class="col-xs-10" colspan="2"><input type="checkbox" name="step_running" value="1" <?=$news->step_running?"checked":""?> />
              啟用<input type="file" name="step_running_files" />
              <?php if($news->step_running_files != null){ ?>
                <hr />
                <a href="<?=$news->step_running_files?>" target="_blank"> 下載已上傳檔案</a>
              <?php } ?>
            </td>
          </tr>
          
        </tbody>
      </table>

    </div>
    <div class="button pull-right" >
      <input type="hidden" name="id" value="<?=h($news->id)?>" />
      <button class="btn-primary btn">存檔</button>&nbsp;&nbsp;&nbsp;
      <a href="<?=admin_url("cases")?>">返回</a>
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