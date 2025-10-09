<?php
use PHPUnit\Framework\TestCase;
use Helpers\Url;

class UrlTest extends TestCase
{
    public function setUp(): void
    {
        // Simulate environment for tests
        $_SERVER['SCRIPT_NAME'] = '/student-monitoring/public/index.php';
        $_SERVER['SCRIPT_FILENAME'] = 'C:/xampp/htdocs/student-monitoring/public/index.php';
    }

    public function testBasePath()
    {
        $this->assertEquals('/student-monitoring', Url::basePath());
    }

    public function testTo()
    {
        $this->assertEquals('/student-monitoring/dashboard', Url::to('/dashboard'));
        $this->assertEquals('/student-monitoring/', Url::to('/'));
    }

    public function testAsset()
    {
        $this->assertEquals('/student-monitoring/assets/app.css', Url::asset('app.css'));
        $this->assertEquals('/student-monitoring/assets/app.js', Url::asset('app.js'));
        $this->assertEquals('/student-monitoring/assets/icons/icon.svg', Url::asset('icons/icon.svg'));
    }

    public function testPublicPath()
    {
        $this->assertEquals('/student-monitoring/manifest.json', Url::publicPath('manifest.json'));
        $this->assertEquals('/student-monitoring/browserconfig.xml', Url::publicPath('browserconfig.xml'));
    }
}
