<?php 
include_once("inc/settings.php");

$useLayout = !isset($_SERVER['HTTP_X_PJAX']);
if($useLayout)
	require_once("header.php");
?>
<div class="content-frame">
<img src="<?= LOGO_URL?>" style="max-height: 40px; max-width: 80%"></img>
<div id="diagnosticspanel" style="min-height: 375px" class="row">

</div>
 <!--table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Size</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
  <div style="text-align: right">
    <button type="button" class="btn btn-rounded btn-danger">Record</button> 
  </div-->
</div>


<script>
$(function()
{
	$("aside li").removeClass("active");
	$("#diagnosticstab").addClass("active");
	PM.Service.diagnostics();
});
</script>


<?php if($useLayout) require_once("footer.php"); ?>
