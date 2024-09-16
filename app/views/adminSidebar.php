<!-- Sidebar -->
<nav class="col-md-3 col-lg-2 d-md-block p-0">
    <div class="sidebar-container">
        <div class="sidebar p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="CinemaManagement">
                        <i class="fas fa-building me-4 fa-lg"></i>
                        Cinemas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-film me-4 fa-lg"></i>
                        Movies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="UserManage">
                        <i class="fas fa-user-alt me-4 fa-lg"></i>
                        Customer
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="StaffManage">
                        <i class="fas fa-user-circle me-4 fa-lg"></i>
                        Staff
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="RewardManage">
                        <i class="fas fa-award me-4 fa-lg"></i>
                        Reward
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-ticket-alt me-4 fa-lg"></i>
                        Bookings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AdminForum.html">
                        <i class="fa fa-users me-4 fa-lg"></i>
                        Forum
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Feedback.html">
                        <i class="fa fa-comment-dots me-4 fa-lg"></i>
                        Feedback
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="TicketPricingManagement">
                        <i class="fa fa-ticket me-4 fa-lg"></i>
                        Ticket Pricing Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="TicketTracking.html">
                        <i class="fa fa-ticket-alt me-4 fa-lg"></i>
                        Ticket Tracking
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-chart-bar me-4 fa-lg"></i>
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog me-4 fa-lg"></i>
                        Settings
                    </a>
                </li>
            </ul>
        </div>
        <!-- Admin Info -->
        <div class="admin-info">
            <div class="d-flex align-items-center mb-2">
                <img src="<?= ROOT ?>/assets/images/defaultProfile.jpg" alt="Admin Avatar" class="me-2"/>
                <div>
                    <strong><?= $_SESSION['admin']['userName'] ?? 'Admin' ?></strong>
                    <div class="small text-muted"
                         style="background-color: whitesmoke; border-radius: 20px; text-align: center; width: 100px"><?= $_SESSION['admin']['role'] ?? 'Role' ?></div>
                </div>
            </div>
            <!-- Profile Link -->
            <a class="btn btn-outline-light btn-sm w-100" href="AdminProfile">
                <i class="fas fa-user me-2"></i>Profile
            </a>
            <br><br>
            <!-- Logout Link -->
            <a class="btn btn-outline-light btn-sm w-100" href="Logout">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </div>
    </div>
</nav>
