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
					}
				});
        }
        var title='';
        var id2='';
        //function to edit a research
        function toModal(id){
            id2=id;
            $.ajax({
				url:"toPass.php",
				method:"POST",
				data:{id:id},
				dataType: 'json',
				success:function(response){
					$('#editModal').html(response);
                    document.getElementById("pass").focus();
                }
			});
        }
        function toCheck2(id){
            var letters = /^([a-zA-Z]+\s)*[a-z]+$/;
            if((id=='fname')||(id=='lname')){
                var fname=$("#"+id).val();
                var fname = fname.replace(/ +(?= )/g,'');
                var newName = fname.trim();
                document.getElementById(id).value = newName;
            }else if((id=='uploaded_file')||(id=='imgrad_file')){
                var fileName=$("#"+id).val();
                // Another way: checking the type of the file
                if ( $('#'+id)[0].files[0].type != 'application/pdf' ) {
                    alert( 'it is not pdf File' );
                    document.getElementById(id).value = "";
                }
            }else{
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                var email=$("#"+id).val();
                email = email.trim();
                if(email.match(mailformat)){
                    document.getElementById(id).value = email;
                }else{
                    if(email!=''){
                        alert("Invalid Email!");
                        document.getElementById(id).value = '';
                        document.getElementById(id).focus();
                    }
                }
            }
        }
        /*function toCheck3(id){
            var letters = /^([a-zA-Z]+\s)*[a-z]+$/;
            if(id=='lname'){
                var lname=$("#lname").val();
                lname = lname.replace(/ +(?= )/g,'');
                var newName = lname.trim();
                if(newName.toLowerCase().match(letters)){
                    document.getElementById("lname").value = newName;
                }else{
                    alert("Invalid Last Name!");
                }
            }
        }*/
        function toCheck(){
            var x=$("#pass").val();
            var numbers = /^[0-9]+$/;
            if(x.match(numbers))
            {
                if(x.length<=4){
                    if(x.length==4){
                        $.ajax({
                            url:"toCheck.php",
                            method:"POST",
                            data:{x:x},
                            dataType: 'json',
                            success:function(response){
                                if(response=="invalid"){
                                    alert("Invalid PIN Number ! Re-enter to continue.");
                                    document.getElementById("pass").value = '';
                                    document.getElementById("pass").focus();
                                }else{
                                    openEdit();
                                    
                                }
                            },
                            error:function(xhr,status,error){
                                alert(xhr.responseText);
                            }
                        });
                    }
                }else{
                    alert("invalid");
                }
            }else{
                if(x!=''){
                    alert("Number only");
                    document.getElementById("pass").value = '';
                    document.getElementById("pass").focus();
                }
            }
        }
        function openEdit(){
            var id=id2;
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
                var letters = /^([a-zA-Z]+\s)*[a-z]+$/;
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
                        url:"toUpdate.php",
                        method:"POST",
                        data:formData,
                        dataType: 'json',
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function(response){
                            if(response=='true'){
                                location.reload();
                            }
                        },
                        error:function(xhr,status,error){
                            alert(xhr.responseText);
                        }
                    });
                }else{
                    alert("Please fill up the required field");
                }
                
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
                        $("#modalBody").html(data);
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
                        $("#modalBody").html(data);
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
                        $("#modalBody").html(data);
                        
					}
				});
			});

		$(document).on('click', '#select0', function(){
            var select="#select";
            if ($("#select0").prop("checked")) { 
                for(var i=1;i<20;i++){
                    var res = select.concat(i.toString());
                    $(res).prop("checked", true);
                }
            }else{
                for(var i=1;i<20;i++){
                    var res = select.concat(i.toString());
                    $(res).prop("checked", false);
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
                            if((this.id=="select10") || (this.id=="select11") || (this.id=="select12") || (this.id=="select13") || (this.id=="select14") || (this.id=="select15") || (this.id=="select16") || (this.id=="select17") || (this.id=="select18") || (this.id=="select19")){
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
                            }

                        }
                    });
           }
        }
        function toClear(){
            var selectedVal= document.getElementById("agenda").options;
            var selectedVal2= document.getElementById("college").options;
            document.getElementById("fname").value="";
            document.getElementById("lname").value="";
            document.getElementById("email").value="";
            document.getElementById("agenda").selectedIndex =1;
            document.getElementById("college").selectedIndex =1;
            document.getElementById("abstractName").value="";
            document.getElementById("uploaded_file").value="";
            document.getElementById("imgrad_file").value="";
            $('#student').prop('checked',true);
            document.getElementById("fname").focus();
        }
	</script>
    <script type="text/javascript"> 
            $(document).ready(function() {
            $('#search').off('keyup');
            $('#search').on('keyup', function() {
                // Your search term, the value of the input
                var searchTerm = $('#search').val();
                // table rows, array
                var tr = [];
                // Loop through all TD elements
                $('#table').find('td').each(function() {
                    var value = $(this).html();
                    // if value contains searchterm, add these rows to the array
                    if (value.toLowerCase().includes(searchTerm.toLowerCase())) {
                        tr.push($(this).closest('tr'));
                    }
                });
                // If search is empty, show all rows
                if ( searchTerm == '') {
                    $('tr').show();
                }
                else {
                    // Else, hide all rows except those added to the array
                    $('tr').not('thead tr').hide();
                    tr.forEach(function(el) {
                        el.show();
                    });
                }
            });
        });
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
            
        }  float: none;
        
        #category{
            font-weight: bold;
        }
        #dropdownButton{
            color: white;
        }
        #dropdownButton:hover{
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }
         .modal-title {
          min-height: 16.42857143px;
          padding: 15px;
          border-bottom: 1px solid #763435;
          }
	</style>
