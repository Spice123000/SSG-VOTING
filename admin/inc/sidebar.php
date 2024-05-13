<nav id="sidebar" class="sidebar js-sidebar">
		<div class="sidebar-content js-simplebar">
			<?php
			$myrow = $oop->displaySystem();
			foreach($myrow as $row){ ?>
			<a class="sidebar-brand" href="?page=dashboard">
					<img src="../img/logo/<?=$row['scsit_logo'];?>" class="me-2" alt="SCSIT logo" style="height: 50px; margin-left: -17px;">
					<img src="../img/logo/<?=$row['comelec_logo'];?>" class="me-2" alt="Comelec logo" style="height: 50px; margin-left: -50px;">
					<img src="../img/logo/<?=$row['ssg_logo'];?>" class="me-2" alt="SSG logo" style="height: 50px; margin-left: -45px;">
			<span class="align-middle" >
				<?= $row['system_name']; } ?>
		  	</span>
        </a>
				<ul class="sidebar-nav">
					<center><span class="badge" class="text-light">Administrator</span></center>
					<center><span id="clock" class="text-light"></span></center>
					<li class="sidebar-header">
						Pages
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=dashboard">
              			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a  class="sidebar-link" href="?page=comelec">
						<img src="../img/logo/comelec-logo.png" alt="Comelec logo" style="height: 30px; margin-left: -4px; margin-right: 4px;">
              			 <span class="align-middle">Comelec</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=voters">
              			<i class="align-middle" data-feather="edit-2"></i> <span class="align-middle">Voters</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=candidates">
              			<i class="align-middle" data-feather="users"></i> <span class="align-middle">Candidates</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=partylist">
              			<i class="align-middle" data-feather="users"></i> <span class="align-middle">Partylist</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=departments">
              			<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Departments</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=positions">
              			<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Positions</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=ranking">
              			<i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Ranking</span>
            			</a>
					</li>
                    <li class="sidebar-item">
						<a class="sidebar-link" href="?page=chart">
              			<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Chart</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="?page=access_code">
              			<i class="align-middle" data-feather="code"></i><span class="align-middle"> Access Code</span>
            			</a>
					</li>
					<li class="sidebar-item mb-5">
						<a class="sidebar-link" href="?page=system_settings">
              			<i class="align-middle" data-feather="settings"></i> <span class="align-middle">System Settings</span>
            			</a>
					</li>
				</ul>
			</div>
		</nav>
       
        <script>
        const currentLocation = location.href;
        const menuItem = document.querySelectorAll('.sidebar-link');
        const menuLength = menuItem.length;
        for (let i = 0; i < menuLength; i++) {
            if (menuItem[i].href === currentLocation) {
                menuItem[i].className = "sidebar-link active"
            }
        }
        </script>