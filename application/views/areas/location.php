<?php include(__DIR__."/../_header.php"); ?>

<?php function css_section(){ ?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.7/dist/leaflet.css" />
<?php } ?>
<div class="container">
  <div class="content-list" style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      各區推動概況 &gt;
      <span class="now"><?=h($area_name)?></span>
    </div>
  
    <div class="col-md-12" >
      <div id='cont' class="menu">
          
        <h1><?=h($area_name)?></h1>

        <h3>地區介紹</h3>
        <div>
          <?=nl2br($area_item->intro) ?>
        </div>
        <hr />

        <h3>市府歷年建設與服務</h3>
        <table style="background:white;border-radius: 5px;" class="table table-bordered">
          <tr>
            <td>填報局處</td>
            <td>案件名稱</td>
            <td>分類</td>
          </tr>
        <?php foreach($gov_items as $item){
         ?>
          <tr>
            <td><?=h($item->unit)?></td>
            <td><a href="<?=site_url("/areas/detail/".$item->id)?>"><?=h($item->name)?></a></td>
            <td><?=h($item->type)?></td>
          </tr>
        <?php } ?>
        </table>

        <h3>歷年民眾提案一覽表</h3>
        
        <?php foreach($area_cases as $year => $datas){
		if(count($datas) == 0){ continue ;}
		
 ?>
        <p>
          <?=$year?> 年
        </p>
        <table style="background:white;border-radius: 5px;" class="table table-bordered">
        <tr>
	<?php if($year < 2017 ) { ?>
	<td style="width:10%;text-align:center;">
            進入<Br />第二階段<Br />
            i-Voting
		</td>
	<?php }?>
          <td>最終優先提案</td>
          <td>編號</td>
          <td>名稱</td>
          <td>提案人</td>
        </tr>
      <?php foreach($datas as $item){ ?>
        <tr>
	 <?php if($year < 2017 ) { ?>
          <td style="text-align:center;"><?=h($item->step_ivoting_2?"V":"")?></td>
	<?php } ?>
          <td><?=h($item->step_advance?"V":"")?></td>
          <td><?=h($item->caseno)?></td>
          <td><a href="<?=site_url("/cases/view/".$item->id)?>"><?=h($item->name)?></a></td>
          <td><?=h($item->author)?></td>
        </tr>
      <?php } ?>
      </table>
        <?php } ?>

	
	<hr />

        <!-- <div id="mapid" style="width: 100%; height: 500px"></div> -->

         <p>相關資料</p>

        <a target="_blank" href="<?=$area_item->opendata_link?>">開放資料連結</a>
      </div>
    </div>


    <div style="clear:both"></div>

  </div>
</div>

<?php function js_section(){ ?>

  <script src="https://unpkg.com/leaflet@0.7.7/dist/leaflet.js"></script>
  <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script> 
  
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSIFJslwcgjr4ttFgt0TX3KSG6sqLkzY8"
        ></script>
  <script src="<?=base_url("js/google_tile.js")?>"></script>

  <script>
    var center = [24.175396128726,120.67096084356];

    var mymap = L.map('mapid').setView(center, 11);

    var _num = function(val, divide, floats){
      return parseInt(val / divide * Math.pow(10, 2), 10) / Math.pow(10, floats);
    };
    var convert = function(value2, full_desc ){
      var prefix, value, unitdata;
      prefix = "";
      if (value2 < 0) {
        value = value2 * -1;
        prefix = "-";
      } else {
        value = value2;
      }
      unitdata = ["", "元", 1];
      value = parseInt(10000 * value / unitdata[2]) / 10000;
      value = value >= 1000000000000
        ? _num(value, 1000000000000, 2) + " 兆"
        : value >= 100000000
          ? _num(value, 100000000, 2) + " 億"
          : value >= 10000
            ? parseInt(value / 10000) + " 萬"
            : value >= 1000
              ? parseInt(value / 1000) + " 千"
              : value >= 1 ? parseInt(10 * value) / 10 : value;
      return prefix + value + (full_desc ? unitdata[0] + unitdata[1] : "");
    };

    var osm = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      id: 'mapbox.streets'
    });

    // var renderText = function(item){
    //   var fields = ["填報部門", "填報部門單位", "填報人", "填報人聯絡方式", "區", "起始年度", "結束年度", "分類", "建設(服務)案", "地點", "預算金額", "預算狀態", "中央補助款金額", "預算說明", "內容摘要", "辦理期程", "計畫聯絡科室", "分機", "備註", "區list"];

    //   var out = [];
    //   out.push("<h2>"+item["建設(服務)案"]+"</h2>");
    //   out.push("<p>辦理機關： "+item["填報部門"]+"<br />");
    //   out.push("計畫預算： "+( item["預算金額"] && (item["預算金額"]+ "  (約 "+convert(parseInt(item["預算金額"],10),true)+")" ) || "無資料")+"<br />");
    //   out.push("計畫期程： "+item["辦理期程"]+"</p>");
    //   out.push("<div style='float:right;'><a href='/areas/view/"+item["建設(服務)案"]+"'>...瞭解更多</a></div>");
    //   out.push("<div style='clear:both;'></div>");
    //   // for(var k in fields){
    //   //   out.push(fields[k]+":"+item[fields[k]]);
    //   // }
    //   return out.join("");
    // };

    var icons = {};

    var icons_type = ["地方基礎設施", "文化教育", "道路維護", "生態綠化", "公園設施", "交通設施", "老人及社會福利", "產業發展", "社區營造", "治安防災", "都市環境", "清潔衛生"];

    $.each(icons_type,function(ind,type){
      icons[type] = L.icon({
        iconUrl: "/img/icons/" + type + ".png",
        iconSize:     [30, 30], // size of the icon
        // popupAnchor:  [-3, -76] 
      });
    });
    

    $.get("/js/cleaned_data.json").then(function(data){
      var dataw = [];
      var name = decodeURIComponent($("#cont").data("name"));

      $.each(data,function(ind,proj){
        if(proj["建設(服務)案"] == name) {
          dataw.push(proj);
        }
      });
      data = dataw;
      $.each(data,function(ind,project){
        for(var k in project["地圖"]){
          var gis = project["地圖"][k];
          if(gis.type == 0 || gis.latlngs.length == 1){
            gis.latlngs.forEach(function(p){
              var props = icons[project["分類"]] && {icon:icons[project["分類"]],zIndexOffset:100} || {zIndexOffset:100};
              var marker = L.marker(p.latlng,props).addTo(mymap);
                // .bindPopup(renderText(project));
            });
          }else if(gis.type == 1){
            var latlngs = gis.latlngs.map(function(p){ return p.latlng ;});
            var polyline = L.polyline(latlngs, {color: 'red',zIndexOffset:50}).addTo(mymap);
              // .bindPopup(renderText(project));
          }else if(gis.type == 2){
            var latlngs = gis.latlngs.map(function(p){ return p.latlng ;});
            latlngs.push(latlngs[0]);
            var polyline = L.polyline(latlngs, {color: 'red'}).addTo(mymap);
              // .bindPopup(renderText(project));
          }
        }
      });
        

    });

    // var ggl = new L.Google();
    var ggl2 = new L.Google('roadmap');
    mymap.addLayer(ggl2);
    mymap.addControl(new L.Control.Layers( {'Google':ggl2,'OSM':osm}, {}));

  </script>
<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>