</head>
<body style="background-color: #f6f6f6">
    <nav class="navbar nav-tabs navbar-expand-lg navbar-dark" style="background-color: #763435">
        <a class="navbar-brand justify-content-left" href="#">
            <img class="img d-lg-block d-none" style="height: 75px" src="Icon/header.png">
            <img class="img d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
        <button class="navbar-toggler ml-auto hidden-sm-up float-xs-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto"></ul>
            <li style="list-style-type:none;"><a class="btn nav-item" href="adminnew.php">DASHBOARD</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item"  style="font-weight: bold;" href="uploadnew.php" id="disabled">RESEARCHES</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="uploadform.php">UPLOAD FORM</a></li>
            <li style="list-style-type:none;"><div class="dropdown" style="color: white;">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPTIONS</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="userManual.php">Documentation</a>
                    <a class="dropdown-item" style="color: black" href="dlForms.php">Forms</a>
                </div>
                </div></li>
            <li style="list-style-type:none;"><div class="dropdown" style="color: white;">
              <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE ACCOUNT</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="rc_accounts.php">RC Accounts</a>
                    <a class="dropdown-item" style="color: black" href="addaccount.php">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="changepassAdmin.php">Edit Account</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
                </div></li>
        </div>
    </nav>
	<div class="container-fluid">
        <br>
        <h2 class="pt-3 text-center" style="font-weight:bold;">LIST OF RESEARCHES</h2><br>
            <div class="row">
                <div class="input-group col-md-8 offset-md-2 bg-light p-4 rounded">
                    <input class="form-control border-right-0" autocomplete="off" type="text" id="search" placeholder="Search Here" >
                    <span class="input-group-append bg-white border-left-0">
                        <span class="input-group-text bg-transparent" >
                            <i class="fa fa-search"></i>
                        </span>
                    </span>
                </div>
                <div class="col-md-8" style="position: absolute; margin-top:-38px; margin-left:215px; width:100%">
                </div>
            </div><br>
        
			<div id="tableFetch"></div>
			<div id="gpdf" style="margin-bottom:5%">
				 <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#openMdal" onclick="openModal()"> Generate Report</button>
			</div>
	</div>
    <!-- modal for edit -->
        <div class="modal" tabindex="-1" id="editModal" role="dialog"></div>
    <!-- modal for PIN -->
        <div class="modal" tabindex="-1" id="pinModal" role="dialog"></div>
	<!-- Modal -->
	<div class="modal fade " id="openMdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header"  style="border:none; margin:0; padding-left:30px;" id="modalHeader">
					<h3 class="col-12 modal-title text-center" id="exampleModalLongTitle" style="font-weight: bold; color: #763435">Select Category
                    <button type="button" id="xClose" class="close" data-dismiss="modal" style="font-size:30px; color:dimgray; float:right;">&times;</button></h3><hr>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="radio1" value="option1" checked>
                            <label class="form-check-label" for="radio1" style="font-weight: bold"> By Date</label>
                        </div>
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="radio2" value="option2">
                            <label class="form-check-label" for="radio2" style="font-weight: bold"> By Colleges</label>
                        </div>
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="radio3" value="option3" >
                            <label class="form-check-label" for="radio3" style="font-weight: bold"> By Agenda</label>
                        </div>
                        <div class="col form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="radio4" value="option4" >
                            <label class="form-check-label" for="radio5" style="font-weight: bold"> By Affiliation</label>
                        </div>
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