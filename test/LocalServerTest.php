<?php
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client;

abstract class LocalServerTest extends TestCase
{

  protected static $process;

  const HOST = "localhost";
  const PORT = 8080;

  public static function setUpBeforeClass()
  {
    $command = sprintf(
      // display_errors=Off is necessary because PHP would show
      // errors on screen and return 200 if it is set to On... seriously, PHP?
      'php -d display_errors=Off -S %s:%d -t %s',
      self::HOST,
      self::PORT,
      realpath(__DIR__ . '/../www')
    );
    self::$process = new Process($command);
    // Uncomment if the process hangs after too much output
    // self::$process->disableOutput();
    self::$process->start();
    // Wait for the server to start...
    usleep(100000);
  }

  public static function tearDownAfterClass()
  {
    self::$process->stop();
  }

  protected function makeRequest($path = NULL, $data = NULL, $method = 'GET')
  {
    $params = [];
    if ($data) {
      $params['body'] = $data;
    }

    $client = new Client([
      'base_uri' => 'http://' . static::HOST . ':' . static::PORT,
      'http_errors' =>  false
    ]);
    return $client->request($method, $path, $params);
  }

  protected function makeRelativePath(&$absolutePath) {
    $absolutePath = substr($absolutePath, strlen(realpath(__DIR__ . '/../www')));
  }

  protected function getTestablePages($ext='*') {
    $files = glob(dirname(__DIR__) . '/www/*.' . $ext);
    array_walk($files, array($this, 'makeRelativePath'));
    return $files;
  }

  protected function output($message) {
    fwrite(STDERR, $message . "\n");
  }
}
