<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="dashboard.php"><i class="fas fa-warehouse"></i>&nbsp;&nbsp;Inventory Management</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i>&nbsp;Home</a>
      </li>
      <?php

      if (isset($_SESSION['userid']))
       {?>
          <li class="nav-item active">
            <a class="nav-link" href="logout.php"><i class="fa fa-user-slash"></i>&nbsp;Logout</a>
          </li>
        <?php
      }

      ?>
      
    </ul>
    <?php

      if (isset($_SESSION['userid']))
       {?>
          <ul class="navbar-nav ml-auto">
          
          <li class="nav-item active">
            <a class="nav-link" href="new_order.php"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Orders</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="manage_products.php"><i class="fab fa-product-hunt"></i>&nbsp;&nbsp;Products</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="reports.php"><i class="fas fa-file-pdf"></i>&nbsp;&nbsp;Reports</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="manage_customer.php"><i class="fas fa-users"></i>&nbsp;&nbsp;Customers</a>
          </li>
          <!-- <li class="nav-item active">
            <a class="nav-link" href="#"><i class="fa fa-home"></i>&nbsp;Orders</a>
          </li> -->
        </ul>
        <?php
      }

      ?>
    
  </div>
</nav>