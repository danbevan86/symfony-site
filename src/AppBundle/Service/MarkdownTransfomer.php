<?php
/**
 * Created by PhpStorm.
 * User: danbevan
 * Date: 06/09/2016
 * Time: 18:45
 */

namespace AppBundle\Service;


class MarkdownTransfomer
{

    public function parse($str)
    {
        return strtoupper($str);
    }
}