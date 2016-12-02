<?php include(__DIR__."/../../_admin_header.php"); ?>

<?php function css_section(){ ?> 

  <link rel="stylesheet" href="<?=base_url("js/jquery-ui-1.12.1.custom/jquery-ui.min.css")?>" />
  <link rel="stylesheet" href="<?=base_url("css/jquery.fileupload.css")?>">


<?php } ?>
<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/member/index")?>">首頁</a> &gt; 
      <a href="<?=site_url("/admin/".$_type)?>"><?=$_name?>記錄管理</a> &gt; 
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
            <td class="field col-xs-2" >年度</td>
            <td class="col-xs-10" colspan="2">
              <?php 
              $years = [];
              for($ind_y = date("Y"); $ind_y >= 2016;--$ind_y){
                $years[] = $ind_y;
              }
              _render_select($years,"year",$news->year);
              ?>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >講座名稱</td>
            <td class="col-xs-10" colspan="2">
              <input type="text" style="width:100%;" name="title" value="<?=h($news->title)?>"/>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >日期時間</td>
            <td class="col-xs-10" colspan="2">
              <input class="datepicker" type="text" name="record_date" value="<?=_date_format_utc($news->record_date,"Y/m/d")?>" />
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >地點</td>
            <td class="col-xs-10" colspan="2">
              <input type="text" style="width:100%;" name="location" value="<?=h($news->location)?>"/>
            </td>
          </tr>
          <tr>
            <td class="field col-xs-2" >講座內容</td>
            <td class="col-xs-10" colspan="2">
              <textarea class="tinymce" name="content" style="width:100%; height:400px;resize:vertical;"><?=h($news->content)?></textarea>
            </td>
            </td>
          </tr>
          <tr>
            <td>
              上傳照片
            </td>
            <td>
              <div class="form-group">
                <p>
                  <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>上傳檔案</span>
                      <!-- The file input field used as target for the file upload widget -->
                      <input type="file" id="fileupload" name="files" multiple />
                      <div id="files" >
                      <?php foreach($news_images as $file){  ?>
                      <p id="file_<?=$file->id?>">
                        <a target='_blank' href="<?=$file->url?>"><?=h($file->filename)?>
                        </a>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <label><input type="radio" <?=($news->major_file == $file->id )?"checked":""?> name="file_major" value="<?=$file->id?>" />主要照片</label> 
                        <input type="hidden" name="fileids[]" value="<?=$file->id?>" />
                        <button class="btn btn-delete btn-danger" data-fileid="<?=h($file->id)?>" >刪除檔案</button>
                      </p>
                    <?php }?>
                      </div>
                  </span>
                </p>
              </div>
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
      <button class="btn-primary btn">存檔</button>&nbsp;&nbsp;&nbsp;
      <a href="<?=admin_url($_type)?>">返回</a>
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

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?=base_url("js/load-image.all.min.js")?>"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?=base_url("js/canvas-to-blob.min.js")?>"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?=base_url("js/jquery.iframe-transport.js")?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?=base_url("js/jquery.fileupload.js")?>"></script>
<!-- The File Upload processing plugin -->
<script src="<?=base_url("js/jquery.fileupload-process.js")?>"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?=base_url("js/jquery.fileupload-image.js")?>"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?=base_url("js/jquery.fileupload-audio.js")?>"></script>
<!-- The File Upload video preview plugin -->
<script src="<?=base_url("js/jquery.fileupload-video.js")?>"></script>
<!-- The File Upload validation plugin -->
<script src="<?=base_url("js/jquery.fileupload-validate.js")?>"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="<?=base_url("js/jquery.xdr-transport.js")?>"></script>
<![endif]-->

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


    $('#fileupload').fileupload({
        url: "<?=site_url("admin/livingroom/upload_image")?>",
        dataType: 'json',
        autoUpload: true,
        formAcceptCharset:"utf-8",
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 100000 * 1000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>');
        data.context.appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p id="'+file.file_id+'" />')
                    .append($('<span class="file file-waiting" />').text(file.name));
            if (!index) {
                // node
                //     .append('<br>')
                //     .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.error) {
            node.find(".file-waiting").removeClass("file-waiting");
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var $child = $(data.context.children()[index]);
            $child.find(".file-waiting").removeClass("file-waiting");

            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index]).find(".file")
                    .wrap(link);
                $(data.context.children()[index]).append('&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="file_major" value="'+file.file_id+'" />主要照片</label> <input type="hidden" name="fileids[]" value='+file.file_id+' /><button class="btn btn-delete btn-danger" data-fileid="'+file.file_id+'" >刪除檔案</button>')
                
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $("#files").on("click",".btn-delete",function(e){
      var node = this;
      if(window.confirm("確定要刪除嗎？")){
        $(this).parent().remove();
      }

      e.preventDefault();
    });        
</script>
<?php } ?>


<?php include(__DIR__."/../../_admin_footer.php"); ?>