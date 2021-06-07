<div class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fas fa-blog"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="read_product.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="cs nav-link" href="read_supplier.php">Suppliers</a>
            </li>
            
          </ul>
          
       
        <?php
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true  && $_SESSION['access_level']=='Admin'){
    ?>
    <ul class="nav navbar-nav navbar-right">
        <li <?php echo $page_title=="Edit Profile" ? "class='active'" : ""; ?>>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                  <?php echo $_SESSION['username']; ?>
                  <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
    <?php
    }

			?>

    
    </div>
  </div>
</div>
      