<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function admin_url($url){
  return site_url("admin/".$url);
}


function _get_areas(){
  return ["中區", "東區", "南區", "西區", "北區", "西屯區", "南屯區", "北屯區", "豐原區", "東勢區", "大甲區", "清水區", "沙鹿區", "梧棲區", "后里區", "神岡區", "潭子區", "大雅區", "新社區", "石岡區", "外埔區", "大安區", "烏日區", "大肚區", "龍井區", "霧峰區", "太平區", "大里區", "和平區"];;
}

function _render_select($options,$name,$val){
  ?>
<select name="<?=h($name)?>">
<?php 
foreach($options as $area){ ?>
  <option <?=$area==$val?"selected":""?>><?=$area?></option>
<?php } ?>
</select>
  <?php 
}

function _convert_area_options($areas){
  $ret = [];
  foreach($areas as $a){
    $ret[$a->id] = $a->name;
  }
  return $ret;
}

function _render_object_select($options,$name,$val){
  ?>
<select name="<?=h($name)?>">
<?php 
foreach($options as $key => $area){ ?>
  <option  value="<?=$key?>" <?=$key==$val?"selected":""?>><?=$area?></option>
<?php } ?>
</select>
  <?php 
}

function _render_area_select($name = "area",$val){
  return _render_select(_get_areas(),$name,$val);
}

function _get_case_types(){
  return ["社區營造","文化教育","生態綠化", "道路維護", "交通設施", 
    "兒童及青少年","居家環境","公園設施","醫療照護", "地方基礎建設", 
    "觀光遊憩", "都市環境","治安防災","清潔衛生","社會福利", "產業發展", 
    "其它" ];
}


function _get_news_image_url($img){
  if($img == null){
    return base_url("img/news_default.png");
  }
  // https://www.youtube.com/embed/tH6qirvqCbg

  if(strpos($img,"/embed/") != FALSE){
    $token = explode("/embed/", $img);
    return "https://img.youtube.com/vi/".$token[1]."/0.jpg";
  }

  return $img;
}