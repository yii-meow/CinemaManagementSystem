<!--Navigation Bar-->
<div class="dropdowns">
    <div class="category-container">
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=Action">
                <button class="btn dropbtn" type="button">
                    ACTION
                </button>
            </a>
        </div>
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=Animation">
                <button class="btn dropbtn" type="button">
                    ANIMATION
                </button>
            </a>
        </div>
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=Comedy">
                <button class="btn dropbtn" type="button">
                    COMEDY
                </button>
            </a>
        </div>
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=Adventure">
                <button class="btn dropbtn" type="button">
                    ADVENTURE
                </button>
            </a>
        </div>
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=Fantasy">
                <button class="btn dropbtn" type="button">
                    FANTASY
                </button>
            </a>
        </div>
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=Horror">
                <button class="btn dropbtn" type="button">
                    HORROR
                </button>
            </a>
        </div>
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=Romance">
                <button class="btn dropbtn" type="button">
                    ROMANCE
                </button>
            </a>
        </div>
        <div class="drop">
            <a href="<?= ROOT ?>/MovieResult?category=All">
                <button class="btn dropbtn" type="button">
                    ALL MOVIES
                </button>
            </a>
        </div>
    </div>
    <div class="forum-container mr-2">
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
    <div class="forum-container mr-2">
        <div class="drop">
            <button class="btn dropdown-toggle dropbtn" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                Feedback
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= ROOT ?>/FeedbackController">Add feedback</a></li>
                <li><a class="dropdown-item" href="<?= ROOT ?>/FeedbackHistory">My feedback</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    .dropdowns {
        background-color: #f03351;
        padding: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        flex-grow: 1;
    }

    .forum-container {
        flex-shrink: 0;
    }

    .drop {
        margin: 0 30px;
    }

    .dropbtn {
        border: 0 !important;
        box-shadow: none;
        color: white;
        margin: 0;
        transition: all 0.3s ease;
    }

    .dropbtn:hover {
        background-color: #fff;
        color: #f03351;
    }

    .dropdown-menu {
        background-color: #fff;
        border: none;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .dropdown-item {
        color: #f03351;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #d62b49;
    }

    .btn {
        --bs-btn-padding-x: 0.35rem;
    }


    @media (max-width: 768px) {
        .dropdowns {
            flex-direction: column;
        }

        .category-container {
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .forum-container {
            width: 100%;
            margin-top: 10px;
            margin-right: 100px;
        }

        .drop {
            margin: 5px 0;
            width: 100%;
        }

        .dropbtn {
            width: 100%;
        }
    }
</style>