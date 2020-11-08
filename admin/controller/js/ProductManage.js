let site = new SiteGlobal();
var s1Action = 'new';
var s1Code = "";

var s2Action = 'new';
var s2Code = "";

function s1ProductProp(e){
    Clears2ProdcutForm();
    $('#p_code').val(e.getAttribute('value')); 
    s2Action = 'new';
    s2Code = e.getAttribute('value');
}

function Gets1Single(e) {
    var data = new FormData();
    data.append('ref',e.getAttribute('value'));
    data.append('action','get_s1_single');
    var t = site.GetSetFeild('controller/ProductMaster.php','POST',data,'#brand_manage_err');
    var rs = jQuery.parseJSON(t.responseText);
    console.log(rs);
    $('#product_name').val(rs.NAME);
    $('#p_cat_drop_down').val(rs.CAT);
    $('#product_marketing_brand').val(rs.MARKETING);
    $('#product_manufacturer_company').val(rs.MANUFACTURER);
    $('#product_tax_slab').val(rs.TAX);
    $('#product_desc').val(rs.DESC);
    $('#product_storage_tips').val(rs.S_TIPS);
    $('#product_benifits').val(rs.BEN);
    $('#product_usage').val(rs.U_METHOD);    
    s1Action = 'update';
    s1Code = e.getAttribute('value');
}

// Clear s1Product
function Clears1ProductForm(){
    $('#product_name').val('');
    $('#p_cat_drop_down').prop('selectedIndex',0);
    $('#product_marketing_brand').prop('selectedIndex',0);;
    $('#product_manufacturer_company').prop('selectedIndex',0);;
    $('#product_tax_slab').val('');
    $('#product_desc').val('');
    $('#product_storage_tips').val('');
    $('#product_benifits').val('');
    $('#product_usage').val('');
}

// Clear s2Product
function Clears2ProdcutForm(){
    $('#p_code').val('');
    $('#sku').val('');
    $('#title').val('');
    $('#ean').val('');
    $('#product_package_unit').prop('selectedIndex',0);
    $('#product_selling_rate').val('');
    $('#product_mrp').val('');
    $('#product_stock').val('');
    $('#product_net_qty').val('');
    $('#p_height').val('');
    $('#p_width').val('');
    $('#p_length').val('');
    $('#product_warranty').val('');
    $('#product_max_per_cust').val('');
    $('#product_additional_info').val('');
    $('#product_img1').val(null);
    $('#product_img2').val(null);
    $('#product_img3').val(null);
}

function s1ProductDataNew(){
    var data = new FormData();
        data.append('product_name',$('#product_name').val());
        data.append('product_category',$('#p_cat_drop_down').val());
        data.append('product_marketing_brand',$('#product_marketing_brand').val());
        data.append('product_manufacturer_company',$('#product_manufacturer_company').val());
        data.append('product_tax_slab',$('#product_tax_slab').val());
        data.append('product_desc',$('#product_desc').val());
        data.append('product_storage_tips',$('#product_storage_tips').val());
        data.append('product_benifits',$('#product_benifits').val());
        data.append('product_usage',$('#product_usage').val());
    return data;
}

function Gets1ProductShortTbl(){
    var data = new FormData();
    data.append('action','s1_product_short_tbl');
    return site.ControlGenerator('controller/ProductMaster.php','POST',data);
}

