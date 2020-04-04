<?php
/*
 * @author Mark Hameetman (BureauPartners B.V.) <mark@bureau.partners>
 * @link https://github.com/bureaupartners/pdfgrep
 * @license MIT
 *
 * @copyright Copyright (c) 2019, GRIVOS Holding B.V.
 */

declare (strict_types = 1);
use BureauPartners\pdfgrep\pdfgrep;
use PHPUnit\Framework\TestCase;

final class ExtractPdfTest extends TestCase
{
    public function testCanExtractWord()
    {
        $pdfgrep = new pdfgrep(dirname(__FILE__) . '/pdf/Document.pdf', 'ipsum');
        $this->assertCount(29, $pdfgrep->getMatches());
        print_r($pdfgrep->getMatches());
    }

    public function testCanGetPageNumbers()
    {
        $pdfgrep = new pdfgrep(dirname(__FILE__) . '/pdf/Document.pdf', 'Lorem ipsum dolor');
        $this->assertCount(2, $pdfgrep->getPageNumbers());
        $this->assertContains(1, $pdfgrep->getPageNumbers());
        $this->assertContains(3, $pdfgrep->getPageNumbers());
    }
}
