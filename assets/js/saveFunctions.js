function Save1(){
  var c1 = $("input#b1c1").val();
  var c2 = $("input#b1c2").val();
  var c3 = $("input#b1c3").val();
  var c4 = $("input#b1c4").val();
  var c5 = $("input#b1c5").val();
  var c6 = $("input#b1c6").val();
  var c7 = $("input#b1c7").val();
  var c8 = $("input#b1c8").val();
  var c9 = $("input#b1c9").val();
  var c10 = $("select#b1c10").val();
  var c11 = $("input#b1c11").val();
  var c12 = $("input#b1c12").val();
  var c13 = $("input#b1c13").val();
  var c14 = $("input#b1c14").val();
  
  
  var dataArray = {
	"c1":c1,
	"c2":c2,
	"c3":c3,
	"c4":c4,
	"c5":c5,
	"c6":c6,
	"c7":c7,
	"c8":c8,
	"c9":c9,
	"c10":c10,
	"c11":c11,
	"c12":c12,
	"c13":c13,
	"c14":c14
  };
 
  jQuery.ajax({
	type: "POST",
	url: "process.php",
	data: {block1 : JSON.stringify(dataArray)},
	cache: false,
	success: function(response){
		if (response)
			alert(response);
		else
			window.location.href = 'index.php';
	}
  });
}