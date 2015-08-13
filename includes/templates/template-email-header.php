<?php

class WsWebinarTemplate_EmailHeader {

    public static function get($logoURI, $title, $content, $basecolor, $bodybgcolor, $emailbodybgcolor , $bodyTXTcolor) {
        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title><?php echo $title; ?></title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            </head>
            <body>
                <table style="font-family: 'arial', sans-serif; background-color: <?php echo $bodybgcolor; ?>; width: 100%;">
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <table style="overflow: hidden; margin: 10px auto; width: 600px;">
                                <tr style="background-color:<?php echo $basecolor; ?>;">
                                    <td><img style="float: left; margin: 15px; max-height: 45px;" src="<?php echo $logoURI; ?>" /><h1 style="color:#333;"><?php echo $title; ?></h1></td>
                                </tr>
                                <tr style="background-color:<?php echo $emailbodybgcolor; ?>; color:<?php echo $bodyTXTcolor; ?>; padding: 10px;">
                                    <td colspan="2" style="padding: 20px;">             
                                        <?php
                                        echo $content;
                                    }

                                }