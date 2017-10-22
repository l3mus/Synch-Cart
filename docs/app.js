// A $( document ).ready() block.
$( document ).ready(function() {
    console.log( "ready!" );
	//getLoyalty();
	request("110,5");
	  if(first){
		request2("110,5");
	  }
	request("110,3");
});
var total = 0.00; 
var itemsTotal = 0;
var first = true;
var discount;

function request(content){
	var item;
	$.ajax({
         url: "request.php",
         type: "POST",	
		 dataType: "json",
         data: {qrcode: content},
         success: function(obj, textstatues){
			item = obj;
			getLoyalty(item);
         },
		 error: function(obj,response){
			 console.log(obj);
			console.log("error");
		 }
    });
}
function getLoyalty(item){
	var result;
	var listItem;
	var price 
	$.ajax({
         url: "loyalty.php",
         type: "POST",	
         dataType: "json",
         data: {accountNum: accountNum, sku: item["SKU"]},
         success: function(obj, textstatus){
			parsed = JSON.parse(obj);
			createItem(item,parsed);
			
         },
		 error: function(response){
			 console.log("FWEIJR");
			 console.log(response);
		 }
    });
}
function request2(content){
	console.log(content);
	var item;
	var promises = [];
	var request;
	$.ajax({
         url: "request2.php",
         type: "POST",	
		 dataType: "json",
         data: {qrcode: content},
         success: function(obj, textstatues){
			item = obj;
			for(i = 0; i < item.length; i++)
			{
				request = isNextPurchase(item[i]);
				
			promises.push(request);
			}
			
			$.when.apply(null,promises).done(function(){
			
			});
			
         },
		 error: function(obj,response){
			 console.log(obj);
			console.log("error");
		 }
    });
}

function isNextPurchase(item){
	var result;
	var listItem;
	var price;
	var request;
	request = $.ajax({
         url: "next_purchase.php",
         type: "POST",	
         dataType: "json",
         data: {accountNum: accountNum},
         success: function(obj, textstatus){
			parsed = JSON.parse(obj);
			for(i = 0; i < parsed["categories"].length; i++)
			{
				if(parsed["categories"][i]["probability"] > 60 && parsed["categories"][i]["categoryName"].toUpperCase() == item["Category"].toUpperCase())
				{
					createItem2(item,parsed);
				}
			}
         },
		 error: function(response){
			 console.log("FWEIJR");
			 console.log(response);
		 }
    });
	return request;
}
function createItem(item, parsed){
	container = $("#cart");
	container.find("#first-item").text("Cart Items");
	container.find("#loyalty-text").text(parsed["offer"]["description"]);
	listItem = container.find(".w3-cell-row:first").clone();
	
	listItem.find("h3").text(item["Name"].replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}));

	listItem.find("#price").text(accounting.formatMoney(item["Price"]));
	listItem.find("#loyalty").text("");
	
	listItem.find("img").attr("src","data:image/jpg;base64," + item["Image"]);
	total += parseInt(item["Price"]);
	itemsTotal++;
	if(first){
		first = false;
		discount = parsed["offer"]["description"]
  .match(/^\d+|\d+\b|\d+(?=\w)/g)
  .map(function (v) {return +v;});
	}
	if( total >= discount[1]){
		var discountTotal;
		discountTotal = parseInt(total * (1 - (discount[0]/100)));
		container.find("#total").html("Cart subtotal ("+itemsTotal+" items): <del>"+ accounting.formatMoney(total) + "</del> "+ accounting.formatMoney(discountTotal));
	}else{
		container.find("#total").html("Cart subtotal ("+itemsTotal+" items): "+ accounting.formatMoney(total));

	}
	
	listItem.removeAttr("style");;
	console.log(listItem.find("img"));
	container.find(".w3-cell-row:first").after(listItem);
	container.find(".w3-cell-row:first").after("<hr>");
			
}

function createItem2(item, parsed){
	console.log("HERE");
	container = $("#suggestions");
	console.log(container);
	listItem = container.find(".sugg-item:first").clone();
	
	listItem.find("#name2").text(item["Name"].replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}));

	listItem.find("#price").text(accounting.formatMoney(item["Price"]));

	listItem.find("img").attr("src","data:image/jpg;base64," + item["Image"]);

	
	listItem.removeAttr("style");
	container.find(".sugg-item:first").after(listItem);
	console.log(listItem);
			
}
var app = new Vue({
  el: '#app',
  data: {
    scanner: null,
    activeCameraId: null,
    cameras: [],
    scans: []
  },
  mounted: function () {
    var self = this;
	var dbres;
    self.scanner = new Instascan.Scanner({ mirror: false, video: document.getElementById('preview'), scanPeriod: 5 });
    self.scanner.addListener('scan', function (content, image) {
	  //TODO: get time from qr 
	  if(first){
		request2(content);
	  }
	   request(content);
	  //console.log(dbres);
	  //getLoyalty(content);
      self.scans.unshift({ date: +(Date.now()), content: content });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      self.cameras = cameras;
      if (cameras.length > 0) {
        self.activeCameraId = cameras[0].id;
        self.scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  },
  methods: {
    formatName: function (name) {
      return name || '(unknown)';
    },
    selectCamera: function (camera) {
      this.activeCameraId = camera.id;
      result = this.scanner.start(camera);
	  console.log(result.content);
    }
  }
});
