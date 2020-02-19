<?php 
session_start();
include("connect.php");
require_once "authCookieSessionValidate.php";
require_once "Auth.php";

$auth = new Auth();

if(!$isLoggedIn) {
    header("Location: loginSample.php");
}
$count=1;
?>

<!DOCTYPE html>
<html>
<head>   
    <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
	<link rel="stylesheet" href="trytry.css">
	<script type="text/javascript">
		$(document).ready(function(){
			function load_unseen_notification()
			{
				$.ajax({
					url:"fetchUpload.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
						$("#tableFetch").html(data.output);
                        $("#modalBody").html(data.output2);
                        $("#year").attr("disabled",data.flag1);
                        if(data.flag1==false){
                            $("#months").hide();
                            $("#labelForMnth").hide();
                        }else{
                            $("#months").attr("disabled",data.flag2);
                        }
                        
					}
				});
			}
			load_unseen_notification();
		});
        function openModal(){
            $("#radio1").prop("checked",true);
            $.ajax({
					url:"fetchDate.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
                        $("#modalBody").html(data.output2);
                        $("#year").attr("disabled",data.flag1);
                        if(data.flag1==false){
                            $("#months").hide();
                            $("#labelForMnth").hide();
                        }else{
                            $("#months").attr("disabled",data.flag2);
                        }
					}
				});
        }
        var title='';
        //function to edit a research
        function toModal(id){
            $('#editModal').html("");
            $.ajax({
				url:"toEdit.php",
				method:"POST",
				data:{id:id},
				dataType: 'json',
				success:function(response){
					$('#editModal').html(response.output);
                    title=response.title;
                }
			});
        }
        var rn='';
        
        function toDel(id){
            $('#editModal').html("");
            $.ajax({
				url:"toDel.php",
				method:"POST",
				data:{id:id},
				dataType: 'json',
				success:function(response){
                    $('#editModal').html(response.output);
                    rn=response.rn;
                }
			});
        }
        function toDelete(){
            var pass=$("#pass2").val();
            if(pass!=''){
                var data=pass+"*"+rn;
                $.ajax({
                    url:"toDel.php",
                    method:"POST",
                    data:{data:data},
                    dataType: 'json',
                    success:function(response){
                        if(response=='okay'){
                            alert("Deleted Successfully");
                            location.reload();
                        }
                    }
                });
            }else{
                alert("Please fill up the required field");
                $("#pass2").focus();
            }
        }
        var formData=new FormData();
        //function to update a research
        function toUpdate(id){
            
            if(id=='save'){
                var fname=$("#fname").val();
                var lname=$("#lname").val();
                var email=$("#email").val();
                var agenda=$("#agenda").val();
                var college=$("#college").val();
                var staticRN=$("#staticRN").html();
                var abstractName=$("#abstractName").val();
                var vidFileLength = $("#uploaded_file")[0].files.length;
                if((fname!='') && (lname!='') && (email!='') && (agenda!='') && (college!='') && (abstractName!='') && (vidFileLength != 0 )){
                    var category='';
                        formData.append('uploaded_file',$('#uploaded_file')[0].files[0]);
                        formData.append('imgrad_file',$('#imgrad_file')[0].files[0]);
                        formData.append('fname',fname);
                        formData.append('lname',lname);
                        formData.append('staticRN',staticRN);
                        formData.append('email',email);
                        formData.append('agenda',agenda);
                        formData.append('college',college);
                        formData.append('abstractName',abstractName);

                        formData.append('title',title);
                      if ($('#student').is(':checked')) {
                          category=$("#student").val();
                          formData.append('radio',category);
                      }if ($('#faculty').is(':checked')) {
                          category=$("#faculty").val();
                          formData.append('radio',category);
                      }
                    $.ajax({
                        url:"toPass.php",
                        method:"POST",
                        dataType: 'json',
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function(response){
                            $('#editModal').html(response);
                        },
                        error:function(xhr,status,error){
                            alert(xhr.responseText);
                        }
                    });
                }else{
                    alert("Please fill up the required field");
                }
                
            }else{
                var pass=$("#pass").val();
                formData.append('pass',pass);
                $.ajax({
                    url:"toUpdate.php",
                    method:"POST",
                    data:formData,
                    dataType: 'json',
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(response){
                        alert(response);
                        location.reload();
                    },
                    error:function(xhr,status,error){
                        alert(xhr.responseText);
                    }
                });

            }
        }
        
		function getValue(i){
			$.ajax({
				url:"toPdf.php",
				method:"POST",
				data:{i:i},
				dataType:"json",
				success:function(data)
				{
					if(data=="okay"){
						window.open("pdfDisplay.php");
					}
					else{
						alert(data);
					}
				}
			});
				
		}
		$(document).on('click', '#radio1', function(){
            $("#modalBody").html("");
                $.ajax({
					url:"fetchDate.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
                        $("#modalBody").html(data.output2);
                        $("#year").attr("disabled",data.flag1);
                        if(data.flag1==false){
                            $("#months").hide();
                            $("#labelForMnth").hide();
                        }else{
                            $("#months").attr("disabled",data.flag2);
                        }
					}
				});
			});
		$(document).on('click', '#radio2', function(){
            $("#modalBody").html("");
                $.ajax({
					url:"fetchCol.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
                        var output='';
                        $("#modalBody").html(data[0]);
                        for(var i=1;i<data.length;i++){
                            output=data[i].split("*");
                            if(output[1]==='true'){
                                $(output[0]).attr("disabled",true);
                            }else{
                                $(output[0]).attr("disabled",false);
                            }
                            
                        }
					}
				});
			});
		$(document).on('click', '#radio3', function(){
            $("#modalBody").html("");
			$.ajax({
					url:"fetchAge.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
                        var output='';
                        $("#modalBody").html(data[0]);
                        for(var i=1;i<data.length;i++){
                            output=data[i].split("*");
                            if(output[1]=='true'){
                                $(output[0]).attr("disabled",true);
                            }else{
                                $(output[0]).attr("disabled",false);
                            }
                            
                        }
					}
				});
		});
        $(document).on('click', '#radio4', function(){
            $("#modalBody").html("");
                $.ajax({
					url:"fetchAffliate.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
                        $("#modalBody").html(data.output);
                        $("#category").attr("disabled",data.flag1);
                        
					}
				});
			});

		$(document).on('click', '#select0', function(){
            var select="#select";
            for(var i=1;i<20;i++){
                var res = select.concat(i.toString());
                if ($(res).prop( 
                      "disabled")) { 
                        $(res).prop("checked", false);
                } else { 
                    $(res).prop("checked", true);
                } 
            }
            
            
		});
		$(document).on('click', '.chck1', function(){
			var bool=$('input[type=checkbox]').prop('checked');
			if(bool){
				$("#select0").prop("checked", false);
			}
			
		});
		function submitFunc(){
           if ($('#radio1').is(':checked')) {
            var year=$("#year").val();
            var months=$("#months").val();
            var value=year+"*"+months;
                $.ajax({
                    url:"pdf.php",
                    method:"POST",
                    data:{value:value},
                    dataType:"json",
                    success:function(data)
                    {
                        if(data=='1:1'){
                            window.open("viewsPdfUpload.php");
                        }else if(data=='1:all'){
                            window.open("viewsPdfUpload2.php");
                        }else if(data=='all:1'){
                            window.open("viewsPdfUpload3.php");
                        }else{
                            window.open("viewsPdfUpload4.php");
                        }

                    }
                });
                    //
           }else if ($('#radio2').is(':checked')) {
               var check=0;
               var id='';
               $('input[type=checkbox]').each(function () {
                    if (this.checked){
                        check+=1;
                        if(this.id!="select0"){
                            if((this.id=="select10") || (this.id=="select11") || (this.id=="select12") || (this.id=="select13") || (this.id=="select14") || (this.id=="select15") || (this.id=="select16") || (this.id=="select17") || (this.id=="select18") || (this.id=="select19") || (this.id=="select20")){
                                var slce=this.id.slice(6,8);
                                id=id.concat(slce+"*"); 
                            }else{
                                var slce=this.id.slice(6,7);
                                id=id.concat(slce+"*");
                            }
                            
                            
                        }
                        
                    }
                });
               if(check!=0){
                   $.ajax({
				        url:"pdf2.php",
                        method:"POST",
                        data:{id:id},
                        dataType:"json",
                        success:function(data)
                        {
                          if(data=="ok"){
                              window.open("pdftoDsplayCol.php");
                          }else{
                              alert(data);
                          }
                        }
				    });
                   //alert(id);
               }else{
                   alert("Please check the checkboxes");
               }
           }else if ($('#radio3').is(':checked')) {
               var check=0;
               var id='';
               $('input[type=checkbox]').each(function () {
                    if (this.checked){
                        check+=1;
                        if(this.id!="select0"){
                            var slce=this.id.slice(6,7);
                            id=id.concat(slce+"*");
                        }
                        
                    }
                });
               if(check!=0){
                   $.ajax({
				        url:"pdf3.php",
                        method:"POST",
                        data:{id:id},
                        dataType:"json",
                        success:function(data)
                        {
                          if(data=="ok"){
                              window.open("pdftoDsplayAgd.php");
                          }
                        }
				    });
                   //alert(id);
               }else{
                   alert("Please check the checkboxes");
               }
               
           }else{
                var category=$("#category").val();
                    $.ajax({
                        url:"pdf4.php",
                        method:"POST",
                        data:{category:category},
                        dataType:"json",
                        success:function(data)
                        {
                            if(data=='all'){
                                window.open("viewsPdfAffliate.php");
                            }else{
                                window.open("viewsPdfAffliate2.php");
                            }

                        }
                    });
           }
        }
        $(document).on('change', '#year', function(){
            var year=$("#year").val();
			$.ajax({
					url:"fetchMonth.php",
					method:"POST",
					dataType:"json",
                    data:{year:year},
					success:function(data)
					{
                        $("#months").attr("disabled",data.flag2);
                        $("#months").html(data.mnth);
                        
					}
            });
            
            $("#months").show();
            $("#labelForMnth").show();
		});
        function toClear(){
            var selectedVal= document.getElementById("agenda").options;
            var selectedVal2= document.getElementById("college").options;
            document.getElementById("fname").value="";
            document.getElementById("fname").focus();
            document.getElementById("lname").value="";
            document.getElementById("email").value="";
            document.getElementById("agenda").selectedIndex =1;
            document.getElementById("college").selectedIndex =1;
            document.getElementById("abstractName").value="";
            document.getElementById("uploaded_file").value="";
            document.getElementById("imgrad_file").value="";
            $('#student').prop('checked',true);
            
        }
	</script>
	<style>
		#myBtn {
          display: none;
          position: fixed;
          bottom: 20px;
          right: 30px;
          z-index: 99;
          font-size: 18px;
          border: none;
          outline: none;
          background-color: #763435;
          color: white;
          cursor: pointer;
          padding: 15px;
          border-radius: 50px;;
            font-size: 80%;
        }

        #myBtn:hover {
          background-color: #555;
        }
        .my-custom-scrollbar {
        position: relative;
        height: 255px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
        th{
            position: sticky;
        }
		.dropdown-item active{
			background-color:#763435;
			border-color:#763435;
		}
		
		#xClose:hover {
          color: #555;
        }
		.form-check{
			padding:10px;
		}
		#disabled{
			pointer-events: none;
		}
        .modal-content{
            padding: 0;
            
        }
        #category{
            font-weight: bold;
        }
	</style>
