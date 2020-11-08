class SiteGlobal{

     // Custom Error Function (Requires the jQuery)
    WriteError(Obj,ErrorType,Highlight,ErrorMsg){
        var errStr = "<div class='sufee-alert alert with-close alert-"+ErrorType+" alert-dismissible fade show'><span class='badge badge-pill badge-"+ErrorType+"'>"+Highlight+"</span>&nbsp;&nbsp;"+ErrorMsg+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>";
        $(Obj).html(errStr);
    }

    // Custom Write Message To Fronend
    WriteMsg(Obj,MsgType,Highlight,Msg){
        swal(Highlight,Msg,MsgType);
        // var msgStr = "<div class='sufee-alert alert with-close alert-"+MsgType+" alert-dismissible fade show'><span class='badge badge-pill badge-"+MsgType+"'>"+Highlight+"</span>&nbsp;&nbsp;"+Msg+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>";
        // $(Obj).html(msgStr);
    }  

    JSON_CODE_MSG(Code,MsgEle = null,file_min = 50,file_max = 1){
        let site = new SiteGlobal();
        //alert(Code);
        switch (Code.statusCode) {
            case 100:
                site.WriteMsg(MsgEle,'info','Status ','Continue !');
                break;
            case 101:
                site.WriteMsg(MsgEle,'info','Switchig ','Protocol !');
                break;
            case 200:
                site.WriteMsg(MsgEle,'info','Status ','Ok !');
                break;
            case 201:
                site.WriteMsg(MsgEle,'info','Created ','!');
                break;
           case 202:
                site.WriteMsg(MsgEle,'info','Accepted ','!');
                break;
            case 203:
                site.WriteMsg(MsgEle,'info','Non-Authoritative ','Information !');
                break;
            case 204:
                site.WriteMsg(MsgEle,'info','Non ','Additional Content !');
                break;
            case 205:
                site.WriteMsg(MsgEle,'info','Reset ','Content !');
                break; 
            case 206:
                site.WriteMsg(MsgEle,'info','Partial ','Content !');
                break; 
            case 300:
                site.WriteMsg(MsgEle,'info','Mutiple ','Choice !');
                break; 
            case 301:
                site.WriteMsg(MsgEle,'info','Moved ','Perminently !');
                break; 
            case 302:
                site.WriteMsg(MsgEle,'info','Found ','!');
                break; 
            case 303:
                site.WriteMsg(MsgEle,'info','Not ','Modified !');
                break; 
            case 304:
                site.WriteMsg(MsgEle,'info','Reset ','Content !');
                break; 
            case 305:
                site.WriteMsg(MsgEle,'warning','Use ','Proxy !');
                break; 
            case 307:
                site.WriteMsg(MsgEle,'warning','Termporary ','Redirect !');
                break; 
            case 400:
                site.WriteMsg(MsgEle,'error','Bad ','Request !');
                break; 
            case 401:
                site.WriteMsg(MsgEle,'error','Unauthorized ',' !');
                break; 
            case 402:
                site.WriteMsg(MsgEle,'info','Payment ','Required !');
                break; 
            case 402:
                site.WriteMsg(MsgEle,'info','Payment ','Required !');
                break; 
            case 403:
                site.WriteMsg(MsgEle,'error','Access ','Forbidden !');
                break; 
            case 404:
                site.WriteMsg(MsgEle,'warning','Not ','Found !');
            case 405:
                site.WriteMsg(MsgEle,'info','Method ','Not Allowed !');
                break; 
            case 406:
                site.WriteMsg(MsgEle,'error','Not ','Acceptible !');
                break; 
            case 407:
                site.WriteMsg(MsgEle,'warning','Proxy ','Authentication Required !');
                break; 
            case 408:
                site.WriteMsg(MsgEle,'warning','Request ','Timeout !');
                break; 
            case 409:
                site.WriteMsg(MsgEle,'warning','Confict ','!');
                break;     
            case 410:
                site.WriteMsg(MsgEle,'warning','Gone ','!');
                break; 
            case 411:
                site.WriteMsg(MsgEle,'warning','Length ','Required !');
                break; 
            case 412:
                site.WriteMsg(MsgEle,'warning','Precondition ','Faild !');
                break; 
            case 413:
                site.WriteMsg(MsgEle,'warning','Payload ','Too Large !');
                break; 
            case 414:
                site.WriteMsg(MsgEle,'warning','URI ','Too Large !');
                break; 
            case 415:
                site.WriteMsg(MsgEle,'warning','Unsupported ','Media Type !');
                break; 
            case 416:
                site.WriteMsg(MsgEle,'warning','Range ','Not Setisfiable !');
                break; 
            case 417:
                site.WriteMsg(MsgEle,'error','Expecation ','Faild !');
                break; 
            case 426:
                site.WriteMsg(MsgEle,'error','Upgrade ','Required !');
                break; 
            case 500:
                site.WriteMsg(MsgEle,'error','Internal Server ','Error !');
                break; 
            case 501:
                site.WriteMsg(MsgEle,'warning','Not ','Error !');
                break; 
            case 502:
                site.WriteMsg(MsgEle,'error','Bad ','Getway !');
                break; 
            case 503:
                site.WriteMsg(MsgEle,'error','Service ','Unavailable !');
                break; 
            case 504:
                site.WriteMsg(MsgEle,'error','Service ','Unavailable !');
                break;  
            case 505:
                site.WriteMsg(MsgEle,'error','HTTP ','Version Not Supported !');
                break;   
            case 'DATA_SAVE':
                site.WriteMsg(MsgEle,'success','Data ','Saved Successfully !');
                break;  
            case 'EMPTY':                
                site.WriteMsg(MsgEle,'error','Empty ','Feilds Not Allows. Please Fill The All Feilds !');
                break;
            case 'DATA_LENGTH':
                site.WriteMsg(MsgEle,'warning','Data ','Lengths Not Match To The Standard Rules !');
                break;
            case 'DATA_EXIST':
                site.WriteMsg(MsgEle,'warning','Data ','Already Exist !');
                break;
            case 'PASSWORD':
                site.WriteMsg(MsgEle,'warning','Password ','Should be 6 to 16 Character long and contains the least One Digit,Capital Char,Special Char');
                break;
            case 'PASSWORD_MIS':
                site.WriteMsg(MsgEle,'warning','Password ','Mismatch From The Recent One !');
                break;
            case 'EMAIL':
                site.WriteMsg(MsgEle,'warning','Email ','is not valid !');
                break;
            case 'PHONE':
                site.WriteMsg(MsgEle,'warning','Phone / Mobile ','Number is not valid !');
                break;
            case 'PINCODE':
                site.WriteMsg(MsgEle,'warning','Pincode ','is not valid !');
                break;
            case 'FILE_SIZE':
                site.WriteMsg(MsgEle,'warning','File Size ','Not Be Less ' + file_min + ' KB and Not Be Grater Then ' + file_max + 'MB');
                break;
            case 'FILE_FORMAT':
                site.WriteMsg(MsgEle,'warning','File Format ','Not Supported !');
                break;
            case 'FILE_EMPTY':
                site.WriteMsg(MsgEle,'warning','File Should ','Not Be Empty.');
                break;
            case 'DATE':
                site.WriteMsg(MsgEle,'warning','Date ','Format Incorrect.');
                break;
            case 'GST':
                site.WriteMsg(MsgEle,'warning','GST ','Format Incorrect.');
                break;
            case 'URL':
                site.WriteMsg(MsgEle,'warning','URL ','Format Incorrect.');
                break;    
            case 'PRODCUT_PUR_LIMIT':
                site.WriteMsg(MsgEle,'warning','The Seller Not Support The ','They Many Prodcut To Deliver.');
                break;
            case 'PRODCUT_ADD_CART_SUCCESS':
                site.WriteMsg(MsgEle,'info','Product Added To ','Cart.');
                break;
            case 'PRODCUT_EXIST_IN_CART':
                site.WriteMsg(MsgEle,'warning','Product Already In ','Cart.');
                break;
            case 'PRODCUT_QANTITY_OVER_STOCK':
                site.WriteMsg(MsgEle,'warning','You Enter Too Many Qantity ','Against Stock.');
                break;
            case 'PRODCUT_QANTITY_INVALID':
                site.WriteMsg(MsgEle,'warning','You Enter Wring Qantity ','Based Your Order.');
                break;
            case 'CART_PRODCUT_UPDATED':
                location.reload(true);
                break;
            case 'PRODUCT_DELETED_FROM_CART':
                site.WriteMsg(MsgEle,'warning','Product Removed From Your ','Cart.');
                location.reload(true);
                break;
            case 'USER_DETAILS':
                site.WriteMsg(MsgEle,'warning','For Order Provide Address And Pincode ','Order Faild.');
                break;
            case 'ORDER_PLACED':
                site.WriteMsg(MsgEle,'success','Your Order Placed Successfully ','Thanks For Shopping With Us.');
                $('#cart_body').html(Code.EmptyCart)
                break;
            case 'CUSTOMER_ADD':
                window.location = 'login.php';
                break;
            case 'CUST_GRANTED':
                window.location = 'profile.php';
                break;
            case 'GRANT_ADMIN':
                window.location = 'index.php';
                break;
            default:
                break;
        }
    }

    Transaction(TargetFilePath,Method,SubmitedData,Action,ErrorElement){
        //err = new SiteGlobal();
        let err = new SiteGlobal();
        $.ajax({

            url:TargetFilePath,
            enctype : 'mutipart/form-data',
            method:Method,
            data:{
                SubmitedData : SubmitedData,
                action:Action
            },
            processData : false,
            contentType : false,
            beforeSend : function(){
                err.WriteError(ErrorElement,'info','Data','Processing !');
            },
            cache:false,
            success:function(result)
            {
                
                alert(result);
                try {
                    var r = jQuery.parseJSON(result);
                    if(r.statusCode == 200)
                    {
                        err.WriteError(ErrorElement,'success','Data','Save Successfully !');
                    }
                    else if(r.statusCode ==  "PasswordError"){
                        err.WriteError(ErrorElement,"warning","New And Confrim Password","Must be Same And 6 to 16 Character long. Contains The Least One Digit,Capital Char,Special Char");
                    }
                    else if(r.statusCode ==  "OldPasswordError"){
                        err.WriteError(ErrorElement,"warning","Old Password","is Wrong You Can't Modify The Old Password.");
                    }
                    else if(r.statusCode == 500)
                    {
                        err.WriteError(ErrorElement,"error","Server"," Not Responding !");
                    }
                    else if(r.statusCode == 400){
                        err.WriteError(ErrorElement,"error","Blank"," Values Not Allows");
                    }
                } catch (e) {
                    err.WriteError(ErrorElement,"error","Internal Server"," Error !");
                }
                
            }
        });
    }

    Transaction(TargetFilePath,Method,Data,MsgElement){
        let site = new SiteGlobal();
        $.ajax({
            type:Method,
            enctype : 'mutipart/form-data',
            url : TargetFilePath,
            data : Data,
            processData : false,
            contentType : false,
            cache : false,
            async : false,
            beforeSend : function(){
                site.WriteMsg(MsgElement,'info','Data','Processing !');
            },
            success : function(result){
              console.log(result);
               try {
                    var r = jQuery.parseJSON(result);
                    if(r.statusCode == 'REVOKE'){
                        window.location = 'login.php';
                    }                    
                    site.JSON_CODE_MSG(r,MsgElement);
                } catch (e) {
                    //site.WriteMsg(MsgElement,"error","Internal Server"," Error !");
                }
            }
        });
    }

    ControlGenerator(TargetFilePath,Method,Data){
        var t = ($.ajax({
            method:Method,
            url : TargetFilePath,
            data : Data,
            processData : false,
            contentType : false,
            global : false,
            async : false
        }));       

        return t.responseText;
    }

    GetSetFeild(TargetFilePath,method,data){
        var t = ($.ajax({
            method: method,
            url : TargetFilePath,
            data : data,
            processData : false,
            contentType : false,
            global : false,
            async : false,
        }));
        return t;
    }

    // Check The Values Empty or not
    CommonTextFeildCheck(ValueArray){
        var flag = true;
        ValueArray.forEach(function(item){
            if(item == ""){
                flag = false;
                return flag;
            }
        });
        return flag;
    }

    // Check The Values Has Proper Length or Not
    TextLengthCheck(ValueArray,l){
        var flag = true;
        ValueArray.forEach(function(item){
            if(item.length > l){
                flag = false;
                return flag;
            }
        });
        return flag;
    }

    // Check Password Feild
    CheckPassword(ValueArray){
        var flag = true;
        var p = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=./\W/g)(?=.{6,16})")
        ValueArray.forEach(function(item){
            if(!p.test(item) || ValueArray[0] != item){
                flag = false;
                return flag;
            }
        });
        return flag;
    }

    RevokeAdmin() {
        var data = new FormData();
        data.append('action','Revoke');
        let r = new SiteGlobal();
        r.Transaction('controller/Auth.php','POST',data,'#logout');    
    }
}

$(document).ready(function(e){    
     $('#logout').on('click',function(e){
        let r = new SiteGlobal();
        r.RevokeAdmin();
    });

    $('#m_logout').on('click',function(e){
        let r = new SiteGlobal();
        r.RevokeAdmin();
    });

});