		  function show(s,i,obj){
			  $("."+s).css("display",obj.checked?"table-cell":"none");
			  $("."+i).css("display",obj.checked?"table-cell":"none");
		  }
		 // function chg(){
			// $.each($("input[type=checkbox]"),function(k,v){
			  // if($(v).prop("checked")){
			  
					// $("#myTable tr *:nth-child("+(k+1)+")").css("display","table-cell");
			  // }else{
					// $("#myTable tr *:nth-child("+(k+1)+")").css("display","none");
			  // }
			// })
		// }
		function preview(oper){
			if (oper < 10){
			bdhtml=window.document.body.innerHTML;//獲取當前頁的html代碼
			sprnstr="<!--startprint"+oper+"-->";//設置列印開始區域
			eprnstr="<!--endprint"+oper+"-->";//設置列印結束區域
			prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18); //從開始代碼向後取html

			prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));//從結束代碼向前取html
			window.document.body.innerHTML=prnhtml;
			window.print();
			window.document.body.innerHTML=bdhtml;
			}
			else {
			window.print();
			}
		}
		$(function () {
			//widgets: ['zebra'] 這個參數，能對表格的奇偶數列作分色處理
			$("#myTable").tablesorter({widgets: ['zebra']});
		});
		function selAll(){
			//變數checkItem為checkbox的集合
			var checkItem = document.getElementsByName("c1");
			for(var i=0;i<checkItem.length;i++){
				checkItem[i].checked=true;
			}
			
		}
		function unselAll(){
			//變數checkItem為checkbox的集合
			var checkItem = document.getElementsByName("c1");
			for(var i=0;i<checkItem.length;i++){
				checkItem[i].checked=false;
			}
		}
		function usel(){
			//變數checkItem為checkbox的集合
			var checkItem = document.getElementsByName("c1");
			for(var i=0;i<checkItem.length;i++){
				checkItem[i].checked=!checkItem[i].checked;
			}
		}