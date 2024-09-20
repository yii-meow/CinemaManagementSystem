<!--Navigation Bar-->
<div class="dropdowns" style="display: flex; flex-flow: row nowrap;">
    <div class="drop">
        <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
            ACTION
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">Superhero</a></li>
            <li><a class="dropdown-item" href="">War</a></li>
            <li><a class="dropdown-item" href="">Adventure</a></li>
        </ul>
    </div>
    <div class="drop">
        <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
            HORROR
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">Supernatural Horror</a></li>
            <li><a class="dropdown-item" href="">Zombie</a></li>
        </ul>
    </div>
    <div class="drop">
        <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
            ANIMATION
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">2D Animation</a></li>
            <li><a class="dropdown-item" href="">3D Animation</a></li>
            <li><a class="dropdown-item" href="">Anime</a></li>
        </ul>
    </div>
    <div class="drop">
        <a href="<?= ROOT ?>/MovieResult?category=romance">
            <button class="btn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                ROMANCE
            </button>
        </a>
    </div>
    <div class="drop">
        <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
            FORUM
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= ROOT ?>/Forum/index">Community Forum</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/AddPost/index">Create Post</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/MyPost/index">My Post</a></li>
            <li><a class="dropdown-item" href="<?= ROOT ?>/ShowLikedPost/index">Liked Post</a></li>
        </ul>
    </div>
</div>