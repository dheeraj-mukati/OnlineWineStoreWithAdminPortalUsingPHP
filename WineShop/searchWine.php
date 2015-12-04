<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Insert title here</title>
		
		<script type="text/javascript">
		
		$(document).ready(function() {

			function hideShowWineNameFields(flag){
				if(flag == "hide"){
					//Hide wine name row and label
					$("#wineNameRow").hide();
					$("#wineNameRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#wineNameRow").show();
					$("#wineNameRowLabel").show();
				}		
			}

			function hideShowWineTypeFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#selectWineTypeRowLabel").hide();
					$("#selectWineTypeRow").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#selectWineTypeRowLabel").show();
					$("#selectWineTypeRow").show();
				}		
			}

			function hideShowYearAndRestrcitionFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#selectRestrictionRow").hide();
					$("#selectRestrictionRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#selectRestrictionRow").show();
					$("#selectRestrictionRowLabel").show();
				}		
			}

			function hideShowRestrcitionValueFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#restrictionValueRow").hide();
					$("#restrictionValueRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#restrictionValueRow").show();
					$("#restrictionValueRowLabel").show();
				}		
			}

			function hideShowSelectWineryFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#selectWineryRow").hide();
					$("#selectWineryRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#selectWineryRow").show();
					$("#selectWineryRowLabel").show();
				}		
			}

			function hideShowSelectRegionFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#selectRegionRow").hide();
					$("#selectRegionRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#selectRegionRow").show();
					$("#selectRegionRowLabel").show();
				}		
			}

			function hideShowSelectGrapeFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#selectGrapeRow").hide();
					$("#selectGrapeRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#selectGrapeRow").show();
					$("#selectGrapeRowLabel").show();
				}		
			}

			function hideShowSelectFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#selectRow").hide();
					$("#selectRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#selectRow").show();
					$("#selectRowLabel").show();
				}		
			}

			function hideShowWineryFields(flag){
				if(flag == "hide"){
					//Hide wine type row and label
					$("#wineryNameRow").hide();
					$("#wineryNameRowLabel").hide();
				}else if(flag == "show"){
					//show wine name and label
					$("#wineryNameRow").show();
					$("#wineryNameRowLabel").show();
				}		
			}
			
			$("#selectSearchBy").change(function() {
				var selectTypeOption = $('#selectSearchBy').val();

				// hide all the fields
				if(selectTypeOption == "By_Search_By"){

					hideShowWineNameFields("hide");
					hideShowWineTypeFields("hide");
					hideShowYearAndRestrcitionFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowSelectWineryFields("hide");
					hideShowSelectRegionFields("hide");
					hideShowSelectGrapeFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
				}
				
				//show only wine name fields and hide all other fields
				else if(selectTypeOption == "By_Wine_Name"){

					hideShowWineTypeFields("hide");
					hideShowYearAndRestrcitionFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowSelectWineryFields("hide");
					hideShowSelectRegionFields("hide");
					hideShowSelectGrapeFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
					
					hideShowWineNameFields("show");
				}

				else if(selectTypeOption == "By_year"){
					
					hideShowWineNameFields("hide");
					hideShowWineTypeFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowSelectWineryFields("hide");
					hideShowSelectRegionFields("hide");
					hideShowSelectGrapeFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
					
					hideShowYearAndRestrcitionFields("show");
				}

				else if(selectTypeOption == "By_cost"){
					
					hideShowWineNameFields("hide");
					hideShowWineTypeFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowSelectWineryFields("hide");
					hideShowSelectRegionFields("hide");
					hideShowSelectGrapeFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
					
					hideShowYearAndRestrcitionFields("show");
				}
				
				//show only wine type fields and hide all other fields
				else if(selectTypeOption == "By_Wine_Type"){

					hideShowYearAndRestrcitionFields("hide");
					hideShowWineNameFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowSelectWineryFields("hide");
					hideShowSelectRegionFields("hide");
					hideShowSelectGrapeFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
					
					hideShowWineTypeFields("show");
					
					//ajax call to get wine types from the database table wine_type
					$.ajax({
					    url:"getSearchDataAjax.php?tableName=wine_type",
					    type:"GET",
					    success:function(msg){
						    //add html code 
					    	$("#selectWineTypeRow").html(msg);
					    	
					    },
					    error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					    }
					});
				}

				else if(selectTypeOption == "By_Winery"){

					hideShowYearAndRestrcitionFields("hide");
					hideShowWineNameFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowWineTypeFields("hide");
					hideShowSelectRegionFields("hide");
					hideShowSelectGrapeFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
					
					hideShowSelectFields("show");
					
				}

				else if(selectTypeOption == "By_Region"){

					hideShowYearAndRestrcitionFields("hide");
					hideShowWineNameFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowWineTypeFields("hide");
					hideShowSelectWineryFields("hide");
					hideShowSelectGrapeFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
					
					hideShowSelectRegionFields("show");
					//ajax call to get region from the database table region
					$.ajax({
					    url:"getSearchDataAjax.php?tableName=region",
					    type:"GET",
					    success:function(msg){
						    //add html code 
					    	$("#selectRegionRow").html(msg);
					    	
					    },
					    error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					    }
					});
				}

				else if(selectTypeOption == "By_Grape"){

					hideShowYearAndRestrcitionFields("hide");
					hideShowWineNameFields("hide");
					hideShowRestrcitionValueFields("hide");
					hideShowWineTypeFields("hide");
					hideShowSelectWineryFields("hide");
					hideShowSelectRegionFields("hide");
					hideShowSelectFields("hide");
					hideShowWineryFields("hide");
					
					hideShowSelectGrapeFields("show");
										
					//ajax call to get region from the database table region
					$.ajax({
					    url:"getSearchDataAjax.php?tableName=grape_variety",
					    type:"GET",
					    success:function(msg){
						    //add html code 
					    	$("#selectGrapeRow").html(msg);
					    	
					    },
					    error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					    }
					});
				}
				
			});

			$("#selectRestriction").change(function() {
				var selectTypeOption = $('#selectRestriction').val();
				hideShowRestrcitionValueFields("show");
			});

			$("#selectSelect").change(function() {
				var selectSelect = $('#selectSelect').val();

				if(selectSelect == "enter_value"){

					hideShowSelectWineryFields("hide");
					hideShowWineryFields("show");
					
				}else if(selectSelect == "select_value"){

					hideShowSelectWineryFields("show");
					hideShowWineryFields("hide");
					//ajax call to get wine types from the database table wine_type
					$.ajax({
					    url:"getSearchDataAjax.php?tableName=winery",
					    type:"GET",
					    success:function(msg){
						    //add html code 
					    	$("#selectWineryRow").html(msg);
					    	
					    },
					    error: function(xhr, desc, err) {
					        console.log(xhr);
					        console.log("Details: " + desc + "\nError:" + err);
					    }
					});	
				}else{
					hideShowSelectWineryFields("hide");
					hideShowWineryFields("hide");
				}
			});
		});

		function getRestriction(){

			var selectTypeOption = $('#selectSearchBy').val();

			
			if(selectTypeOption == "By_Wine_Name"){
				addOptionsToFinalRestriction("wine_name Like %" + $('#wineName').val()  +"%");
			}
			else if(selectTypeOption == "By_Wine_Type"){
				addOptionsToFinalRestriction( "wine_type = " + $('#selectWineType').val());
			}
			else if(selectTypeOption == "By_year"){
				addOptionsToFinalRestriction( "year " + $('#selectRestriction').val() +" " + $('#restrictionValue').val());
			}
			else if(selectTypeOption == "By_cost"){
				addOptionsToFinalRestriction( "cost " + $('#selectRestriction').val() +" " + $('#restrictionValue').val());
			}
			else if(selectTypeOption == "By_Winery"){

				var selectSelect = $('#selectSelect').val();
				
				if(selectSelect == "enter_value"){
					
					addOptionsToFinalRestriction("winery_name Like %" + $('#wineryName').val()  +"%");
				}
				else if(selectSelect == "select_value"){
					addOptionsToFinalRestriction("winery_name = " + $('#selectWinery').val());
				}
			}
			else if(selectTypeOption == "By_Region"){
				addOptionsToFinalRestriction( "region_type = " + $('#selectRegion').val());
			}
			else if(selectTypeOption == "By_Grape"){
				addOptionsToFinalRestriction( "variety = " + $('#selectGrape').val());
			}else{
				alert("Please select a value");
			}
		}

		function removeRestriction(){

			var selectFinalRestrictionValue = $('#selectFinalRestriction').val();
			$("#selectFinalRestriction option[value='"+selectFinalRestrictionValue+"']").remove();
		}
		
		function addOptionsToFinalRestriction(optionVal) {

			$('#selectFinalRestriction').append($("<option/>", {
				value : optionVal,
				text : optionVal
			}));
		}
		
		</script>
	</head>
	
	<body>
		<h1>Search Wine</h1>
		
		<form>
			<table>
				<tr>
					<td>Search: </td>
					<td id="wineNameRowLabel" style="display: none">Enter Wine Name: </td>
					<td id="selectWineTypeRowLabel" style="display: none">Select Wine Type: </td>
					<td id="selectRestrictionRowLabel" style="display: none">Select Restriction type: </td>
					<td id="restrictionValueRowLabel" style="display: none">Select Restriction Value: </td>
					<td id="selectRowLabel" style="display: none">Select : </td>
					<td id="selectWineryRowLabel" style="display: none">Select Winery: </td>
					<td id="wineryNameRowLabel" style="display: none">Enter Winery Name: </td>
					<td id="selectRegionRowLabel" style="display: none">Select Region: </td>
					<td id="selectGrapeRowLabel" style="display: none">Select Grape: </td>
					<td></td>
					<td>Final Restrictions</td>
					<td></td>
				</tr>
				
				<tr>
					<td><select id="selectSearchBy" name="selectSearchBy">
						<option value="By_Search_By">Select Search By</option>
						<option value="By_Wine_Name">By Wine Name</option>
						<option value="By_Wine_Type">By Wine Type</option>
						<option value="By_year">By year</option>
						<option value="By_cost">By cost</option>
						<option value="By_Winery">By Winery</option>
						<option value="By_Region">By Region</option>
						<option value="By_Grape">By Grape</option>
				</select></td>
				
				<td id="wineNameRow" style="display: none"><input type="text" id="wineName" /></td>
				
				<td id="selectWineTypeRow" style="display: none"></td>
				
				<td id="selectRestrictionRow" style="display: none">
					<select style="width: 150px" name= "selectRestriction" id="selectRestriction">
						<option value="0">Select restriction</option>
                 		<option value="&gt;">&gt;</option>
                 		<option value="&lt;">&lt;</option>
                 		<option value="&gt;=">&gt;=</option>
                 		<option value="&lt;=">&lt;=</option>
                		<option value="=">=</option>
					</select>
				</td>	
				
				<td id="restrictionValueRow" style="display: none"><input type="number" id="restrictionValue" /></td>
				
				<td id="selectRow" style="display: none">
					<select style="width: 150px" name= "selectSelect" id="selectSelect">
						<option value="0">Select</option>
						<option value="enter_value">Enter Like Value</option>
						<option value="select_value">Select from list</option>
					</select></td>
					
				<td id="selectWineryRow" style="display: none"></td>
				
				<td id="wineryNameRow" style="display: none"><input type="text" id="wineryName" /></td>
				
				<td id="selectRegionRow" style="display: none"></td>
				
				<td id="selectGrapeRow" style="display: none"></td>
				
				<td> <input type="button" value=">>" onclick="getRestriction()"></td>
				<td><select id="selectFinalRestriction" style="width: 200;height: 120" multiple="multiple"></select></td>
				
				<td><input type="button" value="Remove" onclick="removeRestriction()"> <br><br><input type="submit" value=" Search "></td>
				</tr>
			</table>
			<hr>
		</form>
	</body>
</html>


<?php




?>