function Deletes2Product(e) {
    var data = new FormData();
    data.append('ref',e.getAttribute('value'));
    data.append('action','s2_delete');
    SaveProduct(data,'#s1_s2_sub_msg');
}
function SaveProduct(Data,MsgElement){
    $.ajax({
        type:'POST',
        enctype : 'mutipart/form-data',
        url : 'controller/ProductMaster.php',
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
                switch (r.statusCode) {
                    case 'S1_DONE':
                        site.WriteMsg(MsgElement,"info","Regester New Product"," Successfully !");    
                        Clears1ProductForm();
                        $('#s1_product_short_tbl').html(Gets1ProductShortTbl());    
                        break;
                    case 'PRODUCT_NAME_EMPTY':
                        site.WriteMsg(MsgElement,"error","Product Name"," should not be empty !");
                        break;
                    case 'PRODUCT_CATAGORY_NONE':
                        site.WriteMsg(MsgElement,"error","Product catagory"," should not be none !");
                        break;
                    case 'PRODUCT_TAX_SLAB_EMPTY':
                        site.WriteMsg(MsgElement,"error","Product tax"," slab required !");
                        break;
                    case 'PRODUCT_TAX_SLAB_WRONG':
                        site.WriteMsg(MsgElement,"error","Product tax"," Invalid !");
                        break;
                    case 'MAIN_PRODUCT_SELECT':
                        site.WriteMsg(MsgElement,"error","Parent Product"," required !");
                        break;
                    case 'PRODUCT_SKU':
                        site.WriteMsg(MsgElement,"error","Product SKU"," required !");
                        break;
                   case 'PRODUCT_DATA_LENGTH_VIOLATE':
                        site.WriteMsg(MsgElement,"error","Please Enter Valid Data"," in form !");
                        break; 
                    case 'PRODUCT_PACKAGE_UNIT':
                        site.WriteMsg(MsgElement,"error","Product Package unit"," Required !");
                        break;
                    case 'PRODUCT_AMOUNT_INVALID':
                        site.WriteMsg(MsgElement,"error","Product Amount"," is not valid !");
                        break;
                    case 'PRODUCT_STOCK_INVALID':
                        site.WriteMsg(MsgElement,"error","Product Stock"," is not valid !");
                        break;
                    case 'PRODUCT_NQTY_INVALID':
                        site.WriteMsg(MsgElement,"error","Product Net"," Quantity is not valid !");
                        break;
                    case 'PRODUCT_DIAMANTION_INVALID':
                        site.WriteMsg(MsgElement,"error","Product Diamantion"," is not valid !");
                        break;
                    case 'PRODUCT_WARRANTY_INVALID':
                        site.WriteMsg(MsgElement,"error","Product Warranty"," information is not valid !");
                        break;
                    case 'PRODUCT_MAX_PER_CUST_INVALID':
                        site.WriteMsg(MsgElement,"error","Product Per Customer"," information is not valid !");
                        break;
                    case 'PRODUCT_ADDINFO_INVALID':
                        site.WriteMsg(MsgElement,"error","Product Additional"," information is not valid !");
                        break;
                    case 'S1_UPDATE':
                        site.WriteMsg(MsgElement,"info","Product Master"," information Updated !");
                        $('#s1_product_short_tbl').html(Gets1ProductShortTbl());    
                        break;
                    case 'PRODUCT_SAVED':
                        site.WriteMsg(MsgElement,"success","Product Saved"," Successfully !");
                        Clears2ProdcutForm();
                        $('#s1_s2_tbl').html(GetS2ProductList(s1Code));
                        break;
                    case 'PRODUCT_S2_DELETE':
                        site.WriteMsg(MsgElement,"info","Product Deleted"," Successfully !");
                        $('#s1_s2_tbl').html(GetS2ProductList(s1Code));
                    default:
                        site.JSON_CODE_MSG(r.statusCode,MsgElement);
                        break;
                }
               
            } catch (e) {
                site.WriteMsg(MsgElement,"error","Internal Server"," Error !");
            }
            finally{
                s1Action = 'new';
            }
        }
    });
}

function s1_s2_sub(e){
    var ref = e.getAttribute('value');
    s1Code = ref;
    $('#s1_s2_tbl').html(GetS2ProductList(ref));
    var data = new FormData();
    data.append('ref',ref);
    data.append('action','get_s1_single');
    var t = site.GetSetFeild('controller/ProductMaster.php','POST',data,'#s1_s2_sub_msg');
    var rs = jQuery.parseJSON(t.responseText);
    //console.log(rs);
    $('#s1_product_name').val(rs.NAME);
    $('#s1_product_cat').val(rs.CAT);
    $('#s1_pro_mar_brand').val(rs.MARKETING);
    $('#s1_pro_manu_brand').val(rs.MANUFACTURER);
    $('#s1_product_tax_slab').val(rs.TAX);
    $('#s1_product_desc').val(rs.DESC);
    $('#s1_product_storage_tips').val(rs.S_TIPS);
    $('#s1_product_benifits').val(rs.BEN);
    $('#s1_product_usage').val(rs.U_METHOD);        
}

