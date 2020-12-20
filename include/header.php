<header class="bg-nav fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-lg-0">
                <a class="navbar-brand mr-3 " href="index.php"><img src="./assets/img/logo.png" alt="" width="60" height="60" >    Maripakai.co</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav navbar-custom">
                        <!-- <li class="nav-item "> <a href="index.html" class="nav-link text-danger font-weight-bolder">Home</a> </li> -->
                    </ul>
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item d-flex align-items-center">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                  <button class="btn btn-outline-secondary searching" type="button" ><i class="las la-search"></i></button>
                                </div>
                              </div>
                        </li> -->
                        
                        <li><a class="nav-link" href="keranjang.php"><i class="la la-shopping-cart" style="font-size:30px;"></i></a></li>
                        <?php   if(strlen($_SESSION['login'])==0){
                        ?>
                        <li class="nav-item d-flex align-items-center"> <a href="login.php" class="btn btn-md btn-primary">LOGIN</a> </li>
                        <?php } ?>
                        <?php
                            $username=$_SESSION['login'];
                            $sql ="SELECT NamaLengkap FROM users WHERE Username=:username ";
                            $query= $dbh -> prepare($sql);
                            $query-> bindParam(':username', $username, PDO::PARAM_STR);
                            $query-> execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                                {
                        ?> 
                        <li class="nav-item d-flex align-items-center dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hai, <?php echo htmlentities($result->NamaLengkap)?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="dashboar.php">Dashboard</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                        <?php }} ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>