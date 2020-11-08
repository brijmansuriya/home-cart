<div class="card">
    <div class="card-header">
        <strong>Reset</strong>
        <small> password</small>
    </div>
    <form action="#" id="frm_site_pwd" enctype="multipart/form-data">
    <div class="modal-body">
            <div class="card-body card-block">
                <div class="form-group" id="reset_pwd_err">
                </div>
                <div class="form-group" id="extra_attr">
                </div>
                <div class="form-group">
                    <label for="username" class=" form-control-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="" class="form-control" <?php if(!empty($site->SITE_DATA['ID'])){ printf("disabled"); } ?> value="<?php printf($site->SITE_DATA['ID']); ?>">
                </div>
               <div class="form-group">
                    <label for="old_pwd" class=" form-control-label">Old Password</label>
                    <input type="password" name="old_pwd" id="old_pwd" placeholder="" class="form-control" <?php if(empty($site->SITE_DATA['ID'])){ printf("disabled"); } ?>>
                </div>
                <div class="form-group">
                    <label for="new_pwd" class=" form-control-label">New Password</label>
                    <input type="password" name="new_pwd" id="new_pwd" placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confrim_pwd" class=" form-control-label">Confrim Password</label>
                    <input type="password" name="confrim_pwd" id="confrim_pwd" placeholder="" class="form-control">
                </div>
                <div class="form-group">
                    <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
					    <span class="badge badge-pill badge-warning">Username & Password</span>
						    If You See This First Time Must Insert New Username And Password (Leave Old Password As Blank).
					</div>
                </div>
            </div>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </form>
</div>