function GetS2ProductList(ref) {
    var data = new FormData();
    data.append('ref',ref);
    data.append('action','s2_product_tbl');
    return site.ControlGenerator('controller/ProductMaster.php','POST',data);
}

function Gets2Single(e){
    var ref = e.getAttribute('value');
    $('#product_model').css("z-index","9999");
    $('#p_code').val(ref);
    var data = new FormData();
    data.append('ref',ref);
    data.append('action','get_s2_single');
    var t = site.GetSetFeild('controller/ProductMaster.php','POST',data,'#brand_manage_err');
    var rs = jQuery.parseJSON(t.responseText);
        $('#sku').val(rs.SKU);
        $('#title').val(rs.TITLE);
        $('#ean').val(rs.EAN);
        $('#product_package_unit').val(rs.PPU);
        $('#product_selling_rate').val(rs.SR);
        $('#product_mrp').val(rs.MRP);
        $('#product_stock').val(rs.STOCK);
        $('#product_net_qty').val(rs.NQTY);
        $('#p_height').val(rs.PH);
        $('#p_width').val(rs.PW);
        $('#p_length').val(rs.PL);
        $('#product_warranty').val(rs.WAR);
        $('#product_max_per_cust').val(rs.MPC);
        $('#product_additional_info').val(rs.ADD_INFO);
    s2Action = "update";
    s2Code = ref;
}

