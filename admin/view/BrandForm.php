<li class="has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-plus"></i>Manage Product Brands (This Information Direct Display To Customer)
                    <span class="arrow">
                        <i class="fas fa-angle-down"></i>
                    </span>
                </a>
                <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                    <div class="card" style="border:none">
                        <div class="col-lg-12">
                            <form action="#"  method="post" id="frm_brand_manage" name="frm_brand_manage">
                                <div class="form-group" id="brand_manage_err">
                                
                                </div>
                                <div class="form-group">
                                    <label for="cmp_name" class="pr-1  form-control-label">Company Name</label>
                                    <input type="text" id="cmp_name" name="cmp_name" placeholder="Enter Fully Quilified Company Name"  class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="cmp_address" class="pr-1  form-control-label">Company Address</label>
                                    <input type="text" id="cmp_address" name="cmp_address" placeholder="Enter Actual Company Address"  class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="cmp_cell" class="pr-1  form-control-label">Company Cell</label>
                                    <input type="text" id="cmp_cell" name="cmp_cell" placeholder="For Direct Customer Support From Company"  class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="cmp_email" class="pr-1  form-control-label">Company Email</label>
                                    <input type="email" id="cmp_email" name="cmp_email" placeholder="For Direct Customer Support From Company"  class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="cmp_logo" class="pr-1  form-control-label">Company Logo / Image</label>
                                    <input type="file" id="cmp_logo" name="brand_logo" placeholder=""  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="cmp_type" class="pr-1  form-control-label">Company Type</label>
                                    <select name="cmp_type" id="cmp_type" class="form-control">
                                        <option value="1" selected>Marketing Company</option>
                                        <option value="2">Manufacturer Company</option>
                                        <option value="3">Both of Above</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" name="btn_save_cat" type="submit">
                                        <i class="zmdi zmdi-plus"></i>Save</button>
                                </div>                                
                            </form>
                            <hr>
                            <div class="form-group">                                
                                <label for="brand_drop_down" class="pr-1  form-control-label">List Of Available Brands</label>
                                <select class="form-control" id="brand_drop_down" name="brand_drop_down"></select>
                            <div>
                            <div class="form-group" style="margin-top:17px">
                                        <button class="au-btn au-btn-icon au-btn--blue au-btn--small" id='btn_get_set_brand' name="btn_get_set_brand" type="button" data-toggle="modal" data-target="#brand_model">
                                        Select Brand And Update</button>
                            </div>
                        </div>
                    </div>
                </div>
        </li>