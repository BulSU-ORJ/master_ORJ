<?php
	$output='<div class="modal-dialog modal-dialog-centered" role="document" style="padding-top:0; margin-top:0;">
    <div class="modal-content">
      <div class="modal-header" style="border:none; padding-bottom:0; margin-bottom:0;">
        <h5 class="modal-title" id="PINLabel">Please enter your PIN No. to continue:</h5>
      </div>
      <div class="modal-body" style="padding-bottom:0; padding-right:0;">
        <div class="form-group">
            <input type="password" class="form-control" id="pass" name="pass" onkeyup="toCheck()">
        </div>
      </div>
      <div class="modal-footer" style="border:none; padding-bottom:10px; padding-right:10px;">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>';
    
    // Return response 
	echo json_encode($output);
?>