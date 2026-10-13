<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <url>
            <loc><?php echo e(URL::to('/')); ?>/<?php echo e($page->page_slug); ?></loc>
            <lastmod><?php echo e(date('c',time())); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</urlset><?php /**PATH /home/catalogo/public_html/resources/views/sitemap/pages.blade.php ENDPATH**/ ?>