<?php 
$Param['page'] += 0;
$Param['cat'] += 0;

if ($Param['cat'] and $Param['cat'] <= 0 or $Param['cat'] > 3) MessageSend(1, 'Такой категории не существует.', '/news');

Head('Каталог новостей');
?>
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
<div class="CatHead">
<?php if ($_SESSION['USER_LOGIN_IN']) echo '<a href="/loads/add"><div class="Cat">Добавить файл</div></a>' ?>
<a href="/loads"><div class="Cat">Все новости</div></a>
<a href="/loads/main/cat/1"><div class="Cat">Поисковое продвижение</div></a>
<a href="/loads/main/cat/2"><div class="Cat">Оптимизация сайта</div></a>
<a href="/loads/main/cat/3"><div class="Cat">Новичкам</div></a>
<?php SearchForm() ?>
</div>

<div class="Page">
<?php 
if ($Module == 'main' and !$Param['cat']) {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'WHERE `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `loads` '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `loads` '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `loads`';
$Param4 = '/loads/main/page/';
} else {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `loads` WHERE `cat` = '.$Param['cat'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `loads` WHERE `cat` = '.$Param['cat'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `loads` WHERE `cat` = '.$Param['cat'];
$Param4 = '/loads/main/cat/'.$Param['cat'].'/page/';
}

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


PageSelector($Param4, $Param['page'], $Count);

while ($Row = mysqli_fetch_assoc($Result)) {
if (!$Row['active']) $Row['name'] .= ' (Ожидает модерации)';

echo '<a href="/loads/material/id/'.$Row['id'].'"><div class="ChatBlock"><span>Добавил: '.$Row['added'].' | '.$Row['date'].'</span>'.$Row['name'].'</div></a>';


}
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>