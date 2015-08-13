<?php

class WsWebinarTemplate_EmailFooter {

    public static function get() {
        ?>
        </td>
        </tr>
        <tr>
            <td height="50px"><?php echo (!null == get_option('_wswebinar_email_footerTxt') ? get_option('_wswebinar_email_footerTxt') : ''); ?></td> 
        </tr>
        </table>
        </td>
        <td>&nbsp;</td>
        </tr>
        </table>
        </body>
        </html>
    <?php
    }

}
