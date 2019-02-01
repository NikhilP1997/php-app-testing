<?php
require_once 'LocalServerTest.php';

class RoutesTest extends LocalServerTest {
  var $routes = [
    '/slim-app/hello/PHP'
  ];

  public function testRoutesStatusCodes() {
    $this->output("\nTesting routes for HTTP error codes");

    foreach ($this->routes as $route) {
      $response = $this->makeRequest($route);
      $statusCode = $response->getStatusCode();
      $this->output(sprintf("\t%s: %d", $route, $statusCode));
      $this->assertEquals(200, $statusCode);
    }
  }

  public function testRoutesHtmlCode() {
    $this->output("\nValidating routes output");

    foreach ($this->routes as $route) {
      $response = $this->makeRequest($route);
      $body = $response->getBody();
      // I wanted to use a real HTML validator here, but
      // DOMDocument does not understand HTML5 and
      // Tidy did not report any error with missing closing tags... seriously, PHP?
      $valid = (strpos($body, 'Hello, PHP!') !== false);
      $this->output(sprintf("\t%s: %d", $route, $valid));
      $this->assertEquals(true, $valid);
    }
  }
}
