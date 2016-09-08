<?php include(__DIR__."/../_header.php"); ?>

<?php function css_section(){ ?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.7/dist/leaflet.css" />
<?php } ?>
<div class="container">
  <div class="content-list" style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <span class="now">各區推動概況</span>

    </div>
  
    <div class="col-md-3">
      <div class="menu">
        <p>
          <img width="20" src="<?=base_url("img/icons/rect.png")?>" />&nbsp;: 為市政府規劃案
        </p>
        <p>
          <img width="20" src="<?=base_url("img/icons/circle.png")?>" />&nbsp;: 為民眾自行提案
        </p>
        <ul>
        <?php 
        $menus = ["地方基礎設施", "文化教育", "道路維護", "生態綠化", "公園設施", "交通設施", "老人及社會福利", "產業發展", "社區營造", "治安防災", "都市環境", "清潔衛生"] ;

        foreach($menus as $m){
        ?>
          <li><a href=""><img width="20" src="<?=base_url("img/icons/".$m."_gray.png")?>" />&nbsp;: <?=$m?></a></li>
        <?php } ?>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div id="mapid" style="width: 100%; height: 600px"></div>
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


    var osm = L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw', {
      maxZoom: 18,
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
      id: 'mapbox.streets'
    });

    var renderText = function(item){
      var fields = ["填報部門", "填報部門單位", "填報人", "填報人聯絡方式", "區", "起始年度", "結束年度", "分類", "建設(服務)案", "地點", "預算金額", "預算狀態", "中央補助款金額", "預算說明", "內容摘要", "辦理期程", "計畫聯絡科室", "分機", "備註", "區list"];

      var out = [];
      for(var k in fields){
        out.push(fields[k]+":"+item[fields[k]]);
      }
      return out.join("<Br />");
    };

    var icons = {};

    var icons_type = ["地方基礎設施", "文化教育", "道路維護", "生態綠化", "公園設施", "交通設施", "老人及社會福利", "產業發展", "社區營造", "治安防災", "都市環境", "清潔衛生"];

    $.each(icons_type,function(ind,type){
      icons[type] = L.icon({
        iconUrl: "http://pb.local/img/icons/" + type + ".png",
        iconSize:     [30, 30], // size of the icon
        // popupAnchor:  [-3, -76] 
      });
    });
    

    $.get("/js/cleaned_data.json").then(function(data){

      $.each(data,function(ind,project){
        for(var k in project["地圖"]){
          var gis = project["地圖"][k];
          if(gis.type == 0 || gis.latlngs.length == 1){
            gis.latlngs.forEach(function(p){
              var marker = L.marker(p.latlng,{icon:icons[project["分類"]]}).addTo(mymap)
                .bindPopup(renderText(project));
            });
          }else if(gis.type == 1){
            var latlngs = gis.latlngs.map(function(p){ return p.latlng ;});
            var polyline = L.polyline(latlngs, {color: 'red'}).addTo(mymap)
              .bindPopup(renderText(project));
          }else if(gis.type == 2){
            var latlngs = gis.latlngs.map(function(p){ return p.latlng ;});
            var polyline = L.polygon(latlngs, {color: 'red'}).addTo(mymap)
              .bindPopup(renderText(project));
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