// Jquery Start
$(document).ready(function(e){
    
    var BrandRef = null;

    // Initialize The Brand Drop Down
    $('#brand_drop_down').html(GetBrandListAsDropDown());    

    
    //load the Super Products
    $('#s1_product_short_tbl').html(Gets1ProductShortTbl());

    

    /* s1_s2_model dorp down initilize*/
    $('#s1_product_cat').html(GetProductCatagoryAsDropDown());
    $('#s1_pro_mar_brand').html(GetMarketingCompanyList());
    $('#s1_pro_manu_brand').html(GetManufacturerCompanyList());
    /* s1_s2_model over */


    $('#product_marketing_brand').html(GetMarketingCompanyList());
    
    $('#product_manufacturer_company').html(GetManufacturerCompanyList());
    $('#p_cat_drop_down').html(GetProductCatagoryAsDropDown());
    $('#product_package_unit').html(GetProductUnitAsDropDown());
    
    // Generate The XHR Response To Create The Dropdown
    function GetBrandListAsDropDown(){
        var data = new FormData();
        data.append('action','get_product_as_drop_down');
        return site.ControlGenerator('controller/ProductBrand.php','POST',data);
    }

    // Reganerate The Drop Down XHR
    function RefreshBrandData(){
        $('#brand_drop_down').html(GetBrandListAsDropDown());     
        $('#product_marketing_brand').html(GetMarketingCompanyList());
        $('#product_manufacturer_company').html(GetManufacturerCompanyList());
    }

    // Generate The Product Catagory XHR 
    function GetProductCatagoryAsDropDown(){
        var data = new FormData();
        data.append('action','LoadCatagoryList');
        return site.ControlGenerator('controller/Catagory.php','POST',data);
    }

    // Generate The Product Unit Drop Down XHR
    function GetProductUnitAsDropDown(){
        var data = new FormData();
        data.append('action','get_product_unit');
        return site.ControlGenerator('controller/ProductUnit.php','POST',data);
    }

    function GetMarketingCompanyList(){
        var data = new FormData();
        data.append('action','get_marketing_company_list');
        return site.ControlGenerator('controller/ProductBrand.php','POST',data);
    }

    function GetManufacturerCompanyList(){
        var data = new FormData();
        data.append('action','get_manufacturer_company_list');
        return site.ControlGenerator('controller/ProductBrand.php','POST',data);
    }
    // Clear The All Feilds
    function ClearBrandFeilds(){
        $("#cmp_name").val("");
        $("#cmp_address").val("");
        $("#cmp_cell").val("");
        $("#cmp_email").val("");
        $("#cmp_logo").val(null);
    }

    // Set Brand Value 
    function SetBrandValues(r){
        var data = new FormData();
        data.append('ref',r);
        data.append('action','get_single_brand_data');
        var t = site.GetSetFeild('controller/ProductBrand.php','POST',data,'#brand_manage_err');
        var rs = jQuery.parseJSON(t.responseText);
        BrandRef = r;
        $('#new_cmp_name').val(rs.COMPANY_NAME);
        $('#new_cmp_address').val(rs.COMPANY_ADDRESS);
        $('#new_cmp_cell').val(rs.COMPANY_CELL);
        $('#new_cmp_email').val(rs.COMPANY_EMAIL);
        $('#new_cmp_type').val(rs.COMPANY_TYPE);

    }   

    // Save New Brand
    $('#frm_brand_manage').on('submit',function(e){
        e.preventDefault();
        var data = new FormData();
        data.append('cmp_name',$('#cmp_name').val());
        data.append('cmp_address',$('#cmp_address').val());
        data.append('cmp_cell',$('#cmp_cell').val());
        data.append('cmp_email',$('#cmp_email').val());
        data.append('cmp_logo',$('#cmp_logo')[0].files[0]);
        data.append('cmp_type',$('#cmp_type').val());
        data.append('action','new_product_company');
        site.Transaction('controller/ProductBrand.php','POST',data,'#brand_manage_err');
        RefreshBrandData();
        ClearBrandFeilds();
    });

    // Update Values
    $('#btn_get_set_brand').on('click',function(e){
        var r = $('#brand_drop_down').val();
        SetBrandValues(r);
    });
    
    // Update Existing Brand
    $('#update_brand').on('submit',function(e){
        e.preventDefault();
        var data = new FormData();
        data.append('cmp_name',$('#new_cmp_name').val());
        data.append('cmp_address',$('#new_cmp_address').val());
        data.append('cmp_cell',$('#new_cmp_cell').val());
        data.append('cmp_email',$('#new_cmp_email').val());
        data.append('cmp_type',$('#new_cmp_type').val());
        data.append('cmp_logo',$('#new_cmp_logo')[0].files[0]);
        data.append('cmp_no',BrandRef);
        data.append('action','update_company');        
        site.Transaction('controller/ProductBrand.php','POST',data,'#brand_update_msg');
        RefreshBrandData();
        $('#new_cmp_name').val('');
        $('#new_cmp_address').val('');
        $('#new_cmp_cell').val('');
        $('#new_cmp_email').val('');
        $('#new_cmp_type').val('');
        $('#new_cmp_logo').val(null);
    });

   
    
    
    $('#frm_new_product').on('submit',function(e){
        e.preventDefault();
        var data = s1ProductDataNew();
        if(s1Action == 'new')
            data.append('action','reg_new_product');
        if(s1Action == 'update'){
            data.append('p_code',s1Code);
            data.append('action','update_s1_product');
        }   
        SaveProduct(data,'#reg_pro_msg');
        s1Action = 'new';
        s1Code = "";
            
    });    

    $('#frm_new_product_s2').on('submit',function(e){

        e.preventDefault();
        var data = new FormData();
        
        if(s2Action == 'new')
            data.append('p_code',$('#p_code').val());
        
        data.append('sku',$('#sku').val());
        data.append('title',$('#title').val());
        data.append('ean',$('#ean').val());
        data.append('product_package_unit',$('#product_package_unit').val());
        data.append('product_selling_rate',$('#product_selling_rate').val());
        data.append('product_mrp',$('#product_mrp').val());
        data.append('product_stock',$('#product_stock').val());
        data.append('product_net_qty',$('#product_net_qty').val());
        data.append('p_height',$('#p_height').val());
        data.append('p_width',$('#p_width').val());
        data.append('p_length',$('#p_length').val());
        data.append('product_warranty',$('#product_warranty').val());
        data.append('product_max_per_cust',$('#product_max_per_cust').val());
        data.append('product_additional_info',$('#product_additional_info').val());
        data.append('product_img1',$('#product_img1')[0].files[0]);
        data.append('product_img2',$('#product_img2')[0].files[0]);
        data.append('product_img3',$('#product_img3')[0].files[0]);
        if(s2Action == 'new'){
            data.append('action','save_s2product');
        }
        if(s2Action == "update"){
            data.append('action','update_s2product');
            data.append('ref',s2Code);
        }
        SaveProduct(data,'#product_msg');
    });

});

