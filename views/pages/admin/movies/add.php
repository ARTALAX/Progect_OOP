<?php include "../views/components/start.php";
use App\Kernel\Session\Session; ?>
<h1>add book</h1><?php var_dump($_GET['q']); ?>
<form action="/validate-form" method="post">
	<input type="text" name="name" placeholder="Имя">
	<input type="email" name="email" placeholder="Email">
	<?php $session = new Session();
	if ($session->has('name')) { ?>
		<ul>
			<?php foreach ($session->getFlash('name') as $error) { ?>
				<li>
					<?= $error ?>
				</li>

			<?php } ?>
		</ul>
	<?php } ?>
	<button type="submit">Отправить</button>
	<?php include "../views/components/end.php"; ?>