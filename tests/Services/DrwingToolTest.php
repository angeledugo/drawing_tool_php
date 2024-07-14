<?php
namespace App\Tests\Services;

use App\Services\DrawingTool;
use PHPUnit\Framework\TestCase;

class DrawingToolTest extends TestCase
{
    private DrawingTool $drawingTool;

    protected function setUp(): void
    {
        $this->drawingTool = new DrawingTool();
    }

    public function testCreateCanvas(): void
    {
        $input = "C 20 4";
        $expected = "----------------------\n|                    |\n|                    |\n|                    |\n|                    |\n----------------------";
        $this->assertEquals($expected, $this->drawingTool->executeCommands($input));
    }

    public function testDrawLine(): void
    {
        $input = "C 20 4\nL 1 2 6 2";
        $expected = "----------------------\n|                    |\n|xxxxxx              |\n|                    |\n|                    |\n----------------------";
        $this->assertEquals($expected, $this->drawingTool->executeCommands($input));
    }

    public function testDrawRectangle(): void
    {
        $input = "C 20 4\nR 16 1 20 3";
        $expected = "----------------------\n|               xxxxx|\n|               x   x|\n|               xxxxx|\n|                    |\n----------------------";
        $this->assertEquals($expected, $this->drawingTool->executeCommands($input));
    }

    public function testBucketFill(): void
    {
        $input = "C 20 4\nL 1 2 6 2\nL 6 3 6 4\nR 16 1 20 3\nB 10 3 o";
        $expected = "----------------------\n|oooooooooooooooxxxxx|\n|xxxxxxooooooooox   x|\n|     xoooooooooxxxxx|\n|     xoooooooooooooo|\n----------------------";
        $this->assertEquals($expected, $this->drawingTool->executeCommands($input));
    }
}