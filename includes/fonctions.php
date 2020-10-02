<?php
function secure_sqlformat($chaine)
{
    return preg_replace('/[^a-zA-Z0-9 ]/s', '', $chaine);
}
