<!--Header-->
<div class="header" id="header">

    <div class="binder">
        <a href="Homepage">
            <div style="margin-left: 20px;" class="business-icon">
                <div
                        style="color: white; height: inherit; text-align: center; font-weight: bold; font-size: 20px;">
                    <img src="<?= ROOT ?>/assets/images/alternativeIcon.png" draggable="false" width="200" height="55"/>
                </div>
            </div>
        </a>

        <div class="search-ctn col-7" style="margin-top: auto; margin-bottom: auto;">
            <form action="<?= ROOT ?>/MovieResult" method="GET" class="search-ctn input-group"
                  style="display: flex; flex-flow: row nowrap; min-width: 100%;" role="search">
                <div class="s-box col-11">
                    <input type="text" name="search" autocomplete="off"
                           style="outline:2px solid #f03351; color: #f03351; position: relative; border-bottom-right-radius: 0px; border-top-right-radius: 0px;"
                           id="txtSearch" class="form-control border border-1 search-bar"
                           placeholder="Movie Title"/>
                </div>
                <div>
                    <button type="submit"
                            style="background-color: #141414; width: fit-content; border-bottom-left-radius: 0px; border-top-left-radius: 0px; border-color: #f03351; height: 41px; margin-top: -2px;"
                            class="btn-light btn btn-search">
                        <i style="color: #f03351; font-size: 18px; display: flex; justify-content: center; align-items: center; margin-top: 4.5px; height: 18px;"
                           class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="right-header">
        <div class="action-group" style="display: flex; flex-flow: row nowrap;">

            <?php if (isset($_SESSION['userId'])): ?>
                <!-- User is logged in -->
                <div class="profile-container action" id="profile">
                    <div style="margin-top: auto; margin-bottom: auto;">
                        <button onclick="window.location.href='<?= ROOT ?>/Profile'" class="btn header-font"
                                style="padding:10px; width: 160px; font-size: 17px; display: flex; color: #f03351;">
                            <i class="fa-solid fa-user" style="margin-right: 5px; font-size: 20px;"></i>
                            User Profile
                        </button>
                    </div>
                </div>
                <div class="login action" style="margin-right: 20px;">
                    <div style="margin-top: auto; margin-bottom: auto;">
                        <button ID="btnLgn" class="topBtns btn dropdown-toggle header-font" data-bs-toggle="dropdown"
                                aria-expanded="false" Style="font-size: 17px; color:#f03351">
                            <i style="color: #f03351; font-size:18px" class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Logout
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="Logout" class="dropdown-item LoginHover">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <!-- User is not logged in -->
                <div class="login action" style="margin-right: 20px;">
                    <div style="margin-top: auto; margin-bottom: auto;">
                        <button ID="btnLgn" class="topBtns btn dropdown-toggle header-font" data-bs-toggle="dropdown"
                                aria-expanded="false" Style="font-size: 17px; color:#f03351">
                            <i style="color: #f03351; font-size:18px" class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;Login
                        </button>
                        <ul class="dropdown-menu">
                            <li id="userlogin">
                                <a href="Login" id="hrefCustomer" class="dropdown-item LoginHover">Customer</a>
                            </li>
                            <li id="stafflogin">
                                <a id="hrefStaff" href="LoginStaff" class="dropdown-item LoginHover">Staff</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

