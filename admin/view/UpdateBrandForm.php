<div class="modal fade" id="brand_model" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card" style="margin-bottom:0">
                    <div class="card-header">
                        <strong>Update Brand </strong> Details
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-body card-block">
                        <form id='update_brand'>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='new_cmp_name' class='form-control-label'>New Company Name</label>
                                        <input type='text' id='new_cmp_name' name='new_cmp_name' class='form-control'/>
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='new_cmp_address' class='form-control-label'>New Address :</label>
                                        <input id='new_cmp_address' name='new_cmp_address' class='form-control'>
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='new_cmp_cell' class=' form-control-label'>New Cell :</label>
                                        <input id='new_cmp_cell' name='new_cmp_cell' class='form-control' >
                                    </div>
                                </div> 
                            </div>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='new_cmp_email' class=' form-control-label'>New Email :</label>
                                        <input id='new_cmp_email' name='new_cmp_email' class='form-control' >
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='new_cmp_type' class=' form-control-label'>New Company Type : </label>
                                         <select id='new_cmp_type' name='new_cmp_type' class='form-control' >
                                            <option value="1" selected>Marketing Company</option>
                                            <option value="2">Manufacturer Company</option>
                                            <option value="3">Both of Above</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='new_cmp_logo' class=' form-control-label'>New Company Logo :</label>
                                        <input type='file' id='new_cmp_logo' name='new_cmp_logo' class='form-control' >
                                    </div>
                                </div>
                            </div>                           
                            <div class='row form-group'>
                                <div class='col-3'>
                                        <div class='form-group'>
                                            <button type='submit' id='btn_update_brand' name='btn_update_brand' class='btn btn-primary'> Update Data </button>
                                        </div>
                                </div>
                            <div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>     