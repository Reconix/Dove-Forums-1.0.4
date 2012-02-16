<div class="sidebar_box">
    <div class="sidebar_heading"><h3><?php echo $this->lang->line('searchTitle'); ?></h3></div>
        <div id="search">
            <form method="post" id="searchform" action="<?php echo ''.site_url().'/forums/search'; ?>">
                <fieldset class="search">
                <input name="search" type="text" class="box" />
                <button class="btn" title="Submit Search"><?php echo $this->lang->line('searchButton'); ?></button>
                </fieldset>
            </form>
        </div>
</div>