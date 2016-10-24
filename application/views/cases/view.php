<?php include(__DIR__."/../_header.php"); ?>

<?php function css_section(){ ?>
<style>.content-ul li{margin-top:10px;
  font-size:18px;
  }</style>
<?php }?>

<div class="container">
  <div class="content-list">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <a href="<?=site_url("/cases/area/".$news->area)?>"><?=$news->area?>提案清單</a> &gt; 
      <span class="now"><?=h($news->name)?></span>

    </div>

    <div class="row">
      <div class="col-md-8">
        <div style="background:white;border-radius:40px;padding:20px;min-height:400px;">
          <ul class="content-ul">
            <li>
              提案名稱：<br />
              <?=$news->name?>
            </li>
            <li>
              提案目的：<br />
              <?=$news->purpose?>
            </li>
            <li>
              提案內容：<br />
              <?=$news->content?>
            </li>
            <li>
              提案預算額：<br />
              <?=$news->budget?> 元
              <br />
              <?=$news->budget_desc?>
            </li>
            <li>
              提案人：<br />
              <?=$news->author?>
            </li>
            <li>
              專家學者市政顧問團建議：<br />
              <?=$news->advice?>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div style="background:white;border-radius:40px;padding:20px;min-height:400px;padding-left:10%">
          <?php 
          $status = [
            ["住民會議提案", "step_source" ],
            ["專家學者意見", "step_expert" ],
            ["第一階段 ivoting ", "step_ivoting_1" ],
            ["第二階段 ivoting ", "step_ivoting_2" ],
            ["優先執行", "step_advance" ],
            ["執行進度", "step_running" ]
          ];
          ?>
          <?php foreach ($status as $key => $value) { 
              $file = $value[1]."_files";
            ?>
            <p>
              <a target="_blank" href="<?=$news->$value[1]?$news->$file:"#"?>" style="width:160px;text-align: center;" class="btn btn-default <?=$news->$value[1]?"btn-primary":""?>">
                <?=$value[0]?>
              </a>
            </p>
          <?php } ?>
          
        </div>
      </div>
    </div>
    <div style="clear:both"></div>

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>