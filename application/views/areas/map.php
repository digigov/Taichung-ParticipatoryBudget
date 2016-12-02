<?php include(__DIR__."/../_header.php"); ?>

<?php function css_section(){ ?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.7/dist/leaflet.css" />
<?php } ?>
<div class="container">
  <div class="content-list" style="min-height:450px;">
    <div class="breadcrumb">
      <a href="<?=site_url("/")?>">首頁</a> &gt; 
      <span class="now">各區推動概況</span>&gt;
      <span class="now"> 地圖檢視 </span>

    </div>
  
    <div class="col-md-4 col-sm-4">
      <div class="menu">
      
        <p  data-type="gov" class="gov-toggle gov-toggled">
          <img width="20" src="<?=base_url("img/icons/rect.png")?>" />&nbsp;： 為市政府規劃案
        </p>
        <p  data-type="normal" class="gov-toggle gov-toggled">
          <img width="20" src="<?=base_url("img/icons/circle.png")?>" />&nbsp;： 為民眾自行提案
        </p>
        
        <ul>
        <?php 
        $menus = _get_case_types();

        foreach($menus as $m){
          if(trim($m) == "其他"){
            continue;
          }
        ?>
          <li class="menu-toggle menu-toggled" data-type="<?=h($m)?>"><span href=""><img width="20" src="<?=base_url("img/icons/".$m."_gray.png")?>" />&nbsp;： <?=$m?></span></li>
        <?php } ?>
        </ul>
      </div>
    </div>
    <div class="col-md-8 col-sm-8">
      <div id="mapid" style="width: 100%; height: 500px"></div>
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

    var renderText = function(item){
      var fields = ["填報部門", "填報部門單位", "填報人", "填報人聯絡方式", "區", "起始年度", "結束年度", "分類", "建設(服務)案", "地點", "預算金額", "預算狀態", "中央補助款金額", "預算說明", "內容摘要", "辦理期程", "計畫聯絡科室", "分機", "備註", "區list"];

      var out = [];
      out.push("<h2>"+item["建設(服務)案"]+"</h2>");
      out.push("<p>辦理機關： "+item["填報部門"]+"<br />");
      out.push("計畫預算： "+( item["預算金額"] && (item["預算金額"]+ "  (約 "+convert(parseInt(item["預算金額"],10),true)+")" ) || "無資料")+"<br />");
      out.push("計畫期程： "+item["辦理期程"]+"</p>");
      out.push("<div style='float:right;'><a href='/areas/detail/"+item["建設(服務)案"]+"'>...瞭解更多</a></div>");
      out.push("<div style='clear:both;'></div>");
      // for(var k in fields){
      //   out.push(fields[k]+":"+item[fields[k]]);
      // }
      return out.join("");
    };

    var icons = {};

    var icons_type = <?=json_encode(_get_case_types())?>;

    $.each(icons_type,function(ind,type){
      icons[type+"_gov"] = L.icon({
        iconUrl: "/img/icons/" + type + ".png",
        iconSize:     [30, 30], // size of the icon
        // popupAnchor:  [-3, -76] 
      });
      icons[type+"_normal"] = L.icon({
        iconUrl: "/img/icons/" + type + "_circle.png",
        iconSize:     [30, 30], // size of the icon
        // popupAnchor:  [-3, -76] 
      });
    });

    var icon_enable = {};
    icons_type.forEach(function(icon){
      icon_enable[icon] = true;
    });
    
    var gov_type_enable ={
      gov:true,
      normal:true
    };

    var markers = [];
    // menu-toggle
    $.get("/js/cleaned_data.json",function(data){
      $.each(data,function(ind,project){
        project["gov_type"] ="gov";
        for(var k in project["地圖"]){
          var gis = project["地圖"][k];
          if(gis.type == 0 || gis.latlngs.length == 1){
            gis.latlngs.forEach(function(p){
              var props = icons[project["分類"]+"_"+project["gov_type"]] && {icon:icons[project["分類"]+"_"+project["gov_type"]],zIndexOffset:100} || {zIndexOffset:100};
              var marker = L.marker(p.latlng,props).addTo(mymap)
                .bindPopup(renderText(project));
              marker.data = project;
              markers.push(marker);
            });
          }
          
        }
      });
        

    });

    var rerender = function(){
      markers.forEach(function(m){
        if(icon_enable[m.data["分類"]] && gov_type_enable[m.data["gov_type"]]){
          m.addTo(mymap);
        }else{
          mymap.removeLayer(m);
        }
      });
    }

    $(".menu-toggle").click(function(){
      var type = $(this).data("type");
      icon_enable[type] = !icon_enable[type];

      if(icon_enable[type]){
        $(this).addClass("menu-toggled");
      }else{
        $(this).removeClass("menu-toggled");
      }
      rerender();
    });

    $(".gov-toggle").click(function(){
      var type = $(this).data("type");
      gov_type_enable[type] = !gov_type_enable[type];

      if(gov_type_enable[type]){
        $(this).addClass("gov-toggled");
      }else{
        $(this).removeClass("gov-toggled");
      }
      rerender();
    });

    // var ggl = new L.Google();
    var ggl2 = new L.Google('roadmap');
    mymap.addLayer(ggl2);
    mymap.addControl(new L.Control.Layers( {'Google':ggl2,'OSM':osm}, {}));

  </script>
<?php } ?>


<?php include(__DIR__."/../_footer.php"); ?>