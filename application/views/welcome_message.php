<?php include(__DIR__."/_header.php"); ?>
<?php function css_section(){ ?>
 <style>
    body {
      -webkit-font-smoothing: antialiased;
      font: normal 15px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
      color: #232525;
      padding-top:70px;
    }

    #slides {
      display: none;
      position:relative;
    }

    #slides .slidesjs-navigation {
      margin-top:3px;
      display:none;
    }

    #slides:hover .slidesjs-navigation{
      display:block;
    }

    #slides .slidesjs-previous {
      margin-right: 5px;
      /*float: left; */
      position:absolute;
      top:120px;
      z-index:100;
    }

    #slides .slidesjs-next {
      margin-right: 5px;
      position:absolute;
      top:120px;
      right:0px;
      z-index:100;
    }

    .slidesjs-pagination {
      margin: 6px 0 0;
      float: right;
      list-style: none;
    }

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
    }

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0;
      padding-top: 13px;
/*      background-image: url(/img/pagination.png);*/      background-position: 0 0;
      float: left;
      overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
      background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
      color: #333
    }

    #slides a:hover,
    #slides a:active {
      color: #9e2020
    }

    .navbar {
      overflow: hidden
    }
  </style>
<?php } ?>

<div class="container">
  
  <?php if(count($slides) > 0){ ?>
  <div class="slides" style="background:rgb(128,208,205);padding-top:20px;">

    <div id="slides">
      <?php 
      if(count($slides) == 1){
        $slides[] = $slides[0];
      }
      foreach($slides as $slide) { ?>
        <a href="<?=$slide->url?>"><img style='width:100%;' alt="<?=$slide->text?>" src="<?=h($slide->img_url)?>" /></a>
      <?php } ?>

      <a href="#" class="slidesjs-previous slidesjs-navigation"> 
        <img src="<?=base_url("img/arrow_left.png")?>" />
      </a>
      <a href="#" class="slidesjs-next slidesjs-navigation"> 
        <img src="<?=base_url("img/arrow_right.png")?>" />
      </a>
    </div>
  </div>
  <?php } ?>
  <div class="content-deep">
    <div class="col-md-3 block-left">
      <?php include(__DIR__."/_ph_menu.php") ?>
    </div>
    <div class="col-md-9 block-right">
      <div>
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/7hnzIIvy290" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
    <div style='clear:both;'></div>
  </div>

</div>

<?php function js_section(){ ?>
<script src="<?=base_url("/js/jquery.slides.min.js")?>"></script>
<script>
  $('#slides').slidesjs({
    width: 940,
    height: 375,
    navigation: false
  });
</script>
<?php } ?>

<div class="container">
  <img src="<?=base_url("img/bg_city.png")?>" width="100%" />
</div>
<?php include(__DIR__."/_footer.php"); ?>