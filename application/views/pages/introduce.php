<?php include(__DIR__."/../_header.php"); ?>

<?php function css_section(){ ?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.7/dist/leaflet.css" />
<?php } ?>
<div class="container page-introduce">
  <div class="layout-content" style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <a  style='font-weight: bold;' href="<?=site_url("/introduce")?>">認識參與式預算</a> | 
      <a href="<?=site_url("/process")?>">推動流程</a> 
    </div>
  
    <div class="col-md-12 col-sm-12">
      <div class="title">
        <div class="col-xs-2 col-md-1">  
          <img style='width:100%;' src="<?=base_url("img/introduce_icon_01.png")?>" />
        </div>
        <h1 class="col-xs-8 col-md-10">何謂參與式預算</h1>
        <div class="col-xs-2 col-md-1">  
          <img style='width:100%;'  src="<?=base_url("img/introduce_icon_02.png")?>" />
        </div>
      </div>
  
      <div class="row">
        <div class="col-md-6  col-xs-12">
          <div class="introduce-block introduce-define">
            <h2>參與式預算定義</h2>
            <p>參與式預算是指由人民來決定一部份公共預算的支出。民眾和社區內所有群體的代表，共同討論預算計畫，提出方案，並且投票決定支出的優先順序，取得「公共性」與「急迫性」兩者的平衡。</p>
            <p>
            參與式預算結合「參與式民主」（participatory democracy）的精神與「審議式民主」（deliberative democracy）的討論模式，相信「社區居民才是在地的專家」，藉由公民社 會與公部門的集思廣益與集體合作的過程，改善現行政策尚未解決的公共問題，以及將公民社會的創意導入公部門，補足現行代議民主體制下的不足。</p>
          </div>
        </div>

        <div class="col-md-6  col-xs-12   ">
          <div style="background: #fde5e5;" class="introduce-block"><img style="width:100%;" src="<?=base_url("img/introduce_earth.png")?>" />
          </div>
        </div>
      </div>
      <div class="row">
        <div style='background: #f0ffec;' class="introduce-block col-md-8">
          <h2>參與式預算源起</h2>
          <p>參與式預算源起於巴西愉港市（Porte Alegre）。1988年，巴西左派政權工人黨贏得愉港市的大選，在第三波民主化的浪潮下標榜以「人民議會」進行都市治理，進行一系列的行政改革，而參與式預算便在此脈絡下於1989年正式誕生。</p>
          <p>
          1996年，聯合國人居署（UN-Habitat）在伊斯坦堡會議上認可參與式預算是「善治的最 佳實踐」（the best practice of good governance）。參與式預算從南美洲一路擴散到歐洲、亞洲、非洲與北美洲，造就近代的民主奇蹟！</p>
          <p>
          這套民主治理的實驗，近幾年成為不同的國家作為城市治理的參考模式。根據法國巴黎第八大學政治學教授辛特默（Yves Sintomer）等主編的參與式預算全球報告，在2010年，世 界上參與式預算就已高達1,500件。在2013年版的報告書中，參與式預算的案例數統計更接近2,800件，三年內成長87%。而這股這股風潮也在2014年九合一大選期間吹到了臺灣政壇。</p> 
        </div>

        <div class="col-md-4 col-md-offset-0 col-xs-4 col-xs-offset-4 ">
          <div  style='background: #fafbec;' class="introduce-block introduce-idea " ><img style="width:100%;" src="<?=base_url("img/introduce_idea.png")?>" />
          </div>
        </div>
      </div>
      <div class="row">
        
      </div>
      <div class="row">
        <div class="introduce-block col-md-12">
          <h2>參與式預算四大原則</h2>
          <p>政治學者溫普勒（Brian Wampler）指出，在巴西愉港，7成以上的參與者都屬於容易被傳統政治參與管道排除的弱勢民眾。研究也發現，由於人都具有同理心，藉由審議程序的連結，在更具包容性的公共討論下，人們會願意將公共資源優先挹注到最為迫切的公共需求，捲動公眾參與公共資源的重分配（redistribution），推動實現社會正義的目標。</p>
          <p>參與式預算作為一種參與式民主之所以能夠誘發改變社會的可能性，來自於制度設計的四大原則（Wampler 2012）
          </p> </div>
      </div>

      <div class="row" >
        <div style="background:#e5f0fd" class="introduce-block col-md-12">
          <b>1. 發聲原則（Voice）</b>：參與式預算的宗旨是為弱者發聲，希望藉由制度設計讓在傳統政治制度之下弱勢、被邊緣化的聲音能夠有機會透過審議過程的積極聆聽而有被同等重視的機會，進而激發更有活力的公民參與。
        </div>
      </div>
      <div class="row" >
        <div style="background:#fde5f3" class="introduce-block col-md-12">
        <b>2. 投票原則（Vote）</b>：結合發聲原則，透過比傳統代議政治更寬鬆的投票規定來涵納更多人的聲音。再者，投票也是直接民主的展現，因此也希望藉此達成增加公民權力（authority）的關鍵影響。
        </div>
      </div>
      <div class="row" >
        <div style="background:#fdf0e5" class="introduce-block col-md-12">
          <b>3. 監督原則（Oversight）</b>：相對於傳統的預算流程，參與式預算將公民帶入預算審議的流程中，使得政府必須更加開放、揭示更多資訊供大眾檢視與監督。
        </div>
      </div>
      <div class="row">
        <div style="background:#ebfde5" class="introduce-block col-md-12">

          <b>4. 社會正義原則（Social Justice）</b>：公共資源的分配應該以社會正義原則為依歸。從巴西愉港的案例來看，經過審議的過程，公民的確了解也願意把稅收花在最需要的地方，使公共資源有機會重分配，更符合社會正義。
        </div>
      </div>
      <div class="row">
        <div class="introduce-block col-md-12">
          <p>這四大原則捕捉了能夠改變社會的（transformative）參與式預算神韻，也是臺中市參與式預算在制度設計上努力的方向。</p> </div>
      </div>
    </div>

    <div style="clear:both"></div>
    

  </div>
</div>

<?php function js_section(){ ?>

<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>