            <nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
                </a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>
			    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<?php 
					$id = $_SESSION['id'];
					$myrow = $oop->displayComProfile($id);
					foreach($myrow as $row){
						?>
						<img src="../img/profiles/<?=$row['profile']?>" class="avatar img-fluid rounded-circle m-e1" alt="" /> <span class="text-dark"><?=$row['firstname']?></span>
						<?php
					}
					?>
                </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="?page=profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="process/logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>