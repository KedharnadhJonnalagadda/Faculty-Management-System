<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap 4 Modal</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
       
	});
    
</script>
<style>
    .bs-example{
    	margin: 20px;
    }
    
</style>
</head>

<?php session_start();



?>

<body>
<div id="message" class="bs-example">
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-body">
                    <br />
                    <h5 style="text-align:center;color:<?php echo $_SESSION['color'];?>"><?php echo $_SESSION['msgHead'];?></h5>
                    <div style="text-align:center"><h5 class="modal-title"><img src="./<?php echo $_SESSION['gif'];?>" alt="success"  width="20%" height="20%"/></h5></div>
                    <p class="text-secondary"  style="text-align:center;color:<?php echo $_SESSION['color'];?>;"><?php echo $_SESSION["message"]?></p>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
$_SESSION["message"]="";

?>