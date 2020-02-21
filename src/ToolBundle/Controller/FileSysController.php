<?php


namespace ToolBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;

class FileSysController extends  Controller
{
    public function  dumpFileAction($file, $content){
        $fs = new Filesystem();
        $path = __DIR__."/var/";
        $fs->dumpFile($path.$file, $content);
        return new Response("dumped in".$path.$file);
    }
}
