<?php
namespace sPHP;

?>

<header>
	<a href="./?_Script=Home">Home</a>
	<a href="./?_Script=Management/Generic/Person">Person</a>
	<a href="./?_Script=User/SignIn">Sign in</a>
	<a href="./?_Script=User/SignOut">Sign out</a> | <a href="./?_Script=User/Profile"><?=$User->Name()?></a>
</header>

<main>
	<div class="Content">