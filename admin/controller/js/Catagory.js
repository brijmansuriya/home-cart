let site = new SiteGlobal();

let rec = null;


function Generator(task){
    var data = new FormData();
    data.append('action',task);
    return site.ControlGenerator('controller/Catagory.php','POST',data);
}

function Initialize() {
    $('#p_cat_drop_down').html(Generator('LoadCatagoryList'));
    $('#CatTableData').html(Generator('LoadCatagoryTable'));
}

var ClearMessage = setTimeout(function(){
    $('#cat_msg').html(null);
},7000);

function ClearForm(){
    $('#cat_name').val(null);
    $('#cat_desc').val(null);
    $('#cat_img').val(null);
    $('#p_cat_drop_down').val(-1);

    $('#NewCatName').val(null);
    $('#NewDesc').val(null);
    $('#NewIcon').val(null);

    rec = null;

    ClearMessage;
}

function Transaction(TargetFilePath,Method,Data,MsgElement){
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
           try {
                var r = jQuery.parseJSON(result);
                console.log(result);
                if(r.statusCode == 'DATA_SAVE'){
                    Initialize();
                    ClearForm();
                }
                if(r.statusCode == 'DUPLICATE_PARENT'){
                    site.WriteMsg(MsgElement,'warning','Parent Catagory','Duplicate Founnd !');
                    return;
                }
                if(r.statusCode == 'UPDATE'){
                    site.WriteMsg(MsgElement,'success','Data','Updated Successfully !');
                    Initialize();
                    ClearForm();
                    return;
                }
                site.JSON_CODE_MSG(r.statusCode);
                ClearMessage;
            } catch (e) {
                site.WriteMsg(MsgElement,"error","Internal Server"," Error !");
                ClearMessage;
            }
        }
    });
}

function AddCatagory(){
    var data = new FormData();
    data.append('cat_name',$('#cat_name').val());
    data.append('cat_desc',$('#cat_desc').val());
    data.append('cat_img',$('#cat_img')[0].files[0]);
    data.append('parent_cat',$('#p_cat_drop_down').val());
    data.append('action','AddCatagory');
    Transaction('controller/Catagory.php','POST',data,'#cat_msg');
}

function UpdateCatagory(rec){
    var data = new FormData();
    data.append('cat_name',$('#NewCatName').val());
    data.append('cat_desc',$('#NewDesc').val());
    data.append('cat_img',$('#NewIcon')[0].files[0]);
    data.append('rec_id',rec)
    data.append('action','UpdateCatagory');
    Transaction('controller/Catagory.php','POST',data,'');
}

 // Fetch Single Record From Database
 function GetSpecificRecord(rec_id){
    $.ajax({
            async : true,
            url:"controller/Catagory.php",
            method:"POST",
            data:{
                rec_id:rec_id,
                action:"GetSpecificRecord"
            },
            cache:false,
            success:function(result)
            {
                var r = jQuery.parseJSON(result);
                if (r.Catagory != "" && r.CatDesc != ""){
                    $("#NewCatName").val(r.Catagory);
                    $("#NewDesc").val(r.CatDesc);
                }

            }
        })
}

function UpdateData(e){
    rec_id = e.getAttribute('value');
    rec = rec_id;
    GetSpecificRecord(rec);
}

// Search Data
function search(data) {
    $.ajax({
        async : true,
        type : 'POST',
        url : 'controller/Catagory.php',
        data : {
            action:"SearchData",
            search:data
        },
        success : function(response){
            $("#CatTableData").html(response);
        }
    });
}


$(document).ready(function(e){
    
    Initialize();

    $('#frm_cat').on('submit',function(e){
        e.preventDefault();
        AddCatagory();
    });

    $('#UpdateCatagoryForm').on('submit',function(e){
        e.preventDefault();
        UpdateCatagory(rec);
    });

    $('#cat_search').keyup(function(e){
        data = $('#cat_search').val();
        if(e.keyCode == 32 || e.keyCode == 46  || e.keyCode == 13 || e.keyCode == 27 || e.keyCode == 9 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 40)){
            return;
        }else{
            if(data != ""){
                $("#CatTableData").html(null);
                search(data);
            }else if (data != "" && e.keyCode == 8){
                search(data);
            }else if (data == "" && e.keyCode == 8){
                Initialize()
            }else{
                return;
            }
        }
    });

});