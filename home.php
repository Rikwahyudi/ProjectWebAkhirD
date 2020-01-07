<?php require_once 'includes/header.php'; ?>

<div class="row">

    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">

                <a href="produk.php" style="text-decoration:none;color:black;">
                    Total
                    <span class="badge pull pull-right"><?php// echo $countProduct; ?></span>
                </a>

            </div>
            <!--/panel-hdeaing-->
        </div>
        <!--/panel-->
    </div>
    <!--/col-md-4-->

    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="" style="text-decoration:none;color:black;">
                    Total Pesanan
                    <span class="badge pull pull-right"><?php //echo $countOrder; ?></span>
                </a>

            </div>
            <!--/panel-hdeaing-->
        </div>
        <!--/panel-->
    </div>
    <!--/col-md-4-->

    <div class="col-md-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <a href="produk.php" style="text-decoration:none;color:black;">
                    Stock
                    <span class="badge pull pull-right"><?php //echo $countLowStock; ?></span>
                </a>

            </div>
            <!--/panel-hdeaing-->
        </div>
        <!--/panel-->
    </div>
    <!--/col-md-4-->
    <div class="col-md-4">
        <div class="card">
            <div class="cardHeader">
			<img src=".assests/images/login.jpg" style="width:60%;" class="card-img-top" alt="...">
            </div>
            <div class="cardContainer">
                <h5 class="card-title">info profil</h5>
                <p class="card-text"><i class="fa fa-user">&nbsp;</i>User</p>
                <p class="card-text"><i class="fa fa-user">&nbsp;</i>Login : <?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
            </div>
        </div>
        <br />

    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="cardHeader">
                <h1><?php echo date('d'); ?></h1>
            </div>

            <div class="cardContainer">
                <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
            </div>
        </div>
        <br />

    </div>
<?php require_once 'includes/footer.php'; ?>
