

function ControlGenerator(TargetFilePath,Method,Data){
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

function Generator(task,url){
    var data = new FormData();
    data.append('action',task);
    return ControlGenerator(url,'POST',data);
}

function ProductActionBlock(product_code,task){
    if (task == "Added" || task == "Update") { 
        return `<div class='btn-addcart-product-detail size10 trans-0-4 m-t-10 m-b-10' style='display:flex;'>
        
                    <button class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' value='`+ product_code +`' onclick='UpdateToCart(this)' style='margin-right:10px'>
                        <i class='fs-18 fa fa-edit' aria-hidden='true'></i>
                    </button>

                    <button class='flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4' value='` + product_code + `' onclick='DeleteToCart(this)'>
                        <i class='fs-18 fa fa-trash' aria-hidden='true'></i>
                    </button>
                </div>

                <div class='btn-addcart-product-detail size10 trans-0-4 m-t-10 m-b-10'>
                    <a style='background-color:darkolivegreen' class='flex-c-m sizefull bo-rad-23 hov1 s-text1 trans-0-4' href=''>
                        Goto Cart &nbsp;<i class='fs-20 fa fa-shopping-cart' aria-hidden='true'></i>
                    </a>
                </div>`

    }
    if (task == 'Delete')
    {
        return `<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">        
                    <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="`+ product_code +`" onclick="AddToCart(this)">
                        Add to Cart
                    </button>
                </div>`;
    }
    
    
}

function BtnCartToggle(){
    return `
    <a style='background-color:darkolivegreen' class='flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4' href=''>
        Goto Cart &nbsp;<i class='fs-20 fa fa-shopping-cart' aria-hidden='true'></i>
    </a>
    `;
}

function PushCart(product_code,product_qty,task,source = ''){

    var data = new FormData();
    data.append('product_code',product_code);
    data.append('product_qty',product_qty);
    data.append('action',task);

    $.ajax({
        method : 'POST',
        url : 'client/controller/CartController.php',
        data : data,
        processData : false,
        contentType : false,
        beforeSend : function(){
            swal('We Are Process Your Cart','','info');
        },
        success : function (response){
            //swal('Product Added To Your Cart','','success');
            console.log(response);
            var r = jQuery.parseJSON(response);
            switch (r.statusCode) {
                case 'PRODCUT_PUR_LIMIT':
                    swal('The Seller Not Support The ','They Many Prodcut To Deliver.','warning');
                    break;
                case 'PRODCUT_ADD_CART_SUCCESS':
                    if (source == 'FromCard'){
                       // $('btn-cart-toggle').html(BtnCartToggle());
                    }else{
                        $('#product_action').html(ProductActionBlock(product_code,"Added"));
                    }
                    swal('Product Added To ','Cart.','success');
                    break;
                case 'PRODCUT_EXIST_IN_CART':
                    swal('Product','Already in your Cart.','warning');
                    break;
                case 'PRODCUT_QANTITY_OVER_STOCK':
                    swal('You Enter Too Many Qantity ','Against Stock.','warning');
                    break;
                case 'PRODCUT_QANTITY_INVALID':
                    swal('You Enter Invalid Qantity ','Based to Order.','warning');
                    break;
                case 'CART_PRODCUT_UPDATED':
                    $('#product_action').html(ProductActionBlock(product_code,"Update"));
                    swal('Product Updated To ','Cart.','success');
                    break;
                case 'PRODUCT_DELETED_FROM_CART':
                    $('#product_action').html('');
                    $('#product_action').html(ProductActionBlock(product_code,"Delete"));
                    $('#product_qty').val('1');
                    swal('Product Removed From Your ','Cart.','warning');
                    break;
            }
        },
        global : false,
        async : false
    });
}

function AddToCart(e){
    if(ptc != ''){
        if(e.getAttribute('value') == ptc){
            if ($('#product_qty').val() != "" && !isNaN($('#product_qty').val()) && e.getAttribute('value') == ptc){
                product_qty = $('#product_qty').val();
                if(product_qty <= max){
                    PushCart(e.getAttribute('value'),product_qty,'AddToCart');            
                }
                else{
                    swal('Too many Products !','Seller Supports ' + max + ' Quntity Per Customer.','warning');    
                }
            }
                
            else 
                swal('Product Qunatity','is invalid','error');
        }
    }
    
}

function AddToCartFromCard(e)
{
        product_qty = 1;
        PushCart(e.getAttribute('value'),product_qty,'AddToCart','FromCard'); 
        $(e).attr({
            style : 'background-color:darkolivegreen',
            onclick : "GotoCart(this)"
        });
        $(e).children("span").first().html("Goto Cart");
 
}

function UpdateToCart(e){
    if(e.getAttribute('value') == ptc){
        if ($('#product_qty').val() != "" && !isNaN($('#product_qty').val()) && e.getAttribute('value') == ptc){
            product_qty = $('#product_qty').val();
            if(product_qty <= max){
                PushCart(e.getAttribute('value'),product_qty,'UpdateToCart');            
            }
            else{
                swal('Too many Products !','Seller Supports ' + max + ' Quntity Per Customer.','warning');    
            }
        }
            
        else 
            swal('Product Qunatity','is invalid','error');
    }
    else{
        PushCart(e.getAttribute('value'),product_qty,'UpdateToCart');            
    }
}

function DeleteToCart(e){
    if(e.getAttribute('value') != '')
        PushCart(e.getAttribute('value'),0,'DeleteToCart');  
}

function GotoCart(e){
    ptc = e.getAttribute('value');
    if (ptc != '')
        window.location = 'ProductDetail.php?ptc='+ptc;
}