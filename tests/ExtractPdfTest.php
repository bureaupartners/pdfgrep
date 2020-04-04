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
        $pdfgrep = new pdfgrep(dirname(__FILE__) . '/pdf/Document.pdf', 'id');
        $this->assertCount(7, $pdfgrep->getMatches());
    }

    public function testCanGetPageNumbers()
    {
        $pdfgrep = new pdfgrep(dirname(__FILE__) . '/pdf/Document.pdf', 'id');
        $this->assertCount(1, $pdfgrep->getPageNumbers());
    }
}
