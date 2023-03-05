<?php

declare(strict_types=1);

namespace getinstance\lazy\medium;

use PHPUnit\Framework\TestCase;
use getinstance\utils\aichat\ai\Messages;
use getinstance\utils\aichat\ai\Comms;
use getinstance\utils\aichat\control\Runner;

final class Article12Test extends TestCase
{
    private function getToken(): string
    {
        $path = __DIR__ . "/../conf/chat.json";
        $conf = json_decode(file_get_contents($path), true);
        $token = $conf['openai']['token'];
        return $token;
    }

    public function testRunner(): void
    {
        $runner = new Runner();
        $msgs = $runner->start("test1");
        $resp = $runner->query($msgs, "can you create PHP singleton template class named Registry?");
        fputs(STDERR, print_r($resp, true));
        $exchange = $msgs->toArray();
        $this->assertEquals($resp, $exchange[count($exchange) - 1]['content']);
    }

    public function testQuery(): void
    {
        $msgs = new Messages("clever and humorous");
        $comms = new Comms($this->getToken());
        $msgs->addMessage("user", "hello bot");
        $msgs->addMessage("assistant", "hello how can I help you?");
        $msgs->addMessage("user", "What is the earliest known love poem?");
        $resp = $comms->sendQuery($msgs);
        $this->assertTrue(strlen($resp) > 5);
        fputs(STDERR, print_r($resp, true));
    }

    public function testMessages(): void
    {
        $msgs = new Messages("clever and humorous");
        $this->assertInstanceof(Messages::class, $msgs);
        $msgs->addMessage("user", "hello bot");
        $output = $msgs->toArray();
        $this->assertEquals($output[0]['role'], "system");
        $this->assertStringContainsString("clever and humorous", $output[0]['content']);
        $this->assertEquals($output[1]['role'], "user");
        $this->assertStringContainsString("hello bot", $output[1]['content']);
    }
}
