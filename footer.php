<footer>

    <div>
        <h6>reseaux sociaux</h6>
        <a href="https://www.youtube.com/channel/UCO8F6et9nPeQ3pI0RzAywCA"><img src="photo/youtube.png" style="width:50px;" alt="youtube"></a>
        <a href="https://www.instagram.com/saintyvesbeatmaker/"><img src="photo/insta.png" style="width:50px;" alt="instagram"></a>
        <a href="https://www.facebook.com/saintyvesbeatmaker/"><img src="photo/facebook.png" style="width:50px;" alt="facebook"></a>
        <a href="https://soundcloud.com/saintyvesbeatmaker/tracks"><img src="photo/soundcloud.png" style="width:50px;" alt="soundcloud"></a>
        <a href="https://saintyves.bandcamp.com/"><img src="photo/bandcamp.png" style="width:50px;" alt="bandcamp" /></a>
    </div>
    <div>
    <p class="mention"><a href="mentionlegale.php">Mentions légales </a></p>
    <p class="cookie"><a href="cookiebot.php">cookie </a></p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="./slick/slick.js"></script>




<script>
    $('.regular').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [{
                breakpoint: 1700,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 1115,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 685,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,


                }
            }

        ]
    });
</script>


<?php ob_flush() ?>

</body>


</html>