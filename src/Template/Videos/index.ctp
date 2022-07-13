<section id="page-content" class="sidebar-left">
    <div class="container">
        <!-- Page title -->
        <div class="page-title">
            <h1>Video - Youtube</h1>
            <div class="breadcrumb float-left">
                <ul>
                    <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index' ]); ?>">Beranda</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Videos', 'action' => 'index' ]); ?>">Video</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end: Page title -->
        <!-- Blog -->
        <div id="blog">
            <?php if($videos) : ?>
                <?php foreach($videos as $k => $video) : ?>
                    <div class="post-item">
                        <div class="post-item-wrap">
                            <div class="post-video">
                                <?php echo $video->embed; ?>
<!--                                <iframe width="560" height="315" src="https://www.youtube.com/embed/dA8Smj5tZOQ" frameborder="0" allowfullscreen></iframe>-->
                                <span class="post-meta-category"><a href="#">Video</a></span>
                            </div>
                            <div class="post-item-description">
                                <span class="post-meta-date"><i class="fa fa-calendar-o"></i><?= $video->created->format('d M Y'); ?></span>
                                <h2><a href="#"><?php echo $video->title; ?></a></h2>
                                <p><?php echo $video->description; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h2>Data Video Tidak Ditemukan.</h2>
            <?php endif; ?>
        </div>
        <!-- end: Blog -->
    </div>
</section> <!-- end: Content -->
