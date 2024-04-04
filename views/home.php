<h1>Meus vídeos</h1>
<?php foreach($videos as $video): ?>

<div class="video">
        <a href="<?php echo BASE_URL ?>/videi/ver/<?php echo $video['url']; ?>"></a><strong><?php echo $video['titulo']; ?></strong>
</div> 

<?php endforeach; ?>