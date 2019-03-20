function Block1(){
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
	}
  });
}

function Block2(year,month){
  var c1 = $("input#b2c1").val();
  var c2 = $("input#b2c2").val();
  var c3 = $("select#b2c3").val();
  var c4 = $("select#b2c4").val();
  var c5 = $("select#b2c5").val();
  var c6 = $("select#b2c6").val();
  var c7 = $("input#b2c7").val();
  var c8 = $("select#b2c8").val();
  
  var dataArray = {
	"c1":c1,
	"c2":c2,
	"c3":c3,
	"c4":c4,
	"c5":c5,
	"c6":c6,
	"c7":c7,
	"c8":c8,
	"year":year,
	"month":month
  };
 
  jQuery.ajax({
	type: "POST",
	url: "process.php",
	data: {block2 : JSON.stringify(dataArray)},
	cache: false,
	success: function(response){
		if (response)
			alert(response);	
	}
  });
}


function Block3(year,month){
  var c1 = $("input#b3c1").val();
  var c2 = $("select#b3c2").val();
  var c3 = $("input#b3c3").val();
  var c4 = $("select#b3c4").val();
  var c5 = $("input#b3c5").val();
  var c6 = $("input#b3c6").val();
  
  var dataArray = {
	"c1":c1,
	"c2":c2,
	"c3":c3,
	"c4":c4,
	"c5":c5,
	"c6":c6,
	"year":year,
	"month":month
  };
 
  jQuery.ajax({
	type: "POST",
	url: "process.php",
	data: {block3 : JSON.stringify(dataArray)},
	cache: false,
	success: function(response){
		if (response)
			alert(response);
	}
  });
}

function Block4(year,month){
  var c1 = $("input#b4c1").val();
  var c2 = $("select#b4c2").val();
  var c3 = $("input#b4c3").val();
  var c4 = $("input#b4c4").val();
  var c5 = $("input#b4c5").val();
  var c6 = $("input#b4c6").val();
  var c7 = $("input#b4c7").val();
  var c8 = $("input#b4c8").val();
  var c9 = $("input#b4c9").val();
  var c10 = $("input#b4c10").val();
  var c11 = $("input#b4c11").val();
  var c12 = $("input#b4c12").val();
  var c13 = $("input#b4c13").val();
  var c14 = $("input#b4c14").val();
  var c15 = $("input#b4c15").val();
  var c16 = $("input#b4c16").val();
  var c17 = $("input#b4c17").val();
  var c18 = $("select#b4c18").val();
  var c19 = $("input#b4c19").val();
  var c20 = $("select#b4c20").val();
  var c21 = $("input#b4c21").val();
  
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
	"c14":c14,
	"c15":c15,
	"c16":c16,
	"c17":c17,
	"c18":c18,
	"c19":c19,
	"c20":c20,
	"c21":c21,
	"year":year,
	"month":month
  };
 
  jQuery.ajax({
	type: "POST",
	url: "process.php",
	data: {block4 : JSON.stringify(dataArray)},
	cache: false,
	success: function(response){
		if (response)
			alert(response);
	}
  });
}

function Block5(year,month){
  var c1 = $("input#b5c1").val();
  var c2 = $("input#b5c2").val();
  var c3 = $("input#b5c3").val();
  var c4 = $("input#b5c4").val();
  var c5 = $("select#b5c5").val();
  var c6 = $("input#b5c6").val();
  var c7 = $("input#b5c7").val();
  var c8 = $("input#b5c8").val();
  var c9 = $("input#b5c9").val();
  var c10 = $("input#b5c10").val();
  var c11 = $("input#b5c11").val();
  var c12 = $("select#b5c12").val();
  var c13 = $("select#b5c13").val();
  var c14 = $("input#b5c14").val();
  var c15 = $("input#b5c15").val();
  var c16 = $("input#b5c16").val();
  
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
	"c14":c14,
	"c15":c15,
	"c16":c16,
	"year":year,
	"month":month
  };
 
  jQuery.ajax({
	type: "POST",
	url: "process.php",
	data: {block5 : JSON.stringify(dataArray)},
	cache: false,
	success: function(response){
		if (response)
			alert(response);
	}
  });
}


function Block6(year,month){
  var c1 = $("input#b6c1").val();
  var c2 = $("input#b6c2").val();
  var c3 = $("input#b6c3").val();
  var c4 = $("input#b6c4").val();
  var c5 = $("input#b6c5").val();
  var c6 = $("input#b6c6").val();
  var c7 = $("input#b6c7").val();
  var c8 = $("input#b68").val();
  var c9 = $("input#b6c9").val();
  var c10 = $("input#b6c10").val();
  var c11 = $("input#b6c11").val();
  var c12 = $("input#b6c12").val();
  var c13 = $("input#b6c13").val();
  var c14 = $("select#b6c14").val();
  var c15 = $("input#b6c15").val();
  var c16 = $("select#b6c16").val();
  var c17 = $("select#b6c17").val();
  var c18 = $("input#b6c18").val();
  var c19 = $("input#b6c19").val();
  var c20 = $("select#b6c20").val();
  var c21 = $("input#b6c21").val();
  var c22 = $("input#b6c22").val();
  var c23 = $("input#b6c23").val();
  var c24 = $("input#b6c24").val();
  var c25 = $("select#b6c25").val();
  
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
	"c14":c14,
	"c15":c15,
	"c16":c16,
	"c17":c17,
	"c18":c18,
	"c19":c19,
	"c20":c20,
	"c21":c21,
	"c22":c22,
	"c23":c23,
	"c24":c24,
	"c25":c25,
	"year":year,
	"month":month
  };
 
  jQuery.ajax({
	type: "POST",
	url: "process.php",
	data: {block6 : JSON.stringify(dataArray)},
	cache: false,
	success: function(response){
		if (response)
			alert(response);
	}
  });
}s