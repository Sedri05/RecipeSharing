<link href="/header-style.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
<div class="header-container">
    <nav class="header-nav">
        <div class="header-flex">
            <div class="header-flex-item-title">
                <h1><a href="/">Chefly</a></h1>
            </div>
            <div class="header-flex-item"><a href="/search">Tags</a></div>
            <div class="header-flex-item"><a href="/about">Over Ons</a></div>
            <?php if (isset($_SESSION["logged_in"])) { ?>
                <div class="header-flex-item"><a href="/account">Account</a></div>
            <?php } else { ?>
                <div class="header-flex-item"><a href="/login">Inloggen</a></div>
            <?php } ?>
            <div class="header-flex-item-search">
                <span class="search-icon material-symbols-outlined">search</span>
                <form autocomplete="off" action="/search">
                    <input class="search-input" type="text" placeholder="zoeken" name="search">
                </form>
            </div>
        </div>
    </nav>
</div>