<div class="card">
    <div class="card-header">
        <strong>Company</strong>
        <small> Form</small>
    </div>
    <form action="#" id="frm_site_admin" enctype="multipart/form-data">
    <div class="card-body card-block">
            <div class="form-group" id="site_frm_err">
            </div>
            <div class="form-group">
                <label for="web_name" class=" form-control-label">Website Name</label>
                <input type="text" id="web_name" placeholder="Enter your company name" class="form-control" value="<?php printf($site->SITE_DATA['SITE_NAME']); ?>">
            </div>
            <div class="form-group">
                <label for="web_logo" class=" form-control-label">Website Logo</label>
                <input type="file" id="web_logo" placeholder="" class="form-control">
            </div>
            <div class="form-group">
                <label for="cmp_name" class=" form-control-label">Company</label>
                <input type="text" id="cmp_name" placeholder="Enter your company name" class="form-control" value="<?php printf($site->SITE_DATA['COMPANY_NAME']); ?>" >
            </div>
            <div class="form-group">
                <label for="cmp_logo" class=" form-control-label">Company Logo</label>
                <input type="file" id="cmp_logo" placeholder="" class="form-control">
            </div>
            <div class="form-group">
                <label for="cmp_e_dt" class=" form-control-label">Establishing Date</label>
                <input type="date" id="cmp_e_dt" placeholder="Company Establishing Date" class="form-control" value="<?php printf($site->SITE_DATA['ESTABLISHED_DATE']); ?>">
            </div>
            <div class="form-group">
                <label for="cmp_gst" class=" form-control-label">GST</label>
                <input type="text" id="cmp_gst" placeholder="" class="form-control" value="<?php printf($site->SITE_DATA['GST_NO']); ?>">
            </div>
            <div class="form-group">
                <label for="cmp_addr" class=" form-control-label">Full Address</label>
                <input type="text" id="cmp_addr" placeholder="Enter street name" class="form-control" value="<?php printf($site->SITE_DATA['ADDRESS']); ?>">
            </div>
            <div class="row form-group">
                <div class="col-8">
                    <div class="form-group">
                        <label for="city" class=" form-control-label">City</label>
                        <input type="text" id="city" placeholder="Enter your city" class="form-control" value="<?php printf($site->SITE_DATA['CITY']); ?>">
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="pincode" class=" form-control-label">Postal Code</label>
                        <input type="text" id="pincode" placeholder="Postal Code" class="form-control" value="<?php printf($site->SITE_DATA['PINCODE']); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="country" class=" form-control-label">Country</label>
                <input type="text" id="country" placeholder="Country name India Must" class="form-control" value="<?php printf($site->SITE_DATA['COUNTRY']); ?>">
            </div>
            <div class="form-group">
                <label for="cmp_email" class=" form-control-label">Email</label>
                <input type="email" id="cmp_email" placeholder="Company Email Address" class="form-control" value="<?php printf($site->SITE_DATA['EMAIL']); ?>">
            </div>
            <div class="form-group">
                <label for="phone" class=" form-control-label">Contact Number</label>
                <input type="text" id="phone" placeholder="Company Contact Number" class="form-control" value="<?php printf($site->SITE_DATA['PHONE']); ?>">
            </div>
            <div class="form-group">
                <label for="cimg1" class=" form-control-label">Company Image 1</label>
                <input type="file" id="cimg1" placeholder="" class="form-control">
            </div>
            <div class="form-group">
                <label for="cimg2" class=" form-control-label">Company Image 2</label>
                <input type="file" id="cimg2" placeholder="" class="form-control">
            </div>
            <div class="form-group">
                <label for="cimg3" class=" form-control-label">Company Image 3</label>
                <input type="file" id="cimg3" placeholder="" class="form-control">
            </div>
            <div class="form-group">
                <label for="cimg4" class=" form-control-label">Company Image 4</label>
                <input type="file" id="cimg4" placeholder="" class="form-control">
            </div>
            <div class="form-group">
                <label for="cimg5" class=" form-control-label">Company Image 5</label>
                <input type="file" id="cimg5" placeholder="" class="form-control">
            </div>
        
    </div>
    <div class="card-footer">
        <div class="form-group">
            <button type="submit" id="btn_save" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Save</button>
            <button type="reset" id="btn_clear" class="btn btn-danger"><i class="fa fa-ban"></i> Clear</button>
        </div>
    </div>
    </form>
</div>