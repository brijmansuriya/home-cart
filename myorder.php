<?php
	require_once(__DIR__ ."\admin\controller\Functional.php");
	$site = new Assets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<?php require_once('client/model/HeaderScript.php'); ?>
	<style>
		
	</style>
</head>
<body class="animsition">
	
    <?php require_once('client/model/Navbar.php') ?>
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/cart-banner.jpg);">
		<h2 class="l-text2 t-center">
			MY ORDERS
		</h2>
    </section>
    <section class="cart bgwhite p-t-70 p-b-100">
        <div class="container">            
            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                        <!--  -->
                        <div class="flex-sb-m flex-w p-b-35">
                            <div class="flex-w">                                
                                <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                <select class="form-control" id="sorting" >
                                        <option value='-1'>Records Per Page</option>
                                        <option value='1'>1</option>
                                        <option value='3'>3</option>
                                        <option value='5'>5</option>
                                        <option value='10'>10</option>
                                        <option values='20'>20</option>    
                                    </select>
                                </div>
                            </div>
                        </div>
            </div>
            <div id="OrderTable"></div>  		
			
		</div>
	</section>

	<?php require_once('client/model/FooterData.php'); ?>	
	<?php require_once('client/model/FooterScript.php'); ?>
</body>
</html>
<script type="text/javascript">
    function load_data(data)  
    {  
             $.ajax({  
                    url:"admin/controller/OrderController.php",  
                    type:"POST",  
                    data:data,
                    processData : false,
                    contentType : false,
                    cache : false,
                    async : false,
                    success:function(data){  
                        $('#OrderTable').html(data);  
                    }  
            })  
    } 

    function CancelOrder(e){
        $(e).parent().parent().parent().remove(); // continue
    }

	$(document).ready(function(){

        var data = new FormData();
        data.append('action','OrderTable');
        data.append('page',1);
		load_data(data);  
         
        $(document).on('click', '.pagination_link', function(){  
            var page = $(this).attr("id");  
            var data = new FormData();
            if($('#sorting').val() > 0){
                data.append('rec_per_page',$('#sorting').val());
            }
            data.append('page',page);
            data.append('action','OrderTable');
            load_data(data);  
        });  

        $(document).on('change', '#sorting', function(){  
            if($('#sorting').val() < 0){
                return;
            }

            var data = new FormData();
            data.append('page',1);
            data.append('rec_per_page',$('#sorting').val());
            data.append('action','OrderTable');
            load_data(data);  

        });  
	})
</script>