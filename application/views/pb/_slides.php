

<?php function js_section(){ ?>
<script src="<?=base_url("/js/jquery.slides.min.js")?>"></script>
<script>
  $('#slides').slidesjs({
    width: 940,
    height: 375,
    navigation: false,
    play: {
      active: true,
      effect: "slide",
      interval: 5000,
      auto: true,
        // [boolean] Start playing the slideshow on load.
      swap: true,
        // [boolean] show/hide stop and play buttons
      pauseOnHover: true,
        // [boolean] pause a playing slideshow on hover
      restartDelay: 2500
        // [number] restart delay on inactive slideshow
    }
  });
</script>
<?php } ?>


  <?php if(count($slides) > 0){ ?>
  <div class="slides" style="background:rgb(128,208,205);">

    <div id="slides">
      <?php 
      shuffle($slides);
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