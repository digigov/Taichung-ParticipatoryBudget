
<div class="container">
  <div class="footer">
  
  </div>
</div>
<script src="<?=base_url("js/jquery.min.js")?>"></script>
<script src="<?=base_url("bootstrap/js/bootstrap.min.js")?>" ></script>
<script type="text/javascript">
  $(".danger").click(function(){
    return window.confirm("確認要刪除嗎？");
  });

</script>
<?php if(function_exists("js_section")) {
  js_section();
  }?>

</body>
</html>
