<?php Head('Пишем свой движок на PHP') ?>
<body>
<div class="wrapper">
<div class="header">
    <div>
        <a class="header__btn" href="/contact/">Оставить заявку</a>
        <p>
            8 (800) 000 00 00
        </p>
    </div>
</div>
<div class="content">
<?php Menu();
MessageShow() 
?>
    <h1 class="home-page--h1">Компания "Генератор продаж" поможет продвинуть ваш сайт в поисковой системе!</h1>
    <h2 class="home-page--h2">В доказательство, посмотрите результаты наших клиентов:</h2>
    <div class="Wallop Wallop--fade">
        <div class="Wallop-list">
            <div class="Wallop-item Wallop-item--current">
                <img src="/resource/img/slide1.png" />
            </div>
            <div class="Wallop-item">
                <img src="/resource/img/slide2.png" />
            </div>
            <div class="Wallop-item">
                <img src="/resource/img/slide3.jpg" />
            </div>
        </div>
        <button class="Wallop-buttonPrevious"></button>
        <button class="Wallop-buttonNext"></button>
    </div>
    <link rel="stylesheet" href="/resource/wallop.css">
    <link rel="stylesheet" href="/resource/wallop--fade.css">
    <script type="text/javascript" src="/resource/Wallop.min.js"></script>
    <script type="text/javascript">
        var wallopEl = document.querySelector('.Wallop');
        var wallop = new Wallop(wallopEl);
    </script>
<div class="Page">
    <h2 class="articles-cool--h2">Читайте всё о продвижении:</h2>
    <div class="articles-cool">
<?php $Query = mysqli_query($CONNECT, 'SELECT `id`, `dimg`, `name` FROM `loads` ORDER BY `date` DESC LIMIT 8'); 
while ($Row = mysqli_fetch_assoc($Query)) echo '<a href="/loads/material/id/'.$Row['id'].'"><img src="/catalog/mini/'.$Row['dimg'].'/'.$Row['id'].'.jpg" class="lm" alt="'.$Row['name'].'" title="'.$Row['name'].'"><p class="article-cool__title">'.$Row['name'].'</p></a>';



$OnlineU = mysqli_query($CONNECT, 'SELECT `user` FROM `online`'); 

$u0 = 0;
$u1 = 0;

while ($data = mysqli_fetch_assoc($OnlineU)) {
	

if ($data['user'] == 'guest') $u0 += 1;	

else {
	$u1 += 1;	
	$u_list .= '<a href="/user/login/'.$data['user'].'" class="lol">'.$data['user'].'</a>, ';
	
	
}
	
	



	
	
}

	if ($u_list) $u_list = ' [ '.substr($u_list, 0, -2).' ]';

	
	echo 'Гостей: '.$u0.' | Пользователей: '.$u1.$u_list;



?>

    </div>



</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>