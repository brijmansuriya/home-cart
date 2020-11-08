<?php

   include('script/server/site-master.php');

   $s = new SiteMaster();
   $cmp_no = openssl_random_pseudo_bytes(10);
   print(bin2hex($cmp_no));
   while (true) {
      if($r = $s->select(Array('cmp_no'),'_ecm_product_brand_mstr',"cmp_no like '%".$cmp_no."%'")){
         $cnt = mysqli_num_rows($r);
         if($cnt > 0 || $cnt == 1){
            $cmp_no = openssl_random_pseudo_bytes(10);
         }
         else{
            print("<br>".bin2hex($cmp_no));         
            break;
         }
      }   
   }
   print("<br>".bin2hex($cmp_no));
//header('content-type:image/jpg');
   //include('script/server/site-master.php');

   // $r = $db->select(Array('pro_pic'),'_ecm_site_mstr');

   // $data = mysqli_fetch_assoc($r);
   
   // echo("<img height='800' src='data:image/*;base64,".base64_encode($data['pro_pic'])."'>");
    //echo $data['pro_pic'];
   //print(base64_decode($data['pro_pic']));

   // $json = file_get_contents('https://api.postalpincode.in/pincode/360005');
   // $obj = json_decode($json);
   // print_r($obj[0]->Status);
   // $token = "28c24176cc7d262ea2cb618da6811da6";
   // $email = "vivekkudecha@gmail.com";
   // $otp = "860458";
   
   // $token = base64_encode($token);

   // //print(base64_decode($token.$email.$otp));
   // printf("<a href='script/server/CustomerVerification.php/$token'>Verify</a>")

   // $cnt = 0;
   // $p = "";
   // for ($i = 0; $i < 1000000; $i++)
   // {
   //    $c = bin2hex(openssl_random_pseudo_bytes(20));
   //    if($p != $c){
   //       $cnt++;
   //       print($cnt."<br>");
   //       $p = $c;
   //    }else{
   //       print("<br>".$cnt);
   //       break;
   //    }
   // }  
   
?>