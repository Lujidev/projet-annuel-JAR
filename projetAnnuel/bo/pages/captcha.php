<?php
session_start();

/* -----------------------------CREATE ALL VAR----------------------------- */

/*========= IMAGE SIZE =========*/
$image_width = 300;
$image_height = 150;


/*========= FONT CHOISE =========*/
$listOfFonts = scandir("fonts");
$font = "fonts/".$listOfFonts[rand(2,8)];


/*========= LETTERS =========*/
///ORIGINAL $autorized_char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$autorized_char = "abcdefghijklmnopqrstuvwxyz0123456789";
$nb_letters = rand(5,7);
$letters = array(); /* Contains all the letters which compose the sentence display */
$letters_position_x = array();
$letters_position_y = array();
$font_rotation = array();
$font_size = array();

for ($i=0; $i < $nb_letters; $i++){
    $letters[] = substr(str_shuffle($autorized_char), 0, 1);
    $letters_position_x[] = (rand (20, $image_width - 60) / $nb_letters) + $i * ($image_width / $nb_letters);
    $letters_position_y[] = rand (40, $image_height - 40);
    /*With thoose coeficients, letters can't be display out of screen*/
    $font_rotation[] = rand (-30, 30);
    $font_size[] = rand (16, 22);
}
$_SESSION['captcha'] = $letters;


/*========= POLYGONS =========*/
$nb_polygon = rand (3, 7);
$polygon_array = array();

for ($i = 0; $i < $nb_polygon; $i++){
    $nb_points = rand (3, 8);
    
    $polygon_array[] = $nb_points;
    
    for ($j = 0; $j < $nb_points; $j++){
        $polygon_array[] = rand (0, $image_width ); // Xi
        $polygon_array[] = rand (0, $image_height); // Yi
    }
}
/** 
 * Description of polygon_array[]
 *    
 * It contains all number of points per polygon
 * and also contains all the positions (x,y) of each points
 * in this order:
 *
 *   polygon_array = [nb_points_polygon1,
 *                    X_position_point1_of_polygon1,
 *                    Y_position_point1_of_polygon1,
 *                    X_position_point2_of_polygon1, 
 *                    Y_position_point2_of_polygon1,
 *                         ...
 *                    X_position_pointN_of_polygon1, --> There will be many positions as points to be located
 *                    Y_position_pointN_of_polygon1,     
 *                    nb_points_polygon2, --> We record data in the continuation
 *                    X_position_point1_of_polygon2,
 *                    Y_position_point1_of_polygon2,
 *                    X_position_point2_of_polygon2, 
 *                    Y_position_point2_of_polygon2,
 *                         ...
 *                    X_position_pointN_of_polygon2,
 *                    Y_position_pointN_of_polygon2,
 *                         ...
 *                    nb_points_polygon_N, --> As many polygon which will be display
 *                         ...
 *                    ];
 *
 * At display time, we will 'slice' this array to be able to give correct parameters to imagepolygon().
 */


/*========= COLORS =========*/
/*Color of background*/
$bg_color_r = rand (0,255);
$bg_color_g = rand (0,255);
$bg_color_b = rand (0,255);

/*Color of letters is the negative of the color background*/
$text_color_r = 255 - $bg_color_r;
$text_color_g = 255 - $bg_color_g;
$text_color_b = 255 - $bg_color_b;



/* ----------------------------- DISPLAY CAPTCHA ----------------------------- */

header("Content-type: image/png");
$image = imagecreate($image_width, $image_height);

/*Background color*/
imagecolorallocate($image, $bg_color_r, $bg_color_g, $bg_color_b);

/*Text color*/
$color = imagecolorallocate($image, $text_color_r, $text_color_g, $text_color_b);

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

/* -------------------- POLYGON DISPLAY -------------------- */

$tmp_array = array();
/**
 * This array stock temporarily all the coordinates between two nb_points
 * and each loop handles a different polygon
 */

$index_contain_nb_points = 0;
/**
 * =0 because in polygon_array[], 
 * polygon_array[0] contain necessarily a $nb_points
 */

for ($i = 0; $i < $nb_polygon; $i++)
{
    $count = 0;
    /**
     * $count allow to feed tmp_array[] 
     * and always start to 0 for each new polygon handled
     */
    for ($j = $index_contain_nb_points + 1;
         $j < $index_contain_nb_points + 2 * $polygon_array[$index_contain_nb_points] + 1;
         /*While we are not on the next index which contain an nb_points*/
         $j++){
        /**
         * $j scan polygon_array[] to stock points positions from this array to tmp_array[]
         */    
        $tmp_array[$count] = $polygon_array[$j];
        $count++;
    }
    
    imagepolygon(
        $image,
        $tmp_array,
        $polygon_array[$index_contain_nb_points],
        $color
    );
    
    $index_contain_nb_points += 2 * $polygon_array[$index_contain_nb_points] + 1;
}
    /**
     * With this calculation, $index_contain_nb_points JUMP in polygon_array[] FROM an index which contain
     * nb_points TO the next index which contain the next nb_point.
     *
     * ex: polygon_array[0] = 5 -->the polygon is a pentagon,
     *           we need 10 coordinates
     *           so we will jump to polygon_array[11] because
     *           polygon_array[1] to polygon_array[10] contains coordinates
     */

imagepng($image);
imagedestroy($image);