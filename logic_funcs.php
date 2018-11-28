<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 13.04.18
 * Time: 23:12
 */
$x=15;
$a = 0;
$b = 17;
$c = 37;
function Factorial($x)
{
    if ($x > 1)
        return $x*Factorial($x - 1);
    else
        return 1;
}
function Angle_between_arms($a,$b,$c)
{

    if ($a >= 12 || $a <= -1)
        return "Wrong hours";
    if ($b > 60 || $b <= -1)
        return "wrong minutes";
    $angle = 0;
    $hour_angle = $a*30 + (0.5*$b);
    $minut_angle = $b*6 + (0.1*$c);
    $angle += $hour_angle >= $minut_angle ? $hour_angle - $minut_angle : $minut_angle - $hour_angle;

    return $angle < 181 ? $angle : $angle - 180;
}
echo "<table style='border: 1px black;width: 100%;'><tr><td>Factorial of $x</td></tr><tr><td>" .Factorial($x)."</td></tr></table>";

echo "Angle between arms on clock:<table style='border: 1px black;width: 100%;'> <tr><td> hours: $a </td></tr><tr><td>minutes: $b </td></tr><tr><td> seconds: $c </td></tr><tr><td>angle: ".Angle_between_arms($a,$b,$c)."</td></tr></table>";
?>