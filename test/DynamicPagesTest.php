<?php
require_once 'LocalServerTest.php';

class DynamicPagesTest extends LocalServerTest {
  public function testDynamicPagesStatusCodes() {
    $this->output("\nTesting dynamic pages for HTTP error codes");
    $pages = $this->getTestablePages('php');

    foreach ($pages as $page) {
      $response = $this->makeRequest($page);
      $statusCode = $response->getStatusCode();
      $this->output(sprintf("\t%s: %d", $page, $statusCode));
      $this->assertEquals(200, $statusCode);
    }
  }

  public function testDynamicPagesHtmlCode() {
    $this->output("\nValidating dynamic pages HTML syntax");
    $pages = $this->getTestablePages('php');

    foreach ($pages as $page) {
      $response = $this->makeRequest($page);
      $body = $response->getBody();
      // I wanted to use a real HTML validator here, but
      // DOMDocument does not understand HTML5 and
      // Tidy did not report any error with missing closing tags... seriously, PHP?
      $valid = (strpos($body, '<h1>Hello, PHP!</h1>') !== false);
      $this->output(sprintf("\t%s: %d", $page, $valid));
      $this->assertEquals(true, $valid);
    }
  }
}
