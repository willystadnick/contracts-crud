        </div>

        <hr/>

        <div class="container">
            <p class="text-center"><a href="https://about.me/willy.stadnick">Willy Stadnick</a> &copy; <?php echo date('Y'); ?></p>
            <br/>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <?php if (isset($js)): ?>
        <?php echo $js; ?>
        <?php endif;?>

    </body>
</html>
