<?php

class SiteTest extends PHPUnit_Framework_TestCase
{
    public function testTaoBao()
    {
        $taobao = new Site; 
        $taobao->setTitle( "淘宝" );  
        $this->assertEquals("淘宝", $taobao->getTitle());
    }

    public function testGoogle()
    {
        $google = new Site; 
        $google->setTitle( "Google搜索" ); 
        $this->assertEquals("Google搜索", $google->getTitle());
    }
}
