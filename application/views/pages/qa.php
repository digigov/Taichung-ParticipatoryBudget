<?php include(__DIR__."/../_header.php"); ?>

<style>
  .question{
    font-size:24px;
  }
  .answer{
    font-size:16px;
  }
  .answer-highlight{
    font-size:24px;
    color:rgb(14,115,185);
  }
</style>
<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <span class="now"> 問與答 (Q&amp;A)</span>
    </div>

    <div class="col-md-12 qa-container" style="">

      <div class="qa-header clearfix">
        <div class="qa-left-top">
          <img src="<?=base_url("img/qa_left_top.png")?>" />
        </div>
        <div class="qa-center-top">
        </div>
        <div class="qa-right-top">
          <img src="<?=base_url("img/qa_right_top.png")?>" />
        </div>
      </div>
      <div class="qa-header2 clearfix">
        <div class="qa-left-middle">

        </div>
        
        <div class="qa-center-middle" style='width:94%;'>
          <p><img style='max-width:100%;' src="<?=base_url("img/qa_icon.png")?>" /></p>

          <?php foreach($qas as $qa){ ?>
          <div class="question-container">
            <p class="question">Q：<?=h($qa->question)?>  </p>
            <div class="answer">
              <?=($qa->answer)?>
            </div>
          </div>
          <?php } ?>

          <div class="answer">
            <hr />
            <p>
              有任何參與式預算的相關問題，都歡迎 email 至臺中市參與式預算推動專案辦公室！<br />
              <a style='color:white;' href="mailto:empower.tccentral@gmail.com">empower.tccentral@gmail.com</a>
            </p>
          </div>  
        </div>
        <div class="qa-right-middle">
          <img src="<?=base_url("img/qa_right_middle.png")?>" />
        </div>
        
      </div>
      <div class="qa-header clearfix" style='position:relative;'>
        <div class="qa-left-bottom">
          <img src="<?=base_url("img/qa_left_bottom.png")?>" />
        </div>
        <div class="qa-center-bottom">
        </div>
        <div class="qa-right-bottom">
          <img src="<?=base_url("img/qa_right_bottom.png")?>" />
        </div>
      </div>
    </div>
    <div style="clear:both"></div>

  </div>
</div>

<?php function js_section(){ ?>

<script>
var fixpos = function(){
  $(".qa-left-middle").css("height",($(".qa-center-middle").height()+5+"px"));
  $(".qa-right-middle").css("height",($(".qa-center-middle").height()+3+"px"));

  $(".qa-center-middle").css("width",
    ($(".qa-header2").width() - 40) +
    "px");

  $(".qa-center-top").css("width",
    ($(".qa-header2").width() - 86) +
    "px");
};
fixpos();

$(window).on("resize",fixpos);

setTimeout(fixpos,3000);
</script>
<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>