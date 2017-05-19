<?php
session_start();

/* -----------------------------CREATE ALL VAR----------------------------- */

/*========= IMAGE SIZE =========*/
$image_width = 300;
$image_height = 150;

/*========= FONT CHOISE =========*/
$font = "fonts/comfortaa.ttf";

/*========= LETTERS =========*/
$autorized_char = "0123456789";
$nb_letters = 4;
$letters = array();
$letters_position_x = array();
$letters_position_y = array();
$font_rotation = array();
$font_size = array();

for ($i=0; $i < $nb_letters; $i++){
    $letters[] = substr(str_shuffle($autorized_char), 0, 1);
    $letters_position_x[] = (rand (20, $image_width - 70) / $nb_letters) + $i * ($image_width / $nb_letters);
    $letters_position_y[] = $image_height / 2;
    $font_rotation[] = 0;
    $font_size[] = 25;
}
$_SESSION['captcha'] = $letters;


/* ----------------------------- DISPLAY CAPTCHA ----------------------------- */

header("Content-type: image/png");
$image = imagecreate($image_width, $image_height);

/*Background color*/
imagecolorallocate($image, 32, 100, 200);

/*Text color*/
$color = imagecolorallocate($image, 200, 20, 32);

/** -------------------- TEXT DISPLAY --------------------
 *  We scan arrays give in parameter of imagettftext(). 
 *  Each loop handles a letter.
 *  The color and font are the same for all the letters.
 */
for ($i=0; $i < $nb_letters ; $i++){
    imagettftext(
        $image,
        $font_size[$i],
        $font_rotation[$i],
        $letters_position_x[$i],
        $letters_position_y[$i],
        $color,
        $font,
        $letters[$i]
    );
}

imagepng($image);
imagedestroy($image);