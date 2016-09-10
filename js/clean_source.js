

var fs = require("fs");
var content = fs.readFileSync(__dirname+ "/data.json");
var request = require("request");
var items = JSON.parse(content);


var fetch_map_items = (field) => {
  return new Promise((ok,fail)=>{
    var items = field.split(/http/);
    var keys = items.map((url)=>{
      if(url.indexOf("mapfiddle") != -1){
        var key = url.match("mapfiddle.org/marker/([a-zA-Z0-9]*)")[1];
        return key;
      }
      return null;
    }).filter((o) => o);

    if(keys.length == 0 ){
      ok(null);
      return true;
    }

    request("http://mapfiddle.org/api/markers/"+keys.join(",")+"/fiddle",function(err,res,body){
      var result = JSON.parse(body);
      if(!result.isSuccess){
        console.log(keys);
        console.log(body);
        console.log("=====");
      }
      console.log(result.isSuccess);
      // ok(body);
      ok(result.data);
    });
  });
};

Promise.all(items.map(function(item){
  return new Promise((ok,fail)=>{

    item["預算金額"] = item["預算金額\n (元)"];
    delete item["預算金額\n (元)"];
    delete item["填報人"];
    delete item["填報人聯絡方式"];
    delete item["填報部門單位"];

    item["區list"] = item["區"].replace(/\(.*\)/g,"").replace(/（.*）/,"").split("、");
    item["區list"] = item["區list"].map(item=>{
      return item.replace(/[\r\n]+/g,"").trim();
    });

    
    if(item["區list"][0] == ""){
      item["區list"] = null;
    }

    fetch_map_items(item["地圖"]).then(function(res){
      item["地圖"] = res;
      ok(item);
    });    
    
  });

})).then(function(items){
  return items.filter(f=>f["區list"] && f["地圖"]);
}).then(function(items){
  var ret = items.reduce(function(now,next){
    now[next["分類"]] = now[next["分類"]] || 0;
    now[next["分類"]]++;
    return now;
  },{});
  console.log(ret);
  fs.writeFileSync(__dirname+"/../public/js/cleaned_data.json",JSON.stringify(items));
});
