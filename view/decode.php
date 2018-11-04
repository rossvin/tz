<div class="centered2">
<p>Ваш пароль:</p>
<p>
    <?php
    $deCode = new deCode();
    echo $deCode->deCode1();
    $deCode->del();

    ?> </p>
</div>