<div class="block">
  <a name="content" ></a>
  <div class="block-header">
    <h2>
      參與式預算
    </h2>
  </div>
  <div class="block-body">
    <?php 
    $items = [ 
      ["what","是什麼"],
      ["how","怎麼做"],
      ["who","誰參加"],
      ["go","去提案"]
    ];
    ?>
    <?php foreach($items as $item){ ?>
    <a href="<?=site_url("/pb/".$item[0]."#content")?>" class="block-item <?=$pb==$item[0]?"block-item-active":"" ?>"><?=$item[1]?></a>
    <?php } ?>
  </div>
</div>
<div style="padding-top:20px;">
  <img style='margin-bottom:30px;' src="<?=base_url("img/pb_intro_min.png")?>" class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2  col-md-12 col-md-offset-0" /> 
  <div style='clear:both;'></div>
</div>