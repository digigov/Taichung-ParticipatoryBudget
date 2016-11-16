<div class="container"  style="max-width:960px;margin:0 auto;margin-top:10px;">
  <div class="qrcode">
    <img src="<?=base_url("img/LineQRcode.png")?>" alt="line QR code" />
    <div>
      臺中市參與式預算
      官方 line
    </div>
  </div>
  <hr style="margin: 0;"/>
  <div class="footer">
    <div class="footer-body"> 
      <div class="row">
        <div class="col-md-5 footer-text">
          <p>主辦單位：臺中市政府民政局</p>
          <p>承辦單位：臺中市參與式預算推動專案辦公室</p>
          <p>
            地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：臺中市中區中山路 69 號4樓(中區再生基地樓上)
          </p>
          <p>
            電&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;話：04-22221712
          </p>
          <p>
            Email： empower.tccentral@gmail.com 
          </p>
        </div>
        <div class="col-md-2 col-xs-4" >
          <a target="_blank" href="http://www.taichung.gov.tw/"><img style='width:100%;' alt="臺中市政府" src="<?=base_url("img/taichung_logo.png")?>" /></a>
        </div>
        <div class="col-md-5 col-xs-12" style="margin-top:20px;text-align:left;">
          <div >
            <div class="fb-page" data-href="https://www.facebook.com/pbtaichung/"  data-tabs="timeline" data-height="100" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/pbtaichung/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/pbtaichung/">臺中市參與式預算</a></blockquote></div>
            <div style='clear:both'></div>
          </div>
        </div>
      </div>
      <div style='clear:both;'></div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?=base_url("bootstrap/js/bootstrap.min.js")?>" ></script>

<?php if(function_exists("js_section")) {
  js_section();
  }?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-5922548-21', 'auto');
  ga('send', 'pageview');

</script>
<div id="fb-root"></div>

<script>
  (function() {
    var cx = '007911714527574581490:icxpm0qddwa';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>