</head>
<body style="background-color: #f6f6f6">
    <nav class="navbar nav-tabs navbar-expand-lg navbar-dark" style="background-color: #763435">
        <a class="navbar-brand" href="#">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 49px" src="Icon/header.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" href="adminnew.php" >DASHBOARD</a>
            <a class="btn nav-item" style="font-weight: bold" id="disabled" href="uploadnew.php">RESEARCHES</a>
            <a class="btn nav-item" href="uploadform.php">UPLOAD FORM</a>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPTIONS</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="userManual.php">Documentation</a>
                    <a class="dropdown-item" style="color: black" href="dlForms.php">Forms</a>
                </div>
            </div>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE ACCOUNT</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="addaccount.php">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="rc_accounts.php">RC Accounts</a>
                    <a class="dropdown-item" style="color: black" href="edit_accountsample.php">Edit Account</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
	<div class="container-fluid">
        <br>
        <h2 class="text-center" style="font-weight:bold;">LIST OF RESEARCHES</h2><br>
			<div id="tableFetch"></div>
			<div id="gpdf">
				 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#openMdal" onclick="openModal()"> Generate Report</button>
			</div>
	</div>
    <!-- modal for edit -->
        <div class="modal" tabindex="-1" id="editModal" role="dialog"></div>
	<!-- Modal -->
	<div class="modal fade " id="openMdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header"  style="border:none; margin:0; padding-left:30px;" id="modalHeader">
					<h5 class="modal-title" id="exampleModalLongTitle">Select Category</h5>
						<button type="button" id="xClose" class="close" data-dismiss="modal" style="font-size:30px; color:dimgray; float:right;">&times;</button>
				</div>
				<div class="modal-body" style=" margin:0;padding-left:10px; padding-right:10px;">
				 
					<div class="form-check form-check-inline" style="margin-left:20px; margin-right:30px;">
						<input class="form-check-input" type="radio" name="exampleRadios" id="radio1" value="option1" checked>
						<label class="form-check-label" for="radio1">
							By Date
						</label>
					</div>
				<div class="form-check form-check-inline" style=" margin-right:10px;">
					<input class="form-check-input" type="radio" name="exampleRadios" id="radio2" value="option2">
					<label class="form-check-label" for="radio2">
						By Colleges
					</label>
				</div>
				<div class="form-check form-check-inline "  style=" margin-right:10px;">
					<input class="form-check-input" type="radio" name="exampleRadios" id="radio3" value="option3" >
					<label class="form-check-label" for="radio3">
						By Agenda
					</label>
				</div>
				<div class="form-check form-check-inline "  style=" margin-right:10px;">
					<input class="form-check-input" type="radio" name="exampleRadios" id="radio4" value="option4" >
					<label class="form-check-label" for="radio5">
						By Affiliation
					</label>
				</div>
                <div id="modalBody"></div>
				<br><br>
				<div class="modal-footer" style="border:none;">
					<button type="button" class="btn btn-dark" id="submit" onclick="submitFunc()">Submit</button>
				</div>
			</div>
		</div>
	</div>
    </div>
</body>
</html>